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
    public function getHistorialVentas() {
        // Consulta para obtener el historial de ventas
        $query = "SELECT v.id_venta, v.fecha_venta, v.monto_venta, v.nombre_cliente, v.apellido_cliente, 
                         v.correo_cliente, v.telefono_cliente, ca.numero_casa 
                  FROM venta v
                  JOIN casa ca ON v.id_casa = ca.id_casa"; // Relaciona la casa vendida con la tabla casa
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todas las ventas
    }
    public function getDetalleVenta($id_venta) {
        $query = "SELECT v.id_venta, v.fecha_venta, v.monto_venta, v.nombre_cliente, v.apellido_cliente, 
                         v.correo_cliente, v.telefono_cliente, ca.numero_casa
                  FROM " . $this->table_name . " v
                  JOIN casa ca ON v.id_casa = ca.id_casa
                  WHERE v.id_venta = :id_venta";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_venta', $id_venta);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}

