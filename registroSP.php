<?php

// The first thing is always start the session
session_start();

// The most important file of the project
include 'conexion.php';

$nombre = $_GET['nombre'];
$primerApellido = $_GET['primerApellido'];
$segundoApellido = $_GET['segundoApellido'];
$email = $_GET['email'];
$password = $_GET['password'];

// Call the stored procedure to insert the payment info
$registro = oci_parse($conn, "begin REGISTRO(:NOMBRE, :APELLIDO1, :APELLIDO2, :EMAIL, :PASSWORD); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary
oci_bind_by_name($registro, ":NOMBRE", $nombre, -1);
oci_bind_by_name($registro, ":APELLIDO1", $primerApellido, -1);
oci_bind_by_name($registro, ":APELLIDO2", $segundoApellido, -1);
oci_bind_by_name($registro, ":EMAIL", $email, -1);
oci_bind_by_name($registro, ":PASSWORD", $password, -1);

// Execute de stored procedure
oci_execute($registro);

?>