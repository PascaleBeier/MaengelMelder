$('#submit').click(function () {
    const form = $('form');
    form.validate();
    if (form.valid()) {
        $(this).button('loading');
    }
});

