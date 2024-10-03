<?php
include 'conexion_bi.php';

// Función para redirigir a la página principal
function redireccionar($mensaje) {
    header("Location: register_persona_bi.php?mensaje=" . urlencode($mensaje));
    exit();
}

// Verifica si se realizó una solicitud POST para agregar una nueva persona
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_per = isset($_POST['nombre_per']) ? htmlspecialchars($_POST['nombre_per']) : '';
    $cedula_per = isset($_POST['cedula_per']) ? htmlspecialchars($_POST['cedula_per']) : '';

    // Validar los datos
    if (empty($nombre_per) || empty($cedula_per)) {
        die("Por favor, completa todos los campos del formulario.");
    }

    // Preparar y ejecutar la consulta con consultas preparadas para evitar inyecciones SQL
    $query = "INSERT INTO persona (nombre_per, cedula_per) VALUES ($1, $2)";
    $result = pg_query_params($conexion, $query, array($nombre_per, $cedula_per));

    if (!$result) {
        die("Error en la consulta: " . pg_last_error());
    }

    // Redireccionar después de la inserción
    redireccionar("La persona ha sido agregada exitosamente.");
}

// Realiza la consulta para obtener la lista de personas ordenada por ID
$query = "SELECT * FROM persona ORDER BY id_per ASC";
$result = pg_query($conexion, $query);

if (!$result) {
    die("Error en la consulta: " . pg_last_error());
}

$personas = array();
while ($row = pg_fetch_assoc($result)) {
    $personas[] = $row;
}

// Devolver las personas como respuesta JSON
echo json_encode($personas);

pg_close($conexion);
?>
