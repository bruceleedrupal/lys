/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
//require('../scss/app.scss');


window.Popper = require('popper.js').default;  

const $ = require('jquery');
global.$ = global.jQuery = $;
require('bootstrap/js/src/dropdown.js');
require('admin-lte/build/js/AdminLTE.js');



// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');
/*
jQuery.fn.clickToggle = function(a, b) {
  return this.on("click", function(ev) { [b, a][this.$_io ^= 1].call(this, ev) })
};
*/

$(document).ready(function(){ 
  $('#cart-summary').click(function(e){
    e.stopPropagation();
  });
});

