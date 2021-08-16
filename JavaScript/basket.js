$(function(){

    //delete product from cart
    
    $(".btn-remove").click(function(){
        let id = $(this).data("product");
        $(".btn-remove"+id).toggleClass("select"); 

        $.post("php/productComplete.php?basket-delete", {id:id}, function(response){
            let answer = JSON.parse(response);

            if(answer.error!="")
            {
                return false;
            }
            $(".select").remove();
            showNumber();
        });
    });

    //on click button buy it, set bassket_accepted column in table basket on 1

    $(".btn-buy").click(function(){
        let id = $(this).data("product");
        $(".btn-remove"+id).toggleClass("select"); 

        $.post("php/productComplete.php?basket-buy", {id:id}, function(response){
            let answer = JSON.parse(response);

            if(answer.error!="")
            {
                return false;
            }
            $("#message-buy").html("");
			$("#message-buy").css("color","green").css("display","block").append("Thank you for buying from us, soon someone will contact you by e-mail.");
            $(".select").remove();
            showNumber();
        });
    });
});