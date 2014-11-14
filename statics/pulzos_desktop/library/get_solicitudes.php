<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include ('conexion.php');
$idNegocio=$_GET['idNegocio'];
$inbxn=$db->Execute('SELECT inboxn.* FROM inboxn LEFT JOIN negocios ON inboxn.inboxnUsuarioRecibeId = negocios.negocioUsuarioId WHERE negocioId ='.$idNegocio.' ORDER BY inboxnId DESC');
//$inbxn=mysql_query('SELECT inboxn.* FROM inboxn LEFT JOIN negocios ON inboxn.inboxnUsuarioRecibeId = negocios.negocioUsuarioId WHERE negocioId ='.$idNegocio.' ORDER BY inboxnId DESC') or die (mysql_error());
while($inboxS=$inbxn->FetchNextObj()){
//while($inboxS=mysql_fetch_array($inbxn)){

    if($inboxS->inboxnMoneyStatus =='2'){
    echo ' 
        <div style="margin-top:1%;margin-bottom:35px">
            <div style="width:225px;height:70px;margin-left:auto;margin-right:auto;">'
                .$inboxS->inboxnMensaje.'<br>
            </div>

            <div id="desicion" style="margin-bottom:5px;width:500px;height:50px;margin-left:auto;margin-right:auto;">
                    <div id="aceptar'.$inboxS->inboxnId.'" class="redondeo-menu"  style="color:white;text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px;margin-left:35%;margin-top:20px;margin-right:20%" onclick="aceptar(event,'.$inboxS->inboxnId.','.$inboxS->inboxnUsuarioId.','.$inboxS->inboxnOfertaId.','.$inboxS->inboxnMoneyUser.');">
                        Aceptar
                    </div>

                    <div id="declinar'.$inboxS->inboxnId.'" class="redondeo-menu"  style="color:white;text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px;margin-left:50%;margin-top:-20px" onclick="declinar(event,'.$inboxS->inboxnId.','.$inboxS->inboxnUsuarioId.','.$inboxS->inboxnOfertaId.','.$inboxS->inboxnMoneyUser.');">
                        Declinar
                    </div>
                    <div style="border-bottom: 1px solid #DFCBDF;margin-top:20px;"></div>
             </div>    
        </div>';
    }else if($inboxS->inboxnMoneyStatus=='1'){
        echo '
            <div style="margin-top:1%;margin-bottom: 35px">
                <div style="width:225px;height:70px;margin-left:auto;margin-right:auto">'
                    .$inboxS->inboxnMensaje.'<br>
                </div>
                <div id="aceptar" class="redondeo-menu"  style="color:white;text-align:center;background-color:#339900 ;width:70px;height:20px;margin-left:45%;margin-top:20px;margin-right:20%">
                            Aceptada
                </div> 
            </div>';
    }else if($inboxS->inboxnMoneyStatus=='3'){
        echo '
            <div style="margin-top:1%;margin-bottom: 35px">
                <div style="width:225px;height:70px;margin-left:auto;margin-right:auto">'
                    .$inboxS->inboxnMensaje.'<br>
                </div>
                <div id="declinar" class="redondeo-menu"  style="color:white;text-align:center;background-color: #D10D00 ;width:70px;height:20px;margin-left:45%;margin-top:20px" >
                            Declinada
                </div> 
            </div>';
    }
}

?>

<body>
</body>
</html>