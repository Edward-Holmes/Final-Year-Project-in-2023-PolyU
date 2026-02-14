<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Reserving...</title>
        <link rel="icon" href="../multimedia/icon/FYP_Icon.ico" type="image/x-icon"><!--设置网页图标-->
        <link rel="stylesheet" href="../css/LoginPage.css"><!--设置页面风格-->
        <link rel="stylesheet" href="../css/loader.css"><!--设置加载风格-->
    </head>
    <body>
        <?php
            $server = "localhost";
            $user = "root";
            $password = "";
            $database = "Parking_System";

            $email = $_COOKIE["uemail"];
            $uid = $_COOKIE["uid"];

            $pstime = $_POST["p-s-time"];
            $petime = $_POST["p-e-time"];
            $license = $_POST["license"];
     
            //创建连接
            $conn = new mysqli($server, $user, $password);
     
            //检测连接
            if ($conn->connect_error) {
                die("Connection error: " . $conn->connect_error);
            } else {
                if ($uid!=null)
                {
                    mysqli_query($conn , "set names utf8");
                    $pstime = date('Y-m-d H:i:s', strtotime($pstime));
                    $petime = date('Y-m-d H:i:s', strtotime($petime));
                    $sql = "UPDATE UserInfo
                            SET Pre_S_Time='$pstime', Pre_E_Time='$petime', This_License='$license'
                            WHERE Uid='$uid'";
                    mysqli_select_db( $conn, $database);
                    $retval = mysqli_query( $conn, $sql );

                    if (! $retval)
                    {
                        echo "<p>Database update failure. Page will jump to start page in 3 seconds!</p>";
                        //延迟跳转
                        $jump = '../FYP_Start Page.html';
                        echo "<script language='javascript' type='text/javascript'>";  
                        echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                        echo "</script>";
                    } 
                    else 
                    {
                        echo "
                        <div class='container'>
	                        <span class='girl'></span>
	                            <div class='boys'>
		                            <span></span>
		                            <span></span>
		                            <span></span>
		                            <span></span>
	                            </div>
                        </div>
                        
                        <script language='javascript' type='text/javascript'>
                            alert(\"Successfully get your reservation Information. Reservation Start Time: " .$pstime. ", Reservation End Time: " .$petime. ", License: " .$license. ". Parking reservation successful, after clicking the [OK] button, page will jump to User Center in 3 seconds!\");
                        </script>
                        ";

                        $jump = './User_Center.php';
                        echo "<script language='javascript' type='text/javascript'>";  
                        echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                        echo "</script>";
                    }
                } else {
                    echo "<p>Login timed out, please log in again. Page will jump to start page in 3 seconds!</p>";
                    //延迟跳转
                    $jump = '../FYP_Start Page.html';
                    echo "<script language='javascript' type='text/javascript'>";  
                    echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                    echo "</script>";
                }
            }

            $conn->close();
        ?>

    </body>
</html>