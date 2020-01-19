// Author: MRM-ESMAILI                     //
// Website: MRM-ESMAILI.IR                 //
//                                         //
// HOW TO USE                              //
//                                         //
// Require JQuery 3                        //
// Require Class before calling it         //
//                                         //
// myFormValidation = new mrmValidation(); //
// myFormValidation.notEmpty('#myForm');   //
//                                         //
// HOW TO USE                              //

const borderColorDefault = "#d2d6de";

class mrmValidation{
	notEmpty(formId){
		$("form"+formId).submit(function(formSubmit){
			var formHeight = $(this).position();
			if(window.mrmvValue==2019){ window.mrmvValue==2018 }else{
				formSubmit.preventDefault();
			}
			var errorFlag = 0;
			$("form"+formId+" input[type='text'],textarea").each(function(){
				var input_value = $(this).val();
				var input_required = $(this).data('required');
				if(input_required && input_value==""){
					$(this).next('span').html('فیلد اجباری!');
					$(this).css("border-color","red");
					//alert($(this).attr('name'));
					errorFlag = 1;
				}else{
					$(this).css("border-color",borderColorDefault);
					$(this).next('span').html('');
				}
			});
			/*
            $("form"+formId+" input[type='radio']").each(function(){
				var input_name = $(this).attr('name');
				var errorFlagRadio = 1;
				$("form"+formId+" input[name='${input_name}']").each(function(){
					var input_required = $(this).data('required');
					var is_checked = $("input[name='${input_name}']:checked").length;

					if(input_required && is_checked){
						$(this).next('span').html('فیلد اجباری!');
						$(this).css("border-color","red");
						//alert($(this).attr('name'));
						errorFlagRadio = 0;
					}else{
						$(this).css("border-color",borderColorDefault);
						$(this).next('span').html('');
					}
				});
			});
			*/
			if(!errorFlag){
				window.mrmvValue=2019;
				$(this).submit();
			}else{
				$('html, body').animate({
					scrollTop: formHeight.top
				}, 500);
			}
			errorFlag = 0;
		});
	}
}