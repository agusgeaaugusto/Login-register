<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Roles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <h2 class="text-center mb-4">Lista de Roles</h2>
        
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="buscarRol" placeholder="Buscar por descripción de rol" aria-label="Buscar" aria-describedby="btnBuscar">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="btnBuscar">Buscar</button>
            </div>
        </div>
        
        <div class="card-body d-flex justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#agregarRolModal">Agregar Rol</button>
        </div>
        
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Descripción del Rol</th>
                            <th>Accesos</th>
                            <th>Creado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-roles">
                        <!-- Aquí se mostrará el listado de roles en forma de tabla -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para agregar rol -->
    <div class="modal fade" id="agregarRolModal" tabindex="-1" role="dialog" aria-labelledby="agregarRolModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarRolModalLabel">Agregar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="agregarRolForm">
                        <div class="form-group">
                            <label for="descripcion_rol">Descripción del Rol:</label>
                            <input type="text" class="form-control" id="descripcion_rol" name="descripcion_rol" required>
                        </div>
                        <div class="form-group">
                            <label for="accesos_rol">Accesos del Rol (separados por comas):</label>
                            <input type="text" class="form-control" id="accesos_rol" name="accesos_rol" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_rol">Fecha de Creación:</label>
                            <input type="date" class="form-control" id="fecha_rol" name="fecha_rol" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Rol</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar rol -->
    <div class="modal fade" id="editarRolModal" tabindex="-1" role="dialog" aria-labelledby="editarRolModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarRolModalLabel">Editar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarRolForm">
                        <input type="hidden" id="editar_id_rol" name="id_rol">
                        <div class="form-group">
                            <label for="editar_descripcion_rol">Descripción del Rol:</label>
                            <input type="text" class="form-control" id="editar_descripcion_rol" name="descripcion_rol" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Función para cargar la lista de roles
            function cargarRoles() {
                $.ajax({
                    url: 'register_rol_bi.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tablaRoles = '';
                        data.forEach(function(rol) {
                            tablaRoles += '<tr>';
                            tablaRoles += '<td>' + rol.id_rol + '</td>';
                            tablaRoles += '<td>' + rol.descripcion_rol + '</td>';
                            tablaRoles += '<td>' + rol.accesos_rol + '</td>';
                            tablaRoles += '<td>' + rol.creado_rol + '</td>';
                            tablaRoles += '<td>' + rol.fecha_rol + '</td>';
                            tablaRoles += '<td>';
                            tablaRoles += '<button class="btn btn-warning btn-sm editar-rol" data-id="' + rol.id_rol + '">Editar</button>';
                            tablaRoles += '<button class="btn btn-danger btn-sm eliminar-rol" data-id="' + rol.id_rol + '">Eliminar</button>';
                            tablaRoles += '</td>';
                            tablaRoles += '</tr>';
                        });
                        $('#tabla-roles').html(tablaRoles);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener roles:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            }

            // Cargar la lista de roles al cargar la página
            cargarRoles();

            // Procesar el formulario de agregar rol
            $('#agregarRolForm').submit(function(e) {
                e.preventDefault();
                var descripcionRol = $('#descripcion_rol').val();
                var accesosRol = $('#accesos_rol').val().split(',');
                var fechaRol = $('#fecha_rol').val();
                $.ajax({
                    url: 'register_rol_bi.php',
                    method: 'POST',
                    data: {
                        descripcion_rol: descripcionRol,
                        accesos_rol: accesosRol,
                        fecha_rol: fechaRol
                    },
                    success: function() {
                        $('#agregarRolModal').modal('hide');
                        $('#descripcion_rol').val('');
                        $('#accesos_rol').val('');
                        $('#fecha_rol').val('');
                        cargarRoles();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al agregar rol:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

            // Procesar el formulario de editar rol
            $('#editarRolForm').submit(function(e) {
                e.preventDefault();
                var idRol = $('#editar_id_rol').val();
                var nuevaDescripcionRol = $('#editar_descripcion_rol').val();
                $.ajax({
                    url: 'editar.php',
                    method: 'POST',
                    data: {
                        id_rol: idRol,
                        nueva_descripcion_rol: nuevaDescripcionRol
                    },
                    success: function() {
                        cargarRoles();
                        $('#editarRolModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al editar rol:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

            // Evento para abrir el modal de editar rol y cargar los datos del rol
            $(document).on('click', '.editar-rol', function() {
                var idRolEditar = $(this).data('id');
                $.ajax({
                    url: 'get_rol.php?id=' + idRolEditar,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#editar_id_rol').val(data.id_rol);
                        $('#editar_descripcion_rol').val(data.descripcion_rol);
                        $('#editarRolModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener datos del rol:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

          // Procesar la eliminación de un rol
$('#tabla-roles').on('click', '.eliminar-rol', function() {
    var idRolEliminar = $(this).data('id');
    if (confirm('¿Estás seguro de que deseas eliminar este rol?')) {
        $.ajax({
            url: 'eliminar.php',
            method: 'GET', // Cambiamos el método a GET para pasar el ID como un parámetro en la URL
            data: {
                eliminar: idRolEliminar // Enviamos el ID del rol que se desea eliminar como 'eliminar'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#tabla-roles').find('button[data-id="' + idRolEliminar + '"]').closest('tr').remove();
                } else {
                    console.error('Error al eliminar rol:', response.message);
                }
                cargarRoles(); // Volvemos a cargar la lista de roles después de la eliminación
            },
            error: function(xhr, status, error) {
                console.error('Error al eliminar rol:', status, error);
                console.log(xhr.responseText);
            }
        });
    }
});


            // Funcionalidad para filtrar roles
            $('#buscarRol').on('input', function() {
                var textoBusqueda = $(this).val().toLowerCase();
                $('#tabla-roles tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
                });
            });
        });
        $(document).ready(function() {
    // Función para cargar la lista de roles
    function cargarRoles() {
        // Tu código para cargar roles aquí
    }

    // Cargar la lista de roles al cargar la página
    cargarRoles();

    // Establecer la fecha actual al cargar la página
    var fechaActual = new Date().toISOString().slice(0,10);
    $('#fecha_rol').val(fechaActual);

    // Resto de tu código aquí...
});
    </script>
</body>
</html>
