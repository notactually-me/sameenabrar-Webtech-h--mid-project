<?php
    session_start();

    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    { 

        $required = array('heading','toChange');
        $id_found = false;
        // Loop over field names, make sure each one exists and is not empty
        $error = false;
        foreach($required as $field) 
        {
            if (empty($_POST[$field])) 
            {
                $error = true;
                break;
            }
        }

        if(!$error)
        {
            //$id = $_REQUEST['changeID'];
            $heading = $_REQUEST['heading'];
            $new = $_REQUEST['toChange'];
            $a = array();
            
            $file = fopen('../model/regList.txt','r');
            $ufile = fopen('../model/userlist.txt','r');
            $ua = array();

            while(!feof($ufile))
            {
                $udata = fgets($ufile);
                $uuser = explode("|",$udata);

                if($uuser[0] == $_SESSION['id'])
                {
                    if($heading == "Name")
                    {
                        $name = str_replace($uuser[2],$new,$udata)."\r\n";
                        array_push($ua,$name);
                        $_SESSION['name'] = $new;
                    }
                }
                else
                {
                    array_push($ua,$udata);

                }


            }
            
            while(!feof($file))
            {
                $data = fgets($file);
                $user = explode("|",$data);

                if($user[0] == $_SESSION['id'])
                {
                    $id_found = true;
                    switch($heading)
                    {
                        case "Name":
                            $newdata = str_replace($user[2],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Phone number":
                            $newdata = str_replace($user[4],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Email":
                            $newdata = str_replace($user[3],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "DOB":
                            $newdata = str_replace($user[6],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Address":
                            $newdata = str_replace($user[5],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Degree":
                            $newdata = str_replace($user[8],$new,$data);
                            array_push($a,$newdata);
                            break;
                        case "Experience":
                            $newdata = str_replace($user[8],$new,$data);
                            array_push($a,$newdata);
                            break;
                    
                    }
                    
                }
                else
                {
                    array_push($a,$data);

                }
            }
            fclose($file);
            fclose($ufile);

            if(!$id_found)
            {
                echo "ID does not exist";
                echo "<br><a href='../view/editCus.php'>Back</a>";
                echo "<br><a href='../view/ahome.php'>Go Home</a>";
            }

            else
            {
                //print_r($a);
                $write = fopen('../model/regList.txt','w');
                //fwrite($write);
                $updated = '';
                foreach($a as $item)
                {
                    $updated = $updated.$item;
                }
                echo $updated;
                fwrite($write,$updated);
                fclose($write);

                $uwrite = fopen('../model/userlist.txt','w');
                //fwrite($write);
                $uupdated = '';
                foreach($ua as $item)
                {
                    $uupdated = $uupdated.$item;
                }
                //echo $updated;
                fwrite($uwrite,$uupdated);
                fclose($uwrite);
                //$_SESSION['pass'] = $npass;
                header('location: ../view/profile.php');
            }
        }
        else
        {
            echo "Please enter all details properly";
            echo "<br><a href='../view/profile.php'>Back</a>";
            echo "<br><a href='../view/ahome.php'>Go Home</a>";
        }
    }
    else
    {
        echo "Invalid request";
        echo "<br><a href='../view/login.php'>Login</a>";
    }    
?>