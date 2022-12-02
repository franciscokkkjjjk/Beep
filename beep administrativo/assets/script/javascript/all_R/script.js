let modal_ = document.querySelector('.modal_confirm');
modal_ = modal_.cloneNode(true);
if (window.localStorage.length > 4) {
    window.localStorage.clear();
}
async function so_game() {
    let req = await fetch('../assets/script/php/requisicoes/game_solic.php');
    let res = await req.json();
    let e = 1;
    console.log(res);
    for (var i in res) {
        let aux = false;
        if (e % 2 == 0) {
            aux = true;
        }
        creat_list(res[i], 'games', null, aux);
        e++;
    }
    document.querySelector('.list_area').style.display = 'none';
}
// creat_list(lista de coisas, diretorio da imagem, url da requisicao, define dois tipos de cores);

function creat_list(list, img_dir, num_aux = null, aux) {
    let list_clone = document.querySelector('.list_area').cloneNode(true);
    if (aux) {
        list_clone.style.backgroundColor = '#292929';
    } else {
        list_clone.style.backgroundColor = '';
    }
    list_clone.querySelectorAll('.event').forEach((e) => {
        e.remove();
    });
    if (img_dir != null) {
        list_clone.querySelector('.list_img').style.backgroundImage = `url(../../assets/imgs/${img_dir}/${list.img})`
    }
    if (num_aux != null) {
        list_clone.querySelector('.num_list').innerHTML = list.num;
    } else {
        list_clone.querySelector('.num_list').innerHTML = "";
    }
    list_clone.querySelector('.list_title').innerHTML = list.title;
    if (num_aux == null) {
        list_clone.querySelector('.button_c').onclick = (e) => {
            e.preventDefault();
            window.sessionStorage.setItem('x5edS', list.id);
            window.location.href = 'visualizar_G.php';
        }
    } else if (num_aux == true) {
        list_clone.querySelector('.button_c').onclick = (e) => {
            e.preventDefault();
            window.sessionStorage.setItem('x5edU', list.id);
            window.location.href = 'visualizar_D_U.php';
        }
    } else {
        list_clone.querySelector('.button_c').onclick = (e) => {
            e.preventDefault();
            window.sessionStorage.setItem('x5edP', list.id);
            window.location.href = 'visualizar_D.php';
        }
    }
    document.querySelector('.corpo_list').append(list_clone);
}



function show_modal(mensage, url_req, value, event) {
    modal_.querySelector('.modal_mensage').textContent = mensage;
    modal_.querySelector('.confirm_modal').onclick = async (e) => {
        e.preventDefault();
        if (url_req != null) {
            let form = new FormData();
            form.append('p_adm305', value)
            let req = await fetch(url_req, {
                method: "POST",
                body: form,
            });
            let res = await req.json();
            console.log(res);
            alert_mensage(res);
            modal_.style.opacity = '';
            setTimeout(() => {
                modal_.remove();
            }, 250)
            e.onclick = '';
            if ((res.error != undefined) && (res.error == false) && (event != 'href')) {
                event.remove();
            } else if (event == 'href' && ((res.error != undefined) && (res.error == false))) {
                setTimeout(() => {
                    window.location.href = 'inicial.php';
                }, 800)
            }
        }
    }
    modal_.querySelector('.reject_modal').onclick = () => {
        modal_.style.opacity = '';
        setTimeout(() => {
            modal_.remove();
        }, 250)
    }
    modal_.querySelector('.event_modal_confirm').onclick = () => {
        modal_.style.opacity = '';
        setTimeout(() => {
            modal_.remove();
        }, 250)
    }
    modal_.style.display = '';
    setTimeout(() => {
        modal_.style.opacity = '1';
    })
    document.querySelector('.a_xd30').appendChild(modal_);
}

let show_modal_simple = false;
function modal_simples(mensagem, url = null) {
    let modal_simples_ = document.querySelector(".a_xd30");
    modal_simples_.querySelector('.modal_mensage').textContent = mensagem;
    modal_simples_.querySelector('.confirm_modal').onclick = () => {
        window.location.href = url;
    }
    modal_simples_.querySelector('.reject_modal').onclick = () => {
        modal_simples_.querySelector(".modal_confirm").style.opacity = "0";
        setTimeout(() => { modal_simples_.querySelector(".modal_confirm").style.display = 'none'; }, 150);
        show_modal_simple = false;
    }
    if (show_modal_simple) {
        modal_simples_.querySelector(".modal_confirm").style.opacity = "0";
        setTimeout(() => { modal_simples_.querySelector(".modal_confirm").style.display = 'none'; }, 150);
        show_modal_simple = false;
    } else {
        show_modal_simple = true;
        modal_simples_.querySelector(".modal_confirm").style.display = '';
        setTimeout(() => {
            modal_simples_.querySelector(".modal_confirm").style.opacity = "1";
        }, 250);
    }
}

function header_modal(modal, button) {
    button.onclick = (e) => {
        e.preventDefault()
        modal.style.display = '';
        setTimeout(() => {
            modal.style.opacity = '1';
        }, 50);
        console.log('entrou')
        modal.querySelectorAll('.modal_exit').forEach((e) => e.onclick = () => {
            modal.style.opacity = '0';
            modal.style.display = 'none';
        })
    }

}

async function pesquisar(pro, id) {
    let form = new FormData();
    form.append(pro, id);
    let req_ = await fetch('../assets/script/php/requisicoes/pesquisas/pesquisa.php', {
        method: "POST",
        body: form
    });
    let res = await req_.text();
    document.querySelector('.corpo_list').innerHTML = res;
}

let valorAnterio;
let input_1 = document.querySelector('.pesquisa_game');
if (input_1 != undefined) {
    input_1.addEventListener("keyup", (e) => {
        let value_p = e.target.value;
        if (value_p.trim() != '') {
            pesquisar('x_GAMEP30', value_p);
            valorAnterio = value_p;
        } else {
            pesquisar('x_GAMEP30', '');
        }
        setTimeout(() => {
            document.querySelectorAll(".button_int").forEach((b) => {
                let id = b.id.split('_')[3];
                b.onclick = (c) => {
                    let id_aux = id;
                    window.sessionStorage.setItem('x5edS', id_aux);
                    window.location.href = 'visualizar_G.php';
                }
            })
        }, 50)
    })
}

let input_02 = document.querySelector('.pesquisa_user');
if (input_02 != undefined) {
    input_02.addEventListener('keyup', (e) => {
        let id = e.target.value;
        pesquisar('x_USERD30', id);

        setTimeout(() => {
            document.querySelectorAll(".button_int").forEach((b) => {
                let id = b.id.split('_')[3];
                b.onclick = (c) => {
                    let id_aux = id;
                    window.sessionStorage.setItem('x5edU', id_aux);
                    window.location.href = 'visualizar_D_U.php';
                }
            })
        }, 50)
    })
}

let reset = document.querySelector('.resetar');
if (reset != undefined) {
    reset.addEventListener('click', () => {
        window.location.reload();
    })
}

let input03 = document.querySelector(".pesquisa_post");
if (input03 != undefined) {
    input03.addEventListener('keyup', (e) => {
        console.log('adjxssd')
        let id = e.target.value;
        console.log(id);
        pesquisar('x_POSTD30', id);
        setTimeout(() => {
            document.querySelectorAll(".button_int").forEach((b) => {
                let id = b.id.split('_')[3];
                b.onclick = (c) => {
                    let id_aux = id;
                    window.sessionStorage.setItem('x5edP', id_aux);
                    window.location.href = 'visualizar_D.php';
                }
            })
        }, 50)
    })
}