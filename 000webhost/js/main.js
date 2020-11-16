$(document).ready(function() {
  if ($(window).width() > 992) {
    $(window).scroll(function(){
      if ($(this).scrollTop() > 145) {
        $('#navbar_top').addClass("fixed-top p");
        $('#nav_logo').removeClass("d-none");
        $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
      }else{
        $('#navbar_top').removeClass("fixed-top");
        $('#nav_logo').addClass("d-none");
        $('body').css('padding-top', '0');
      }
    });
  } 
});
