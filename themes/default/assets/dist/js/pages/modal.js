"use strict";

$(function () {

    $(".select2").select2({minimumResultsForSearch:6});

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });

    $('.redactor').redactor({
        formatting: ['p', 'blockquote', 'h3', 'h4', 'pre'],
        minHeight: 150,
        maxHeight: 500,
        linebreaks: true,
        tabAsSpaces: 4,
        dragImageUpload: false,
        dragFileUpload: false,
        //plugins: ['newbuttons']
    });

    $(":file").filestyle();

    $('.validation').formValidation({ framework: 'bootstrap', excluded: ':disabled' });

});
