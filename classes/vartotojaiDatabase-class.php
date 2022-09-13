<?php
include ("classes/databaseConnection-class.php");

class VartotojaiDatabase extends DatabaseConnection {
    public $vartotojai;
    public $vartotojai_teises;

    public function __construct() {
        parent::__construct();
    }


    public function getVartotojai() {

        if(isset($_GET["sortCol"]) && isset($_GET["sortDir"])) {
            $sortCol = $_GET["sortCol"];
            $sortDir = $_GET["sortDir"];
        } else {
            $sortCol = "id";
            $sortDir = "ASC";
        }
        $this->vartotojai = $this->selectWithJoin("vartotojai","vartotojai_teises","teises_id","id","LEFT JOIN",["vartotojai.id", "vartotojai.vardas", "vartotojai.pavarde", "vartotojai.slapyvardis", "vartotojai.registracijos_data", "vartotojai.paskutinis_prisijungimas", "vartotojai_teises.pavadinimas AS teisesPavadinimas"], $sortCol, $sortDir);
        return $this->vartotojai;
    }


    //  VEIKIA
    public function createVartotojas() {
        //cia blogas buvo pavadinimas mygtuko, ne submit, o patvirtinti
        if(isset($_POST["patvirtinti"])) {
            $vartotojas = array(
                "vardas" => "'".$_POST["vardas"]."'",
                "pavarde" => "'" . $_POST["pavarde"] . "'",
                "slapyvardis" => "'" . $_POST["slapyvardis"] . "'",
                //cia buvo sumaisytas eiliskumas
                "slaptazodis" => "'" . $_POST["slaptazodis"] . "'",
                "teises_id" => 3,
                "registracijos_data" => "'" . date("Y/m/d") ."'",
                "paskutinis_prisijungimas" => "'" . "" . "'"
            );

            $this->insertAction("vartotojai", ["vardas", "pavarde", "slapyvardis", "slaptazodis", "teises_id", "registracijos_data", "paskutinis_prisijungimas"], $vartotojas);

            return $vartotojas;
        }
    }

    //kaip sukurei metoda createVartotojas, gali sukurti metoda loginVartotojas

    public function loginVartotojas() {

        //slapyvardis is slaptazodis turetu buti ne statines reiksmes, del to galime padaryti taip
    
        if (isset($_POST["patvirtinti"])) {
            $input_slapyvardis = $_POST["slapyvardis"];
            $input_slaptazodis = $_POST["slaptazodis"];

            //kvieciame duomenu bazes metoda kuri sukureme

           $attemptLogin =  $this->attemptLogin($input_slapyvardis, $input_slaptazodis);//sekmingai 1 nesekmingai 0
            //ir pasikeicia ifas
         if ($attemptLogin == 1) {
                 //echo "Sveiki prisijungę, $vardas!";
                $_SESSION["arPrisijunges"] = 1;
                 header("Location: manoPaskyra.php");
         } else {
                 echo "Įvesti duomenys neteisingi";
                 //header("Location: register.php");
         }

        }

    }

    public function logout() {
        if (isset($_POST["atsijungti"])) {
            session_destroy();
            header("Location: index.php");
        }
    }

    public function roleVartotojas() {
        if ($_SESSION["arPrisijunges"] = 1) {
            $_SESSION["teises_id"] = "selectRole()";
        }
    }

}

?>