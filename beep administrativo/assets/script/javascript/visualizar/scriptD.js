console.log(sessionStorage.x5edS);
if (window.sessionStorage.x5edS == "null") {
    window.sessionStorage.removeItem('x5edS');
}
if (window.sessionStorage.x5edP == "null") {
    window.sessionStorage.removeItem('x5edP');
}
if (window.sessionStorage.x5edP != undefined) {
    async function creat_list_post_D() {
        document.querySelector('.loading').remove();
    }
    creat_list_post_D();
}else {
    window.location.href = 'dununcias.php';
}