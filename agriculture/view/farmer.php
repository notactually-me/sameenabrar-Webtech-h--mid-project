<?php
    session_start();
    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    {
    
?>
<html>
    <head><title>Farmer List</title></head>
    <body>
        <a href="../view/ahome.php">Go Home</a>

        <table border="1px" style="width:85%">
            <tr><th colspan="10">Farmer list</th></tr>
            <tr>
                <th>ID</th><th>Name</th><th>User Type</th><th>Gender</th><th>Phone Number</th>
                <th>Email</th><th>Date of Birth</th><th>Experience</th><th>Number of Fields</th><th>Salary</th>
            </tr>
            <?php
                $file = fopen('../model/farmerList.txt','r');
        
                $userdata = array();
                while(!feof($file))
                {
                    $data = fgets($file);
                    $user = explode("|",$data);
                    
                    
                    if($data != null)
                    {
                        echo "<tr style='text-align: center'>";
                            for($i = 0; $i<count($user); $i++)
                            {
                                echo "<td>".$user[$i]."</td>";
                            }
                        echo "</tr>";
                    }
                    
                }
                fclose($file);
            
            ?>
        </table>
        <br>
        <table>
            <tr>
                <td>
                    <form action="../view/updateFarmer.php" method="post">
                        <input type="Submit" value="Update details">
                    </form>
                </td>

                <td>
                    <form action="../view/addFarmer.php" method="post">
                        <input type="Submit" value="Add Farmer">
                    </form>                            
                </td>

                <td>
                    <form action="../view/delFarmer.php" method="post">
                        <input type="Submit" value="Delete Farmer">
                    </form>                            
                </td>

            </tr>
        </table>
        
    </body>
</html>
<?php
    }
    else
    {
        echo "Invalid request";
        echo "<br><a href='../view/login.php'>Login</a>";
    }
?>
