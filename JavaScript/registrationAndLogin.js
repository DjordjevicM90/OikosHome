$(function()
{
    //registration of new user
	$("#btn-registration").click(function(){
		let name = $("#first-name-registration").val();
		let lastName = $("#last-name-registration").val();
		let email = $("#email-registration").val();
		let password = $("#password-registration").val();
		let repeatPassword = $("#repeat-password-registration").val();

		$.post("registration.php?registration",{name:name, lastName:lastName, email:email, password:password, repeatPassword:repeatPassword}, function(response){
			$("#answer-registration").html(response);
			$("input").val("");
		});
	});

	//login 
	$("#btn-login").click(function(){
		let email = $("#email-login").val();
		let password = $("#password-login").val();
		let remember=$("#remember").is(":checked");
        if(remember==true) remember="1";
        else remember="0";

		$.post("login.php?login",{email:email, password:password, remember:remember}, function(response){
			answer=JSON.parse(response);

			if(answer.error!="")
			{
				$("#answer-login").html(answer.error);
			}
			else
			{
				window.location.assign(answer.data);
			}
		});
	});
});