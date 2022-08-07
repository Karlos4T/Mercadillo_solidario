<?php

    if(!isset($_SESSION)){
        session_start();
    }

    $host = "localhost";
    $user = "u463589001_user";
    $clave = "Instituto-1990";
    $bd = "u463589001_books";

    $con = mysqli_connect($host, $user, $clave, $bd);
?>