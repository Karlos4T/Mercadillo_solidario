<?php
    function rev_ips()
    {
        $ips = array(
            '127.0.0.1',
            '192.168.56.23',
            '192.168.56.54',
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