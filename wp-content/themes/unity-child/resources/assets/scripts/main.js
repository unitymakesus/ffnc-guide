import 'custom-event-polyfill';
// import 'materialize-css';

// Import everything from autoload
import './autoload/*';

/** Import local dependencies */
import Router from './util/Router';
import common from './routes/common';
import postTypeArchiveFfCompany from './routes/postTypeArchiveFfCompany';

/** Populate Router instance with DOM routes */
const routes = new Router({
  common,
  postTypeArchiveFfCompany,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
