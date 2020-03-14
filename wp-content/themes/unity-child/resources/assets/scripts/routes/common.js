import Macy from 'macy';
import initMainMenu from '../util/initMainMenu';

export default {
  init() {
    /**
     * Initialize main menu behavior.
     */
    initMainMenu();

    /**
     * Initialize Macy layouts.
     */
    if (document.querySelector('.grid') !== null) {
      let macyGrid = Macy({   // eslint-disable-line no-unused-vars
        container: '.grid',
        trueOrder: true,
        columns: 3,
        margin: {
          x: 20,
          y: 30,
        },
        breakAt: {
          767: 1,
        },
      });
    }

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
  finalize() {
    /**
     * Form label controls
     */
    $('.wpcf7-form-control-wrap').children('input[type="text"], input[type="email"], input[type="tel"], textarea').each(function() {
      // Remove br
      $(this).parent().prevAll('br').remove();

      // Set field wrapper to active
      $(this).on('focus', function() {
        $(this).parent().prev('label').addClass('active');
      });

      // Remove field wrapper active state
      $(this).on('blur', function() {
        var val = $.trim($(this).val());

        if (!val) {
          $(this).parent().prev('label').removeClass('active');
        }
      });
    });

    $('.wpcf7-form-control-wrap').find('.has-free-text').each(function() {
      var $input = $(this).find('input[type="radio"], input[type="checkbox"]');

      $input.on('focus', function() {
        $input.parent().addClass('active');
      });
    });
  },
};
