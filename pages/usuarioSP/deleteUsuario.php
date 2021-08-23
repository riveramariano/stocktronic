<?php

include '../../conexion.php';

$idUsuario = $_GET['idUsuario'];
$deleteUsuario = oci_parse($conn, "begin DELETE_USUARIO(:ID); end;");

oci_bind_by_name($deleteUsuario, ":ID", $idUsuario, -1);

oci_execute($deleteUsuario);
