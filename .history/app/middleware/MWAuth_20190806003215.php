<?php

class MWAuth
{
    ///Valida el token.
    public static function ValidarToken($request, $response, $next)
    {
        $token = $request->getHeader("Authorization");
        $validacionToken = Token::DecodificarToken($token[0]);
        if ($validacionToken["Estado"] == "OK") {
            $request = $request->withAttribute("payload", $validacionToken);
            return $next($request, $response);
        } else {
            $newResponse = $response->withJson($validacionToken, 401);
            return $newResponse;
        }
    }

    public static function ValidarSocio($request, $response, $next)
    {
        $payload = $request->getAttribute("payload")["Payload"];

        if ($payload->rol_empleado == "rol050") {
            return $next($request, $response);
        } else {
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "No tienes permiso para realizar esta accion (Solo categoria socio).");
            $newResponse = $response->withJson($respuesta, 401);
            return $newResponse;
        }
    }

    public static function ValidarMozo($request, $response, $next)
    {
        $payload = $request->getAttribute("payload")["Payload"];
        $tipoEmployee = $payload->rol_empleado;
        if ($tipoEmployee == "rol000" || $tipoEmployee == "rol050") {
            return $next($request, $response);
        } else {
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "No tienes permiso para realizar esta accion (Solo categoria mozo).");
            $newResponse = $response->withJson($respuesta, 401);
            return $newResponse;
        }
    }
}
