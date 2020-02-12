// Import parent JS
import '../../../../unity-core/dist/scripts/main.js';

/** Import local dependencies */
import Router from './util/Router';
import common from './routes/common';
import archive from './routes/archive';
import archiveFfCompanyData from './routes/directory';

/** Populate Router instance with DOM routes */
const routes = new Router({
  common,
  archive,
  archiveFfCompanyData,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
