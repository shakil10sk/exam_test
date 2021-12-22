function GetXmlHttpObject(handler)
{
   var objXMLHttp=null
   if (window.XMLHttpRequest)
   {
       objXMLHttp=new XMLHttpRequest()
   }
   else if (window.ActiveXObject)
   {
       objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
   }
   return objXMLHttp
}

function stateChanged()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtResult").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}

// Will populate data based on input
function htmlData(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtResult").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=stateChanged;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}

//clientsdata;

function pType()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("slip").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}

function slip(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("slip").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=pType;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}

//warish data;

function wType()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           //document.getElementById("warish").innerHTML= xmlHttp.responseText;
		   alert(xmlHttp.responseText);
   }
   else {
          // alert(xmlHttp.status);
   }
}
function winfo(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("warish").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=wType;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}
//delete warish data;

function delType()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           //document.getElementById("wdel").innerHTML= xmlHttp.responseText;
		   
		   alert(xmlHttp.responseText);
		   
   }
   else {
          // alert(xmlHttp.status);
   }
}
function wDel(url, qStr)
{
var x=confirm('Are You Want to Delete Now?');
if(x){
   if (url.length==0)
   {
       document.getElementById("delinfo").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=delType;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
   }

   else {return false;}
}

//fund with category;

function changeFund()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("fund").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function htmlFund(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("fund").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=changeFund;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}


//sub category  name
function changsCategory()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("scat").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function sCategory(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("scat").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=changsCategory;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}


//sub category2  name
function changsCategory2()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("scat2").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function sCategory2(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("scat2").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=changsCategory2;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}


//sub category3  name
function changsCategory3()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("scat3").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function sCategory3(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("scat3").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=changsCategory3;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}


//sub category4  name
function changsCategory4()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("scat4").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function sCategory4(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("scat4").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=changsCategory4;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}



//sub category5 name
function changsCategory5()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("scat5").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function sCategory5(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("scat5").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=changsCategory5;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}



//add warish info;

function addwr()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
              document.getElementById("txtwr").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function addinfo(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtwr").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=addwr;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}

function addwr2()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
              document.getElementById("txtwr2").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}

function addinfo2(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtwr2").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=addwr2;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}


function addslip()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
              document.getElementById("sslip").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}

function slip2(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("sslip").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=addslip;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}


function addwr3()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
              document.getElementById("txtResult2").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}

function acData(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtResult2").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=addwr3;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}


function addwr4()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
              document.getElementById("sscat").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}

function sCategory2(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("sscat").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=addwr4;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}



//existing birth certificate no check
function eBcno()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtBcno").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function bCno(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtBcno").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=eBcno;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}


function phoneChange()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtPhone").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function sPhone(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtPhone").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=phoneChange;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}
//clientsdata;

function cChange()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtTotal").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function Ctotal(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtTotal").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=cChange;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}


function cDis()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtBill").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
function cDiscount(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtBill").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=cDis;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}

//IP Address Add

function ipChanged()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("ipResult").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}

// Will populate data based on input
function ipData(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("ipResult").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=ipChanged;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}
function RsChanged()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("RsData").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}

// Will populate data based on input
function RsData(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("RsData").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }

   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=RsChanged;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}
