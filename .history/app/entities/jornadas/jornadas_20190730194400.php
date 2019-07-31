<?php
class jornada
{
    public $id_jornada;
    public $id_empleado;
    public $entrada_fecha;
    public $entrada_hora;
    public $salida_hora;

    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `jornadas` WHERE 1   
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "jornada");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_jornada){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `jornadas`
			WHERE `id_jornada` = '$id_jornada'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('jornada');
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
			INSERT INTO `jornadas`
				(`id_jornada`,
				`id_empleado`,
				`entrada_fecha`,
                `entrada_hora`,
                `salida_hora`)
			VALUES (
				:id_jornada,
				:id_empleado,
                :entrada_fecha,
				:entrada_hora,
                :salida_hora)
		");

            $consulta->bindValue(':id_jornada', $this->id_jornada, PDO::PARAM_STR);
            $consulta->bindValue(':id_empleado', $this->id_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':entrada_fecha', $this->entrada_fecha, PDO::PARAM_STR);
            $consulta->bindValue(':entrada_hora', $this->entrada_hora, PDO::PARAM_STR);
            $consulta->bindValue(':salida_hora', $this->salida_hora, PDO::PARAM_STR);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_jornada){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `jornadas` 
                WHERE `id_jornada` = '$id_jornada'
            ");
            $consulta->bindValue(':id_jornada', $id_jornada, PDO::PARAM_STR);
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
                UPDATE `jornadas` 
                SET 
				`id_empleado`=:id_empleado, 
				`entrada_fecha`=:entrada_fecha, 
                `entrada_hora`=:entrada_hora,
                `salida_hora`=:salida_hora 
                WHERE id_jornada=:id_jornada");
                
                $consulta->bindValue(':id_jornada', $this->id_jornada, PDO::PARAM_STR);
                $consulta->bindValue(':id_empleado', $this->id_empleado, PDO::PARAM_STR);
                $consulta->bindValue(':entrada_fecha', $this->entrada_fecha, PDO::PARAM_STR);
                $consulta->bindValue(':entrada_hora', $this->entrada_hora, PDO::PARAM_STR);
                $consulta->bindValue(':salida_hora', $this->salida_hora, PDO::PARAM_STR);
        
        return $consulta->execute();
    }
}
