<?php
/*
 * para procesos de bonificacion de algun usuario 
 * en la aplicacion de escritorio
 * 
 * ->Reutiliza los procesos para cuando algun empleado realiza
 *   la bonificacion cambiando los valores del _Request
 *   Generando un proceso similar al del usuario 
 * 
 */
include('../../library/conexion.php');
require_once('../../library/emails_desktop.php');
//Si bonifica el empleado
        if(isset($_GET['data'])){
            $empleadoT=true;
        /*CAMBIAR VALORES DE OFERTA Y MONTOS CONSUMIDOS NADA MAS!!!!!! */

            $_REQUEST=json_decode($_GET['data'], true);
           
            $montoEmpleado = array();

            //DINERO asignado para ZavorDigital
            $dineroZavor=($_REQUEST['monto']*2.8)/100;
            //Dinero asignado para Empleado
            $dineroEmpleado=($dineroZavor*5)/100;

            $total_sin_iva = $_REQUEST['monto'] - $_REQUEST['iva'];
        //INSERTAR en tabla -Bonificacion_empleado    
            $bEmpleado=array(
                'id_usuarioMostrador'=>$_REQUEST['idusuarios_mostrador'],
                'folio'=>$_REQUEST['folio'],
                'fecha_hora'=>date('d/m/Y h:i:s'),
                'monto_consumido'=>$_REQUEST['monto'],
                'monto_bonificacion'=>$_REQUEST['bonificacion']
            );
            $db->AutoExecute('bonificacion_empleados', $bEmpleado, 'INSERT') or die(mysql_error());

        //REASIGNAR Variables a las del empleado
            //cambio de @idUsuario
            $_REQUEST['idUsuarioPulzos']=$_REQUEST['idusuariopulzos'];
            $_REQUEST['usuarioId']=$_REQUEST['idUsuarioPulzos'];
            //cambio de @empleado
            $_REQUEST['empleado']='nada';
            //cambio de @email
            $ma=$db->Execute('SELECT * FROM usuarios WHERE id = '.$_REQUEST['usuarioId']); $mto=$ma->FetchNextObj();

            $_REQUEST['email'] = $mto->email;
            //cambio de @folio
            $_REQUEST['folio']='E-'.$_REQUEST['folio'];
            //destruccion de variable idEmpleado
            unset($_REQUEST['idEmpleado']);
        //    echo "Variables convertidas al empleado";
        //    var_dump($_REQUEST);

        //Insertar -HistorialDeposito
        $dia = date('d');
            if($dia >= 0 && $dia <= 15){
                $fechaInicio = mktime(0, 0, 0, date('m'), 1, date('Y'));
                $fechaFin = mktime(0, 0, 0, date('m'), 15, date('Y'));
            }elseif($dia >= 16 && $dia <=30){
                $fechaInicio = mktime(0, 0, 0, date('m'), 16, date('Y'));
                $fechaFin = mktime(0, 0, 0, date('m'), 30, date('Y'));
            }

        $query="SELECT * FROM historialDeposito WHERE historialEmpresaId = 900 and historialFechaInicio = '".$fechaInicio."' and historialFechaFin = '".$fechaFin."'";
        $h=$db->Execute($query);
        $his=$h->FetchNextObj();

        //ACTUALIZAR el dinero si hay si no 
        if($his==true){
            $nEmp['historialTotalQuincenal']=$his->historialTotalQuincenal+$dineroEmpleado;
            $j=$db->AutoExecute('historialDeposito',$nEmp, 'UPDATE', 'idHistorial = '.$his->idHistorial);
            $lastHistoryId=$his->idHistorial;

        //SINO-CREAR NUEVO REGISTRO EN HISTORIAL
        }else{
            $historial=array(
                'historialEmpresaId'=>'900',//$_REQUEST['idNegocio'], //idDe pulzos
                'historialTotalQuincenal'=>$dineroEmpleado,
                'historialStatusDeposito'=>'1',
                'historialFechaInicio'=>$fechaInicio,
                'historialFechaFin'=>$fechaFin,
                'historialCodigo'=>'0');  
            $db->AutoExecute('historialDeposito', $historial, 'INSERT') or die(mysql_error());
            $lastHistoryId=$db->Insert_ID();
        }

        //INSERTAR en -comisionRecibida
            $query="SELECT negocios.negocioNombre as nombre FROM negocios WHERE negocioId = ".$_REQUEST['idNegocio'];
            $h=$db->Execute($query);
            $his=$h->FetchNextObj();
                $nombre=$his->nombre;
                $nombre_sin_espacios = str_replace(" ", "", $nombre);
                $referencia = sha1($nombre_sin_espacios.date('dmYHis'));

                $comision=array(
                    'comisionRecibidaEmpresaId'=>'900', //$_REQUEST['idNegocio'],//idDe pulzos
                    'comisionRecibidaUsuarioId'=>$_REQUEST['usuarioId'],
                    'comisionRecibidaFolioTransaccion'=>$_REQUEST['folio'],
                    'comisionRecibidaUsuarioBonificacion'=>$dineroEmpleado,
                    'comisionRecibidaBonificacionZavor'=>'0',
                    'comisionRecibidaNumeroReferencia'=>$referencia,
                    'comisionRecibidaFechaTransaccion'=>time(),
                    'comisionRecibidaHistorialId'=>$lastHistoryId,
                    'fechaDepositoComisionUsuario'=>'0',
                );
        $db->AutoExecute('comisionRecibida', $comision, 'INSERT') or die(mysql_error());
        //Convertir a arreglo para que pueda pasar por el foreach
        $_REQUEST['email']= array(0=> $_REQUEST['email']);
        }


        //VARIOS USUARIOS

        foreach($_REQUEST['email'] as $email){

        //USUARIO NORMAL
        $idN=$_REQUEST['idNegocio'];
        $idU=$_REQUEST['usuarioId'];
        //$email=$_REQUEST['email'];
        $folio=$_REQUEST['folio'];
        $monto=$_REQUEST['monto'];
        $oferta=$_REQUEST['oferta'];
        $bonificacion=$_REQUEST['bonificacion'];
        $empleado=$_REQUEST['empleado'];//EMPLEADO 
        $iva = $_REQUEST['iva'];
        $restar_iva = $monto - $iva;

        //**Obtener datos de la empresa y sus ofertas mediante su Id
        $query ='SELECT negocios.*, ofertas_negocios.* FROM negocios LEFT JOIN ofertas_negocios ON negocios.negocioId = ofertas_negocios.idNegocioOferta WHERE idNegocioOferta ='.$idN.' and ofertaActivacion= "1"';
        //$query="SELECT * FROM negocios LEFT JOIN ofertas_negocios ON negocios.negocioId = ofertas_negocios.idNegocioOferta WHERE idNegocioOferta =".$idN." ORDER BY  ofertaId DESC limit 1";
        $nN =& $db->Execute($query);
        $negocio = $nN->FetchNextObj();


        //1.-insertar en money back
        $money=array();
        $money['moneyNegocioId'] = $idN;
        $money['moneyUsuarioEmail']=$email;
        $money['moneyFolioFactura']=$folio;
        $money['moneyMontoConsumo']=$monto;
        $money['moneyBackOtorgado']=$bonificacion;
        $money['moneyCategoriaDescuento']="todo";
        $db->AutoExecute('money_back', $money, 'INSERT');
        $idMoneyBack=$db->Insert_ID();

        //2.-insercion de money Usuario
        $usuarioM=array();
        $usuarioM['usuarioMoneyUsuarioId']=$idU;
        $usuarioM['usuarioMoneyTotal']=$bonificacion;
        $usuarioM['usuarioMoneyStatus']='0';
        $usuarioM['usuariosMoneyBackId']=$idMoneyBack;
        $db->AutoExecute('money_usuario', $usuarioM, 'INSERT');
        $idMoneyUsuario=$db->Insert_ID();

        //3.-envio de mensaje al usuario de su bonificacion
        $msjSelec=$db->Execute('SELECT social_media_empresa.*, ofertas_negocios.* FROM social_media_empresa LEFT JOIN ofertas_negocios ON social_media_empresa.socialEmpresaId = ofertas_negocios.idMensajeOferta Where socialEmpresaUsuarioId = '.$idN.' and ofertaActivacion = 1 and ofertaId='.$oferta);
        $socialMedia=$msjSelec->FetchNextObj();

        $mensajeRedSocial=array();
                if($socialMedia->mensajeFacebook!=''){
                    $mensajeRedSocial['1']='Facebook:  '.$socialMedia->mensajeFacebook;
                }
                if($socialMedia->mensajeTwitter!=''){
                    $mensajeRedSocial['2']='Twitter:  '.$socialMedia->mensajeTwitter;
                }
                if($socialMedia->mensajePulzos!=''){
                    $mensajeRedSocial['3']='Pulzos:  '.$socialMedia->mensajePulzos;
                }
        //*Mensaje para empleado
        $inbx=array();
        if(isset($empleadoT)){

            $mensaje="Has obtenido un bono por realizar una bonificacion: <br>
                Lugar: <strong> ".$negocio->negocioNombre."</strong><br> 
                Folio: <strong> ".$folio."</strong><br>
                Obteniendo : <strong> $ ".$dineroEmpleado." Pesos</strong> en tu cuenta de pulzos<br><br>
                Mantente al pendiente de tu deposito Gracias... ";
            $asunto="Felicidades Has obtenido un bono...";
            $inbx['inboxnMoneyStatus']="4";
/*
            //QUERY FOR THE DATA
            $em = $db->Execute('select * from usuarios where id = ' . $_REQUEST['idUsuarioPulzos']);
            $employ=$em->FetchNextObj();
            $us = $db->Execute('select * from usuarios where id = ' . $idU);
            $users=$us->FetchNextObj();

            //SEND EMAIL TO EMPLOYEE 
            $from = $employ->email;
            $subject = 'Solicitud de bonificacion enviada.';
            $name_complete = $employ->nombre . ' ' . $employ->apellidos;
            $name_complete_users = $users->nombre . ' ' . $users->apellidos;
            $message = bonificacion_email_empleado($name_complete, $name_complete_users, $folio, $monto);
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers.= 'To: ' . $employ->email . "\r\n";
            $headers.= 'From: Pulzos <atencion@pulzos.com>' . "\r\n";
            mail($from, $subject, $message, $headers);
*/
        //*Mensaje para usuario
        }else{
            $mensaje="Has solicitado una bonificacion en:<br> 
                Lugar:<strong> ".$negocio->negocioNombre."</strong><br> 
                Folio: <strong> ".$folio."</strong> 
                Monto consumido:<strong> $ ".$monto." Pesos </strong><br> 
                Bonificacion:<strong> $ ".$bonificacion." Pesos</strong>
                Se publicara el siguiente mensaje en tus redes sociales:<br><br>".implode("<br>",$mensajeRedSocial) .
                "<br /><font color='RED'>Importante: En algunas cuentas se retendran el 16% del Impuesto al Valor Agregado (IVA).</font>";
            $asunto="Solicitud de bonificacion";
            $inbx['inboxnMoneyStatus']="2";
/*
            //QUERY FOR THE NECESARY DATA
            $us1 = $db->Execute('select * from usuarios where id = ' . $idU);
            $users1=$us1->FetchNextObj();

            //EMAIL TEMPLATE FOR THE USER
            $from1 = $users1->email;
            $subject1 = 'Solicitud de Bonificacion.';
            $name_complete_username = $users1->nombre . ' ' . $users1->apellidos;
            $message1 = bonificacion_email_usuario($negocio->negocioNombre, $name_complete_username, $folio, $monto, $bonificacion);
            $headers1 = 'MIME-Version: 1.0' . "\r\n";
            $headers1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers1.= 'To: ' . $users1->email . "\r\n";
            $headers1.= 'From: Pulzos <atencion@pulzos.com>' . "\r\n";
            mail($from1, $subject1, $message1, $headers1);

            //SEND EMAIL
            $from2 = 'mauricio@zavordigital.com';
            $subject2 = 'se ha realizado una solicitud de bonificacion.';
            $message2 = 'Se ha realizado una solicitud de bonificacion.';
            $headers2 = 'MIME-Version: 1.0' . "\r\n";
            $headers2.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers2.= 'From: Pulzos <atencion@pulzos.com>' . "\r\n";
            mail($from2, $subject2, $message2, $headers2);
*/            
        }
        $idConversacion='0';

        $inbx['inboxnUsuarioId']=$negocio->negocioUsuarioId;
        $inbx['inboxnUsuarioRecibeId']=$idU;
        $inbx['inboxnMensaje']=$mensaje;
        $inbx['inboxnAsunto']=$asunto;
        $inbx['inboxnStatus']="1";
        $inbx['inboxnFecha']=time();
        $inbx['inboxnConversacionId']="0";
        $inbx['inboxnMoneyUser']=$idMoneyUsuario;
        $inbx['inboxnOfertaId']=$oferta;

        $db->AutoExecute('inboxn', $inbx, 'INSERT');
        $idInbox=$db->Insert_ID();
        $aleatorio=$idInbox.$idN.$idU;
        $inbxU=array();
        $inbxU['inboxnConversacionId']=$aleatorio;
        $db->AutoExecute('inboxn', $inbxU, 'UPDATE', 'inboxnId = '.$idInbox);
        $id_inbox_insert=$db->Insert_ID();


        //INSERCION EN BITACORA UNO
        $bitacora = array('bitacoraIbxnId'=>$id_inbox_insert,
                                'bitacoraUsuarioRecibeId'=>$idU,
                                'bitacoraUsuarioEnviaId'=>$negocio->negocioUsuarioId,
                                'bitacoraIbxMsj'=>$mensaje,
                                'bitacoraIbxOferta'=>$oferta,
                                'bitacoraMoneyUsuario'=>$idMoneyUsuario,
                                'bitacoraIbxStatus'=>'2');
        $db->AutoExecute('bitacora_uno', $bitacora, 'INSERT') or die (mysql_error());


        //***INSERCION EN CASO DE QUE HALLA QUE BONIFICAR A ALGUN EMPLEADO***
        }

        if($_REQUEST['empleado']!='nada'){
            $request=array();
            $request['usuarioId']=$_REQUEST['idEmpleado'];
            unset($_REQUEST['empleado']);
            unset($_REQUEST['email']);
            $uM=$db->Execute('SELECT usuarios.email, usuarios_mostrador.* FROM usuarios INNER JOIN usuarios_mostrador ON usuarios.id = usuarios_mostrador.idUsuarioPulzos WHERE idUsuarioPulzos ='.$_REQUEST['idEmpleado']) or die(mysql_error());
            $request=$uM->GetRowAssoc();
            $ref=array_change_key_case($request,CASE_LOWER);
            $result = array_merge($ref, $_REQUEST);
            echo json_encode($result);
        }else if($_REQUEST['empleado']=='nada'){
            $arr = array('error'=>'false','idUsuario'=>$idU,'idOferta'=>$oferta,'idBonificacion'=>$idMoneyUsuario );
            echo json_encode($arr);
            //print_r($arr);
        }else{
            //print_r(false);
        }

$db->Close();
?>

