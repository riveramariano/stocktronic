<?php

// Import conexion.php to establish a connection with Oracle
include '../../conexion.php';

// Get the id that comes from the AJAX params
$idProducto = $_GET['idProducto'];

// Begin the stored procedure that deletes a product from the database
$deleteProducto = oci_parse($conn, "begin DELETE_PRODUCTO(:ID); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary when it's a variable
oci_bind_by_name($deleteProducto, ":ID", $idProducto, -1);

// Execute the stored procedure
oci_execute($deleteProducto);

?>