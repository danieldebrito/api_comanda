<?php
require_once 'comanda_producto.php';
require_once 'IApiCRUD.php';



class comanda_productoApi extends comanda_producto implements IApiCRUD
{

    public function readAllApi($request, $response, $args)
    {
        $all = comanda_producto::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id = $args['id_comanda_producto'];
        $Ret = comanda_producto::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();

        $id_comanda_producto = $ArrayDeParametros['id_comanda_producto'];
        $id_empleado_cocina_bar = $ArrayDeParametros['id_empleado_cocina_bar'];
        $id_comanda = $ArrayDeParametros['id_comanda'];
        $id_producto = $ArrayDeParametros['id_producto'];
        $id_estado_producto = $ArrayDeParametros['id_estado_producto'];
        $cantidad = $ArrayDeParametros['cantidad'];

        $entity = new comanda_producto();
        $entity->id_comanda_producto = $id_comanda_producto;
        $entity->id_empleado_cocina_bar = $id_empleado_cocina_bar;
        $entity->id_comanda = $id_comanda;
        $entity->id_producto = $id_producto;
        $entity->id_estado_producto = $id_estado_producto;
        $entity->cantidad = $cantidad;

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

        /*
    comanda_productos
    comanda_producto
    public $id_comanda_producto;
    public $id_empleado_cocina_bar;
    public $id_comanda;
    public $id_producto;
    public $id_estado_producto;
    public $cantidad;
    */

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
}