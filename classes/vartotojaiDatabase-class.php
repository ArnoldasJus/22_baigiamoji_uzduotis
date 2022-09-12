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


    //  NEVEIKIA
    public function createVartotojas() {
        if(isset($_POST["submit"])) {
            $vartotojas = array(
                "vardas" => $_POST["vardas"],
                "pavarde" => $_POST["pavarde"],
                "slapyvardis" => $_POST["slapyvardis"],
                //"teises_id" => [3],
                "slaptazodis" => $_POST["slaptazodis"]
                //"registracijos_data" => ["date()"],
                //"paskutinis_prisijungimas" => ""
            );
            $this->insertAction("vartotojai", ["vardas", "pavarde", "slapyvardis", "slaptazodis"], ["'" . $vartotojas["vardas"] . "'", "'" . $vartotojas["pavarde"] . "'", "'" . $vartotojas["slapyvardis"] . "'", "'" . $vartotojas["slaptazodis"] . "'"]);
            //var_dump($vartotojas);
        }
    }

    // VARTOTOJO TIKRINIMO METODAS (NEVEIKIA)
    public function egzistuojaVartotojai(){

        if (isset($_GET["sortCol"]) && isset($_GET["sortDir"])) {
            $sortCol = $_GET["sortCol"];
            $sortDir = $_GET["sortDir"];
        } else {
            $sortCol = "id";
            $sortDir = "ASC";
        }
        $this->vartotojai = $this->selectTwoAction("vartotojai", "slapyvardis", "slaptazodis");
        return $this->vartotojai;
    }
}

?>