<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadillo solidario IES P.Negras</title>

    <!--Icono-->
    <link rel="shortcut icon" href="../public/imgs/Logo_sin_fondo.png" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/book.css">

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
            <div class="w-25">
                <a href="../views/" class="d-inline-flex rounded rounded-5 return p-3 text-light text-start text-sm-start" style="text-decoration: none;">
                    <i class="fas fa-arrow-left"></i>
                </a> 
            </div>
            <div class="d-flex flex-column w-auto align-items-center m-sm-0">
                <img src="../public/imgs/Logo_sin_fondo.png" class="logo d-flex p-2" alt="">
            </div>   
            <?php
                include '../logic/hostconnect.php';
                include '../logic/rev_ips.php';

                if (isset($_POST['id']))
                    $id = $_POST['id'];
                else if (isset($_GET['id']))
                    $id = $_GET['id'];
                if ($_SESSION)
                {?>
                    <div class="dropstart d-flex justify-content-end w-25">
                        <button class="btn btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Editar
                        </button>
                        <ul class="dropdown-menu dropdown-menu-light">
                            <li>
                                <a class="dropdown-item p-0" href="#">
                                    <form action="../views/edit_form.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $id?>">
                                        <input type="submit" class="w-100 bg-transparent m-0 border-0 text-start mx-2" value="Editar">
                                    </form>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item p-0" href="#">
                                    <form action="../views/form.php" method="POST">
                                        <input type="submit" class="w-100 bg-transparent m-0 border-0 text-start mx-2" value="Añadir libro">
                                    </form>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item p-0" href="#">
                                    <form action="../logic/unreserve_book.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                        <input type="submit" class="w-100 bg-transparent m-0 border-0 text-start mx-2" value="Anular reserva">
                                    </form>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item p-0" href="#">
                                    <form action="../logic/sold_book.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                        <button type="submit" class="w-100 bg-transparent m-0 border-0 text-start text-success mx-2"><b>Libro vendido</b></button>
                                    </form>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="#">
                                    <b>Eliminar libro</b>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php
                }
                else if (!$_SESSION && rev_ips())
                {
                    ?>
                        <div class="w-25 d-flex justify-content-end">
                            <a href="../views/login_admin.php" class="btn btn-outline-light">Login as admin</a>
                        </div>
                    <?php
                }
               ?>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div>
                    <?php
                        $query = "SELECT `id`, `name`, `desc`, `photo`, `photo_type`, `author`, `price`, `status`, `photo_mokup`, `reserved`, `res_date`, `res_ip`, `res_name` ,`category` FROM `books` WHERE id = $id";
                        $data = mysqli_query($con, $query); 
                        
                        if($data)
                        {
                            while($row = mysqli_fetch_array($data))
                            {
                                if (isset($row['res_date']))
                                {
                                    if ($row['res_date'] > 0 && (time() - $row['res_date']) > (3600 * 24 * 7))
                                    {
                                        header("Location: ../logic/unreserve_book.php?id=$id");
                                    }
                                }
                                $id = $row['id'];
                            ?>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <img src="data:<?php $row['photo_type']; ?>;base64,<?php 
                                        if($row['photo_mokup'])
                                            echo base64_encode($row['photo_mokup']);
                                        else
                                            echo base64_encode($row['photo']);
                                        ?>"
                                        class="card-img p-3 rounded-5" alt="..."> </a>
                                    </div>
                                    <div class="col-md-6 col-12 text-center d-flex flex-column justify-content-between h-auto">
                                        <div>
                                            <p class="h1 mt-3"><b><?php echo $row['name']?></b></p>
                                            <div class="col-12 justify-content-center w-100">
                                                <p class="h6 mt-3 text-secondary mb-5"><b><?php echo $row['author']?></b></p>
                                                <p class="h6 m-3 px-5"><?php echo $row['desc']?></p>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-auto">
                                            <div class="d-flex justify-content-between mb-4">
                                                <div>
                                                    <p class="h6 m-2 px-5 text-start"><?php echo "Categoría: "; echo $row['category'];?></p>
                                                    <p class="h6 m-2 px-5 text-start"><?php echo "Estado: "; echo $row['status'];?></p>
                                                </div>
                                                <p class="h3 m-2 px-5"><b><?php echo $row['price'];?>€</b></p>
                                            </div>
                                            <!-- Button trigger modal -->
                                            <?php
                                                if ($_SESSION && $row['reserved'])
                                                {
                                                    if ((time() - $row['res_date']) < 60)
                                                    {
                                                        $time = time() - $row['res_date'];
                                                        if ($time == 1)
                                                            $u = 'segundo';
                                                        else
                                                            $u = 'segundos';
                                                    }
                                                    else if((time() - $row['res_date']) > 60 && (time() - $row['res_date']) < 3600)
                                                    {
                                                        $time = intdiv((time() - $row['res_date']), 60);
                                                        if ($time == 1)
                                                            $u = 'minuto';
                                                        else
                                                            $u = 'minutos';
                                                    }
                                                    else if ((time() - $row['res_date']) > 3600 && (time() - $row['res_date']) < (3600 * 24))
                                                    {
                                                        $time = intdiv((time() - $row['res_date']), (3600));
                                                        if ($time == 1)
                                                            $u = 'hora';
                                                        else
                                                            $u = 'horas';
                                                    }
                                                    else if ((time() - $row['res_date']) > (3600 * 24))
                                                    {
                                                        $time = intdiv((time() - $row['res_date']), (3600 * 24));
                                                        if ($time == 1)
                                                            $u = 'día';
                                                        else
                                                            $u = 'días';
                                                    }

                                                    ?>
                                                        <button type="button" class="btn btn-rsv disabled w-75 mb-4">
                                                            <b>Reservado por <?php echo $row['res_name'];?> hace  <?php echo $time, " " ,$u;?></b>
                                                        </button>
                                                    <?php
                                                }
                                                else if ($_SERVER['REMOTE_ADDR'] === $row['res_ip'])
                                                {
                                                    ?>
                                                        <button type="button" class="btn btn_btn btn-primary w-75 border-light mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                            <b>Cancelar Reserva</b>
                                                        </button>
                                                    <?php
                                                }
                                                else if ($row['reserved'])
                                                {
                                                    ?>
                                                        <button type="disabled" class="btn btn-rsv disabled w-75 mb-4">
                                                            <b>Libro reservado</b>
                                                        </button>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                        <button type="button" class="btn btn_btn btn-primary w-75 border-light mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                                            <b>Reserva el libro</b>
                                                        </button>
                                                    <?php
                                                }
                                            ?>
                                            
                                        </div>
                                        <!-- Modal Reserve book -->
                                      
                                        <form action="../logic/reserve_book.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $id?>">
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Reserva este libro</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Tu libro se reservará automáticamente durante <b> 7 días.</b> Pasado este plazo, el libro volverá a estar disponible.</label>
                                                            <p for="recipient-name" class="col-form-label text-danger"><b>Solo podrás reservar 1 libro cada 7 días.</b></p>

                                                        </div>
                                                        <div class="mb-3 text-start">
                                                           
                                                            <div class="input-group flex-nowrap">
                                                                <input type="text" required class="form-control" placeholder="Nombre y apellidos" name="name" aria-describedby="addon-wrapping">
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"  class="btn btn-secondary border-light" data-bs-dismiss="modal">Cancelar</button>
                                                        <input type="submit" class="btn btn_btn btn-primary border-light" value="Reservar">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <!-- Modal Unreserve book -->
                                      
                                        <form action="../logic/remove_book.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $id?>">
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿El libro <b> <?php echo $row['name']?> se eliminará de la base de datos permanentemente </b>? 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary border-light" data-bs-dismiss="modal">Volver</button>
                                                        <input type="submit" class="btn btn-danger border-light" value="Eliminar">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php 
                            }
                        }
                        else
                        {
                            echo "Error";
                        }
                    ?>
                    
                    <!-- Modal RM book -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">¿Seguro que deseas eliminarlo?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <div class="modal-body">
                                El libro se eliminará de la vase de datos de manera definitiva.
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                                    <form action="../logic/remove_book.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $id?>">
                                        <input type="submit" class="btn btn-danger" value="Eliminar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
</body>
</html>