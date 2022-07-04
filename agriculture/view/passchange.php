<?php
    session_start();
    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    { 
?>
<html>

    <form action="../controller/checkpasschange.php" method="post">
    <table>
        <tr><td><a href="../view/ahome.php">Home</a></td></tr>
        <tr><td>Current Password:</td></tr>
        <tr><td><input type="password" name="currpassword" id="login" value="" placeholder="Enter your current password"/></td></tr>
        
        <tr><td>New Password:</td></tr>
        <tr><td><input type="password" name="newpassword" id="login" value="" placeholder="Enter new password"/></td></tr>
        
        <tr><td>Confirm New Password:</td></tr>
        <tr><td><input type="password" name="newconpassword" id="login" value="" placeholder="Re-enter password"/></td></tr>
        
        <tr><td><input type="submit" name="submit" value="Submit"/></td></tr>
    </table>
    </form>

</html>
<?php
    }
    else
    {
        echo "Invalid request";
        echo "<br><a href='../view/login.php'>Login</a>";
    }    
?>