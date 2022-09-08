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
        $this->vartotojai = $this->selectWithJoin("vartotojai","vartotojai_teises","teises_id","id","LEFT JOIN",["vartotojai.id", "vartotojai.vardas", "vartotojai.pavarde", "vartotojai.slapyvardis", "vartotojai.registracijos_data", "vartotojai.paskutinis_prisijungimas", "vartotojai_teises.pavadinimas AS pavadinimas"], $sortCol, $sortDir);
        return $this->vartotojai;
    }
}

?>