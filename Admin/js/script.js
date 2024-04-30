//  submenu toggler
$(document).ready(function(){

    $(".sub_menu_btn").click(function(){
        $(this).next(".sub_menu").slideToggle();
        $(this).find("dropdown").toggleClass("rotate");

    });
}) 