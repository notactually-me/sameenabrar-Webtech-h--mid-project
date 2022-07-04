<?php
    session_start();
    if(isset($_COOKIE['astatus']) && isset($_SESSION['id']) && isset($_SESSION['pass']))
    {
        $t_file = fopen('../model/TransactionList.txt','r');
        
        $netsales = 0;
        while(!feof($t_file))
        {
        
            $tdata = fgets($t_file);            
            $value = explode("|",$tdata);
            //var_dump($value[7]);
            if($tdata == '')
            {
                break;
            }
            else
            {
                if($value[7] == "Approved")
                {
                    $netsales += intval($value[8]);
                }
            }
        }
        fclose($t_file);

        $f_file = fopen('../model/farmerList.txt','r');
        $s_file = fopen('../model/managerList.txt','r');
        $netcost = 0;
        
        while(!feof($f_file))
        {
            $fdata = fgets($f_file);
            $fvalues = explode("|",$fdata);
            if($fdata == '')
            {
                break;
            }
            else
            {
                

                $netcost += intval($fvalues[9]);
            }
        }

        while(!feof($s_file))
        {
            $sdata = fgets($s_file);
            $svalues = explode("|",$sdata);
            if($sdata == '')
            {
                break;
            }
            else
            {
                $netcost += intval($svalues[11]);
            }
        }
        fclose($f_file);
        fclose($s_file);
        //fclose($t_file);

        $netprofit = $netsales - $netcost;
        

    
?>
<html>
    <head><title>Accounts</title></head>
    <body>
        <a href="../view/ahome.php">Go Home</a>

        <table border="1px" style="width:40%">
            <tr><th colspan="2">Monthly Acounts Data</th></tr>
            
            <tr style="height: 30px;">
                <td>Net Sales:</td>
                <td><?php echo $netsales; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>Net Cost:</td>
                <td><?php echo $netcost; ?></td>
            </tr>

            <tr style="height: 30px;">
                <td>Net Profit:</td>
                <td><?php echo $netprofit; ?></td>
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
