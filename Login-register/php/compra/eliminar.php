<?php
include 'conexion_bi.php';

// Función para validar un ID
function validarID($id) {
    return isset($id) && is_numeric($id);
}

// Función para eliminar una compra
function eliminarCompra($id_com) {
    global $conexion;

    // Validar el ID antes de realizar la eliminación
    if (validarID($id_com)) {
        // Utilizar consultas preparadas para evitar inyecciones SQL
        $query = "DELETE FROM compra WHERE id_com = $1";
        $result = pg_query_params($conexion, $query, array($id_com));

        if (!$result) {
            die("Error en la consulta de eliminación: " . pg_last_error($conexion));
        }

        // Retornar una respuesta JSON indicando éxito
        echo json_encode(array("success" => true));
    } else {
        // Retornar una respuesta JSON indicando error
        echo json_encode(array("success" => false, "message" => "ID de compra no válido"));
    }
}

// Verificar si se proporciona un ID en la URL para eliminar
if (isset($_GET['id'])) {
    // Escapar el valor del ID para evitar inyecciones de SQL
    $id_com = intval($_GET['id']);
    eliminarCompra($id_com);
} else {
    // Retornar una respuesta JSON indicando error si no se proporciona un ID
    echo json_encode(array("success" => false, "message" => "No se proporcionó un ID de compra"));
}

// Cierra la conexión a la base de datos
pg_close($conexion);
?>
