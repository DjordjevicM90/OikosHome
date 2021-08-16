<?php
session_start();
require("php/classBase.php");
require("php/function.php");

$output['data'] = "";
$output['error'] = "";

try{
    $db = new DB();

    if(!login())
    {   
        header("location: index.php");
        exit();
    }

    if(isset($_GET['basket']))
    {
        $table =  "basket_view";
        $id = $_SESSION['user_id'];
        $columnId = "basket_user_id";
        $columnAccepted = "basket_accepted";

        $tableCategory = "category";
        $idCategory = null;

        $selectPorduct = $db->select($table, $id, $columnId, $columnAccepted);
        
        $selectCategory = $db->select($tableCategory, $idCategory, $columnId, $columnAccepted);
    }
     
}catch(Exception $e){
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap CSS -->
     <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="JavaScript/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--------------------
        GOOGLE FONTS SIZE
    ----------------------->
    <link href="css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Orelega+One&display=swap" rel="stylesheet">
    

    <!--------------------
        JAVA SCRIPT- JQuery
    ----------------------->
    
    <script src="JavaScript/jquery-3.6.0.js"></script>
    <script src="JavaScript/function.js"></script>
    <script src="JavaScript/registrationAndLogin.js"></script>
    <script src="JavaScript/basket.js"></script>
    <script src="JavaScript/config.js"></script>

    <link href="css/style.css" rel="stylesheet">

    <title>Houses and Furniture</title>
</head>
<body>
<?php

?>
    <!--Header-->
        <?php include_once("pages/_header.php")?>
    <!--End of Header-->
        
    <section id="section-basket" class="p-5">
        <div class="container all-product">

            <div class="wrapper-product">
                <div class="row">
                    <?php                                                               
                        foreach ($selectPorduct as $object)
                        {  
                            $productId= $object->basket_product_id;
                            $productName= $object->product_name;
                            $productText= $object->product_text;
                            $productPrice= $object->product_price;
                            $productQuantity= $object->basket_quantity;

                            $id = null;
                            $table = "image_product";
                            $columnId = null;
                            $columnDelete = null;
    
                            $porductImg = $db->select($table, $id, $columnId, $columnDelete);
                            
                            foreach($porductImg as $image)
                            {
                                if($productId == $image->image_product_id)
                                {
                                $img = $image->name_image; 
                                break; 
                                }     
                                
                            }

                    ?>
                    <!--Products cards-->
                        
                            <div class="col-xl-3 col-md-6 col-sm-12 btn-remove<?=$productId?>">
                                <div class="card bg-light text-dark border-warning border-2 card-product-cart">
                                    <div class="card-body text-center">
                                    <img  class="d-block w-100" src="images/<?=$img?>">
                                        <h3 class="card-ttile"><?= $productName?></h3>
                                        <p class="card-text "><?= text($productText)?></p><hr>
                                        <h3 class="card-ttile"><?= $productPrice?> $</h3>
                                        <h3 class="card-ttile ">Quantity: <?= $productQuantity?></h3><hr>
                                        <a type="button"  data-product=<?= $productId?> class="btn btn-warning mb-2 btn-remove">Remove from cart</a><br>
                                        <a type="button"  data-product=<?= $productId?> class="btn btn-success btn-buy">Buy product</a>
                                    </div>
                                </div>
                            </div>
                    <?php
                    
                    }
                    
                    ?> 
                </div>
                <div id="message-buy" class=" text-center m-auto row ">
                    
                </div>
            </div>
        </div>
    </section>
    
    <a href="#" class="position-fixed text-warning p-3" id="btn-to-top">
    <i class="fas fa-chevron-up"></i></a>
            
</body>
</html>