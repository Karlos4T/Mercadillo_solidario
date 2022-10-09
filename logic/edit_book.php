<?php
    include 'hostconnect.php';

    if (isset($_POST['id']))
    {
        $id = $_POST['id'];
        $name = htmlspecialchars($_POST['name']);
        $desc = htmlspecialchars($_POST['desc']);
        $author = htmlspecialchars($_POST['author']);
        $price = $_POST['price'];
        $status = $_POST['status'];
        $photo = $_FILES['photo']['name'];
        $photo_mokup = $_FILES['photo_mokup']['name'];
        $category = $_POST['category'];
    
        echo $id, " " ,$name, " " ,$desc, " " ,$author, " " ,$price, " " ,$status, " " ,$category;

        $query = "UPDATE `books` SET `name`='$name',`desc`='$desc', `author`='$author',`price`='$price',`status`='$status', `category`='$category' WHERE id = $id";
        $res = mysqli_query($con, $query);

        if ($res)
        {
            if (!empty($photo))
            {
                $tamanoArchivo = $_FILES['photo']['size'];
                $tipoArchivo = $_FILES['photo']['type'];
                $imagenSubida = fopen($_FILES['photo']['tmp_name'], 'r');
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                $photo = mysqli_escape_string($con, $binariosImagen);

                $query = "UPDATE `books` SET `photo`='$photo', `photo_type`='$tipoArchivo' WHERE id = $id";
                $res = mysqli_query($con, $query);
            }
            if (!empty($photo_mokup))
            {
                $tamanoArchivo = $_FILES['photo_mokup']['size'];
                $tipoArchivo = $_FILES['photo_mokup']['type'];
                $imagenSubida = fopen($_FILES['photo_mokup']['tmp_name'], 'r');
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                $photo_mokup = mysqli_escape_string($con, $binariosImagen);

                $query = "UPDATE `books` SET `photo_mokup` = '$photo_mokup' WHERE id = $id";
                $res = mysqli_query($con, $query);
                
            }
            header("Location: ../views/book.php?id=$id");
        }
    }
    else
    {
        echo "No recibe id";
    }
    
?>