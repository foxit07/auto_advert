$(document ).ready(function() {
    $('#advert-brand').click(function() {
        $('#advert-model_id').find('option').remove();
        $.ajax({
            type: "POST",
            url: '/advert/advert/models',
            data: 'key='+$("#advert-brand").val(),
            success: function(data) {
                $.each(data, function(i, value) {
                    $('#advert-model_id').append($('<option>').text(value.name).attr('value', value.id));
                });
            },
        });
    });

});

