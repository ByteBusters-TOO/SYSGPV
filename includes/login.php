<?php
// Verificamos que el formulario ha sido enviado usando el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturamos los valores del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Aquí puedes agregar la lógica de autenticación
    // Por ejemplo, verificar si el usuario y la contraseña coinciden con una base de datos

    // Supongamos que la autenticación es exitosa
    if ($username === 'admin' && $password === '1234') {
        // Si el login es exitoso, redirigimos al usuario a la página de inicio
        header("Location: ..\pages\home.php");
        exit(); // Es importante salir del script después de usar header para evitar que se ejecute más código
    } else {
        // Si el login falla, redirigimos de nuevo a la página de login con un mensaje de error
        header("Location: login.php?error=1");
        exit();
    }
}
?>
