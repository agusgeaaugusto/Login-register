<?php
include 'conexion_bi.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_producto = htmlspecialchars($_GET['id']);

    $query = "SELECT id_pro, nombre_pro, precio1_pro, precio2_pro, precio3_pro, cantidad_caja_pro, cantidad_uni_pro, costo_caja_pro, costo_uni_pro, codigo_barra_pro 
              FROM producto 
              WHERE id_pro = $1";
    
    $result = pg_query_params($conexion, $query, array($id_producto));

    if ($result) {
        if (pg_num_rows($result) > 0) {
            $producto = pg_fetch_assoc($result);
            header('Content-Type: application/json');
            echo json_encode($producto);
        } else {
            http_response_code(404);
            echo json_encode(array('error' => 'Producto no encontrado'));
        }
    } else {
        http_response_code(500);
        echo json_encode(array('error' => 'Error en la consulta de la base de datos'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'ID de producto no válido'));
}

pg_close($conexion);
?>
