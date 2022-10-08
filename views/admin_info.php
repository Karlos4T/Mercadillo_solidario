<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadillo solidario admin info</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <!--FONT AWESOME-->
    <script src="https://kit.fontawesome.com/19283c162a.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/animations.css">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@300&family=Roboto:wght@700&display=swap" rel="stylesheet">

</head>
<body>
    <!--START MENU-->
    <nav class="navbar navbar-expand-lg bg-dark d-flex flex-column">
        <div class="container-fluid w-100">
            <div class="w-25 d-flex justify-content-start">
                <div class="w-25">
                    <a href="../views/" class="d-inline-flex rounded rounded-5 return p-3 text-light text-start text-sm-start" style="text-decoration: none;">
                        <i class="fas fa-arrow-left"></i>
                    </a> 
                </div>
            </div>
            <div class="d-flex flex-column w-auto align-items-center py-2 m-sm-0">
                <img src="../public/imgs/Logo_sin_fondo.png" class="logo d-flex" alt="">
            </div>
        </div>
    </nav>
	<!--CLOSE MENU-->
    <div class="container-fluid bg-light">
        <div class="container">
            <?php
                include '../logic/log_admin.php';
                include '../logic/rev_ips.php';

                if ($_SESSION && rev_ips())
                {
                    $query = "SELECT `id`, `num_books`, `sold_books`, `dinero_recaudado`, `visitas` FROM `global_data` WHERE `id` = 1";
                    $data = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_array($data))
                    {
                        ?>
                            <div class="row w-100 d-flex justify-content-center py-4">
                                <div class="col-sm-12 col-lg-2 col-md-6 text-light mx-5 my-2" style="background-color: #16a094fe; border-radius: 20px;">
                                    <div class="icon-container w-100 justify-content-center d-flex">
                                        <i class="fas fa-book p-4" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <div class="d-flex w-100 justify-content-center text-center p-4">
                                        <b>
                                            <?php echo $row['num_books'], " libros en stock"?>
                                        </b>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-2 col-md-6 text-light mx-5 my-2" style="background-color: #16a094fe; border-radius: 20px;">
                                    <div class="icon-container w-100 justify-content-center d-flex">
                                        <i class="fas fa-coins p-4" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <div class="d-flex w-100 justify-content-center text-center p-4">
                                        <b>
                                            <?php echo $row['dinero_recaudado'], "€ recaudados"?>
                                        </b>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-2 col-md-6 text-light mx-5 my-2" style="background-color: #16a094fe; border-radius: 20px;">
                                    <div class="icon-container w-100 justify-content-center d-flex">
                                        <i class="fas fa-user p-4" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <div class="d-flex w-100 justify-content-center text-center p-4">
                                        <b>
                                            <?php echo $row['visitas'], " personas han visto la web"?>
                                        </b>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                    <div class="row">
                        <table class="table border border-gray table-striped table-dark">
                            <thead class="thead-dark">
                                <th colspan="4">
                                    <div class="d-flex justify-content-center">
                                        Reservas
                                    </div>
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Nombre</th>
                                    <td>Libro</td>
                                    <td>Days left</td>
                                    <td></td>
                                </tr>
                                <?php
                                    $query = "SELECT `id`, `name`, `res_name`, `res_date` FROM `books` WHERE `reserved` = 'reservado'";
                                    $res = mysqli_query($con, $query);
                                
                                    if ($res)
                                    {
                                        while ($row = mysqli_fetch_array($res))
                                        {
                                            $row['res_date'] = (3600 * 24 * 7) - (time() - $row['res_date']);

                                            if (($row['res_date']) < 60)
                                                {
                                                    $time = $row['res_date'];
                                                    if ($time == 1)
                                                        $u = 'segundo';
                                                    else
                                                        $u = 'segundos';
                                                }
                                                else if(($row['res_date']) > 60 && ($row['res_date']) < 3600)
                                                {
                                                    $time = intdiv(($row['res_date']), 60);
                                                    if ($time == 1)
                                                        $u = 'minuto';
                                                    else
                                                        $u = 'minutos';
                                                }
                                                else if (($row['res_date']) > 3600 && ($row['res_date']) < (3600 * 24))
                                                {
                                                    $time = intdiv(($row['res_date']), (3600));
                                                    if ($time == 1)
                                                        $u = 'hora';
                                                    else
                                                        $u = 'horas';
                                                }
                                                else if (($row['res_date']) > (3600 * 24))
                                                {
                                                    $time = intdiv(($row['res_date']), (3600 * 24));
                                                    if ($time == 1)
                                                        $u = 'día';
                                                    else
                                                        $u = 'días';
                                                }

                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['res_name'];?></th>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $time, " ", $u;?></td>
                                                <td>
                                                    <form action="../logic/unreserve_book.php" method="POST" class="d-flex justify-content-end">
                                                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                                        <input type="submit" class="col-lg-3 col-md-5 col-9 p-1 mx-2 btn btn-danger border-0" style="font-size: .8rem;" value="x">
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php  
                }
                else
                    header('Location: ../views/');
            ?>
        </div>  
    </div>        
</body>
</html>