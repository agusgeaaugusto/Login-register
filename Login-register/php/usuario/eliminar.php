<?php
include 'conexion_bi.php';

// Función para validar un ID
function validarID($id) {
    return isset($id) && is_numeric($id);
}

// Función para redirigir a la página principal después de realizar una operación
function redireccionar() {
    header("Location: register_usuario_bi.php");
    exit();
}

// Función para eliminar un usuario
function eliminarUsuario($id) {
    global $conexion;

    // Validar el ID antes de realizar la eliminación
    if (validarID($id)) {
        // Corrección: Utilizar marcadores de posición en la consulta SQL
        $query = "DELETE FROM Usuario WHERE id_usu = $1";
        $result = pg_query_params($conexion, $query, array($id));

        if (!$result) {
            die("Error en la consulta de eliminación: " . pg_last_error());
        }

        redireccionar();
    } else {
        // Si hay un error, podrías redirigir también para mantener la consistencia
        redireccionar();
    }
}

// Verificar si se proporciona un ID en la URL para eliminar
if (isset($_GET['eliminar'])) {
    $id_usuario = $_GET['eliminar'];
    eliminarUsuario($id_usuario);
}
?>
