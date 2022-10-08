<?php

    include 'hostconnect.php';

    if($_POST)
    {
        $user = htmlspecialchars($_POST['user']);
        $password = htmlspecialchars($_POST['password']);
        if($user === 'carlos' && $password === '1234')
        {
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['time'] = time();
            if(!empty($_SESSION['user']) && !empty($_SESSION['password']))
                header("Location: ../views/main.php");
        }
        else
        {
            $error = "El usuario o la contraseña no coinciden";
            header("Location: ../views/login_admin.php");
        }
    }
?>
