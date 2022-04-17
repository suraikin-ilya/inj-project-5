$(document).on('click', '.open-popup', function (){
    $('.popup-bg').fadeIn(600);
});
$(document).on('click','.close-popup',function (){
    $('.popup-bg').fadeOut(600);
});

    var timeleft = 30;
    var downloadTimer = setInterval(function(){
    if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.getElementById("countdown").innerHTML = "Finished";
} else {
    document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
}
    timeleft -= 1;
}, 1000);
