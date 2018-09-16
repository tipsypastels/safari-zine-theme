 jQuery(document).ready(function($) {
  $(".menu-marker").click(() => {
    $("body").toggleClass("sidebar-open");
  });

  $("#aside-wrapper").click(e => {
    if ($(e.target).hasClass('onclick-close-sidebar')) {
      $("body").removeClass("sidebar-open");
    }
  })

  $("#back-to-top").click(() => {
    $("html, body").animate({ scrollTop: 0 }, 'slow');
  });

  const HEADER_FADES_AT = 100;
  const HEADER_DOCKS_AT = 50;

  var last_scroll = $(window).scrollTop();
  const on_scroll = () => {
    var body   = $("body");
    var scroll = $(window).scrollTop();

    (scroll > HEADER_DOCKS_AT) ? 
      body.addClass('docked') : 
      body.removeClass('docked');

    (scroll > last_scroll && scroll > HEADER_FADES_AT) ?
      body.addClass('scrolling-down') :
      body.removeClass('scrolling-down');

    last_scroll = scroll;
  };

  $(window).scroll(on_scroll);
});

