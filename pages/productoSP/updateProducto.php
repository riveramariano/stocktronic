<?php

// Import conexion.php to establish a connection with Oracle
include '../../conexion.php';

// Catch the values that comes from the AJAX params
$idProducto = $_GET['id'];
$nombreProducto = $_GET['nombre'];
$descProducto = $_GET['desc'];
$urlProducto = $_GET['url'];
$precioProducto = $_GET['precio'];
$cantProducto = $_GET['cant'];
$proveedorProducto = $_GET['idProveedor'];
$categoriaProducto = $_GET['idCategoria'];

// Begin the stored procedure that updates a product
$updateProducto = oci_parse($conn, "begin UPDATE_PRODUCTO(:ID, :NOMBRE, :DESC, :URL_IMG, :PRECIO, :CANTIDAD, :ID_PROVEEDOR, :ID_CATEGORIA); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary when it's a variable
oci_bind_by_name($updateProducto, ":ID", $idProducto, -1);
oci_bind_by_name($updateProducto, ":NOMBRE", $nombreProducto, -1);
oci_bind_by_name($updateProducto, ":DESC", $descProducto, -1);
oci_bind_by_name($updateProducto, ":URL_IMG", $urlProducto, -1);
oci_bind_by_name($updateProducto, ":PRECIO", $precioProducto, -1);
oci_bind_by_name($updateProducto, ":CANTIDAD", $cantProducto, -1);
oci_bind_by_name($updateProducto, ":ID_PROVEEDOR", $proveedorProducto, -1);
oci_bind_by_name($updateProducto, ":ID_CATEGORIA", $categoriaProducto, -1);

// Execute the stored procedure
oci_execute($updateProducto);

?>