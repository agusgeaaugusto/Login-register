<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <!-- Enlaces a Bootstrap CSS y jQuery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            background: linear-gradient(to top, #fdbb2d, #2297c3);
            color: #2297c3;
            height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center mb-4">Lista de Usuarios</h2>

    <div class="input-group mb-3">
        <input type="text" class="form-control" id="buscarUsuario" placeholder="Buscar por nombre de usuario" aria-label="Buscar" aria-describedby="btnBuscar">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="btnBuscar">Buscar</button>
        </div>
    </div>

    <div class="card-body d-flex justify-content-end">
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarUsuarioModal">Agregar Usuario</button>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Usuario</th>
                        <th>Clave</th>
                        <th>Estado</th>
                        <th>Fecha de Creación</th>
                        <th>Fecha de Actualización</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-usuarios">
                    <!-- Aquí se mostrará el listado de usuarios en forma de tabla -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar usuario -->
<div class="modal fade" id="agregarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="agregarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarUsuarioModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="agregarUsuarioForm">
                    <div class="form-group">
                        <label for="nombre_usuario">Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="clave_usuario">Clave:</label>
                        <input type="password" class="form-control" id="clave_usuario" name="clave_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="estado_usuario">Estado:</label>
                        <select class="form-control" id="estado_usuario" name="estado_usuario" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_creado_usuario">Fecha de Creación:</label>
                        <input type="date" class="form-control" id="fecha_creado_usuario" name="fecha_creado_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_actualiza_usuario">Fecha de Actualización:</label>
                        <input type="date" class="form-control" id="fecha_actualiza_usuario" name="fecha_actualiza_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="rol_usuario">Rol:</label>
                        <input type="number" class="form-control" id="rol_usuario" name="rol_usuario" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar usuario -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editarUsuarioForm">
                    <input type="hidden" id="editar_id_usuario" name="id_usuario">
                    <div class="form-group">
                        <label for="editar_nombre_usuario">Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="editar_nombre_usuario" name="nombre_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_clave_usuario">Clave:</label>
                        <input type="password" class="form-control" id="editar_clave_usuario" name="clave_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_estado_usuario">Estado:</label>
                        <select class="form-control" id="editar_estado_usuario" name="estado_usuario" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editar_fecha_creado_usuario">Fecha de Creación:</label>
                        <input type="date" class="form-control" id="editar_fecha_creado_usuario" name="fecha_creado_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_fecha_actualiza_usuario">Fecha de Actualización:</label>
                        <input type="date" class="form-control" id="editar_fecha_actualiza_usuario" name="fecha_actualiza_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_rol_usuario">Rol:</label>
                        <input type="number" class="form-control" id="editar_rol_usuario" name="rol_usuario" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Función para cargar la lista de usuarios
        function cargarUsuarios() {
            $.ajax({
                url: 'register_usuario_bi.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var tablaUsuarios = '';
                    data.forEach(function(usuario) {
                        tablaUsuarios += '<tr>';
                        tablaUsuarios += '<td>' + usuario.id_usu + '</td>';
                        tablaUsuarios += '<td>' + usuario.nombre_usu + '</td>';
                        tablaUsuarios += '<td>' + '<input type="password" value="' + usuario.clave_usu + '" disabled>' + '</td>';
                        tablaUsuarios += '<td>' + (usuario.estado_usu ? 'Activo' : 'Inactivo') + '</td>';
                        tablaUsuarios += '<td>' + usuario.fecha_creado_usu + '</td>';
                        tablaUsuarios += '<td>' + usuario.fecha_actualiza_usu + '</td>';
                        tablaUsuarios += '<td>' + usuario.id_rol + '</td>';
                        tablaUsuarios += '<td>';
                        tablaUsuarios += '<button class="btn btn-warning btn-sm editar-usuario" data-id="' + usuario.id_usu + '">Editar</button>';
                        tablaUsuarios += '<button class="btn btn-danger btn-sm eliminar-usuario" data-id="' + usuario.id_usu + '">Eliminar</button>';
                        tablaUsuarios += '</td>';
                        tablaUsuarios += '</tr>';
                    });
                    $('#tabla-usuarios').html(tablaUsuarios);
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener usuarios:', status, error);
                    console.log(xhr.responseText);
                }
            });
        }

        // Cargar la lista de usuarios al cargar la página
        cargarUsuarios();

        // Función para procesar la eliminación de un usuario
        $('#tabla-usuarios').on('click', '.eliminar-usuario', function() {
            var idUsuarioEliminar = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                $.ajax({
                    url: 'eliminar.php?id=' + idUsuarioEliminar,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#tabla-usuarios').find('button[data-id="' + idUsuarioEliminar + '"]').closest('tr').remove();
                        } else {
                            console.error('Error al eliminar usuario:', response.message);
                        }
                        cargarUsuarios(); // Actualizar la lista de usuarios después de la eliminación
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar usuario:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        // Evento click para abrir el modal de edición y cargar los datos del usuario
        $(document).on('click', '.editar-usuario', function() {
            var idUsuarioEditar = $(this).data('id');
            $.ajax({
                url: 'get_usuario.php?id=' + idUsuarioEditar,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#editar_id_usuario').val(data.id_usu);
                    $('#editar_nombre_usuario').val(data.nombre_usu);
                    $('#editar_clave_usuario').val(data.clave_usu);
                    $('#editar_estado_usuario').val(data.estado_usu ? '1' : '0');
                    $('#editar_fecha_creado_usuario').val(data.fecha_creado_usu);
                    $('#editar_fecha_actualiza_usuario').val(data.fecha_actualiza_usu);
                    $('#editar_rol_usuario').val(data.id_rol);
                    $('#editarUsuarioModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener datos del usuario:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Función para procesar el formulario de edición de usuario
        $('#editarUsuarioForm').submit(function(e) {
            e.preventDefault();
            var idUsuario = $('#editar_id_usuario').val();
            var nombreUsuario = $('#editar_nombre_usuario').val();
            var claveUsuario = $('#editar_clave_usuario').val();
            var estadoUsuario = $('#editar_estado_usuario').val();
            var fechaCreadoUsuario = $('#editar_fecha_creado_usuario').val();
            var fechaActualizaUsuario = $('#editar_fecha_actualiza_usuario').val();
            var rolUsuario = $('#editar_rol_usuario').val();

            $.ajax({
                url: 'editar.php',
                method: 'POST',
                data: {
                    id_usu: idUsuario,
                    nombre_usu: nombreUsuario,
                    clave_usu: claveUsuario,
                    estado_usu: estadoUsuario,
                    fecha_creado_usu: fechaCreadoUsuario,
                    fecha_actualiza_usu: fechaActualizaUsuario,
                    id_rol: rolUsuario
                },
                success: function() {
                    cargarUsuarios();
                    $('#editarUsuarioModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error al editar usuario:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Capturar el evento de entrada en el campo de búsqueda
        $('#buscarUsuario').on('input', function() {
            var textoBusqueda = $(this).val().toLowerCase();
            $('#tabla-usuarios tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
            });
        });

        // Capturar el clic en el botón de búsqueda
        $('#btnBuscar').click(function() {
            var textoBusqueda = $('#buscarUsuario').val().toLowerCase();
            $('#tabla-usuarios tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
            });
        });

        // Función para procesar el formulario de agregar usuario
        $('#agregarUsuarioForm').submit(function(e) {
            e.preventDefault();
            var nombreUsuario = $('#nombre_usuario').val();
            var claveUsuario = $('#clave_usuario').val();
            var estadoUsuario = $('#estado_usuario').val();
            var fechaCreadoUsuario = $('#fecha_creado_usuario').val();
            var fechaActualizaUsuario = $('#fecha_actualiza_usuario').val();
            var rolUsuario = $('#rol_usuario').val();

            $.ajax({
                url: 'register_usuario_bi.php',
                method: 'POST',
                data: {
                    nombre_usu: nombreUsuario,
                    clave_usu: claveUsuario,
                    estado_usu: estadoUsuario,
                    fecha_creado_usu: fechaCreadoUsuario,
                    fecha_actualiza_usu: fechaActualizaUsuario,
                    id_rol: rolUsuario
                },
                success: function() {
                    cargarUsuarios();
                    $('#agregarUsuarioModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error al agregar usuario:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

<!-- Enlaces a Bootstrap JS y Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
