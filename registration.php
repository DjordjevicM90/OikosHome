<?php
    require_once("php/classBase.php");
    require_once("php/classStatistic.php");

    try{
        
        $db = new DB();
        

        if(isset($_GET['registration'])){

            $table = "user";
            $name = $_POST['name'];
            $lastName = $_POST['lastName']; 
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeatPassword = $_POST['repeatPassword'];
            
            $salt="GrJXCV3p44Vlo";

            if($name!="" AND $lastName!="" AND $email!="" AND $password!="" AND $repeatPassword!="")
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
                        "user_status" => "User"
                    );  

                    if(!$db->insert($table, $data) == true)
                    {   
                        echo "Error, please try again."; 
                    }
                    else
                    echo "You have successfully registered, please go on option sign in.";
                    Statistics::writeNote("logs/registration.log","User with email ".$email." has been successfully registered.");
                    
                }
                else
                {
                    echo "Your passwords do not match";  
                }
            }
            else
            {
                echo "You must fill in all the fields.";
                
            }

        }
        
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>