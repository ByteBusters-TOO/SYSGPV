<?php

require_once '../controllers/db_config.php';

class Proyecto {
    private $conn;
    private $table_name = "proyecto";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function readAll() {
        $query = "SELECT id_proyecto, nombre_proyecto, descripcion_proyecto, ubicacion_proyecto, fecha_inicio, fecha_fin FROM proyecto ORDER BY id_proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_proyecto = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre_proyecto, $descripcion_proyecto, $ubicacion_proyecto, $fecha_inicio, $fecha_fin) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nombre_proyecto, descripcion_proyecto, ubicacion_proyecto, fecha_inicio, fecha_fin) VALUES (:nombre_proyecto, :descripcion_proyecto, :ubicacion_proyecto, :fecha_inicio, :fecha_fin)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre_proyecto', $nombre_proyecto);
            $stmt->bindParam(':descripcion_proyecto', $descripcion_proyecto);
            $stmt->bindParam(':ubicacion_proyecto', $ubicacion_proyecto);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            
            if ($stmt->execute()) {
                echo "Inserción exitosa";  // Depuración: Confirmación de inserción
            } else {
                echo "Error en la inserción";  // Depuración: Error en la inserción
            }
        } catch (PDOException $e) {
            echo "Error en la creación del proyecto: " . $e->getMessage();
        }
    }

    public function update($id_proyecto, $nombre_proyecto, $descripcion_proyecto, $ubicacion_proyecto, $fecha_inicio, $fecha_fin) {
        $query = "UPDATE " . $this->table_name . " SET nombre_proyecto = :nombre_proyecto, descripcion_proyecto = :descripcion_proyecto, ubicacion_proyecto = :ubicacion_proyecto, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id_proyecto = :id_proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_proyecto', $nombre_proyecto);
        $stmt->bindParam(':descripcion_proyecto', $descripcion_proyecto);
        $stmt->bindParam(':ubicacion_proyecto', $ubicacion_proyecto);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        
    }

    public function delete($id_proyecto) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_proyecto = :id_proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_proyecto', $id_proyecto);
        return $stmt->execute();
    }
}
?>
