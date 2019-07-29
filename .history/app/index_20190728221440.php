<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../composer/vendor/autoload.php';
require './AccesoDatos.php';

///////////////////////////////////// entidades ///////////
require './entities/cliente/clienteApi.php';


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

$app->group('/clientes', function () {
  $this->get('/', \clienteApi::class . ':readAllApi');
  $this->get('/{id_cliente}', \clienteApi::class . ':readApi');
  $this->post('/', \clienteApi::class . ':createApi');
  $this->delete('/{id_cliente}[/]', \clienteApi::class . ':deleteApi');
  $this->post('/update', \clienteApi::class . ':updateApi');
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