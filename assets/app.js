/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// start the Stimulus application
import './styles/app.scss';

// Bootstrap

import './bootstrap';
require('bootstrap');

const a2lix_lib = require('@a2lix/symfony-collection/dist/a2lix_sf_collection.min');
a2lix_lib.sfCollection.init();

// Font Awesome
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

