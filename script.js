 jQuery(document).ready(function($) {
  $(".menu-marker").click(() => {
    $("body").toggleClass("header-expanded");
  });

  $("#back-to-top").click(() => {
    $("html, body").animate({ scrollTop: 0 }, 'slow');
  });

  $(window).scroll(() => {
    var body   = $("body");
    var scroll = $(window).scrollTop();

    (scroll > 100) ? 
      body.addClass('docked') : 
      body.removeClass('docked');
  });
});

