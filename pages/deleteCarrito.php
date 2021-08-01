<?php
// Import header.php and conexion.php
include '../conexion.php';

$idCarrito = $_GET['idCarrito'];

$deleteCarrito= oci_parse($conn, "begin DELETE_CARRITO($idCarrito); end;");

// Execute de stored procedure
oci_execute($deleteCarrito);
 
?>