<?php session_start(); ?>
<?php include("classes/vartotojaiDatabase-class.php"); ?>
<?php include("classes/imonesDatabase-class.php"); ?>
<?php $vartotojaiDatabase = new VartotojaiDatabase();
$vartotojaiDatabase->logout();
//$vartotojaiDatabase->roleVartotojas();
$vartotojaiDatabase->istrintiVartotojas();
$vartotojaiDatabase->createVartotojas();
?>
<?php $imonesDatabase = new ImonesDatabase();
$imonesDatabase->istrintiImones();
$imonesDatabase->createImone();
?>
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
                <form class="d-flex mb-0" method="POST">
                    <button type="submit" name="atsijungti" class="btn btn-danger my-2 my-sm-0">Atsijungti</button>
                </form>

            <?php } else {
                header("Location: index.php");
            } ?>

        </div>
    </nav>

    <div class="container my-5">

        <div class="d-flex align-items-center">
            <h2 class="text-white">Vartotojai</h2>
            <button type="button" class="btn p-0 mx-3" data-bs-toggle="modal" data-bs-target="#naujasVartotojas" data-bs-toggle="tooltip" data-bs-placement="top" title="Sukurti vartotoją">
                <img src="images/plus.png">
            </button>

            <div class="modal fade" id="naujasVartotojas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Naujo vartotojo sukūrimas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST">
                                <p class="mb-3">Įveskite naujo vartotojo duomenis:</p>

                                <div class="form-outline form-white mb-2">
                                    <input name="vardas" type="text" id="vardas" class="form-control form-control-lg" required />
                                    <label class="form-label" for="vardas">Vardas</label>
                                </div>

                                <div class="form-outline form-white mb-2">
                                    <input name="pavarde" type="text" id="pavarde" class="form-control form-control-lg" required />
                                    <label class="form-label" for="pavarde">Pavardė</label>
                                </div>

                                <div class="form-outline form-white mb-2">
                                    <input name="slapyvardis" type="text" id="slapyvardis" class="form-control form-control-lg" required />
                                    <label class="form-label" for="slapyvardis">Slapyvardis</label>
                                </div>

                                <div class="form-outline form-white mb-2">
                                    <input name="teises_id" type="text" id="teises_id" class="form-control form-control-lg" required />
                                    <label class="form-label" for="teises_id">Teisės ID</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input name="slaptazodis" type="password" id="slaptazodis" class="form-control form-control-lg" required />
                                    <label class="form-label" for="slaptazodis">Slaptažodis</label>
                                </div>

                                <div class="modal-footer">
                                    <button name="sukurti" type="submit" class="btn btn-success">Išsaugoti pakeitimus</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Uždaryti</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-dark text-white">
            <tr>
                <th>ID</th>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Slapyvardis</th>
                <th>Teisės</th>
                <th>Registracijos data</th>
                <th>Paskutinis prisijungimas</th>
                <th>Veiksmai</th>
            </tr>

            <?php
            $vartotojai = new VartotojaiDatabase();
            $vartotojai = $vartotojai->getVartotojai();

            foreach ($vartotojai as $vartotojas) {
            ?>

                <tr>
                    <td><?php echo $vartotojas["id"]; ?></td>
                    <td><?php echo $vartotojas["vardas"]; ?></td>
                    <td><?php echo $vartotojas["pavarde"]; ?></td>
                    <td><?php echo $vartotojas["slapyvardis"]; ?></td>
                    <td><?php echo $vartotojas["teisesPavadinimas"]; ?></td>
                    <td><?php echo $vartotojas["registracijos_data"]; ?></td>
                    <td><?php echo $vartotojas["paskutinis_prisijungimas"]; ?></td>
                    <td>
                        <?php echo '<form method="POST" class="mb-0">'; ?>
                        <?php echo '<input type="hidden" name="id" value=' . $vartotojas["id"] . '>' ?>
                        <?php echo '<button class="btn p-0" type="submit" name="delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Ištrinti vartotoją"><img src="images/cancel.png"></button>' ?>
                        <?php echo '</form>'; ?>
                    </td>
                </tr>

            <?php }
            ?>

        </table>
    </div>

    <div class="container mb-5">
        <div class="d-flex align-items-center">
            <h2 class="text-white">Įmonės</h2>
            <button type="button" class="btn p-0 mx-3" data-bs-toggle="modal" data-bs-target="#naujaImone" data-bs-toggle="tooltip" data-bs-placement="top" title="Pridėti įmonę">
                <img src="images/plus.png">
            </button>

            <div class="modal fade" id="naujaImone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Naujos įmonės pridėjimas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST">
                                <p class="mb-3">Įveskite naujos įmonės duomenis:</p>

                                <div class="form-outline form-white mb-2">
                                    <input name="pavadinimas" type="text" id="pavadinimas" class="form-control form-control-lg" required />
                                    <label class="form-label" for="pavadinimas">Pavadinimas</label>
                                </div>

                                <div class="form-outline form-white mb-2">
                                    <input name="tipas_id" type="text" id="tipas_id" class="form-control form-control-lg" required />
                                    <label class="form-label" for="tipas_id">Įmonės tipo ID</label>
                                </div>

                                <div class="form-outline form-white mb-2">
                                    <input name="aprasymas" type="text" id="aprasymas" class="form-control form-control-lg" required />
                                    <label class="form-label" for="aprasymas">Aprašymas</label>
                                </div>

                                <div class="modal-footer">
                                    <button name="sukurti" type="submit" class="btn btn-success">Išsaugoti pakeitimus</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Uždaryti</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                    <td>
                        <?php echo '<form method="POST" class="mb-0">'; ?>
                        <?php echo '<input type="hidden" name="id" value=' . $imone["id"] . '>' ?>
                        <?php echo '<button class="btn p-0" type="submit" name="delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Ištrinti įmonę"><img src="images/cancel.png"></button>' ?>
                        <?php echo '</form>'; ?>
                    </td>
                </tr>

            <?php }
            ?>

        </table>

    </div>

    <!-- <?php //if ($_SESSION["teises_id"] == 4) { 
            ?>
        <div>
            <h3>Jūs esate adminas</h3>
        </div>
    <?php //} 
    ?>

    <?php //if ($_SESSION["teises_id"] == 3) { 
    ?>
        <div>
            <h3>Jūs esate vartotojas</h3>
        </div>
    <?php //} 
    ?> -->

</body>

</html>