
    qs('.button--post--form').disabled = true;
    qs('.form--inpudiv--event').addEventListener('click',()=>{
        qs('.event--placeholder').style.display='none';
        /*
        <div id="inputdiv"  contenteditable="true" class="inputdiv--form--post"></div>
        */ 
        if(qs('.inputdiv--form--post') == undefined){ 
            let creat_div = document.createElement('div');
            creat_div.id = 'inputdiv';
            creat_div.contentEditable = 'true';
            creat_div.classList.add('inputdiv--form--post');
            qs('.form--inpudiv--event').appendChild(creat_div);
            qs('.inputdiv--form--post').focus();
        }
        qs('.inputdiv--form--post').addEventListener('blur',(e)=>{
            let value = e.target.innerText.trim()
            if(value == '' && qs('.input_img_event').value == '') {
                e.target.innerText = '';
                qs('.button--post--form').disabled = true;
                qs('.button--post--form').style.backgroundColor = '';
                qs('.button--post--form').style.cursor = '';
                qs('.event--placeholder').style.display='';
                qs('.inputdiv--form--post').remove();
            } else if(value == ''){
                qs('.event--placeholder').style.display='';
                qs('.inputdiv--form--post').remove();
            } else {
                qs('.form--event--diviput').value = qs('.inputdiv--form--post').innerText;
                qs('.button--post--form').disabled = false;
                qs('.button--post--form').style.backgroundColor = '#53ffff';
                qs('.button--post--form').style.cursor = 'pointer';
            }
        },true)
    },true)
    showImg_form(qs('.input_img_event'), qs('.img--post'), true);
    qs('.event_modal_game').onclick = ()=>{
        show_modal_games(qs('.modal_game_area_publi'));
    }

