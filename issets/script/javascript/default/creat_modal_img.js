qsAll('.post--img').forEach(e => {
    e.addEventListener('click', ()=>{
        let div00= document.createElement('div');
        div00.setAttribute('class', 'img--modal');
        let event_exit = document.createElement('div');
        event_exit.setAttribute('class', 'exit_event');
        div00.appendChild(event_exit);
        let div03 = document.createElement('div');
        div03.setAttribute('class', 'menu--exit-img-area');
        div00.appendChild(div03);
        let div04 = document.createElement('div');
        div04.setAttribute('class', 'menu--exit-img');
        div03.appendChild(div04);
        let div02 = document.createElement('div');
        div02.setAttribute('class', 'local--max--img');
        div00.appendChild(div02);
        let rem = e.style.backgroundImage;
        let rem00 = rem.replace('url("', ' ');
        let rem01 = rem00.replace('")','');
        let img = document.createElement('img');
        img.setAttribute('src',rem01);
        div02.appendChild(img);
        qs('html').style.overflow = 'hidden';
        document.body.insertBefore(div00,qs('script'));
        setTimeout(()=>{
            qs('.img--modal').style.opacity = '1';
        }, 50)
        function exit_img() {
            qs('.img--modal').style.opacity = '0';
            setTimeout(()=>{
                qs('.img--modal').remove();
            }, 50)
            qs('html').style.overflow = '';
            return true;
        }
        
        qs('.exit_event').addEventListener('click',exit_img,true);
        qs('.menu--exit-img-area').addEventListener('click',exit_img,true);
    });
});