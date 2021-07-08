<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Simple Sidebar - Start Bootstrap Template</title>
    <link href="images/isotipo.svg" type="image" rel="shortcut icon" />
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="styles/simple-sidebar.css" rel="stylesheet" />
    <link href="styles/navbar.css" rel="stylesheet" />
    <link href="styles/index.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet" />
</head>

<?php
include 'components/header.php';
include 'conexion.php';

$curs = oci_new_cursor($conn);
$sp = oci_parse($conn, "begin GET_PRODUCTOS(:CM, 1); end;");
oci_bind_by_name($sp, ":CM", $curs, -1, OCI_B_CURSOR);

oci_execute($sp);
oci_execute($curs);
?>

<table class="table col-10 ml-5 mt-5">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descipcion</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
            $id = $row['ID_PRODUCTO'];
            $nombre = $row['NOMBRE'];
            $descripcion = $row['DESCRIPCION'];
            $precio = $row['PRECIO'];
            $cantidad = $row['CANTIDAD'];
            echo "<tr>
                    <th scope='row'>$id</th>
                    <td>$nombre</td>
                    <td>$descripcion</td>
                    <td>$precio</td>
                    <td>$cantidad</td>
                </tr>";
        }
        ?>
    </tbody>
</table>

<?php
oci_free_statement($sp);
oci_free_statement($curs);

oci_close($conn);
?>