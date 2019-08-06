<?php
class encuesta
{
    public $id_encuesta;
    public $calificacion_mozo;
    public $calificacion_cocinero;
    public $calificacion_mesa;
    public $calificacion_restaurante;
    public $comentario;

    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `encuestas` WHERE 1   
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "encuesta");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_encuesta){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `encuestas`
			WHERE `id_encuesta` = '$id_encuesta'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('encuesta');
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
			INSERT INTO `encuestas`
				(`id_encuesta`,
				`calificacion_mozo`,
				`calificacion_cocinero`,
                `calificacion_mesa`,
                `calificacion_restaurante`,
                `comentario`)
			VALUES (
				:id_encuesta,
				:calificacion_mozo,
                :calificacion_cocinero,
                :calificacion_mesa,
				:calificacion_restaurante,
                :comentario)
		");

            $consulta->bindValue(':id_encuesta', $this->id_encuesta, PDO::PARAM_STR);
            $consulta->bindValue(':calificacion_mozo', $this->calificacion_mozo, PDO::PARAM_STR);
            $consulta->bindValue(':calificacion_cocinero', $this->calificacion_cocinero, PDO::PARAM_STR);
            $consulta->bindValue(':calificacion_mesa', $this->calificacion_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':calificacion_restaurante', $this->calificacion_restaurante, PDO::PARAM_STR);
            $consulta->bindValue(':comentario', $this->comentario, PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_encuesta){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `encuestas` 
                WHERE `id_encuesta` = '$id_encuesta'
            ");
            $consulta->bindValue(':id_encuesta', $id_encuesta, PDO::PARAM_STR);
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
                UPDATE `encuestas` 
                SET 
				`calificacion_mozo`=:calificacion_mozo, 
				`calificacion_cocinero`=:calificacion_cocinero, 
                `calificacion_mesa`=:calificacion_mesa,
                `calificacion_restaurante`=:calificacion_restaurante,
                `comentario`=:comentario 
                WHERE id_encuesta=:id_encuesta");
                
                $consulta->bindValue(':id_encuesta', $this->id_encuesta, PDO::PARAM_STR);
                $consulta->bindValue(':calificacion_mozo', $this->calificacion_mozo, PDO::PARAM_STR);
                $consulta->bindValue(':calificacion_cocinero', $this->calificacion_cocinero, PDO::PARAM_STR);
                $consulta->bindValue(':calificacion_mesa', $this->calificacion_mesa, PDO::PARAM_STR);
                $consulta->bindValue(':calificacion_restaurante', $this->calificacion_restaurante, PDO::PARAM_STR);
                $consulta->bindValue(':comentario', $this->comentario, PDO::PARAM_INT);
        
        return $consulta->execute();
    }

    public static function mejoresComentarios(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("  SELECT com.id_comanda, enc.calificacion_restaurante
            FROM comandas com
            INNER JOIN encuestas enc ON enc.id_encuesta = com.id_encuesta
            ORDER BY enc.calificacion_restaurante DESC
            LIMIT 10
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function peoresComentarios(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("  SELECT com.id_comanda, enc.calificacion_restaurante
            FROM comandas com
            INNER JOIN encuestas enc ON enc.id_encuesta = com.id_encuesta
            ORDER BY enc.calificacion_restaurante ASC
            LIMIT 10
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }
}
