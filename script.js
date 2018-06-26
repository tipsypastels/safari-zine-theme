jQuery(document).ready(function($) {
  $(".menu-marker").click(() => {
    $("header#wrapper").toggleClass("expanded");
  })
});
