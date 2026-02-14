function Reservation()
{
    var pstime = document.getElementById("p-s-time").value;
    var petime = document.getElementById("p-e-time").value;
    var license = document.getElementById("license").value.toString();

    var reservationInfo = document.getElementById('reservation');//获取表单信息

    var info = null;

    if(pstime<petime)
    {
        if(license.length<7)
        {
            info = "Car License Plate is illegal. Please carefully read the Reservation Rules below!";
        }
        else
        {
            info = null;
        }
    }
    else
    {
        if(license.length<7)
        {
            info = "Reservation Time and Car License Plate are illegal. Please carefully read the Reservation Rules below!";
        }
        else
        {
            info = "Reservation Time is illegal. Please carefully read the Reservation Rules below!";
        }
    }

    if(info==null)
    {
        reservationInfo.submit();
    }
    else
    {
        window.alert(info);
    }
}