<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../composer/vendor/autoload.php';
require './AccesoDatos.php';

///////////////////   ENTITIES  ///////////
require './entities/cliente/clienteApi.php';
require './entities/comanda/comandaApi.php';
require './entities/empleados/empleadoApi.php';
require './entities/comanda_productos/comanda_productosApi.php';
require './entities/encuestas/encuestasApi.php';
require './entities/jornadas/jornadasApi.php';
require './entities/mesas/mesasApi.php';
require './entities/productos/productosApi.php';

///////////////////   MIDDLEWARE  ///////////
require_once './middleware/MWAuth.php';
require_once './middleware/MWparaCORS.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->get("/", function() {
  echo "
  <p style='font-size:50px;'>Hola mundo desde api_comanda</p> 
  <br> <br> 
  <p style='font-family:courier;'>Conexion ok con la API.</p>
  ";
});

$app->group('/clientes', function () {
  $this->get('/', \clienteApi::class . ':readAllApi');
  $this->get('/{id_cliente}', \clienteApi::class . ':readApi');
  $this->post('/', \clienteApi::class . ':createApi');
  $this->delete('/{id_cliente}[/]', \clienteApi::class . ':deleteApi');
  $this->post('/update', \clienteApi::class . ':updateApi');
})
->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/comandas', function () {
  $this->get('/', \comandaApi::class . ':readAllApi');
  $this->get('/{id_comanda}', \comandaApi::class . ':readApi');
  $this->post('/', \comandaApi::class . ':createApi');
  $this->delete('/{id_comanda}[/]', \comandaApi::class . ':deleteApi');
  $this->post('/update', \comandaApi::class . ':updateApi');
})
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/fueraTiempo', \comandaApi::class . ':fueraTiempoApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/canceladas', \comandaApi::class . ':canceladasApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');


$app->group('/empleados', function () {
  $this->get('/', \empleadoApi::class . ':readAllApi');
  $this->get('/{id_empleado}', \empleadoApi::class . ':readApi');
  $this->post('/', \empleadoApi::class . ':createApi');
  $this->delete('/{id_empleado}[/]', \empleadoApi::class . ':deleteApi');
  $this->post('/update', \empleadoApi::class . ':updateApi');
})
->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->get('/horarios', \empleadoApi::class . ':horariosAllApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
//->add(\MWAuth.php::class . ':ValidarSocio');

$app->get('/operaciones', \empleadoApi::class . ':operacionesAllApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/operEmpSecAll', \empleadoApi::class . ':operEmpSecAllApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/operEmpSec/{id_empleado}', \empleadoApi::class . ':operEmpSecApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');


$app->group('/comanda_productos', function () {
  $this->get('/', \comanda_productoApi::class . ':readAllApi');
  $this->get('/{id_comanda_producto}', \comanda_productoApi::class . ':readApi');
  $this->post('/', \comanda_productoApi::class . ':createApi');
  $this->delete('/{id_comanda_producto}[/]', \comanda_productoApi::class . ':deleteApi');
  $this->post('/update', \comanda_productoApi::class . ':updateApi');
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/masvendido', \comanda_productoApi::class . ':masVendidoApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/menosvendido', \comanda_productoApi::class . ':menosVendidoApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');



$app->group('/encuestas', function () {
  $this->get('/', \encuestaApi::class . ':readAllApi');
  $this->get('/{id_encuesta}', \encuestaApi::class . ':readApi');
  $this->post('/', \encuestaApi::class . ':createApi');
  $this->delete('/{id_encuesta}[/]', \encuestaApi::class . ':deleteApi');
  $this->post('/update', \encuestaApi::class . ':updateApi');
})
->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/jornadas', function () {
  $this->get('/', \jornadaApi::class . ':readAllApi');
  $this->get('/{id_jornada}', \jornadaApi::class . ':readApi');
  $this->post('/', \jornadaApi::class . ':createApi');
  $this->delete('/{id_jornada}[/]', \jornadaApi::class . ':deleteApi');
  $this->post('/update', \jornadaApi::class . ':updateApi');
})
->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/mesas', function () {
  $this->get('/', \mesaApi::class . ':readAllApi');
  $this->get('/{id_mesa}', \mesaApi::class . ':readApi');
  $this->post('/', \mesaApi::class . ':createApi');
  $this->delete('/{id_mesa}[/]', \mesaApi::class . ':deleteApi');
  $this->post('/update', \mesaApi::class . ':updateApi');
})
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/mesaMasUsada', \mesaApi::class . ':mesaMasUsadaApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/mesaMenosUsada', \mesaApi::class . ':mesaMenosUsadaApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/mesaMasFacturo', \mesaApi::class . ':mesaMasFacturoApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/mesaMenosFacturo', \mesaApi::class . ':mesaMenosFacturoApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/mesaFacMAyor', \mesaApi::class . ':mesaFacMAyorApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');
$app->get('/mesaFacMenor', \mesaApi::class . ':mesaFacMenorApi')
->add(\MWparaCORS::class . ':HabilitarCORSTodos');



$app->group('/productos', function () {
  $this->get('/', \productoApi::class . ':readAllApi');
  $this->get('/{id_producto}', \productoApi::class . ':readApi');
  $this->post('/', \productoApi::class . ':createApi');
  $this->delete('/{id_producto}[/]', \productoApi::class . ':deleteApi');
  $this->post('/update', \productoApi::class . ':updateApi');
})
->add(\MWparaCORS::class . ':HabilitarCORSTodos');



$app->run();