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
                console.log(e.id.replace('p_xD30_C',''));
                let post = document.createElement('form');
                let input = documenta.createElement('div');
                input.value;
                //let info = await fetch('');
            }, true);
        });
    }
}
