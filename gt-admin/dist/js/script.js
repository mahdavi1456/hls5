$(document).ready(function() {
    
	$(".datepicker_in").persianDatepicker();
    	
	$("#myFamily").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
		
    $('.select2').select2();

	$(".select3").select2({
		width: 'resolve'
	});

    $('#pk_id').change(function(){
        var pk_id = $(this).find('option:selected').val();
        $.post("", {get_package_info:1, pk_id:pk_id}, function(data){
            var list = data.split(',');
            $('#bp_time').val(list[0]);
            $('#bp_expire').val(list[1]);
			$('#bp_price').val(-list[2]);
        });
    });
	
	$('#part_calc').change(function(){
		var v = $(this).find('option:selected').val();
		if(v == 1){
			$('.part_calc_box').show();
		} else {
			$('.part_calc_box').hide();
		}
	});
	
    $('[data-name="disable-button"]').click(function() {
        $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable', true);
    });
	
    $('[data-name="enable-button"]').click(function () {
        $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable', false);
    });

    var el = document.querySelector('input.number');
		el.addEventListener('keyup', function (event) {
  		if (event.which >= 37 && event.which <= 40) return;
  			this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	});
	
});