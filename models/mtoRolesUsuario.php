<?php
require_once '../controllers/db_Config.php';//Agregamos la conexion

class RoleModel {
    private $conn;//Variable de conexion
    private $table_name = "rol_usuario"; //variable que contiene el nombre de la tabla

    //Metodo constructor de la clase
    public function __construct() {
        $database = new Database();//Instanciamos la conexion
        $this->conn = $database->getConnection(); //Asignamos la conexion a la variable previamente definida
    }

    // Obtener todos los roles
    public function getAllRoles() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Obtiene un rol en especifico
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_rol = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception('El rol solicitado no existe.');
        }
        
        return $result;
    }

    // Crear nuevo rol
    public function createRole($tipo_usuario, $descripcion_usuario) {
         try {
            $query = "INSERT INTO " . $this->table_name . " (tipo_usuario, descripcion_usuario) VALUES (:tipo_usuario, :descripcion_usuario)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':tipo_usuario', $tipo_usuario);
            $stmt->bindParam(':descripcion_usuario', $descripcion_usuario);

            return $stmt->execute();  // Retorna true si se inserta con éxito, false en caso contrario
        } catch (PDOException $e) {
            return false;  // Devuelve false en caso de error
        }
    }

    // Verificar si existe el tipo de rol
    public function roleNameExists($tipo_usuario) {

        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE tipo_usuario = :tipo_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tipo_usuario', $tipo_usuario);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;  // Devuelve true si ya existe, false si no
    }

   // Eliminar rol
   public function deleteRole($id) {
    try {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_rol = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if($stmt->execute()) {
            return ['success' => true, 'message' => 'Rol eliminado exitosamente.'];
        } else {
            return ['success' => false, 'message' => 'Error al eliminar el rol.'];
        }
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
    }
}

    // Actualizar rol
    public function updateRole($id_rol, $tipo_usuario, $descripcion_usuario) {
        $query = "UPDATE " . $this->table_name . " SET tipo_usuario = :tipo_usuario, descripcion_usuario = :descripcion_usuario  WHERE id_rol = :id_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tipo_usuario', $tipo_usuario);
        $stmt->bindParam(':descripcion_usuario', $descripcion_usuario);
        $stmt->bindParam(':id_rol', $id_rol);
        return $stmt->execute();  // Ejecutar la actualización
    }
    
}
?>