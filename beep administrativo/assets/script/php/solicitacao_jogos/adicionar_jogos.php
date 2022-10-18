<?php
//adicionar a tabela jogos
if(isset($_POST['p_adm305'])) {
    require_once '../function.php';
    require_once '../conecta.php';
    session_start();   
    $id_solicita = mysqli_escape_string($conexao, $_POST['p_adm305']);
    $sql_solic = "SELECT * FROM solicita_list WHERE id_solicita=" . $id_solicita;
    $res_solic = mysqli_query($conexao, $sql_solic);
    if($res_solic) {
        $array_solic = mysqli_fetch_assoc($res_solic);
        if(is_null($array_solic)) {
            $json = [
                'error' => true,
                'mensage' =>'A solicitação não existe ou já foi aprovada/rejeitada.'
            ];
        } else {
            $id_user = $array_solic['id_user_solicita'];
            $img_jogo =  $array_solic['img_jogo'];
            $nome_jogo =  $array_solic['nome_jogo'];
            $desc_jogo =  $array_solic['desc_jogo'];
            $loja_jogo =  $array_solic['loja'];
            $lojaLink_jogo =  $array_solic['link_loja'];
            $clasE_jogo =  $array_solic['class_etaria'];
            $sql_add = "INSERT INTO jogos(`nome_jogo`, `img_jogo`, `desc_jogo`, `loja`, `link_loja`, `class_etaria`) VALUES ('$nome_jogo', '$img_jogo','$desc_jogo', '$loja_jogo', '$lojaLink_jogo', $clasE_jogo)";
            $res_add = mysqli_query($conexao, $sql_add);
            $id_add = mysqli_insert_id($conexao);
            if($res_add) {
                $sql_user = "SELECT * FROM users WHERE id_user=" . $id_user;
                $res_user = mysqli_query($conexao, $sql_user);
                if($res_user) {
                    $ass_user = mysqli_fetch_assoc($res_user);
                    if(!is_null($ass_user)) {
                        $mensagem = "
                        <div style='padding:50px;background-color:#f00; font-size:25px;'>
                            Salve " . $ass_user['nome'] .",
                        </div>
                        <div>
                         o jogo que você solicitou foi cadastrado no sistema.<br>
                         <br>
                         jogo solicitado: $nome_jogo
                        </div>
                        ";
                        $sendemail = email_send('../', $mensagem, "Sucesso! O jogo solicitado foi cadastrado.", $ass_user['email']); 
                        if($sendemail[0]) {
                            $sql_delete_soli = "DELETE FROM `solicita_list` WHERE id_solicita =" . $id_solicita;
                            $res_delete_soli = mysqli_query($conexao, $sql_delete_soli);
                            if($res_delete_soli) {
                                $json = [
                                    'error' => false,
                                    'mensage' => "Jogo foi cadastrado e o usuário foi notificado."
                                ];
                            } else {
                                $json = [
                                    'error' => true,
                                    'mensage' => "Não foi possivel deletar a solicitação, mas o jogo foi cadastrado no sistema e o usário notificado."
                                ];
                            }
                                
                        }  else {
                            $tentativa2 = email_send('../', $mensagem, "Sucesso! O jogo solicitado foi cadastrado.", $ass_user['email']);
                            if($tentativa2[0]) {
                                $sql_delete_soli = "DELETE FROM `solicita_list` WHERE id_solicita =" . $id_solicita;
                                $res_delete_soli = mysqli_query($conexao, $sql_delete_soli);
                                if($res_delete_soli) {
                                    $json = [
                                        'error' => false,
                                        'mensage' => "Jogo foi cadastrado e o usuário foi notificado."
                                    ];
                                } else {
                                    $json = [
                                        'error' => true,
                                        'mensage' => "Não foi possivel deletar a solicitação, mas o jogo foi cadastrado no sistema e o usário notificado."
                                    ];
                                }
                            } else {
                                $sql_delete_op = "DELETE FROM `jogos` WHERE id_jogos=" . $id_add;
                                $res_delete = mysqli_query($conexao, $sql_delete_op);
                                if($res_delete) {
                                    $json = [
                                        'error' => true,
                                        'mensage' => "O usuário não pode ser notificado, então a operação foi revertida."
                                    ];
                                } else {
                                    $json = [
                                        'error' => true,
                                        'mensage' => "O usuário não pode ser notificado, e a operação não pode ser revertida. Chame o suporte."
                                    ];
                                }
                            }
                        }
                    } else {
                        $json = [
                            'error' => true,
                            'mensage' => "Jogo cadastrado, mas o usuário não existe mais."
                        ];
                    }
                } else {
                    $json = [
                        'error' => true,
                        'mensage' => "Jogo cadastrado, mas não possivel acessar o usuario que solicitou."
                    ];
                }
            } else {
                $json = [
                    'error' => true,
                    'mensage' => "Não foi possivel cadastrar o jogo no banco de dados. Tente novamente."
                ];
            }
            
        }
    } else {
        $json = [
            'error' => true,
            'mensage' =>'Erro de sql.'
        ];
    }
    echo json_encode($json);
}

