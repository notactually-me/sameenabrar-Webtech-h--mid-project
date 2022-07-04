<?php
    session_start();

    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    { 
        $cpass = $_REQUEST['currpassword'];
        $npass = $_REQUEST['newpassword'];
        $nconpass = $_REQUEST['newconpassword'];
        $a = array();
        if($cpass == $_SESSION['pass'])
        {
            if($npass == $nconpass)
            {
                $file = fopen('../model/userlist.txt','r');
                //$alldata = file_get_contents('userlist.txt');
                while(!feof($file))
                {
                    $data = fgets($file);
                    $user = explode("|",$data);

                    if($user[0] == $_SESSION['id'])
                    {
                        
                        $newdata = str_replace($_SESSION['pass'],$npass,$data);
                        array_push($a,$newdata);
                    }
                    else
                    {
                        array_push($a,$data);

                    }
                }
                fclose($file);
                //print_r($a);
                $write = fopen('../model/userlist.txt','w');
                //fwrite($write);
                $updated = '';
                foreach($a as $item)
                {
                    $updated = $updated.$item;
                }
                echo $updated;
                fwrite($write,$updated);
                fclose($write);
                $_SESSION['pass'] = $npass;
                header('location: ../controller/logout.php');

            }
            else
            {?>
                <html>
                Password Does not match <br>
                <a href="../view/passchange.php">Try Again?</a><br>
                <a href="../view/ahome.php">Home</a>
                </html>
            <?php
            }

        }
        else
        {
           ?>
           <html>
                Password invalid <br>
                <a href="../view/passchange.php">Try Again?</a><br>
                <a href="../view/home.php">Home</a>
           </html>

           <?php          
        
        }
    }
    else
    {
        echo "Invalid request";
        echo "<br><a href='../view/login.php'>Login</a>";
    }    
?>