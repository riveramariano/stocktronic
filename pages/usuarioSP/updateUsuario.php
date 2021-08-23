<?php

// Import conexion.php to establish a connection with Oracle
include '../../conexion.php';

// Catch the values that comes from the AJAX params
$idUsuario = $_GET['id'];
$nombreUsuario = $_GET['nombre'];
$apellido1Usuario = $_GET['apellido1'];
$apellido2Usuario = $_GET['apellido2'];
$correoUsuario = $_GET['correo'];
$passwordUsuario = $_GET['passwrd'];
$tipoUsuario = $_GET['tipo'];

// Begin the stored procedure that inserts a product into the database
$updateUsuario = oci_parse($conn, "begin UPDATE_USUARIO(:ID, :NOMBRE, :APELLIDO1, :APELLIDO2, :CORREO, :PW, :TIPO ); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary when it's a variable
oci_bind_by_name($updateUsuario, ":ID", $idUsuario, -1);
oci_bind_by_name($updateUsuario, ":NOMBRE", $nombreUsuario, -1);
oci_bind_by_name($updateUsuario, ":APELLIDO1", $apellido1Usuario, -1);
oci_bind_by_name($updateUsuario, ":APELLIDO2", $apellido2Usuario, -1);
oci_bind_by_name($updateUsuario, ":CORREO", $correoUsuario, -1);
oci_bind_by_name($updateUsuario, ":PW", $passwordUsuario, -1);
oci_bind_by_name($updateUsuario, ":TIPO", $tipoUsuario, -1);

// Execute the stored procedure
oci_execute($updateUsuario);
