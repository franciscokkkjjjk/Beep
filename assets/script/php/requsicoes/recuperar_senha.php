<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

require_once "../conecta.php";
$email = $_POST['email'];

$sql = "SELECT * FROM users WHERE email='$email'";
$resultSet = mysqli_query($conexao, $sql);
$usuario = mysqli_fetch_assoc($resultSet);
if (!is_null($usuario)) { // caso o email exista no banco de dados
    $token = bin2hex(random_bytes(50));
    $dataExpiracao = new DateTime();
    $dataExpiracao->add(new DateInterval("P1D"));

    // gravar a data de expiração e o token no banco
    $sql = "INSERT INTO pass_recuperar VALUES ('$email', '$token', \"" . $dataExpiracao->format('Y-m-d H:i:s') . "\", 0)";
    $gravou = mysqli_query($conexao, $sql);

    if ($gravou) {
        // enviar o email de resetar senha pro magrão

        $mail = new PHPMailer(true);
        try {
            // configurações para o envio do email
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->setLanguage('br');
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            // caso de erro de certificado ssl
            /*$mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );*/

            //Recipients
            $mail->setFrom('', 'Recuperar Senha');
            $mail->addAddress($email);                            //Add a recipient
            $mail->addReplyTo('', 'Recuperar Senha');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Redefinir a sua senha no '
                . 'Sistema Beep';
            $mail->Body = "Olá,<br>"
                . "<br>"
                . "Você solicitou a redefinição da sua senha no"
                . " Sistema Beep.<br>"
                . "Para redefinir a sua senha clique neste "
                . "<a href=\""
                . filter_input(INPUT_SERVER, 'SERVER_NAME')
                . "/beep/paginas/nova-senha.php?email=" . $email . "&token="
                . $token . "\">link</a>.<br>"
                . "Este link só funcionará uma única vez, e "
                . "expirará em um dia.<br>"
                . "<br>"
                . "Obrigado!";

            if ($mail->send()) {
                $json = [
                    'mensage' => 'Mensagem enviada com sucesso.',
                    'error' => false
                ];
            } else {
                $json = [
                    'mensage' => 'Erro ao enviar a mensagem.',
                    'error' => false
                ];
            }
        } catch (Exception $e) {
            $json = [
                'mensage' => 'A mensagem não pode ser enviada. Erro'. $mail->ErrorInfo,
                'error' => false
            ];
        }
    } else {
        $json = [
            'mensage' => 'Erro ao gravar no banco de dados.',
            'error' => false
        ];
    }
} else { // caso o email não exista no banco de dados
    $json = [
        'mensage' => "Email informado não existe!",
        'error' => false
    ];
}
echo json_encode($json);
die;
