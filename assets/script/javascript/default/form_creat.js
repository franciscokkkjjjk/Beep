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
        let div03010102 = document.createElement('div');
        div03010102.setAttribute('class', 'remove-imagem img--opt--menu');
        let form = document.createElement('form');
        let div = document.createElement('div');
        div.setAttribute('class', "menu--edit");
        form.setAttribute('action','../assets/script/php/editar_perfil.php');
        form.setAttribute('method','POST');
        form.setAttribute('id','f3deR');
        form.setAttribute('enctype', 'multipart/form-data');
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
        div02010.setAttribute('class', 'menu--pag--button button--header button-exit-event');
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
        div0301.setAttribute('class','banner--perfil event--banner img--edit');
        if(img_banner == ''){
            div03010102.style.display = 'none';
        } else{
            div0301.style.backgroundImage = 'url(../assets/imgs/profile/'+img_banner+')';
        }
        let inputBool = document.createElement('input');
        inputBool.setAttribute('type', 'hidden');
        inputBool.value = false;
        inputBool.setAttribute('name', 'remove_img');
        inputBool.setAttribute('class', 'remove_img');
        let div030101 = document.createElement('div');
        div030101.setAttribute('class', 'opt--img');
        let div03010101 = dC('label');
        div03010101.setAttribute('for', 'input_file_banner');
        let div0301010101 = document.createElement('div');
        div0301010101.setAttribute('class', 'add-imagem img--opt--menu');
        let div0301010102 = dC('input');
        eS(div0301010102, 'input_file');
        div0301010102.setAttribute('name','input_file_banner');
        div0301010102.setAttribute('id','input_file_banner');
        div0301010102.setAttribute('type','file');

       

        aP(div03010101, div0301010101);
        aP(div03010101, div0301010102);
        div030101.appendChild(div03010101);
        div030101.appendChild(div03010102);
        div030101.appendChild(inputBool);
        div0301.appendChild(div030101);
        div03.appendChild(div0301);
        div01.appendChild(div03);

        let div04 = dC('div');
        eS(div04, 'img_perfil');
        if(img_perfil == ''){

        } else{
        div04.style.backgroundImage = 'url(../assets/imgs/profile/'+img_perfil+')';
        }
        let div0401 = dC('label');
        div0401.setAttribute('for','input_file_perfil');
        let div040101 = dC('div');
        eS(div040101, 'add-imagem img--perfil--add');
        let div040102 = dC('input');
        eS(div040102, 'input_file');
        div040102.setAttribute('name','input_file_perfil');
        div040102.setAttribute('id','input_file_perfil');
        div040102.setAttribute('type','file');

        aP(div0401, div040101);
        aP(div0401, div040102);
        aP(div04, div0401);
        aP(div01, div04);

        let div05 = dC('div');
        eS(div05, 'input--edit nome');
        let div0501 = dC('label');
        div0501.setAttribute('for','nome');
        let div050101 = dC('div');
        eS(div050101, 'inf--input--top');
        let div05010101 = dC('span');
        div05010101.innerHTML = 'nome';
        let div05010102 = dC('div');
        eS(div05010102, 'cont--tam');
        let div0501010201 = dC('span');
        eS(div0501010201, 'numer--user nome_contL');
        div0501010201.innerHTML = '0';
        let div0501010202 = dC('span');
        div0501010202.innerHTML = '/40';
        let input05 = dC('input');
        input05.setAttribute('id', 'nome');
        input05.value = nome;
        eS(input05, 'event--edit--input event--nome input--edit--pre'); 
        input05.setAttribute('name', 'nome_edit');

        let div06 = dC('div');
        eS(div06, 'input--edit username');
        let div0601 = dC('label');
        div0601.setAttribute('for','username');
        let div060101 = dC('div');
        eS(div060101, 'inf--input--top');
        let div06010101 = dC('span');
        div06010101.innerHTML = 'username';
        let div06010102 = dC('div');
        eS(div06010102, 'cont--tam');
        let div0601010201 = dC('span');
        eS(div0601010201, 'numer--user username_contL');
        div0601010201.innerHTML = '0';
        let div0601010202 = dC('span');
        div0601010202.innerHTML = '/15';
        let input06 = dC('input');
        let user_dc = username.replace('@', '');
        input06.value = user_dc;
        input06.setAttribute('id', 'username')
        eS(input06, 'event--edit--input event--username input--edit--pre'); 
        input06.setAttribute('name', 'username_edit');

        let div07 = dC('div');
        eS(div07, 'input--edit bio_edit textarea_event');
        let div0701 = dC('label');
        div0701.setAttribute('for','bio');
        let div070101 = dC('div');
        eS(div070101, 'inf--input--top');
        let div07010101 = dC('span');
        div07010101.innerHTML = 'bio';
        let div07010102 = dC('div');
        eS(div07010102, 'cont--tam');
        let div0701010201 = dC('span');
        eS(div0701010201, 'numer--user bio_contL');
        div0701010201.innerHTML = '0';
        let div0701010202 = dC('span');
        div0701010202.innerHTML = '/120';
        let input07 = dC('textarea');
        input07.innerHTML = bio;
        input07.setAttribute('id', 'bio')
        eS(input07, 'event--edit--input event--bio input--edit--pre'); 
        input07.setAttribute('name', 'bio_edit');

        let div_error = dC('div');
        eS(div_error, 'mensagem--erro');
        if(error_php == '') {} else {
            div06.classList.add('error--login');
            div_error.innerHTML = 'Esse username já existe';
        }


        let div08 = dC('div');
        eS(div08, 'input--edit select--area');
        let div0801 = dC('div');
        eS(div0801, 'dat--title');
        div0801.innerHTML = 'Data de nascimento';
        let div0802 = dC('div');
        eS(div0802, 'area--selection--date');
        let div080201 = dC('div');
        eS(div080201, 'select--date-edit mes-eve');
        let div080202 = dC('label');
        div080202.setAttribute('for','mes');
        div080202.setAttribute('id','label-mes');
        div080202.innerHTML = 'mês';
        let select08 = dC('select');//required id="mes" class="select--sub select--date--mes" name="mes"
        select08.setAttribute('id', 'mes');
        eS(select08, 'select--sub select--date--mes');
        select08.required=true;
        select08.setAttribute('name', 'mes');
        let opt08 = dC('option');
        opt08.disabled = true;
        opt08.innerHTML = 'atual';
        let opt0801 = dC('option');
        let opt0802 = dC('option');
        opt0802.disabled = true;
        opt0801.innerHTML = m_nas;

        let div090201 = dC('div');
        eS(div090201, 'select--date-edit dia-eve');
        let div090202 = dC('label');
        div090202.setAttribute('for','dia');
        div090202.setAttribute('id','label-dia');
        div090202.innerHTML = 'dia';
        let select09 = dC('select');//required id="mes" class="select--sub select--date--mes" name="mes"
        select09.setAttribute('id', 'dia');
        eS(select09, 'select--sub select--date--mes');
        select09.required=true;
        select09.setAttribute('name', 'dia');
        let opt09 = dC('option');
        opt09.disabled = true;
        opt09.innerHTML = 'atual';
        let opt0901 = dC('option');
        let opt0902 = dC('option');
        opt0902.disabled = true;
        opt0901.innerHTML = d_nas;

        let div100201 = dC('div');
        eS(div100201, 'select--date-edit ano-eve');
        let div100202 = dC('label');
        div100202.setAttribute('for','ano');
        div100202.setAttribute('id','label-ano');
        div100202.innerHTML = 'ano';
        let select10 = dC('select');//required id="mes" class="select--sub select--date--mes" name="mes"
        select10.setAttribute('id', 'ano');
        eS(select10, 'select--sub select--date--ano');
        select10.required=true;
        select10.setAttribute('name', 'ano');
        let opt10 = dC('option');
        opt10.disabled = true;
        opt10.innerHTML = 'atual';
        let opt1001 = dC('option');
        let opt1002 = dC('option');
        opt1002.disabled = true;
        opt1001.innerHTML = y_nas;
        
        aP(div05010102, div0501010201);
        aP(div05010102, div0501010202);
        aP(div050101,div05010101);
        aP(div050101,div05010102);
        aP(div0501,div050101);
        aP(div05,div0501);
        aP(div05, input05);
        aP(div01, div05);

        aP(div06010102, div0601010201);
        aP(div06010102, div0601010202);
        aP(div060101,div06010101);
        aP(div060101,div06010102);
        aP(div0601,div060101);
        aP(div06,div0601);
        aP(div06, input06);
        aP(div01, div06);

        aP(div01, div_error);

        aP(div07010102, div0701010201);
        aP(div07010102, div0701010202);
        aP(div070101,div07010101);
        aP(div070101,div07010102);
        aP(div0701,div070101);
        aP(div07,div0701);
        aP(div07, input07);
        aP(div01, div07);

  
        
        aP(div08,div0801);
        aP(div0802, div080201);
        aP(div080201, div080202);
        aP(select08, opt08);
        aP(select08, opt0801);
        aP(select08, opt0802);
        aP(div080201, select08);
        aP(div08,div0802);


        aP(div0802, div090201);
        aP(div090201, div090202);
        aP(select09, opt09);
        aP(select09, opt0901);
        aP(select09, opt0902);
        aP(div090201, select09);

        aP(div0802, div100201);
        aP(div100201, div100202);
        aP(select10, opt10);
        aP(select10, opt1001);
        aP(select10, opt1002);
        aP(div100201, select10);

        aP(div01, div08);
        
        for00 = form.appendChild(div);

        let scriptFun = dC('script');
        scriptFun.setAttribute('type', 'text/javascript');

        document.body.insertBefore(form, qs('script'));
        document.body.insertBefore(scriptFun, qs('script'));

        qs('.button-exit-event').onclick = creatFormEdit;
        qs('.event--menu').onclick = creatFormEdit;

        input_ac(qs('.event--nome'), qs('.nome'));
        input_ac(qs('.event--username'), qs('.username'));
        input_ac(qs('.event--bio'), qs('.bio_edit'));

            input_ac_selec(qs('#mes'), qs('#label-mes'));
            input_ac_selec(qs('#ano'), qs('#label-ano'));
            input_ac_selec(qs('#dia'), qs('#label-dia'));
///copia do date_script
            var mes = [
                'Janeiro',//0
                'Fevereiro',
                'Março',//2
                'Abril',
                'Maio',//4
                'Junho',
                'Julho',//6
                'Agosto',//7
                'Setembro',
                'Outubro',//9
                'Novembro',
                'Dezembro'//10
            ]      
        let opt_d = qs('.opcao--date');
        let i_aux = 0;
        mes.forEach(() => {
            let clone = opt_d.cloneNode(true);
            clone.innerHTML = mes[i_aux];
            clone.classList.add('event-mes');
            qs('#mes').appendChild(clone);
            i_aux++;
        });
        let mes_op = qs('#mes');
        mes_op.addEventListener('blur',()=>{
            let value_mes = mes_op.value;
                if(value_mes == mes[0] || value_mes == mes[2] || value_mes == mes[4] || value_mes == mes[6]|| value_mes == mes[7]|| value_mes == mes[9] || value_mes == mes[11]){
                    let event_dia = qsAll('.event-dia');
                    event_dia.forEach((e)=>{
                        e.remove();
                    })
                    let event_ano = qsAll('.event-ano');
                    event_ano.forEach((e)=>{
                        e.remove();
                    })
                    for(i=1; i < 32; i++){
                        let clone = opt_d.cloneNode(true);
                        clone.innerHTML = i;
                        clone.classList.add('event-dia');
                        qs('#dia').appendChild(clone);
                    }
                    for(i=2022; i > 1900; i--){
                        let clone = opt_d.cloneNode(true);
                        clone.innerHTML = i;
                        clone.classList.add('event-ano');
                        qs('#ano').appendChild(clone);
                    }
                } else if (value_mes == mes[1]) {
                    let event_dia = qsAll('.event-dia');
                    event_dia.forEach((e)=>{
                        e.remove();
                    })
                    let event_ano = qsAll('.event-ano');
                    event_ano.forEach((e)=>{
                        e.remove();
                    })
                    for(i=1; i < 30; i++){
                        let clone = opt_d.cloneNode(true);
                        clone.innerHTML = i;
                        clone.classList.add('event-dia');
                        qs('#dia').appendChild(clone);
                    }
                    for(i=2008; i > 1900; i = i-4){
                        let clone = opt_d.cloneNode(true);
                        clone.innerHTML = i;
                        clone.classList.add('event-ano');
                        qs('#ano').appendChild(clone);
                    }
                } else {
                    let event_dia = qsAll('.event-dia');
                    event_dia.forEach((e)=>{
                        e.remove();
                    })
                    let event_ano = qsAll('.event-ano');
                    event_ano.forEach((e)=>{
                        e.remove();
                    })
                    for(i=1; i < 31; i++){
                        let clone = opt_d.cloneNode(true);
                        clone.innerHTML = i;
                        clone.classList.add('event-dia');
                        qs('#dia').appendChild(clone);
                    }
                    for(i=2009; i > 1900; i--){
                        let clone = opt_d.cloneNode(true);
                        clone.innerHTML = i;
                        clone.classList.add('event-ano');
                        qs('#ano').appendChild(clone);
                    }
                }
        }, true)
        for(i=1; i < 32; i++){
            let clone = opt_d.cloneNode(true);
            clone.innerHTML = i;
            clone.classList.add('event-dia');
            qs('#dia').appendChild(clone);
        }
        for(i=2009; i > 1900; i--){
            let clone = opt_d.cloneNode(true);
            clone.innerHTML = i;
            clone.classList.add('event-ano');
            qs('#ano').appendChild(clone);
        }
//mostra uma previa da imagem antes do upload
    function showImg(e,img_lugar){
        return e.addEventListener('change', function () {   
            let img = e.files[0];
            console.log(img);
            let src = URL.createObjectURL(img);
            div03010102.style.display = 'block';
            document.querySelector('.remove_img').value = 'false';
            img_lugar.style.backgroundImage = "url("+src+")";
        });
    }
    div03010102.addEventListener('click',  ()=>{
        div03010102.style.display = 'none';
        document.querySelector('.remove_img').value = 'true';
        document.querySelector('.event--banner').style.backgroundImage = '';
    }, true)
    showImg(qs('#input_file_perfil'), qs('.img_perfil'));
    showImg(qs('#input_file_banner'), qs('.event--banner'));
    qs('html').style.overflow = 'hidden';
    } else {
        creat = false;
        qs('html').style.overflow = '';
        qs('#f3deR').remove();
    }
}
let buttonEdit = qs('.button--editar');
if(buttonEdit != null){ buttonEdit.addEventListener('click',creatFormEdit,true);}


/*

<canvas id='canvas'></canvas> para recortar imagem
function cropImg(){
  const canvas = document.getElementById('canvas');
  const ctx = canvas.getContext('2d');

  var image = new Image();
  image.src = "https://images.unsplash.com/photo-1593642634443-44adaa06623a?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=725&q=80"; 
  
  image.onload = function(){
    ctx.drawImage(image, 150, 200, 500, 300, 60,60, 500, 300);
  }
}

cropImg();
*/