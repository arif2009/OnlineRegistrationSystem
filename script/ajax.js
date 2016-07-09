//select adviser using selecting department
function showAdviser(str)
{
	/*if (str=="")
  	{
  		document.getElementById("txtHint").innerHTML="";
  		return;
  	}*/
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	/*xmlhttp.onreadystatechange=function()
  	{
 		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
    		document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    	}
  	}*/
	//xmlhttp.open("GET","../database/selectadv.php?deptid="+str,true);
        xmlhttp.open("GET","http://localhost/OnlineRegistrationSystem/register/GetAllAdviser",true);
	xmlhttp.send(null);
}