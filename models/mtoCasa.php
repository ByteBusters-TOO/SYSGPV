<?php

require_once '../controllers/db_config.php';

class Casa {
    private $conn;
    private $table_name = "casa";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Función para verificar si ya existe una casa con el mismo número en el mismo proyecto
    public function existsInProject($numero_casa, $id_proyecto) {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE numero_casa = :numero_casa AND id_proyecto = :id_proyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':numero_casa', $numero_casa);
        $stmt->bindParam(':id_proyecto', $id_proyecto);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;  // Devuelve true si ya existe, false si no
    }

    public function create($numero_casa, $estado_casa, $precio_casa, $id_proyecto) {
        // Verificar si ya existe una casa con el mismo número en el mismo proyecto
        if ($this->existsInProject($numero_casa, $id_proyecto)) {
            return ['status' => false, 'mensaje' => 'Ya existe una casa con ese número en este proyecto.'];
        }

        // Insertar la nueva casa si no existe un duplicado
        try {
            $query = "INSERT INTO " . $this->table_name . " (numero_casa, estado_casa, precio_casa, id_proyecto) VALUES (:numero_casa, :estado_casa, :precio_casa, :id_proyecto)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':numero_casa', $numero_casa);
            $stmt->bindParam(':estado_casa', $estado_casa);
            $stmt->bindParam(':precio_casa', $precio_casa);
            $stmt->bindParam(':id_proyecto', $id_proyecto);

            if ($stmt->execute()) {
                return ['status' => true, 'mensaje' => 'Casa registrada exitosamente.'];
            } else {
                return ['status' => false, 'mensaje' => 'Error al registrar la casa.'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'mensaje' => 'Error: ' . $e->getMessage()];
        }
    }
    public function getCasasDisponibles() {
        $query = "SELECT c.id_casa, c.numero_casa, c.estado_casa, c.precio_casa, c.id_proyecto, p.nombre_proyecto AS proyecto
                  FROM " . $this->table_name . " c
                  JOIN proyecto p ON c.id_proyecto = p.id_proyecto
                  WHERE c.estado_casa = 'Lista para la Venta'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Devuelve todas las casas que están listas para la venta
    }
    
}
