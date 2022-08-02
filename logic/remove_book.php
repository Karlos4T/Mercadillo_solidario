<?php
    include 'hostconnect.php';

    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        $query = "DELETE FROM `books` WHERE id = $id";
        
        $res = mysqli_query($con, $query);

        if($res)
        {
            header("Location: ../views/main.php");
        }
    }
?>