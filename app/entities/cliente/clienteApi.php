<?php
require_once 'cliente.php';
require_once 'IApiCRUD.php';

class clienteApi extends cliente implements IApiCRUD
{

    public function readAllApi($request, $response, $args)
    {
        $all = cliente::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id_cliente = $args['id_cliente'];
        $clienteRet = cliente::read($id_cliente);
        $newResponse = $response->withJson($clienteRet, 200);
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
