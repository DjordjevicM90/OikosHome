<?php

include 'classBase.php';
require("function.php");

try{
    $db = new DB();
    $table = "product";
    $id="1";
    $columnId = "product_category_id";
    $columnDelete = "product_delete";

    $rows = $db->select($table, $id, $columnId, $columnDelete);

    if(isset($_GET['furniture'])){
        $table = "product";
        $id="2";
        $columnId = "product_category_id";
        $columnDelete = "product_delete";

        $rows = $db->select($table, $id, $columnId, $columnDelete);
    }
}catch(Exception $e){
    echo $e->getMessage();
}

?>

<div class="container">

        <div class="wrapper-first-artical">
           <div class="row "> 
               
                <?php    
                    $x=0;                                                           
                    foreach ($rows as $object)
                    {   
                        if($x==4) return false;
                        
                        $productId = $object->product_id;
                        $productName = $object->product_name;
                        $productPrice = $object->product_price;
                        $productText = $object->product_text;
                        $productCategoryId = $object->product_category_id; 

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
                    
                    <div class="col-xl-3  col-md-6 col-sm-12 py-2">
                        <div class="card bg-light text-dark border-warning border-2 card-product">
                            <div class="card-body text-center ">
                                <img  class="d-block w-100" src="images/<?=$img?>">
                                <h3 class="card-ttile"><?= $productName?></h3>
                                <p class="card-text d-none d-sm-block"><?= text($productText)?></p>
                                <a type="button"  data-product=<?= $productId?> class="btn btn-success product-complete">See more</a>
                            </div>
                        </div>
                    </div>
                <?php
                    $x++;
                }
                ?> 
            </div>
        </div>
    </div>