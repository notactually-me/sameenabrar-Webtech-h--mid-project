<html>
    <head>
        <title>
            Login
        </title>
    </head>
    <body>
        <fieldset>
            <legend>Login</legend>
            <form action="../controller/logincheck.php" method="post" enctype="">
                <table>
                    <tr><td>User ID</td></tr>
                    <tr><td><input type="text" name="username" value=""/></td></tr>
                    <tr><td>Password</td></tr>
                    <tr><td><input type="password" name="password" value=""/></td></tr>
                    <tr><td><input type="submit" name="submit" value="Submit"> <a href="../view/reg.php">Register</a></tr></td>
                </table>
            </form>
        </fieldset>
    </body>
</html>