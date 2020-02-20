$(document).ready(function () {

    $(document.body).on('click', '#pay', function () {
        $('#pay-result').html("<i class='fa fa-spinner fa-spin'></i>");
        var p_id = $('#pay_p_id').val();
        var pa_price = $('#pa_price').val();
        var pa_details = $('#pa_details').val();
		var pa_type = $('#pa_type').find('option:selected').val();
		var error_code = $('#error_code').val();
        var rrn = $('#rrn').val();
        $.post("gt-include/script/payment.php", {
            add_payment: 1,
            p_id: p_id,
            pa_price: pa_price,
			pa_details: pa_details,
            pa_type: pa_type,
            error_code: error_code,
            rrn: rrn
        }, function () {
            $('#pay-result').html("<div class='alert alert-success'>پرداخت با موفقیت ثبت شد</div>");
			$('#pay').hide();
		});
    });

    $(document.body).on('click', '#start-pay', function () {
        $('#status-result').val("دستگاه در انتظار فرمان...");
        $.post("gt-include/script/payment.php", {
            pos_payment: 1
        }, function (data) {
            if(data!="") {
                alert(data);
                var data_list = data.split('=');
                if(data_list[0] == 0) {
                    $('#status-result').val("پرداخت با موفقیت انجام شد. رسید: " + data_list[1]);
                    $('#error_code').val(data_list[0]);
                    $('#rrn').val(data_list[1]);
                } else {
                    $('#status-result').val("خطای انصراف از پرداخت رخ داده است");
                    $('#error_code').val(data_list[0]);
                    $('#rrn').val(data_list[1]);
                }
            }
        });
    });

    

});