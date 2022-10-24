----------- problemas conhecidos-------------------------------

-não reconhece anos bissextos.
-caso usuario de uma quebra de linha o textArea buga o banco de dados.
-o comentario gera mais de uma imagem (possivel problema= no clone)
-Depois de um tempo a verificação de novos curtidas e etc começãm a deixar o sistema instavel
isso se da pela auta quantidade de requisições em um curto periodo de tempo
talvez aumentar e mudar a logica para ele adicionar um novo valor no html resolva  a charada

-------------------ideias---------------------------------------

- uma function para verificar as imagens que foram cadastradas na imagem.
-

------------------------- implementações -----------------------
-deixar o user editar a data de nascimento apenas uma vez
-uma area para aparecer novos post quando o scrollTop estiver em 0 
-na area post completo colocar uma area para o type 2{
    adicionar uma area para mostrar para quem foi a resposta para o type 4
}
-aparecer post na timeline com menos de uma semana;
--------------------------cadastrar-se----------------------
--O cadastro de usuario tava bugado e ja foi arrumado: 
-INSERT INTO users(username,t_seguidores,t_seguindo, email, nome, senha, foto_perfil, banner_pefil, bio, data_nas, status_) VALUE ('$username_DF',0, 0,'$email', '$nome', '$pass',NULL,NULL,NULL,'$datOt', false)

----------------------------erros--------------------------------
--a img não renicia com o modal - (rever a maneira de fechar o modal);
--o modal está imcompleto
--o descompartilhar do type 2 exclui a postagem errada 
    possivel solução
        verificar no descompartilhar isso
---clicar no botão de curtir varias vezes torna o valor negativo;
---------------------------------futuros-------------------------

-filtração dos posts pela classificação de idade dos jogos
-a pag de curtidas deve ser adaptada para o novo padrão
-criar uma function para mostrar img quando o post esta aberto completo na tela 

----------------------------ideias feitas----------------------------
--no json de pefils criar a posição 0 e 1
-0: fica todas as postagens do user 
-1:fica informações de seu perfil
--colocar na json de perfil o total de seguidores e total de seguindo


------------------------------------descrição de elementos dentro do código---------------------
-p_xD30 = na classe significa que o elemento cai chamar a função de curtir
-p_xD29 = na classe significa que o elemento vai chamar a função de descurtir
-type 1 = comentario
-type 2 = repost com comentario 
-type 3 = post normal
-type 4 = repost direto
