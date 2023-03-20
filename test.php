<?php
    include_once("config.php");
    include_once("ISecretsManager.php");
    use Dotenv\Dotenv;

    $paramStore = new AWSParameterStore();

    $key = "CONNECTION_STRING";
    $value = $paramStore->Get("cassadyTest");

    $_ENV[$key] = $value;

    echo $_ENV["CONNECTION_STRING"];
?>