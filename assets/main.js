$("#forgotPassword").click(function() {

		$("#loginActive").val("2");
		$("#loginModalTitle").html("Forgotten Password");
		$("#loginSignupButton").html("Submit");
		$("#toggleLogin").hide();
		$("#rememberMe").hide();
		$("#email").show();
		$("#password").hide();
		$("#username").hide();
		$("#forgotPassword").hide();
				
})

$('#ModalLoginForm').on('hidden.bs.modal', function () {
	
		$("#loginActive").val("1");
		$("#loginModalTitle").html("Login");
		$("#loginSignupButton").html("Login");
		$("#toggleLogin").show();
		$("#rememberMe").show();
		$("#email").hide();
		$("#password").show();
		$("#username").show();
		$("#forgotPassword").show();
	
})


function datest(e){
	var thiselement = $(e);
	var thisname = thiselement.attr('name');
	var thisval = thiselement.val();
		$.ajax({
			type: "POST",
			url: "http://localhost/spl/predictions/update_predictions",
			data: {newscore: thisval, matchscore: thisname, ajax: 1},
			success: function(result) {
				if (result != "1") {
					alert('An error ocurred');
				}
			}
		})
}