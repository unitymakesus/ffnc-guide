import List from 'list.js';
import Materialize from 'materialize-css';

export default {
  init() {
    // Initialize Materialize JS for forms
    Materialize.updateTextFields();
    $('select.filter').formSelect();

    // Expandable sections
    $('.expandable').on('click', '.closed', function() {
      $(this).removeClass('closed');
    });
  },
  finalize() {
    // Initialize List.JS
    var options = {
      valueNames: [ 'name', 'city', 'region', 'industry', 'employees' ],
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
  },
};
