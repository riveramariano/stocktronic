<?php
function get_lowest_price($conn, $categoria)
{
    $curs = oci_new_cursor($conn);
    $query = oci_parse($conn, "begin GET_LOWEST_PRICE(:CM,:ID_CATEGORIA); end;");

    oci_bind_by_name($query, ":CM", $curs, -1, OCI_B_CURSOR);
    oci_bind_by_name($query, ":ID_CATEGORIA", $categoria, -1);

    oci_execute($query);
    oci_execute($curs);

    return $curs;
}
