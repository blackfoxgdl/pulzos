<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('conexion.php');
$idN=$_REQUEST['idNegocio'];
$idU=$_REQUEST['usuarioId'];
$email=$_REQUEST['email'];
$folio=$_REQUEST['folio'];
$monto=$_REQUEST['monto'];
$bonificacion=$_REQUEST['bonificacion'];


//**Obtener datos de la empresa y sus ofertas mediante su Id
$nombreNegocio=mysql_query("SELECT * FROM negocios LEFT JOIN ofertas_negocios ON negocios.negocioId = ofertas_negocios.idNegocioOferta WHERE idNegocioOferta =".$idN);
$negocio=mysql_fetch_array($nombreNegocio);

//1.-insertar en money back
mysql_query('INSERT INTO money_back (moneyNegocioId,moneyUsuarioEmail,moneyFolioFactura,moneyMontoConsumo,moneyBackOtorgado,moneyCategoriaDescuento) 
                                values ("'.$idN.'","'.$email.'","'.$folio.'","'.$monto.'","'.$bonificacion.'","todo,")') or die(mysql_error());
$idMoneyBack=mysql_insert_id();

//2.-insercion de money Usuario
mysql_query('INSERT INTO money_usuario (usuarioMoneyUsuarioId,usuarioMoneyTotal,usuarioMoneyStatus,usuariosMoneyBackId) values ("'.$idU.'","'.$bonificacion.'","0","'.$idMoneyBack.'")')or die (mysql_error());
$idMoneyUsuario=mysql_insert_id();

//3.-envio de mensaje al usuario de su bonificacion
$msjSelec=mysql_query('SELECT * FROM social_media_empresa where socialEmpresaUsuarioId = '.$idN) or die (mysql_error());
$socialMedia=mysql_fetch_array($msjSelec);
var_dump($socialMedia);
$mensajeRedSocial=array(); 
        if($socialMedia['mensajeFacebook']!=''){
            $mensajeRedSocial['1']='Facebook:  '.$socialMedia['mensajeFacebook'];
        }
        if($socialMedia['mensajeTwitter']!=''){
            $mensajeRedSocial['2']='Twitter:  '.$socialMedia['mensajeTwitter'];
        }
        if($socialMedia['mensajePulzos']!=''){
            $mensajeRedSocial['3']='Pulzos:  '.$socialMedia['mensajePulzos'];
        }
        
$mensaje="<strong>Has solicitado una bonificacion en:</strong><br> 
    Lugar:<strong> ".$negocio['negocioNombre']."</strong><br> 
    Folio: <strong> ".$folio."</strong> 
    Monto consumido:<strong> $ ".$monto." Pesos </strong><br> 
    Bonificacion:<strong> $ ".$bonificacion." Pesos</strong>
    Se publicará el siguiente mensaje en tus redes sociales:<br><br>".implode("<br>",$mensajeRedSocial);
$asunto="Solicitud de bonificacion";
$idConversacion='0';
mysql_query('INSERT INTO inboxn (inboxnUsuarioId,inboxnUsuarioRecibeId,inboxnMensaje,inboxnAsunto,inboxnStatus,inboxnFecha,inboxnConversacionId,inboxnMoneyUser,inboxnOfertaId,inboxnMoneyStatus) values ("'.$negocio['negocioUsuarioId'].'","'.$idU.'","'.$mensaje.'","'.$asunto.'","1","'.time().'","'.$idConversacion.'","'.$idMoneyUsuario.'","'.$negocio['ofertaId'].'","2")') or die(mysql_error());
$idInbox=mysql_insert_id();
$aleatorio=$idInbox.$idN.$idU;
mysql_query('UPDATE inboxn SET inboxnConversacionId='.$aleatorio.' WHERE inboxnId='.$idInbox) or die(mysql_error());
?>
