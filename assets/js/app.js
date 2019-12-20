/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single scss file (app.scss in this case)
require('../scss/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');

/*require('@fortawesome/fontawesome-free/scss/all.min.scss');*/
require('@fortawesome/fontawesome-free/js/all.js');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

require('./form_new_mission.js');
require('./stars_video.js');