<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadillo solidario admin info</title>
</head>
<body>
    <?php
        include '../logic/log_admin.php';
        include '../logic/rev_ips.php';

        if ($_SESSION && rev_ips())
        {
            $query = "SELECT `id`, `num_books`, `sold_books`, `dinero_recaudado`, `visitas` FROM `global_data` WHERE `id` = 1";
            $data = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($data))
            {
                echo "Hemos vendido {$row['sold_books']} libros";
                echo '<br>';
                echo "Hemos recaudado {$row['dinero_recaudado']}€";
                echo '<br>';
                echo "Tenemos {$row['num_books']} libros en stock";
                echo '<br>';
                echo "{$row['visitas']} personas han visitado la web";
            }

        }
        else
            header('Location: ../views/');

    ?>
</body>
</html>