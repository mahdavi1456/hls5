$(document).ready(function(){
	$('#buy_ticket_c_id').change(function(){
		$('#ct_price').val("صبر کنید...");
		var c_id = $(this).find('option:selected').val();
		$.post("gt-include/script/course.php", {
            get_course_price: 1,
            c_id: c_id
        }, function (data) {
            if (data != "error") {
				$('#ct_price').val(data);
            }
        });
	});
});