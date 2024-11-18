<?php

require_once '../controllers/db_config.php';

class Reporte {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getVentas() {
        $query = "SELECT * FROM venta";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCasas() {
        $query = "SELECT * FROM casa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProyectos() {
        $query = "SELECT * FROM proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function guardarReporte($tipo_reporte, $descripcion_reporte, $fecha_generacion) {
        try {
            $query = "INSERT INTO reportes (tipo_reporte, descripcion_reporte, fecha_generacion) 
                      VALUES (:tipo_reporte, :descripcion_reporte, :fecha_generacion)";
            $stmt = $this->conn->prepare($query);

            // Bind de parámetros
            $stmt->bindParam(':tipo_reporte', $tipo_reporte);
            $stmt->bindParam(':descripcion_reporte', $descripcion_reporte);
            $stmt->bindParam(':fecha_generacion', $fecha_generacion);

            // Ejecutar consulta
            $stmt->execute();
            return true; // Retorna true si se ejecutó con éxito
        } catch (PDOException $e) {
            // Manejar errores
            throw new Exception("Error al guardar el reporte: " . $e->getMessage());
        }
    }
}
?>
