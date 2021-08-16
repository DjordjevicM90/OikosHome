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

    if(isset($_GET['profile']))
    {

        if($_SESSION['user_status'] == "administrator")
        {
            $table =  "basket_view";
            $columnFirst = "basket_accepted";
            $columnFirstVal = 1;
            $columnSecond = "basket_confirm";
            $columnSecondVal = 0;
            $columnDelete = "product_delete";
             
        }
        else
        {
            $table =  "basket_view";
            $columnFirst = "basket_accepted";
            $columnFirstVal = 1;
            $columnSecond = "basket_user_id";
            $columnSecondVal = $_SESSION['user_id'];
            $columnDelete = "product_delete";
            
        }

        $tableCategory = "category";
        $idCategory = null;
        $columnId = null;

        $selectPorduct = $db->selectSpec($table, $columnFirst, $columnFirstVal, $columnSecond, $columnSecondVal, $columnDelete);
        
        $selectCategory = $db->select($tableCategory, $idCategory, $columnId, $columnFirst);
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
<!--     <script src="JavaScript/registrationAndLogin.js"></script>
    <script src="JavaScript/basket.js"></script> -->
    <script src="JavaScript/profile.js"></script>
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
    
    <section id="profile" class="p-5">
        <div class="container">

            <h2 class="text-center mb-4"><span class="text-warning"><?= $_SESSION['user_name']?></span>  welcome to your profile page</h2>

            <?php
                if(login() AND $_SESSION['user_status']=="administrator")
                {
            ?>
            
            <div class="accordion accordion-flush" id="questions">
                <!--item 1-->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questions-one" >
                        Change profile.
                    </button>
                    </h2>
                    <div id="questions-one" class="accordion-collapse collapse">
                        <div class="accordion-body">

                            <div class="mb-3 w-50">
                                <label for="first-name" class="col-form-label">First name</label>
                                <input type="text" class="form-control" id="name-profile">
                            </div>

                            <div class="mb-3 w-50">
                                <label for="first-name" class="col-form-label">Last name</label>
                                <input type="text" class="form-control" id="lastname-profile">
                            </div>
                                
                            <div class="mb-3 w-50">
                                <label for="first-name" class="col-form-label">Password</label>
                                <input type="password" class="form-control" id="password-profile" placeholder="Please enter your current password or assign a new one">
                            </div>

                            <div class="mb-3 w-50">
                                <label for="first-name" class="col-form-label">Repeat password</label>
                                <input type="password" class="form-control" id="repeat-password-profile">
                            </div>

                            <div class="mb-3 w-50">
                                <button type="button" class="btn btn-primary" id="btn-save-change">Save</button>
                                <button type="button" class="btn btn-secondary" id="btn-clear-input">Cancel</button>
                            </div>
                            <div class="mb-3 w-50">
                                <p class="text-primary" id="message-profile-change"></p>
                            </div>
                            
                        </div>

                    </div>
                </div>
                <!--item 2-->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questions-two">
                        Add or delete products.
                    </button>
                    </h2>
                    <div id="questions-two" class="accordion-collapse collapse">
                        <div class="d-sm-flex d-block ">
                            <div class="accordion-body col-12 col-sm-6   border-end border-3 ">
                                <h3>Add product</h3>

                                <form action="" method="" id="add-product">

                                    <div class="mb-3 w-100 col-6" >
                                        <label for="first-name" class="col-form-label">Product name</label>
                                        <input type="text" class="form-control" name="name-add" id="name-add">
                                    </div>

                                    <div class="mb-3 w-100 col-6">
                                    <label for="text-area">Description</label>
                                        <textarea class="form-control" name="text-add" style="height: 100px" id="text-add"></textarea>
                                    </div>
                                        
                                    <div class="mb-3 w-100 col-6">
                                        <label for="first-name" class="col-form-label">Price</label>
                                        <input type="text" placeholder="$" name="price-add" class="form-control" id="price-add" >
                                    </div>

                                    <div class="mb-3 w-100 col-6">
                                        <select id="category" name="category"  class="form-select w-50">
                                            <option selected>Category</option>
                                            <option value="1">Houses</option>
                                            <option value="2">Furniture</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 w-100 col-6">
                                        <label for="formFile" class="form-label">Upload image/s</label>
                                        <input class="form-control" type="file" name="files[]" multiple>
                                    </div>

                                    <div class="mb-3 w-100 col-6">
                                        <button type="button" class="btn btn-primary" id="btn-add-product">Save</button>
                                    </div>

                                </form>

                                <div class="mb-3 w-100 col-6">
                                    <p class="text-primary" id="message-add-product"></p>
                                </div>
                            </div>

                            <div class="accordion-body col-12 col-sm-6 ">
                                <h3>Delete product</h3>
                                <div class="mb-3 w-100 ">
                                    <label for="formFile" class="form-label">Chose category of product</label>
                                    <select id="itemStatus" name="itemStatus" onchange="getval(this)" class="form-select w-50">
                                        <option value="0">Category</option>
                                       <?php                                                               
                                            foreach ($selectCategory as $key => $object) {
                                                $categoryId= $object->category_id;
                                                $categoryName= $object->category_name;
                                                
                                                echo "<option value='{$categoryId}' data-type='{$categoryId}'>$categoryName</option>";
 
                                            }
                                        ?> 
                                    </select>
                                </div>
                                 
                                <div id="product-delete"></div>

                                <div class="mb-3 w-100 col-6">
                                    <button type="button" class="btn btn-primary" id="btn-delete-product">Delete</button>
                                </div>

                                <div class="mb-3 w-100 col-6">
                                    <p class="text-primary" id="message-delete-product"></p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!--item 3-->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-three">
                        Purchased products 
                    </button>
                    </h2>
                    <div id="question-three" class="accordion-collapse collapse">
                        <div class="accordion-body">
                                <div class="row">
                                    <?php                                                               
                                        foreach ($selectPorduct as $object)
                                        {  
                                            $productId= $object->basket_product_id;
                                            $productName= $object->product_name;
                                            $productText= $object->product_text;
                                            $productPrice= $object->product_price;
                                            $productQuantity= $object->basket_quantity;
                                            $userName= $object->user_name;
                                            $userLastName= $object->user_lastname;
                                            $userEmail= $object->user_email;
                                            $purchaseTime= $object->basket_time;

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
                                        
                                            <div class="col-xl-3  col-md-6  profile-purches<?=$productId?>">
                                                <div class="card  bg-light text-dark border-warning border-2 card-purchase">
                                                    <div class="card-body  text-center">
                                                    <img  class="d-block w-100" src="images/<?=$img?>">
                                                        <h3 class="card-ttile"><?= $productName?></h3>
                                                        <p class="card-text d-none d-sm-block"><?= text($productText)?></p>
                                                        <h3 class="card-ttile"><?= $productPrice?> $</h3>
                                                        <h3 class="card-ttile">Quantity: <?= $productQuantity?></h3><hr>

                                                        <p class="card-text"> Purchased by:<span class="text-warning"> <?= $userName?> <?= $userLastName?></span></p>
                                                        <p class="card-text">Email: <span class="text-warning"><?= $userEmail?></span></p>
                                                        <p class="card-text d-none d-sm-block">Purchase time: <span class="text-warning"><?= $purchaseTime?></span></p>
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
                </div>
                
                <?php
                    $outputUsers="";
                    $outputRegistration="";

                    if(file_exists("logs/login.log")){
                        $outputUsers=file_get_contents("logs/login.log");
                        $outputUsers=nl2br($outputUsers);
                    }
                    if(file_exists("logs/registration.log")){
                        $outputRegistration=file_get_contents("logs/registration.log");
                        $outputRegistration=nl2br($outputRegistration);
                    }

                ?>

                <!--item 4-->
                <div class="accordion-item">
                    
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-four">
                        Logging statistics
                    </button>
                    </h2>
                    <div id="question-four" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <h3>User login and logout statistics </h3>
                            <?=$outputUsers?>
                        </div>
                    </div>

                </div>

                 <!--item 5-->
                 <div class="accordion-item">
                    
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-five">
                        Statistics of registration
                    </button>
                    </h2>
                    <div id="question-five" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <h3>User registration statistics </h3>
                            <?=$outputRegistration?>
                        </div>
                    </div>

                </div>
                
            </div>
                       
            <?php
                }
                else
                {  
            ?>
                <div class="accordion accordion-flush" id="questions">
                    <!--item 1-->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questions-one" >
                            Change profile.
                        </button>
                        </h2>
                        <div id="questions-one" class="accordion-collapse collapse">
                            <div class="accordion-body">

                                <div class="mb-3 w-50">
                                    <label for="first-name" class="col-form-label">First name</label>
                                    <input type="text" class="form-control" id="name-profile">
                                </div>

                                <div class="mb-3 w-50">
                                    <label for="first-name" class="col-form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastname-profile">
                                </div>
                                    
                                <div class="mb-3 w-50">
                                    <label for="first-name" class="col-form-label">Password</label>
                                    <input type="password" class="form-control" id="password-profile">
                                </div>

                                <div class="mb-3 w-50">
                                    <label for="first-name" class="col-form-label">Repeat password</label>
                                    <input type="password" class="form-control" id="repeat-password-profile">
                                </div>

                                <div class="mb-3 w-50">
                                    <button type="button" class="btn btn-primary" id="btn-save-change">Save</button>
                                    <button type="button" class="btn btn-secondary" id="btn-clear-input">Cancel</button>
                                </div>

                                <div class="mb-3 w-50">
                                    <p class="text-primary" id="message-profile-change"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--item 2-->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questions-two">
                            Purchased history.
                        </button>
                        </h2>
                        <div id="questions-two" class="accordion-collapse collapse">
                            <div class="accordion-body">
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
                                                $purchaseTime= $object->basket_time;

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
                                            
                                                <div class="col-xl-3 col-lg-4 col-md-6  profile-purches<?=$productId?>">
                                                    <div class="card  bg-light text-dark border-warning border-2 card-purchase">
                                                        <div class="card-body  text-center">
                                                            <img  class="d-block w-100" src="images/<?=$img?>">
                                                            <h3 class="card-ttile"><?= $productName?></h3>
                                                            <p class="card-text "><?= text($productText)?></p>
                                                            <h3 class="card-ttile"><?= $productPrice?> $</h3>
                                                            <h3 class="card-ttile">Quantity: <?= $productQuantity?></h3><hr>

                                                            <p class="card-text">Purchase time: <span class="text-warning"><?= $purchaseTime?></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                        
                                        }
                                        
                                        ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </section>

    <div id="message-profile" class=" text-center m-auto row "></div>
    
    <a href="#" class="position-fixed text-warning p-3" id="btn-to-top">
    <i class="fas fa-chevron-up"></i></a>
          
</body>
</html>