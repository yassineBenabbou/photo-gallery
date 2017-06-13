$(document).ready(function() { 


    var p = 0;
    var interval;
    var imgstack;

    $('.mss').mouseover(function () {

    var cover = this;

    imgstack = $(this).data('thumbnails');    

   interval =  setInterval(
            function () {
                if (p < imgstack.length) {                    
                    var img = imgstack[p];
                    $(cover).attr('src', img);
                    p = p + 1;
                }
                else {
                    p = 0;
                }
            }
        , 1000);
    });

    $('.mss').mouseout(function () {  
        clearInterval(interval);
        p = 0;   
        var cover = $(this).data('cover');
        $(this).attr('src', cover);
    });
});       