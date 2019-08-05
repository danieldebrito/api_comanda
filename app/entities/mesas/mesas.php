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
			INSERT INTO `mesas`
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

    public static function delete($id_mesa){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `mesas` 
                WHERE `id_mesa` = '$id_mesa'
            ");
            $consulta->bindValue(':id_mesa', $id_mesa, PDO::PARAM_STR);
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
                UPDATE `mesas` 
                SET 
				`id_estado_mesa`=:id_estado_mesa, 
				`url_foto`=:url_foto, 
                `cant_comensales`=:cant_comensales
                WHERE id_mesa=:id_mesa");
                
                $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_STR);
                $consulta->bindValue(':id_estado_mesa', $this->id_estado_mesa, PDO::PARAM_STR);
                $consulta->bindValue(':url_foto', $this->url_foto, PDO::PARAM_STR);
                $consulta->bindValue(':cant_comensales', $this->cant_comensales, PDO::PARAM_INT);
        
        return $consulta->execute();
    }

    public static function mesaMasUsada(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("  SELECT com.id_mesa, COUNT(com.id_mesa) AS 'CANTIDAD'
                FROM comandas com
                GROUP BY com.id_mesa
                ORDER BY COUNT(com.id_mesa) DESC
                LIMIT 1
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

    public static function mesaMenosUsada(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("  SELECT com.id_mesa, COUNT(com.id_mesa) AS 'CANTIDAD'
                FROM comandas com
                GROUP BY com.id_mesa
                ORDER BY COUNT(com.id_mesa) ASC
                LIMIT 1
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

    public static function mesaMasFacturo(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("  SELECT com.id_mesa AS 'ID MESA', SUM(prod.precio * cp.cantidad) AS 'TOTAL $'
                FROM comanda_productos cp
                INNER JOIN productos prod ON prod.id_producto = cp.id_producto
                INNER JOIN comandas com ON com.id_comanda = cp.id_comanda
                GROUP BY com.id_mesa
                ORDER BY SUM(prod.precio * cp.cantidad) DESC
                LIMIT 1
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

    public static function mesaMenosFacturo(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("  SELECT com.id_mesa AS 'ID MESA',  SUM(prod.precio * cp.cantidad) AS 'TOTAL $'
                FROM comanda_productos cp
                INNER JOIN productos prod ON prod.id_producto = cp.id_producto
                INNER JOIN comandas com ON com.id_comanda = cp.id_comanda
                GROUP BY com.id_mesa
                ORDER BY SUM(prod.precio * cp.cantidad) ASC
                LIMIT 1
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

    public static function mesaFacMAyor(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("  SELECT com.id_comanda AS 'ID COMANDA', com.id_mesa AS 'ID MESA', SUM(prod.precio * cp.cantidad) AS 'TOTAL $'
                FROM comanda_productos cp
                INNER JOIN productos prod ON prod.id_producto = cp.id_producto
                INNER JOIN comandas com ON com.id_comanda = cp.id_comanda
                GROUP BY com.id_comanda
                ORDER BY SUM(prod.precio * cp.cantidad) DESC
                LIMIT 1
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

    public static function mesaFacMenor(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("  SELECT com.id_comanda AS 'ID COMANDA', com.id_mesa AS 'ID MESA', SUM(prod.precio * cp.cantidad) AS 'TOTAL $'
                FROM comanda_productos cp
                INNER JOIN productos prod ON prod.id_producto = cp.id_producto
                INNER JOIN comandas com ON com.id_comanda = cp.id_comanda
                GROUP BY com.id_comanda
                ORDER BY SUM(prod.precio * cp.cantidad) ASC
                LIMIT 1
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







