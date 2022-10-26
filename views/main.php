<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I.E.S P.Negras Libros solidarios</title>

    <!--Icono-->
    <link rel="shortcut icon" href="../public/imgs/Logo_sin_fondo.png" />

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
            <?php
                include '../logic/hostconnect.php';

                $ip = $_SERVER['REMOTE_ADDR'];
                $query = "SELECT `ip` FROM `ips`";
                $data = mysqli_query($con, $query);
                $ip_in = false;
                
                while($row = mysqli_fetch_array($data))
                {
                    if ($row['ip'] == $ip)
                    {
                        $ip_in = true;
                        break;
                    }
                }
                if ($ip_in == false)
                {
                    $query = "INSERT INTO `ips` (`ip`) VALUES ('$ip')";
                    $res = mysqli_query($con, $query);
                    if ($res)
                    {
                        $not_in = false;
                        echo '<p class="text-light"><b>Bienvenid@</b></p>';
                    }
                }
                
                include '../logic/up_global_data.php';
                include '../logic/log_admin.php'; 
                include '../logic/rev_ips.php';
                
                if (!$_SESSION && rev_ips())
                {
                    ?>
                        <div class="d-flex justify-content-end mx-2">
                            <a href="../views/login_admin.php" class="btn btn-outline-light">Login admin</a>
                        </div>
                    <?php
                }
                else if ($_SESSION && rev_ips())
                {
                    ?>
                        <div class="d-flex justify-content-end mx-2">
                            <a href="../views/admin_info.php" class="btn btn-outline-light">Panel Administrador</a>
                        </div>
                    <?php
                }
               ?> 
            </div>
			<a href="../views">
				<div class="d-flex flex-column w-auto align-items-center py-2 m-sm-0">
					<img src="../public/imgs/Logo_sin_fondo.png" class="logo d-flex p-1" alt="">
				</div>
			</a>
            <form action="../views/" method="GET" class="mx-md-3 w-25 d-none d-sm-flex justify-content-end">
                <div class="input-group w-100">
                    <input type="text" name="searcher" class="form-control " placeholder="libro, autor, categoría, estado, precio..." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button type="submit" class="btn btn-outline-light" id="button-addon2">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <form action="../views/" method="GET" class="mx-md-3 my-2 w-100 d-sm-none justify-content-end">
                <div class="input-group w-auto mx-2">
                    <input type="text" name="searcher" class="form-control " placeholder="Busca tu libro" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button type="submit" class="btn btn-outline-light" id="button-addon2">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            </div>
        </div>
    </nav>
	<!--CLOSE MENU-->

	<!--START SOCIAL-->
    <div class="container d-flex justify-content-center bg-transparent">
		<div class="container-social w-auto bg-dark d-flex justify-content-center">
			<?php
				if (!$_SESSION)
				{
					?>
						<div class="social w-100 p-2 d-flex justify-content-evenly">
							<a href="https://www.instagram.com/iespnegras/?igshid=YmMyMTA2M2Y=" target="blank" class="text-muted px-sm-4 px-2 insta"><i class="fab fa-instagram"></i></a>
							<a href="https://twitter.com/IesPnegras" class="text-muted twitter px-sm-4 px-2" target="blank"><i class="fab fa-twitter"></i></a>
							<a href="https://www.facebook.com/IES-Peñas-Negras-788644004586154" target="blank" class="text-muted facebook px-sm-4 px-2"><i class="fab fa-facebook"></i></a>
							<a href="https://www.tiktok.com/@iespnegras" target="blank" class="text-muted tiktok px-sm-4 px-2"><i class="fab fa-tiktok"></i></a>        
						</div>  
					<?php
				}
				else if ($_SESSION)
				{
					?>
						<div class="dropdown-center">
							<a class="h6 text-warning dropdown-toggle m-3 mt-0" style="text-decoration: none;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<b>
									Administrador
								</b>    
							</a>
							<ul class="dropdown-menu dropdown-menu-light">
								<li>
									<a class="dropdown-item p-0" href="#">
										<form action="../views/form.php" method="POST">
											<input type="submit" class="w-100 bg-transparent m-0 border-0 text-start mx-2" value="Añadir libro">
										</form>
									</a>
								</li>
								<li><hr class="dropdown-divider"></li>
								<li>
									<form action="../logic/out_admin.php" class="d-flex justify-content-center mt-3">
										<input type="submit" class="btn btn-outline-danger" value="Cerrar Sesión">
									</form>
								</li>    
							</ul>
						</div>
					<?php
				}
			?>
		</div>
	</div>
	<!--END SOCIAL-->

	<!--START BOOK DISPLAY-->
    <?php
        include '../logic/hostconnect.php';
       //Logout admin automático
        if ($_SESSION)
        {
            if ((time() - $_SESSION['time']) > (3600 * 12))
                header("Location: $SERVER[HTTP_REFERER]");
        }
    ?>
    <div class="container-fluid bg-light p-md-0 w-100">
        <!--START CATEGORIES-->
		<div class="container-categories d-flex justify-content-center w-100 pt-5 text-secondary border-bottom border-gray">
				<ul class="d-flex mt-4 col-12 col-lg-6 justify-content-evenly">
				<li class="d-md-none text-light">   ignore   </li>	
                <li class="categorie mx-2" style="list-style: none;">
						<form action="../views/" method="GET" class="text-gray">
								<input type="hidden" name="searcher" value="Novela">
								<button type="submit" class="border-0 bg-light text-secondary categorie">
									<b>Novela</b>
								</button>
						</form>
					</li>
					<li class="categorie mx-2" style="list-style: none;">
						<form action="../views/" method="GET" class="text-gray">
								<input type="hidden" name="searcher" value="Guía">
								<button type="submit" class="border-0 bg-light text-secondary categorie">
									<b>Guía</b>
								</button>
						</form>
					</li>
					<li class="categorie mx-2" style="list-style: none;">
						<form action="../views/" method="GET" class="text-gray">
								<input type="hidden" name="searcher" value="Didáctico">
								<button type="submit" class="border-0 bg-light text-secondary categorie">
									<b>Didáctico</b>
								</button>
						</form>
					</li>
					<li class="categorie mx-2" style="list-style: none;">
						<form action="../views/" method="GET" class="text-gray">
								<input type="hidden" name="searcher" value="Científico">
								<button type="submit" class="border-0 bg-light text-secondary categorie">
									<b>Científico</b>
								</button>
						</form>
					</li>
					<li class="categorie mx-2" style="list-style: none;">
						<form action="../views/" method="GET" class="text-gray">
								<input type="hidden" name="searcher" value="Novela">
								<button type="submit" class="border-0 bg-light text-secondary categorie">
									<b>Biografía</b>
								</button>
						</form>
					</li>
				</ul>
		</div>
        <div class="container d-flex flex-wrap justify-content-evenly">
            <?php
                if (isset($_GET['searcher']) && !empty($_GET['searcher']))
                {
                    $searcher = $_GET['searcher'];
                    $query = "SELECT `id`, `name`, `desc`, `photo`, `photo_type`, `author`, `price`, `status`, `reserved`, `category` FROM `books` WHERE `name` LIKE '%$searcher%' OR `name` LIKE '%$searcher%' OR `author` LIKE '%$searcher%' OR `reserved` LIKE '%$searcher%' OR `category` LIKE '%$searcher%'";
                }
                else
                    $query = "SELECT `id`, `name`, `desc`, `photo`, `photo_type`, `author`, `price`, `status`, `reserved`, `category` FROM `books`";
                $data = mysqli_query($con, $query);

                if ($data)
                {
                    while($row = mysqli_fetch_array($data))
                    {
                        ?>
                            <div class="card m-3" style="width: 15rem;">
                                <img src="data:<?php $row['photo_type']; ?>;base64,<?php echo base64_encode($row['photo']);?>"
                                class="card-img-top p-3 rounded-5 h-100" alt="...">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title text-nowrap text-dark w-75">
											<b>
												<?php
													echo $row['name'];
												?>
											</b>
                                        </h6>
                                        <h5 class="card-title">
                                            <b>
                                                <?php
                                                    echo $row['price'];
                                                    echo "€";
                                                ?>
                                            </b>
                                        </h5>
                                    </div>
                                    <div class="d-flex justify-content-between w-100">
                                        <div>
                                            <p class="text-secondary" style="font-size: .8rem;">
                                                <b>
                                                    <?php
                                                        echo $row['author'];
                                                    ?>
                                                </b>
                                            </p>
                                        </div>
                                        
                                        <div>
                                            <h6 class="text-success mx-2">
                                                <?php
                                                    if ($row['reserved'])
                                                        echo "R";
                                                ?>
                                            </h6>   
                                        </div>
                                    </div>
                                    
                                    <form action="book.php" method="POST" class="container-btn d-flex justify-content-end">
                                        <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                        <input type="submit" name="submit" class="btn btn-primary align-self-end w-100 border-light" value="Ver más">
                                    </form>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                    echo "Error al conectar a la base de datos";
            ?>  
        </div>
    </div>
	<!--END BOOK DISPLAY-->

    <script src="../public/js/animations.js"></script>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>