<?php 
//DIV 3 
/*for($i = 1; $i <= 100; $i++)
{
    if($i % 3 == 0)
    {
        echo $i . '<br />';
    }
    $i++;
}*/

$a = 0;
$b = 1;
$d = 1;
$c = 0;
echo $b . '<br />';
while($d <= 10)
{
    $c = $a + $b;
    echo $c . '<br />';
    $a = $b;
    $b = $c;
    $d++;
}

/*$c1 = "./statucs/asdas/sdf.jpg";
$var = substr($c1, 2);
echo $var;
/*$para = 'ruben@zavordigital.com';
$titulo = 'hola';
$message = '<strong>
                hola
                </strong>';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers.= 'To: ' . $r['correo'] . "\r\n";
$headers.= 'From: Pulzos <atencion@pulzos.com>' . "\r\n";
mail($para, $titulo, $message, $headers);
/*
<html>
<head>
<script type="text/javascript">
function loadXMLDoc()
{
var xmlhttp;
if (window.XMLHttpRequest)
 {// code for IE7+, Firefox, Chrome, Opera, Safari
 xmlhttp=new XMLHttpRequest();
 }
else
 {// code for IE6, IE5
 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 }

xmlhttp.onload=function()//onreadystatechange=function()
 {
alert(xmlhttp.readyState);
 if (xmlhttp.readyState==4) //&& xmlhttp.status==200)
   {
       alert('esta putada truena aqui');
       alert(xmlhttp.responseText);
     document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
   }
 }

xmlhttp.open("GET","http://www.pulzos.com/inicio.php/mapas/prueba_dos", true);
xmlhttp.send(null);

}
</script>
</head>
<body>

<div id="myDiv"><h2>Let AJAX change this text</h2></div>
<button type="button" onclick="loadXMLDoc()">Change Content</button>

</body>
</html>*/
