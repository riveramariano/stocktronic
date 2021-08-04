<?php

// Import conexion.php to establish a connection with Oracle
include '../../conexion.php';

// Catch the values that comes from the AJAX params
$nombreProducto = $_GET['nombre'];
$descProducto = $_GET['desc'];
$urlProducto = $_GET['url'];
$precioProducto = $_GET['precio'];
$cantProducto = $_GET['cant'];
$proveedorProducto = $_GET['idProveedor'];
$categoriaProducto = $_GET['idCategoria'];

// Begin the stored procedure that inserts a product into the database
$insertProducto = oci_parse($conn, "begin INSERT_PRODUCTO(:NOMBRE, :DESC, :URL_IMG, :PRECIO, :CANTIDAD, :ID_PROVEEDOR, :ID_CATEGORIA); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary when it's a variable
oci_bind_by_name($insertProducto, ":NOMBRE", $nombreProducto, -1);
oci_bind_by_name($insertProducto, ":DESC", $descProducto, -1);
oci_bind_by_name($insertProducto, ":URL_IMG", $urlProducto, -1);
oci_bind_by_name($insertProducto, ":PRECIO", $precioProducto, -1);
oci_bind_by_name($insertProducto, ":CANTIDAD", $cantProducto, -1);
oci_bind_by_name($insertProducto, ":ID_PROVEEDOR", $proveedorProducto, -1);
oci_bind_by_name($insertProducto, ":ID_CATEGORIA", $categoriaProducto, -1);

// Execute the stored procedure
oci_execute($insertProducto);

?>