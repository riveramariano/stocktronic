<?php
// Import header.php and conexion.php
include '../conexion.php';

$idProducto = $_GET['ajaxid'];

$insertCarrito= oci_parse($conn, "begin INSERT_CARRITO(1, 1,  $idProducto); end;");

// Execute de stored procedure
oci_execute($insertCarrito);

?>