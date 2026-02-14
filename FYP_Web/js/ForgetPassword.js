function ForgetPasswd()
{
    var forgetEmail = document.getElementById("forgetEmail").value.toString();
    var forgetPasswd1 = document.getElementById("forgetPasswd1").value.toString();
    var forgetPasswd2 = document.getElementById("forgetPasswd2").value.toString();

    var forgetInfo = document.getElementById('forget');//获取表单信息

    var info;

    if (forgetEmail.length!=0 && forgetPasswd1.length!=0 && forgetPasswd2.length!=0)
    {
        if (forgetPasswd1==forgetPasswd2)
        {
            info = null;
        }
        else
        {
            info = "The password entered twice must be the same!";
        }
    }
    else
    {
        info = "You must input your user e-mail and new password!";
    }

    if (info==null)
    {
        forgetInfo.submit();
    }
    else
    {
        window.alert(info);
    }
}