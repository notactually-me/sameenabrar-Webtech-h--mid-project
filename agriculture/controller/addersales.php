<?php
    session_start();

    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    { 

        // Required field names
        $required = array('id', 'name','email' ,'phone', 'dob','gender','distribution','degree','education','epyears','salary');
        //$id_found = false;
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


        if ($error)
        {
            echo "Please enter valid details";
            echo "<br><a href='../view/addSalesManager.php'>Back</a>";
            echo "<br><a href='../view/ahome.php'>Go Home</a>";
        }
        else
        {
            //personal info
            $id = $_REQUEST["id"];
            $name = $_REQUEST["name"];
            $email = $_REQUEST["email"];
            $phone = $_REQUEST["phone"];
            $dob = $_REQUEST["dob"];
            $gender = $_REQUEST["gender"];
            //job details
            $degree = $_REQUEST["degree"];
            $experience = $_REQUEST["epyears"]." years";
            $education = $_REQUEST["education"];
            $distribution = $_REQUEST["distribution"];           
            $salary = $_REQUEST["salary"];
            $file = fopen('../model/managerList.txt','a');

            $user = $id."|".$name."|"."Salesperson"."|".$distribution."|".$gender."|".$phone."|".$email."|".$dob."|".$experience."|".$education."|".$degree."|".$salary."\r\n";
            
            fwrite($file,$user);
            header('location: ../view/sales_manager.php');
            fclose($file);
        }

        //fclose($file);
    }
    else
    {
        echo "Invalid request";
        echo "<br><a href='../view/login.php'>Login</a>";
    } 
        
?>