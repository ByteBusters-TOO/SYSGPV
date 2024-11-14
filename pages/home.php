<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\style.css">
    <style>
       /* Estilo para el fondo centrado */
       body {
            background-image: url('../src/image/LogoHome.png'); /* Ruta de la imagen desde la raíz del servidor */
            background-size: contain;  /* Ajusta la imagen para que esté contenida */
            background-repeat: no-repeat; /* Evita que se repita la imagen */
            background-position: center; /* Centra la imagen */
            min-height: 100vh; /* Asegura que cubra toda la pantalla */
        }
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
   
    <?php include '..\partials\navbar.html'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © 2024 | BYTE BUSTERS
              </div>
            </div>
          </div>
        </div>
      </footer>
      
</body>
</html>