function printContent(el){
	var restorepage = $('body').html();
	var printcontent = $('#' + el).clone();
	$('body').empty().html(printcontent);
	window.print();
	$('body').html(restorepage);
}
	
$(document).ready(function() {
		
	$(document.body).on('change', '#offer', function(){
		var o_id = $(this).val();
		var price = $(this).data('pay');
		var offer = 0;
		var shop = $(this).data('shop');
		
		$.post("", { calc_offer:1, o_id:o_id, price:price}, function(data){
			offer = data;
			
			var new_price = price - offer;
			
			$('#pay_price').val(parseInt(new_price) + parseInt(shop));
			$('#offer_price').val(offer);
		});
	});
    
    $("#login-p-code").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#set-desktop-login").click();
        }
    });

    $('#set-desktop-login').click(function(){
        $('#set-desktop-login-result').html("<div class='alert alert-warning'>در حال پردازش...</div>");
        var p_id = $('#login-p-code').val();
		var adj = $('#adjective').val();
		var g_type = $('#g_type').find('option:selected').val();
        if(p_id == 0){
            var person_id = $('#login-p-name').find('option:selected').val();
        }
        var g_count = $('#g_count').find('option:selected').html();
        $.post("", {set_login:1, p_id:p_id, person_id:person_id, g_type:g_type, g_count:g_count, adj:adj}, function(data){
			if(data=="ok")
                window.location.reload();
            else
                $('#set-desktop-login-result').html(data);
        });
    });

    $('#show-login-p-code').click(function(){
        $("#login-p-name-container").find('.select2').css("display", "none");
        $("#login-p-code").css("display", "block");
    });

    $('#show-login-p-name').click(function(){
        $("#login-p-name-container").find('.select2').css("display", "block");
        $("#login-p-code").css("display", "none");
        $("#login-p-code").val(0);
    });

    $('.set-pro-to-cart').click(function(){
        var p_id = $(this).data('pid');
        var pr_id = $(this).val();
        $('#set-factor-result' + p_id).html("در حال پردازش...");
        $.post("", {set_pro_to_cart:1, p_id:p_id, pr_id:pr_id}, function(data){
            $('#set-factor-result' + p_id).html(data);
        });
	});
	
	$('.set-pro-to-cart-regular').click(function(){
        var p_id = $('#frmShopRegluarPerson').find('option:selected').val();
        var pr_id = $(this).val();
        $('#set-factor-result').html("در حال پردازش...");
        $.post("", {set_pro_to_cart_regular:1, p_id:p_id, pr_id:pr_id}, function(data){
            $('#set-factor-result-regular').html(data);
		});
		$.post("", {set_price_regular_shop:1, p_id:p_id}, function(data){
            $('#reular_pay_price').val(data);
        });
	});

	$(document.body).on('change', '#frmShopRegluarPerson' ,function(){
        var p_id = $(this).find('option:selected').val();
        $('#set-factor-result-regular').html("در حال پردازش...");
        $.post("", {load_regular_shop:1, p_id:p_id}, function(data){
            $('#set-factor-result-regular').html(data);
		});
		$.post("", {set_price_regular_shop:1, p_id:p_id}, function(data){
            $('#reular_pay_price').val(data);
        });
	});

    $(document.body).on('click', '.remove-from-factor' ,function(){
        var fid = $(this).data('fid');
        var pid = $(this).data('pid');
        $('#set-factor-result' + pid).html("در حال پردازش...");
        $.post("", {remove_from_factor:1, fid:fid, pid:pid}, function(data){
            $('#set-factor-result' + pid).html(data);
        });
	});
	
	$(document.body).on('click', '.remove-from-factor-regular' ,function(){
        var fid = $(this).data('fid');
        var pid = $(this).data('pid');
        $('#set-factor-result-regular').html("در حال پردازش...");
        $.post("", {remove_from_factor_regular:1, fid:fid, pid:pid}, function(data){
            $('#set-factor-result-regular').html(data);
		});
		$.post("", {set_price_regular_shop:1, p_id:pid}, function(data){
            $('#reular_pay_price').val(data);
        });
    });

    $('.load-factor').click(function(){
        $('#factor-result').html("در حال پردازش...");
        var gid = $(this).data('gid');
        var pid = $(this).data('pid');
        $.post("", {load_factor:1, pid:pid, gid:gid}, function(data){
			$('#factor-result').html(data);
        });
    });

    $(document.body).on('click', '#pay' ,function(){
		$('.light').fadeIn();
        $('#pay-result').html("در حال پردازش...");
        var pay_p_id = $('#pay_p_id').val();
        var pay_price = $('#pay_price').val();
		var offer = $('#offer_price').val();
        var pay_type = $('#pay_type').find('option:selected').html();
        $.post("", {add_pay:1, pay_p_id:pay_p_id, pay_price:pay_price, pay_type:pay_type, offer:offer}, function(data){
            $('#pay-result').html(data);
			$('.light').fadeOut();
        });
	});
	
	$(document.body).on('click', '#regular_pay' ,function(){
		$('.light').fadeIn();
        $('#pay-result').html("در حال پردازش...");
		var pay_p_id = $('#frmShopRegluarPerson').find('option:selected').val();
        var pay_price = $('#reular_pay_price').val();
        var pay_type = $('#reular_pay_type').find('option:selected').html();
        $.post("", {add_regular_pay:1, pay_p_id:pay_p_id, pay_price:pay_price, pay_type:pay_type}, function(data){
            $('#regular_pay_result').html(data);
			$('.light').fadeOut();
        });
    });

    $(document.body).on('click', '#set-out' ,function(){
        var g_id = $(this).data('g_id');
		var offer = $('#offer_price').val();
		var g_price = $(this).data('g_price') - offer;
		var checkout_type = $(this).data('checkout_type');
		var sharj = $(this).data('sharj');
		var used_time = $(this).data('used_time');
        var ez = $(this).data('ez');
		$.post("", {set_out:1, g_id:g_id, g_price:g_price, checkout_type:checkout_type, sharj:sharj, used_time:used_time, ez:ez}, function(data){
			window.location.reload();
        });
	});
	
	$(document.body).on('click', '#set_regular_shop_status' ,function(){
        var p_id = $('#frmShopRegluarPerson').find('option:selected').val();
        $('#set-factor-result-regular').html("در حال پردازش...");
        $.post("", {set_regular_shop_status:1, p_id:p_id}, function(data){
            $('#set-factor-result-regular').html(data);
		});
		$.post("", {set_price_regular_shop:1, p_id:p_id}, function(data){
            $('#reular_pay_price').val(data);
        });
    });

    $('.index-load-factor-btn').click(function(){
        var p_id = $(this).data('pid');
        $('#set-factor-result' + p_id).html("در حال پردازش...");
        $.post("", {load_light_factor:1, p_id:p_id}, function(data){
            $('#set-factor-result' + p_id).html(data);
        });
    });

	$("#sms_text").on("keyup", function() {		
		var value = $(this).val();
		var c = value.length;
		if(c==0){
			$('#sms_page').html("0");
			$('#sms_size').html("70");
		}else{
			if(c>0 && c<=70){
				$('#sms_page').html("1");
				$('#sms_size').html(70-c);	
			}
			if(c>=71 && c<=132){
				$('#sms_page').html("2");
				$('#sms_size').html(132-c);	
			}
			if(c>=133 && c<=198){
				$('#sms_page').html("3");
				$('#sms_size').html(198-c);
			}
			if(c>=199 && c<=264){
				$('#sms_page').html("4");
				$('#sms_size').html(264-c);
			}
			if(c>=265 && c<=330){
				$('#sms_page').html("5");
				$('#sms_size').html(330-c);
			}
			if(c>=331 && c<=396){
				$('#sms_page').html("6");
				$('#sms_size').html(396-c);
			}
			if(c>=397 && c<=462){
				$('#sms_page').html("7");
				$('#sms_size').html(462-c);
			}
			if(c>=463 && c<=528){
				$('#sms_page').html("8");
				$('#sms_size').html(528-c);
			}
			if(c>=529 && c<=594){
				$('#sms_page').html("9");
				$('#sms_size').html(594-c);
			}
			if(c>=595 && c<=660){
				$('#sms_page').html("10");
				$('#sms_size').html(660-c);
			}
			if(c>=661){
				$('#sms_page').html("11");
				$('#sms_size').html(661-c);
			}
		}
	});
	
	$('#send-type').change(function(){
        var send_type = $(this).find('option:selected').val();
		if(send_type=="-"){
			$('.p-alt').hide();
		}
		if(send_type==0){
			$('.p-alt').hide();
			$('#p-1').show();
		}
		if(send_type==1){
			$('.p-alt').hide();
			$('#p-2').show();
		}
		if(send_type==2){
			$('.p-alt').hide();
			$('#p-3').show();
		}
	});

	$(document.body).on('change', '#gm_g_count' ,function(){
		var g_id = $(this).data('g_id');
		var new_count = $(this).find("option:selected").text();
        $.post("", {game_change_count:1, new_count:new_count, g_id:g_id}, function(data){
			window.location.reload();
        });
    });
		
	$(document.body).on('change', '#gm_vip_count' ,function(){
		var gid = $(this).data('g_id');
		var new_count = $(this).find("option:selected").text();
        $.post("", {set_vip:1, new_count:new_count, gid:gid}, function(){
			window.location.reload();
        });
    });

});