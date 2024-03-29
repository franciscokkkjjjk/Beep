let key_anterior;
let selecionada = 0;
function loading(area = 0) {
    let fundo = document.createElement('div');
    let spin = document.createElement('div');
    fundo.setAttribute('class', 'back--event');
    spin.setAttribute('class', 'event')
    fundo.appendChild(spin);
    if (area == false)
        document.querySelector('.area_loading').append(fundo);
    else {
        document.querySelector('.modal_pesquisa_autocomplete').innerHTML = '';
        document.querySelector('.modal_pesquisa_autocomplete').append(fundo);
    }
}

async function pesquisa_(pesquisa) {
    let pesquisaCompleta = pesquisa;
    let pesquisa_form = new FormData();
    if (selecionada == 0) {
        pesquisa_form.append('x_POST30', pesquisaCompleta);
    } else if (selecionada == 1) {
        pesquisa_form.append('x_GAME30', pesquisaCompleta);
    } else if (selecionada == 2) {
        pesquisa_form.append('x_USUARIO30', pesquisaCompleta);
    } else {
        let msm = {
            "mensage": 'Não foi possivel fazer a pesquisa.',
            'error': true
        };
        alert_mensage(msm);
    }
    let res_pes;
    let aux = 0;
    if (document.querySelector('.nada') != undefined) {
        document.querySelectorAll('.nada').forEach((e) => e.remove());
    }
    document.querySelectorAll('.post--menu--area').forEach((e) => {
        if (aux > 1) {
            e.remove();
        }
        aux++;
    })
    document.querySelector('.area_game').innerHTML = '';
    document.querySelector('.users_area').innerHTML = '';
    loading();
    try {
        let req_pes = await fetch('../assets/script/php/requsicoes/pesquisas/pesquisar_auto.php', {
            method: "POST",
            body: pesquisa_form,
        });
        if (selecionada == 0 || selecionada == 1) {
            res_pes = await req_pes.json();
        }
        if (selecionada == 2) {
            res_pes = await req_pes.text();
        }
    } catch {
        document.querySelector('.area_loading').innerHTML = '';
        post_not(5);
        return;
    }
    console.log(res_pes);
    document.querySelector('.area_loading').innerHTML = '';
    document.querySelector(".modal_pesquisa_autocomplete").style.opacity = '0';
    setTimeout(() => document.querySelector(".modal_pesquisa_autocomplete").style.display = 'none', 25)
    document.querySelector('.modal_close_pesquisa').style.display = 'none';

    console.log(res_pes);
    if (res_pes.nada == undefined && selecionada == 0) {
        console.log(res_pes);
        criarPosts(res_pes);
        curtir_post();
        desCurtir();
        viwimg();
        show_CM();
        descompartilhar();
        qs('.event-direct').onclick = compartilhar;
        post_num_curtida();
        setInterval(() => {
            post_num_curtida();
        }, 9000);
        post_num_compartilhamento();
        setInterval(async () => {
            post_num_compartilhamento();
        }, 9000);
    } else if (res_pes.nada == undefined && selecionada == 1) {
        creat_game(res_pes);
    } else if (res_pes != '' && selecionada == 2) {
        document.querySelector('.users_area').innerHTML = res_pes;
        document.querySelectorAll('.area_users').forEach((e) => {
            let id = e.id;
            e.onclick = () => {
                window.location.href = "perfil_user_v.php?username=" + id;
            };
        });
    } else {
        post_not(5);

    }
}
document.querySelector('.publicacoes_c').onclick = (e) => {
    selecionada = 0;
    document.querySelectorAll('.publicacoes_area').forEach((e) => {
        e.classList.remove('active_pesquisa');
    })
    let pesquisa_generic = document.querySelector('.input_pesquisar').value;
    if (pesquisa_generic != "")
        pesquisa_(pesquisa_generic);
    else {
        let aux = 0;
        document.querySelectorAll('.post--menu--area').forEach((e) => {
            if (aux > 1) {
                e.remove();
            }
            aux++;
        })
        document.querySelector('.area_game').innerHTML = '';
        document.querySelector('.users_area').innerHTML = '';
    }
    document.querySelector('.blue_border_').classList.remove('blue_area_3');
    document.querySelector('.blue_border_').classList.remove('blue_area_2');
    document.querySelector('.blue_border_').classList.add('blue_area_1');
}
document.querySelector('.usuario_c').onclick = (e) => {
    selecionada = 2;
    document.querySelectorAll('.publicacoes_area').forEach((e) => {
        e.classList.remove('active_pesquisa');
    })
    let pesquisa_generic = document.querySelector('.input_pesquisar').value;
    if (pesquisa_generic != "")
        pesquisa_(pesquisa_generic);
    else {
        let aux = 0;
        document.querySelectorAll('.post--menu--area').forEach((e) => {
            if (aux > 1) {
                e.remove();
            }
            aux++;
        })
        document.querySelector('.area_game').innerHTML = '';
        document.querySelector('.users_area').innerHTML = '';
    }
    document.querySelector('.blue_border_').classList.remove('blue_area_2');
    document.querySelector('.blue_border_').classList.add('blue_area_3');
    document.querySelector('.blue_border_').classList.remove('blue_area_1');
}
document.querySelector('.game_c').onclick = (e) => {
    selecionada = 1;
    document.querySelectorAll('.publicacoes_area').forEach((e) => {
        e.classList.remove('active_pesquisa');
    })
    let pesquisa_generic = document.querySelector('.input_pesquisar').value;
    if (pesquisa_generic != "")
        pesquisa_(pesquisa_generic);
    else {
        let aux = 0;
        document.querySelectorAll('.post--menu--area').forEach((e) => {
            if (aux > 1) {
                e.remove();
            }
            aux++;
        })
        document.querySelector('.area_game').innerHTML = '';
        document.querySelector('.users_area').innerHTML = '';
    }
    document.querySelector('.blue_border_').classList.add('blue_area_2');
    document.querySelector('.blue_border_').classList.remove('blue_area_3');
    document.querySelector('.blue_border_').classList.remove('blue_area_1');
}
qs('.input_pesquisar').addEventListener('keyup', async (e) => {
    console.log(e.which)
    let pesquisa = e.target.value.trim();
    let res;

    if (e.which == 13 && e.target.value.trim() != '') {
        console.log('entrou');
        pesquisa_(pesquisa);
    }
    if (pesquisa == key_anterior) {
        return;
    }
    if (pesquisa != '') {
        document.querySelector('.modal_pesquisa_autocomplete').style.display = 'block';
        setTimeout(() => {
            document.querySelector('.modal_pesquisa_autocomplete').style.opacity = '1';
        }, 35)
        document.querySelector('.modal_close_pesquisa').style.display = '';
        loading(1);
        try {
            let form_ = new FormData();
            form_.append('x_AUTO30', pesquisa);
            let req_ = await fetch('../assets/script/php/requsicoes/pesquisas/pesquisar_auto.php', {
                method: 'POST',
                body: form_
            });
            res = await req_.text();
        } catch {
            let msm = {
                "mensage": "Não foi possivel realizar a pesquisa.",
                "error": true
            }
            alert_mensage(msm);
            return;
        }
        setTimeout(() => {
            document.querySelectorAll('.area_users').forEach((e) => {
                let id = e.id;
                e.onclick = () => {
                    window.location.href = "perfil_user_v.php?username=" + id;
                };
            });
            let pesquisaCompleta = document.querySelector('.pesquisar_completa').ariaValueText;
            document.querySelector('.pesquisar_completa').onclick = (e) => {
                let pesquisaCompleta = e.target.ariaValueText;
                pesquisa_(pesquisaCompleta);
            }
        })
        document.querySelector('.modal_pesquisa_autocomplete').innerHTML = res;
    } else {
        document.querySelector('.modal_pesquisa_autocomplete').style.opacity = '0';
        setTimeout(() => {
            document.querySelector('.modal_pesquisa_autocomplete').style.display = 'none';
        }, 15)
        document.querySelector('.modal_close_pesquisa').style.display = 'none';
    }
    key_anterior = pesquisa;
}, true);
document.querySelector('.modal_close_pesquisa').onclick = () => {
    document.querySelector('.modal_pesquisa_autocomplete').style.opacity = '0';
    setTimeout(() => document.querySelector('.modal_pesquisa_autocomplete').style.display = 'none', 15)
    document.querySelector('.modal_close_pesquisa').style.display = 'none';
}
