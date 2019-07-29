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
    
    /*
    empleados
    empleado
    public $id_empleado;
    public $rol_empleado;
    public $id_estado_empleado;
    public $nombre_y_apellido;*/

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
            $consulta->bindValue(':nombre_y_apellido', $this->nombre_y_apellido, PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_comanda){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `comandas` 
                WHERE `id_comanda` = '$id_comanda'
            ");
            $consulta->bindValue(':id_comanda', $id_comanda, PDO::PARAM_STR);
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
                UPDATE `comandas` 
                SET 
				`id_empleado_mozo`=:id_empleado_mozo, 
				`id_cliente`=:id_cliente, 
                `id_encuesta`=:id_encuesta, 
                `id_mesa`=:id_mesa, 
				`id_estado_comanda`=:id_estado_comanda, 
				`entregado_a_tiempo`=:entregado_a_tiempo, 
				`fecha_comanda`=:fecha_comanda 
                WHERE id_comanda=:id_comanda");
                
                $consulta->bindValue(':id_comanda', $this->id_comanda, PDO::PARAM_STR);
                $consulta->bindValue(':id_empleado_mozo', $this->id_empleado_mozo, PDO::PARAM_STR);
                $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
                $consulta->bindValue(':id_encuesta', $this->id_encuesta, PDO::PARAM_INT);
                $consulta->bindValue(':id_mesa', $this->id_empleado_mozo, PDO::PARAM_STR);
                $consulta->bindValue(':id_estado_comanda', $this->id_estado_comanda, PDO::PARAM_STR);
                $consulta->bindValue(':entregado_a_tiempo', $this->entregado_a_tiempo, PDO::PARAM_INT);
                $consulta->bindValue(':fecha_comanda', $this->fecha_comanda, PDO::PARAM_STR);
        
        return $consulta->execute();
    }

}