if(qs('.publi') != undefined) {
    let pub = qs('.publi');
    pub.onclick = async (e)=>{
        console.log('click');
        let req = await fetch('../assets/script/php/requisicoes/game_solic.php');
        let res = await req.json();
        let a = 1;
        console.log(res);
        for (var i in res) {
            let aux = false;
            if (e % 2 == 0) {
                aux = true;
            }
            creat_list(res[i], null, aux);
            e++;
        }
        document.querySelector('.list_area').style.display = 'none';
    }
}