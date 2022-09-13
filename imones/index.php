<?php session_start(); ?>
<?php include("classes/imonesDatabase-class.php"); ?>
<!DOCTYPE html>
<html lang="lt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mano paskyra</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href="assets/style.css" rel="stylesheet">
</head>

<body class="gradient-custom">

    <nav class="navbar navbar-light bg-dark shadow-sm">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="manoPaskyra.php">
                <img src="images/favicon.png">
            </a>

            <?php if (isset($_SESSION["arPrisijunges"]) && $_SESSION["arPrisijunges"] == 1) { ?>
                <form class="d-flex" method="POST">
                    <button type="submit" name="atsijungti" class="btn btn-danger my-2 my-sm-0">Atsijungti</button>
                </form>

            <?php } else {
                header("Location: index.php");
            } ?>

        </div>
    </nav>



    <div class="container text-white">
        <h2>Įmonės</h2>
        <table class="table table-dark text-white">
            <tr>
                <th>ID</th>
                <th>Pavadinimas</th>
                <th>Įmonės tipas</th>
                <th>Aprašymas</th>
                <th>Veiksmai</th>
            </tr>

            <?php
            $imones = new ImonesDatabase();
            $imones = $imones->getImones();

            foreach ($imones as $imone) {
            ?>

                <tr>
                    <td><?php echo $imone["id"]; ?></td>
                    <td><?php echo $imone["pavadinimas"]; ?></td>
                    <td><?php echo $imone["imonesTipas"]; ?></td>
                    <td><?php echo $imone["aprasymas"]; ?></td>
                    <td>X O</td>
                </tr>

            <?php }
            ?>

        </table>
    </div>

</body>

</html>