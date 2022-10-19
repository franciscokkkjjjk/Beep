console.log(sessionStorage.x5edS); 
if(window.sessionStorage.x5edS != undefined || window.sessionStorage.x5edP != undefined) {
    let input = document.createElement('input');
    let url_s;
    let value = new FormData();
    if(window.sessionStorage.x5edS != undefined) {
        value.append('x_25_SP', window.sessionStorage.x5edS);
        url_s = '../assets/script/php/requisicoes/game_completo.php';
    } else if(window.sessionStorage.x5edP != undefined) {

    }    
    async function pedrinha() {
        let req = await fetch(url_s, {
            method:'POST',
            body:value
        });
        let res = await req.json();
        console.log(res);
        alert_mensage(res);
    }
    pedrinha();
    console.log(value.getAll('teste'));
} else {
    window.location.href = 'inicial.php';
}