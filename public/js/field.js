$('input').keydown(keydown);

$oldDetail = $('#modal-kerabat').find('.field-kerabat').clone();

$('#btn-cancel').click(function(){
    $('#modal-kerabat').html($oldDetail);
    $oldDetail.find('input').keydown(keydown);
    enabled();
})

enabled();

function enabled() {
    if ($('.field-kerabat').length == 1) {
        $('.delete-field').hide();
    } else {
        $('.delete-field').show();
    }
}

function addField() {
    const newField = $('.field-kerabat:first').clone();

    newField.find('input').val('');
    newField.find('.error-message').hide();
    newField.find('input').keydown(keydown);

    $('#modal-kerabat').append(newField);

    $('.delete-field').show();
}

function deleteField(element) {
    $(element).parent('.field-kerabat').remove();
    enabled();
}

function keydown(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
    }
}

$('#add-field').click(addField);