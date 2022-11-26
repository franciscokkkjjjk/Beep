console.log(sessionStorage.x5edS);
if (window.sessionStorage.x5edS == "null") {
    window.sessionStorage.removeItem('x5edS');
}
if (window.sessionStorage.x5edU == "null") {
    window.sessionStorage.removeItem('x5edS');
}
if (window.sessionStorage.x5edP == "null") {
    window.sessionStorage.removeItem('x5edP');
}
const auxF = (var_, lugar) => {
    return var_.querySelector(lugar);
}
if (window.sessionStorage.x5edU != undefined && window.sessionStorage.x5edU != null) {
    async function creat_list_post_D() {
        let req_aux = new FormData();
        req_aux.append('x5edP', window.sessionStorage.x5edP);
        let res;
        try {
            let req = await fetch('../assets/script/php/requisicoes/denuncias_all.php', {
                method: 'POST',
                body: req_aux
            });

            res = await req.json();
        } catch {
            window.location.href = 'dununcias.php';
            return;
        }
        if (res.error) {
            window.location.href = 'dununcias.php';
        } else {
            console.log(res);
            document.querySelector('.loading').remove();
            let info_post_d = document.querySelector('.info_cont');
            console.log(info_post_d);
            let midia;
            //verficar se o post ta em quarentena ou não. Caso estive, colocar uma mensagem que ele ta em quarentena e adicionar uma classe no botão, caso contrario, deixar como esta.
            if (res.posts_info.postagem_denunciada.querent == 1) {
                document.querySelector(".quarentena").innerHTML = '(Em quarentena)';
                document.querySelector('.buttons_acpt').classList.add('buttons_qua');
                document.querySelector(".buttons_acpt").addEventListener("click", (e) => {
                    e.preventDefault();
                    window.location.href = "../assets/script/php/denuncias_posts/quarentena.php?id_p_r=" + res.posts_info.postagem_denunciada.id_publicacao;
                }, true)
                // console.log(document.querySelector('.quarentena'))
            } else {
                document.querySelector(".buttons_acpt").addEventListener("click", (e) => {
                    e.preventDefault();
                    window.location.href = "../assets/script/php/denuncias_posts/quarentena.php?id_p=" + res.posts_info.postagem_denunciada.id_publicacao;
                }, true)
            }
            document.querySelector(".buttons_rej").onclick = (e) => {
                e.preventDefault();
                modal_simples('Você realmente que excluir essa publicação? Essa ação é irreversível.', "../assets/script/php/denuncias_posts/excluir_p.php?id_p=" + res.posts_info.postagem_denunciada.id_publicacao);
            }
            document.querySelector(".buttons_edit").onclick = (e) => {
                e.preventDefault();
                modal_simples('Essa publicação realmente está tudo ok? Essa ação resultará na exclusão de todas denúncias referentes a essa publicação.', "../assets/script/php/denuncias_posts/tudoOk.php?id_p=" + res.posts_info.postagem_denunciada.id_publicacao);

            }
            if (res.posts_info.postagem_denunciada.midia_publi != "") {
                if (res.posts_info.postagem_denunciada.midia_publi.split(".")[1] == "mp4") {
                    midia = document.createElement("video");
                    midia.setAttribute("controls", "on");
                    midia.setAttribute("src", `../../assets/imgs/posts/${res.posts_info.postagem_denunciada.midia_publi}`);
                    document.querySelector(".img_area").append(midia);

                } else if (res.posts_info.postagem_denunciada.midia_publi.split(".")[1] != '') {
                    let midia = document.createElement('img');
                    midia.setAttribute('src', `../../assets/imgs/posts/${res.posts_info.postagem_denunciada.midia_publi}`);
                    document.querySelector(".img_area").append(midia);
                }
            } else {
                let div_ = document.createElement('div');
                div_.textContent = "Mídia não informada";
                div_.classList.add("img_p");
                div_.style.alignItems = "center";
                document.querySelector(".img_area").append(div_);
            }
            info_post_d.querySelector('.conteudo_1 .text_C').innerHTML = res.posts_info.postagem_denunciada.text_publi;
            info_post_d.querySelector('.conteudo2  .text_C').innerHTML = res.posts_info.postagem_denunciada.date_p;
            info_post_d.querySelector(".conteudo3 .text_C").innerHTML = res.posts_info.postagem_denunciada.id_publicacao;
            info_post_d.querySelector(".conteudo4 .text_C").innerHTML = res.posts_info.postagem_denunciada.user_publi;
            if (res.posts_info.postagem_interagida == undefined) {
                qs(".areaInter").remove();
            } else {
                //continua com a minha aberração
            }
            let area_user_D = document.querySelector(".user_info");
            let img_ = document.createElement("div");
            img_.setAttribute("style", `background-image:url(../../assets/imgs/profile/${res.posts_info.userPubliDenunciada.foto_perfil})`);
            area_user_D.querySelector(".img_area").append(img_);
            area_user_D.querySelector(".text_C").innerHTML = res.posts_info.userPubliDenunciada.nome;
            area_user_D.querySelector(".conteudo2 .text_C").innerHTML = res.posts_info.userPubliDenunciada.username;
            area_user_D.querySelector(".conteudo3 .text_C").innerHTML = res.posts_info.userPubliDenunciada.bio;
            area_user_D.querySelector(".conteudo4 .text_C").innerHTML = res.posts_info.userPubliDenunciada.data_nas;
            let denuncias_area = document.querySelector(".motivos_info");
            denuncias_area.querySelector(".conteudo_1 .text_C").innerHTML = res.motivos.mais_selecionados;
            denuncias_area.querySelector(".conteudo2 .text_C").innerHTML = res.motivos.qt_denuncias;
            let motivos_area = document.querySelector(".motivos_area");
            if (motivos_area != undefined) {
                motivos_area.remove()
            }
            for (let aux in res.motivos.info_motivo) {
                let motivos_area_clone = motivos_area.cloneNode(true);
                motivos_area_clone.querySelector(".motivo_text00").innerHTML = res.motivos.info_motivo[aux].denunciador;
                motivos_area_clone.querySelector(".motivo_text01").innerHTML = res.motivos.info_motivo[aux].motivo;
                if (res.motivos.info_motivo[aux].motivo_text != "") {
                    motivos_area_clone.querySelector(".motivo_text02").style.display = '';
                    motivos_area_clone.querySelector(".motivo_title02").style.display = '';
                    motivos_area_clone.querySelector(".motivo_text02").innerHTML = res.motivos.info_motivo[aux].motivo_text;
                } else {
                    motivos_area_clone.querySelector(".motivo_text02").style.display = 'none';
                    motivos_area_clone.querySelector(".motivo_title02").style.display = 'none';
                }
                motivos_area_clone.querySelector(".motivo_text01").innerHTML = res.motivos.info_motivo[aux].motivo;
                document.querySelector(".m_area .C_1").append(motivos_area_clone);
            }
        }
    }
    creat_list_post_D();
} else {
    window.location.href = 'dununcias.php';
    // console.log('teste')
}