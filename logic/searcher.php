<?php
    include 'hostconnect.php';

    if (isset($_GET))
    {
        $query = "SELECT `id`, `name`, `desc`, `photo`, `photo_type`, `author`, `price`, `status`, `photo_mokup`, `reserved`, `category` 
        FROM `books` WHERE `name` LIKE '%$searcher%'";
        $res = mysqli_query($con, $query);

        if ($res)
        {
            
        }
    }

?>