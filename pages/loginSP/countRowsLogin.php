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
    echo 'Email o contraseña no validos';
}

// $rownum = oci_num_rows($login); // Returns 1 if user exists

// var_dump($row);
// $_SESSION['loggedUser'] = 1;
// $_SESSION['idUsuario'] = $row['ID_USUARIO'];
// $_SESSION['nombreUsuario'] = $row['NOMBRE'];
// $_SESSION['apellidoUsuario'] = $row['APELLIDO1'];
// $_SESSION['idRol'] = $row['ID_ROL'];

// header('Location: pages/inicio.php ');
