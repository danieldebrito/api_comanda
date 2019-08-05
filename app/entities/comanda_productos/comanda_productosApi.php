<?php
require_once 'comanda_productos.php';
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
        $id_comanda = $ArrayDeParametros['id_comanda'];
        $id_producto = $ArrayDeParametros['id_producto'];
        $id_empleado = $ArrayDeParametros['id_empleado'];
        $id_estado_producto = $ArrayDeParametros['id_estado_producto'];
        $cantidad = $ArrayDeParametros['cantidad'];

        $entity = new comanda_producto();
        $entity->id_comanda_producto = $id_comanda_producto;
        $entity->id_comanda = $id_comanda;
        $entity->id_producto = $id_producto;
        $entity->id_empleado = $id_empleado;
        $entity->id_estado_producto = $id_estado_producto;
        $entity->cantidad = $cantidad;

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_comanda_producto"];
        $respuesta = comanda_producto::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new comanda_producto();
        $entity->id_comanda_producto = $ArrayDeParametros['id_comanda_producto'];
        $entity->id_comanda = $ArrayDeParametros['id_comanda'];
        $entity->id_producto = $ArrayDeParametros['id_producto'];
        $entity->id_empleado = $ArrayDeParametros['id_empleado'];
        $entity->id_estado_producto = $ArrayDeParametros['id_estado_producto'];
        $entity->cantidad = $ArrayDeParametros['cantidad'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }

    public function masVendidoApi($request, $response, $args)
    {
        $all = comanda_producto::masVendido();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function menosVendidoApi($request, $response, $args)
    {
        $all = comanda_producto::menosVendido();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }
}

