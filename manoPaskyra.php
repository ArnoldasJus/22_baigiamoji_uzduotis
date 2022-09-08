<?php session_start(); ?>
<?php include("classes/vartotojaiDatabase-class.php"); ?>
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
                <form class="d-flex" method="POST" action="index.php">
                    <button type="submit" name="atsijungti" class="btn btn-danger my-2 my-sm-0">Atsijungti</button>
                </form>

            <?php } else {
                header("Location: index.php");
            } ?>


            <?php
            if (isset($_POST["atsijungti"])) {
                session_destroy();
                header("Location: index.php");
            }
            ?>

        </div>
    </nav>

    <div class="container">
        <h2>Vartotojai</h2>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Slapyvardis</th>
                <th>Teisės</th>
                <th>Registracijos data</th>
                <th>Paskutinis prisijungimas</th>
            </tr>

            <?php
                $vartotojai = new VartotojaiDatabase();
                $vartotojai = $vartotojai->getVartotojai();
                foreach ($vartotojai as $vartotojas) {
            ?>

                <tr>
                    <td><?php echo $vartotojai["id"]; ?></td>
                    <td><?php echo $vartotojai["vardas"]; ?></td>
                    <td><?php echo $vartotojai["pavarde"]; ?></td>
                    <td><?php echo $vartotojai["slapyvardis"]; ?></td>
                    <td><?php echo $vartotojai["pavadinimas"]; ?></td>
                    <td><?php echo $vartotojai["registracijos_data"]; ?></td>
                    <td><?php echo $vartotojai["paskutinis_prisijungimas"]; ?></td>
                </tr>
                
            <?php }
            ?>

        </table>
    </div>

</body>

</html>