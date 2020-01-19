$(document).ready(function () {

    $(document.body).on('change', '#offer', function () {
        var o_id = $(this).val();
        var price = $(this).data('pay');
        var offer = 0;
        var shop = $(this).data('shop');

        $.post("", {calc_offer: 1, o_id: o_id, price: price}, function (data) {
            offer = data;
            var new_price = price - offer;
            $('#pay_price').val(parseInt(new_price) + parseInt(shop));
            $('#offer_price').val(offer);
        });
    });

});