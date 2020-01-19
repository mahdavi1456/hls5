$(document).ready(function () {

    $('#set-activity').click(function () {
        $('#set-activity-result').html("<i class='fa fa-spinner fa-spin'></i>");
		var u_code = $('#u_code').val();
		$.post("gt-include/script/user.php", {
            set_activity: 1,
            u_code: u_code
        }, function (data) {
            if (data == "ok") {
                $('#set-activity-result').html("<br><div class='alert alert-success'>عملیات با موفقیت انجام شد</div>");
				window.location.reload();
            } else {
                $('#set-activity-result').html(data);
            }
        });
    });
	
	$('#u_code').keypress(function(e){
		if(e.keyCode==13)
			$('#set-activity').click();
    });

});