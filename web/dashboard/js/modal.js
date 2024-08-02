$(function(){
    $('#createButton').click(function(){
        $('#modal').modal('create')
        .find('#modalContent')
        .load($(this).attr('value'))
    });
});