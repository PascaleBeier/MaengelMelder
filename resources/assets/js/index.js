$('#submit').click(() => {
    const form = $('form');
    form.validate();
    if (form.valid()) {
        $(this).button('loading');
    }
});