function close_moda_rede() {
    document.querySelector('.moda_fast').style.opacity = "0";
    document.querySelector('html').style.overflow = '';
    setTimeout(()=>{document.querySelector('.moda_fast').style.display = 'none';}, 250);
}
document.querySelector('.button_area_add_rede').addEventListener('click', (e)=>{
    e.preventDefault();
    document.querySelector('.moda_fast').style.display = '';
    document.querySelector('html').style.overflow = 'hidden';
    setTimeout(()=>{document.querySelector('.moda_fast').style.opacity = "1";}, 250);
    document.querySelectorAll('.exit_event_rede').forEach((b)=>{
        b.onclick = close_moda_rede;
    })
})