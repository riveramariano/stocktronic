<?php
// Import header.php and conexion.php
include '../conexion.php';

$idProducto = $_GET['id'];
$nombreProducto = $_GET['nombre'];
$descProducto = $_GET['desc'];
$urlProducto = $_GET['url'];
$precioProducto = $_GET['precio'];
$cantProducto = $_GET['cant'];
$proveedorProducto = $_GET['proveedor'];
$categoriaProducto = $_GET['categoria'];

// Call the stored procedure to insert
$updateProducto = oci_parse($conn, "begin UPDATE_PRODUCTO(:ID, :NOMBRE, :DESC, :URL, :PRECIO, :CANTIDAD, :PROVEEDOR, :CATEGORIA); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary
oci_bind_by_name($updateProducto, ":ID", $idProducto, -1);
oci_bind_by_name($updateProducto, ":NOMBRE", $nombreProducto, -1);
oci_bind_by_name($updateProducto, ":DESC", $descProducto, -1);
oci_bind_by_name($updateProducto, ":URL", $urlProducto, -1);
oci_bind_by_name($updateProducto, ":PRECIO", $precioProducto, -1);
oci_bind_by_name($updateProducto, ":CANTIDAD", $cantProducto, -1);
oci_bind_by_name($updateProducto, ":PROVEEDOR", $proveedorProducto, -1);
oci_bind_by_name($updateProducto, ":CATEGORIA", $categoriaProducto, -1);

// Execute de stored procedure
oci_execute($updateProducto);

// Redirect to "confirmacion.php" after the insert is accomplished
header('Location: tablaProductos.php');
