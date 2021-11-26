<?php

use PHPMailer\PHPMailer\PHPMailer;
require "vendor/autoload.php";

class correo{
    private static $mail;

    private static function estableceClase(){
        self::$mail = new PHPMailer();
        self::$mail->IsSMTP();
        self::$mail->SMTPDebug  = 2;
        self::$mail->SMTPAuth   = true;
        self::$mail->SMTPSecure = "tls";
        self::$mail->Host= "smtp.gmail.com";
        self::$mail->Port= 587;

    }

    public static function enviar($usuario, $password, $titulo, $asunto, $html, $direccion, $adjuntos = ""){
        self::estableceClase();

        // introducir usuario de google
        self::$mail->Username   = $usuario;
        // introducir clave
        self::$mail->Password   = $password;
        self::$mail->SetFrom($usuario, $titulo);
        // asunto
        self::$mail->Subject = $asunto;
        // cuerpo
        self::$mail->MsgHTML($html);
        // adjuntos
        self::$mail->AddEmbeddedImage($adjuntos, 'archivo');// destinatario

        self::$mail->AddAddress($direccion, "Test");
        // enviar
        $resul = self::$mail->Send();

        // if($resul) {
        //     echo "Error" . self::$mail->ErrorInfo;
        //     } else {
        //     echo "Enviado";
        // }

    }
}