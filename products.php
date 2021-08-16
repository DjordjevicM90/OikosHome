<?php
session_start();
require("php/classBase.php");
require("php/function.php");

$output['data'] = "";
$output['error'] = "";

try{
    $db = new DB();

    if(isset($_GET['category'])){
        
        $table = "product";
        $id = $_GET['category'];
        $columnId = "product_category_id";
        $columnDelete = "product_delete";

        $tableCategory = "category";
        $idCategory = null;

        $selectPorduct = $db->select($table, $id, $columnId, $columnDelete);
        $selectCategory = $db->select($tableCategory, $idCategory, $columnId, $columnDelete); 

    }
    else header("location: index.php");

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
        
    <div class="container all-product">

        <div class="wrapper-product">
            <div class="row">
                <?php  
                                                                             
                    foreach ($selectPorduct as $object)
                    {   
                        $productId= $object->product_id;
                        $productName= $object->product_name;
                        $productText= $object->product_text;

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
                    
                        <div class="col-xl-3 col-lg-4 col-md-6 py-2">
                            <div class="card bg-light text-dark border-warning border-2 card-product">
                                <div class="card-body text-center">
                                    <img id = "product<?=$productId?>" class=" d-block w-100 " src="images/<?=$img?>">
                                    <h3 class="card-ttile"><?= $productName?></h3>
                                    <p class="card-text "  ><?= text($productText)?></p>
                                    <a type="button"  data-product=<?= $productId?> class="btn btn-success product-complete ">See more</a>
                                </div>
                            </div>
                        </div>
                <?php
                    
                }
                ?> 
            </div>
        </div>
    </div>

<section id="section-product-complete" class="p-5 ">
    <div class="container">
        <div class="wrapper-slideshow-image m-auto my-5">

            <div class="carousel slide " data-bs-ride="carousel" id="slide">

                <div class="carousel-inner d-none d-sm-block images-slider">

                </div>

                <button  class="carousel-control-prev d-none d-sm-block" type="button" data-bs-target="#slide" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next d-none d-sm-block" type="button" data-bs-target="#slide" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>
        </div>

        <div id="full-product" class=" text-center row">
    
        </div>
        <div class="message-cart" class=" text-center m-auto row ">
    
        </div>
    </div>
</section>

    <!--Footer-->
    <?php include_once("pages/_footer.php")?>
    <!--End of Footer-->
            
</body>
</html>