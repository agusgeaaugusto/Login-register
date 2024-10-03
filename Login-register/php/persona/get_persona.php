<?php
include 'conexion_bi.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_persona = htmlspecialchars($_GET['id']);

    $query = "SELECT id_per, nombre_per, cedula_per FROM persona WHERE id_per = $1";
    $result = pg_query_params($conexion, $query, array($id_persona));

    if ($result) {
        if (pg_num_rows($result) > 0) {
            $persona = pg_fetch_assoc($result);
            header('Content-Type: application/json');
            echo json_encode($persona);
        } else {
            http_response_code(404);
            echo json_encode(array('error' => 'Persona no encontrada'));
        }
    } else {
        http_response_code(500);
        echo json_encode(array('error' => 'Error en la consulta de la base de datos'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'ID de persona no válido'));
}

pg_close($conexion);
?>
