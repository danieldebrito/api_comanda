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

        $id_encuesta = $ArrayDeParametros['id_encuesta'];
        $calificacion_mozo = $ArrayDeParametros['calificacion_mozo'];
        $calificacion_cocinero = $ArrayDeParametros['calificacion_cocinero'];
        $calificacion_mesa = $ArrayDeParametros['calificacion_mesa'];
        $calificacion_restaurante = $ArrayDeParametros['calificacion_restaurante'];
        $comentario = $ArrayDeParametros['comentario'];

        $entity = new encuesta();
        $entity->id_encuesta = $id_encuesta;
        $entity->calificacion_mozo = $calificacion_mozo;
        $entity->calificacion_cocinero = $calificacion_cocinero;
        $entity->calificacion_mesa = $calificacion_mesa;
        $entity->calificacion_restaurante = $calificacion_restaurante;
        $entity->comentario = $comentario;

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_encuesta"];
        $respuesta = encuesta::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new encuesta();
        $entity->id_encuesta = $ArrayDeParametros['id_encuesta'];
        $entity->calificacion_mozo = $ArrayDeParametros['calificacion_mozo'];
        $entity->calificacion_cocinero = $ArrayDeParametros['calificacion_cocinero'];
        $entity->calificacion_mesa = $ArrayDeParametros['calificacion_mesa'];
        $entity->calificacion_restaurante = $ArrayDeParametros['calificacion_restaurante'];
        $entity->comentario = $ArrayDeParametros['comentario'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }
}
