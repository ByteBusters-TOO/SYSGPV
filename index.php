<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | SYSGPV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
         margin: 0;
         padding: 0;
         font-family: "Lato", sans-serif;
         background-color: #f8f9fa;
         height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .login-container {
         width: 100%;
         height: 100%;
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
         position: relative;
         padding-top: 60px; /* Espacio entre la imagen y el borde superior */
      }

      .login-modal {
         width: 100%;
         max-width: 400px;
         padding: 30px;
         background: #ffffff;
         border-radius: 10px;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
         text-align: center;
         position: relative;
         z-index: 1;
         margin-top: 70px;
      }

      .login-logo {
         width: 300px; /* Tamaño de la imagen */
         height: auto;
         position: absolute;
         top: -50px; /* Ajusta la posición vertical de la imagen */
         left: 50%;
         transform: translateX(-50%);
         z-index: 2;
      }

      .form-control {
         border-radius: 5px;
         border: 1px solid #ced4da;
         padding: 10px;
         font-size: 1rem;
      }

      

      .copyright {
         text-align: center;
         font-size: 0.85rem;
         color: #6c757d;
         margin-top: 20px;
      }

      body::before {
         content: "";
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: radial-gradient(circle, rgba(255, 255, 255, 0.8), rgba(240, 240, 240, 1));
         z-index: 0;
      }

    </style>
</head>

<body>
<div class="login-container">
    <img src="src/image/Prototipo2.png" alt="Logo" class="login-logo">
    <div class="login-modal">
        <form role="form" method="POST">
            <div class="form-group mb-3">
                <label for="username" class="form-label">Correo Electrónico</label>
                <input type="text" class="form-control" id="username" placeholder="Nombre de Usuario" aria-label="Nombre de Usuario" autocomplete="username" required>
            </div>
            <div class="form-group mb-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="Contraseña" aria-label="Contraseña" autocomplete="current-password" required>
            </div>
            <button type="button" class="btn btn-outline-primary" id="loginButton">Iniciar Sesión</button>
            <p class="mt-4 text-sm text-center">
                ¿No tienes una cuenta? 
                <a href="pages/usuario.php" class="text-primary">Crear cuenta</a>
            </p>
        </form>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="js\login.js"></script>
    <div class="copyright">
        © 2024 | BYTE BUSTERS
    </div>
</div>

</body>

</html>
