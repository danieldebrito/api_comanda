<?php
class cliente
{
    public $id_cliente;
    public $password;
    public $nombre_y_apellido;
    public $dni;
    public $sexo;
    public $edad;

    public static function readAll()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
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

    public static function read($id_cliente)
    {
        try {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `clientes`
			WHERE `id_cliente` = '$id_cliente'
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

    public function create()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			INSERT INTO `clientes`
                (`id_cliente`,
                `password`,
				`nombre_y_apellido`,
				`dni`,
				`sexo`,
				`edad`)
			VALUES (
                :id_cliente,
                :password,
				:nombre_y_apellido,
				:dni,
				:sexo,
				:edad)
		");

            $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
            $consulta->bindValue(':password', $this->password, PDO::PARAM_INT);
            $consulta->bindValue(':nombre_y_apellido', $this->nombre_y_apellido, PDO::PARAM_STR);
            $consulta->bindValue(':dni', $this->dni, PDO::PARAM_INT);
            $consulta->bindValue(':sexo', $this->sexo, PDO::PARAM_STR);
            $consulta->bindValue(':edad', $this->edad, PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_cliente){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `clientes` 
                WHERE `id_cliente` = '$id_cliente'
            ");
            $consulta->bindValue(':id_cliente', $id_cliente, PDO::PARAM_STR);
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
                UPDATE `clientes`
                SET `password`=:password,
                    `nombre_y_apellido`=:nombre_y_apellido,
                    `dni`=:dni,
                    `sexo`=:sexo,
                    `edad`=:edad 
                WHERE id_cliente=:id_cliente");
                
        $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
        $consulta->bindValue(':password', $this->edad, PDO::PARAM_INT);
        $consulta->bindValue(':nombre_y_apellido', $this->nombre_y_apellido, PDO::PARAM_STR);
        $consulta->bindValue(':dni', $this->dni, PDO::PARAM_INT);
        $consulta->bindValue(':sexo', $this->sexo, PDO::PARAM_STR);
        $consulta->bindValue(':edad', $this->edad, PDO::PARAM_INT);
        
        return $consulta->execute();
    }

}
