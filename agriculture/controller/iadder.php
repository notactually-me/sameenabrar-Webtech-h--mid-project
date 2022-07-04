<?php
    session_start();

    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    { 

        // Required field names
        $required = array('id', 'name','price' ,'status', 'stock');
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
            echo "<br><a href='../view/iadd.php'>Back</a>";
            echo "<br><a href='../view/ahome.php'>Go Home</a>";
        }
        else
        {
            //personal info
            $id = $_REQUEST["id"];
            $name = $_REQUEST["name"];
            $price = $_REQUEST["price"];
            $status = $_REQUEST["status"];
            $stock = $_REQUEST["stock"];
            
            $file = fopen('../model/inventoryList.txt','a');

            $user = $id."|".$name."|".$price."|".$status."|".$stock."\r\n";
            
            fwrite($file,$user);
            header('location: ../view/inventory.php');
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