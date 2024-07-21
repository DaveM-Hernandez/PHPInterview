<?php
$servername = "localhost";
$username = "root";
$database = "interview";
$con = new mysqli($servername,$username,'',$database);

if($con->connect_error){
    die("Conexion fallida: " . $con->connect_error);
}



