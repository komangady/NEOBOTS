void fuzzy_tempProcess()
{
  // Getting a random value
  
  Serial.println(inputSetpoint);
  inputSetpoint = map(inputSetpoint, 0, 50, 0, 50);
  Serial.print("Setpoint : ");
  Serial.println(inputSetpoint);
  int input = inputSetpoint - temp; 
  input = map(input, -50, 50, 10, -10);
  Serial.print("error : ");
  Serial.println(input);
  input_error_speed = (input_error_speed - input) / 1;
  
  // Printing something
  Serial.print("Error - Input fuzzy : ");
  Serial.println(input_error_speed);
  fuzzy->setInput(1, input);
  fuzzy->setInput(2, input_error_speed);
  fuzzy->fuzzify();
  float output = fuzzy->defuzzify(1);
  Serial.println("Result Speed: ");
  Serial.println(output, 1);
  input_error_speed = input;
}
