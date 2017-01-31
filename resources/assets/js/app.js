
/**
 * First we will load all of this project's JavaScript
 * dependencies which include jQuery and Bootstrap.
 */

require('./bootstrap');

/**
 * Here comes Application-specific JavaScript.
 */

// Form validation with jquery-validation
$('#submit').click(function() {
    const form = $('form');
    form.validate();
    if (form.valid()) {
        $(this).button('loading');
    }
});