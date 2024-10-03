<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal Moderna</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    /* Mantén el estilo existente */
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f7f6;
      color: #333;
      height: 100vh;
    }

    .topbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: #007bff;
      color: #fff;
      padding: 15px 20px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: -250px;
      width: 250px;
      height: 100%;
      background-color: #343a40;
      color: #fff;
      padding-top: 60px;
      transition: left 0.3s ease;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .sidebar.open {
      left: 0;
    }

    .sidebar .profile {
      text-align: center;
      padding: 20px 0;
      border-bottom: 1px solid #495057;
    }

    .sidebar .profile img {
      border-radius: 50%;
      width: 80px;
      height: 80px;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .sidebar .profile h4 {
      margin-bottom: 5px;
      font-size: 18px;
    }

    .sidebar .profile p {
      font-size: 14px;
      color: #adb5bd;
    }

    .sidebar .search-box {
      padding: 15px;
      border-bottom: 1px solid #495057;
    }

    .sidebar .search-box input {
      width: 100%;
      padding: 10px;
      border-radius: 30px;
      border: none;
      background-color: #495057;
      color: #fff;
      font-size: 14px;
    }

    .sidebar .search-box input::placeholder {
      color: #adb5bd;
    }

    .sidebar a {
      display: block;
      padding: 15px;
      color: #fff;
      text-decoration: none;
      font-size: 16px;
      border-bottom: 1px solid #495057;
      transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #007bff;
      color: #fff;
    }

    #main {
      margin-left: 0;
      transition: margin-left 0.3s ease;
      padding: 60px 20px;
    }

    #main.open {
      margin-left: 250px;
    }

    .hero {
      background: linear-gradient(120deg, #007bff, #6610f2);
      color: #fff;
      text-align: center;
      padding: 100px 20px;
      border-radius: 10px;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
      margin-bottom: 30px;
    }

    .hero h1 {
      font-size: 48px;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .hero .cta {
      background-color: #ff5722;
      color: #fff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .hero .cta:hover {
      background-color: #e64a19;
    }

    .quick-access {
      text-align: center;
      margin-bottom: 30px;
    }

    .quick-access h2 {
      font-size: 32px;
      margin-bottom: 30px;
      color: #007bff;
    }

    .quick-access .row {
      justify-content: center;
    }

    .quick-button {
      background-color: #007bff;
      color: #fff;
      font-size: 24px;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s ease;
      margin: 10px;
    }

    .quick-button:hover {
      background-color: #0056b3;
    }

    footer {
      background-color: #343a40;
      color: #fff;
      padding: 20px;
      text-align: center;
      margin-top: 30px;
      border-radius: 10px;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }

    footer p {
      margin: 5px 0;
    }

    footer .social i {
      font-size: 20px;
      color: #fff;
      margin: 0 10px;
      transition: color 0.3s ease;
    }

    footer .social i:hover {
      color: #007bff;
    }
  </style>
</head>
<body>

<div class="topbar">
  <button class="btn btn-light" onclick="toggleNav()"><i class="fas fa-bars"></i></button>
  <h2 class="d-inline-block ml-3">CARVALLO BODEGA</h2>
  <div class="ml-auto">
    <i class="fas fa-user-circle fa-2x"></i>
  </div>
</div>

<div class="sidebar" id="mySidebar">
  <div class="profile text-center">
    <img src="https://via.placeholder.com/80" alt="Perfil">
    <h4>Nombre Usuario</h4>
    <p>Administrador</p>
  </div>

  <div class="search-box">
    <input type="text" placeholder="Buscar...">
  </div>

  <a href="cargos/cargo.php"><i class="fas fa-user-tie"></i> Cargos</a>
  <a href="comprovante/comprovante.php"><i class="fas fa-receipt"></i> Comprovante</a>
  <a href="persona/persona.php"><i class="fas fa-user"></i> Persona</a>
  <a href="proveedor/proveedor.php"><i class="fas fa-truck"></i> Proveedor</a>
  <a href="usuario/usuario.php"><i class="fas fa-users"></i> Usuario</a>
  <a href="rol/rol.php"><i class="fas fa-users-cog"></i> Rol</a>
  <a href="compra/compra.php"><i class="fas fa-shopping-cart"></i> Compra</a>
  <a href="producto/producto.php"><i class="fas fa-box"></i> Producto</a>
  <a href="moneda/moneda.php"><i class="fas fa-users"></i> Moneda</a>
</div>

<div id="main">
  <section class="hero">
    <h1>Bienvenidos a Carvallo Bodega</h1>
    <p>Ofrecemos productos de calidad directamente del productor al consumidor.</p>
    <a href="#" class="cta">Conoce Más</a>
  </section>

  <div class="quick-access">
    <h2>Acceso Rápido</h2>
    <div class="row">
      <div class="col-auto">
        <button class="quick-button" data-toggle="modal" data-target="#agregarCargoModal"><i class="fas fa-plus"></i></button>
        <button class="quick-button" data-toggle="modal" data-target="#registroModal"><i class="fas fa-user-plus"></i></button>
      </div>
    </div>
  </div>
</div>

<footer>
  <p>&copy; 2024 Carvallo Bodega. Todos los derechos reservados.</p>
  <div class="social">
    <i class="fab fa-facebook-f"></i>
    <i class="fab fa-twitter"></i>
    <i class="fab fa-instagram"></i>
  </div>
</footer>

<!-- Modal para agregar cargo -->
<div class="modal fade" id="agregarCargoModal" tabindex="-1" aria-labelledby="agregarCargoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregarCargoLabel">Agregar Cargo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí va el formulario para agregar cargo -->
        <form>
          <div class="form-group">
            <label for="cargoName">Nombre del Cargo</label>
            <input type="text" class="form-control" id="cargoName" placeholder="Nombre del Cargo">
          </div>
          <div class="form-group">
            <label for="cargoDescription">Descripción del Cargo</label>
            <textarea class="form-control" id="cargoDescription" rows="3" placeholder="Descripción"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para el registro -->
<div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registroLabel">Registrar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario de registro -->
        <form>
          <div class="form-group">
            <label for="nombreCliente">Nombre</label>
            <input type="text" class="form-control" id="nombreCliente" placeholder="Nombre">
          </div>
          <div class="form-group">
            <label for="apellidoCliente">Apellido</label>
            <input type="text" class="form-control" id="apellidoCliente" placeholder="Apellido">
          </div>
          <div class="form-group">
            <label for="telefonoCliente">Teléfono</label>
            <input type="tel" class="form-control" id="telefonoCliente" placeholder="Teléfono">
          </div>
          <div class="form-group">
            <label for="emailCliente">Email</label>
            <input type="email" class="form-control" id="emailCliente" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="direccionCliente">Dirección</label>
            <textarea class="form-control" id="direccionCliente" rows="3" placeholder="Dirección"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleNav() {
    var sidebar = document.getElementById('mySidebar');
    var main = document.getElementById('main');
    sidebar.classList.toggle('open');
    main.classList.toggle('open');
  }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
