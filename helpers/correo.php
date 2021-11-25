<?php

use PHPMailer\PHPMailer\PHPMailer;
require "vendor/autoload.php";

class correo{
    private static $mail;

    private function estableceClase(){
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
        $mail->Username   = $usuario;
        // introducir clave
        $mail->Password   = $password;
        $mail->SetFrom($usuario, $titulo);
        // asunto
        $mail->Subject = $asunto;
        // cuerpo
        $mail->MsgHTML($html);
        // adjuntos
        $mail->AddEmbeddedImage($adjuntos, 'archivo');// destinatario

        $address = $direccion;
        $mail->AddAddress($address, "Test");
        // enviar
        $resul = $mail->Send();

        if(!$resul) {
            echo "Error" . $mail->ErrorInfo;
            } else {
            echo "Enviado";
        }

    }
}