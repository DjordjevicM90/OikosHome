
$(document).ready(function(){

    /* Scroll button to top */
	$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#btn-to-top').fadeIn();
			} else {
				$('#btn-to-top').fadeOut();
			}
		});
	// Scroll body to 0px on click
	$('#btn-to-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});

	//search field

	$("#search-input").keyup(function(){
		var value= $(this).val();
		if(value!="")
		{
			$.post("php/search.php", {value:value}, function(response){
				
				$("#search-list").fadeIn();
				$("#search-list").css("color", "white").html(response);	
				
			});
		}
		else
		$("#search-list").fadeOut();
		$("#search-list").html("");
		
	});
});