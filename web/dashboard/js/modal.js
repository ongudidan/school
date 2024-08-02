$(function(){
    $('#createButton').click(function(){
        $('#create').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'))
    });

    $('#viewLink').click(function(){
        $('#view').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'))
    });
});