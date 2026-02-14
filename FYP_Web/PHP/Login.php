<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Logging in...</title>
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

            $email = $_POST["E-mail"];
            $passwd = $_POST["passwd"];

            $expire=time()+60*60*24*30;
            setcookie("uemail", $email, $expire);
            setcookie("upassword", $passwd, $expire);
     
            //创建连接
            $conn = new mysqli($server, $user, $password, $database);
     
            //检测连接
            if ($conn->connect_error) {
                die("Connection error: " . $conn->connect_error);
            } else {
                $sql = "SELECT * FROM UserInfo where User_Email='$email'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) 
                {
                    //输出数据
                    while($row = $result->fetch_assoc())
                    {
                        if ($row["Password"] == $passwd) 
                        {
                            setcookie("uname", $row["User_Name"], $expire);
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
                            ";

                            $jump = './User_Center.php';
                            echo "<script language='javascript' type='text/javascript'>";  
                            echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                            echo "</script>";
                        }
                        else
                        {
                            echo "<p>The password is wrong! Page will jump to start page in 3 seconds!</p>";

                            //延迟跳转
                            $jump = '../FYP_Start Page.html';
                            echo "<script language='javascript' type='text/javascript'>";  
                            echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                            echo "</script>";
                        }
                    }
                } 
                else 
                {
                    echo "<p>Please register! Page will jump to start page in 3 seconds!</p>";
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