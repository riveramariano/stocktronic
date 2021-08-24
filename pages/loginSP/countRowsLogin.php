<?php

// Import conexion.php to establish a connection with Oracle
include '../../conexion.php';

// Catch the values that comes from the AJAX params
$emailLogin = $_GET['p_email'];
$emailPassword = $_GET['p_passwrd'];

$curs = oci_new_cursor($conn);

$login = oci_parse($conn, "begin LOGIN(:CM, :email, :passwrd); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary when it's a variable
oci_bind_by_name($login, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($login, ":email", $emailLogin, 32);
oci_bind_by_name($login, ":passwrd", $emailPassword, 32);

// Execute the stored procedure
oci_execute($login);
oci_execute($curs);

$row = oci_fetch_row($curs); // Returns array if user exists 
 
if ($row  == false) {
    echo 'Correo electrónico o contraseña no validos';
}
