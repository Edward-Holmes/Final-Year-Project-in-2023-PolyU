function Motify()
{
    var changeName = document.getElementById("changeName").value.toString();
    var changeEmail = document.getElementById("changeEmail").value.toString();
    var changeGender = document.getElementById("changeGender").value.toString();
    var changePwd = document.getElementById("changePwd").value.toString();

    var motifyInfo = document.getElementById('motify');//获取表单信息

    if(confirm("Your info will be changed as User Name: " + changeName +
    ", E-mail: " + changeEmail +
    ", Gender: " + changeGender +
    ", Password: " + changePwd + ". If you click [Yes], the modification will take effect.")) 
    {
        //True
        motifyInfo.submit();
    } else {
        //False
        alert("This modification has been cancelled.");
    }
}