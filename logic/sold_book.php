<?php
    include 'hostconnect.php';

    $id = $_POST['id'];
    $query = "SELECT `price` FROM `books` WHERE `id` = '$id'";
    $data = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($data))
        $price = $row['price'];

    $query = "SELECT `sold_books`, dinero_recaudado FROM `global_data` WHERE `id` = 1";
    $data = mysqli_query($con, $query);
    $dinero_recaudado;

    while ($row = mysqli_fetch_array($data))
    {
        $sold_books = $row['sold_books'] + 1;
        $dinero_recaudado = $row['dinero_recaudado'] + $price;
    }

    $query = "UPDATE `global_data` SET `sold_books`='$sold_books', `dinero_recaudado`='$dinero_recaudado' WHERE `id` = 1";
    $res =  mysqli_query($con, $query);
    
    if ($res)
        header("Location: ../logic/remove_book.php?id=$id");    
?>