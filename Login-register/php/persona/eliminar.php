<?php
include 'conexion_bi.php';

function validarID($id) {
    return isset($id) && filter_var($id, FILTER_VALIDATE_INT) !== false && $id > 0;
}

function eliminarPersona($id) {
    global $conexion;

    if (validarID($id)) {
        $query = "DELETE FROM persona WHERE id_per = $1";
        $result = pg_query_params($conexion, $query, array($id));

        if (!$result) {
            echo json_encode(array("success" => false, "message" => "Error en la consulta de eliminación: " . pg_last_error($conexion)));
            exit;
        }

        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "message" => "ID de persona no válido"));
    }
}

if (isset($_GET['id'])) {
    $id_persona = intval($_GET['id']);
    eliminarPersona($id_persona);
} else {
    echo json_encode(array("success" => false, "message" => "No se proporcionó un ID de persona"));
}
?>
