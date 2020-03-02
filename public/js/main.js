let modal = $('#modalForAddCountry');

$('#buttonForShowModal').on('click', function(e) {
    e.preventDefault();
    modal.modal();
    $('input[name="country"]').val('');;
});

$('#buttonForSendCountryAsAjax').on('click', function(e) {
    e.preventDefault();

    let form = $('#formAddCountryForAjax');
    let btn = $('#buttonForSendCountryAsAjax');
    let country = form.find('input[name="country"]');

    if (country.val() === '') {
        country.next().text('Поле не должно быть пустым').show();
        return false;
    } else {
        country.next().text('').hide();
    }

    btn.addClass('disabled');

    $.ajax({
        url: 'countries/add',
        type: 'POST',
        data: {country: country.val()},
        success(data) {
            let table = $(data).find('.table');

            if (!table.length) {
                modal.modal('hide');
                location.reload();
                return false;
            }
    
            modal.modal('hide');
            btn.removeClass('disabled');
            $('.table').replaceWith(table);
        },
        error() {
            modal.modal('hide');
            btn.removeClass('disabled');
            alert('Ошибка добавления, попробуйте позже');
        }
    });
});
