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

        $id_comanda = $ArrayDeParametros['id_comanda'];
        $id_empleado_mozo = $ArrayDeParametros['id_empleado_mozo'];
        $id_cliente = $ArrayDeParametros['id_cliente'];
        $id_encuesta = $ArrayDeParametros['id_encuesta'];
        $id_mesa = $ArrayDeParametros['id_mesa'];
        $id_estado_comanda = $ArrayDeParametros['id_estado_comanda'];
        $entregado_a_tiempo = $ArrayDeParametros['entregado_a_tiempo'];
        $fecha_comanda = $ArrayDeParametros['fecha_comanda'];


        $entiti = new comanda();

        $entiti->id_comanda = $id_comanda;
        $entiti->id_empleado_mozo = $id_empleado_mozo;
        $entiti->id_cliente = $id_cliente;
        $entiti->id_encuesta = $id_encuesta;
        $entiti->id_mesa = $id_mesa;
        $entiti->id_estado_comanda = $id_estado_comanda;
        $entiti->entregado_a_tiempo = $entregado_a_tiempo;
        $entiti->fecha_comanda = $fecha_comanda;

        $entiti->create();

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