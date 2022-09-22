function post_not(timeline) {
    let nada = document.createElement('div');
    nada.classList.add('nada');
    if (timeline == 0) {
        nada.innerHTML = 'Por enquanto não há nada por aqui. :(';
    } if (timeline == 'coment') {
        nada.innerHTML = 'Seja o primeiro a interagir com esse usuário!';
    } if (timeline == 1) {
        nada.innerHTML = 'Esse usuário não fez nenhuma publicação. :(';
    } if (timeline == 2) {
        nada.innerHTML = 'Esse usuário não curtiu nenhuma publicação. :(';
    } if (timeline == 3) {
        nada.innerHTML = "OPS! Parece que nenhum jogo foi cadastrado ainda. Solicite o cadastro de um jogo em <a href='solicitacaoJogos.php'>aqui</a>.";
        document.querySelector('.feed-body-post').style.gridTemplateColumns = 'none';
    } if(timeline == 4){
        nada.innerHTML = "Esse usuário não possue nenhum jogo. :(";
    }
    document.querySelector('.feed-body-post').appendChild(nada);
}
function showImg_form(e, a, c) {
    let inpu = e;
    let exit = document.createElement('div');
    exit.setAttribute('class', 'exit--previu');
    let exit_img = document.createElement('div');
    exit_img.setAttribute('class', 'menu--exit-img');
    exit.appendChild(exit_img);
    return e.onchange = function () {
        let midia;
        let img = e.files[0];
        console.log(img);
        let seguir;
        console.log(img.type);
        if (img.type == 'image/jpeg' || img.type == 'image/gif' || img.type == 'image/png' || img.type == 'image/jfif') {
            console.log('é uma img');
            seguir = true
            midia = document.createElement('img');
        } else if (img.type == 'video/mp4') {
            console.log('isso é um video');
            midia = document.createElement('video');
            midia.setAttribute('controls', '');
            seguir = true;
        } else {
            seguir = false;
        }
        if (seguir) {
            let src = URL.createObjectURL(img);
            midia.setAttribute('src', src);
            a.appendChild(exit);
            a.appendChild(midia);
            console.log(e.value);
            qs('.button--post--form').disabled = false;
            qs('.button--post--form').style.backgroundColor = '#53ffff';
            qs('.button--post--form').style.cursor = 'pointer';
            exit.addEventListener('click', (e = e) => {
                inpu.value = '';
                midia.remove();
                exit.remove();
                if (c) {
                    let value = qs('.inputdiv--form--post');
                    if (value != undefined) {
                        if (value.innerText.trim() == '' && inpu.value == '') {
                            qs('.inputdiv--form--post').innerText = '';
                            qs('.button--post--form').disabled = true;
                            qs('.button--post--form').style.backgroundColor = '';
                            qs('.button--post--form').style.cursor = '';
                            qs('.button--post--form').style.cursor = '';
                        }
                    } else {
                        if (qs('.input_img_event').value == '') {
                            qs('.button--post--form').disabled = true;
                            qs('.button--post--form').style.backgroundColor = '';
                            qs('.button--post--form').style.cursor = '';
                            qs('.button--post--form').style.cursor = '';
                        }
                    }

                }
            }, true)
        } else {
            let alerta = {
                mensage: 'A Beep aceita apenas formato gif, mp4, png, jpeg, jpg e jfif.',
                error: true
            }
            if (document.getElementById('img--post-coment') != undefined) {
                document.getElementById('img--post-coment').value = '';
            }
            document.getElementById('img--post').value = '';
            alert_mensage(alerta);
        }
    }

}
let timer; 
function alert_mensage(json) {
    let creat_mensage = document.createElement('div');
    creat_mensage.classList.add('mensagem_alert');
    if (json.mensage != undefined) {
        creat_mensage.innerHTML = json.mensage;
        if (qs('.mensagem_alert') == undefined) {
            if (json.error) {
                creat_mensage.style.backgroundColor = '#f00';
                creat_mensage.style.color = '#fff';
            }
            qs('.feed-area').appendChild(creat_mensage);
        } else {
            qs('.mensagem_alert').innerHTML = json.mensage;
            if (json.error) {
                qs('.mensagem_alert').style.backgroundColor = '#f00';
                qs('.mensagem_alert').style.color = '#fff';
            }
            clearTimeout(timer);
            
        }
        timer = setTimeout(() => {
            if (qs('.mensagem_alert') != undefined) {
                qs('.mensagem_alert').remove();
            }
        }, 4000);
    }
} 
function img_viw_modal(button_add, input_file) {
    let file_input = input_file;
    file_input.onchange = (e)=>{
        let seguir = false;
        let img = e.files[0];
        if (img.type == 'image/jpeg' || img.type == 'image/gif' || img.type == 'image/png' || img.type == 'image/jfif') {
            seguir = true
        }
        if(seguir) {
         let area_img = docuemnt.querySelector('.img_cap_solicita');
         if(area_img != undefined) {
            area_img.style.backgroundImage = `url(${e.files[0]})`;
         }   
        }
    } 
}
