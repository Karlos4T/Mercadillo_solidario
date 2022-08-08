<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_log</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/login_admin.css">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@300&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/19283c162a.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php
        include '../logic/log_admin.php'; 
        include '../logic/rev_ips.php';
        if($_SESSION || !rev_ips())
            header("Location: ../views/");
    ?>
    <nav class="navbar navbar-expand-lg bg-dark mb-5">
        <div class="container-fluid d-flex justify-content-md-between justify-content-center">
            <a href="../views/">    
                <img src="../public/imgs/Logo_sin_fondo.png" class="logo" alt="">
            </a>  
        </div>
    </nav>
    <div class="container-fluid">
        <div class="container d-flex justify-content-center">
            <div class="card mt-5 bg-dark">
                <form action="../logic/log_admin.php" method="POST" class="p-2 px-3">
                    <p class="h4 text-center text-light my-3">Admin Login</p>
                    <div>
                        <input type="text" maxlenght="25" name="user" required class="form-control mt-3" placeholder="Usuario">
                        <input type="password" maxlength="25" name="password" required class="form-control mt-3" placeholder="Contraseña">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-outline-success mt-4" value="Entrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>