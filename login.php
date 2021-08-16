<?php
    session_start();
    require_once("php/classBase.php");
    require_once("php/function.php");
    require_once("php/classStatistic.php");

    $output['data'] = "";
    $output['error'] = "";
    

    try{
        $db = new DB();

        if(isset($_SESSION['time'])) 
        {
            if(time()-60>$_SESSION['time']){ //If is passed 1 minute, destroy these sessions.
                unset($_SESSION['time']);
                unset($_SESSION['mistake']);
            }
        }

        //if the user entered the wrong e-mail or password 5 times , then disaloow log for 1 minute, for that user and create session['time'].
        if(isset($_SESSION['mistake']) and $_SESSION['mistake']==5) 
        {
            $output['error']="You have entered the wrong password more than 5 times, please try again in 1 minute.";
            Statistics::writeNote("logs/login.log", "User with  IP  address - ". $_SERVER['REMOTE_ADDR'] ." was banned for 1 min");

            if(!isset($_SESSION['time']))
            {
                $_SESSION['time']=time();
            }
            echo JSON_encode($output, 256);
            exit();   
        }

        if(isset($_GET['login'])){

            $table = "user";
            $columnEmail = "user_email";
            $columnActive = "user_active";

            $email=$_POST['email'];
            $password=$_POST['password'];
            $remember = $_POST['remember'];

            $salt="GrJXCV3p44Vlo";

            if($email!="" AND $password!="")
            {
                if(!$row=$db->selectRow($table, $email, $columnEmail, $columnActive))
                {
                    $output['error'] = "Wrong email or password";

                    if(!isset($_SESSION['mistake'])){ //After first wrong user input, create session['mistake'].
                        $_SESSION['mistake']=1;
                    }
                    else{
                        ++$_SESSION['mistake']; //If session['mistake'] alredy exists, then increase its value by 1.
                    }
                }

                else
                {
                    foreach($row as $obj){
                        $userId = $obj->user_id;
                        $userName = $obj->user_name;
                        $userLastname = $obj->user_lastname;
                        $userEmail = $obj->user_email;
                        $userStatus = $obj->user_status;


                        $passwordBase = $obj->user_password;
                    }

                    if(password_verify($password.$salt, $passwordBase))
                    {
                        createSession($userId, $userName, $userLastname, $userEmail, $userStatus, $remember);
                        
                        $output['data']="index.php";
                        Statistics::writeNote("logs/login.log","User with email ".$userEmail." has successfully logged in.");
                    }
                    else
                    {
                        $output['error'] = "Wrong email or password";

                        if(!isset($_SESSION['mistake'])){ //After first wrong user input, create session['mistake'].
                            $_SESSION['mistake']=1;
                        }
                        else{
                            ++$_SESSION['mistake']; //If session['mistake'] alredy exists, then increase its value by 1.
                        }
                    }
                }

            }
            else
            {
                $output['error'] = "You must fill in all the fields.";
            }

        }
        if(isset($_GET['logoff']))
        {
            Statistics::writeNote("logs/login.log","User with email ".$userEmail." has successfully logged out.");
            destroySession();
            header("location: index.php");
        }
        echo JSON_encode($output, 256);
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>