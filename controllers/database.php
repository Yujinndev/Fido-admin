<?php
    session_start();

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "fidoapp";

    $con = new mysqli($host, $username, $password, $database);

    if ($con->connect_error) {
        die ($con->connect_error);
    }

    return $con;
?> 