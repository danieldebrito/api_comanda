<?php
class ermpleado
{
    public $id_empleado;
    public $rol_empleado;
    public $id_estado_empleado;
    public $nombre_y_apellido;

    public static function readAll()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `empleados` WHERE 1   
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "empleado");   /*X*/
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_empleado)
    {
        try {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `empleados`
			WHERE `id_empleado` = '$id_empleado'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('empleado');
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }
    
    public function create()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			INSERT INTO `empleados`
				(`id_empleado`,
				`rol_empleado`,
				`id_estado_empleado`,
                `nombre_y_apellido`)
			VALUES (
				:id_empleado,
				:rol_empleado,
				:id_estado_empleado,
                :nombre_y_apellido)
		");

            $consulta->bindValue(':id_empleado', $this->id_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':rol_empleado', $this->rol_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':id_estado_empleado', $this->id_estado_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':nombre_y_apellido', $this->nombre_y_apellido, PDO::PARAM_STR);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_empleado){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `empleados` 
                WHERE `id_empleado` = '$id_empleado'
            ");
            $consulta->bindValue(':id_empleado', $id_empleado, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
    }

    public function update()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
                UPDATE `empleados` 
                SET 
				`rol_empleado`=:rol_empleado, 
				`id_estado_empleado`=:id_estado_empleado, 
                `id_estanombre_y_apellidodo_empleado`=:nombre_y_apellido");
                
                $consulta->bindValue(':id_empleado', $this->id_empleado, PDO::PARAM_STR);
                $consulta->bindValue(':rol_empleado', $this->rol_empleado, PDO::PARAM_STR);
                $consulta->bindValue(':id_estado_empleado', $this->id_estado_empleado, PDO::PARAM_STR);
                $consulta->bindValue(':nombre_y_apellido', $this->nombre_y_apellido, PDO::PARAM_STR);
        
        return $consulta->execute();
    }

}