<?php
require_once 'productos.php';
require_once 'IApiCRUD.php';

class productoApi extends producto implements IApiCRUD
{
    public function readAllApi($request, $response, $args)
    {
        $all = producto::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id = $args['id_producto'];
        $Ret = producto::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();

        $id_producto = $ArrayDeParametros['id_producto'];
        $id_sector = $ArrayDeParametros['id_sector'];
        $producto = $ArrayDeParametros['producto'];
        $tiempo_preparacion = $ArrayDeParametros['tiempo_preparacion'];
        $precio = $ArrayDeParametros['precio'];

        $entity = new producto();
        $entity->id_producto = $id_producto;
        $entity->id_sector = $id_sector;
        $entity->producto = $producto;
        $entity->tiempo_preparacion = $tiempo_preparacion;
        $entity->precio = $precio;

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_producto"];
        $respuesta = producto::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new producto();
        $entity->id_producto = $ArrayDeParametros['id_producto'];
        $entity->id_sector = $ArrayDeParametros['id_sector'];
        $entity->producto = $ArrayDeParametros['producto'];
        $entity->tiempo_preparacion = $ArrayDeParametros['tiempo_preparacion'];
        $entity->precio = $ArrayDeParametros['precio'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }
}
