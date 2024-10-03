<?php
include 'conexion_bi.php';

function validarID($id) {
    return isset($id) && is_numeric($id);
}

function editarPersona($conexion, $id, $nuevoNombre, $nuevaCedula) {
    if (validarID($id)) {
        $query = "UPDATE persona SET nombre_per = $1, cedula_per = $2 WHERE id_per = $3";
        $result = pg_query_params($conexion, $query, array($nuevoNombre, $nuevaCedula, $id));

        if (!$result) {
            die("Error en la consulta de actualización: " . pg_last_error());
        }

        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'ID de persona no válido.'));
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_per']) && isset($_POST['nuevo_nombre_per']) && isset($_POST['nuevo_cedula_per'])) {
    $idPersonaEditar = $_POST['id_per'];
    $nuevoNombre = $_POST['nuevo_nombre_per'];
    $nuevaCedula = $_POST['nuevo_cedula_per'];

    if (empty($nuevoNombre) || empty($nuevaCedula)) {
        echo json_encode(array('success' => false, 'message' => 'Por favor, completa todos los campos.'));
    } else {
        editarPersona($conexion, $idPersonaEditar, $nuevoNombre, $nuevaCedula);
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'ID de persona o nuevos datos no proporcionados.'));
}
?>
