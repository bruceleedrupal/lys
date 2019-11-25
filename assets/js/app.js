/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
//require('../scss/app.scss');


//import Popper from 'popper.js';
import $  from 'jquery';
import Dropdown from 'bootstrap/js/src/dropdown.js';
import Alert from 'bootstrap/js/src/alert.js';
import defaultExport from 'admin-lte/build/js/AdminLTE.js';

global.$ = global.jQuery = $;


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
  
  $('.setItemQuantityForm .setItemQuantitySelect').change(function(e){
    $(this).closest('form').submit();  
  });

  

  $('#select_belongs_to_form_belongsTo').change(function(e){
    $(this).closest('form').submit();
  });

});

