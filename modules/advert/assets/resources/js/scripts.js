$(document ).ready(function() {
    $('#brand-id').click(function() {
        $('#advert-model_id').find('option').remove();
        $.ajax({
            type: "POST",
            url: '/advert/advert/models',
            data: 'key='+$("#brand-id").val(),
            success: function(data) {
                $.each(data, function(i, value) {
                    $('#advert-model_id').append($('<option>').text(value.name).attr('value', value.id));
                });
            },
        });
    });

});

