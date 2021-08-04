<?php

// Import conexion.php to establish a connection with Oracle
include '../../conexion.php';

// Get the id that comes from the AJAX params
$idCarrito = $_GET['idCarrito'];

// Begin the stored proceduure to delete an item from the cart
$deleteCarrito= oci_parse($conn, "begin DELETE_CARRITO($idCarrito); end;");

// Execute the stored procedure
oci_execute($deleteCarrito);
 
?>