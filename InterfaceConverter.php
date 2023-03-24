<?php

// Get the reflection of the class
$reflection = new ReflectionClass('MyClass');

// Get the methods and properties of the class
$methods = $reflection->getMethods();
$properties = $reflection->getProperties();

// Create the interface code
$interfaceCode = "interface MyInterface {\n";

foreach ($methods as $method) {
  if (!$method->isConstructor() && $method->isPublic()) {
    $parameters = "";
    $params = $method->getParameters();
    foreach ($params as $param) {
      $parameters .= "$" . $param->getName() . ", ";
    }
    $parameters = rtrim($parameters, ", ");
    $interfaceCode .= "  public function " . $method->getName() . "($parameters);\n";
  }
}

foreach ($properties as $property) {
  if ($property->isPublic()) {
    $interfaceCode .= "  public $" . $property->getName() . ";\n";
  }
}

$interfaceCode .= "}\n";

// Output the interface code
echo $interfaceCode;

//************************************************************************************************************************/
//************************************************************************************************************************/
//************************************************************************************************************************/
// Define the PHP class with functions
class MyClass {
  public $prop1 = "hello";
  public $prop2 = "world";
  
  public function __construct($prop1, $prop2) {
    $this->prop1 = $prop1;
    $this->prop2 = $prop2;
  }
  
  public function myMethod() {
    echo "MyClass::myMethod() called.";
  }
}
?>