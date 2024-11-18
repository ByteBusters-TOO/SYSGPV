<?php
session_start();// Inicia una nueva sesión o reanuda la sesión existente
require_once '../models/mtoindex.php';// Incluye el archivo que contiene la definición de la clase 'Login'

header('Content-Type: application/json');// Establece el tipo de contenido de la respuesta como JSON

$response = array();//Inicializa un array para almacenar la respuesta

try {

    //Consultamos que tipo de metodo optiene el servidor
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //asignamos a una variable el dato enviado y consultamos a la vez si esta vacio o no
        $correo_usuario = isset($_POST['username']) ? $_POST['username'] : '';
        $contra = isset($_POST['password']) ? $_POST['password'] : '';

        $userModel = new mtoindex();//Instanciamos el modelo del index
        $user = $userModel->authenticate($correo_usuario, $contra); //Mandamos los datos a la autenticación

        //Consultamos que tipo de respuesta se obtuvo del metodo
        if ($user) {
            error_log($user['id_rol']);
            $_SESSION['user'] = $user['correo_usuario'];//Asignamos el correo como usuario de session
            $_SESSION['user_id'] = $user['id_usuario'];//Asignamos el ID del usuario para poder ocuparla en el navegador para la gestión
            $_SESSION['tpu'] = $user['id_rol'];//Asignamos el id del rol usuario a una variable de sesion
            if ($user['id_rol'] == 1) {//Si es administrador
                //Redirigimos al usuario a su vista
                $response = ['status' => 'success', 'redirect' => './pages/home.php'];
            } elseif ($user['id_rol'] == 2) {//Si es dueño
                //Redirigimos al usuario a su vista
                $response = ['status' => 'success', 'redirect' => './pages/homeDueño.php'];
            }
        } else {//Si el correo o la contraseña son incorrectos mostramos un mensaje de error
            throw new Exception('Usuario o contraseña incorrectos.' .$user. " ERROR");
        }
    } else {//Si hay algun error en el servidore mostramos algun error
        throw new Exception('Método no permitido.');
    }
} catch (Exception $e) {//Captura de errores
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

echo json_encode($response);//Revolvemos la respuesta codificada como JSON
?>