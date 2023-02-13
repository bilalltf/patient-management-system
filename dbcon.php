<?php

$con = mysqli_connect("localhost","root","Abc@123456789","patients");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

?>