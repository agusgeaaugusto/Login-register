<?php
include 'conexion_bi.php';

// Función para validar un ID
function validarID($id) {
    return isset($id) && is_numeric($id);
}

// Verifica si se proporciona un ID válido en la solicitud
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Obtiene el ID de la compra desde la solicitud y lo limpia para evitar inyecciones SQL
    $id_com = htmlspecialchars($_GET['id']);

    // Consulta para obtener los detalles de la compra utilizando una consulta preparada para evitar inyecciones SQL
    $query = "SELECT id_com, fecha_com, total_com, estado_com, id_usu, iva10_com, iva5_com, exenta_com, id_proveedor FROM compra WHERE id_com = $1";
    $result = pg_query_params($conexion, $query, array($id_com));

    if ($result) {
        // Verifica si se encontraron resultados
        if (pg_num_rows($result) > 0) {
            // Si se encuentra la compra, devuelve los detalles en formato JSON
            $compra = pg_fetch_assoc($result);
            header('Content-Type: application/json');
            echo json_encode($compra);
        } else {
            // Si no se encuentra la compra, devuelve un mensaje de error y establece el código de respuesta HTTP 404 (No encontrado)
            http_response_code(404);
            echo json_encode(array('error' => 'Compra no encontrada'));
        }
    } else {
        // Si ocurre algún error en la consulta, devuelve un mensaje de error y establece el código de respuesta HTTP 500 (Error interno del servidor)
        http_response_code(500);
        echo json_encode(array('error' => 'Error en la consulta de la base de datos'));
    }
} else {
    // Si no se proporciona un ID válido, devuelve un mensaje de error y establece el código de respuesta HTTP 400 (Solicitud incorrecta)
    http_response_code(400);
    echo json_encode(array('error' => 'ID de compra no válido'));
}

// Cierra la conexión a la base de datos
pg_close($conexion);
?>
