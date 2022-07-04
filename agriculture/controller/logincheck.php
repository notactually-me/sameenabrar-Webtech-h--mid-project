<?php
    session_start();  

    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    $_SESSION["id"] = $username;
    $_SESSION["pass"] = $password;
    $log = false;


    $file = fopen('../model/userlist.txt','r');
    if ($username == null)
        {
            echo "Please enter a valid username";
        }
    elseif ($password == null)
    {
        echo "Please enter a valid password";
    }
    else
    {
        while(!feof($file))
        {
            $data = fgets($file);
            $user = explode("|",$data);
            //$isuser = "admin";

            
            if ($username == $user[0] && $password == $user[1])
            {
                    setcookie('astatus', 'alogin', time()+3600, '/');  
                    header('location: ../view/ahome.php?');
                    $_SESSION['name'] = $user[2];  
                    $log = true; 
                    break;             
            }
            
            else
            {
                //echo "Incorrect username/password";
                //break;
                continue;
            }
        
        }
        
        if($log == false)
            {
                echo 'Incorrect username/password';
                echo '<br><a href="../view/login.php">Login</a>';
            }
    }

?>