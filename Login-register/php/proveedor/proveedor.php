<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proveedores</title>
    <!-- Enlaces a Bootstrap CSS y jQuery -->
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

        /* Puedes agregar estilos adicionales para otros elementos según sea necesario */
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Lista de Proveedores</h2>

        <div class="input-group mb-3">
            <input type="text" class="form-control" id="buscarProveedor" placeholder="Buscar por nombre de Proveedor" aria-label="Buscar" aria-describedby="btnBuscar">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="btnBuscar">Buscar</button>
            </div>
        </div>

        <div class="card-body d-flex justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#agregarProveedorModal">Agregar Proveedor</button>
        </div>
    

    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>RUC</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-proveedor">
                    <!-- Aquí se mostrará el listado de proveedores en forma de tabla -->
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- Modal para agregar proveedor -->
    <div class="modal fade" id="agregarProveedorModal" tabindex="-1" role="dialog" aria-labelledby="agregarProveedorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarProveedorModalLabel">Agregar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="agregarProveedorForm">
                        <div class="form-group">
                            <label for="nombre_prove">Nombre:</label>
                            <input type="text" class="form-control" id="nombre_prove" name="nombre_prove" required>
                        </div>
                        <div class="form-group">
                            <label for="ruc_prove">RUC:</label>
                            <input type="number" class="form-control" id="ruc_prove" name="ruc_prove" required>
                            <div id="alertRuc" class="alert alert-danger d-none" role="alert">Por favor ingrese un RUC válido.</div>
                        </div>
                        <div class="form-group">
                            <label for="direccion_prove">Dirección:</label>
                            <input type="text" class="form-control" id="direccion_prove" name="direccion_prove" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono_prove">Teléfono:</label>
                            <input type="tel" class="form-control" id="telefono_prove" name="telefono_prove" required>
                            <div id="alertTelefono" class="alert alert-danger d-none" role="alert">Por favor ingrese un número de teléfono válido.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Proveedor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar proveedor -->
    <div class="modal fade" id="editarProveedorModal" tabindex="-1" role="dialog" aria-labelledby="editarProveedorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarProveedorModalLabel">Editar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarProveedorForm">
                        <input type="hidden" id="editar_id_proveedor" name="id_proveedor">
                        <div class="form-group">
                            <label for="nombre_prove_edit">Nombre:</label>
                            <input type="text" class="form-control" id="nombre_prove_edit" name="nombre_prove" required>
                        </div>
                        <div class="form-group">
                            <label for="ruc_prove_edit">RUC:</label>
                            <input type="number" class="form-control" id="ruc_prove_edit" name="ruc_prove" required>
                            <div id="alertRucEdit" class="alert alert-danger d-none" role="alert">Por favor ingrese un RUC válido.</div>
                        </div>
                        <div class="form-group">
                            <label for="direccion_prove_edit">Dirección:</label>
                            <input type="text" class="form-control" id="direccion_prove_edit" name="direccion_prove" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono_prove_edit">Teléfono:</label>
                            <input type="tel" class="form-control" id="telefono_prove_edit" name="telefono_prove" required>
                            <div id="alertTelefonoEdit" class="alert alert-danger d-none" role="alert">Por favor ingrese un número de teléfono válido.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Función para cargar la lista de proveedores
            function cargarProveedores() {
                $.ajax({
                    url: 'register_proveedor_bi.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tablaProveedores = '';
                        data.forEach(function(proveedor) {
                            tablaProveedores += '<tr>';
                            tablaProveedores += '<td>' + proveedor.id_proveedor + '</td>';
                            tablaProveedores += '<td>' + proveedor.nombre_prove + '</td>';
                            tablaProveedores += '<td>' + proveedor.ruc_prove + '</td>';
                            tablaProveedores += '<td>' + proveedor.direccion_prove + '</td>';
                            tablaProveedores += '<td>' + proveedor.telefono_prove + '</td>';
                            tablaProveedores += '<td>';
                            tablaProveedores += '<button class="btn btn-warning btn-sm editar-proveedor" data-id="' + proveedor.id_proveedor + '">Editar</button>';
                            tablaProveedores += '<button class="btn btn-danger btn-sm eliminar-proveedor" data-id="' + proveedor.id_proveedor + '">Eliminar</button>';
                            tablaProveedores += '</td>';
                            tablaProveedores += '</tr>';
                        });
                        $('#tabla-proveedor').html(tablaProveedores);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener proveedores:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            }

            // Cargar la lista de proveedores al cargar la página
            cargarProveedores();

            // Función para procesar la eliminación de un proveedor
            $('#tabla-proveedor').on('click', '.eliminar-proveedor', function() {
                var idProveedorEliminar = $(this).data('id');
                if (confirm('¿Estás seguro de que deseas eliminar este proveedor?')) {
                    $.ajax({
                        url: 'eliminar.php?id=' + idProveedorEliminar,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#tabla-proveedor').find('button[data-id="' + idProveedorEliminar + '"]').closest('tr').remove();
                            } else {
                                console.error('Error al eliminar proveedor:', response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error al eliminar proveedor:', status, error);
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            // Evento click para abrir el modal de edición y cargar los datos del proveedor
            $(document).on('click', '.editar-proveedor', function() {
                var idProveedorEditar = $(this).data('id');
                $.ajax({
                    url: 'get_proveedor.php?id=' + idProveedorEditar,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#editar_id_proveedor').val(data.id_proveedor);
                        $('#nombre_prove_edit').val(data.nombre_prove);
                        $('#ruc_prove_edit').val(data.ruc_prove);
                        $('#direccion_prove_edit').val(data.direccion_prove);
                        $('#telefono_prove_edit').val(data.telefono_prove);
                        $('#editarProveedorModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener datos del proveedor:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

            // Función para procesar el formulario de edición de proveedor
            $('#editarProveedorForm').submit(function(e) {
                e.preventDefault();
                var idProveedor = $('#editar_id_proveedor').val();
                var nombre = $('#nombre_prove_edit').val();
                var ruc = $('#ruc_prove_edit').val();
                var direccion = $('#direccion_prove_edit').val();
                var telefono = $('#telefono_prove_edit').val();
                 // Validar RUC y teléfono como numéricos
    if(isNaN(ruc)) {
        $('#alertRucEdit').removeClass('d-none');
        return;
    }
    if(isNaN(telefono)) {
        $('#alertTelefonoEdit').removeClass('d-none');
        return;
    }

    // Verificar si el RUC ya existe en la lista de proveedores antes de enviar el formulario
    var rucExiste = false;
    $('#tabla-proveedor tr').each(function() {
        var idProveedorActual = $(this).find('td:eq(0)').text(); // ID del proveedor en esta fila
        var rucProveedor = $(this).find('td:eq(2)').text(); // RUC del proveedor en esta fila
        if (idProveedorActual != idProveedor && rucProveedor == ruc) {
            rucExiste = true;
            return false; // Salir del bucle each si se encuentra un RUC igual
        }
    });

    if (rucExiste) {
        $('#alertRucEdit').removeClass('d-none').text('El RUC ya está registrado.');
        return;
    }
                $.ajax({
                    url: 'editar.php',
                    method: 'POST',
                    data: {
                        id_proveedor: idProveedor,
                        nuevo_nombre_proveedor: nombre,
                        nuevo_ruc: ruc,
                        nueva_direccion: direccion,
                        nuevo_telefono: telefono
                    },
                    success: function() {
                        cargarProveedores();
                        $('#editarProveedorModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al editar proveedor:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

            // Evento para filtrar proveedores al escribir en el campo de búsqueda
            $('#buscarProveedor').on('input', function() {
                var textoBusqueda = $(this).val().toLowerCase(); // Obtener el texto de búsqueda en minúsculas
                // Filtrar los proveedores en la tabla
                $('#tabla-proveedor tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1); // Mostrar/ocultar los proveedores según el texto de búsqueda
                });
            });

            // Función para procesar el formulario de agregar proveedor
            $('#agregarProveedorForm').submit(function(e) {
                e.preventDefault();
                var nombre = $('#nombre_prove').val();
                var ruc = $('#ruc_prove').val();
                var direccion = $('#direccion_prove').val();
                var telefono = $('#telefono_prove').val();

               // Validar RUC y teléfono como numéricos
    if(isNaN(ruc)) {
        $('#alertRuc').removeClass('d-none');
        return;
    }
    if(isNaN(telefono)) {
        $('#alertTelefono').removeClass('d-none');
        return;
    }

    // Verificar si el RUC ya existe en la lista de proveedores antes de enviar el formulario
    var rucExiste = false;
    $('#tabla-proveedor tr').each(function() {
        var rucProveedor = $(this).find('td:eq(2)').text(); // Obtener el RUC del proveedor en esta fila
        if (rucProveedor == ruc) {
            rucExiste = true;
            return false; // Salir del bucle each si se encuentra un RUC igual
        }
    });

    if (rucExiste) {
        $('#alertRuc').removeClass('d-none').text('El RUC ya está registrado.');
        return;
    }
                $.ajax({
                    url: 'register_proveedor_bi.php',
                    method: 'POST',
                    data: {
                        nombre_prove: nombre,
                        ruc_prove: ruc,
                        direccion_prove: direccion,
                        telefono_prove: telefono
                    },
                    success: function() {
                        cargarProveedores();
                        $('#agregarProveedorModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al agregar proveedor:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <!-- Enlace a Bootstrap JS y Popper.js (necesario para algunos componentes de Bootstrap) -->
 
</body>
</html>





















