#include <PubSubClient.h>
#include <WiFiEspClient.h>
#include <WiFiEsp.h>
#include <WiFiEspUdp.h>
#include <Adafruit_Sensor.h>
#include <DHT.h>
#include <DHT_U.h>
#include <Fuzzy.h>
#define DHTPIN 12 
#define DHTTYPE DHT11 
DHT_Unified dht(DHTPIN, DHTTYPE);
uint32_t delayMS;
float temp, humi;
int input_error_speed = 0;

#define WIFI_AP ""
#define WIFI_PASSWORD ""


const char broker[] = "";
IPAddress server(000,000,000,000);
const int port = 0000;
char buffer[10];
void callback(char* topic, byte* payload, unsigned int length);

// Initialize the Ethernet client object
WiFiEspClient espClient;
PubSubClient tb(server, port, callback, espClient);

int inputSetpoint = 0;

void callback(char* topic, byte* payload, unsigned int length) {
  // Allocate the correct amount of memory for the payload copy
  byte* p = (byte*)malloc(length);
  // Copy the payload to the new buffer
  memcpy(p,payload,length);
  inputSetpoint = payload;
  tb.publish("outTopic", p, length);
  // Free the memory
  free(p);
}

int status = WL_IDLE_STATUS;
unsigned long lastSend;

const int ldrPin = A0; // analog pin 0
int PulseSensorPurplePin = 1;   // Pulse Sensor PURPLE WIRE connected to ANALOG PIN 1
int heartbeat_value = 0;                // holds the incoming raw data. Signal value can range from 0-1024
int ldr_value = 0;
int weight = 0;

Fuzzy *fuzzy = new Fuzzy();

void setup() {
  // initialize serial for debugging
  Serial.begin(9600);
  InitWiFi();
  lastSend = 0;
  dht.begin();
  sensor_t sensor;
  dht.temperature().getSensor(&sensor);
  dht.humidity().getSensor(&sensor);
  delayMS = sensor.min_delay / 1000;

  fuzzy_tempControl();
}

void loop() {
  status = WiFi.status();
  if ( status != WL_CONNECTED) {
    while ( status != WL_CONNECTED) {
      Serial.print("Attempting to connect to WPA SSID: ");
      Serial.println(WIFI_AP);
      // Connect to WPA/WPA2 network
      status = WiFi.begin(WIFI_AP, WIFI_PASSWORD);
      delay(500);
    }
    Serial.println("Connected to AP");
  }

  if ( !tb.connected() ) {
    reconnect();
  }

  if ( millis() - lastSend > 4000 ) { // Update and send only after 1 seconds
    
    //========================= START TEMPERATURE and HUMIDITY ==================
    // Delay between measurements.
    //delay(delayMS);
    // Get temperature event and print its value.
    sensors_event_t event;
    dht.temperature().getEvent(&event);
    if (isnan(event.temperature)) {
      Serial.println(F("Error reading temperature!"));
      temp = 0;
    }
    else {
      Serial.print(F("Temperature: "));
      Serial.print(event.temperature);
      Serial.println(F("°C"));
      temp = event.temperature;
    }
    // Get humidity event and print its value.
    dht.humidity().getEvent(&event);
    if (isnan(event.relative_humidity)) {
      Serial.println(F("Error reading humidity!"));
      humi = 0;
    }
    else {
      Serial.print(F("Humidity: "));
      Serial.print(event.relative_humidity);
      Serial.println(F("%"));
      humi = event.relative_humidity;
    }
    //========================= END TEMPERATURE and HUMIDITY ==================

    // ==================================== START FUZZY =======================
    fuzzy_tempProcess();
    // ==================================== END FUZZY =========================
    
    //========================= START LDR ==================
    ldr_value = analogRead(ldrPin);
    //========================= END LDR ====================

    //========================= START HEARTBEAT ============
    heartbeat_value = analogRead(PulseSensorPurplePin);  // Read the PulseSensor's value.
    //========================= END HEARTBEAT ============

    //========================= START WEIGHT ============
    weight = analogRead(A1);  // Read the PulseSensor's value.
    //========================= END WEIGHT ============
    
    dtostrf(temp,7, 2, buffer);      
    tb.publish("ICB001/temperature_value/tb_temperature",buffer);  

    dtostrf(humi,7, 2, buffer);      
    tb.publish("ICB001/humidity_value/tb_humidity",buffer);

    dtostrf(heartbeat_value,7, 0, buffer);      
    tb.publish("ICB001/heartbeat_value/tb_heartbeat",buffer);

    dtostrf(weight,7, 0, buffer);      
    tb.publish("ICB001/weight_value/tb_weight",buffer);

    dtostrf(ldr_value,7, 0, buffer);      
    tb.publish("ICB001/ldr_value/tb_ldr",buffer);

    lastSend = millis();
  }

  tb.loop();
  
}



void InitWiFi()
{
  // initialize serial for ESP module
  Serial1.begin(115200);
  // initialize ESP module
  WiFi.init(&Serial1);
  // check for the presence of the shield
  if (WiFi.status() == WL_NO_SHIELD) {
    Serial.println("WiFi shield not present");
    // don't continue
    while (true);
  }

  Serial.println("Connecting to AP ...");
  // attempt to connect to WiFi network
  while ( status != WL_CONNECTED) {
    Serial.print("Attempting to connect to WPA SSID: ");
    Serial.println(WIFI_AP);
    // Connect to WPA/WPA2 network
    status = WiFi.begin(WIFI_AP, WIFI_PASSWORD);
    delay(500);
  }
  Serial.println("Connected to AP");
}

void reconnect() {
  // Loop until we're reconnected
  while (!tb.connected()) {
    Serial.print("Connecting to ThingsBoard node ...");
    // Attempt to connect (clientId, username, password)
    if (tb.connect("clientID", "username", "password") ) {
      Serial.println( "[DONE]" );
      tb.subscribe("ICB001/control/heating");
    } else {
      Serial.print( "[FAILED]" );
      Serial.println( " : retrying in 5 seconds" );
      // Wait 5 seconds before retrying
      delay( 5000 );
    }
  }
}
