 jQuery(document).ready(function($) {
   $(".menu-marker").click(() => {
     $("header#wrapper").toggleClass("expanded");
   });

   $("#back-to-top").click(() => {
     $("html, body").animate({ scrollTop: 0 }, 'slow');
   });
});

