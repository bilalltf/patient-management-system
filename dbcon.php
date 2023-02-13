<?php

$con = mysqli_connect("localhost","admin","Abc@123456789","patients");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

?>