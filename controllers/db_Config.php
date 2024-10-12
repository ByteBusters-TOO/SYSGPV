<?php
    /*  CLASE PARA LA CONEXION DEL PROYECTO CON LA BASE DE DATOS*/
    class Database { 
        private $host = 'localhost'; //Variable que posee el nombre del servidor
        private $db_name = 'sysgpv_db'; //Variable que posee el nombre de la base de datos
        private $username = 'root'; //Variable que posee el usuario para el ingreso al gestor de base de datos
        private $password = ''; //Variable que posee la contraseña para el ingreso al gestor de base de datos
        public $conn; //Variable que poseera la cadena conexion

        //Funcion para obtener la conexion
        public function getConnection() {
            $this->conn = null;//Inciacializamos la variable como nula
            try {
                //Asignamos la cadena conexion a la variable conn
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                //Se establece el modo de error a excepciones
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) { //Si hay algun errror en los datos o conexion
                echo "Connection error: " . $exception->getMessage();//Imprimimos un mensaje de error
            }
            return $this->conn;//Retornamos el contenido de la variable conn
        }
    }
?>