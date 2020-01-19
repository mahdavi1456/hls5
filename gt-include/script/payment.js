$(document).ready(function () {

    $(document.body).on('click', '#pay', function () {
        $('#pay-result').html("<i class='fa fa-spinner fa-spin'></i>");
        var p_id = $('#pay_p_id').val();
        var pa_price = $('#pa_price').val();
        var pa_details = $('#pa_details').val();
		var pa_type = $('#pa_type').find('option:selected').val();
		$.post("gt-include/script/payment.php", {
            add_payment: 1,
            p_id: p_id,
            pa_price: pa_price,
			pa_details: pa_details,
            pa_type: pa_type
        }, function () {
            $('#pay-result').html("<div class='alert alert-success'>پرداخت با موفقیت ثبت شد</div>");
			$('#pay').hide();
		});
    });

});