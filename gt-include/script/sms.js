$(document).ready(function(){
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
		if(send_type == "boys"){
            $('.p-alt').hide();
            $('#p-boys').show();
        }
		if(send_type == "girls"){
            $('.p-alt').hide();
            $('#p-girls').show();
        }
    });


});