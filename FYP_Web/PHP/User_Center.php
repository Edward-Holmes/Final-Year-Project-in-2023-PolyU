<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Welcome <?php echo $_COOKIE["uname"]?></title>
        <link rel="icon" href="../multimedia/icon/FYP_Icon.ico" type="image/x-icon"><!--设置网页图标-->
        <link rel="stylesheet" href="../css/reset.min.css"><!--设置页面基本风格-->
        <link rel="stylesheet" href="../css/style.css"><!--设置页面风格-->
        <link rel="stylesheet" href="../css/font.css"><!--设置自定义字体-->
        <link rel="stylesheet" href="../css/imageStyle.css"><!--设置自定义字体-->

        <script src="../js/MotifyTest.js" type="text/javascript"></script><!--修改信息检测函数-->
        <script src="../js/ReservationTest.js" type="text/javascript"></script><!--预约检测函数-->

        <!--响应式布局-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/centerStyle.css">

        <!--设置表格格式-->
        <link rel="stylesheet" type="text/css" href="../css/tableStyle.css">
    </head>

    <style type="text/css">/*定义页面字体*/
        li {
            font-family: cyberHead;
            color:#FF0000
            font-size: 200px
        }

        th, td, p {
            font-family: cyberInput;
            color:#FFFFFF
            font-size: 60px
            text-align:center;
        }

        h3, .centerbtn {
            font-family: cyberBtn;
            color:#FFFFFF
        }

    </style>

    <body>
        
    <?php
            $server = "localhost";
            $user = "root";
            $password = "";
            $database = "Parking_System";

            $email = $_COOKIE["uemail"];
            $passwd = $_COOKIE["upassword"];

            $expire=time()+60*60*24*30;
     
            //创建连接
            $conn = new mysqli($server, $user, $password, $database);
     
            //检测连接
            if ($conn->connect_error) {
                die("Connection error: " . $conn->connect_error);
            } else {
                $userInfo = "SELECT * FROM UserInfo where User_Email='$email'";
                $userInfoResult = $conn->query($userInfo);

                if ($userInfoResult->num_rows > 0) 
                {
                    //输出数据
                    while($userInformation = $userInfoResult->fetch_assoc())
                    {
                        if ($userInformation["Password"] == $passwd) {
                            if($userInformation["Uid"] == 100000000){
                                $stateTitle = 'Special Status';
                                $state = 'Super User';
                                $parkingTimeTitle = 'All User Parking Time';

                                $yourUID = $userInformation["Uid"];
                                setcookie("uid", $yourUID, $expire);
                                $parkingInfo = "SELECT * FROM ParkingRec";
                                $parkingInfoResult = $conn->query($parkingInfo);
                            }
                            else{
                                $stateTitle = 'Parking State';
                                if($userInformation["Pre_Start_Time"]==NULL){
                                    $state = 'Not Parking';
                                } else {
                                    $state = 'Parking';
                                }
                                $parkingTimeTitle = 'Parking Time';

                                $yourUID = $userInformation["Uid"];
                                setcookie("uid", $yourUID, $expire);
                                $parkingInfo = "SELECT * FROM ParkingRec where Uid='$yourUID'";
                                $parkingInfoResult = $conn->query($parkingInfo);
                        }

                        if ($parkingInfoResult->num_rows > 0) {
                        //输出数据
                            $parkingTime = $parkingInfoResult->num_rows;
                        } else {
                            $parkingTime = 0;
                        }


                    echo "
                    <div class='div1'>
                        <!--背景鼠标跟随特效函数-->
                        <script src='../js/script.js'></script>
                    </div>";
                    
                    echo "
                    <div class='div2'>
                        <div class='demo'>
                            <div class='container'>
                                <div class='row'>
                                    <div class='col-md-offset-2 col-md-8'>
                                        <div class='tab' role='tabpanel'>
                                            <!-- Nav tabs -->
                                            <ul class='nav nav-tabs' role='tablist'>
                                                <li role='presentation' class='active'><a href='#Section1' aria-controls='home' role='tab' data-toggle='tab'><i class='fa fa-user'></i>User Info</a></li>
                                                <li role='presentation'><a href='#Section2' aria-controls='profile' role='tab' data-toggle='tab'><i class='fa fa-pencil'></i>Modify Info</a></li>
                                                <li role='presentation'><a href='#Section3' aria-controls='messages' role='tab' data-toggle='tab'><i class='fa fa-car'></i>Parking Info</a></li>
                                                <li role='presentation'><a href='#Section4' aria-controls='messages' role='tab' data-toggle='tab'><i class='fa fa-comment'></i>Reservation</a></li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class='tab-content tabs'>";

                    echo "
                                                <div role='tabpanel' class='tab-pane fade in active' id='Section1'>
                                                    <h3>User Information</h3>
                                                    <img src='../multimedia/UserImage/" . $userInformation["Profile_Image"] . "' class='round_icon'  alt='Your Profile Photo is Missing!'>
                                                    <table>
                                                        <tr>
                                                            <th width='70%'>UID</th>
                                                            <td>" . $userInformation["Uid"] . "</td>                                                 
                                                        </tr>
                                                        <tr>
                                                            <th width='70%'>User Name</th>
                                                            <td>" . $userInformation["User_Name"] . "</td>
                                                        </tr>
                                                        <tr>
                                                            <th width='70%'>E-mail</th>
                                                            <td>" . $userInformation["User_Email"] . "</td>
                                                        </tr>
                                                        <tr>
                                                            <th width='70%'>Gender</th>
                                                            <td>" . $userInformation["Gender"] . "</td>
                                                        </tr>
                                                        <tr>
                                                            <th width='70%'>" . $stateTitle . "</th>
                                                            <td>" . $state . "</td>
                                                        </tr>
                                                        <tr>
                                                            <th width='70%'>". $parkingTimeTitle ."</th>
                                                            <td>" . $parkingTime . "</td>
                                                        </tr>
                                                    </table>
                                                </div>";

                    echo "
                                                <div role='tabpanel' class='tab-pane fade' id='Section2'>
                                                    <h3>Modify Your Information</h3>
                                                    <img src='../multimedia/UserImage/" . $userInformation["Profile_Image"] . "' class='round_icon'  alt='Your Profile Photo is Missing!'>
                                                    <form action='../PHP/Motify.php' method='post' id='motify'>
                                                        <table>
                                                            <tr>
                                                                <th width='70%'>User Name</th>
                                                                <td>
                                                                    <input type='text' style='color: #000000;' value='" . $userInformation["User_Name"] . "' placeholder='" . $userInformation["User_Name"] . "' id='changeName' name='changeName' maxlength='32'>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width='70%'>E-mail</th>
                                                                <td>
                                                                    <input type='text' style='color: #000000;' value='" . $userInformation["User_Email"] . "' placeholder='" . $userInformation["User_Email"] . "' id='changeEmail' name='changeEmail' maxlength='32'>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width='70%'>Gender</th>
                                                                <td>
                                                                    <select style='color: #000000;' id='changeGender' name='changeGender'>
                                                                        <option value='" . $userInformation["Gender"] . "' selected hidden>" . $userInformation["Gender"] . "</option>
                                                                        <option value='Secret'>Secret</option>
                                                                        <option value='Male'>Male</option>
                                                                        <option value='Female'>Female</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            <th width='70%'>Password</th>
                                                            <td>
                                                                <input type='password' style='color: #000000;' value='" . $userInformation["Password"] . "' placeholder='Password' id='changePwd' name='changePwd' maxlength='15'>
                                                            </td>
                                                            </tr>
                                                        </table>
                                                        <br>
                                                        <input type='button' onclick='Motify()' value='Motify Now' class='centerbtn'>
                                                    </form>
                                                </div>";

                    echo "
                                                <div role='tabpanel' class='tab-pane fade' id='Section3'>
                                                    <h3>Parking Information</h3>
                                                    <img src='../multimedia/UserImage/". $userInformation["Profile_Image"] ."' class='round_icon'  alt='Your Profile Photo is Missing!'>
                                                    <h3>Current situation</h3>
                                                    <table class='showInfo'>
                                                        <tr>
                                                            <th>License</th>
                                                            <th>Appointment Start Time</th>
                                                            <th>Appointment End Time</th>
                                                            <th>Start Time</th>
                                                            <th>Parking Lot</th>                                                
                                                        </tr>
                                                        <tr>";
                    if ($userInformation["This_License"]==NULL){
                        $license = "Not Booked Yet";
                    } else {
                        $license = $userInformation["This_License"];
                    }

                    if ($userInformation["Pre_S_Time"]==NULL){
                        $pstime = "Not Booked Yet";
                    } else {
                        $pstime = $userInformation["Pre_S_Time"];
                    }

                    if ($userInformation["Pre_E_Time"]==NULL){
                        $petime = "Not Booked Yet";
                    } else {
                        $petime = $userInformation["Pre_E_Time"];
                    }

                    if ($userInformation["S_Time"]==NULL){
                        $stime = "Not Parked Yet";
                    } else {
                        $stime = $userInformation["S_Time"];
                    }

                    if ($userInformation["P_Lot"]==NULL){
                        $plot = "Not Parked Yet";
                    } else {
                        $plot = $userInformation["P_Lot"];
                    }
                    echo "
                                                            <td>". $license ."</td>
                                                            <td>". $pstime ."</td>
                                                            <td>". $petime ."</td>
                                                            <td>". $stime ."</td>
                                                            <td>". $plot ."</td>
                                                        </tr>
                                                    </table>
                                                    <br><br>";
                    if ($userInformation["Uid"] == 100000000) {
                        echo "
                                                    <h3>All User Parking History</h3>
                                                    <table  class='showInfo'>
                                                        <tr>
                                                            <th>UID</th>
                                                            <th>Car License Plate</th>
                                                            <th>Appointment Start Time</th>
                                                            <th>Appointment End Time</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Parking Lot</th>                                                
                                                        </tr>";

                                                        while ($parkingInformation = mysqli_fetch_array($parkingInfoResult, MYSQLI_ASSOC))
                                                        {
                                                            echo "
                                                        <tr>
                                                            <td>".$parkingInformation['Uid']."</td>
                                                            <td>".$parkingInformation['License']."</td>
                                                            <td>".$parkingInformation['Pre_Start_Time']."</td>
                                                            <td>".$parkingInformation['Pre_End_Time']."</td>
                                                            <td>".$parkingInformation['Start_Time']."</td>
                                                            <td>".$parkingInformation['End_Time']."</td>
                                                            <td>".$parkingInformation['Parking_Lot']."</td>
                                                        </tr>
                                                            ";
                                                        }
                    } else {
                        echo "
                                                    <h3>Your Parking History</h3>
                                                    <table  class='showInfo'>
                                                        <tr>
                                                            <th>Car License Plate</th>
                                                            <th>Appointment Start Time</th>
                                                            <th>Appointment End Time</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Parking Lot</th>                                                
                                                        </tr>";

                                                        while ($parkingInformation = mysqli_fetch_array($parkingInfoResult, MYSQLI_ASSOC))
                                                        {
                                                            echo "
                                                        <tr>
                                                            <td>".$parkingInformation['License']."</td>
                                                            <td>".$parkingInformation['Pre_Start_Time']."</td>
                                                            <td>".$parkingInformation['Pre_End_Time']."</td>
                                                            <td>".$parkingInformation['Start_Time']."</td>
                                                            <td>".$parkingInformation['End_Time']."</td>
                                                            <td>".$parkingInformation['Parking_Lot']."</td>
                                                        </tr>
                                                            ";
                                                        }
                    }

                    echo "                                    
                                                    </table>
                                                </div>
                                                ";

                    echo "
                                                <div role='tabpanel' class='tab-pane fade' id='Section4'>
                                                    <h3>Reservation</h3>
                                                    <form action='../PHP/Reservation.php' method='post' id='reservation'>
                                                        <table>
                                                            <tr>
                                                                <th width='70%'>Reservation Start Time</th>
                                                                <td>
                                                                    <input type='datetime-local' style='color: #000000;' min='". date('Y-m-d H:i:s') ."' id='p-s-time' name='p-s-time' step='1' value='" .date('Y-m-d H:i:s'). "'>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width='70%'>Reservation End Time</th>
                                                                <td>
                                                                    <input type='datetime-local' style='color: #000000;' min='". date('Y-m-d H:i:s') ."' id='p-e-time' name='p-e-time' step='1' value='". date('Y-m-d H:i:s') ."'>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width='70%'>Car License Plate</th>
                                                                <td>
                                                                <input type='text' style='color: #000000;' ' placeholder='京A00000' id='license' name='license' maxlength='8'>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <br>
                                                        <input type='button' onclick='Reservation()' value='Reserve Now' class='centerbtn'>
                                                    </form>
                                                    <p></p>
                                                    <br><br>
                                                    <h3>Reservation Rules</h3>
                                                        <p>1. It's best to make an reservation an hour in advance;<br>
                                                           2. The reservation start time <b style='color: #FF0000;'><u>must</u></b> be before the current time;<br>
                                                           3. The reservation start time <b style='color: #FF0000;'><u>must</u></b> be before the reservation end time;<br>
                                                           4. The car license plate <b style='color: #FF0000;'><u>must</u></b> be filled in!
                                                        </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <script src='../js/jquery-2.1.1.min.js' type='text/javascript'></script>
                        <script src='../js/bootstrap.min.js' type='text/javascript'></script>
                    </div>";
                    
                    echo "
                            <!--自动运行背景音乐-->
                            <audio id='bgm' src='../multimedia/audio/Wuthering Waves.mp3' controls='controls' autoplay loop='true' hidden='true'/> 
                            ";
                        } else {
                            echo "<p style='color: #000000;'>" .$userInformation["Password"]. "Error code 01. The authentication of identity module fails. The page will skip after 3 seconds. Please log in again.</p>";
                            $jump = '../FYP_Start Page.html';
                            echo "<script language='javascript' type='text/javascript'>";  
                            echo "setTimeout(function(){window.location.replace('". $jump ."');},3000);";
                            echo "</script>";
                        }
                    }
                }
                else
                {
                    echo "<p style='color: #000000;'>Error code 02. The authentication of identity module fails. The page will skip after 3 seconds. Please log in again.</p>";
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