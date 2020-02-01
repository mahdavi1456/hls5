$(document).ready(function(){

    $('.load-person-extra-form-btn').click(function(){
       var p_id = $(this).data('p_id');
	   var home_url = $('#home-url').val();
       $('#load-person-extra-form' + p_id).html("<i class='fa fa-spinner fa-spin'></i>");
       $.post(home_url + "gt-include/script/person.php", {load_person_extra_form:1, p_id:p_id}, function(data){
           $('#load-person-extra-form' + p_id).html(data);
       });
    });
	
	$('.load-person-edit-form-btn').click(function(){
       var p_id = $(this).data('p_id');
	   var home_url = $('#home-url').val();
	   $('#load-person-edit-form' + p_id).html("<i class='fa fa-spinner fa-spin'></i>");
       $.post(home_url + "gt-include/script/person.php", {load_person_edit_form:1, p_id:p_id}, function(data){
           $('#load-person-edit-form' + p_id).html(data);
       });
    });

    $('.load-set-card').click(function(){
        var p_id = $(this).data('p_id');
        $('#cardModal' + p_id).find('.card-input').setCursorPosition(1);
    });
	
	$('#p_family').keyup(function(){
		var s = $(this).val();
		if(s != "" && s.length >= 3) {
		$('.family-search-result').show();
		var home_url = $('#home-url').val();
		$('.family-search-result').html("<p>در حال جستجو...</p>");
			$.post(home_url + "gt-include/script/person.php", {search_person:1, p_family:s}, function(data){
				if(data != "") {
					$('.family-search-result').show();
					$('.family-search-result').html(data);
				} else {
					$('.family-search-result').hide();
				}
			});
		} else {
			$('.family-search-result').hide();
		}		
	});
	
	$('#login-p-name-container #p_family').keyup(function(event){
        if (event.keyCode === 13) {
            $("#set-desktop-login").click();
        }
	});
	
	/*
	$('#p_family').blur(function(){
		$('.family-search-result').hide();
	});*/
	
	$(document.body).on('click', '.person-item' ,function(){
		var p_id = $(this).data('p_id');
		var p_fullname = $(this).data('p_fullname');
		$('#p_family').val(p_fullname);
		$('#p_id').val(p_id);
		$('.family-search-result').hide();
	});
	
	$(document.body).on('click', '.hide-person-item' ,function(){
		$('.family-search-result').hide();
	});
	
	$('.pk_id').change(function(){
        var pk_id = $(this).find('option:selected').val();
        var id = $(this).data('id');
		var home_url = $('#home-url').val();
		$.post(home_url + "gt-include/script/person.php", {get_package_info:1, pk_id:pk_id}, function(data){
			var list = data.split(',');
            $('#bp_time' + id).val(list[0]);
            $('#bp_expire' + id).val(list[1]);
			$('#bp_price' + id).val(-list[2]);
        });
    });

});