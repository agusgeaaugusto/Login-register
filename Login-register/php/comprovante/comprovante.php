<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Comprovantes</title>
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
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Lista de Comprovantes</h2>

        <div class="input-group mb-3">
            <input type="text" class="form-control" id="buscarComprovante" placeholder="Buscar por nombre de comprovante" aria-label="Buscar" aria-describedby="btnBuscar">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="btnBuscar">Buscar</button>
            </div>
        </div>

        <div class="card-body d-flex justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#agregarComprovanteModal">Agregar Comprovante</button>
        </div>
    
    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Comprovante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-comprovantes">
                    <!-- Aquí se mostrará el listado de comprovantes en forma de tabla -->
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Modal para agregar comprovante -->
    <div class="modal fade" id="agregarComprovanteModal" tabindex="-1" role="dialog" aria-labelledby="agregarComprovanteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarComprovanteModalLabel">Agregar Comprovante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="agregarComprovanteForm">
                        <div class="form-group">
                            <label for="nombre_comprovante">Nombre del Comprovante:</label>
                            <input type="text" class="form-control" id="nombre_comprovante" name="nombre_comprovante" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Comprovante</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar comprovante -->
    <div class="modal fade" id="editarComprovanteModal" tabindex="-1" role="dialog" aria-labelledby="editarComprovanteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarComprovanteModalLabel">Editar Comprovante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarComprovanteForm">
                        <input type="hidden" id="editar_id_comprovante" name="id_comprovante">
                        <div class="form-group">
                            <label for="editar_nombre_comprovante">Nombre del Comprovante:</label>
                            <input type="text" class="form-control" id="editar_nombre_comprovante" name="nombre_comprovante" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Función para cargar la lista de comprovantes
            function cargarComprovantes() {
                $.ajax({
                    url: 'register_comprovante_bi.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tablaComprovantes = '';
                        data.forEach(function(comprovante) {
                            tablaComprovantes += '<tr>';
                            tablaComprovantes += '<td>' + comprovante.id_comprovante + '</td>';
                            tablaComprovantes += '<td>' + comprovante.nombre_comprovante + '</td>';
                            tablaComprovantes += '<td>';
                            tablaComprovantes += '<button class="btn btn-warning btn-sm editar-comprovante" data-id="' + comprovante.id_comprovante + '">Editar</button>';
                            tablaComprovantes += '<button class="btn btn-danger btn-sm eliminar-comprovante" data-id="' + comprovante.id_comprovante + '">Eliminar</button>';
                            tablaComprovantes += '</td>';
                            tablaComprovantes += '</tr>';
                        });

                        $('#tabla-comprovantes').html(tablaComprovantes);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener comprovantes:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            }

            // Cargar la lista de comprovantes al cargar la página
            cargarComprovantes();

            // Procesar formulario de agregar comprobante
$('#agregarComprovanteForm').submit(function(event) {
    // Evitar que el formulario se envíe de forma tradicional
    event.preventDefault();
    
    // Obtener el nombre del comprobante del campo de entrada
    var nombreComprovante = $('#nombre_comprovante').val();

    // Enviar una solicitud AJAX al servidor
    $.ajax({
        url: 'register_comprovante_bi.php', // URL del script PHP para agregar comprobante
        method: 'POST', // Método HTTP POST para enviar datos al servidor
        data: { nombre_comprovante: nombreComprovante }, // Datos a enviar al servidor
        success: function(response) { // Función que se ejecutará si la solicitud es exitosa
            // Recargar la lista de comprobantes
            cargarComprovantes();
            // Cerrar el modal de agregar comprobante
            $('#agregarComprovanteModal').modal('hide');
        },
        error: function(xhr, status, error) { // Función que se ejecutará si hay un error en la solicitud
            console.error('Error al agregar comprobante:', status, error);
            console.log(xhr.responseText);
        }
    });
});

            // Procesar formulario de editar comprovante
            $('#editarComprovanteForm').submit(function(e) {
                e.preventDefault();
                var idComprovante = $('#editar_id_comprovante').val();
                var nuevoNombreComprovante = $('#editar_nombre_comprovante').val();

                $.ajax({
                    url: 'editar.php',
                    method: 'POST',
                    data: {
                        id_comprovante: idComprovante,
                        nuevo_nombre_comprovante: nuevoNombreComprovante
                    },
                    success: function() {
                        cargarComprovantes();
                        $('#editarComprovanteModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al editar comprovante:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

            // Procesar eliminación de comprovante
            $('#tabla-comprovantes').on('click', '.eliminar-comprovante', function() {
                var idComprovanteEliminar = $(this).data('id');
                if (confirm('¿Estás seguro de que deseas eliminar este comprovante?')) {
                    $.ajax({
                        url: 'eliminar.php?eliminar=' + idComprovanteEliminar,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#tabla-comprovantes').find('button[data-id="' + idComprovanteEliminar + '"]').closest('tr').remove();
                                cargarComprovantes();
                            } else {
                                console.error('Error al eliminar comprovante:', response.message);
                            }
                            cargarComprovantes();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error al eliminar comprovante:', status, error);
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            // Cargar el modal de edición de comprovante
            $(document).on('click', '.editar-comprovante', function() {
                var idComprovanteEditar = $(this).data('id');
                $.ajax({
                    url: 'get_comprovante.php?id=' + idComprovanteEditar,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#editar_id_comprovante').val(data.id_comprovante);
                        $('#editar_nombre_comprovante').val(data.nombre_comprovante);
                        $('#editarComprovanteModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener datos del comprovante:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

            // Capturar el evento de entrada en el campo de búsqueda
            $('#buscarComprovante').on('input', function() {
                var textoBusqueda = $(this).val().toLowerCase();

                // Filtrar los comprovantes en la tabla
                $('#tabla-comprovantes tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
                });
            });

            // Capturar el clic en el botón de búsqueda
            $('#btnBuscar').click(function() {
                var textoBusqueda = $('#buscarComprovante').val().toLowerCase();

                // Filtrar los comprovantes en la tabla
                $('#tabla-comprovantes tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
                });
            });
        });
    </script>

    <!-- Enlace a Bootstrap JS y Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
