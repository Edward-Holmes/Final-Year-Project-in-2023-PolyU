function Register()
{
    var rmail = document.getElementById("email").value.toString();
    var passwd1 = document.getElementById("passwd1").value.toString();
    var passwd2 = document.getElementById("passwd2").value.toString();

    var newUserInfo = document.getElementById('formid2');//获取表单信息

    var info = null;

    if(rmail.length==0)
    {
        if (passwd1.length==0 || passwd2==0)
        {
            info = "Please input your Information!!!";
        }
        else
        {
            info = "Please input your Register E-mail!!!";
        }
    }
    else
    {
        if (passwd1.length!=0 && passwd2!=0)
        {
            if (passwd1==passwd2)
            {
                info = null;
            }
            else
            {
                info = "Please enter the same Password twice!!!";
            }
        }
        else
        {
            info = "Please input your Password twice!!!";
        }
    }

    if(info==null)
    {
        newUserInfo.submit();
    }
    else
    {
        window.alert(info);
    }
}