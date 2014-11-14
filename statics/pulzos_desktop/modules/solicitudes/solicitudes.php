<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('../../library/conexion.php');
$redirect=$_POST['redirect'];
$idInbx=$_POST['id'];
$idnN=$_POST['idNegocioNegocio'];//idNegocioNegocio-> id negocio como negocio
$idN=$_POST['idNegocioU'];//idNegocio->id Negocio como usuario
$idU=$_POST['idUsuario'];//idUsuario->Usuario a quien se va a enviar el correo
$idO=$_POST['idOferta'];
$idB=$_POST['idBonificacion'];//idBonificaion->inboxMoneyUser->usuarioMoneyID(MoneyUsuario)

if($redirect=='aceptar'){
   
    mysql_query('UPDATE inboxn SET inboxnMoneyStatus= 1, inboxnStatus=0  WHERE inboxnId='.$idInbx) or die(mysql_error());
//Insertar en Inbox tu solicitud fue exitosa
    
    $mensaje='FELICIDADES TU SOLICITUD DE BONIFICACION FUE APROBADA, MANTENTE AL PENDIENTE DEL TU DEPOSITO.';
    $asunto="Re:Solicitud de bonificación";
    $idConversacion='0';

    mysql_query('INSERT INTO inboxn (inboxnUsuarioId,inboxnUsuarioRecibeId,inboxnMensaje,inboxnAsunto,inboxnStatus,inboxnFecha,inboxnConversacionId,inboxnMoneyUser,inboxnOfertaId,inboxnMoneyStatus) values ("'.$idN.'","'.$idU.'","'.$mensaje.'","'.$asunto.'","1","'.time().'","'.$idConversacion.'","0","0","0")') or die(mysql_error());
    
    $idInbox=mysql_insert_id();
    $aleatorio=$idInbox.$idN.$idU;
    mysql_query('UPDATE inboxn SET inboxnConversacionId='.$aleatorio.' WHERE inboxnId='.$idInbox) or die (mysql_error());

    //SEND MESSAGE TO THE USER AND THE EMPLOYEE
    
/*    
//4.-Insertar en 'historialdeposito' y 'Comision recivida'
    $comision=array();
    $historial=array();
    
// ->TODA LA INFORAMCION DE MONEY_BACK SEGUN MONEY_USUARIOS 

    $qHN='SELECT * FROM money_usuario LEFT JOIN money_back ON money_usuario.usuariosMoneyBackId = money_back.moneyBackId WHERE usuarioMoneyId ='. $idB;
    $historia=$db->Execute($qHN);
    $historialN=$historia->FetchNextObj();
    
// -> CHECAR HISTORIAL DE EL NEGOCIO  
    $qhistorial='SELECT * FROM historialdeposito WHERE historialEmpresaId='.$idnN." order by idHistorial DESC limit 0, 1" ;
    $hD =& $db->Execute($qhistorial);
    $hDep = $hD->FetchNextObj();
    
//VARIABLES PARA INSERCION DE HISTORIA
    $dia = date('d');
    $mes = date('m');
    $ano = date('Y');
    $fechaTransaccion = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $fechaIni = mktime(0, 0, 0, date('m'), 1, date('Y'));
    $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
    $fechaIni1 = mktime(0, 0, 0, date('m'), 16, date('Y'));
    $fechaFin1 = mktime(0, 0, 0, date('m'), 30, date('Y'));
    
    $historial['historialEmpresaId']=$idnN;
    $historial['historialStatusDeposito']='0';
//CHECA QUE ESTE DENTRO DE 1 al 15, 16 al 30     
    if($dia >= '1' && $dia <= '15'){
        $historial['historialFechaInicio'] = $fechaIni;
        $historial['historialFechaFin'] = $fechaFin;
    }elseif($dia >= 16 && $dia <= 30){
        $historial['historialFechaInicio']=$fechaIni1;
        $historial['historialFechaFin']=$fechaFin1;
    }
    $historial['historialCodigo'] = '';
    
//GENERAR BONIFICAION "ZAVORDIGITAL"    
    $resta = $historialN->moneyMontoConsumo - $historialN->moneyBackOtorgado;
    $comisionZavor=($resta * 2.8) / 100;
    
//GENERAR NUMERO DE TRANSACCION
    $nombreN = 'SELECT * FROM negocios WHERE negocioId ='.$idnN;
    $nN=$db->Execute($nombreN);
    $n=$nN->FetchNextObj();
    $n_sinEspacio=str_replace(" ", "", $n->negocioNombre);
    $timestamp = date('dmYHis');
    $transaccion = sha1($n_sinEspacio.$timestamp);
    
//VARIABLES DE COMISION
    $comision['comisionRecibidaEmpresaId']=$idnN;
    $comision['comisionRecibidaUsuarioId']=$idU;
    $comision['comisionRecibidaFolioTransaccion']=$historialN->moneyFolioFactura;
    $comision['comisionRecibidaUsuarioBonificacion']=$historialN->moneyBackOtorgado;
    $comision['comisionRecibidaBonificacionZavor'] = $comisionZavor;
    $comision['comisionRecibidaNumeroReferencia'] = $transaccion;
    $comision['comisionRecibidaFechaTransaccion'] = $fechaTransaccion;
//CREAR CORTE EN FECHA DE LA BASE 
    $cort=explode(':', date("d:m:Y",$hDep->historialFechaFin));
 
//***CREAR REGISTRO DE HISTORIAL CUANDO NO LO HAY  
    if(empty($hDep) || $cort[1]!=$mes || $cort[2] != $ano ){
       // echo "CREAR UN NUEVO REGISTRO EN HISTORIAL X QUE EL HISTORIAL ESTA VACIO O PORQUE ES MES MAYOR O AÑO";
        
        $historial['historialTotalQuincenal'] = $historialN->moneyBackOtorgado;
        $db->AutoExecute('historialdeposito', $historial, 'INSERT');
        $comision['comisionRecibidaHistorialId'] = $db->Insert_ID();
        $db->AutoExecute('comisionrecibida', $comision, 'INSERT');
    }else{
       
        if(date("d:m:Y") >= date("d:m:Y",$hDep->historialFechaInicio) && date("d:m:Y") <= date("d:m:Y",$hDep->historialFechaFin)){
           // echo "-> ACTUALIZAR CUALQUIERA AGARRANDO DE REFERENCIA EL QUE ESTA EN INDICE<br>";
            
            $sumaAct['historialTotalQuincenal'] = $historialN->moneyBackOtorgado + $hDep->historialTotalQuincenal;
            $db->AutoExecute('historialdeposito', $sumaAct, 'UPDATE', 'idHistorial = '.$hDep->idHistorial);
            $comision['comisionRecibidaHistorialId']=$hDep->idHistorial;
            $db->AutoExecute('comisionrecibida', $comision, 'INSERT');
            
        }else if(date("d:m:Y") > date("d:m:Y",$hDep->historialFechaFin)){
           // echo "CREAR REGISTRO NUEVO (16 al 30)<br>";
            
            $historial['historialTotalQuincenal'] = $historialN->moneyBackOtorgado;
            $db->AutoExecute('historialdeposito', $historial, 'INSERT');
            $comision['comisionRecibidaHistorialId'] = $db->Insert_ID();
            $db->AutoExecute('comisionrecibida', $comision, 'INSERT');
            
        }else{
            //echo "CREAR NUEVO<br>";
            $historial['historialTotalQuincenal'] = $historialN->moneyBackOtorgado;            
            $db->AutoExecute('historialdeposito', $historial, 'INSERT'); 
            $comision['comisionRecibidaHistorialId']=$db->Insert_ID();
            $db->AutoExecute('comisionrecibida', $comision, 'INSERT');
        }
 }
    */
}else if($redirect=='declinar'){
   
    mysql_query('UPDATE inboxn SET inboxnMoneyStatus= 3, inboxnStatus=0 WHERE inboxnId='.$idInbx) or die(mysql_error());
    //Insertar en Inbox Solicitud declinada
    
    $mensaje='Lo sentimos tu solicitud de bonificación no fue aprobada.';
    $asunto="Re:Solicitud de bonificación";
    $idConversacion='0';
    
    mysql_query('INSERT INTO inboxn (inboxnUsuarioId,inboxnUsuarioRecibeId,inboxnMensaje,inboxnAsunto,inboxnStatus,inboxnFecha,inboxnConversacionId,inboxnMoneyUser,inboxnOfertaId,inboxnMoneyStatus) values ("'.$idN.'","'.$idU.'","'.$mensaje.'","'.$asunto.'","1","'.time().'","'.$idConversacion.'","0","0","0")') or die(mysql_error());
    
    $idInbox=mysql_insert_id();
    $aleatorio=$idInbox.$idN.$idU;
    mysql_query('UPDATE inboxn SET inboxnConversacionId='.$aleatorio.' WHERE inboxnId='.$idInbox) or die (mysql_error());

    //SEND EMAIL
    $from2 = 'mauricio@zavordigital.com';
    $subject2 = 'Se ha rechazado una solicitud de bonificacion.';
    $message2 = 'Se ha rechazado una solicitud de bonificacion.';
    $headers2 = 'MIME-Version: 1.0' . "\r\n";
    $headers2.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers2.= 'From: Pulzos <atencion@pulzos.com>' . "\r\n";
    mail($from2, $subject2, $message2, $headers2); 
}
?>
