<?php

// The first thing is always start the session
session_start();

// The most important file of the project
include '../../conexion.php';

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

// The first thing is always start the session
session_start();

// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);

// Call the stored procedure to insert the payment info
$login = oci_parse($conn, "begin LOGIN(:CM, :EMAIL, :PASSWORD); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary
oci_bind_by_name($login, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($login, ":EMAIL", $email, -1);
oci_bind_by_name($login, ":PASSWORD", $password, -1);

// Execute de stored procedure
oci_execute($login);
oci_execute($curs);

$row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS);

// $_SESSION['loggedUser'] = 1;
$_SESSION['idUsuario'] = $row['ID_USUARIO'];
$_SESSION['nombreUsuario'] = $row['NOMBRE'];
$_SESSION['apellidoUsuario'] = $row['APELLIDO1'];
$_SESSION['idRol'] = $row['ID_ROL'];

?>