//fetch 4 products of houses and show them in section _aricalFirst.php
function fetchRecomHouses(){
    $.ajax({
        url: "php/fetchRecomProducts.php",
        type: "post",
        success: function(response){
            $("#fetchRecomHouses").html(response);
        }
    });
}

//fetch 4 products of furniture and show them in section _aricalThird.php
function fetchRecomFurniture(){
    $.ajax({
        url: "php/fetchRecomProducts.php?furniture",
        type: "post",
        success: function(response){
            $("#fetchRecomFurniture").html(response);
            showCompleteProduct();
        }
    });
}

// show the number of products in the basket
function showNumber(){
    $.post("php/productComplete.php?showNumber",function(response){
        let obj = JSON.parse(response);
        let id = $("session-id").data("session");

        if(obj.data)
        {
            let x=0;
            for(el of obj.data){
                if(el.basket_accepted==0 && el.basket_user_id == id)
                {
                        
                }
                x++;
            }
            $("#quantity-cart").html(x);
        }
        else return false;  	
    });
}

// set user name and last name in inputs on page profile.php
function showUserProfile(){
    
    $.post("php/profileComplete.php?select-user", function(response){
        let obj = JSON.parse(response);
        if(obj.data)
        {
            for(el of obj.data){
                $("#name-profile").val(el.user_name);
                $("#lastname-profile").val(el.user_lastname);
                $("#session-id").html(el.user_name+" "+el.user_lastname);
                $("#password-profile").val("");
                $("#password-profile").val("");
            }

        }
        else return false;
    });
}

//on click select section, show all products of that category
function getval(sel)
{
    if(sel.value == 0) return false;
    let categoryType = sel.value;
    $("#product-delete").html("");

    $.post("php/profileComplete.php?select-delete-products", {categoryType:categoryType}, function(response){
        let obj = JSON.parse(response);

        for(el of obj.data){
            if(categoryType == "1" && el.product_category_id == "1")
            {
                $product = $("<div class='bg-primary m-1 text-light p-2 w-50 product-delete' data-id='"+el.product_id+"'>"+el.product_name+"</div>");

                $("#product-delete").append($product);
                
            }
            else if(categoryType == "2" && el.product_category_id == "2")
            {
                $product = $("<div class='bg-primary m-1 text-light p-2 w-50 product-delete' data-id='"+el.product_id+"'>"+el.product_name+"</div>");

                $("#product-delete").append($product);
            } 
        }

        // on click div with class name "product-delet" add border red
        $(".product-delete").click(function(){
            $(this).toggleClass("select");  
       });
    });
}

//on click button see more on page index.php or product.php, show complete product
function showCompleteProduct()
{

    $(".product-complete").click(function(){
        let id = $(this).data("product");

        $.post("php/productComplete.php?product-complete", {id:id}, function(response){
            
            let obj = JSON.parse(response);
            if(obj.data)
            {
                for(el of obj.data){
                    let productData = $("<div class='col-12 my-2'><div class='card bg-light text-dark border-warning border-2 my-5 '><div class='card-body text-center '><h3 class='card-title '>"+el.product_name+"</h3><p class='product-text'>"+el.product_text+"</p><h3 class='card-title'>"+el.product_price+" $</h3></div></div></div>");

                    let btnCartBack = $("<div class='btn-cart-back'><button id='btn-back' data-category="+el.product_category_id+" type='button' class='btn btn-warning m-auto mb-3 btn-back '>Go back</button><button type='button' id='"+el.product_id+"' class='btn btn-success m-auto mb-3 btn-cart'>Add to cart</button><div>");

                    let productId = el.product_id;

                    let category = el.product_category_id;

                    //show all images in slider for this product
                    $.post("php/productComplete.php?product-images", function(response){
                        let obj = JSON.parse(response);

                        let active = "active"
                        for(el of obj.data){
                            if(productId == el.image_product_id)
                            {
                                let img = $("<div class='carousel-item "+active+"'><img class = 'd-block m-auto' src = 'images/"+el.name_image+"'></img></div>");

                                $(".images-slider").append(img);
                                
                                if(category == "1") $(".images-slider-house").append(img);
                                else $(".images-slider-furniture").append(img);
                                

                                active = "";
                            }
                        }
                    });
                    
                    $("#full-product").css("display","block").html(productData).append(btnCartBack);

                    if(category == "1")
                    {
                        $("#full-product-recom-house").css("display","block").html(productData).append(btnCartBack);
                        $("#section-product-house").css("display","block");
                        $("#fetchRecomHouses").css("display","none"); 
                    }
                    else 
                    {
                        $("#full-product-recom-furniture").css("display","block").html(productData).append(btnCartBack);
                        $("#section-product-furniture").css("display","block");
                        $("#fetchRecomFurniture").css("display","none");
                    }
                
                    $("#section-product-complete").css("display","block");  
                    $(".all-product").css("display","none");
                }
            }

            $(".btn-back").click(function(){

                let id = $(this).data("category");

                if(id == 1)
                {
                    $("#fetchRecomHouses").css("display","block");
                    $("#full-product-recom-house").html("");
                    $("#section-product-house").css("display","none");
                    $(".images-slider-house").html("");
                }
                else
                {
                    $("#fetchRecomFurniture").css("display","block");
                    $("#full-product-recom-furniture").html("");
                    $("#section-product-furniture").css("display","none");
                    $(".images-slider-furniture").html("");
                }
               
                $("#section-product-complete").css("display","none");
                $(".all-product").css("display","block");
                $("#full-product").html("");
                $(".message-cart").html("");
                $(".images-slider").html("");
            });
            
            //on click button Add to Cart - insert or update quantity in table basket that product.

            $(".btn-cart").click(function(){
                let id = $(this).attr("id");

                $.post("php/productComplete.php?select-basket", {id:id}, function(response){
                    let obj = JSON.parse(response);

                    if(obj.data)
                    {
                        for(el of obj.data)
                        {
                            if(el.basket_product_id==id && el.basket_accepted==0)
                            {

                                $.post("php/productComplete.php?update-cart", {id:id}, function(response){
                                    let obj=JSON.parse(response);

                                    if(obj.data!="")
                                    {
                                        $(".message-cart").html("");
                                        $(".message-cart").css("color","green").css("display","block").append("The product was added once more.");
                                    }
                                    
                                });
                                return false;
                            }
                            
                        }
                        $.post("php/productComplete.php?insert-cart", {id:id}, function(response){
                            let answer = JSON.parse(response);

                            if(answer.error!="")
                            {
                                $(".message-cart").css("display","block").append(answer.error);
                                return false;
                            }
                            $(".message-cart").css("color","green").css("display","block").css("text-align","center").append(answer.data);

                            showNumber();
                        });
                    }
                    else
                    {
                        $(".message-cart").html("");
                        $(".message-cart").css("text-align","center").css("display","block").append("You have to sing in.");
                    }

                });
                
            });

        });
        
    });	
}

showNumber();
fetchRecomHouses();
fetchRecomFurniture();
showUserProfile();
