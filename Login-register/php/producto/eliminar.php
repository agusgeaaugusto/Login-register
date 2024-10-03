<?php
include 'conexion_bi.php';

function validarID($id) {
    return isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false && $id > 0;
}

function eliminarProducto($id) {
    global $conexion;

    if (validarID($id)) {
        $query = "DELETE FROM producto WHERE id_pro = $1";
        $result = pg_query_params($conexion, $query, array($id));

        if (!$result) {
            echo json_encode(array("success" => false, "message" => "Error en la consulta de eliminación: " . pg_last_error($conexion)));
            exit;
        }

        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "message" => "ID de producto no válido"));
    }
}

if (isset($_GET['id'])) {
    $id_producto = intval($_GET['id']);
    eliminarProducto($id_producto);
} else {
    echo json_encode(array("success" => false, "message" => "No se proporcionó un ID de producto"));
}

pg_close($conexion);
?>
