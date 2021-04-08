$(document).ready(function () {
    $('[id^="set-banknote-"]').on('click', function (e) {
        e.preventDefault();
        $('.errors').empty();
        $.ajax({
            url: '/api/money-receiver/banknote/insert/' + this.dataset.id,
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).done(function (res) {
            $('#filled').html(res.filled)
        }).fail(function (jqXHR, textStatus) {
            $('.errors').html(textStatus);
        });
    });
    $('[id^="set-coin-"]').on('click', function (e) {
        e.preventDefault();
        $('.errors').empty();
        $.ajax({
            url: '/api/money-receiver/coin/insert/' + this.dataset.id,
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).done(function (res) {
            $('#filled').html(res.filled)
        }).fail(function (jqXHR, textStatus) {
            $('.errors').html(textStatus);
        });
    })
    $('[id^="buy-product-"]').on('click', function (e) {
        e.preventDefault();
        $('.errors').empty();
        $('.dispenser').empty();
        var $this = $(this);
        $.ajax({
            url: '/api/vending-machine/buy/' + this.dataset.id,
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).done(function (res) {
            $('#filled').html(res.operation.filled);
            $('.dispenser').html('Товар "' + res.product.name + '" выдан');
            if (res.product.amount === 0) {
                $this.attr('disabled', true);
            }
        }).fail(function (jqXHR, textStatus) {
            console.log(jqXHR)
            $('.errors').html(jqXHR.responseJSON.message);
        });
    })
    $('#get-change').on('click', function (e) {
        e.preventDefault();
        $('.errors').empty();
        $('.dispenser').empty();
        $.ajax({
            url: '/api/vending-machine/get-change',
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).done(function (res) {
            $('#filled').html(res.filled);
            $('.dispenser').html('Сдача выдана');
        }).fail(function (jqXHR, textStatus) {
            console.log(jqXHR)
            $('.errors').html(jqXHR.responseJSON.message);
        });
    })
});
