$('.toggle-nav').click(() => {
    if (!$('header').hasClass('nav-visible')){
        $('header').addClass('nav-visible');
    } else{
        $('header').removeClass('nav-visible');
    }
})