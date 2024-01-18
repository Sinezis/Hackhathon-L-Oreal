/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap');

addEntry('js/app', './assets/js/app.js');
addStyleEntry('css/app', './assets/css/app.scss');

const a2lix_lib = require('@a2lix/symfony-collection/dist/a2lix_sf_collection.min');
a2lix_lib.sfCollection.init();


