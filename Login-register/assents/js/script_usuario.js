document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSeccion);
document.getElementById("btn_registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPagina);
var contenedor_login_register = document.querySelector(".contenedor_login-register");
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var caja_trasera_login = document.querySelector(".caja_trasera-login");
var caja_trasera_register = document.querySelector(".caja_trasera-register");
function anchoPagina(){
    if(window.innerWidth>850){
caja_trasera_login.style.display = "block";
caja_trasera_register.style.display="block";
    }else{
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
caja_trasera_register.style.display="none";
formulario_login.style.display="block";
formulario_register.style.display="none";
contenedor_login_register.style.left="0px";
    }
}
anchoPagina();

function iniciarSeccion() {
    if(window.innerWidth > 850){
    formulario_login.style.display = "block";
    contenedor_login_register.style.left = "10px"; // You can adjust the left value
    formulario_register.style.display = "none";
    caja_trasera_login.style.opacity = "0";
    caja_trasera_register.style.opacity = "1";
}else{
    formulario_login.style.display = "block";
    contenedor_login_register.style.left = "0px"; // You can adjust the left value
    formulario_register.style.display = "none";
    caja_trasera_login.style.display = "none";
    caja_trasera_register.style.display = "block";
}

    }
    
    anchoPagina();
function register() {
    if (window.innerWidth > 850) {
        // If the window width is greater than 850 pixels
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        // If the window width is 850 pixels or less
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
    
   
}
/*alert("hola mundo");const express = require('express');
const app = express();
const pgp = require('pg-promise')();
const bodyParser = require('body-parser');
const PORT = process.env.PORT || 600;

// Configura la conexión a la base de datos PostgreSQL
const db = pgp('postgresql://postgres:admin@localhost:5432/gugu1');

// Middleware para parsear JSON y datos en formularios
app.use(bodyParser.json());

// Crear la tabla "personas" si no existe (puedes hacerlo fuera de la función asincrónica)
db.none('CREATE TABLE IF NOT EXISTS personas (id SERIAL PRIMARY KEY, ruc_ci NUMERIC, nombre TEXT, apellido TEXT, edad NUMERIC, direccion TEXT, email TEXT, telefono TEXT)')
  .then(() => {
    console.log('Tabla "personas" creada con éxito');
  })
  .catch(error => {
    console.error('Error al crear la tabla: ', error);
  });

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor escuchando en el puerto ${PORT}`);
});
app.post('/guardarpersona', async (req, res) => {
    try {
      const { ruc_ci, nombre, apellido, edad, direccion, email, telefono } = req.body;
  
      const result = await db.one(
        'INSERT INTO personas (ruc_ci, nombre, apellido, edad, direccion, email, telefono) VALUES ($1, $2, $3, $4, $5, $6, $7) RETURNING id',
        [ruc_ci, nombre, apellido, edad, direccion, email, telefono]
      );
  
      console.log('Persona guardada');
      res.status(201).json({ message: 'Persona guardada 123' });
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'Error al guardar persona en la base de datos' });
    }
  });*/