<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I.E.S P.Negras Libros solidarios</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/form-s.css">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@300&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/19283c162a.js" crossorigin="anonymous"></script>
    

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark mb-5">
        <div class="container-fluid">
            <a href="../views/">
                <img src="../public/imgs/Logo_sin_fondo.png" class="logo mx-3" style="width: 130px;" alt="">
            </a>    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <?php
        include '../logic/hostconnect.php';
        include '../logic/rev_ips.php';

        
        if (isset($_POST['id']))
        {
            $id = $_POST['id'];

            $query = "SELECT `id`, `name`, `desc`, `photo`, `photo_type`, `author`, `price`, `status`, `photo_mokup`, `reserved`, `category` FROM `books` WHERE id = '$id'";
            $res = mysqli_query($con, $query);

            if ($res)
            {
                while ($row = mysqli_fetch_array($res))
                {          
    ?>
    <form action="../logic/edit_book.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <p class="h4 text-center">Sube tu libro!</p>

        <div class="container px-5">

                <div class="row d-flex justify-content-between mx-md-5">

                    <div class="col-12 col-md-6 p-0">
                        <input class="col-12 p-2 mt-3" type="text" name="name" placeholder="Nombre" value="<?php echo $row['name']?>">
                        <input class="col-12 p-2 my-3" type="text" name="author" placeholder="Autor" value="<?php echo $row['author']?>">
                    </div>
                    <div class="col-12 col-md-6 p-0">
                        <div class="form-group col-12 my-auto p-2 mt-2">

                            <select id="inputState" class="form-select p-2 col-12" name="status" >
                                <option selected><?php echo $row['status']?></option>
                                <option>Nuevo</option>
                                <option>Aceptable</option>
                                <option>Aún se puede leer</option>
                                <option>Reventao</option>

                            </select>

                        </div>
                        <div class="form-group col-12 my-auto p-2">

                            <select id="inputState" class="form-select p-2 col-12" name="category" >

                                <option selected><?php echo $row['category']?></option>
                                <option>Novela</option>
                                <option>Didáctico</option>
                                <option>Guía</option>

                            </select>

                        </div>
                    </div> 
                        
                        
                </div>

                <div class="row d-flex justify-content-between mx-md-5">

                    <textarea class="w-100 my-2 p-2" id="" cols="30" name="desc" placeholder="Descripción" rows="10"><?php echo $row['desc']?></textarea>

                </div>

                <div class="row d-flex justify-content-between mx-md-5 mt-3 w-auto">

                    <div class="file-select w-auto p-0" id="src-file1" >

                        <button type="button" class="btn-warning btn-photo w-100 mb-2">
                            
                            <div class="text d-flex justify-content-between w-100">
                                <p class="h6">Foto inicial</p>
                                <i class="fas fa-camera mx-2 mt-1"></i>
                            </div>
                            <input class="col-12 h-100 p-auto" type="file" name="photo" aria-label="Archivo">

                        </button>

                        <button type="button" class="btn-warning btn-photo">
                            
                            <div class="text d-flex justify-content-between w-100">
                                <p class="h6">Foto presentación</p>
                                <i class="fas fa-camera mx-2 mt-1"></i>
                            </div>
                            <input class="col-12 h-100 p-auto" type="file" name="photo_mokup" aria-label="Archivo">

                        </button>

                    </div>

                    <input class="p-2 px-3 my-auto col-4 col-md-2 d-flex justify-content-between" type="number" name="price" placeholder="precio" value="<?php echo $row['price']?>"> 

                </div>

                <div class="row d-flex justify-content-md-end justify-content-between mx-md-5 mb-5 mt-4">

                    <a class="btn btn-secondary col-4 col-md-2 col-lg-1 mx-md-3" href="../views/" name="cancel" placeholder="Cancelar" id="">Cancel</a>
                    <input class="btn btn-success col-4 col-md-2 col-lg-1" type="submit" name="submit" placeholder="Aceptar" id="">

                </div>

        </div>

    </form>
    <?php
            }
        }
    }
    ?>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>

