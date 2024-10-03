<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Compras</title>
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
        <h2 class="text-center mb-4">Lista de Compras</h2>

        <div class="input-group mb-3">
            <input type="text" class="form-control" id="buscarCompra" placeholder="Buscar por fecha de compra" aria-label="Buscar" aria-describedby="btnBuscar">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="btnBuscar">Buscar</button>
            </div>
        </div>

        <div class="card-body d-flex justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#agregarCompraModal">Agregar Compra</button>
        </div>
    

        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>ID Usuario</th>
                            <th>IVA 10%</th>
                            <th>IVA 5%</th>
                            <th>Exenta</th>
                            <th>ID Proveedor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-compra">
                        <!-- Aquí se mostrará el listado de compras en forma de tabla -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para agregar compra -->
    <div class="modal fade" id="agregarCompraModal" tabindex="-1" role="dialog" aria-labelledby="agregarCompraModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarCompraModalLabel">Agregar Compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="agregarCompraForm">
                        <div class="form-group">
                            <label for="fecha_com">Fecha:</label>
                            <input type="date" class="form-control" id="fecha_com" name="fecha_com" required>
                        </div>
                        <div class="form-group">
                            <label for="total_com">Total:</label>
                            <input type="number" step="0.01" class="form-control" id="total_com" name="total_com" required>
                        </div>
                        <div class="form-group">
                            <label for="estado_com">Estado:</label>
                            <select class="form-control" id="estado_com" name="estado_com" required>
                                <option value="true">Activo</option>
                                <option value="false">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_usu">ID Usuario:</label>
                            <input type="number" class="form-control" id="id_usu" name="id_usu" required>
                        </div>
                        <div class="form-group">
                            <label for="iva10_com">
                            <label for="iva10_com">IVA 10%:</label>
                            <input type="number" class="form-control" id="iva10_com" name="iva10_com" required>
                        </div>
                        <div class="form-group">
                            <label for="iva5_com">IVA 5%:</label>
                            <input type="number" class="form-control" id="iva5_com" name="iva5_com" required>
                        </div>
                        <div class="form-group">
                            <label for="exenta_com">Exenta:</label>
                            <input type="number" class="form-control" id="exenta_com" name="exenta_com" required>
                        </div>
                        <div class="form-group">
                            <label for="id_proveedor">ID Proveedor:</label>
                            <input type="number" class="form-control" id="id_proveedor" name="id_proveedor" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Compra</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar compra -->
    <div class="modal fade" id="editarCompraModal" tabindex="-1" role="dialog" aria-labelledby="editarCompraModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarCompraModalLabel">Editar Compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarCompraForm">
                        <input type="hidden" id="editar_id_com" name="id_com">
                        <div class="form-group">
                            <label for="fecha_com_edit">Fecha:</label>
                            <input type="date" class="form-control" id="fecha_com_edit" name="fecha_com" required>
                        </div>
                        <div class="form-group">
                            <label for="total_com_edit">Total:</label>
                            <input type="number" step="0.01" class="form-control" id="total_com_edit" name="total_com" required>
                        </div>
                        <div class="form-group">
                            <label for="estado_com_edit">Estado:</label>
                            <select class="form-control" id="estado_com_edit" name="estado_com" required>
                                <option value="true">Activo</option>
                                <option value="false">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_usu_edit">ID Usuario:</label>
                            <input type="number" class="form-control" id="id_usu_edit" name="id_usu" required>
                        </div>
                        <div class="form-group">
                            <label for="iva10_com_edit">IVA 10%:</label>
                            <input type="number" class="form-control" id="iva10_com_edit" name="iva10_com" required>
                        </div>
                        <div class="form-group">
                            <label for="iva5_com_edit">IVA 5%:</label>
                            <input type="number" class="form-control" id="iva5_com_edit" name="iva5_com" required>
                        </div>
                        <div class="form-group">
                            <label for="exenta_com_edit">Exenta:</label>
                            <input type="number" class="form-control" id="exenta_com_edit" name="exenta_com" required>
                        </div>
                        <div class="form-group">
                            <label for="id_proveedor_edit">ID Proveedor:</label>
                            <input type="number" class="form-control" id="id_proveedor_edit" name="id_proveedor" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Función para cargar la lista de compras
            function cargarCompras() {
                $.ajax({
                    url: 'get_compras.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tablaCompras = '';
                        data.forEach(function(compra) {
                            tablaCompras += '<tr>';
                            tablaCompras += '<td>' + compra.id_com + '</td>';
                            tablaCompras += '<td>' + compra.fecha_com + '</td>';
                            tablaCompras += '<td>' + compra.total_com + '</td>';
                            tablaCompras += '<td>' + (compra.estado_com ? 'Activo' : 'Inactivo') + '</td>';
                            tablaCompras += '<td>' + compra.id_usu + '</td>';
                            tablaCompras += '<td>' + compra.iva10_com + '</td>';
                            tablaCompras += '<td>' + compra.iva5_com + '</td>';
                            tablaCompras += '<td>' + compra.exenta_com + '</td>';
                            tablaCompras += '<td>' + compra.id_proveedor + '</td>';
                            tablaCompras += '<td>';
                            tablaCompras += '<button class="btn btn-warning btn-sm editar-compra" data-id="' + compra.id_com + '">Editar</button>';
                            tablaCompras += '<button class="btn btn-danger btn-sm eliminar-compra" data-id="' + compra.id_com + '">Eliminar</button>';
                            tablaCompras += '</td>';
                            tablaCompras += '</tr>';
                        });
                        $('#tabla-compra').html(tablaCompras);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener compras:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            }

            // Cargar la lista de compras al cargar la página
            cargarCompras();

            // Función para procesar la eliminación de una compra
            $('#tabla-compra').on('click', '.eliminar-compra', function() {
                var idCompraEliminar = $(this).data('id');
                if (confirm('¿Estás seguro de que deseas eliminar esta compra?')) {
                    $.ajax({
                        url: 'eliminar.php?id=' + idCompraEliminar,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#tabla-compra').find('button[data-id="' + idCompraEliminar + '"]').closest('tr').remove();
                            } else {
                                console.error('Error al eliminar compra:', response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error al eliminar compra:', status, error);
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            // Evento click para abrir el modal de edición y cargar los datos de la compra
            $(document).on('click', '.editar-compra', function() {
                var idCompraEditar = $(this).data('id');
                $.ajax({
                    url: 'get_compra.php?id=' + idCompraEditar,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#editar_id_com').val(data.id_com);
                        $('#fecha_com_edit').val(data.fecha_com);
                        $('#total_com_edit').val(data.total_com);
                        $('#estado_com_edit').val(data.estado_com);
                        $('#id_usu_edit').val(data.id_usu);
                        $('#iva10_com_edit').val(data.iva10_com);
                        $('#iva5_com_edit').val(data.iva5_com);
                        $('#exenta_com_edit').val(data.exenta_com);
                        $('#id_proveedor_edit').val(data.id_proveedor);
                        $('#editarCompraModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener datos de la compra:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

            // Función para procesar el formulario de edición de compra
            $('#editarCompraForm').submit(function(e) {
                e.preventDefault();
                var idCompra = $('#editar_id_com').val();
                var fecha = $('#fecha_com_edit').val();
                var total = $('#total_com_edit').val();
                var estado = $('#estado_com_edit').val();
                var idUsuario = $('#id_usu_edit').val();
                var iva10 = $('#iva10_com_edit').val();
                var iva5 = $('#iva5_com_edit').val();
                var exenta = $('#exenta_com_edit').val();
                var idProveedor = $('#id_proveedor_edit').val();

                $.ajax({
                    url: 'editar.php',
                    method: 'POST',
                    data: {
                        id_com: idCompra,
                        fecha_com: fecha,
                        total_com: total,
                        estado_com: estado,
                        id_usu: idUsuario,
                        iva10_com: iva10,
                        iva5_com: iva5,
                        exenta_com: exenta,
                        id_proveedor: idProveedor
                    },
                    success: function() {
                        cargarCompras();
                        $('#editarCompraModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al editar compra:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

            // Función para procesar el formulario de agregar compra
            $('#agregarCompraForm').submit(function(e) {
                e.preventDefault();
                var fecha = $('#fecha_com').val();
                var total = $('#total_com').val();
                var estado = $('#estado_com').val();
                var idUsuario = $('#id_usu').val();
                var iva10 = $('#iva10_com').val();
                var iva5 = $('#iva5_com').val();
                var exenta = $('#exenta_com').val();
                var idProveedor = $('#id_proveedor').val();

                $.ajax({
                    url: 'register_compra.php',
                    method: 'POST',
                    data: {
                        fecha_com: fecha,
                        total_com: total,
                        estado_com: estado,
                        id_usu: idUsuario,
                        iva10_com: iva10,
                        iva5_com: iva5,
                        exenta_com: exenta,
                        id_proveedor: idProveedor
                    },
                    success: function() {
                        cargarCompras();
                        $('#agregarCompraModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al agregar compra:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });

            // Función para buscar compras por fecha
            $('#btnBuscar').click(function() {
                var fechaBuscar = $('#buscarCompra').val();
                $.ajax({
                    url: 'buscar_compras.php',
                    method: 'GET',
                    data: { fecha_com: fechaBuscar },
                    dataType: 'json',
                    success: function(data) {
                        var tablaCompras = '';
                        data.forEach(function(compra) {
                            tablaCompras += '<tr>';
                            tablaCompras += '<td>' + compra.id_com + '</td>';
                            tablaCompras += '<td>' + compra.fecha_com + '</td>';
                            tablaCompras += '<td>' + compra.total_com + '</td>';
                            tablaCompras += '<td>' + (compra.estado_com ? 'Activo' : 'Inactivo') + '</td>';
                            tablaCompras += '<td>' + compra.id_usu + '</td>';
                            tablaCompras += '<td>' + compra.iva10_com + '</td>';
                            tablaCompras += '<td>' + compra.iva5_com + '</td>';
                            tablaCompras += '<td>' + compra.exenta_com + '</td>';
                            tablaCompras += '<td>' + compra.id_proveedor + '</td>';
                            tablaCompras += '<td>';
                            tablaCompras += '<button class="btn btn-warning btn-sm editar-compra" data-id="' + compra.id_com + '">Editar</button>';
                            tablaCompras += '<button class="btn btn-danger btn-sm eliminar-compra" data-id="' + compra.id_com + '">Eliminar</button>';
                            tablaCompras += '</td>';
                            tablaCompras += '</tr>';
                        });
                        $('#tabla-compra').html(tablaCompras);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al buscar compras:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>





















