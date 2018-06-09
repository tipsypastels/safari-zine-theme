jQuery(document).ready(function($) {
  const toggleModal = () => {
    $('aside#modal').slideToggle(200);
    $('body').toggleClass('modal-open');
  }

  $('.menu-opener').click(toggleModal);

  // i have no idea why this works but it just does
  // don't touch it
  $('body.modal-open main').live("click", function(e) {
    e.preventDefault();
    toggleModal();
  });
});
