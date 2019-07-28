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
		$id_cliente=$args['id'];
	 	$clienteRet = cliente::read($id_cliente);
		$newResponse = $response->withJson($clienteRet, 200);  
	 	return $newResponse;
	 }
	 
	 public function CreateApi($request, $response, $args) {

		$ArrayDeParametros = $request->getParsedBody();

		$id_cliente = $ArrayDeParametros['id_cliente'];
		$nombre_y_apellido = $ArrayDeParametros['nombre_y_apellido'];
		$dni = $ArrayDeParametros['dni'];
		$sexo = $ArrayDeParametros['sexo'];
		$edad = $ArrayDeParametros['edad'];

		$cliente = new cliente();

		$cliente->id_cliente=$id_cliente;
		$cliente->nombre_y_apellido=$nombre_y_apellido;
		$cliente->dni=$dni;
		$cliente->sexo=$sexo;
		$cliente->edad=$edad;
		
		$cliente->CargarUno();

		$response->getBody()->write("true");

		return $response;
	}
}

/*


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