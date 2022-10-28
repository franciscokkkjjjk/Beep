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
            info_post_d.querySelector('.conteudo_1 .text_C').innerHTML;
        }
    }
    creat_list_post_D();
} else {
    window.location.href = 'dununcias.php';
}