<?php
// Import header.php and conexion.php
include '../../conexion.php';

$idCarrito = $_GET['idCarrito'];
$cantidad = $_GET['cantidad'];

$updateCarrito= oci_parse($conn, "begin UPDATE_CARRITO($idCarrito, $cantidad); end;");

// Execute de stored procedure
oci_execute($updateCarrito);

?>