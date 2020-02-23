function printContent(el) {
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
}

$(document).ready(function () {

    $('#set-desktop-login').click(function () {
        var p_code = $('#p_code').val();
		var p_id = $('#p_id').val();
        var g_adj = $('#g_adj').val();
        if (g_adj == "")
            g_adj = "";
        var g_type = $('#g_type').find('option:selected').val();
        var g_count = $('#g_count').find('option:selected').val();
		var g_in = $('#g_in').val();
        $.post("gt-include/script/game.php", {
            set_login: 1,
            p_code:p_code,
			p_id: p_id,
            g_type: g_type,
            g_count: g_count,
			g_in: g_in,
            g_adj: g_adj
        }, function (data) {
			if (data == "ok") {
                window.location.reload();
            } else {
                $('#set-desktop-login-result').html(data);
            }
        });
    });
	
	$('#set-desktop-login2').click(function () {
        var p_name = $('#p_name').val();
		var p_family = $('#p_family1').val();
		var p_mobile = $('#p_mobile').val();
		var p_birth = $('#p_birth').val();
		var p_type = $('#p_type').val();
		var p_gender = $('#p_gender').find('option:selected').val();
		var u_id = $('#u_id').val();
		var p_regdate = $('#p_regdate').val();
        var g_type = $('#g_type1').find('option:selected').val();
		var g_count = $('#g_count1').find('option:selected').val();
		var g_adj = $('#g_adj1').val();
		var g_in = $('#g_in').val();
		if (g_adj == "")
            g_adj = "";
		$.post("gt-include/script/game.php", {
            set_login2: 1,
			p_name :p_name,
			p_family :p_family,
			p_mobile :p_mobile,
			p_type :p_type,
			p_birth :p_birth,
			p_gender :p_gender,
			u_id :u_id,
			p_regdate :p_regdate,
			g_type :g_type ,
			g_count : g_count,
			g_in :g_in ,
			g_adj : g_adj
        }, function (data) {
			if (data == "ok") {
                window.location.reload();
            } else {
                $('#set-desktop-login-result2').html(data);
            }
        });
    });

    $('.load-game').click(function () {
        $('#login-overly').show();
        var p_id = $(this).data('p_id');
        var g_id = $(this).data('g_id');
        $.post("gt-include/script/game.php", {load_game: 1, p_id: p_id, g_id: g_id}, function (data) {
			$('html, body').animate({
				scrollTop: $('.main-header').offset().top
			}, 'slow');
			$('#load-game-result').html(data);
            $('#login-overly').hide();
        });
    });

    $("#p_code").keyup(function (event) {
        if (event.keyCode === 13) {
            $("#set-desktop-login").click();
        }
    });

    $(document.body).on('change', '.gm_g_count', function () {
        var g_id = $(this).data('g_id');
        var new_count = $(this).find("option:selected").val();
        $.post("gt-include/script/game.php", {
            game_change_count: 1,
            new_count: new_count,
            g_id: g_id
        }, function () {
            window.location.reload();
        });
    });

    $(document.body).on('change', '.gm_vip_count', function () {
        var g_id = $(this).data('g_id');
        var new_count = $(this).find("option:selected").val();
        $.post("gt-include/script/game.php", {
            set_vip: 1,
            new_count: new_count,
            g_id: g_id
        }, function () {
            window.location.reload();
        });
    });

    $(document.body).on('click', '#set-out', function () {
		var g_id = $(this).data('g_id');
		var total = $(this).data('total');
		var total_vip = $(this).data('total_vip');
		var extra = $(this).data('extra');
		var total_price = $(this).data('total_price');
		var total_vip_price = $(this).data('total_vip_price');
		var extra_price = $(this).data('extra_price');
		var used_sharj = $(this).data('used_sharj');
		var login_price = $(this).data('login_price');
		var total_shop = $(this).data('total_shop');
		var offer = $(this).data('offer');
		
        $.post("gt-include/script/game.php", {
            set_out: 1,
            g_id: g_id,
			total: total,
			total_vip: total_vip,
			extra: extra,
			total_price: total_price,
			total_vip_price: total_vip_price,
			extra_price: extra_price,
			used_sharj: used_sharj,
			login_price: login_price,
			total_shop: total_shop,
			offer: offer
        }, function (data) {
			window.location.reload();
        });
    });
		
	$(document.body).on('click', '#print' ,function(){
		printContent('printarea');
	});

});