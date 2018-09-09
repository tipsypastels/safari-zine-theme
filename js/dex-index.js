jQuery(document).ready(function($) {
  /* if we have (live) multiple searchable areas in future, make sure
     to put this in a more general location */

  let $searchArea = $('.searchable-area');
  let $searchBar = $('.searchable-area  .search-bar');
  let $searchResults = $('.searchable-area .search-results');

  $searchBar.select()

  let searchBarEmpty = () => {
    return !$searchBar.val()
  }

  let endSearch = () => {
    $searchResults.removeClass('hide');
  }

  let startSearch = () => {
    $searchResults.addClass('hide');

    $searchResults.children().each(function() {
      let search = $searchBar.val().toLowerCase();
      let data = $(this).data('searchable');

      if (data.includes(search)) {
        $(this).addClass('show');
      } else {
        $(this).removeClass('show');
      }
    });
  }

  $searchBar.keyup(function() {
    if (searchBarEmpty()) {
      endSearch();
    } else {
      startSearch();
    }
  });  
});