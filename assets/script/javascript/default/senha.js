document.querySelector('form').onsubmit = async (e) => {
    e.preventDefault();
    let form = document.querySelector('form');
    let value = new FormData(form);
    let res;
    
    try {
        let req = await fetch("../assets/script/php/requsicoes/recuperar_senha.php", {
            method: "POST",
            body: value
        })
        res = await req.json();
    } catch {

        return;
    }
    console.log(res);
}