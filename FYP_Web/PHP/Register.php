<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Registering...</title>
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

            $email = $_POST["email"];
            $passwd = $_POST["passwd1"];
     
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
                    echo "<p>The email has already been registered! Page will jump to start page in 3 seconds!</p>";
                    //延迟跳转
                    $jump = '../FYP_Start Page.html';
                    echo "<script language='javascript' type='text/javascript'>";  
                    echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                    echo "</script>";
                } 
                else 
                {
                    $sql2 = "SELECT * FROM UserInfo";
                    $result2 = $conn->query($sql2);
                    $userNum = $result2->num_rows;

                    $newUid = 100000000 + $userNum;

                    $sql3 = "INSERT INTO UserInfo (Uid, User_Email, Password)
                    VALUES ('$newUid', '$email', '$passwd')";

                    if ($conn->query($sql3) === TRUE) {
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
                            alert(\"Successful registration! After clicking the [OK] button, page will jump to Login Page in 3 seconds! And then you can login with your Info.\");
                        </script>
                        ";

                    $jump = '../FYP_Start Page.html';
                    echo "<script language='javascript' type='text/javascript'>";  
                    echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                    echo "</script>";
                    } else {
                        echo "
                        <script language='javascript' type='text/javascript'>
                            alert(\"Successful registration! After clicking the [OK] button, page will jump to Login Page in 3 seconds! And then you can login with your Info.\");
                        </script>";

                        $jump = '../FYP_Start Page.html';
                        echo "<script language='javascript' type='text/javascript'>";  
                        echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                        echo "</script>";
                    }
                }
            }

            $conn->close();
        ?>

    </body>
</html>