<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
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
    <?php include '../partials/navbar-register.html'; ?>

    <div class="container mt-5">
        <h2>Registrar Usuario</h2>
        
        <!-- Contenedor de mensaje -->
        <div class="mensaje my-4 margen-form"></div>

        <form role="form" class="margen-form" id="RegistrarUsuarioForm">

            <div class="mb-2">
                  <label class="form-label" for="nombre_usuario">Nombre:</label>
                  <input type="text" class="form-control border" id="nombre_usuario" name="nombre_usuario" required>
                </div>
            <div class="mb-2">
                  <label class="form-label" for="correo_usuario">Correo Electrónico:</label>
                  <input type="text" class="form-control border" id="correo_usuario" name="correo_usuario" required>
                </div>
                <div class="mb-2">
                  <label class="form-label" for="u_rol_usuario">Rol Usuario: </label>
                  <select name="tipo_usuario" id="u_rol_usuario" class="form-control border">
                  </select>
                </div>
                <div class="mb-2">
                  <label class="form-label" for="upassword">Contraseña: </label>
                  <input type="password" class="form-control border" id="upassword" required>
                </div>
                <div class="mb-2">
                  <label class="form-label" for="confcontrasenia">Confirmar Contraseña:</label>
                  <input type="password" class="form-control border" id="confcontrasenia" required>
                </div>
                <div class="ms-auto">
                    <button type="button" href="#" id="actionUsuarioButton" class="btn btn-outline-success">Guardar</button>
                    <a href="../index.php" class="btn btn-outline-secondary">Cancelar</a>
                </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/usuario.js"></script> <!-- Referencia al archivo JS externo -->
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

<!-- Modal de Confirmación de Registro -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmRegisterModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmRegisterModalLabel">Confirmar Registro</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro de que desea registrar este usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="confirmRegisterButton">Registrar</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
