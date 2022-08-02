<?php
    include 'hostconnect.php';

    if(isset($_POST['id']))
    {
        $query = "SELECT `res_ip` FROM `books`";
        $data = mysqli_query($con, $query);

        if ($data)
        {
            while ($row = mysqli_fetch_array($data))
            {
                if ($_SERVER['REMOTE_ADDR'] === $row['res_ip'])
                {
                    $ip = $row['res_ip'];
                    header('Location: ../views/main.php');
                }
            }
        }
        if (!$ip)
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $fechares = time();
            $ip = $_SERVER['REMOTE_ADDR'];
    
            $query = "SELECT `reserved` FROM `books` WHERE id = $id";
            $data = mysqli_query($con, $query);
    
            if($data)
            {
                while ($row = mysqli_fetch_array($data))
                {
                    if (!$row['reserved'])
                    {
                        $query = "UPDATE `books` SET `reserved` = 'reservado', `res_ip` = '$ip', `res_date` = '$fechares', `res_name` = '$name' WHERE id = $id";
                        $res = mysqli_query($con, $query);
                    
                        if($res)
                        {
                            header("Location: ../views/book.php?id=$id");
                        }
                    }
                }
            }
        }
    }
?>