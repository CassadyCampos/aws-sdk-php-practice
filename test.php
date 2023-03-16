<?php
    include_once("config.php");
    include_once("ISecretsManager.php");

    echo "'Test Hello World'\r\n\r";
    // $result = mysqli_query($mysqli, "SELECT * FROM contacts ORDER BY id DESC");

    $test = new AWSParameterStore();
    $res = $test->Get("cassadyTest");
    
    
    echo $res;
?>