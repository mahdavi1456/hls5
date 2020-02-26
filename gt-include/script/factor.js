$(document).ready(function () {
	
	
	$(document.body).on('change', '.change-count2' ,function(){
		var pr_id = $('#pr_id3').find('option:selected').val();
		var f_count = $('#f_count3').val();
		var home_url = $('#home-url').val();
		 $.post(home_url + "gt-include/script/factor.php", {load_price: 1, pr_id: pr_id, f_count: f_count}, function (data) {
            $('#pr_price3').val(data);
        });
    });
	
	$(document.body).on('change', '.change-count' ,function(){
        var f_id = $(this).data('fid');
		var p_id = $(this).data('pid');
		var pr_id = $(this).data('prid');
		var f_count = $('#f_count' + f_id).find('option:selected').val();
        $.post("gt-include/script/factor.php", {
            load_count: 1,
            f_id:f_id,
			pr_id:pr_id,
			f_count: f_count
        }, function (data) {
			if (data == "ok") {
                window.location.reload();
            }
        });
    });
	
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