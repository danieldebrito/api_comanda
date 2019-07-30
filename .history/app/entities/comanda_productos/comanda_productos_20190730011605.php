<?php
class comanda_producto
{
    public $id_comanda_producto;
    public $id_comanda;
    public $id_producto;
    public $id_empleado;
    public $id_estado_producto;
    public $cantidad;

    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `comanda_productos` WHERE 1   
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "comanda_producto");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_comanda_producto){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `comanda_productos`
			WHERE `id_comanda_producto` = '$id_comanda_producto'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('comanda_producto');
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
			INSERT INTO `comanda_productos`
				(`id_comanda_producto`,
				`id_comanda`,
				`id_producto`,
                `id_empleado`,
                `id_estado_producto`,
                `cantidad`)
			VALUES (
				:id_comanda_producto,
				:id_comanda,
                :id_producto,
                :id_empleado,
				:id_estado_producto,
                :cantidad)
		");

            $consulta->bindValue(':id_comanda_producto', $this->id_comanda_producto, PDO::PARAM_STR);
            $consulta->bindValue(':id_comanda', $this->id_comanda, PDO::PARAM_STR);
            $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
            $consulta->bindValue(':id_empleado', $this->id_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':id_estado_producto', $this->id_estado_producto, PDO::PARAM_STR);
            $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_comanda_producto){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `comanda_productos` 
                WHERE `id_comanda_producto` = '$id_comanda_producto'
            ");
            $consulta->bindValue(':id_comanda_producto', $id_comanda_producto, PDO::PARAM_STR);
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
                UPDATE `comanda_productos` 
                SET 
				`id_empleado_cocina_bar`=:id_empleado_cocina_bar, 
				`id_comanda`=:id_comanda, 
                `id_producto`=:id_producto,
                `id_estado_producto`=:id_estado_producto,
                `cantidad`=:cantidad 
                WHERE id_comanda_producto=:id_comanda_producto");
                
                $consulta->bindValue(':id_comanda_producto', $this->id_comanda_producto, PDO::PARAM_STR);
                $consulta->bindValue(':id_empleado_cocina_bar', $this->id_empleado_cocina_bar, PDO::PARAM_STR);
                $consulta->bindValue(':id_comanda', $this->id_comanda, PDO::PARAM_STR);
                $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
                $consulta->bindValue(':id_estado_producto', $this->id_estado_producto, PDO::PARAM_STR);
                $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
        
        return $consulta->execute();
    }

}