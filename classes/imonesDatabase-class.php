<?php
include_once ("classes/databaseConnection-class.php");

class ImonesDatabase extends DatabaseConnection {
    public $imones;
    public $imones_tipas;

    public function __construct() {
        parent::__construct();
    }


    public function getImones() {

        if(isset($_GET["sortCol"]) && isset($_GET["sortDir"])) {
            $sortCol = $_GET["sortCol"];
            $sortDir = $_GET["sortDir"];
        } else {
            $sortCol = "id";
            $sortDir = "ASC";
        }
        $this->imones = $this->selectWithJoin("imones", "imones_tipas","tipas_id","id","LEFT JOIN",["imones.id", "imones.pavadinimas", "imones_tipas.pavadinimas AS imonesTipas", "imones.aprasymas"], $sortCol, $sortDir);
        return $this->imones;
    }
}
