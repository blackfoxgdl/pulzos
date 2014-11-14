<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pulzos</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<link href="css/jquery.ui.css" rel="stylesheet" type="text/css"/>
</head>
<!--<body onresize="window.resizeTo(700,600);">-->
<body>
<div id="alertas"></div>
<div id="imagen"></div>
<?php
//if(isset($_REQUEST['desktop'])){ ?>
    <div id="pulzar" style="text-align: center;margin-top:10%;margin-bottom: 10%;display:none;">
        <form id="formUser" action="library/ingreso.php" method="post">
            <div style="margin-left: auto;margin-right:auto">
                <br/>
                <div class="inputTxt redondeo " style="margin-left: auto;margin-right: auto;">
                    <input class="input_index " name="email" type="text" id="email" placeholder="Email:"  />
                </div>
                <br/>
                <br/>
                <div class="inputTxt redondeo" style="margin-left: auto;margin-right: auto;">
                    <input class="input_index" name="pass" type="password" id="pass" placeholder="Password" style="width:192px;margin-top:2px"   />
                </div>
                <br/>
                <br/>
                    <input id="ingresar" type="submit" value="Login" /><br />
            </div>
        </form>
    </div>
<?php
/*
}else{
    header('Location:http://www.pulzos.com');
}*/
?>
</body>
</html>