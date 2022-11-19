async function so_denuncia() {
    let req_d = await fetch('../assets/script/php/requisicoes/denuncias_user.php');
    let res_d = await req_d.json();
    let a = 1;
    console.log(res_d);
    for (var i in res_d) {
        let aux = false;
        if (a % 2 == 0) {
            aux = true;
        }
        creat_list(res_d[i], null, aux);
    }
    document.querySelector('.list_area').style.display = 'none';
}
so_denuncia();
