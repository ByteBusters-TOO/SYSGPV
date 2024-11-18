<?php

require_once '../controllers/db_Config.php';

class Alerta {
    private $conn;
    private $table_name = "alertas";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function readAll() {
        $query = "SELECT id_alerta, estado_alerta, asunto_alerta, fecha_alerta, tipo_alerta, id_proyecto, id_usuario FROM alertas ORDER BY id_alerta";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_alerta = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($estado_alerta, $asunto_alerta, $fecha_alerta, $tipo_alerta, $id_proyecto, $id_usuario) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (estado_alerta, asunto_alerta, fecha_alerta, tipo_alerta, id_proyecto, id_usuario) VALUES (:estado_alerta, :asunto_alerta, :fecha_alerta, :tipo_alerta, :id_proyecto, :id_usuario)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':estado_alerta', $estado_alerta);
            $stmt->bindParam(':asunto_alerta', $asunto_alerta);
            $stmt->bindParam(':fecha_alerta', $fecha_alerta);
            $stmt->bindParam(':tipo_alerta', $tipo_alerta);
            $stmt->bindParam(':id_proyecto', $id_proyecto);
            $stmt->bindParam(':id_usuario', $id_usuario);

            return $stmt->execute();  // Retorna true si se inserta con éxito, false en caso contrario
        } catch (PDOException $e) {
            return false;  // Devuelve false en caso de error
        }
    }

    public function update($id_alerta, $estado_alerta, $asunto_alerta, $fecha_alerta, $tipo_alerta, $id_proyecto, $id_usuario) {
        $query = "UPDATE " . $this->table_name . " SET estado_alerta = :estado_alerta, asunto_alerta = :asunto_alerta, fecha_alerta = :fecha_alerta, tipo_alerta = :tipo_alerta, id_proyecto = :id_proyecto, id_usuario = :id_usuario WHERE id_alerta = :id_alerta";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':estado_alerta', $estado_alerta);
        $stmt->bindParam(':asunto_alerta', $asunto_alerta);
        $stmt->bindParam(':fecha_alerta', $fecha_alerta);
        $stmt->bindParam(':tipo_alerta', $tipo_alerta);
        $stmt->bindParam(':id_alerta', $id_alerta);
        $stmt->bindParam(':id_proyecto', $id_proyecto);
        $stmt->bindParam(':id_usuario', $id_usuario);
        return $stmt->execute();  // Ejecutar la actualización
    }

    public function delete($id_alerta) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_alerta = :id_alerta";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_alerta', $id_alerta);
        return $stmt->execute();
    }
    
    public function getProyectos() {
        $query = "SELECT id_proyecto, nombre_proyecto, estado_proyecto FROM proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getUsuarios() {
        $query = "SELECT id_usuario, nombre_usuario FROM usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAlertaPorId($id_alerta)
    {
        try {
            $query = "SELECT c.id_alerta, c.estado_alerta, c.asunto_alerta, c.fecha_alerta, 
                             c.tipo_alerta, c.id_proyecto, c.id_usuario, p.nombre_proyecto, u.nombre_usuario
                      FROM " . $this->table_name . " c
                      JOIN proyecto p ON c.id_proyecto = p.id_proyecto
                      JOIN usuario u ON c.id_usuario = u.id_usuario
                      WHERE c.id_alerta = :id_alerta";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_alerta', $id_alerta);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log("Error en " . __METHOD__ . ": " . $e->getMessage());
            return null;
        }
    }
}
?>
