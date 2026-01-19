<?php

use FFI\Exception;

class Database {
    private $connection ;
    
    public function __construct(){
        $host = 'localhost';
        $db   = 'thoth_lms';
        $user = 'root';
        $password = 'amine@2002@N';
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'la connection est fait ';
        } catch (Exception $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }
    function getbyEmail($email){
    $sql = "SELECT email FROM utilisateurs WHERE email  = ?";
    $stmt= $this->connection->prepare($sql);
    $stmt->execute([$email]);
    return $user = $stmt->fetch(); 
}
}
class mere {
     
}

