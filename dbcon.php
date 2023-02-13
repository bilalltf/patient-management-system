<?php

$con = mysqli_connect("root","admin","Abc@123456789","patients");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

?>