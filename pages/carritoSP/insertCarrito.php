<?php

// Import conexion.php to establish a connection with Oracle
include '../../conexion.php';

// Start the session to get the id of the user that logged into the system
session_start();
$idUsuario = $_SESSION['idUsuario'];

// Get the id that comes from the AJAX params
$idProducto = $_GET['ajaxid'];

// Begin the stored procedure that inserts an item into the user cart
$insertCarrito= oci_parse($conn, "begin INSERT_CARRITO(1, :ID_USUARIO,  $idProducto); end;");

// When calling a stored procedure you will need to bind the params like this if the're inside variables
oci_bind_by_name($insertCarrito, ":ID_USUARIO", $idUsuario, -1);

// Execute the stored procedure
oci_execute($insertCarrito); 

?>