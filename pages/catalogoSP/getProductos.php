<?php

function get_products($conn, $categoria)
{
    $curs = oci_new_cursor($conn);

    $getProductos = oci_parse($conn, "begin GET_PRODUCTOS(:CM, :ID_CATEGORIA); end;");

    oci_bind_by_name($getProductos, ":CM", $curs, -1, OCI_B_CURSOR);
    oci_bind_by_name($getProductos, ":ID_CATEGORIA", $categoria, -1);

    oci_execute($getProductos);
    oci_execute($curs);

    return $curs;
}

function get_products_random($conn)
{
    $curs = oci_new_cursor($conn);
    $query = oci_parse($conn, "begin GET_PRODUCTS_RANDOM(:CM); end;");

    oci_bind_by_name($query, ":CM", $curs, -1, OCI_B_CURSOR);

    oci_execute($query);
    oci_execute($curs);

    return $curs;
}
