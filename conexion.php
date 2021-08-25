<?php

// Declare connection variables, Note: We'll need to change the username & password to = st
$username = 'st';
$password = 'st';
$dbname = 'localhost/orcl';

// Initialize the connection with Oracle
$conn = oci_connect($username, $password, $dbname, 'AL32UTF8') or die(oci_error());

