console.log(sessionStorage.x5edS);
if (window.sessionStorage.x5edS == "null") {
    window.sessionStorage.removeItem('x5edS');
}
if (window.sessionStorage.x5edU == "null") {
    window.sessionStorage.removeItem('x5edU');
}
if (window.sessionStorage.x5edP == "null") {
    window.sessionStorage.removeItem('x5edP');
}
const auxF = (var_, lugar) => {
    return var_.querySelector(lugar);
}
if (window.sessionStorage.x5edU != undefined) {
    async function creat_list_post_D_U() {
        let req_aux = new FormData();
        req_aux.append('x5edU', window.sessionStorage.x5edU);
        let req = await fetch('../assets/script/php/requisicoes/denuncia_user_all.php', {
            method: 'POST',
            body: req_aux
        });
        let res = await req.json();
        console.log(req);
        if (res.error) {
            window.location.href = 'dununcias.php';
        } else {
            console.log(res);
            document.querySelector('.loading').remove();
            let info_post_d = document.querySelector('.info_cont');
            console.log(info_post_d);
            let midia;
            //verficar se o post ta em quarentena ou não. Caso estive, colocar uma mensagem que ele ta em quarentena e adicionar uma classe no botão, caso contrario, deixar como esta.
            if (res.usuario_denunciado.status_ == 1) {
                document.querySelector(".quarentena").innerHTML = '(Conta suspensa)';
                document.querySelector('.buttons_sus').classList.add('buttons_sus_r');
                document.querySelector(".buttons_sus").addEventListener("click", (e) => {
                    e.preventDefault();
                    // window.location.href = "../assets/script/php/denuncias_posts/quarentena.php?id_p_r=" + res.usuario_denunciado.id_publicacao;
                }, true)
                // console.log(document.querySelector('.quarentena'))
            } else {
                document.querySelector(".buttons_sus").addEventListener("click", (e) => {
                    e.preventDefault();
                    // modal_simples('Você realmente quer fazer isso?', "../assets/script/php/denuncias_posts/quarentena.php?id_p=" + res.usuario_denunciado.id_publicacao);
                    // window.location.href = ";
                }, true)
            }
            document.querySelector(".buttons_visualizar_p").onclick = (e) => {
                e.preventDefault();
            }
            document.querySelector(".buttons_visualizar_p").onclick = (e) => {
                e.preventDefault();
                // modal_simples('Essa publicação realmente está tudo ok? Essa ação resultará na exclusão de todas denúncias referentes a essa publicação.', "../assets/script/php/denuncias_posts/tudoOk.php?id_p=" + res.usuario_denunciado.id_publicacao);

            }
            console.log(res.usuario_denunciado.midia_user)
            if ((res.usuario_denunciado.midia_user != "") && (res.usuario_denunciado.midia_user != null)) {
                let midia = document.createElement('img');
                midia.setAttribute('class', 'img_p');
                midia.setAttribute('src', `../../assets/imgs/profile/${res.usuario_denunciado.midia_user}`);
                document.querySelector(".img_area").classList.add('img_p');
                document.querySelector(".img_area").append(midia);
            } else {
                let div_ = document.createElement('div');
                div_.textContent = "Mídia não informada";
                div_.classList.add("img_p");
                div_.style.alignItems = "center";
                document.querySelector(".img_area").append(div_);
            }
            if ((res.usuario_denunciado.midia_banner != "") && (res.usuario_denunciado.midia_banner != null)) {
                let midia = document.createElement('img');
                midia.setAttribute('src', `../../assets/imgs/profile/${res.usuario_denunciado.midia_banner}`);
                document.querySelector(".banner_").append(midia);
            } else {
                let div_ = document.createElement('div');
                div_.textContent = "Mídia não informada";
                div_.classList.add("img_p");
                div_.style.alignItems = "center";
                document.querySelector(".img_area").append(div_);
            }
            info_post_d.querySelector('.conteudo_1 .text_C').innerHTML = res.usuario_denunciado.nome;
            info_post_d.querySelector(".conteudo3 .text_C").innerHTML = res.usuario_denunciado.email;
            info_post_d.querySelector(".conteudo2 .text_C").innerHTML = res.usuario_denunciado.date_nasc;
            info_post_d.querySelector(".conteudo4 .text_C").innerHTML = res.usuario_denunciado.bio;

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
    creat_list_post_D_U();
} else {
    window.location.href = 'dununcias.php';
}