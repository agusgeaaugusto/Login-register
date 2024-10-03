<?php
include 'conexion_bi.php';

// Función para validar un ID
function validarID($id) {
    return isset($id) && is_numeric($id);
}

// Función para editar una compra
function editarCompra($id_com, $fecha_com, $total_com, $estado_com, $id_usu, $iva10_com, $iva5_com, $exenta_com, $id_proveedor) {
    global $conexion;

    // Validar el ID antes de realizar la edición
    if (validarID($id_com)) {
        // Preparar la consulta con consultas preparadas para evitar inyecciones SQL
        $query = "UPDATE compra SET fecha_com = $1, total_com = $2, estado_com = $3, id_usu = $4, iva10_com = $5, iva5_com = $6, exenta_com = $7, id_proveedor = $8 WHERE id_com = $9";
        $result = pg_query_params($conexion, $query, array($fecha_com, $total_com, $estado_com, $id_usu, $iva10_com, $iva5_com, $exenta_com, $id_proveedor, $id_com));

        if (!$result) {
            die("Error en la consulta de actualización: " . pg_last_error());
        }

        // Devolver una respuesta JSON exitosa
        echo json_encode(array('success' => true));
    } else {
        // Devolver una respuesta JSON con error si el ID no es válido
        echo json_encode(array('success' => false, 'message' => 'ID de compra no válido.'));
    }
}

// Verificar si se proporciona un ID válido y nuevos datos de la compra
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_com']) && isset($_POST['fecha_com']) && isset($_POST['total_com']) && isset($_POST['estado_com']) && isset($_POST['id_usu']) && isset($_POST['iva10_com']) && isset($_POST['iva5_com']) && isset($_POST['exenta_com']) && isset($_POST['id_proveedor'])) {
    $id_com = $_POST['id_com'];
    $fecha_com = $_POST['fecha_com'];
    $total_com = $_POST['total_com'];
    $estado_com = $_POST['estado_com'];
    $id_usu = $_POST['id_usu'];
    $iva10_com = $_POST['iva10_com'];
    $iva5_com = $_POST['iva5_com'];
    $exenta_com = $_POST['exenta_com'];
    $id_proveedor = $_POST['id_proveedor'];

    // Validar los datos
    if (empty($fecha_com) || empty($total_com) || empty($estado_com) || empty($id_usu) || empty($iva10_com) || empty($iva5_com) || empty($exenta_com) || empty($id_proveedor)) {
        // Devolver una respuesta JSON con error si algún campo está vacío
        echo json_encode(array('success' => false, 'message' => 'Por favor, completa todos los campos.'));
    } else {
        // Editar la compra con los nuevos datos
        editarCompra($id_com, $fecha_com, $total_com, $estado_com, $id_usu, $iva10_com, $iva5_com, $exenta_com, $id_proveedor);
    }
} else {
    // Devolver una respuesta JSON con error si no se proporciona un ID o nuevos datos
    echo json_encode(array('success' => false, 'message' => 'ID de compra o nuevos datos no proporcionados.'));
}

// Cierra la conexión a la base de datos
pg_close($conexion);
?>
