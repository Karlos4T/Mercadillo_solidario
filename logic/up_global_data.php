<?php
    include 'hostconnect.php';

    $query = "SELECT `id` FROM `books`";
    $data = mysqli_query($con, $query);
    $books = 0;

    while ($row = mysqli_fetch_array($data))
        $books++;

    $query = "SELECT `ip` FROM `ips`";
    $data = mysqli_query($con, $query);
    $visitas = 0;

    while ($row = mysqli_fetch_array($data))
        $visitas++;
    
    $query = "UPDATE `global_data` SET `num_books`='$books',`visitas`='$visitas' WHERE `id` = 1";
    $res = mysqli_query($con, $query);
?>