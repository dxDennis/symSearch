/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '@fortawesome/fontawesome-free/js/all.js'

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

import '../vendor/MDB-Pro_4.15.0/js/popper.min';
import '../vendor/MDB-Pro_4.15.0/js/bootstrap.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/accordion-extended.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/animations-extended.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/buttons.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/cards.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/character-counter.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/chips.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/collapsible.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/dropdown/dropdown.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/dropdown/dropdown-searchable.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/file-input.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/forms-free.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/lightbox.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/mdb-autocomplete.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/megamenu.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/parallax.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/preloading.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/range-input.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/scrolling-navbar.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/sidenav.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/smooth-scroll.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/sticky.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/treeview.min';
import '../vendor/MDB-Pro_4.15.0/js/modules/wow.min';

$(function(){
    console.log('jQuery Ready');
    $('[data-toggle="tooltip"]').tooltip()
});
