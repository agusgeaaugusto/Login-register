<?php
include 'conexion_bi.php';

// Función para validar un ID
function validarID($id) {
    return isset($id) && is_numeric($id);
}

// Función para editar un usuario
function editarUsuario($id, $nuevoNombre, $nuevaClave, $nuevoEstado, $idRol) {
    global $conexion;

    // Validar el ID antes de realizar la edición
    if (validarID($id)) {
        // Preparar la consulta con consultas preparadas para evitar inyecciones SQL
        $query = "UPDATE Usuario SET nombre_usu = $1, clave_usu = $2, estado_usu = $3, fecha_actualiza_usu = CURRENT_DATE, id_rol = $4 WHERE id_usu = $5";
        $result = pg_query_params($conexion, $query, array($nuevoNombre, $nuevaClave, $nuevoEstado, $idRol, $id));

        if (!$result) {
            die("Error en la consulta de actualización: " . pg_last_error());
        }

        // Devolver una respuesta JSON exitosa
        echo json_encode(array('success' => true));
    } else {
        // Devolver una respuesta JSON con error si el ID no es válido
        echo json_encode(array('success' => false, 'message' => 'ID de usuario no válido.'));
    }
}

// Verificar si se proporciona un ID válido y nuevos datos
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_usuario']) && isset($_POST['nuevo_nombre_usuario']) && isset($_POST['nueva_clave_usuario']) && isset($_POST['nuevo_estado_usuario']) && isset($_POST['id_rol'])) {
    $idUsuarioEditar = $_POST['id_usuario'];
    $nuevoNombreUsuario = $_POST['nuevo_nombre_usuario'];
    $nuevaClaveUsuario = $_POST['nueva_clave_usuario'];
    $nuevoEstadoUsuario = $_POST['nuevo_estado_usuario'];
    $idRolUsuario = $_POST['id_rol'];

    // Validar los datos
    if (empty($nuevoNombreUsuario) || empty($nuevaClaveUsuario) || $nuevoEstadoUsuario === '') {
        // Devolver una respuesta JSON con error si algún dato está vacío
        echo json_encode(array('success' => false, 'message' => 'Por favor, completa todos los campos para editar el usuario.'));
    } else {
        // Editar el usuario con los nuevos datos
        editarUsuario($idUsuarioEditar, $nuevoNombreUsuario, $nuevaClaveUsuario, $nuevoEstadoUsuario, $idRolUsuario);
    }
} else {
    // Devolver una respuesta JSON con error si no se proporciona un ID o nuevos datos
    echo json_encode(array('success' => false, 'message' => 'ID de usuario o nuevos datos no proporcionados.'));
}
?>
