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

  let trySearch = (data, search) => {
    search = search.split(' ');

    // efficiency matters

    for (let i = 0; i < search.length; i++) {
      let valid = data.includes(search[i]);
      if (!valid) {
        return false;
      }
    }

    return true;
  }

  let startSearch = () => {
    $searchResults.addClass('hide');

    $searchResults.children().each(function() {
      let data = $(this).data('searchable')
      let search = $searchBar.val().toLowerCase()

      if (trySearch(data, search)) {
        $(this).addClass('show');
      } else {
        $(this).removeClass('show');
      }
    });
  }

  $searchBar.on('select change paste keyup', function() {
    if (searchBarEmpty()) {
      endSearch();
    } else {
      startSearch();
    }
  });  
});