<?php
require_once 'cliente.php';
require_once 'IApiCRUD.php';

class clienteApi extends cliente implements IApiCRUD {

	public function readAllApi($request, $response, $args) {
		$all=cliente::readAll();
		$newResponse = $response->withJson($all, 200);
		return $newResponse;
	}

	public function readApi($request, $response, $args) {
		$id_cliente=$args['id_cliente'];
		var_dump($args);
	 	$clienteRet = cliente::read($id_cliente);
		$newResponse = $response->withJson($clienteRet, 200);  
	 	return $newResponse;
 }
}

/*
 public function setOne($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

		$idMaquina = $ArrayDeParametros['idMaquina'];
		$detalle = $ArrayDeParametros['detalle'];
		$marca = $ArrayDeParametros['marca'];
		$sector = $ArrayDeParametros['sector'];
		$estado = $ArrayDeParametros['estado'];
		$urlImagen = $ArrayDeParametros['urlImagen'];
		$fabricanteNombre = $ArrayDeParametros['fabricanteNombre'];
		$fabricanteDireccion = $ArrayDeParametros['fabricanteDireccion'];
		$fabricanteTelefono = $ArrayDeParametros['fabricanteTelefono'];
		$fabricanteContacto = $ArrayDeParametros['fabricanteContacto'];

		$maquina = new maquina();

		$maquina->idMaquina=$idMaquina;
		$maquina->detalle=$detalle;
		$maquina->marca=$marca;
		$maquina->sector=$sector;
		$maquina->estado=$estado;
		$maquina->urlImagen=$urlImagen;
		$maquina->fabricanteNombre=$fabricanteNombre;
		$maquina->fabricanteDireccion=$fabricanteDireccion;
		$maquina->fabricanteTelefono=$fabricanteTelefono;
		$maquina->fabricanteContacto=$fabricanteContacto;
		
		$maquina->CargarUno();

		$response->getBody()->write("true");

		return $response;
}

    public function delete($request,$response,$args){
        $id = $args["id"];
        $respuesta = maquina::Baja($id);
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }

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