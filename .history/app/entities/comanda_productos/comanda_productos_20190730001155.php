<?php
class comanda_producto
{
    public $id_comanda_producto;
    public $id_empleado_cocina_bar;
    public $id_comanda;
    public $id_producto;
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
    /*
    comanda_productos
    comanda_producto
    public $id_comanda_producto;
    public $id_empleado_cocina_bar;
    public $id_comanda;
    public $id_producto;
    public $id_estado_producto;
    public $cantidad;
    */
    
    public function create()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			INSERT INTO `comanda_productos`
				(`id_comanda_producto`,
				`id_empleado_cocina_bar`,
				`id_comanda`,
                `id_producto`,
                `id_estado_producto`,
                `cantidad`)
			VALUES (
				:id_comanda_producto,
				:id_empleado_cocina_bar,
                :id_comanda,
                :id_producto,
				:id_estado_producto,
                :cantidad)
		");

            $consulta->bindValue(':id_comanda_producto', $this->id_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':id_empleado_cocina_bar', $this->rol_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':id_comanda', $this->id_estado_empleado, PDO::PARAM_STR);
            $consulta->bindValue(':id_producto', $this->nombre_y_apellido, PDO::PARAM_STR);
            $consulta->bindValue(':id_estado_producto', $this->nombre_y_apellido, PDO::PARAM_STR);
            $consulta->bindValue(':cantidad', $this->nombre_y_apellido, PDO::PARAM_INT);

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
                `nombre_y_apellido`=:nombre_y_apellido 
                WHERE id_empleado=:id_empleado");
                
                $consulta->bindValue(':id_empleado', $this->id_empleado, PDO::PARAM_STR);
                $consulta->bindValue(':rol_empleado', $this->rol_empleado, PDO::PARAM_STR);
                $consulta->bindValue(':id_estado_empleado', $this->id_estado_empleado, PDO::PARAM_STR);
                $consulta->bindValue(':nombre_y_apellido', $this->nombre_y_apellido, PDO::PARAM_STR);
        
        return $consulta->execute();
    }

}