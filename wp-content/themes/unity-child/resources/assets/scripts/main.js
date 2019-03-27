// Import parent JS
import '../../../../unity-core/dist/scripts/main.js';

/** Import local dependencies */
import Router from './util/Router';
import archiveFfCompanyData from './routes/directory';
// import home from './routes/home';
// import aboutUs from './routes/about';
// import archive from './routes/archive';

/** Populate Router instance with DOM routes */
const routes = new Router({
  archiveFfCompanyData,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
