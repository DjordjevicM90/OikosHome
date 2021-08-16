<?php
    //show 20 words as an item description
    function text($productText){
        $temp = explode(" ",$productText);
        $new = array_slice($temp, 0, 20);
        $text = implode(" ", $new)." ...";
        return $text;
    }

    function createSession($id, $name, $lastname, $email, $status, $remember)
    {
        $_SESSION['user_id']=$id;
        $_SESSION['user_name']="$name $lastname";
        $_SESSION['user_email']=$email;
        $_SESSION['user_status']=$status;

        if($remember=="1")
        {
            setcookie("id", $id, time()+86400, "/");
            setcookie("name", "$name $lastname", time()+86400, "/");
            setcookie("email", $email, time()+86400, "/");
            setcookie("status", $status, time()+86400, "/");
        }
    }
    
    function login()
    {
        if(isset($_SESSION['user_id']) AND isset($_SESSION['user_name'])  AND isset($_SESSION['user_status']))
        {
            return true;
        }
        else if(isset($_COOKIE['id']) and isset($_COOKIE['name']) and isset($_COOKIE['status'])){
            $_SESSION['user_id']=$_COOKIE['id'];
            $_SESSION['user_name']=$_COOKIE['name'];
            $_SESSION['user_status']=$_COOKIE['status'];
            return true;
        }
        return false;
    }


    function destroySession()
    {
        session_unset();
        session_destroy();
        setcookie("id", "", time()-1,"/");
        setcookie("name", "", time()-1,"/");
        setcookie("email", "", time()-1,"/");
        setcookie("status", "", time()-1,"/");
        header("location: index.php");
    }
?>