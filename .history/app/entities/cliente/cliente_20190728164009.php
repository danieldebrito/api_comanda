<?php
class cliente{
	public $id_cliente;
    public $nombre_y_apellido;
    public $dni;
    public $sexo;
    public $edad;

	public static function readAll(){
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `clientes` WHERE 1
			");
			$consulta->execute();
			$ret = $consulta->fetchAll(PDO::FETCH_CLASS, "cliente");
		} catch (Exception $e) {
			$mensaje = $e->getMessage();
			$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
		} finally {
			return $ret;
		}	
	}

	public static function read($id) {
		try {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
			$consulta =$objetoAccesoDato->RetornarConsulta("
			SELECT * 
			FROM `clientes` 
			WHERE `id_cliente` = '$id'
			");
			$consulta->execute();
			$cliente = $consulta->fetchObject('cliente');
		} catch (Exception $e) {
			$mensaje = $e->getMessage();
			$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
		} finally {
			return $cliente;
		}
	}

	public function create(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
		INSERT INTO `clientes` 
				(`id_cliente`, 
				`nombre_y_apellido`, 
				`dni`, 
				`sexo`, 
				`edad`)
			VALUES (
				:id_cliente, 
				:nombre_y_apellido, 
				:dni, 
				:sexo, 
				:edad)
		");

		$consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
		$consulta->bindValue(':nombre_y_apellido', $this->nombre_y_apellido, PDO::PARAM_STR);
		$consulta->bindValue(':dni', $this->dni, PDO::PARAM_INT);
		$consulta->bindValue(':sexo', $this->sexo, PDO::PARAM_STR);
		$consulta->bindValue(':edad', $this->edad, PDO::PARAM_INT);

		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

}


/*
 


	public static function Baja($id)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("
			DELETE FROM `maquinas` WHERE `idMaquina` = $id
			");

            $consulta->bindValue(':idMaquina', $id, PDO::PARAM_STR);

            $consulta->execute();

            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
	}
	
 	public function ModificarUno(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		   
		$consulta =$objetoAccesoDato->RetornarConsulta("
		UPDATE `maquinas` SET 
		   `idMaquina`=:idMaquina',
		   `detalle`=:detalle,
		   `marca`=:marca,
		   `sector`=:sector,
		   `estado`=:estado,
		   `urlImagen`=:urlImagen,
		   `fabricanteNombre`=:fabricanteNombre,
		   `fabricanteDireccion`=:fabricanteDireccion,
		   `fabricanteTelefono`=:fabricanteTelefono,
		   `fabricanteContacto`=:fabricanteContacto 
		   WHERE 
		   `idMaquina`=:idMaquina
		");  

		  $consulta->bindValue(':idMaquina', $this->idMaquina, PDO::PARAM_INT);
		  $consulta->bindValue(':detalle', $this->detalle, PDO::PARAM_STR);
		  $consulta->bindValue(':marca', $this->marca, PDO::PARAM_STR);
		  $consulta->bindValue(':sector', $this->sector, PDO::PARAM_STR);
		  $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
		  $consulta->bindValue(':urlImagen', $this->urlImagen, PDO::PARAM_STR);
		  $consulta->bindValue(':fabricanteNombre', $this->fabricanteNombre, PDO::PARAM_STR);
		  $consulta->bindValue(':fabricanteDireccion', $this->fabricanteDireccion, PDO::PARAM_STR);
		  $consulta->bindValue(':fabricanteTelefono', $this->fabricanteTelefono, PDO::PARAM_STR);
		  $consulta->bindValue(':fabricanteContacto', $this->fabricanteContacto, PDO::PARAM_STR);

		  return $consulta->execute();
	}

 */