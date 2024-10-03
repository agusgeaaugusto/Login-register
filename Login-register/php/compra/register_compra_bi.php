<?php
include 'conexion_bi.php';

// Función para redirigir a la página principal
function redireccionar() {
    header("Location: index.php"); // Ajusta el nombre de tu archivo principal si es diferente
    exit();
}

// Verifica si se realizó una solicitud POST para agregar una nueva compra
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera y limpia los datos del formulario
    $fecha_com = isset($_POST['fecha_com'])? htmlspecialchars($_POST['fecha_com']) : '';
    $total_com = isset($_POST['total_com'])? floatval($_POST['total_com']) : 0;
    $estado_com = isset($_POST['estado_com'])? $_POST['estado_com'] : false;
    $id_usu = isset($_POST['id_usu'])? intval($_POST['id_usu']) : 0;
    $iva10_com = isset($_POST['iva10_com'])? floatval($_POST['iva10_com']) : 0;
    $iva5_com = isset($_POST['iva5_com'])? floatval($_POST['iva5_com']) : 0;
    $exenta_com = isset($_POST['exenta_com'])? floatval($_POST['exenta_com']) : 0;
    $id_proveedor = isset($_POST['id_proveedor'])? intval($_POST['id_proveedor']) : 0;

    // Validar los datos
    if (empty($fecha_com) || $total_com <= 0 || empty($estado_com) || $id_usu <= 0 || $id_proveedor <= 0) {
        die("Por favor, completa todos los campos del formulario.");
    }

    // Preparar y ejecutar la consulta con consultas preparadas para evitar inyecciones SQL
    $query = "INSERT INTO compra (fecha_com, total_com, estado_com, id_usu, iva10_com, iva5_com, exenta_com, id_proveedor) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
    $result = pg_query_params($conexion, $query, array($fecha_com, $total_com, $estado_com, $id_usu, $iva10_com, $iva5_com, $exenta_com, $id_proveedor));

    // Verificar si la consulta fue exitosa
    if (!$result) {
        die("Error en la consulta: " . pg_last_error());
    }

    // Redireccionar después de la inserción
    redireccionar();
}

// Cierra la conexión a la base de datos
pg_close($conexion);
?>
