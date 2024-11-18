<?php
require_once '../controllers/db_Config.php';

class EmpresaModel {
    private $conn;
    private $table_name = "empresacompetencia";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_empresa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  public function read($id) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id_empresa = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    // Obtenemos el resultado de la consulta
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Verifica si el resultado existe
    if (!$result) {
        return null; // Si no se encuentra la empresa, retornamos null
    }
    
    return $result; // Si se encuentra, devolvemos los datos
}

    public function createEmpresa($nombre_empresa, $ventas_empresa, $proyectos_empresa) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nombre_empresa, ventas_empresa, proyectos_empresa) 
                      VALUES (:nombre_empresa, :ventas_empresa, :proyectos_empresa)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre_empresa', $nombre_empresa);
            $stmt->bindParam(':ventas_empresa', $ventas_empresa);
            $stmt->bindParam(':proyectos_empresa', $proyectos_empresa);

            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Empresa creada exitosamente.'];
            } else {
                return ['success' => false, 'message' => 'No se pudo crear la empresa.'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    public function deleteEmpresa($id) {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id_empresa = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Empresa eliminada exitosamente.'];
            } else {
                return ['success' => false, 'message' => 'No se pudo eliminar la empresa.'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    public function updateEmpresa($id, $nombre_empresa, $proyectos_empresa, $ventas_empresa) {
        $query = "UPDATE " . $this->table_name . " 
                 SET nombre_empresa = :nombre_empresa, 
                     proyectos_empresa = :proyectos_empresa,
                     ventas_empresa = :ventas_empresa
                 WHERE id_empresa = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre_empresa', $nombre_empresa);
        $stmt->bindParam(':proyectos_empresa', $proyectos_empresa);
        $stmt->bindParam(':ventas_empresa', $ventas_empresa);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Empresa actualizada exitosamente.'];
        } else {
            return ['success' => false, 'message' => 'No se pudo actualizar la empresa.'];
        }
    }

    public function empresaNameExists($nombre_empresa) {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE nombre_empresa = :nombre_empresa";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_empresa', $nombre_empresa);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
?>
