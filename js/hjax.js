function clientSideInclude(id, url) 
{
	var xml	=getxmlobj();
	xml.open("GET",url,false);
	xml.send(null);
	document.getElementById(id).innerHTML =xml.responseText;
}


function getxmlobj()
{
   var xml;
   
    try
	{
	   xml = new ActiveXObject('Msxml2.XMLHTTP');
	}
	catch(e1)
	{
	   try
	   {
	      xml = new ActiveXObject('Microsoft.XMLHTTP');
	   }
	   catch(e2)
	   {
	     xml=null;
	   }
	}

 if(!xml  && typeof 'XMLHttpRequest' != 'undefined')
 {
    xml = new XMLHttpRequest();
 }
 
 return xml;

}
