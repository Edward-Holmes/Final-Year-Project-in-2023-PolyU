<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Motifying...</title>
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

            $uid = $_COOKIE["uid"];

            $changeName = $_POST["changeName"];
            $changeEmail = $_POST["changeEmail"];
            $changeGender = $_POST["changeGender"];
            $changePwd = $_POST["changePwd"];
     
            //创建连接
            $conn = new mysqli($server, $user, $password);
     
            //检测连接
            if ($conn->connect_error) {
                die("Connection error: " . $conn->connect_error);
            } else {
                $sqlTest = "SELECT * FROM UserInfo where User_Email='$changeEmail'";
                mysqli_select_db( $conn, $database);
                $testResult = $conn->query($sqlTest);
            
                if ($testResult->num_rows > 0) {
                    while ($testRow = $testResult->fetch_assoc()) {
                        if ($testRow["Uid"]==$uid) {
                            $testBool = true;
                        } else {
                            $testBool = false;
                            $retval = false;
                        }
                    }
            } else {
                $testBool = true;
            }

                if ($uid!=null)
                {
                    if ($testBool){
                        mysqli_query($conn , "set names utf8");
                        $sql = "UPDATE UserInfo
                            SET User_Email='$changeEmail', User_Name='$changeName', Password='$changePwd', Gender='$changeGender'
                            WHERE Uid='$uid'";
                        $retval = mysqli_query( $conn, $sql );
                    }

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
                            alert(\"Successfully get your new Identity Information. User Name: " .$changeName. ", E-mail: " .$changeEmail. ", Gender: " .$changeGender. ", and Password: " .$changePwd. ". Information updated successfully, after clicking the [OK] button, page will jump to Login Page in 3 seconds! And then you can login with your new Info.\");
                        </script>
                        ";

                        $jump = '../FYP_Start Page.html';
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