<?php
// Suponiendo que tienes una conexión a la base de datos establecida
include 'conexion_bi.php';

// Verificar si se proporciona un ID válido en la solicitud
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Consulta para obtener los detalles del usuario
    $query = "SELECT id_usu, nombre_usu, estado_usu, fecha_creado_usu, fecha_actualiza_usu, id_rol FROM Usuario WHERE id_usu = $1";
    $result = pg_query_params($conexion, $query, array($id_usuario));

    if ($result) {
        // Si se encuentra el usuario, devolver los detalles en formato JSON
        $usuario = pg_fetch_assoc($result);
        header('Content-Type: application/json');
        echo json_encode($usuario);
    } else {
        // Si no se encuentra el usuario, devolver un mensaje de error
        http_response_code(404);
        echo json_encode(array('error' => 'Usuario no encontrado'));
    }
} else {
    // Si no se proporciona un ID válido, devolver un mensaje de error
    http_response_code(400);
    echo json_encode(array('error' => 'ID de usuario no válido'));
}
?>
