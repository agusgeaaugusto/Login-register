<?php
include 'conexion_bi.php';

// Función para redirigir a la página principal después de realizar una operación
function redireccionar() {
    header("Location: register_usuario_bi.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario y limpiarlos
    $nombre_usu = isset($_POST['nombre_usu']) ? htmlspecialchars($_POST['nombre_usu']) : '';
    $clave_usu = isset($_POST['clave_usu']) ? htmlspecialchars($_POST['clave_usu']) : '';
    $estado_usu = isset($_POST['estado_usu']) ? (int)$_POST['estado_usu'] : 0;
    $fecha_creado_usu = isset($_POST['fecha_creado_usu']) ? date('m-d-Y', strtotime($_POST['fecha_creado_usu'])) : date('m-d-Y');
    $fecha_actualiza_usu = isset($_POST['fecha_actualiza_usu']) ? date('m-d-Y', strtotime($_POST['fecha_actualiza_usu'])) : date('m-d-Y');
    $id_rol = isset($_POST['id_rol']) ? (int)$_POST['id_rol'] : 0;

    // Validar los datos
    if (empty($nombre_usu) || empty($clave_usu) || empty($fecha_creado_usu) || empty($fecha_actualiza_usu) || empty($id_rol)) {
        die("Por favor, completa todos los campos del formulario.");
    }

    // Preparar la consulta con consultas preparadas para evitar inyecciones SQL
    $query = "INSERT INTO Usuario (nombre_usu, clave_usu, estado_usu, fecha_creado_usu, fecha_actualiza_usu, id_rol) VALUES ($1, $2, $3, $4, $5, $6)";
    $result = pg_query_params($conexion, $query, array($nombre_usu, $clave_usu, $estado_usu, $fecha_creado_usu, $fecha_actualiza_usu, $id_rol));

    // Verificar si la consulta fue exitosa
    if (!$result) {
        die("Error en la consulta: " . pg_last_error());
    }

    // Redireccionar después de la inserción
    redireccionar();
}

// Realiza la consulta para obtener la lista de usuarios
$query = "SELECT * FROM Usuario ORDER BY id_usu ASC"; // ASC para ordenar de menor a mayor (ascendente)
$result = pg_query($conexion, $query);

// Crear un array para almacenar los usuarios
$usuarios = array();
while ($row = pg_fetch_assoc($result)) {
    $usuarios[] = $row;
}

// Enviar los usuarios como respuesta JSON
echo json_encode($usuarios);

// Cerrar la conexión
pg_close($conexion);
?>
