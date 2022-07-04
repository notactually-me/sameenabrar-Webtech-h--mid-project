<?php
    session_start();
    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    {
        $file = fopen('../model/reglist.txt','r');
        
        $userdata = array();
        while(!feof($file))
        {
            $data = fgets($file);
            $user = explode("|",$data);
            
            if($user[0] == $_SESSION['id'])
            {
                foreach($user as $item)
                {
                    array_push($userdata,$item);
                }

            }
        }
        fclose($file);

        $skillset = fopen('../model/skill_list.txt', 'r');
        $skill = array();
        while(!feof($skillset))
        {
            $data = fgets($skillset);
            $user = explode("|",$data);
            
            if($user[0] == $_SESSION['id'])
            {
                foreach($user as $item)
                {
                    array_push($skill, $item);
                }

            }
        }
        $skills = implode(', ', array_slice($skill,3));

    
?>
<html>
    <head><title>User Profile</title></head>
    <body>
        <a href="../view/ahome.php">Go Home</a>

        <table border="1px" style="width:40%">
            <tr><th colspan="2">Profile</th></tr>
            <tr style="height: 30px;">
                <td style="width: 50%;">Name:</td>
                <td><?php echo $userdata[2]; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>ID:</td>
                <td><?php echo $userdata[0]; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>Email:</td>
                <td><?php echo $userdata[3]; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>Date Of Birth:</td>
                <td><?php echo $userdata[6]; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>Gender:</td>
                <td><?php echo $userdata[7]; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>Address:</td>
                <td><?php echo $userdata[5]; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>Phone:</td>
                <td><?php echo $userdata[4]; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>Degree:</td>
                <td><?php echo $userdata[8]; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>Years of experience:</td>
                <td><?php echo $userdata[9]; ?> years</td>
            </tr>

            <tr style="height: 30px;">
                <td>Skills:</td>
                <td><?php echo $skills; ?></td>
            </tr>
        </table>
        <fieldset style="width:37.7%">
            <legend>Update Profile</legend>
            <form action="../controller/profile_edit.php" method="post">
                <table>
                    <tr>
                        <td>Detail to Update: </td>
                        <td>
                        <select name="heading" id="edit">
                                <option value="">Choose Value</option>
								<option value="Name">Name</option>	
								<option value="Phone number"> Phone number</option>
                                <option value="Email">Email</option>
                                <option value="DOB">DOB</option>
                                <option value="Address">Address</option>
                                <option value="Experience">Experience</option>
                                <option value="Degree">Degree</option>
                                <!-- <option value="Skills">Skills</option>	 -->
                                
							</select>
                        </td>
                    </tr>
                    <tr>
                        <td>Change to: </td>
                        <td><input type="text" name="toChange" id="edit" placeholder="Type new data"/></td>
                    </tr>
                    <tr><td><input type="Submit" name="submit" value="Apply changes"></td></tr>
                </table>
            
        </fieldset>
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
