jQuery(document).ready(function($){
  const toggleSidebar = () => {
    $('aside#sidebar').toggleClass('active');
    $('body').toggleClass('sidebar-open');
  }

  $('.menu-opener').click(toggleSidebar);
  $('.container').click(e => {
    if ($('body').hasClass('sidebar-open')) toggleSidebar();
  })
});
