<?php
require_once '../composer/vendor/autoload.php';
use \Firebase\JWT\JWT;

class Token
{
    private static $key = "example_key";

    private static $token = array(
        "aud" => "daniel de brito",
        "iat" => "", //Cuándo fue metido
        "nbf" => "", //Antes de esto no va a funcionar (Desde)
        //"exp" => "", //Hasta cuando va a funcionar
        "id_empleado" => "",
        "tipo" => "",
        "nombre_y_apellido" => "",
    );

    public static function CodificarToken( $id_empleado, $tipo, $nombre_y_apellido)
    {
        $fecha = new Datetime("now", new DateTimeZone('America/Buenos_Aires'));
        Token::$token["iat"] = $fecha->getTimestamp();
        Token::$token["nbf"] = $fecha->getTimestamp();

        Token::$token["id_empleado"] = $id_empleado;
        Token::$token["tipo"] = $tipo;
        Token::$token["nombre_y_apellido"] = $nombre_y_apellido;

        $jwt = JWT::encode(Token::$token, Token::$key);

        return $jwt;
    }

    public static function DecodificarToken($token)
    {
        try
        {
            $payload = JWT::decode($token, Token::$key, array('HS256'));
            $decoded = array("Estado" => "OK", "Mensaje" => "OK", "Payload" => $payload);
        } catch (\Firebase\JWT\BeforeValidException $e) {
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } catch (\Firebase\JWT\ExpiredException $e) {
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje.");
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        return $decoded;
    }
}
