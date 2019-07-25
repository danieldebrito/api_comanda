<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

header('Access-Control-Allow-Origin: *');

require '../composer/vendor/autoload.php';
require './AccesoDatos.php';

///////////////////////////////////// entidades ///////////
require './maquina/maquinas/maquinaApi.php';
require './maquina/especificaciones/especificacionApi.php';
require './maquina/repuestos/repuestoApi.php';
require './maquina/repuestos/maquina_repuestoApi.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->get("/", function() {
  echo "
  <p style='font-size:50px;'>Hola mundo desde api_meyro_sgc</p> 
  <br> <br> 
  <p style='font-family:courier;'>Conexion ok con la API.</p>
  ";
});

$app->group('/maquina', function () {
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

$app->group('/especificacion', function () {
// http://localhost/api_meyro_sgc/app/index.php/especificacion/
$this->get('/', \especificacionApi::class . ':getAll');
// http://localhost/api_meyro_sgc/app/index.php/especificacion/17
$this->get('/{id}', \especificacionApi::class . ':getOne');

$this->get('/maquinas/{id}', \especificacionApi::class . ':getAllMaquina');
// http://localhost/api_meyro_sgc/app/index.php/especificacion/
$this->post('/', \especificacionApi::class . ':setOne');
// http://localhost/api_meyro_sgc/app/index.php/especificacion/17
$this->delete('/{id}[/]', \especificacionApi::class . ':delete');

$this->delete('/maquina/{id}[/]', \especificacionApi::class . ':deleteTodosMaquina');
// http://localhost/api_meyro_sgc/app/index.php/especificacion/update/
$this->post('/update[/]', \especificacionApi::class . ':updateOne');
});

$app->group('/maquinaRepuesto', function () {
  $this->get('/', \repuestoApi::class . ':getAll');
  $this->get('/porMaquina/{id}[/]', \repuestoApi::class . ':getAllMachine');
  $this->get('/{id}', \repuestoApi::class . ':getOne');
  $this->post('/', \repuestoApi::class . ':setOne');
  $this->delete('/{id}[/]', \repuestoApi::class . ':delete');
  $this->post('/update[/]', \repuestoApi::class . ':updateOne');
  });

  $app->group('/maqRto', function () {
    $this->post('/', \MaquinaRepuesto::class . ':setOne');
    $this->delete('/{id}[/]', \MaquinaRepuesto::class . ':delete');
  });

// cors habilitadas
$app->add(function ($req, $res, $next) {
  $response = $next($req, $res);
  return $response
          //->withHeader('Access-Control-Allow-Origin', 'http://juntasmeyro.com.ar')
         // ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
          ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
          ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->run();