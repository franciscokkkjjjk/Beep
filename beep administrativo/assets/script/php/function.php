<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function email_send($d, $mens, $assunt, $from) {

require $d.'PHPMailer-master/src/Exception.php';
require $d.'PHPMailer-master/src/PHPMailer.php';
require $d.'PHPMailer-master/src/SMTP.php';
    $mail = new PHPMailer(true);
    try {
        // configurações para o envio do email
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setLanguage('br');
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'luis.2020316527@aluno.iffar.edu.br';
        $mail->Password = 'tfpdfidrjocetasu';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // caso de erro de certificado ssl

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients = Quem vai enviar o email

        $mail->setFrom('beep.contac@gmail.com', 'Por favor, não responda este email.');
        $mail->addAddress($from);                            //Add a recipient
        $mail->addReplyTo('beep.contac@gmail.com', 'Por favor, não responda este email.');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $assunt;
        $mail->Body = $mens;

        if ($mail->send()) {
            return [true, 'mensagem enviada com sucesso!'];
        } else {
            return [false, 'erro ao enviar a mensagem'];
        }
    } catch (Exception $e) {
        
            return [false, "Erro: {$mail->ErrorInfo}"];
    }
}
