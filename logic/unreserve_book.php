<?php
    include 'hostconnect.php';

    if(isset($_POST['id']) || isset($_GET['id']))
    {
        if (isset($_POST['id']))
            $id = $_POST['id'];
        else if (isset($_GET['id']))
            $id = $_GET['id'];

        echo $id;
        $query = "UPDATE `books` SET `reserved` = '', `res_ip` = '', `res_date` = 0, `res_name` = '' WHERE id = $id";
        $res = mysqli_query($con, $query);
    
        if($res)
        {
            if ($id)
                header("Location: $_SERVER[HTTP_REFERER]");
        }
    }
?>