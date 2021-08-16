<?php
session_start();
require("php/classBase.php");
require_once("php/function.php");

try{
    $db = new DB();
    $id=null;
    $table = "category";
    $columnId = "product_category_id";
    $columnDelete = null;
    $selectCategory = $db->select($table,$id,$columnId,$columnDelete);


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
        GOOGLE FONTS
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

    <title>Oikos Home</title>
</head>
<body>

    <!--Header-->
        <?php include_once("pages/_header.php")?>
    <!--End of Header-->
        
    <!--Showcase-->
    <?php include_once("pages/_showcase.php")?>
    <!--End of Showcase-->

    <!--Houses products-->
    <?php include_once("pages/_articalFirst.php")?>
    <!--End of Houses products-->


    <!--Most popular house-->
    <?php include_once("pages/_articalSecond.php")?>
    <!--End of Most popular house-->

    <!--Furnitur products-->
    <?php include_once("pages/_articalThird.php")?>
    <!--End of Furnitur products-->

    <!--Footer-->
    <?php include_once("pages/_footer.php")?>
    <!--End of Footer-->

</body>
</html>