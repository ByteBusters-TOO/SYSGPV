<?php
require_once '../controllers/db_Config.php';//Agregamos la conexion

class Usuario {
    private $conn;//Variable de conexion
    private $table_name = "usuario"; //variable que contiene el nombre de la tabla

    //Metodo constructor de la clase
    public function __construct() {
        $database = new Database();//Instanciamos la conexion
        $this->conn = $database->getConnection();//Asignamos la conexion a la variable previamente definida
    }

    public function readTable(){
        $query = "SELECT id_usuario,tipo_usuario,nombre_usuario,correo_usuario FROM rol_usuario r, usuario u WHERE r.id_rol = u.id_rol ORDER BY id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Funcion que muestra todos los registros de la tabla
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_usuario = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre_usuario, $correo_usuario,  $id_rol, $password) {
        $query = "INSERT INTO " . $this->table_name . " (nombre_usuario, correo_usuario, id_rol, password) VALUES (:nombre_usuario, :correo_usuario, :id_rol, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':correo_usuario', $correo_usuario);
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }

    public function update($id, $nombre_usuario, $correo_usuario, $password, $id_rol) {
        $query = "UPDATE " . $this->table_name . " SET nombre_usuario = :nombre_usuario, correo_usuario = :correo_usuario, password = :password, id_rol = :id_rol WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':correo_usuario', $correo_usuario);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_usuario = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /*public function deshabilitar($id,$estado){
        $query = "UPDATE " . $this->table_name . " SET estado_usuario = :estado WHERE id_usuario = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
    }*/

    public function getRolesUsuario() {
        $query = "SELECT id_rol, tipo_usuario FROM rol_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>