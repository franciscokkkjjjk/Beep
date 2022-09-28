<?php 
     session_start();
     require_once '../conecta.php';
     require_once '../function/funcoes.php';
     if($_POST['c-pXD30']) {
      $publi_des = $_POST['c-pXD30'];

        $sql_post_compartilhado = 'SELECT * FROM publicacoes WHERE id_publi='.$publi_des;
        $res_post_compartilhado = mysqli_query($conexao, $sql_post_compartilhado);
        $assoc_post = mysqli_fetch_assoc($res_post_compartilhado);
         if(is_null($assoc_post)) {
            $descompatilha = [
               'error' => true,
               'mensage' => "A postagem já foi descompartilhada anteriormente."
            ];
            echo json_encode($descompatilha);
            die;
         }
         if($assoc_post['type'] == '4' or $assoc_post['type'] == '2') {
            if($assoc_post['user_publi'] == $_SESSION['id_user']) {
               $sql_delet = 'DELETE FROM publicacoes WHERE id_publi='.$publi_des;
               $res_delet = mysqli_query($conexao, $sql_delet);
               if($res_delet) {
                  $sql_interagida = 'SELECT * FROM publicacoes WHERE id_publi='.$assoc_post['id_publi_interagida'];
                  $res_interagida = mysqli_query($conexao, $sql_interagida);
                  $assoc_interagida = mysqli_fetch_assoc($res_interagida);

                  $calc = intval($assoc_interagida['num_compartilha'])-1;

                  $updt_interagida = "UPDATE publicacoes SET num_compartilha=$calc WHERE id_publi=".$assoc_post['id_publi_interagida'];
                  $res_updt_interagida = mysqli_query($conexao, $updt_interagida);
                  if($res_updt_interagida) {
                     $descompatilha = [
                        'error' => false,
                        'id_descompartilhada' => $publi_des
                     ];
                     echo json_encode($descompatilha);
                  }
               } else {
                  $descompatilha = [
                     'error' => true,
                     'mensage' => 'erro no deletar'
                  ];
                  echo json_encode($descompatilha);
               }
          } else {
            $em_busca_de_nemo = 'SELECT * FROM publicacoes WHERE id_publi_interagida='.$assoc_post['id_publi_interagida'].' AND user_publi='.$_SESSION['id_user'];
            $nossa_achamos_o_nemo = mysqli_query($conexao, $em_busca_de_nemo);
            $olha_o_nemo_ai = mysqli_fetch_assoc($nossa_achamos_o_nemo);
            $nemo = $olha_o_nemo_ai['id_publi'];

            $busca_raiz = 'SELECT * FROM publicacoes WHERE id_publi='.$olha_o_nemo_ai['id_publi_interagida'];
            $achomos_raiz = mysqli_query($conexao, $busca_raiz);
            $assoc_raiz = mysqli_fetch_assoc($achomos_raiz);

            $bo_mata_o_nemo = "DELETE FROM publicacoes WHERE id_publi=".$nemo;
            $conseguimos_interogacao = mysqli_query($conexao, $bo_mata_o_nemo);
            if($conseguimos_interogacao) {
               $calc = intval($assoc_raiz['num_compartilha'])-1;
               $updt_interagida = "UPDATE publicacoes SET num_compartilha=$calc WHERE id_publi=".$assoc_raiz['id_publi'];
               $res_updt_interagida = mysqli_query($conexao, $updt_interagida);
               if($res_updt_interagida) {
                  $descompatilha = [
                     'error' => false,
                     'id_descompartilhada' => $nemo
                  ];
                  echo json_encode($descompatilha);
               } else {
                  $descompatilha = [
                     'error' => true,
                     'mensage' => 'Não foi possivel atualizar o numero de curtidas.'
                  ];
                  echo json_encode($descompatilha);
               }
            }
          }
         }else {
            $sql_post_des = 'SELECT * FROM publicacoes WHERE user_publi='.$_SESSION['id_user'].' AND id_publi_interagida='.$publi_des;
            $res_post_des = mysqli_query($conexao, $sql_post_des);
            $assoc_post_des = mysqli_fetch_assoc($res_post_des);
            if($assoc_post_des != NULL){
               $id_post_comp = $assoc_post_des['id_publi'];
               $sql_delet = 'DELETE FROM publicacoes WHERE id_publi='.$assoc_post_des['id_publi'];
               $res_delet = mysqli_query($conexao, $sql_delet);
               if($res_delet) {
                  $sql_interagida = 'SELECT * FROM publicacoes WHERE id_publi='.$publi_des;
                  $res_interagida = mysqli_query($conexao, $sql_interagida);
                  $assoc_interagida = mysqli_fetch_assoc($res_interagida);
                  $calc = intval($assoc_interagida['num_compartilha'])-1;
                  $updt_interagida = "UPDATE publicacoes SET num_compartilha=$calc WHERE id_publi=".$publi_des;
                  $res_updt_interagida = mysqli_query($conexao, $updt_interagida);
                  if($res_updt_interagida) {
                     $descompatilha = [
                        'error' => false,
                        'id_descompartilhada' => $id_post_comp
                     ];
                     echo json_encode($descompatilha);
               }
             }
            } else {
               $descompatilha = [
                  'error' => true,
                  'mensage' => 'valor da postagem igual a nulo.'
               ];
               echo json_encode($descompatilha);
            }
         }
     } else {
      $descompatilha = [
         'error' => true,
         'mensage' => 'A postagem selecionada não existe'
      ];
      echo json_encode($descompatilha);
   }
?>