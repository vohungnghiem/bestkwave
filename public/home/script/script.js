$(document).ready(function () {
    var url = window.location + "";
    var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "");
    var res = path.split("/");
    $(".menu-item a").each(function () {
        if ((res[0] + '/' + res[1]) == $(this).attr('href')) {
            $(this).parents('.menu-item').addClass('menu-open');
        }
        if ($('.post-cat-title').attr('urlpage') == $(this).attr('href')) {
            $(this).parents('.menu-item').addClass('menu-open');
        }
    });
    if(typeof res[2] === "undefined")
    {
        $(".sub-menu li:eq(0)").addClass('active');
    } 
    $(".sub-menu a").each(function (){
        if ((res[0] + '/' + res[1] + '/' + res[2]) == $(this).attr('href')) {
            $(".sub-menu li").removeClass('active');
            $(this).parents('li').addClass('active');
        }
        
        
    });
    
});


// search
$(document).ready(function () {
    $( "div" ).on( "click", ".icon-search", function() {
        $('.form').css('display', 'flex');
        $('.icon-search').css('display','none');
    });
});

$(document).click(function(e) {
    if ($(e.target).closest(".second-header-right").attr("class") != "second-header-right") {
        $('.form').css('display', 'none');
        $('.icon-search').css('display','block');
    }
});

// function menu
function sticky_menu(menu, sticky) {
    if (typeof sticky === 'undefined' || !jQuery.isNumeric(sticky)) sticky = 0;
    if ($(window).scrollTop() >= sticky) {
        if ($('#menufixed').length === 0) {
            widthfixed = $('#container-all').width();
            logo = $('#logo-fixed').html();
            mainmenu = $('#main-menu-fixed').html();
            secondmenu = $('#second-header-right').html();
            menu.after(
                '<div class="fixed">'+
                    '<div id="menufixed" style="width:'+widthfixed+'px; z-index: 10" >'+
                        '<div class="second-header-left">' +
                            logo + mainmenu + 
                        '</div>'+
                        secondmenu +
                    '</div>'+
                '</div>'
            );
        }
        $('#google_translate_element').css({"position": "fixed", "bottom": "30px","left":"0px"});
    } else {
        $('.fixed').remove();
        $('#google_translate_element').css({"position": "static"});
    }
}
// function menu mobile
function sticky_menu_mobile(menu, sticky) {
    if (typeof sticky === 'undefined' || !jQuery.isNumeric(sticky)) sticky = 0;
    if ($(window).scrollTop() >= sticky) {
        if ($('#menufixed').length === 0) {
            widthfixed = $('#container-all').width();
            logo = $('#logo-fixed').html();
            mobile_right = $('#mobile-right').html();
            menu.after(
            '<div class="fixedmobile">'+
                '<div id="menufixed" style="width:'+widthfixed+'px; z-index:10" >'+
                    '<div class="second-header-left">' +
                        logo + 
                    '</div>'+
                    '<div class="mobile-right">' + 
                        mobile_right + 
                    '</div>'+
                '</div>'+
            '</div>');
        }
    } else {
        $('.fixedmobile').remove();
    }
}
// condition menu
$(document).ready(function () { 
    var menu = $("#wrap-content");
    if (menu.length) {
        var sticky = menu.offset().top + 1;
        if ($(window).width() > 768) {
            sticky_menu(menu, sticky);
            $(window).on('scroll', function () {
                sticky_menu(menu, sticky);
            });
        }else{
            sticky_menu_mobile(menu, sticky);
            $(window).on('scroll', function () {
                sticky_menu_mobile(menu, sticky);
            });
        }
    }
});
// extra mobile menu
$(document).ready(function () {
    $( "body").on( "click", ".showicon", function() {
        $('.showicon').remove();
        $('.icon').append('<i class="fas fa-times closeicon"></i>')
        var height = $(window).height() - 50;
        $('.mobile').addClass("mobile-full");
        $('#menufixed').css('display','none');
        var form = $('#form').html();
        var ul = $('#main-menu-fixed').html();
        var social = $('#social').html();
        var drop_link = $('#drop_link').html();
        $(".mobile-full").append(
            '<div class="row mobile-content" style="height:'+height+'px">'+
                '<div class="col-md-6 col-12">'+
                form +
                ul +
                '</div>'+
                '<div class="col-md-6 col-12">'+
                    social +
                    '<div class="list-drop">'+
                    drop_link +
                    '</div>'+
                '</div>'+
            '</div>'
        );
    });
    $( "body").on( "click", ".closeicon", function() {
        $('.closeicon').remove();
        $('.icon').append(' <i class="fas fa-bars showicon"></i>')
        $('.mobile-content').remove();
        $('.mobile').removeClass("mobile-full");
        $('#menufixed').css('display','block');
    });
});
// tranform logo page
$(document).ready(function () {
    if($(".header-wrapper").hasClass("layout-two-check")) {
        $(".mobile-logo").addClass("layout-logo-two");
    } 
});
// resize 
$(document).ready(function(){
    $(window).resize(function(){
        widthfixed = $(window).width();
        $('#menufixed').css('width',widthfixed);
    });
});
// scroll
$(document).ready(function () {
    $( window ).scroll(function() {
        var y = $(this).scrollTop(); 
        if (y > 200) {
            $('.scroll').fadeIn();
        }else{
            $('.scroll').fadeOut();
        }
    });
    $('.scroll').click(function(){
        $('html, body').animate({scrollTop : 0},700);
        return false;
    });
});

