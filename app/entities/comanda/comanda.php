<?php
class comanda
{
    public $id_comanda;
    public $id_empleado_mozo;
    public $id_cliente;
    public $id_encuesta;
    public $id_mesa;
    public $id_estado_comanda;
    public $entregado_a_tiempo;
    public $fecha_comanda;

    public static function readAll()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `comandas` WHERE 1
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "comanda");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_comanda)
    {
        try {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `comandas`
			WHERE `id_comanda` = '$id_comanda'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('comanda');
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
			INSERT INTO `comandas`
				(`id_comanda`,
				`id_empleado_mozo`,
				`id_cliente`,
                `id_encuesta`,
                `id_mesa`,
				`id_estado_comanda`,
				`entregado_a_tiempo`,
				`fecha_comanda`)
			VALUES (
				:id_comanda,
				:id_empleado_mozo,
				:id_cliente,
                :id_encuesta,
                :id_mesa,
				:id_estado_comanda,
				:entregado_a_tiempo,
				:fecha_comanda)
		");

            $consulta->bindValue(':id_comanda', $this->id_comanda, PDO::PARAM_STR);
            $consulta->bindValue(':id_empleado_mozo', $this->id_empleado_mozo, PDO::PARAM_STR);
            $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
            $consulta->bindValue(':id_encuesta', $this->id_encuesta, PDO::PARAM_INT);
            $consulta->bindValue(':id_mesa', $this->id_empleado_mozo, PDO::PARAM_STR);
            $consulta->bindValue(':id_estado_comanda', $this->id_estado_comanda, PDO::PARAM_STR);
            $consulta->bindValue(':entregado_a_tiempo', $this->entregado_a_tiempo, PDO::PARAM_INT);
            $consulta->bindValue(':fecha_comanda', $this->fecha_comanda, PDO::PARAM_STR);

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