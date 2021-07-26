<?php
// Import header.php and conexion.php
include '../conexion.php';

session_start();
$idUsuario = $_SESSION['idUsuario'];

$idProducto = $_GET['ajaxid'];

$insertCarrito= oci_parse($conn, "begin INSERT_CARRITO(1, :ID_USUARIO,  $idProducto); end;");
oci_bind_by_name($insertCarrito, ":ID_USUARIO", $idUsuario, -1);

// Execute de stored procedure
oci_execute($insertCarrito); 

?>