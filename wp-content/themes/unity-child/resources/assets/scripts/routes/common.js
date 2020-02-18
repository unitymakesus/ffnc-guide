export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    // Activate search box
    function activateSearch() {
      $('.navbar .search-form').addClass('active');
      $('.navbar .search-form .search-submit').removeClass('disabled');
    }

    // Deactivate search box
    function deactivateSearch() {
      $('.navbar .search-form').removeClass('active');
      $('.navbar .search-form .search-submit').addClass('disabled');
    }

    // Only show search if element inside is receiving focus
    $('.navbar .search-form').on('click', 'input', function(e) {
      e.preventDefault();

      // Only allow default action (submit) if the search field has content
      // If not, switch focus to search field instead
      if ($(this).hasClass('search-submit')) {
        if ($('.navbar .search-field').val().length > 0) {
          $('.navbar .search-form').submit();
        } else {
          $('.navbar .search-form .search-field').focus();
        }
      }

      return false;
    }).on('focus', 'input', function() {
      activateSearch();
    }).on('focusout', function() {
      setTimeout(function () {
        if ($(':focus').closest('.navbar').length == 0) {
          deactivateSearch();
        }
      }, 200);
    });


    /**
     * Initalize our custom dropdowns.
     */
    let dropdownToggles = document.querySelectorAll('.dropdown__toggle');
    if (dropdownToggles.length) {
      dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
          let expanded = this.getAttribute('aria-expanded');
          this.setAttribute('aria-expanded', expanded === 'false' ? 'true' : 'false');

          e.preventDefault();
          return false;
        });
      });
    }
  },
};
