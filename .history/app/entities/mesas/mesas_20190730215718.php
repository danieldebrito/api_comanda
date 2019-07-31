<?php
class mesa
{
    public $id_mesa;
    public $id_estado_mesa;
    public $url_foto;
    public $cant_comensales;

    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `mesas` WHERE 1   
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "mesa");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_mesa){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `mesas`
			WHERE `id_mesa` = '$id_mesa'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('mesa');
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
				(`id_mesa`,
				`id_estado_mesa`,
				`url_foto`,
                `cant_comensales`)
			VALUES (
				:id_mesa,
				:id_estado_mesa,
				:url_foto,
                :cant_comensales)
		");

            $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':id_estado_mesa', $this->id_estado_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':url_foto', $this->url_foto, PDO::PARAM_STR);
            $consulta->bindValue(':cant_comensales', $this->cant_comensales, PDO::PARAM_INT);

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

            /*
    mesa
    mesas
    public $id_mesa;
    public $id_estado_mesa;
    public $url_foto;
    public $cant_comensales;
    */

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
                $consulta->bindValue(':salida_hora', $this->salida_hora, PDO::PARAM_INT);
        
        return $consulta->execute();
    }
}
