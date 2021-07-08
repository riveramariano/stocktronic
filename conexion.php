<?php

$username = 'test';
$password = 'test';
$dbname = 'localhost/orcl';

$conn = oci_connect($username, $password, $dbname, 'AL32UTF8') or die(oci_error());

?>