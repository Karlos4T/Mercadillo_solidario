<?php
    $ips = array(
        '192.168.1.58',
        '192.168.1.113'
    );
    if (!in_array($_SERVER['REMOTE_ADDR'], $ips))
    {   
        $error = "No tienes permiso para acceder";
        header("Location: ../views/main.php");
    }
?>