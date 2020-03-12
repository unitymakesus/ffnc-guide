// Import parent JS
// import '../../../../unity-core/dist/scripts/main.js';

// Import everything from autoload
import './autoload/*';

/** Import local dependencies */
import Router from './util/Router';
import common from './routes/common';
import archiveFfCompanyData from './routes/directory';

/** Populate Router instance with DOM routes */
const routes = new Router({
  common,
  archiveFfCompanyData,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
