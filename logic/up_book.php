<?php
if(isset($_SESSION))
{
    
}
    include 'hostconnect.php';

    if(isset($_POST['name']) || isset($_POST['author']) || isset($_POST['desc']) || isset($_POST['price']) || isset($_POST['status']))
    {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        $photo = $_FILES['photo']['name'];
        $photo_mokup = $_FILES['photo_mokup']['name'];
        $category = $_POST['category'];

        $query = "SELECT `id`, `name` FROM `books` WHERE name = '$name'";
        $res = mysqli_query($con, $query);

        if($res)
        {
            if($name && $desc && $author && $status && $price && $category){
        
                $tamanoArchivo = $_FILES['photo']['size'];
                $tipoArchivo = $_FILES['photo']['type'];
                $imagenSubida = fopen($_FILES['photo']['tmp_name'], 'r');
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                $photo = mysqli_escape_string($con, $binariosImagen);
        
                $tamanoArchivo = $_FILES['photo_mokup']['size'];
                $tipoArchivo = $_FILES['photo_mokup']['type'];
                $imagenSubida = fopen($_FILES['photo_mokup']['tmp_name'], 'r');
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                $photo_mokup = mysqli_escape_string($con, $binariosImagen);
    
                $query = "INSERT INTO books (`name`, `desc`, `author`, `photo`, `photo_type`, `price`, `status`, `photo_mokup`, `category`) VALUES ('$name', '$desc', '$author', '$photo', '$tipoArchivo' ,'$price', '$status', '$photo_mokup', '$category')";
                $res = mysqli_query($con, $query);
                
                if($res)
                {
                    header('Location: ../views/main.php');
                }
            }
            else
            {
                echo "Hay algún campo incompleto";
            }    
        }
        else
        {
            echo "Este libro ya está en la base de datos";
            header("Location: ../views/form.php");
        }

        
    }


?>