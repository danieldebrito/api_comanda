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
});

$app->group('/comandas', function () {
  $this->get('/', \comandaApi::class . ':readAllApi');
  $this->get('/{id_comanda}', \comandaApi::class . ':readApi');
  $this->post('/', \comandaApi::class . ':createApi');
  $this->delete('/{id_comanda}[/]', \comandaApi::class . ':deleteApi');
  $this->post('/update', \comandaApi::class . ':updateApi');
});

$app->group('/empleados', function () {
  $this->get('/', \empleadoApi::class . ':readAllApi');
  $this->get('/{id_empleado}', \empleadoApi::class . ':readApi');
  $this->post('/', \empleadoApi::class . ':createApi');
  $this->delete('/{id_empleado}[/]', \empleadoApi::class . ':deleteApi');
  $this->post('/update', \empleadoApi::class . ':updateApi');
});

$app->group('/comanda_productos', function () {
  $this->get('/', \comanda_productoApi::class . ':readAllApi');
  $this->get('/{id_comanda_producto}', \comanda_productoApi::class . ':readApi');
  $this->post('/', \comanda_productoApi::class . ':createApi');
  $this->delete('/{id_comanda_producto}[/]', \comanda_productoApi::class . ':deleteApi');
  $this->post('/update', \comanda_productoApi::class . ':updateApi');
});

$app->group('/encuestas', function () {
  $this->get('/', \encuestaApi::class . ':readAllApi');
  $this->get('/{id_encuesta}', \encuestaApi::class . ':readApi');
  $this->post('/', \encuestaApi::class . ':createApi');
  $this->delete('/{id_encuesta}[/]', \encuestaApi::class . ':deleteApi');
  $this->post('/update', \encuestaApi::class . ':updateApi');
});

$app->group('/jornadas', function () {
  $this->get('/', \jornadaApi::class . ':readAllApi');
  $this->get('/{id_jornada}', \jornadaApi::class . ':readApi');
  $this->post('/', \jornadaApi::class . ':createApi');
  $this->delete('/{id_jornada}[/]', \jornadaApi::class . ':deleteApi');
  $this->post('/update', \jornadaApi::class . ':updateApi');
});

$app->group('/mesas', function () {
  $this->get('/', \mesaApi::class . ':readAllApi');
  $this->get('/{id_mesa}', \mesaApi::class . ':readApi');
  $this->post('/', \mesaApi::class . ':createApi');
  $this->delete('/{id_mesa}[/]', \mesaApi::class . ':deleteApi');
  $this->post('/update', \mesaApi::class . ':updateApi');
});

$app->group('/productos', function () {
  $this->get('/', \productosApi::class . ':readAllApi');
  $this->get('/{id_producto}', \productosApi::class . ':readApi');
  $this->post('/', \productosApi::class . ':createApi');
  $this->delete('/{id_producto}[/]', \productosApi::class . ':deleteApi');
  $this->post('/update', \productosApi::class . ':updateApi');
});

// cors habilitadas
$app->add(function ($req, $res, $next) {
  $response = $next($req, $res);
  return $response
          ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
          ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
          ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->run();


/*

$app->group('/cliente', function () {
    // http://localhost/api_meyro_sgc/app/index.php/maquina/
  $this->get('/', \maquinaApi::class . ':getAll');

    // http://localhost/api_meyro_sgc/app/index.php/maquina/200
  $this->get('/{id}', \maquinaApi::class . ':getOne');

    // http://localhost/api_meyro_sgc/app/index.php/maquina/  
    // +  body  +  form-data  y poner los parametros, 
  $this->post('/', \maquinaApi::class . ':setOne');

  $this->delete('/{id}[/]', \maquinaAPI::class . ':delete');

    // http://localhost/api_meyro_sgc/app/index.php/maquina/update/
    // +  body  +  form-data  y poner todos los parametros
  $this->post('/update[/]', \maquinaApi::class . ':updateOne');    ////////  VER NO FUNCA
});

*/