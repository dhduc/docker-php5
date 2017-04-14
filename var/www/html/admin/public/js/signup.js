$(document).ready(function(){

	$("#frmSignup").submit(function(){

		if($(this).data("formstatus") !== "submitting"){

			var form = $(this),
			formData = form.serialize(),
			formUrl = form.attr("action"),
			formMethod = form.attr("method"),
			responseMsg = $("#signupMsg");

			form.data("formstatus", "submitting");

			responseMsg.hide()
			.addClass("response-waiting")
			.text("Please Wait...")
			.fadeIn(200);

			

			$.ajax({
				url: formUrl,
				type: formMethod,
				data: formData,
				success: function(data){

					var responseData = jQuery.parseJSON(data), cssClass = "response-error";

					switch(responseData.status){
						case "error": cssClass = "response-error"; break;
						case "success": cssClass = "response-success"; break;
					}

					responseMsg.fadeOut(200, function(){
						$(this).removeClass("response-waiting").addClass(cssClass).text(responseData.message).fadeIn(200, function(){
							setTimeout(function(){
								responseMsg.fadeOut(200, function(){
									$(this).removeClass(cssClass);
									
									form.data('formstatus','submit');
									
									if(responseData.status == "success"){
										window.location = "login";
									}
								});
							}, 3000);
						});
					});

					

				}, error: function (){
					alert('Có lỗi xảy ra');
				}

			});

		}

		return false;
	});
});