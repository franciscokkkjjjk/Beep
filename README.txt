----------- problemas conhecidos-------------------------------

-não reconhece anos bissextos.
-o descompartilhamento do type 2 exclui a postagem de origem ao em vez da postagem- 
criada para o compartilhamento
-caso usuario de uma quebra de linha o textArea buga o banco de dados.
-o comentario gera mais de uma imagem (possivel problema= no clone)


-------------------ideias---------------------------------------

-

------------------------- implementações -----------------------

-deixar o user editar a data de nascimento apenas uma vez
-repostagem com comentario
-uma area para aparecer novos post quando o scrollTop estiver em 0 
-na area post completo colocar uma area para o type 2{
    adicionar uma area para mostrar para quem foi a resposta para o type 4
}
-aparecer post na timeline com menos de uma semana;

----------------------------erros--------------------------------
--a img não renicia com o modal - (rever a maneira de fechar o modal);
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
