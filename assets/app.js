/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/nucleo-icons.css';
import './styles/nucleo-svg.css';
import './styles/argon-dashboard.css';

// JS
import './javascript/argon-dashboard.js';
import './javascript/plugins/perfect-scrollbar.js';
import './javascript/plugins/Chart.extension.js';
import './javascript/plugins/bootstrap-notify.js';
import './javascript/plugins/chartjs.min.js';
import './javascript/plugins/smooth-scrollbar.min.js';
import './javascript/core/popper.min.js';
import './javascript/core/bootstrap.min.js';
import './javascript/core/bootstrap.bundle.min.js';

// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
require('bootstrap');