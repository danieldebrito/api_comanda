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
        $id = $args['id_comanda'];
        $Ret = comanda::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {

        $ArrayDeParametros = $request->getParsedBody();

        $id_comanda = $ArrayDeParametros['id_comanda'];
        $id_empleado_mozo = $ArrayDeParametros['id_empleado_mozo'];
        $id_cliente = $ArrayDeParametros['id_cliente'];
        $id_encuesta = $ArrayDeParametros['id_encuesta'];
        $id_mesa = $ArrayDeParametros['id_mesa'];
        $id_estado_comanda = $ArrayDeParametros['id_estado_comanda'];
        $entregado_a_tiempo = $ArrayDeParametros['entregado_a_tiempo'];
        $fecha_comanda = $ArrayDeParametros['fecha_comanda'];


        $entity = new comanda();
        $entity->id_comanda = $id_comanda;
        $entity->id_empleado_mozo = $id_empleado_mozo;
        $entity->id_cliente = $id_cliente;
        $entity->id_encuesta = $id_encuesta;
        $entity->id_mesa = $id_mesa;
        $entity->id_estado_comanda = $id_estado_comanda;
        $entity->entregado_a_tiempo = $entregado_a_tiempo;
        $entity->fecha_comanda = $fecha_comanda;

        $entity->create();

        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_comanda"];
        $respuesta = cliente::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new cliente();
        $entity->id_comanda = $ArrayDeParametros['id_comanda'];
        $entity->id_empleado_mozo = $ArrayDeParametros['id_empleado_mozo'];
        $entity->id_cliente = $ArrayDeParametros['id_cliente'];
		$entity->id_encuesta = $ArrayDeParametros['id_encuesta'];
        $entity->id_mesa = $ArrayDeParametros['id_mesa'];
        $entity->id_estado_comanda = $ArrayDeParametros['id_estado_comanda'];
        $entity->entregado_a_tiempo = $ArrayDeParametros['entregado_a_tiempo'];
        $entity->fecha_comanda = $ArrayDeParametros['fecha_comanda'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }
}