
<?php
// show complete product on click see more.
session_start();

require("classBase.php");
require("function.php");

$db = new DB();
$output['data'] = "";
$output['error'] = "";

//on click button see more on page product.php, show complete product
if(isset($_GET['product-complete']))
{
    $id = $_POST['id'];
    $table = "product";
    $columnId = "product_id";
    $columnDelete = "product_delete";

    $output['data'] = $db->select($table, $id, $columnId, $columnDelete);

}

if(isset($_GET['product-images']))
{
    $id = null;
    $table = "image_product";
    $columnId = null;
    $columnDelete = null;

    $output['data'] = $db->select($table, $id, $columnId, $columnDelete);
}

// show number products on cart icon
if(isset($_GET['showNumber'])){

    if(!login())
    {
        $output['error'] = "Error";
    }
    else
    {
        $table = "basket_view";
        $id = $_SESSION['user_id'];
        $columnId = "basket_user_id";
        $columnAccep = "basket_accepted";

        $output['data'] = $db->select($table, $id, $columnId, $columnAccep); 
    }
      
}

/////////////////////////
// on click button Add to Cart - get all data from basa and insert or update quantity in table basket that product.
///////////////////////////

    //select all data from basket-view for that user 
    if(isset($_GET['select-basket']))
    {
        if(!login())
        {
            $output['error'] = "Error";
        }
        else
        {
            $table = "basket_view";
            $product_id = $_POST['id'];
            $user_id = $_SESSION['user_id'];
            $columnProductId = "basket_product_id";
            $columnUserId = "basket_user_id";
            $columnDelete = "product_delete";

            $output['data'] = $db->selectSpec($table, $columnProductId, $product_id, $columnUserId, $user_id, $columnDelete); 
        }
        
    }

    // update quantity for product
    if(isset($_GET['update-cart']))
    {
        $table = "basket";
        $product_id = $_POST['id'];
        $user_id = $_SESSION['user_id'];
        
        $set1 = null;
        $set2 = null;

        $columnProductId = "basket_product_id";
        $columnUserId = "basket_user_id";

        $output['data'] = $db->updateQuantityAccep($table, $set1, $set2, $product_id, $user_id, $columnProductId, $columnUserId);
    }

    // adding products to the cart.

    if(isset($_GET['insert-cart']))
    {
        $table = "basket";
        $product_id = $_POST['id'];
        $user_id = $_SESSION['user_id'];
        
        $data = array (
            "basket_product_id" => $product_id,
            "basket_user_id" => $user_id,
        ); 

        if(!$db->insert($table, $data) == true)
        {   
            $output['error'] = "Error, please try again."; 
        }
        else 
        {
            $output['data'] = "The product is added to the cart.";
        }
    }

/////////////////////////
// ECND OF on click button Add to Cart - insert or update quantity in table basket that product.
///////////////////////////

    //delete product from cart and from table basket
    if(isset($_GET['basket-delete'])){

        $table = "basket";
        $product_id = $_POST['id'];
        $user_id = $_SESSION['user_id'];
        $columnProductiId = "basket_product_id";
        $columnUserId = "basket_user_id";
        $coulumnAccepted = "basket_accepted";

        if(!$db->delete($table, $product_id, $user_id, $columnProductiId,  $columnUserId, $coulumnAccepted) == true)
        {   
            $output['error'] = "Error, please try again."; 
        }
        else 
        {
            $output['data'] = "The product is removed form the cart.";
        }
    }

    //update product from table basket when user press button buy it
    if(isset($_GET['basket-buy'])){
        $table = "basket";
        $product_id = $_POST['id'];
        $user_id = $_SESSION['user_id'];
        
        $set1 = "basket_accepted";
        $set2 = 1;

        $columnProductId = "basket_product_id";
        $columnUserId = "basket_user_id";

        $output['data'] = $db->updateQuantityAccep($table, $set1, $set2, $product_id, $user_id, $columnProductId, $columnUserId);
    }

echo JSON_encode($output,256);

?>