<?php

// Import conexion.php to establish a connection with Oracle
include '../../conexion.php';

// Catch the values that comes from the AJAX params
$nombreUsuario = $_GET['nombre'];
$apellido1Usuario = $_GET['apellido1'];
$apellido2Usuario = $_GET['apellido2'];
$correoUsuario = $_GET['correo'];
$passwordUsuario = $_GET['passwrd'];
$tipoUsuario = $_GET['tipo'];

// Begin the stored procedure that inserts a product into the database
$insertUsuario = oci_parse($conn, "begin INSERT_USUARIO(:NOMBRE, :APELLIDO1, :APELLIDO2, :CORREO, :PW, :TIPO ); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary when it's a variable
oci_bind_by_name($insertUsuario, ":NOMBRE", $nombreUsuario, -1);
oci_bind_by_name($insertUsuario, ":APELLIDO1", $apellido1Usuario, -1);
oci_bind_by_name($insertUsuario, ":APELLIDO2", $apellido2Usuario, -1);
oci_bind_by_name($insertUsuario, ":CORREO", $correoUsuario, -1);
oci_bind_by_name($insertUsuario, ":PW", $passwordUsuario, -1);
oci_bind_by_name($insertUsuario, ":TIPO", $tipoUsuario, -1);

// Execute the stored procedure
oci_execute($insertUsuario);
