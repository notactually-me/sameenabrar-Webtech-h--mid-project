<?php


    // Required field names
    $required = array('id', 'password', 'conpassword', 'name','email' ,'phone', 'address','dob','gender','degree','epyears','skills');
    $iderror = false;
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
    
    $file = fopen('../model/reglist.txt','r');

    while(!feof($file))
    {
        $data = fgets($file);
        $user = explode("|",$data);

        if($user[0] == $_REQUEST["id"])
        {
            $ierror = true;
            break;
        }
    }
    fclose($file);

if($ierror)
{
    echo "Chosen ID already exist.";
    echo "<br><a href='../view/reg.php'>Try Again?</a>";
    echo "<br><a href='../view/login.php'>Login</a>";
}
else
    {

        if ($error)
            {
                echo "Please enter valid details";
                echo "<br><a href='../view/reg.php'>Try Again?</a>";
                echo "<br><a href='../view/login.php'>Login</a>";
            }
        else
            {
                //personal info
                $id = $_REQUEST["id"];
                $pass = $_REQUEST["password"];
                $cpass = $_REQUEST["conpassword"];
                $name = $_REQUEST["name"];
                $email = $_REQUEST["email"];
                $phone = $_REQUEST["phone"];
                $address = $_REQUEST["address"];
                $dob = $_REQUEST["dob"];
                $gender = $_REQUEST["gender"];
                //job details
                $degree = $_REQUEST["degree"];
                $experience = $_REQUEST["epyears"];
                $listofskills = $_REQUEST["skills"];

                if ($pass != $cpass)
                {
                    echo "Password does not match";
                }
                else
                {
                    //$skills = '';
                    foreach($listofskills as $item)
                    {
                        if ($item == null)
                        {
                            continue;
                        }
                        else
                        {
                            $skills = $skills."|".$item;
            
                        }
                        
                    }

                    $file = fopen('../model/reglist.txt','a');
                    $userlist = fopen('../model/userlist.txt','a');
                    $skill_list = fopen('../model/skill_list.txt','a');

                    $user = $id."|".$pass."|".$name."|".$email."|".$phone."|".$address."|".$dob."|".$gender."|".$degree."|".$experience."|".$skills."\r\n";
                    $logindata = $id."|".$pass."|".$name."\r\n";
                    $userskills = $id."|".$name."|".$skills."\r\n";
                    
                    fwrite($file,$user);
                    fwrite($userlist,$logindata);
                    fwrite($skill_list,$userskills);
                    header('location: ../view/login.php');
                }

                fclose($file);
                fclose($userlist);
                fclose($skill_list);
            }
    }
?>