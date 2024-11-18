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
        $query = "SELECT id_proyecto, nombre_proyecto, descripcion_proyecto, ubicacion_proyecto, fecha_inicio, fecha_fin, estado_proyecto FROM proyecto ORDER BY id_proyecto";
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
    // Nueva función para verificar si un proyecto con el mismo nombre ya existe
    public function existsByName($nombre_proyecto) {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE nombre_proyecto = :nombre_proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_proyecto', $nombre_proyecto);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;  // Devuelve true si ya existe, false si no
    }

    public function create($nombre_proyecto, $descripcion_proyecto, $ubicacion_proyecto, $fecha_inicio, $fecha_fin, $estado_proyecto) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nombre_proyecto, descripcion_proyecto, ubicacion_proyecto, fecha_inicio, fecha_fin, estado_proyecto) VALUES (:nombre_proyecto, :descripcion_proyecto, :ubicacion_proyecto, :fecha_inicio, :fecha_fin, :estado_proyecto)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre_proyecto', $nombre_proyecto);
            $stmt->bindParam(':descripcion_proyecto', $descripcion_proyecto);
            $stmt->bindParam(':ubicacion_proyecto', $ubicacion_proyecto);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->bindParam(':estado_proyecto', $estado_proyecto);

            return $stmt->execute();  // Retorna true si se inserta con éxito, false en caso contrario
        } catch (PDOException $e) {
            return false;  // Devuelve false en caso de error
        }
    }

    public function update($id_proyecto, $nombre_proyecto, $descripcion_proyecto, $ubicacion_proyecto, $fecha_inicio, $fecha_fin, $estado_proyecto) {
        $query = "UPDATE " . $this->table_name . " SET nombre_proyecto = :nombre_proyecto, descripcion_proyecto = :descripcion_proyecto, ubicacion_proyecto = :ubicacion_proyecto, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, estado_proyecto = :estado_proyecto  WHERE id_proyecto = :id_proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_proyecto', $nombre_proyecto);
        $stmt->bindParam(':descripcion_proyecto', $descripcion_proyecto);
        $stmt->bindParam(':ubicacion_proyecto', $ubicacion_proyecto);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':id_proyecto', $id_proyecto);
        $stmt->bindParam(':estado_proyecto', $estado_proyecto);
        return $stmt->execute();  // Ejecutar la actualización
    }

    public function delete($id_proyecto) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_proyecto = :id_proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_proyecto', $id_proyecto);
        return $stmt->execute();
    }

    public function getTotalProyectos() {
        // Consulta para contar todos los proyectos
        $query = "SELECT COUNT(*) as total_proyectos FROM proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_proyectos'];  // Retorna el total de proyectos
    }
    

}
?>
