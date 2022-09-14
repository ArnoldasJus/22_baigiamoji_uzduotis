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

    public function istrintiImones() {
        if (isset($_POST["delete"])) {
            $this->deleteAction("imones", $_POST["id"]);
        }
    }

    public function createImone() {

        if (isset($_POST["sukurti"])) {
            $imone = array(
                "pavadinimas" => "'" . $_POST["pavadinimas"] . "'",
                "tipas_id" => "'" . $_POST["tipas_id"] . "'",
                "aprasymas" => "'" . $_POST["aprasymas"] . "'"
            );

            $this->insertAction("imones", ["pavadinimas", "tipas_id", "aprasymas"], $imone);

            header("Location: manoPaskyra.php");
            // return $imone;
        }
    }
}
