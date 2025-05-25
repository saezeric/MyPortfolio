<?php
$host = "mysql-projecto0saezeric.alwaysdata.net";
$dbname = "projecto0saezeric_proyectoextrauf3";
$username = "394058";
$password = "APIRetal3618.";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Error de conexion: " . $mysqli->connect_error);
}
