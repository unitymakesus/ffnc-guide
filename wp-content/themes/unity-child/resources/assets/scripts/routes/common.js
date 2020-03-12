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
  },
};
