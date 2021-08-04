<?php

// Import conexion.php to establish a connection with Oracle
include '../../conexion.php';

// Get the id and the quantity that comes from the AJAX params
$idCarrito = $_GET['idCarrito'];
$cantidad = $_GET['cantidad'];

// Begin the stored procedure that updates the quantity of an item in the user cart
$updateCarrito= oci_parse($conn, "begin UPDATE_CARRITO($idCarrito, $cantidad); end;");

// Execute de stored procedure
oci_execute($updateCarrito);

?>