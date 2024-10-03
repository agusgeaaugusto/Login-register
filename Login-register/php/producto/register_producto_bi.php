<?php
include 'conexion_bi.php';

// Función para redirigir a la página principal después de realizar una operación
function redireccionar() {
    header("Location: register_producto_bi.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar y limpiar datos del formulario
    $nombre_pro = htmlspecialchars($_POST['nombre_pro']);
    $precio1_pro = htmlspecialchars($_POST['precio1_pro']);
    $precio2_pro = htmlspecialchars($_POST['precio2_pro']);
    $precio3_pro = htmlspecialchars($_POST['precio3_pro']);
    $cantidad_caja_pro = htmlspecialchars($_POST['cantidad_caja_pro']);
    $cantidad_uni_pro = htmlspecialchars($_POST['cantidad_uni_pro']);
    $costo_caja_pro = htmlspecialchars($_POST['costo_caja_pro']);
    $codigo_barra_pro = htmlspecialchars($_POST['codigo_barra_pro']);
    $costo_uni_pro = htmlspecialchars($_POST['costo_uni_pro']);

    // Validar los datos
    if (empty($nombre_pro) || empty($precio1_pro) || empty($precio2_pro) || empty($precio3_pro) ||
        empty($cantidad_caja_pro) || empty($cantidad_uni_pro) || empty($costo_caja_pro) || 
        empty($codigo_barra_pro) || empty($costo_uni_pro)) {
        die("Por favor, completa todos los campos del formulario.");
    }

    // Preparar y ejecutar la consulta
    $query = "INSERT INTO Producto (nombre_pro, precio1_pro, precio2_pro, precio3_pro, cantidad_caja_pro, cantidad_uni_pro, costo_caja_pro, costo_uni_pro, codigo_barra_pro) 
              VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)";
    $params = array($nombre_pro, $precio1_pro, $precio2_pro, $precio3_pro, $cantidad_caja_pro, $cantidad_uni_pro, $costo_caja_pro, $costo_uni_pro, $codigo_barra_pro);
    $result = pg_query_params($conexion, $query, $params);

    // Verificar si la consulta fue exitosa
    if (!$result) {
        die("Error en la consulta: " . pg_last_error());
    }

    // Redireccionar después de la inserción
    redireccionar();
}

// Consultar y devolver la lista de productos en formato JSON
$query = "SELECT * FROM Producto ORDER BY id_pro ASC";
$result = pg_query($conexion, $query);
$productos = array();

while ($row = pg_fetch_assoc($result)) {
    $productos[] = $row;
}

echo json_encode($productos);
pg_close($conexion);
?>
