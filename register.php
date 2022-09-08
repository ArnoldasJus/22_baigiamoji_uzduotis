<?php session_start(); ?>
<!DOCTYPE html>
<html lang="lt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href="assets/style.css" rel="stylesheet">
</head>

<body class="gradient-custom">

    <?php if (isset($_SESSION["arPrisijunges"]) && $_SESSION["arPrisijunges"] == 1) { ?>
        <!-- <form method="POST" action="index.php">
            <button type="submit" name="atsijungti">Atsijungti</button>
        </form> -->

        <?php header("Location: manoPaskyra.php"); ?>

    <?php } else { ?>

        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body py-3 px-5 text-center">

                                <div class="mb-md-3 mt-md-4 pb-5">

                                    <form method="POST" action="index.php">

                                        <h2 class="fw-bold mb-2 text-uppercase">Registracija</h2>
                                        <p class="text-white-50 mb-5">Įveskite savo duomenis</p>

                                        <div class="form-outline form-white mb-2">
                                            <input name="vardas" type="text" id="vardas" class="form-control form-control-lg" />
                                            <label class="form-label" for="vardas">Vardas</label>
                                        </div>

                                        <div class="form-outline form-white mb-2">
                                            <input name="pavarde" type="text" id="pavarde" class="form-control form-control-lg" />
                                            <label class="form-label" for="pavarde">Pavardė</label>
                                        </div>

                                        <div class="form-outline form-white mb-2">
                                            <input name="slapyvardis" type="text" id="slapyvardis" class="form-control form-control-lg" />
                                            <label class="form-label" for="slapyvardis">Slapyvardis</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input name="slaptazodis" type="password" id="slaptazodis" class="form-control form-control-lg" />
                                            <label class="form-label" for="slaptazodis">Slaptažodis</label>
                                        </div>

                                        <button name="patvirtinti" class="btn btn-outline-light btn-lg px-5" type="submit">Registuotis</button>
                                    </form>


                                </div>

                                <div>
                                    <p class="mb-0">Jau turite paskyrą? <a href="index.php" class="text-white-50 fw-bold">Prisijunkite</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php } ?>

</body>

</html>