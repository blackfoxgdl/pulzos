<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pulzos</title>

<script type="text/javascript" src="js/desktop.js" ></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript" src="js/getConector.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.min.js"></script>
<script type="text/javascript" src="js/selectMenu.js"></script>
<script type="text/javascript" src="js/jpulzo.js"></script>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/loader.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ui.css" rel="stylesheet" type="text/css" /> 
<link href="css/selectmenu.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function(){
    inicioA();
});

</script>
<?php 

if(isset($_REQUEST['negocioId'])){
	$_SESSION['login']=$_REQUEST['negocioId'];
        $idUsuario=$_REQUEST['negocioUsuarioId'];
        $idMostrador=$_REQUEST['idMostrador'];
}else{
	header('http://www.pulzos.com/statics/pulzos_desktop/index.php');
	//header('Location:http://localhost/pulzos/statics/pulzos_desktop/index.php');
} ?>
</head>

<body>
<input type='hidden' id='negocioId' value='<?php echo $_SESSION['login']; ?>' />
<input type='hidden' id='negocioUsuario' value='<?php echo $idUsuario; ?>' />
<input type="hidden" id="mostradorId" value="<?php echo $idMostrador; ?>" />
<div id="alertas" ></div>
<div id="imagen" title="Inicio" style="cursor: pointer;" onclick="inicioA();"></div>
<div id="contenido"></div>
<div  id="getHome" class="menu-lateral" onmouseover="menuP('over')" onmouseout="menuP('out')" onclick="menuP('click')">
        <img src="img/pulzos-home.png" id="menu-Home" style="cursor: pointer" />
</div>
</body>
</html>