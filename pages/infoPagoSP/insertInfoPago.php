<?php

// The first thing is always start the session
session_start();

// Get the user id from the session
$idUsuario = $_SESSION['idUsuario'];

// The most important file of the project
include '../../conexion.php';

$numeroTarjeta = strval($_GET['numTarjeta']);
$direccion1 = strval($_GET['dir1']);
$direccion2 = strval($_GET['dir2']);
$telefono = strval($_GET['telefono']);
$total = strval($_SESSION['total']);
$metodoPago = strval($_GET['metodoPago']); 

// Call the stored procedure to insert the payment info
$insertInfoPago = oci_parse($conn, "begin INSERT_INFOPAGO(:NUM_TARJETA, :DIR_FACTURACION, :DIR_FACTURACION2, :TELEFONO, :TOTAL, :ID_USUARIO, :ID_METODOPAGO); end;");

// Bind the parameters into the stored procedure, this is strictly neccesary
oci_bind_by_name($insertInfoPago, ":NUM_TARJETA", $numeroTarjeta, -1);
oci_bind_by_name($insertInfoPago, ":DIR_FACTURACION", $direccion1, -1);
oci_bind_by_name($insertInfoPago, ":DIR_FACTURACION2", $direccion2, -1);
oci_bind_by_name($insertInfoPago, ":TELEFONO", $telefono, -1);
oci_bind_by_name($insertInfoPago, ":TOTAL", $total, -1);
oci_bind_by_name($insertInfoPago, ":ID_USUARIO", $idUsuario, -1);
oci_bind_by_name($insertInfoPago, ":ID_METODOPAGO", $metodoPago, -1);

// Execute de stored procedure
oci_execute($insertInfoPago);

?>