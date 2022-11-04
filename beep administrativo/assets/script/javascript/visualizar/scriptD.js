console.log(sessionStorage.x5edS);
if (window.sessionStorage.x5edS == "null") {
    window.sessionStorage.removeItem('x5edS');
}
if (window.sessionStorage.x5edP == "null") {
    window.sessionStorage.removeItem('x5edP');
}
const auxF = (var_, lugar) => {
    return var_.querySelector(lugar);
}
if (window.sessionStorage.x5edP != undefined) {
    async function creat_list_post_D() {
        let req_aux = new FormData();
        req_aux.append('x5edP', window.sessionStorage.x5edP);
        let req = await fetch('../assets/script/php/requisicoes/denuncias_all.php', {
            method: 'POST',
            body: req_aux
        });
        let res = await req.json();
        if (res.error) {
            window.location.href = 'dununcias.php';
        } else {
            console.log(res);
            document.querySelector('.loading').remove();
            let info_post_d = document.querySelector('.info_cont');
            console.log(info_post_d);
            let midia;
            if(res.posts_info.postagem_denunciada.midia_publi != "") {
                if(res.posts_info.postagem_denunciada.midia_publi.split(".")[1] == "mp4"){
                    midia = document.createElement("video");
                    midia.setAttribute("controls", "on");
                    midia.setAttribute("src", `../../assets/imgs/posts/${res.posts_info.postagem_denunciada.midia_publi}`);
                    document.querySelector(".img_area").append(midia);
                }
            }
            info_post_d.querySelector('.conteudo_1 .text_C').innerHTML = res.posts_info.postagem_denunciada.text_publi;
            info_post_d.querySelector('.conteudo2  .text_C').innerHTML = res.posts_info.postagem_denunciada.date_p;
            info_post_d.querySelector(".conteudo3 .text_C").innerHTML = res.posts_info.postagem_denunciada.id_publicacao;
            info_post_d.querySelector(".conteudo4 .text_C").innerHTML = res.posts_info.postagem_denunciada.user_publi;
            if(res.posts_info.postagem_interagida == undefined) {
                qs(".areaInter").remove();
            } else {
                //continua com a minha aberração
            }
            let area_user_D = document.querySelector(".user_info");
            let img_ = document.createElement("div");
            img_.setAttribute("style", `background-image(url(../../assets/imgs/profile/${res.posts_info.userPubliDenunciada.foto_perfil}))`);
            area_user_D.querySelector(".img_area").append(img_);
        }
    }
    creat_list_post_D();
} else {
    window.location.href = 'dununcias.php';
}