<?php
// show complete product on click see more.
session_start();

require("classBase.php");
require("function.php");

;
$output['data'] = "";
$output['error'] = "";

try
{
    $db = new DB();

    if(isset($_GET['select-user']))
    {
        if(!login()) 
        {
            $output['error'] = "Error";
        }
        else
        {   
            $table = "user";
            $email = $_SESSION['user_email'];
            $columnEmail = "user_email";
            $columnActive = "user_active";
            

            $output['data'] = $db->selectRow($table, $email, $columnEmail, $columnActive);   
        }
         
    }

    // change user profile
    if(isset($_GET['profile-change']))
    {
        $table = "user";
        $userId = $_SESSION['user_id'];
        $columId= "user_id";
        
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $email = $_SESSION['user_email']; 
        $password = $_POST['password'];
        $status = $_SESSION['user_status'];

        $repeatPassword = $_POST['repeatPassword'];
        
        $salt="GrJXCV3p44Vlo";

        if($name!="" AND $lastName!="" AND $password!="" AND $repeatPassword!="")
        {
            if($password == $repeatPassword)
            {
                $password=$password.$salt;
                $password=password_hash($password, PASSWORD_BCRYPT);

                $data = array (
                    "user_name" => $name,
                    "user_lastname" => $lastName,
                    "user_email" => $email,
                    "user_password" => $password,
                    "user_status" => $status
                ); 

                if(!$db->updateUser($table, $userId, $columId, $data) == true)
                {
                    $output['error'] = "Something wrong, please try again.";
                }
                else 
                {
                    $output['data'] = "You have successfully changed your profile information";
                }
            }
            else
            {
                $output['error'] = "Your passwords do not match";
            }
            
        }
        else
        {
            $output['error'] = "You must fill in all the fields.";
        }
    }



    if(isset($_GET['add-products']))
    {

        $table = "product";
        $productName = $_POST['name-add'];
        $porductText = $_POST['text-add'];
        $porductPrice = $_POST['price-add'];
        $porductCategory = $_POST['category'];
        $images = $_FILES['files']['name'];
        $temp = $_FILES['files']['tmp_name'];

        $data = array (
            "product_name" => $productName,
            "product_text" => $porductText,
            "product_category_id" => $porductCategory,
            "product_price" => $porductPrice,
        );  

        if($productName!="" AND $porductText!="" AND $porductPrice!="" AND $porductCategory!="Category" AND $images!=array(""))
        {
            
            foreach ($temp as $name){
                $img = $name;
            }

            $img=getimagesize($img);

            if($img)
            {
                if(!$db->insert($table, $data) == true)
                {
                    echo "Error, please try again."; 
                }
                else
                {
                    $id = $db->insertId();
                    if(is_array($_FILES))
                    {
                        foreach($_FILES['files']['name'] as $name => $value){
                            $file_name = explode(".", $_FILES['files']['name'][$name]);
                            $allower_ext = array("jpg", "JPG", "jpeg", "png", "gif");

                            if(in_array($file_name[1], $allower_ext))
                            {
                                $new_name = microtime(true).".".$file_name[1];
                                $temp = $_FILES['files']['tmp_name'][$name];
                                $destination = "../images/".$new_name;
                                

                                if(@move_uploaded_file($temp, $destination))
                                {
                                    $table = "image_product";
                                    

                                    $data = array (
                                        "image_product_id" => $id,
                                        "name_image" => $new_name,
                                    );

                                    if(!$db->insert($table, $data) == true)
                                    {
                                        $output['error'] = "Error, please try again."; 
                                        
                                    }
                                    $output['data'] = "You have successfully added your image/s.";
                                }
                            }
                        }
                    }
                    $output['data'] = "You have successfully added product";
                }
            }
            else $output['error'] = "This image type is not allowed.";  
        }
        else $output['error'] = "You must fill in all the fields.";
    }

    if(isset($_GET['select-delete-products']))
    {
        $table = "product";
        $id = $_POST['categoryType'];
        $columnId = "product_category_id";
        $columnDelete = "product_delete";
    
        $output['data'] = $db->select($table, $id, $columnId, $columnDelete);
        
    }

    if(isset($_GET['product-delete']))
    {
        $table = "product";
        $productId = $_POST['productId'];
        $columnProductId = "product_id";
        $productDelete = 1;

        $data = array (
            "product_delete" => $productDelete,
        ); 

        if(!$db->updateUser($table, $productId, $columnProductId, $data) == true)
        {
            $output['error'] = "Something wrong, please try again.";
            $output['data'] = "";
        }
        else 
        {
            $table = "image_product";
            $imageProductId = $productId;
            $columnImageProId = "image_product_id";
            $columnSecond = null;

            $nameImages = $db->select($table, $imageProductId, $columnImageProId, $columnSecond);
            
            foreach($nameImages as $nameImg)
            {
                unlink("../images/".$nameImg->name_image);
            }

            $table = "image_product";
            $productId = $_POST['productId'];
            $user_id = null;
            $columnImageProId = "image_product_id";
            $columnSecond = null;
            $columnThird = null;
            
            if(!$db->delete($table, $productId, $user_id, $columnImageProId,  $columnSecond, $columnThird) == true)
            {   
                $output['error'] = "Error, please try again."; 
            }
            else 
            {
                $output['data'] = "The product is removed form the cart.";
            }
            $output['data'] = "You have successfully changed your profile information";
            $output['error'] = "";
        }
    }

    echo JSON_encode($output, 256);

}catch(Exception $e){
    echo $e->getMessage();
}


?>