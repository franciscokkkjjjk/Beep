<?php 
     session_start();
     require_once '../conecta.php';
     require_once '../function/funcoes.php';
     if($_POST['c-pXD30']) {
      $publi_des = $_POST['c-pXD30'];
        $sql_post_compartilhado = 'SELECT * FROM publicacoes WHERE id_publi='.$publi_des;
        $res_post_compartilhado = mysqli_query($conexao, $sql_post_compartilhado);
        $assoc_post = mysqli_fetch_assoc($res_post_compartilhado);
         if($assoc_post['type'] == '4' or $assoc_post['type'] == '2') {
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
                     'moio' => false,
                     'id_descompartilhada' => $publi_des
                  ];
                  echo json_encode($descompatilha);
               }
            } else {
               $descompatilha = [
                  'moio' => true,
                  'error' => 'erro no deletar'
               ];
               echo json_encode($descompatilha);
            }
         }else {//acrescentar quando o user descompartilhar pela publi raiz
            $descompatilha = [
               'moio' => true,
               'error' => 'erro no tipo'
            ];
            echo json_encode($descompatilha);
         }
     } else {
      $descompatilha = [
         'moio' => true,
         'error' => 'seu tareco não existe'
      ];
      echo json_encode($descompatilha);
   }
?>