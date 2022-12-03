document.querySelector('form').onsubmit = async (e) => {
    e.preventDefault();
    let form = document.querySelector('form');
    let value = new FormData(form);
    let res;
    document.querySelector('.loading_').style.display = '';
    document.querySelector('.loading_').style.display = '';
    document.querySelector('.aguar').style.display = '';
    document.querySelector(".event").style.display = '';
    document.querySelector('.foi').style.display = 'none';
    try {
        let req = await fetch("../assets/script/php/requsicoes/recuperar_senha.php", {
            method: "POST",
            body: value
        })
        res = await req.json();
    } catch {
        document.querySelector('.aguar').style.display = 'none';
        document.querySelector(".event").style.display = 'none';
        document.querySelector('.foi').innerHTML = "Email enviado com sucesso";
        document.querySelector('.foi').style.display = '';
        document.querySelector(".body_loading").style.width = 'auto';
        document.querySelector(".body_loading").style.padding = '10px';
        setTimeout(() => {
            document.querySelector('.loading_').style.display = 'none';
            document.querySelector('.aguar').style.display = '';
            document.querySelector(".event").style.display = '';
            document.querySelector('.foi').innerHTML = "";
            document.querySelector('.foi').style.display = 'none';
            document.querySelector(".body_loading").style.width = '';
            document.querySelector(".body_loading").style.padding = '';
        }, 2000)
        return;
    }
    document.querySelector('.loading_').style.display = '';
    document.querySelector('.aguar').style.display = 'none';
    document.querySelector(".event").style.display = 'none';
    console.log(res);
    document.querySelector('.foi').innerHTML = res.mensage;
    document.querySelector('.foi').style.display = '';
    document.querySelector(".body_loading").style.width = 'auto';
    document.querySelector(".body_loading").style.padding = '10px';
    setTimeout(() => {
        document.querySelector('.loading_').style.display = 'none';
        document.querySelector('.aguar').style.display = '';
        document.querySelector(".event").style.display = '';
        document.querySelector('.foi').innerHTML = "";
        document.querySelector('.foi').style.display = 'none';
        document.querySelector(".body_loading").style.width = '';
        document.querySelector(".body_loading").style.padding = '';
    }, 2000)
    console.log(res);
}