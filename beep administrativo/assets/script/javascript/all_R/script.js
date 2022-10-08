async function so_game() {
    let req = await fetch(); 
}
function creat_list(list, img_dir, url_reqs) {
    let sL = querySelector;
    let list_clone = qs('.list_area').cloneNode(true);
        list_clone.sL('.list_img').style.backgroundImage = `url(../../../../assets/imgs/${img_dir}/${list})`
        list_clone.sL('.list_title').innerHTML = list.title;
        list_clone.sL('.button_a').onclick = async ()=>{
                let req = await fetch(url_reqs[0]);
                let res = await req.json();
                alert_mensage(res)
        }
        list_clone.sL('.button_b').onclick = async ()=>{
            let req = await fetch(url_reqs[1]);
            let res = await req.json();
            alert_mensage(res)
            }
        list_clone.sL('.button_c').onclick = async ()=>{
            let req = await fetch(url_reqs[2]);
            let res = await req.json();
            alert_mensage(res)
        }
    document.querySelector('.corpo_list').append(list_clone);
}
//  <div class="corpo_list">
//             <div class="list_area">
//                 <div class="area_list_info_1">
//                     <div class="list_img">
//                     </div>
//                     <div class="list_title">
//                         Red Dead Redempition
//                     </div>
//                 </div>
//                 <div class="area_list_info_2">
//                     <nav>
//                         <a href="" class="a_nav">
//                             <div class="button_a button_int">
//                                 <div class="img_"></div>
//                             </div>
//                         </a>
//                     </nav>
//                     <div class="button_b button_int">
//                         <div class="img_"></div>
//                     </div>
//                     <div class="button_c button_int">
//                         <div class="img_"></div>
//                     </div>
//                 </div>
//             </div>
//         </div> 
