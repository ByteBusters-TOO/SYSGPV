<?php
require_once '../controllers/db_Config.php';

class mtoindex {
    private $conn;
    private $table_name = "usuario";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function authenticate($nombre_usuario, $contra) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nombre_usuario = :nombre_usuario AND contra = :contra";
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':contra', $contra);        
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}
?> 