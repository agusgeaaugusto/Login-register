<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cargos</title>
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
    <h2 class="text-center mb-4">Lista de Cargos</h2>

    <div class="input-group mb-3">
        <input type="text" class="form-control" id="buscarCargo" placeholder="Buscar por nombre de cargo" aria-label="Buscar" aria-describedby="btnBuscar">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="btnBuscar">Buscar</button>
        </div>
    </div>

    <div class="card-body d-flex justify-content-end">
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarCargoModal">Agregar Cargo</button>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Cargo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-cargos">
                    <!-- Aquí se mostrará el listado de cargos en forma de tabla -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar cargo -->
<div class="modal fade" id="agregarCargoModal" tabindex="-1" role="dialog" aria-labelledby="agregarCargoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCargoModalLabel">Agregar Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="agregarCargoForm">
                    <div class="form-group">
                        <label for="nombre_cargo">Nombre del Cargo:</label>
                        <input type="text" class="form-control" id="nombre_cargo" name="nombre_cargo" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Cargo</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar cargo -->
<div class="modal fade" id="editarCargoModal" tabindex="-1" role="dialog" aria-labelledby="editarCargoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCargoModalLabel">Editar Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editarCargoForm">
                    <input type="hidden" id="editar_id_cargo" name="id_cargo">
                    <div class="form-group">
                        <label for="editar_nombre_cargo">Nombre del Cargo:</label>
                        <input type="text" class="form-control" id="editar_nombre_cargo" name="nombre_cargo" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Función para cargar la lista de cargos
        function cargarCargos() {
            $.ajax({
                url: 'register_cargo_bi.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var tablaCargos = '';
                    data.forEach(function(cargo) {
                        tablaCargos += '<tr>';
                        tablaCargos += '<td>' + cargo.id_cargo + '</td>';
                        tablaCargos += '<td>' + cargo.nombre_cargo + '</td>';
                        tablaCargos += '<td>';
                        tablaCargos += '<button class="btn btn-warning btn-sm editar-cargo" data-id="' + cargo.id_cargo + '">Editar</button>';
                        tablaCargos += '<button class="btn btn-danger btn-sm eliminar-cargo" data-id="' + cargo.id_cargo + '">Eliminar</button>';
                        tablaCargos += '</td>';
                        tablaCargos += '</tr>';
                    });
                    $('#tabla-cargos').html(tablaCargos);
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener cargos:', status, error);
                    console.log(xhr.responseText);
                }
            });
        }

        // Cargar la lista de cargos al cargar la página
        cargarCargos();

        // Función para procesar la eliminación de un cargo
        $('#tabla-cargos').on('click', '.eliminar-cargo', function() {
            var idCargoEliminar = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar este cargo?')) {
                $.ajax({
                    url: 'eliminar.php?eliminar=' + idCargoEliminar,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#tabla-cargos').find('button[data-id="' + idCargoEliminar + '"]').closest('tr').remove();
                        } else {
                            console.error('Error al eliminar cargo:', response.message);
                        }
                        cargarCargos(); // Actualizar la lista de cargos después de la eliminación

                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar cargo:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        // Evento click para abrir el modal de edición y cargar los datos del cargo
        $(document).on('click', '.editar-cargo', function() {
            var idCargoEditar = $(this).data('id');
            $.ajax({
                url: 'get_cargo.php?id=' + idCargoEditar,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#editar_id_cargo').val(data.id_cargo);
                    $('#editar_nombre_cargo').val(data.nombre_cargo);
                    $('#editarCargoModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener datos del cargo:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Función para procesar el formulario de edición de cargo
        $('#editarCargoForm').submit(function(e) {
            e.preventDefault();
            var idCargo = $('#editar_id_cargo').val();
            var nuevoNombreCargo = $('#editar_nombre_cargo').val();

            $.ajax({
                url: 'editar.php',
                method: 'POST',
                data: {
                    id_cargo: idCargo,
                    nuevo_nombre_cargo: nuevoNombreCargo
                },
                success: function() {
                    cargarCargos();
                    $('#editarCargoModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error al editar cargo:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Capturar el evento de entrada en el campo de búsqueda
        $('#buscarCargo').on('input', function() {
            var textoBusqueda = $(this).val().toLowerCase();
            $('#tabla-cargos tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
            });
        });

        // Capturar el clic en el botón de búsqueda
        $('#btnBuscar').click(function() {
            var textoBusqueda = $('#buscarCargo').val().toLowerCase();
            $('#tabla-cargos tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
            });
        });

        // Función para procesar el formulario de agregar cargo
        $('#agregarCargoForm').submit(function(e) {
            e.preventDefault();
            var nombreCargo = $('#nombre_cargo').val();

            $.ajax({
                url: 'register_cargo_bi.php',
                method: 'POST',
                data: {
                    nombre_cargo: nombreCargo
                },
                success: function() {
                    cargarCargos();
                    $('#agregarCargoModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error al agregar cargo:', status, error);
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
