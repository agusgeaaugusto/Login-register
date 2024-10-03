function crearProveedor() {
    // Obtener datos del formulario
    var nombre = document.getElementById("nombre_proveedor").value;
    var ruc = document.getElementById("ruc_proveedor").value;
    var direccion = document.getElementById("direccion_proveedor").value;
    var telefono = document.getElementById("telefono_proveedor").value;

    // Validar que los campos no estén vacíos
    if (nombre === "" || ruc === "" || direccion === "" || telefono === "") {
        alert("Por favor, complete todos los campos.");
        return;
    }

    // Realizar la solicitud AJAX para crear un nuevo proveedor
    // Aquí debes hacer una llamada a tu servidor (PHP, Node.js, etc.) para manejar la inserción en la base de datos.
    // Puedes usar la función fetch o jQuery.ajax para ello.

    // Ejemplo con fetch
    fetch('crear_proveedor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            nombre: nombre,
            ruc: ruc,
            direccion: direccion,
            telefono: telefono
        }),
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("resultado").innerHTML = data.message;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function leerProveedores() {
    // Realizar la solicitud AJAX para obtener la lista de proveedores
    // Aquí debes hacer una llamada a tu servidor para obtener los datos de la base de datos.

    // Ejemplo con fetch
    fetch('leer_proveedores.php')
    .then(response => response.json())
    .then(data => {
        // Manipular los datos recibidos (puedes mostrarlos en una tabla, por ejemplo)
        document.getElementById("resultado").innerHTML = "Datos de proveedores: " + JSON.stringify(data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

// Implementar las funciones actualizarProveedor() y eliminarProveedor() de manera similar a crearProveedor()
