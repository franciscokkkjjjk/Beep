/*
     <div id="inputdiv"  contenteditable="true" class="inputdiv--form--post"></div>
*/ 
let modal = qs('.modal-coment');
let clone = modal.cloneNode(true);
function coment() {
    modal.remove();
    let comentar = qsAll('.comentar');
    if(comentar.length > 0) {
        console.log('ola')
        comentar.forEach((e) => {
            e.addEventListener('click', async (element)=>{
                clone.style.display = '';
                qs('.feed-area').append(clone);
                let id = e.id.replace('p_xD30_C','');
                let post = document.createElement('form');
                let input = document.createElement('input');
                post.setAttribute('method','post');
                input.setAttribute('value',id);
                input.setAttribute('name','p-xD30');
                post.appendChild(input);
                let info_requi = new FormData(post);
                let info = await fetch('../assets/script/php/requsicoes/comenta.php', {
                    method:'POST',
                    body:info_requi
                })
                let json_c = await info.json()
                console.log(json_c);
         }, true);
        });
    }
}
