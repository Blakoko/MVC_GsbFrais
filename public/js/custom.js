/**
 * Created by albert on 17/11/15.
 */
$(document).ready(function() {
    $(window).bind('scroll',function(){
     var navheight = $(window).height() - 70;
        if ($(window).scrollTop() > navheight){
            $('nav').addClass('fixed');
        }
        else {
            $('nav').removeClass('fixed');
        }

            });
});