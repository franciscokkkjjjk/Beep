qs('.input_pesquisar').addEventListener('keypress', async (e) => {
    let pesquisa = e.target.value;
    try {
        let form_ = new FormData();
        form_.append('x_AUTO30', pesquisa);
        let req_ = await fetch('../assets/script/php/requsicoes/pesquisar_.php', {
            method:'POST',
            body: form_
        });
        let res = await req_.text();
        console.log(res)
    } catch {
        console.log('deu pau');
        document.querySelector('body').innerHTML = "<div>sdds</div>";
        return
    }
}, true);