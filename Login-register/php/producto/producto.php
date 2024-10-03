<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
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
    <h2 class="text-center mb-4">Lista de Productos</h2>

    <div class="input-group mb-3">
        <input type="text" class="form-control" id="buscarProducto" placeholder="Buscar por nombre de producto" aria-label="Buscar" aria-describedby="btnBuscar">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="btnBuscar">Buscar</button>
        </div>
    </div>

    <div class="card-body d-flex justify-content-end">
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarProductoModal">Agregar Producto</button>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Código de Barra</th>
                        <th>Nombre del Producto</th>
                        <th>Precio 1</th>
                        <th>Precio 2</th>
                        <th>Precio 3</th>
                        <th>Cantidad por Caja</th>
                        <th>IVA</th>
                        <th>Cantidad por Unidad</th>
                        <th>Validación</th>
                        <th>Costo por Caja</th>
                        <th>Costo por Unidad</th>
                        <th>ID Proveedor</th>
                        <th>ID Comercial</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-productos">
                    <!-- Aquí se mostrará el listado de productos en forma de tabla -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar producto -->
<div class="modal fade" id="agregarProductoModal" tabindex="-1" role="dialog" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="agregarProductoForm">
                    <div class="form-group">
                        <label for="codigo_barra_pro">Código de Barra:</label>
                        <input type="text" class="form-control" id="codigo_barra_pro" name="codigo_barra_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre_pro">Nombre del Producto:</label>
                        <input type="text" class="form-control" id="nombre_pro" name="nombre_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="precio1_pro">Precio 1:</label>
                        <input type="number" class="form-control" id="precio1_pro" name="precio1_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="precio2_pro">Precio 2:</label>
                        <input type="number" class="form-control" id="precio2_pro" name="precio2_pro">
                    </div>
                    <div class="form-group">
                        <label for="precio3_pro">Precio 3:</label>
                        <input type="number" class="form-control" id="precio3_pro" name="precio3_pro">
                    </div>
                    <div class="form-group">
                        <label for="cantidad_caja_pro">Cantidad por Caja:</label>
                        <input type="number" class="form-control" id="cantidad_caja_pro" name="cantidad_caja_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="iva_pro">IVA:</label>
                        <input type="number" class="form-control" id="iva_pro" name="iva_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_uni_pro">Cantidad por Unidad:</label>
                        <input type="number" class="form-control" id="cantidad_uni_pro" name="cantidad_uni_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="validacion_pro">Validación:</label>
                        <input type="text" class="form-control" id="validacion_pro" name="validacion_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="costo_caja_pro">Costo por Caja:</label>
                        <input type="number" class="form-control" id="costo_caja_pro" name="costo_caja_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="costo_uni_pro">Costo por Unidad:</label>
                        <input type="number" class="form-control" id="costo_uni_pro" name="costo_uni_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="id_proveedor">ID Proveedor:</label>
                        <input type="number" class="form-control" id="id_proveedor" name="id_proveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="id_com">ID Comercial:</label>
                        <input type="number" class="form-control" id="id_com" name="id_com" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar producto -->
<div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editarProductoForm">
                    <input type="hidden" id="editar_id_producto" name="id_producto">
                    <div class="form-group">
                        <label for="editar_codigo_barra_pro">Código de Barra:</label>
                        <input type="text" class="form-control" id="editar_codigo_barra_pro" name="codigo_barra_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_nombre_pro">Nombre del Producto:</label>
                        <input type="text" class="form-control" id="editar_nombre_pro" name="nombre_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_precio1_pro">Precio 1:</label>
                        <input type="number" class="form-control" id="editar_precio1_pro" name="precio1_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_precio2_pro">Precio 2:</label>
                        <input type="number" class="form-control" id="editar_precio2_pro" name="precio2_pro">
                    </div>
                    <div class="form-group">
                        <label for="editar_precio3_pro">Precio 3:</label>
                        <input type="number" class="form-control" id="editar_precio3_pro" name="precio3_pro">
                    </div>
                    <div class="form-group">
                        <label for="editar_cantidad_caja_pro">Cantidad por Caja:</label>
                        <input type="number" class="form-control" id="editar_cantidad_caja_pro" name="cantidad_caja_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_iva_pro">IVA:</label>
                        <input type="number" class="form-control" id="editar_iva_pro" name="iva_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_cantidad_uni_pro">Cantidad por Unidad:</label>
                        <input type="number" class="form-control" id="editar_cantidad_uni_pro" name="cantidad_uni_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_validacion_pro">Validación:</label>
                        <input type="text" class="form-control" id="editar_validacion_pro" name="validacion_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_costo_caja_pro">Costo por Caja:</label>
                        <input type="number" class="form-control" id="editar_costo_caja_pro" name="costo_caja_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_costo_uni_pro">Costo por Unidad:</label>
                        <input type="number" class="form-control" id="editar_costo_uni_pro" name="costo_uni_pro" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_id_proveedor">ID Proveedor:</label>
                        <input type="number" class="form-control" id="editar_id_proveedor" name="id_proveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="editar_id_com">ID Comercial:</label>
                        <input type="number" class="form-control" id="editar_id_com" name="id_com" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Función para cargar la lista de productos
        function cargarProductos() {
            $.ajax({
                url: 'register_producto_bi.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var tablaProductos = '';
                    data.forEach(function(producto) {
                        tablaProductos += '<tr>';
                        tablaProductos += '<td>' + producto.productid_pro + '</td>';
                        tablaProductos += '<td>' + producto.codigo_barra_pro + '</td>';
                        tablaProductos += '<td>' + producto.nombre_pro + '</td>';
                        tablaProductos += '<td>' + producto.precio1_pro + '</td>';
                        tablaProductos += '<td>' + producto.precio2_pro + '</td>';
                        tablaProductos += '<td>' + producto.precio3_pro + '</td>';
                        tablaProductos += '<td>' + producto.cantidad_caja_pro + '</td>';
                        tablaProductos += '<td>' + producto.iva_pro + '</td>';
                        tablaProductos += '<td>' + producto.cantidad_uni_pro + '</td>';
                        tablaProductos += '<td>' + producto.validacion_pro + '</td>';
                        tablaProductos += '<td>' + producto.costo_caja_pro + '</td>';
                        tablaProductos += '<td>' + producto.costo_uni_pro + '</td>';
                        tablaProductos += '<td>' + producto.id_proveedor + '</td>';
                        tablaProductos += '<td>' + producto.id_com + '</td>';
                        tablaProductos += '<td>';
                        tablaProductos += '<button class="btn btn-warning btn-sm editar-producto" data-id="' + producto.productid_pro + '">Editar</button>';
                        tablaProductos += '<button class="btn btn-danger btn-sm eliminar-producto" data-id="' + producto.productid_pro + '">Eliminar</button>';
                        tablaProductos += '</td>';
                        tablaProductos += '</tr>';
                    });
                    $('#tabla-productos').html(tablaProductos);
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener productos:', status, error);
                    console.log(xhr.responseText);
                }
            });
        }

        // Cargar la lista de productos al cargar la página
        cargarProductos();

        // Función para procesar la eliminación de un producto
        $('#tabla-productos').on('click', '.eliminar-producto', function() {
            var idProductoEliminar = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                $.ajax({
                    url: 'eliminar.php?eliminar=' + idProductoEliminar,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#tabla-productos').find('button[data-id="' + idProductoEliminar + '"]').closest('tr').remove();
                        } else {
                            console.error('Error al eliminar producto:', response.message);
                        }
                        cargarProductos(); // Actualizar la lista de productos después de la eliminación
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar producto:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        // Evento click para abrir el modal de edición y cargar los datos del producto
        $(document).on('click', '.editar-producto', function() {
            var idProductoEditar = $(this).data('id');
            $.ajax({
                url: 'get_producto.php?id=' + idProductoEditar,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#editar_id_producto').val(data.productid_pro);
                    $('#editar_codigo_barra_pro').val(data.codigo_barra_pro);
                    $('#editar_nombre_pro').val(data.nombre_pro);
                    $('#editar_precio1_pro').val(data.precio1_pro);
                    $('#editar_precio2_pro').val(data.precio2_pro);
                    $('#editar_precio3_pro').val(data.precio3_pro);
                    $('#editar_cantidad_caja_pro').val(data.cantidad_caja_pro);
                    $('#editar_iva_pro').val(data.iva_pro);
                    $('#editar_cantidad_uni_pro').val(data.cantidad_uni_pro);
                    $('#editar_validacion_pro').val(data.validacion_pro);
                    $('#editar_costo_caja_pro').val(data.costo_caja_pro);
                    $('#editar_costo_uni_pro').val(data.costo_uni_pro);
                    $('#editar_id_proveedor').val(data.id_proveedor);
                    $('#editar_id_com').val(data.id_com);
                    $('#editarProductoModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener datos del producto:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Función para procesar el formulario de edición de producto
        $('#editarProductoForm').submit(function(e) {
            e.preventDefault();
            var idProducto = $('#editar_id_producto').val();
            var codigoBarra = $('#editar_codigo_barra_pro').val();
            var nombreProducto = $('#editar_nombre_pro').val();
            var precio1 = $('#editar_precio1_pro').val();
            var precio2 = $('#editar_precio2_pro').val();
            var precio3 = $('#editar_precio3_pro').val();
            var cantidadCaja = $('#editar_cantidad_caja_pro').val();
            var iva = $('#editar_iva_pro').val();
            var cantidadUnidad = $('#editar_cantidad_uni_pro').val();
            var validacion = $('#editar_validacion_pro').val();
            var costoCaja = $('#editar_costo_caja_pro').val();
            var costoUnidad = $('#editar_costo_uni_pro').val();
            var idProveedor = $('#editar_id_proveedor').val();
            var idCom = $('#editar_id_com').val();

            $.ajax({
                url: 'editar.php',
                method: 'POST',
                data: {
                    productid_pro: idProducto,
                    codigo_barra_pro: codigoBarra,
                    nombre_pro: nombreProducto,
                    precio1_pro: precio1,
                    precio2_pro: precio2,
                    precio3_pro: precio3,
                    cantidad_caja_pro: cantidadCaja,
                    iva_pro: iva,
                    cantidad_uni_pro: cantidadUnidad,
                    validacion_pro: validacion,
                    costo_caja_pro: costoCaja,
                    costo_uni_pro: costoUnidad,
                    id_proveedor: idProveedor,
                    id_com: idCom
                },
                success: function() {
                    cargarProductos();
                    $('#editarProductoModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error al editar producto:', status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Capturar el evento de entrada en el campo de búsqueda
        $('#buscarProducto').on('input', function() {
            var textoBusqueda = $(this).val().toLowerCase();
            $('#tabla-productos tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
            });
        });

        // Capturar el clic en el botón de búsqueda
        $('#btnBuscar').click(function() {
            var textoBusqueda = $('#buscarProducto').val().toLowerCase();
            $('#tabla-productos tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -1);
            });
        });

        // Función para procesar el formulario de agregar producto
        $('#agregarProductoForm').submit(function(e) {
            e.preventDefault();
            var codigoBarra = $('#codigo_barra_pro').val();
            var nombreProducto = $('#nombre_pro').val();
            var precio1 = $('#precio1_pro').val();
            var precio2 = $('#precio2_pro').val();
            var precio3 = $('#precio3_pro').val();
            var cantidadCaja = $('#cantidad_caja_pro').val();
            var iva = $('#iva_pro').val();
            var cantidadUnidad = $('#cantidad_uni_pro').val();
            var validacion = $('#validacion_pro').val();
            var costoCaja = $('#costo_caja_pro').val();
            var costoUnidad = $('#costo_uni_pro').val();
            var idProveedor = $('#id_proveedor').val();
            var idCom = $('#id_com').val();

            $.ajax({
                url: 'register_producto_bi.php',
                method: 'POST',
                data: {
                    codigo_barra_pro: codigoBarra,
                    nombre_pro: nombreProducto,
                    precio1_pro: precio1,
                    precio2_pro: precio2,
                    precio3_pro: precio3,
                    cantidad_caja_pro: cantidadCaja,
                    iva_pro: iva,
                    cantidad_uni_pro: cantidadUnidad,
                    validacion_pro: validacion,
                    costo_caja_pro: costoCaja,
                    costo_uni_pro: costoUnidad,
                    id_proveedor: idProveedor,
                    id_com: idCom
                },
                success: function() {
                    cargarProductos();
                    $('#agregarProductoModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error al agregar producto:', status, error);
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
