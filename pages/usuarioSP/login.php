<?php
// The first thing is always start the session
session_start();

// The most important file of the project
include '../../conexion.php';

// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);

$emailLogin = $_GET['emailLogin'];
$passwordLogin = $_GET['passwordLogin']; 

// Call the stored procedure to insert the payment info
$login = oci_parse($conn, "begin LOGIN(:CM, :EMAIL, :PASSWORD); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary
oci_bind_by_name($login, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($login, ":EMAIL", $emailLogin, -1);
oci_bind_by_name($login, ":PASSWORD", $passwordLogin, -1);

// Execute de stored procedure
oci_execute($login);
oci_execute($curs);

$row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS);

// $_SESSION['loggedUser'] = 1;
$_SESSION['idUsuario'] = $row['ID_USUARIO'];
$_SESSION['nombreUsuario'] = $row['NOMBRE'];
$_SESSION['apellidoUsuario'] = $row['APELLIDO1'];
$_SESSION['idRol'] = $row['ID_ROL'];