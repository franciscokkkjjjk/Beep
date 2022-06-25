let creat = false;
const dC = function(e) {
    return document.createElement(e);
}
const eS = function(e, a) {
    return e.setAttribute('class', a);
}
const aP = function(e, a) {
    return e.appendChild(a);
}
function creatFormEdit(){
    if(!creat) {
        creat = true;
        let form = document.createElement('form');
        let div = document.createElement('div');
        div.setAttribute('class', "menu--edit");
        form.setAttribute('action','../issets/script/php/editar_perfil.php');
        form.setAttribute('method','POST');
        form.setAttribute('id','f3deR');
        let opt= document.createElement('option');
        opt.setAttribute('class','opcao--date');
        div.appendChild(opt);
        let div00= document.createElement('div');
        div00.setAttribute('class','event--menu');
        div.appendChild(div00);
        let div01 = document.createElement('div');
        div01.setAttribute('class','menu--body');
        div.appendChild(div01);
        let div02 = document.createElement('div');
        div02.setAttribute('class','cabeca--menu');
        let div0201 = document.createElement('div');
        div0201.setAttribute('class', 'menu--exit');
        let div02010 = document.createElement('div');
        div02010.setAttribute('class', 'menu--pag--button button--header');
        div020101 = document.createElement('div');
        div020101.setAttribute('class', 'menu--exit-img');
        div02010.appendChild(div020101);
        div0201.appendChild(div02010);
        div02.appendChild(div0201);
        let div0202 = document.createElement('div');
        div0202.setAttribute('class', 'menu--text');
        div02.appendChild(div0202);
        let div0203 = document.createElement('div');
        div0203.setAttribute('class','button--menu');
        let but020301 = document.createElement('button');
        but020301.innerHTML = 'Salvar';
        div0203.appendChild(but020301);
        div02.appendChild(div0203);
        div01.appendChild(div02);
        let div03 = document.createElement('div');
        div03.setAttribute('class', 'body--edit');
        let div0301 = document.createElement('div');
        div0301.setAttribute('class','banner--perfil img--edit');
        div0301.style.backgroundImage = 'url(../issets/imgs/profile/'+img_banner+')';
        let div030101 = document.createElement('div');
        div030101.setAttribute('class', 'opt--img');
        let div03010101 = document.createElement('div');
        div03010101.setAttribute('class', 'add-imagem img--opt--menu');
        let div03010102 = document.createElement('div');
        div03010102.setAttribute('class', 'remove-imagem img--opt--menu');
        div030101.appendChild(div03010101);
        div030101.appendChild(div03010102);
        div0301.appendChild(div030101);
        div03.appendChild(div0301);
        div01.appendChild(div03);
        let div04 = dC('div');
        eS(div04, 'img_perfil');
        div04.style.backgroundImage = 'url(../issets/imgs/profile/'+img_perfil+')';
        aP(div01, div04);
        for00 = form.appendChild(div);
        document.body.insertBefore(form, qs('script'));
        console.log(form);
    } else {
        creat = false;
        qs('#f3deR').remove();
    }
}


/*
    <div class="menu--edit">
    <option class="opcao--date"></option>
        <div class="event--menu">
        </div>
        <div class="menu--body">
---2---------<div class="cabeca--menu">
                <div class="button--menu">
                  <button>Salvar</button>
                </div>
            </div>
-----3--------<div class="body--edit">
                <div style='background-image:url(../issets/imgs/profile/<?=$_SESSION["img_banner"]?>)' class="banner--perfil img--edit">
                    <div class="opt--img">
                        <div  class="add-imagem img--opt--menu"></div>
                        <div class="remove-imagem img--opt--menu"></div>
                    </div>
                </div>
---------4--------<div style='background-image:url(../issets/imgs/profile/<?=$_SESSION["img"]?>)' class="img_perfil">
                        <div class="add-imagem img--perfil--add"></div>
                </div>
---------5--------<div class="input--edit nome">
                    <label for="nome">
                        <div class="inf--input--top">
                            <span>Nome</span>
                            <div class="cont--tam">
                                <span class="numer--user nome_contL">0</span><span>/40<span>
                            </div>
                        </div>
                    </label>
                    <input id='nome' class="event--edit--input event--nome input--edit--pre" name='nome_edit'>
                </div>
                <div class="input--edit username">
                    <label for="username">
                    <div class="inf--input--top">
                        <span>username</span>
                        <div class="cont--tam">
                        <span class="numer--user username_contL">0</span><span>/15<span>
                        </div>
                    </div>
                    </label>
                    <input id='username' class="event--edit--input event--username input--edit--pre" name='bio_edit'>
                </div>
                <div class="input--edit bio_edit textarea_event">
                    <label for="bio">
                    <div class="inf--input--top">
                        <span>bio</span>
                        <div class="cont--tam">
                        <span class="numer--user bio_contL">0</span><span>/120<span>
                        </div>
                    </div>
                    </label>
                    <textarea id='bio' class="event--edit--input event--bio input--edit--pre"  name='nome_edit'></textarea>
                </div>
                <div class="input--edit select--area">
                <div class="dat--title">
                    Data de nascimento
                </div>
                <div class="area--selection--date">
                            <div class="select--date mes-eve">
                                <label id="label-mes" for="mes">
                                    mês
                                </label>
                                <select required id="mes" class="select--sub select--date--mes" name="mes">
                                    <option disabled>Atual</option>
                                    <option></option>
                                    <option disabled></option>
                                    <option></option>
                                </select>
                            </div>
                            <div class="select--date dia-eve">
                                <label id="label-dia" for="dia">
                                    dia
                                </label>
                                <select required id="dia" class="select--sub select--date--dia" name="dia">
                                    <option disabled>Atual</option>
                                    <option></option>
                                    <option disabled></option>
                                    <option></option>
                                </select>
                            </div>
                            <div required class="select--date ano-eve">
                                <label id="label-ano" for="ano">
                                    ano
                                </label>
                                <select required id="ano" class="select--sub select--date--ano" name="ano">
                                    <option disabled>Atual</option>
                                    <option></option>
                                    <option disabled></option>
                                    <option></option>
                                </select>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
*/