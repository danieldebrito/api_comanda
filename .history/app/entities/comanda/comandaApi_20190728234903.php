<?php
require_once 'comanda.php';
require_once 'IApiCRUD.php';

class comandaApi extends comanda implements IApiCRUD
{

    public function readAllApi($request, $response, $args)
    {
        $all = comanda::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id_cliente = $args['id_comanda'];
        $Ret = cliente::read($id_cliente);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {

        $ArrayDeParametros = $request->getParsedBody();

        $id_cliente = $ArrayDeParametros['id_cliente'];
        $nombre_y_apellido = $ArrayDeParametros['nombre_y_apellido'];
        $dni = $ArrayDeParametros['dni'];
        $sexo = $ArrayDeParametros['sexo'];
        $edad = $ArrayDeParametros['edad'];

        $cliente = new cliente();

        $cliente->id_cliente = $id_cliente;
        $cliente->nombre_y_apellido = $nombre_y_apellido;
        $cliente->dni = $dni;
        $cliente->sexo = $sexo;
        $cliente->edad = $edad;

        $cliente->create();

        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id_cliente = $args["id_cliente"];
        $respuesta = cliente::delete($id_cliente);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $cliente = new cliente();
        $cliente->id_cliente = $ArrayDeParametros['id_cliente'];
        $cliente->nombre_y_apellido = $ArrayDeParametros['nombre_y_apellido'];
        $cliente->dni = $ArrayDeParametros['dni'];
		$cliente->sexo = $ArrayDeParametros['sexo'];
		$cliente->edad = $ArrayDeParametros['edad'];

        $resultado = $cliente->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }
}

/*

public function updateOne($request, $response, $args) {

$ArrayDeParametros = $request->getParsedBody();

var_dump($ArrayDeParametros);

$MiMaquina = new maquina();

// $MiMaquina->idMaquina=$ArrayDeParametros["idMaquina"];
$MiMaquina->detalle=$ArrayDeParametros["detalle"];
$MiMaquina->marca=$ArrayDeParametros["marca"];
$MiMaquina->sector=$ArrayDeParametros["sector"];
$MiMaquina->estado=$ArrayDeParametros["estado"];
$MiMaquina->urlImagen=$ArrayDeParametros["urlImagen"];
$MiMaquina->fabricanteNombre=$ArrayDeParametros["fabricanteNombre"];
$MiMaquina->fabricanteDireccion=$ArrayDeParametros["fabricanteDireccion"];
$MiMaquina->fabricanteTelefono=$ArrayDeParametros["fabricanteTelefono"];
$MiMaquina->fabricanteContacto=$ArrayDeParametros["fabricanteContacto"];

$resultado = $MiMaquina->ModificarUno();
$objDelaRespuesta= new stdclass();

$objDelaRespuesta->resultado=$resultado;
return $response->withJson($objDelaRespuesta, 200);
}

 */
