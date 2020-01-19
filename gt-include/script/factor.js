$(document).ready(function () {

    $('.index-load-factor-btn').click(function () {
        var p_id = $(this).data('pid');
        $('#set-factor-result' + p_id).html("در حال پردازش...");
        $.post("gt-include/script/factor.php", {load_shop_factor: 1, p_id: p_id}, function (data) {
            $('#set-factor-result' + p_id).html(data);
        });
    });

    $('.load-factor').click(function () {
        $('#factor-result').html("در حال پردازش...");
        var gid = $(this).data('gid');
        var pid = $(this).data('pid');
        $.post("", {load_factor: 1, pid: pid, gid: gid}, function (data) {
            $('#factor-result').html(data);
        });
    });

    $(document.body).on('click', '.remove-from-factor-regular', function () {
        var fid = $(this).data('fid');
        var pid = $(this).data('pid');
        $('#set-factor-result-regular').html("در حال پردازش...");
        $.post("", {remove_from_factor_regular: 1, fid: fid, pid: pid}, function (data) {
            $('#set-factor-result-regular').html(data);
        });
        $.post("", {set_price_regular_shop: 1, p_id: pid}, function (data) {
            $('#reular_pay_price').val(data);
        });
    });

    $(document.body).on('change', '#frmShopRegluarPerson', function () {
        var p_id = $(this).find('option:selected').val();
        $('#set-factor-result-regular').html("در حال پردازش...");
        $.post("", {load_regular_shop: 1, p_id: p_id}, function (data) {
            $('#set-factor-result-regular').html(data);
        });
        $.post("", {set_price_regular_shop: 1, p_id: p_id}, function (data) {
            $('#reular_pay_price').val(data);
        });
    });

    $(document.body).on('click', '#set_regular_shop_status', function () {
        var p_id = $('#frmShopRegluarPerson').find('option:selected').val();
        $('#set-factor-result-regular').html("در حال پردازش...");
        $.post("", {set_regular_shop_status: 1, p_id: p_id}, function (data) {
            $('#set-factor-result-regular').html(data);
        });
        $.post("", {set_price_regular_shop: 1, p_id: p_id}, function (data) {
            $('#reular_pay_price').val(data);
        });
    });

});