"use strict";

$(function () {

    $(".select2").select2({minimumResultsForSearch:6});

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
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

    $(document).on('click', '[data-toggle="ajax"]', function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
        $.get(href, function( data ) {
          $("#posModal").html(data);
          $("#posModal").modal({backdrop:'static'});
          return false;
      });
    });

    $(":file").filestyle();

    $('.validation').formValidation({ framework: 'bootstrap', excluded: ':disabled' });

    $('.clock').click( function(e){
        e.preventDefault();
        return false;
    });
    function Now() { return new Date().getTime(); }
    var stamp = Math.floor(Now() / 1000);
    var time = date(dateformat+' '+timeformat, stamp);
    $('.clock').text(time);

    window.setInterval(function(){
        var stamp = Math.floor(Now() / 1000);
        var time = date(dateformat+' '+timeformat, stamp);
        $('.clock').text(time);
    }, 10000);

});
