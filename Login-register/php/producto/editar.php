<?php
include 'conexion_bi.php';

function validarID($id) {
    return isset($id) && is_numeric($id);
}

function editarProducto($conexion, $id, $nuevoNombre, $nuevoPrecio1, $nuevoPrecio2, $nuevoPrecio3, $nuevaCantidadCaja, $nuevaCantidadUnidad, $nuevoCostoCaja, $nuevoCostoUnidad, $nuevoCodigoBarra) {
    if (validarID($id)) {
        $query = "UPDATE producto 
                  SET nombre_pro = $1, precio1_pro = $2, precio2_pro = $3, precio3_pro = $4, cantidad_caja_pro = $5, 
                      cantidad_uni_pro = $6, costo_caja_pro = $7, costo_uni_pro = $8, codigo_barra_pro = $9 
                  WHERE id_pro = $10";
        $params = array($nuevoNombre, $nuevoPrecio1, $nuevoPrecio2, $nuevoPrecio3, $nuevaCantidadCaja, $nuevaCantidadUnidad, $nuevoCostoCaja, $nuevoCostoUnidad, $nuevoCodigoBarra, $id);
        $result = pg_query_params($conexion, $query, $params);

        if (!$result) {
            die("Error en la consulta de actualización: " . pg_last_error());
        }

        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'ID de producto no válido.'));
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_pro'])) {
    $idProductoEditar = $_POST['id_pro'];
    $nuevoNombre = $_POST['nuevo_nombre_pro'];
    $nuevoPrecio1 = $_POST['nuevo_precio1_pro'];
    $nuevoPrecio2 = $_POST['nuevo_precio2_pro'];
    $nuevoPrecio3 = $_POST['nuevo_precio3_pro'];
    $nuevaCantidadCaja = $_POST['nueva_cantidad_caja_pro'];
    $nuevaCantidadUnidad = $_POST['nueva_cantidad_uni_pro'];
    $nuevoCostoCaja = $_POST['nuevo_costo_caja_pro'];
    $nuevoCostoUnidad = $_POST['nuevo_costo_uni_pro'];
    $nuevoCodigoBarra = $_POST['nuevo_codigo_barra_pro'];

    if (empty($nuevoNombre) || empty($nuevoPrecio1) || empty($nuevoPrecio2) || empty($nuevoPrecio3) ||
        empty($nuevaCantidadCaja) || empty($nuevaCantidadUnidad) || empty($nuevoCostoCaja) || 
        empty($nuevoCostoUnidad) || empty($nuevoCodigoBarra)) {
        echo json_encode(array('success' => false, 'message' => 'Por favor, completa todos los campos.'));
    } else {
        editarProducto($conexion, $idProductoEditar, $nuevoNombre, $nuevoPrecio1, $nuevoPrecio2, $nuevoPrecio3, $nuevaCantidadCaja, $nuevaCantidadUnidad, $nuevoCostoCaja, $nuevoCostoUnidad, $nuevoCodigoBarra);
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'ID de producto o nuevos datos no proporcionados.'));
}

pg_close($conexion);
?>
