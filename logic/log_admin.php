<?php

    include 'hostconnect.php';

    if($_POST)
    {
        if($_POST['user'] === 'carlos' && $_POST['password'] === '1234')
        {            
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['time'] = time();
            if(!empty($_SESSION['user']) && !empty($_SESSION['password']))
            {
                header("Location: ../views/main.php");
            }
        }
        else
        {
            $error = "El usuario o la contraseña no coinciden";
            header("Location: ../views/login_admin.php");
        }
    }

?>