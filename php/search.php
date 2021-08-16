<?php
    session_start();
    require("classBase.php");
    require("function.php");
    
    $output['data'] = "";
    $output['error'] = "";
    
    try{
        $db = new DB();

        $table = "product";
        $value = $_POST['value'];
        $columnDelete = "product_delete";
        $columnProdName = "product_name";
        
        if(!$row =$db->search($table,$value,$columnDelete,$columnProdName))
        {
            return false;
        }
        else

        foreach ($row as $obj)
            {
               $productName = $obj->product_name; 
               $productId = $obj->product_id; 
               $productCategory = $obj->product_category_id; 
        ?>

            <ul>
                <li><a href="products.php?category=<?=$productCategory?>#product<?=$productId?>"><?=$productName?></a></li>
            </ul>

        <?php    
            }   

    }catch(Exception $e){
        echo $e->getMessage();
    }
?>

        
         

             
