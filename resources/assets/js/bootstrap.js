/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');

window.swal = require('bootstrap-sweetalert');

require('jquery-validation');
require('jquery-validation/dist/localization/messages_de');

$('#submit').click(function () {
    const form = $('form');
    form.validate();
    if (form.valid()) {
        $(this).button('loading');
    }
});