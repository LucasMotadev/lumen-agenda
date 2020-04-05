<?php

namespace App\Utils;



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Email
{
    private $email;

    public function __construct($arrConfig)
    {

        $this->email = new PHPMailer();
        $this->email->CharSet = "UTF-8";
        $this->email->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
        $this->email->isSMTP();                                            // Send using SMTP
        $this->email->Host       = $arrConfig['server'];                   // Set the SMTP server to send through
        $this->email->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->email->Username   = $arrConfig['user'];                     // SMTP username
        $this->email->Password   = $arrConfig['pw'];                               // SMTP password
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $this->email->Port       = $arrConfig['port'];                                    // TCP port to connect to
    }


    private function addDestinatarios($destinatario)
    {
        
        if (!is_array($destinatario)){

            $this->email->addAddress($destinatario); // Add a recipient
        }else{

            foreach ($destinatario as  $email) {
    
                $this->email->addAddress($email->email); // Add a recipient
    
            }
        }

    }

    private function addAnexo($anexo)
    {
        if (!is_array($anexo)){

            $this->email->addAttachment($anexo);
        }else{

            foreach ($anexo as  $value) {

                $this->email->addAddress($value); // Add a recipient
            }
        }         
    }

    public function send($destinatario, $assunto, $messagem = 'messagem')
    {
        try {
            $this->email->setFrom('lukasmotta.8@hotmail.com', 'Geraldo Lucas Mota de Oliveira');
            $this->addDestinatarios($destinatario);

            // $this->email->addAddress('ellen@example.com');               // Name is optional
            // $this->email->addReplyTo('info@example.com', 'Information');
            // $this->email->addCC('cc@example.com');
            //   $this->email->addBCC('bcc@example.com');
            // Attachments
            // $this->email->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name anexos 

            // Content
            $this->email->isHTML(true);                                  // Set email format to HTML
            $this->email->Subject = $assunto;
            $this->email->Body    = $messagem . '<p>Att;</p>' ;// '<p>Att;</p> <p>  <img src = "cid:assinatura" alt = "assinatura"></p>';
            $this->email->AltBody = 'Texto plano';
          //  ($assinatura) ? $this->email->addEmbeddedImage($assinatura, 'assinatura') : '';
      
            $result = $this->email->send();
            return $result;
        } catch (Exception $e) {
             throw new Exception('Erro ao enviar email'. $e->getMessage() .  $this->email->ErrorInfo);
        }
    }
}
