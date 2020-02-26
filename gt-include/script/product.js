$(document).ready(function () {

    $('.set-pro-to-cart-regular').click(function () {
        var p_id = $('#frmShopRegluarPerson').find('option:selected').val();
        var pr_id = $(this).val();
        $('#set-factor-result').html("<i class='fa fa-spinner fa-spin'></i>");
        $.post("", {set_pro_to_cart_regular: 1, p_id: p_id, pr_id: pr_id}, function (data) {
            $('#set-factor-result-regular').html(data);
        });
        $.post("", {set_price_regular_shop: 1, p_id: p_id}, function (data) {
            $('#reular_pay_price').val(data);
        });
    });

	$(document.body).on('click', '.set-pro-to-cart', function () {
        var p_id = $(this).data('pid');
        var pr_id = $(this).val();
        $('#set-factor-result' + p_id).html("<i class='fa fa-spinner fa-spin'></i>");
        $.post("gt-include/script/product.php", {set_pro_to_cart: 1, p_id: p_id, pr_id: pr_id}, function (data) {
            $('#set-factor-result' + p_id).html(data);
        });
    });
	
	$('.shop-search').keyup(function () {
        var p_id = $(this).data('pid');
		var search = $(this).val();
        $.post("gt-include/script/product.php", {set_search: 1, p_id: p_id, search: search}, function (data) {
            $('.shop-search-result').html(data);
        });
    });

    $(document.body).on('click', '.remove-from-factor', function () {
        var fid = $(this).data('fid');
        var pid = $(this).data('pid');
        $('#set-factor-result' + pid).html("<i class='fa fa-spinner fa-spin'></i>");
        $.post("gt-include/script/product.php", {remove_from_factor: 1, fid: fid, pid: pid}, function (data) {
            $('#set-factor-result' + pid).html(data);
        });
    });

});