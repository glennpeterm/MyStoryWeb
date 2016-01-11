$(function() {
    //grid portfolio 
        Grid.init();
        


/* ---------- @ Scroll to Top -----------*/
$('div.scroll-top a').click(function(){
$('html,body').animate({scrollTop:0},500);
return false;
});


$(document).ready(function() {	
    $('.nav').onePageNav({
    filter: ':not(.external)',
    currentClass: 'active',
    scrollThreshold: 0.25
    });
    $(".main-nav").sticky({ topSpacing: 0 });
});

});
