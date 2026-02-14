function Login()
{
    var Email = document.getElementById("E-mail").value.toString();
    var password = document.getElementById("passwd").value.toString();

    var userInfo = document.getElementById('formid1');//获取表单信息

    var info = null;

    if(Email.length==0 && password.length==0)
    {
      info = "Please input your E-mail and Password!!!";
    }
    else if(Email.length!=0 && password.length==0)
    {
      info = "Please input your Password!!!";
    }
    else if(Email.length==0 && password.length!=0)
    {
      info = "Please input your E-mail!!!";
    }
    else
    {
      info = null;
    }

    if(info==null)
    {
      userInfo.submit();
    }
    else
    {
      window.alert(info);
    }
}