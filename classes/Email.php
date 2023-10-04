<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $correo;
    public $nombre;
    public $token;
    public $mensaje;
    public $telefono;
    public $fecha;
    public $hora;
    public $contacto;
    public function __construct($args = [])
    {
        $this->correo = $args['correo'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->mensaje = $args['mensaje'] ?? '';
        $this->telefono = $args['telefono'] ?? null;
        $this->fecha = $args['fecha'] ?? null;
        $this->hora = $args['hora'] ?? null;
        $this->contacto = $args['contacto'] ?? '';
    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = 'tls';
        //Configurar el contenido del email
        $mail->setFrom('cuentas@gustavoramirez.com');
        $mail->addAddress('cuentas@gustavoramirez.com', 'GustavoRamirez.com');
        $mail->Subject = 'Confirma tu cuenta';
        //Habilitar HTML

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en AppSalon, solo debes confirmarla en el siguiente enlace: </p>";
        $contenido .= "<a href='" . $_ENV['PROJECT_URL'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";
        $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        $mail->send();
    }
    public function recuperarPassword() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = 'tls';
        //Configurar el contenido del email
        $mail->setFrom('cuentas@gustavoramirez.com');
        $mail->addAddress('cuentas@gustavoramirez.com', 'GustavoRamirez.com');
        $mail->Subject = 'Recupera tu contraseña';
        //Habilitar HTML

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado recuperar tu contraseña, para hacerlo da click en el siguiente enlace:</p>";
        $contenido .= "<a href='" . $_ENV['PROJECT_URL'] . "/recuperar?token=" . $this->token . "'>Recupera tu contraseña</a>";
        $contenido .= "<p>Si tu no solicitaste una nueva contraseña, cambiala en tu cuenta</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        $mail->send();
    }
    public function mensajeContacto() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = 'tls';
        $mail->setFrom('contacto@gustavoRamirez.com');
        $mail->addAddress('contacto@gustavoRamirez.com');
        $mail->Subject = "$this->nombre desea información";
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = '<html>';
        $contenido .= '<p>Nombre: ' . $this->nombre . '</p>';
        $contenido .= '<p>Mensaje: ' . $this->mensaje . '</p>';
        if($this->contacto === 'telefono') {
            $contenido .= '<p>Eligió ser contactado por telefono</p>';
            $contenido .= '<p>Telefono: ' . $this->telefono . '</p>';
            $contenido .= '<p>El día: ' . $this->fecha . '</p>';
            $contenido .= '<p>Hora: ' . $this->hora . '</p>';
        }else {
            $contenido .= '<p>Eligió ser contactado por email</p>';
            $contenido .= '<p>Correo: ' . $this->email . '</p>';
        }
        $contenido .= '</html>';
        $mail->Body = $contenido;
        $mail->send();
    }
}