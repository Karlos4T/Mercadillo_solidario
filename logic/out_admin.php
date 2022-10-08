<?php
    function logout_admin(){
        if (!$_SESSION)
            session_start();
        unset($_SESSION['user']);
        unset($_SESSION['password']);
        session_destroy();
    
        header("Location: ../views/main.php");
    }
?>