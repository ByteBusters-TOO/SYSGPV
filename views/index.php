<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | SYSGPV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\pages\login.css">
    <style>
        /* Estilo adicional para la marca de copyright */
        .copyright {
    position: fixed;
    bottom: 0;
    
    width: 100%;
    text-align: right;
    padding: 10px 10px;
    color: #6c757d; /* Color del texto */
}
    </style>
</head>

<body>
<div class="sidenav">
         <div class="login-main-text">
         <img src="..\src\image\Prototipo3.png" alt="Logo">
            <p>Sistema Informático para Gestión de proyectos de vivienda</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form role="form" method="POST">
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" id="username" placeholder="User Name" required>
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" id="password" placeholder="Password" required>
                  </div>
                  <button type="submit" class="btn btn-black" id="loginButton">Login</button>
                  <button type="submit" class="btn btn-secondary">Register</button>
               </form>
            </div>
         </div>
      </div>
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <script src="../js/login.js"></script>
   <!-- Div de copyright -->
    <div class="copyright">
        © 2024 | BYTE BUSTERS
    </div>
</body>
</html>
