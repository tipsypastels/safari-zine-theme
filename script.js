 jQuery(document).ready(function($) {
  $(".menu-marker").click(() => {
    $("body").toggleClass("header-expanded");
  });

  $("#back-to-top").click(() => {
    $("html, body").animate({ scrollTop: 0 }, 'slow');
  });

  var last_scroll = $(window).scrollTop();
  const on_scroll = () => {
    var body   = $("body");
    var scroll = $(window).scrollTop();

    (scroll > 100) ? 
      body.addClass('docked') : 
      body.removeClass('docked');

    (scroll > last_scroll) ?
      body.addClass('scrolling-down') :
      body.removeClass('scrolling-down');

    last_scroll = scroll;
  };

  $(window).scroll(on_scroll);
  $(window).on({ touchmove: on_scroll });
});

