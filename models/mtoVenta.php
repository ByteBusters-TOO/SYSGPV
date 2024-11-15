<?php

require_once '../controllers/db_config.php';

class Venta {
    private $conn;
    private $table_name = "venta";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para registrar una venta
    public function create($fecha_venta, $monto_venta, $nombre_cliente, $apellido_cliente, $correo_cliente, $telefono_cliente, $id_casa) {
        $query = "INSERT INTO " . $this->table_name . " (fecha_venta, monto_venta, nombre_cliente, apellido_cliente, correo_cliente, telefono_cliente, id_casa)
                  VALUES (:fecha_venta, :monto_venta, :nombre_cliente, :apellido_cliente, :correo_cliente, :telefono_cliente, :id_casa)";
        $stmt = $this->conn->prepare($query);

        // Bind de parámetros
        $stmt->bindParam(':fecha_venta', $fecha_venta);
        $stmt->bindParam(':monto_venta', $monto_venta);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente);
        $stmt->bindParam(':apellido_cliente', $apellido_cliente);
        $stmt->bindParam(':correo_cliente', $correo_cliente);
        $stmt->bindParam(':telefono_cliente', $telefono_cliente);
        $stmt->bindParam(':id_casa', $id_casa);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return ['status' => true];
        } else {
            return ['status' => false];
        }
    }
}
