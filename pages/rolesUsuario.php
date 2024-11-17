<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Roles Usuario | SYSGPV</title>
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
        <?php
            include '../partials/navbar.html';
        ?>
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Configuración de Roles</h2>
            </div>
            <!-- Botón para abrir el modal de crear usuario -->
            <div class="text-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTipoUsuarioModal">
                    <i class="bi bi-plus-circle"></i> Agregar Tipo de Rol
                </button>
            </div>

            <!-- Modal para Crear/Editar Tipo de Usuario -->
            <div class="modal fade" id="createTipoUsuarioModal" tabindex="-1" aria-labelledby="createTipoUsuarioModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTipoUsuarioModalLabel">Agregar Rol</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="tipoUsuarioForm">
                                <div class="mb-3">
                                    <label for="tipo_usuario" class="form-label">Nombre del Rol:</label>
                                    <input type="text" class="form-control" id="tipo_usuario" 
                                        placeholder="Ingrese el nombre del rol" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion_usuario" class="form-label">Descripción:</label>
                                    <textarea class="form-control" id="descripcion_usuario" 
                                            rows="3" placeholder="Ingrese la descripción" required></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="actionTipoUsuarioButton">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped" id="tipoUsuarioTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOMBRE TIPO ROL</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DESCRIPCIÓN</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="body-t"><!-- CARGA DE TABLA --></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <footer class="footer py-4">
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

            <!-- Modal de Confirmación de Eliminación -->
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro de que desea eliminar este tipo de usuario?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <script src="../js/rol.js"></script>

            <!-- Modal de Mensajes -->
            <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="messageModalLabel">Mensaje</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="messageModalBody">
                            <!-- Contenido del mensaje -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>