<?php 

class DatabaseConnection {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "crm";

    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            //$this->conn->exec("set names utf8");
            //echo "Prisijungta prie duomenu bazes sekmingai";
        } catch(PDOException $e) {
            echo "Prisijungti prie duomenu bazes nepavyko: " . $e->getMessage();
        }

    }
   
    public function selectAction($table, $col ="id", $sortDir ="ASC") {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table` WHERE 1 ORDER BY $col $sortDir";
            //pasiruosimas vykdyti
            $stmt = $this->conn->prepare($sql);
            //vykdyti
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;

        } catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }
   
    public function insertAction($table, $cols, $values) {

        $cols = implode(",", $cols);
        $values = implode(",", $values);

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql= "INSERT INTO `$table` ($cols) VALUES ($values)";
            $this->conn->exec($sql);
            echo "Pavyko sukurti naują įrašą";

        } catch (PDOException $e) {
            echo "Nepavyko sukurti naujo iraso: " . $e->getMessage();
        }

    }

    public function deleteAction($table, $id) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `$table` WHERE id = $id";
            $this->conn->exec($sql);
            //echo "<span class='border border-2 border-danger p-2 mb-4 rounded'>Įrašas ištrintas</span>";
        }
        catch(PDOException $e) {
            echo "Nepavyko istrinti iraso: " . $e->getMessage();
        }
        
    }

    public function updateAction($table, $id, $data) {
        $cols = array_keys($data);
        $values = array_values($data);

        $dataString = [];
        for ($i=0; $i<count($cols); $i++) {
           $dataString[] = $cols[$i] . " = '" . $values[$i]. "'";
        }
        $dataString = implode(",", $dataString);

       try{
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "UPDATE `$table` SET $dataString WHERE id = $id";
              $stmt = $this->conn->prepare($sql);
              $stmt->execute();
              echo "Pavyko atnaujinti irasa";
         } 
       catch(PDOException $e) {
              echo "Nepavyko atnaujinti iraso: " . $e->getMessage();
       }
    }
    
    public function selectOneAction($table, $id) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table` WHERE id = $id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }

    public function selectRole($slapyvardis) {

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT teises_id FROM `vartotojai` WHERE slapyvardis = $slapyvardis";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }

       //var_dump($sql);
    }

    public function attemptLogin($slapyvardis, $slaptazodis) {

        $slapyvardis = "'".$slapyvardis."'";
        $slaptazodis = "'" . $slaptazodis . "'";

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `vartotojai` WHERE slapyvardis = $slapyvardis AND slaptazodis = $slaptazodis";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return count($result);
        } catch (PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }

    public function selectWithJoin($table1, $table2, $table1RelationCol, $table2RelationCol, $join, $cols, $sortCol = "id", $sortDir = "ASC") {

        $cols = implode(",", $cols);
        
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT $cols FROM $table1 
            $join $table2
            ON $table1.$table1RelationCol = $table2.$table2RelationCol
            ORDER BY $sortCol $sortDir";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->conn = null;
      //echo "Atjungta is duomenu bazes sekmingai";
    }

}

?>