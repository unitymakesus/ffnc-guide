import List from 'list.js';
import Materialize from 'materialize-css';

export default {
  init() {
    // Initialize Materialize JS for forms
    Materialize.updateTextFields();
    $('select.filter').formSelect();
  },
  finalize() {
    // Initialize List.JS
    var options = {
      valueNames: [ 'name', 'city', 'region', 'industry', 'employees', 'policies' ],
    };

    var directoryList = new List('directory-list', options);  // eslint-disable-line no-unused-vars

    function resetList() {
      directoryList.search();
      directoryList.filter();
      directoryList.update();
      $('#search_keyword').val('');
      $('#filter_region>option:eq(0)').prop('selected', true);
      $('#filter_industry>option:eq(0)').prop('selected', true);
      $('#filter_employees>option:eq(0)').prop('selected', true);
    }

    function updateList() {
      var value_region = $('#filter_region').val();
      var value_industry = $('#filter_industry').val();
      var value_employees = $('#filter_employees').val();

      directoryList.filter(function(item) {
        var regionFilter = false;
        var industryFilter = false;
        var employeesFilter = false;

        if (value_region == null || value_region == 'all') {
          regionFilter = true;
        } else {
          regionFilter = item.values().region.indexOf(value_region) >= 0;
        }

        if (value_industry == null || value_industry == 'all') {
          industryFilter = true;
        } else {
          industryFilter = item.values().industry.indexOf(value_industry) >= 0;
        }

        if (value_employees == null || value_employees == 'all') {
          employeesFilter = true;
        } else {
          employeesFilter = item.values().employees.indexOf(value_employees) >= 0;
        }

        return regionFilter && industryFilter && employeesFilter;
      });

      directoryList.update();
    }

    $('select.filter').on('change', updateList);
    $('#reset_filter').on('click', resetList);


    /**
     * Collapse elements.
     */
    let collapseElems = document.querySelectorAll('.collapse');
    if (collapseElems.length) {
      collapseElems.forEach(collapse => {
        let btn = collapse.querySelector('.collapse__toggle');
        let target = collapse.querySelector('.collapse__panel');

        btn.addEventListener('click', function() {
          let expanded = btn.getAttribute('aria-expanded') === 'true';
          btn.setAttribute('aria-expanded', !expanded);
          target.hidden = expanded;
        });
      });
    }
  },
};
