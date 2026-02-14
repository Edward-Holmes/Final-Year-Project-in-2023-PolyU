<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Verification</title>
        <link rel="icon" href="../multimedia/icon/FYP_Icon.ico" type="image/x-icon"><!--设置网页图标-->
        <link rel="stylesheet" href="../css/LoginPage.css"><!--设置页面风格-->
    </head>
    <body>
        <?php
            $email = $_POST["forgetEmail"];
            $passwd = $_POST["forgetPasswd1"];

            changePassword($email,$passwd);

            function changePassword($user_email, $new_passwd)
            {
                $server = "localhost";
                $user = "root";
                $password = "";
                $database = "Parking_System";

                //创建连接
                $conn = new mysqli($server, $user, $password, $database);
     
                //检测连接
                if ($conn->connect_error) {
                    die("Connection error: " . $conn->connect_error);
                } else {

                    $sql = "SELECT * FROM UserInfo where User_Email='$user_email'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) 
                    {
                        $sqlreset = "UPDATE UserInfo
                            SET Password='$new_passwd'
                            WHERE User_Email='$user_email'";
                        $retval = mysqli_query( $conn, $sqlreset );

                        if (!$retval)
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
                            <script language='javascript' type='text/javascript'>
                            alert(\"Successfully change your new password.\");
                            </script>
                            ";

                            $jump = '../FYP_Start Page.html';
                            echo "<script language='javascript' type='text/javascript'>";  
                            echo "setTimeout(function(){window.location.replace('". $jump ."');},1000);";
                            echo "</script>";
                        }
                    } 
                    else 
                    {
                        echo "Account does not exist. Please register. Page will jump to start page in 3 seconds!";

                        $jump = '../FYP_Start Page.html';
                        echo "<script language='javascript' type='text/javascript'>";  
                        echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                        echo "</script>";
                    }
                }

                $conn->close();
            }
        ?>

    </body>
</html>