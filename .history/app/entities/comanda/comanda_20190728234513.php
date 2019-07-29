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

    public static function read($id_cliente)
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

    public static function delete($id_cliente){
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
                SET `nombre_y_apellido`=:nombre_y_apellido,
                    `dni`=:dni,
                    `sexo`=:sexo,
                    `edad`=:edad 
                WHERE id_cliente=:id_cliente");
                
        $consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
        $consulta->bindValue(':nombre_y_apellido', $this->nombre_y_apellido, PDO::PARAM_STR);
        $consulta->bindValue(':dni', $this->dni, PDO::PARAM_INT);
        $consulta->bindValue(':sexo', $this->sexo, PDO::PARAM_STR);
        $consulta->bindValue(':edad', $this->edad, PDO::PARAM_INT);
        
        return $consulta->execute();
    }

}

/*

public function ModificarUno(){
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

$consulta =$objetoAccesoDato->RetornarConsulta("
UPDATE `maquinas` SET
`idMaquina`=:idMaquina',
`detalle`=:detalle,
`marca`=:marca,
`sector`=:sector,
`estado`=:estado,
`urlImagen`=:urlImagen,
`fabricanteNombre`=:fabricanteNombre,
`fabricanteDireccion`=:fabricanteDireccion,
`fabricanteTelefono`=:fabricanteTelefono,
`fabricanteContacto`=:fabricanteContacto
WHERE
`idMaquina`=:idMaquina
");

$consulta->bindValue(':idMaquina', $this->idMaquina, PDO::PARAM_INT);
$consulta->bindValue(':detalle', $this->detalle, PDO::PARAM_STR);
$consulta->bindValue(':marca', $this->marca, PDO::PARAM_STR);
$consulta->bindValue(':sector', $this->sector, PDO::PARAM_STR);
$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
$consulta->bindValue(':urlImagen', $this->urlImagen, PDO::PARAM_STR);
$consulta->bindValue(':fabricanteNombre', $this->fabricanteNombre, PDO::PARAM_STR);
$consulta->bindValue(':fabricanteDireccion', $this->fabricanteDireccion, PDO::PARAM_STR);
$consulta->bindValue(':fabricanteTelefono', $this->fabricanteTelefono, PDO::PARAM_STR);
$consulta->bindValue(':fabricanteContacto', $this->fabricanteContacto, PDO::PARAM_STR);

return $consulta->execute();
}

 */
