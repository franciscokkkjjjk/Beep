<?php
// verificar se o email e token batem com banco
$email = $_POST['email'];
$token = $_POST['token'];
$senha = $_POST['senha'];

require_once "../conecta.php";

$sql = "SELECT * FROM pass_recuperar WHERE "
    . "email='$email' AND token='$token'";
$resultSet = mysqli_query($conexao, $sql);
$reset = mysqli_fetch_assoc($resultSet);
if (!is_null($reset)) {
    // verificar se jah está expirado
    $hoje = new DateTime();
    $dataExpiracao = new DateTime($reset['dataExpiracao']);
    if ($hoje < $dataExpiracao) { // ainda é válida

        if ($reset['ativo'] == 0) {
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $sql2 = "UPDATE users SET senha='" . $senha .
                "' WHERE email='" . $email . "'";
            $resultSet = mysqli_query($conexao, $sql2);


            if ($resultSet) { // se gravou a senha    
                $sql3 = "UPDATE pass_recuperar SET ativo=1" . " WHERE email='" . $email . "' AND " . "token='" . $token . "'";
                $resultSet = mysqli_query($conexao, $sql3);

                if ($resultSet) { // se gravou usado = 1
                    $json = [
                        'mensage' => 'Nova senha redefinida com sucesso!',
                        'error' => false
                    ];
                    echo json_encode($json);
                    die();
                }

            } else { // erro ao gravar o usado no password_reset
                $json = [
                    'mensage' => "Erro ao gravar nova senha no banco de dados! Erro: " . mysqli_errno($conexao) . ": " . mysqli_error($conexao),
                    'error' => true
                ];
            }
        } else {
            $json = [
                'mensage' => "Pedido de recuperação de senha já expirado! Por favor solicite novamente.",
                'error' => true
            ];
        }

        // continua...
    } else { // expirou o pedido de recuperação
        $json = [
            'mensage' => "Pedido de recuperação de senha já expirado! Por favor solicite novamente",
            'error' => true
        ];
    }
} else { // se não existe esse pedido de reset
    $_SESSION['mensagem'] = "Pedido de recuperação de senha inválido!";
}

echo json_encode($json);

    // exibir o formulario de redefinição de senha
// encaminha para o arquivo que redefine a senha

    ?>