<?php
    if (!isset($_SESSION)){
        session_start();
    }

    $host = "localhost";
    $user = "root";
    $clave = "";
    $bd = "solidary_books";

    $con = mysqli_connect($host, $user, $clave, $bd);
?>