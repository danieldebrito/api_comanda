<?php
require_once 'jornadas.php';
require_once 'IApiCRUD.php';

class jornadaApi extends jornada implements IApiCRUD
{
    public function readAllApi($request, $response, $args)
    {
        $all = jornada::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id = $args['id_jornada'];
        $Ret = jornada::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();

        $id_jornada = $ArrayDeParametros['id_jornada'];
        $id_empleado = $ArrayDeParametros['id_empleado'];
        $entrada_fecha = $ArrayDeParametros['entrada_fecha'];
        $entrada_hora = $ArrayDeParametros['entrada_hora'];
        $salida_hora = $ArrayDeParametros['salida_hora'];

        $entity = new jornada();
        $entity->id_jornada = $id_jornada;
        $entity->id_empleado = $id_empleado;
        $entity->entrada_fecha = $entrada_fecha;
        $entity->entrada_hora = $entrada_hora;
        $entity->salida_hora = $salida_hora;

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_jornada"];
        $respuesta = jornada::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new jornada();
        $entity->id_jornada = $ArrayDeParametros['id_jornada'];
        $entity->id_empleado = $ArrayDeParametros['id_empleado'];
        $entity->entrada_fecha = $ArrayDeParametros['entrada_fecha'];
        $entity->entrada_hora = $ArrayDeParametros['entrada_hora'];
        $entity->salida_hora = $ArrayDeParametros['salida_hora'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }
}
