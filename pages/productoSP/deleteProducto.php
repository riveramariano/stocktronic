<?php
// Import header.php and conexion.php
include '../../conexion.php';

$idProducto = $_GET['idProducto'];

$deleteProducto = oci_parse($conn, "begin DELETE_PRODUCTO(:ID); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary
oci_bind_by_name($deleteProducto, ":ID", $idProducto, -1);

// Execute de stored procedure
oci_execute($deleteProducto);

?>