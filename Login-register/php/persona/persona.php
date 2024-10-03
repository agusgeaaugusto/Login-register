<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Personas</title>
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
    <h2 class="text-center mb-4">Lista de Personas</h2>

    <div class="input-group mb-3">
        <input type="text" class="form-control" id="buscarPersona" placeholder="Buscar por nombre de persona" aria-label="Buscar" aria-describedby="btnBuscar">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="btnBuscar">Buscar</button>
        </div>
    </div>

    <div class="card-body d-flex justify-content-end">
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarPersonaModal">Agregar Persona</button>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-personas">
                    <!-- Aquí se mostrará el listado de personas en forma de tabla -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar persona -->
<div class="modal fade" id="agregarPersonaModal" tabindex="-1" role="dialog" aria-labelledby="agregarPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarPersonaModalLabel">Agregar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="agregarPersonaForm">
                    <div class="form-group">
                        <label for="nombre_per">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_per" name="nombre_per" required>
                    </div>
                    <div class="form-group">
                        <label for="cedula_per">Cédula:</label>
                        <input type="text" class="form-control" id="cedula_per" name="cedula_per" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Persona</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar persona -->
<div class="modal fade" id="editarPersonaModal" tabindex="-1" role="dialog" aria-labelledby="editarPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarPersonaModalLabel">Editar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editarPersonaForm">
                    <input type="hidden" id="editar_id_per" name="id_per">
                    <div class="form-group">
                        <label for="editar_nombre_per">Nombre:</label>
                        <input type="text" class="form-control" id="editar_nombre_per" name="nombre_per" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_cedula_per">Cédula:</label>
                        <input type="text" class="form-control" id="editar_cedula_per" name="cedula_per" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Función para cargar la lista de personas
        function cargarPersonas() {
            $.ajax({
                url: 'register_persona_bi.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var tablaPersonas = '';
                    data.forEach(function(persona) {
                        tablaPersonas += '<tr>';
                        tablaPersonas += '<td>' + persona.id_per + '</td>';
                        tablaPersonas += '<td>' + persona.nombre_per + '</td>';
                        tablaPersonas += '<td>' + persona.cedula_per + '</td>';
                        tablaPersonas += '<td>';
                        tablaPersonas += '<button class="btn btn-warning btn-sm editar-persona" data-id="' + persona.id_per + '">Editar</button>';
                        tablaPersonas += '<button class="btn btn-danger btn-sm eliminar-persona" data-id="' + persona.id_per + '">Eliminar</button>';
                        tablaPersonas += '</td>';
                        tablaPersonas += '</tr>';
                    });
                    $('#tabla-personas').html(tablaPersonas);
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener personas:', status, error);
                    console.log(xhr.responseText);
                }
            });
        }

        // Cargar la lista de personas al cargar la página
        cargarPersonas();

        // Función para procesar la eliminación de una persona
        $('#tabla-personas').on('click', '.eliminar-persona', function() {
            var idPersonaEliminar = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar esta persona?')) {
                $.ajax({
                    url: 'eliminar.php?eliminar=' + idPersonaEliminar,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#tabla-personas').find('button[data-id="' + idPersonaEliminar + '"]').closest('tr').remove();
                        } else {
                            console.error('Error al eliminar persona:', response.message);
                        }
                        cargarPersonas(); // Actualizar la lista de personas después de la eliminación
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar persona:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        // Evento click para abrir el modal de edición y cargar los datos de la persona
        $(document).on('click', '.editar-persona', function() {
            var idPersonaEditar = $(this).data('id');
            $.ajax({
                url: 'get_persona.php?id=' + idPersonaEditar,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#editar_id_per').val(data.id_per);
                    $('#editar_nombre_per').val(data.nombre_per);
                    $('#editar_cedula_per').val(data.cedula_per);
                    $('#editarPersonaModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener datos de la persona:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Función para procesar el formulario de edición de persona
        $('#editarPersonaForm').submit(function(e) {
            e.preventDefault();
            var idPersona = $('#editar_id_per').val();
            var nuevoNombrePer = $('#editar_nombre_per').val();
            var nuevaCedulaPer = $('#editar_cedula_per').val();

            $.ajax({
                url: 'editar.php',
                method: 'POST',
                data: {
                    id_per: idPersona,
                    nuevo_nombre_per: nuevoNombrePer,
                    nueva_cedula_per: nuevaCedulaPer
                },
                success: function() {
                    cargarPersonas();
                    $('#editarPersonaModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error al editar persona:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Capturar el evento de entrada en el campo de búsqueda
        $('#buscarPersona').on('input', function() {
            var textoBusqueda = $(this).val().toLowerCase();
            $('#tabla-personas tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
            });
        });

        // Capturar el clic en el botón de búsqueda
        $('#btnBuscar').click(function() {
            var textoBusqueda = $('#buscarPersona').val().toLowerCase();
            $('#tabla-personas tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
            });
        });

        // Función para procesar el formulario de agregar persona
        $('#agregarPersonaForm').submit(function(e) {
            e.preventDefault();
            var nombrePersona = $('#nombre_per').val();
            var cedulaPersona = $('#cedula_per').val();

            $.ajax({
                url: 'register_persona_bi.php',
                method: 'POST',
                data: {
                    nombre_per: nombrePersona,
                    cedula_per: cedulaPersona
                },
                success: function() {
                    cargarPersonas();
                    $('#agregarPersonaModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error al agregar persona:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

<!-- Enlaces a Bootstrap JS y Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
