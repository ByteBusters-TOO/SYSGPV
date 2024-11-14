<?php
require_once '../controllers/db_Config.php';

class mtoindex {
    private $conn;
    private $table_name = "usuario";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function authenticate($nombre_usuario, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nombre_usuario = :nombre_usuario AND password = :password";
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':password', $password);        
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}
?> 