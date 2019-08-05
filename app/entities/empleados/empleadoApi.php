<?php
require_once 'empleado.php';
require_once 'IApiCRUD.php';



class empleadoApi extends empleado implements IApiCRUD
{

    public function readAllApi($request, $response, $args)
    {
        $all = empleado::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id = $args['id_empleado'];
        $Ret = empleado::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {

        $ArrayDeParametros = $request->getParsedBody();

        $id_empleado = $ArrayDeParametros['id_empleado'];
        $rol_empleado = $ArrayDeParametros['rol_empleado'];
        $id_estado_empleado = $ArrayDeParametros['id_estado_empleado'];
        $nombre_y_apellido = $ArrayDeParametros['nombre_y_apellido'];


        $entity = new empleado();
        $entity->id_empleado = $id_empleado;
        $entity->rol_empleado = $rol_empleado;
        $entity->id_estado_empleado = $id_estado_empleado;
        $entity->nombre_y_apellido = $nombre_y_apellido;

        $entity->create();

        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_empleado"];
        $respuesta = empleado::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new empleado();
        $entity->id_empleado = $ArrayDeParametros['id_empleado'];
        $entity->rol_empleado = $ArrayDeParametros['rol_empleado'];
        $entity->id_estado_empleado = $ArrayDeParametros['id_estado_empleado'];
		$entity->nombre_y_apellido = $ArrayDeParametros['nombre_y_apellido'];

        
        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }

    public function horariosAllApi($request, $response, $args)
    {
        $all = empleado::horariosAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function operacionesAllApi($request, $response, $args)
    {
        $all = empleado::operacionesAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function operEmpSecAllApi($request, $response, $args)
    {
        $all = empleado::operEmpSecAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function operEmpSecApi($request, $response, $args)
    {
        $id = $args['id_empleado'];
        $Ret = empleado::operEmpSec($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }
}

