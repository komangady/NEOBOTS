var mqtt;
var value_temperature = 0;
var value_humidity = 0;
var value_heartbeat = 0;
var value_weight = 0;
var value_ldr = 0;

var time_temperature = 0;
var time_humidity = 0;
var time_heartbeat = 0;
var time_weight = 0;
var time_ldr = 0;

function sendmesg(devicestring, command) {
 
	mqtt.send(devicestring, command);

	//----------------------------Console--------------
	if ($('#ws p').length > 30) {
	$('#ws p').first().remove();
	}
	$('#ws').append('<p class="pf" style="color: #FF0000 ;">Data Sent by Server :' + devicestring + ' = ' + command);
	$('#ws').scrollTop($("#ws")[0].scrollHeight - $("#ws").height());
	//----------------------------Console--------------
}


$( document ).ready(function() {
  var reconnectTimeout = 2000;
  function MQTTconnect() {
  if (typeof path == "undefined") {
      path = '/mqtt';
  }
  mqtt = new Paho.MQTT.Client(
    host,
    port,
    path,
    "web_" + parseInt(Math.random() * 100, 10)
  );
      var options = {
          timeout: 3,
          useSSL: useTLS,
          cleanSession: cleansession,
          onSuccess: onConnect,
          onFailure: function (message) {
              $('#status').val("Connection failed: " + message.errorMessage + "Retrying");
              setTimeout(MQTTconnect, reconnectTimeout);
          }
      };

      mqtt.onConnectionLost = onConnectionLost;
      mqtt.onMessageArrived = onMessageArrived;

      if (username != null) {
          options.userName = username;
          options.password = password;
      }
      console.log("Host="+ host + ", port=" + port + ", path=" + path + " TLS = " + useTLS + " username=" + username + " password=" + password);
      mqtt.connect(options);
  }

  function onConnect() {
      $('#status').html('Host: ' + host + ':' + port + path);
      mqtt.subscribe(topic, {qos: 0});
	  console.log("onConnect");
  }

  function onConnectionLost(response) {
      setTimeout(MQTTconnect, reconnectTimeout);
      $('#status').val("connection lost: " + responseObject.errorMessage + ". Reconnecting");

  };


  function onMessageArrived(message) {

	var topic = message.destinationName;
	var payload = message.payloadString;
		
	/* if(topic == "/sensors/temperature")
	{			
		value_temperature = payload;
	}
	if(topic == "/sensors/humidity")
	{			
		value_humidity = payload;
	}
	if(topic == "/sensors/heartbeat")
	{			
		value_heartbeat= payload;
	}
	if(topic == "/sensors/weight")
	{			
		value_weight= payload;
	}
	if(topic == "/sensors/ldr")
	{
		value_ldr = payload;
	} */
	 
	//----------------------------Console--------------
	if ($('#ws p').length > 30) {
		$('#ws p').first().remove();
	}
	$('#ws').append('<p class="pf" style="color: green ;"> Data received by broker : ' + topic + ' = ' + payload);
	$('#ws').scrollTop($("#ws")[0].scrollHeight - $("#ws").height());
	//----------------------------Console--------------
	 
  };


  $(document).ready(function() {
      MQTTconnect();
  });

});
