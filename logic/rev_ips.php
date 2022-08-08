<?php
    function rev_ips()
    {
        $ips = array(
            '192.168.1.58',
            '192.168.1.113',
            '192.168.1.108',
            '192.168.1.97',
            '192.168.1.54',
            '87.218.52.56',
            '127.0.0.1',
        );
    
        if (!in_array($_SERVER['REMOTE_ADDR'], $ips))
        {   
            $error = "No tienes permiso para acceder";
            $rt = false;
        }
        else
            $rt = true;
        return ($rt);
    }
?>