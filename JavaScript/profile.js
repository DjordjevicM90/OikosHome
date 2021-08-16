$(function(){
    //on click button save in profile.php, change user profile
    $("#btn-save-change").click(function(){
        let name = $("#name-profile").val();
        let lastName = $("#lastname-profile").val();
        let password = $("#password-profile").val();
        let repeatPassword = $("#repeat-password-profile").val();

        $.post("php/profileComplete.php?profile-change", {name:name, lastName:lastName, password:password, repeatPassword:repeatPassword}, function(response){
            obj = JSON.parse(response);

            if(obj.data)
            {
                $("#message-profile-change").html("");
                $("#message-profile-change").append(obj.data);
                showUserProfile();
                return false;
            }
            $("#message-profile-change").html("");
            $("#message-profile-change").append(obj.error);
        });
    });

    //add product
    $("#btn-add-product").click(function(){ //add image 
        $.ajax({
            url: "php/profileComplete.php?add-products",
            type: "POST",
            data:  new FormData(document.getElementById('add-product')),
            contentType: false,
            processData: false,
            success: function(response){
                let obj=JSON.parse(response);
                
                if(obj.data) $("#message-add-product").html(obj.data);
                else $("#message-add-product").html(obj.error);
               
            }  
        });
    });

    // delete product
    $("#btn-delete-product").click(function(){ 
        if($(".select").length){
            $('.select').each(function(){
                let productId=($(this).attr('data-id'));

                if(!confirm("Are you sure you want to delete the product? ")) return false;
                $.post("php/profileComplete.php?product-delete",{productId:productId},function(response){
                    let obj=JSON.parse(response);
    
                    if(obj.data==""){
                        $("#message-delete-product").html(obj.error);
                        return false;
                    }
                    else
                    $("#message-delete-product").html("You have successfully deleted the product ");
                });
            });
            $(".select").remove();
        }
        else $("#message-delete-product").html("You have not selected a product to delete");
    });
});