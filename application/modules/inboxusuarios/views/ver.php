<?php
/**
 * Vista en la cual se muestran la informacion que se ha
 * enviado en un inbox o en todos para que se pueda leer,
 * regresar a los inbox o pueda contestar el mensaje privado
 * que se ha enviado. NOTA SE USA EL ID DE EMPRESA EN LA TABLA
 * DE USUARIO NO EN LA TABLA DE NEGOCIOS
 *
 * @version 0.1
 * @author jorgeLeon <jorge@zavordigital.com>
 * @copyright ZavorDigital, May 6, 2011
 * @package 
 * 
 **/
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
//click en el boton de aceptar money
var idUsuario=$('#idUsuario').attr('value');
var idRecibe=$('#idRecibe').attr('value');
    $('a#aceptar').click(function(event){
           event.preventDefault();
           var idClick=$(this).attr('class');
           var id=replaceAll(idClick,'lnkAceptar_','');
           $('.lnkRechazado_'+id).parent().slideUp('slow');
           urlAceptarInbox = $('#moneyEmpresa').attr('href');
           urlAceptadoPosteo = $("#aceptar").attr('href');
  
           $.get(urlAceptadoPosteo);
     //Validacion para el boton inbox de usuario o negocio
           if($(this).attr('rel')=='usuario'){
             
               $.post(urlAceptarInbox, {inboxId:id,status:'aceptar', click:'1'},function(){
                   $('#opciones-bonificaciones .'+idClick).slideUp('slow', function(){
                       $('#opciones-bonificaciones .'+idClick).html('<div class="span-4 redondeo-menu"  style="color:#FFFFFF;text-align:center;background-color: #339900;width:70px;height:20px">Aceptado</div>').slideDown('slow');    
                   });   
               });
           }else{      
               $.post(urlAceptarInbox, {inboxId:id, status:'aceptar', idUsuario:idUsuario, idRecibe:idRecibe},function(){
                   $('#opciones-bonificaciones .'+idClick).slideUp('slow', function(){
                       $('#opciones-bonificaciones .'+idClick).html('<div class="span-4 redondeo-menu"  style="color:#FFFFFF;text-align:center;background-color: #339900;width:70px;height:20px">Aceptado</div>').slideDown('slow');    
                   });   
               });
            }
    }).trigger('click');// se agrego .trigger('click') para que se activara el boton de aceptar automatico .

});
    $("#regresarI").click(function(event){
        event.preventDefault();
        var url = $(this).attr("href");
        $("#dinamica").load(url);
    });

    $(".lnkEliminar").click(function(event){
        event.preventDefault();
        urlE = $(this).attr('href');
        $(event.currentTarget).parent().parent().parent().hide('slow', function(){
            $.get(urlE);           
        });
    });
        
    $('.lnkEliminarC').click(function(event){
         event.preventDefault();
         urlEC=$(this).attr('href');
         var deleteC=confirm("Deseas eliminar la conversacion?");
         if(deleteC==true){
             $(event.currentTarget).parent().parent().parent().slideUp('slow');
             $.get(urlEC);
         }else{
            return false;
         }
    });
    
    $(".respuestaB").click(function(event){
        event.preventDefault();
        divCon=$(event.currentTarget).attr("id");
        ident = $(event.currentTarget).attr("id");
        a=replaceAll(ident,'responderB','');
        var urlF = $("#formaResponder").attr("action");
        urlMain=urlF+a;
        $('.'+divCon).load(urlMain);
    });
   
   function replaceAll(t, r, c) { return t.replace(new RegExp(r, 'g'),c); }
   
//click en el boton de aceptar money
/*var idUsuario=$('#idUsuario').attr('value');
var idRecibe=$('#idRecibe').attr('value');
    $('a#aceptar').click(function(event){
           event.preventDefault();
           var idClick=$(this).attr('class');
           var id=replaceAll(idClick,'lnkAceptar_','');
           $('.lnkRechazado_'+id).parent().slideUp('slow');
           urlAceptarInbox = $('#moneyEmpresa').attr('href');
           urlAceptadoPosteo = $("#aceptar").attr('href');
  
           $.get(urlAceptadoPosteo);
     //Validacion para el boton inbox de usuario o negocio
           if($(this).attr('rel')=='usuario'){
             
               $.post(urlAceptarInbox, {inboxId:id,status:'aceptar', click:'1'},function(){
                   $('#opciones-bonificaciones .'+idClick).slideUp('slow', function(){
                       $('#opciones-bonificaciones .'+idClick).html('<div class="span-4 redondeo-menu"  style="color:#FFFFFF;text-align:center;background-color: #339900;width:70px;height:20px">Aceptado</div>').slideDown('slow');    
                   });   
               });
           }else{      
               $.post(urlAceptarInbox, {inboxId:id, status:'aceptar', idUsuario:idUsuario, idRecibe:idRecibe},function(){
                   $('#opciones-bonificaciones .'+idClick).slideUp('slow', function(){
                       $('#opciones-bonificaciones .'+idClick).html('<div class="span-4 redondeo-menu"  style="color:#FFFFFF;text-align:center;background-color: #339900;width:70px;height:20px">Aceptado</div>').slideDown('slow');    
                   });   
               });
            }
    });*/

//click en boton rechazar Money
    $('a#rechazar').click(function(event){
           event.preventDefault();    
           var idClick=$(this).attr('class');
           var id=replaceAll(idClick,'lnkRechazado_','');
           if($(this).attr('rel')=='usuario'){
               urlAceptarInbox = $('#moneyEmpresa').attr('href');
               $.post(urlAceptarInbox, {inboxId:id, status:'rechazado', click:'1'});
           }
           $('.respuestaB').slideUp('slow');
           $('.lnkAceptar_'+id).parent().slideUp('slow'); 
           $('.lnkRechazado_'+id).slideUp('slow', function(){
                $(this).html('<div class="span-4 redondeo-menu"  style="color:#FFFFFF;text-align:center;background-color: #D10D00;width:70px;height:20px">Declinado</div>').slideDown('slow');    
                $('.InboxNo_'+id).parent().fadeIn('slow');
           });

    });
    
    $('.opcionesRechazados span').click(function(event){
        event.preventDefault();
        var idClass=$(this).parent().parent().parent().attr('class');
        var idToken=$(this).parent().attr('id');
        var id=replaceAll(idClass,'span-8 rechazado','');
        
          switch(idToken){
              case('enviar'):
                  if($('.InboxNo_'+id).attr('value')==''){
                      var deleteC=confirm("No tiene ninguna razón, Deseas continuar?");
                         if(deleteC==true){
                             urlAceptarInbox = $('#moneyEmpresa').attr('href');
                             $.post(urlAceptarInbox, {inboxId:id, status:'rechazado', idUsuario:idUsuario, idRecibe:idRecibe});
                         }else{
                            return false;
                         }
                  }else{
                      razon =$('.InboxNo_'+id).attr('value');
                      urlAceptarInbox = $('#moneyEmpresa').attr('href');
                      $.post(urlAceptarInbox, {inboxId:id, status:'rechazado', idUsuario:idUsuario, idRecibe:idRecibe, razon:razon});
                  }
              break;    
              case('cancelar'):
                  $(this).parent().parent().parent().fadeOut('slow',function(){
                      $('.lnkAceptar_'+id).parent().slideDown('slow');
                      $('.lnkRechazado_'+id).slideUp('fast',function(){
                          $(this).html('<div class="span-4 redondeo-menu"  style="color:#FFFFFF;text-align:center;background-color: #660066;width:70px;height:20px">Declinado</div>').slideDown('slow');    
                      });
                  });
              break;
         }
         if(idToken=='enviar'){
            $(this).parent().parent().parent().slideUp('slow');
         }
    }); 
    function replaceAll(t, r, c) { return t.replace(new RegExp(r, 'g'),c); }
</script>

<?php echo anchor('inboxusuarios/moneyEmpresa/','', array('id'=>'moneyEmpresa','class'=>'','style'=>'display:none')); ?>  

<div class="span-14 last" style=""><!-- main **begin** -->

        <?php $indice=0;foreach($inboxN as $inbox):
            
            //Cuando llega uno de un usuario Para los dos
            if($inbox->statusEU==0):
                  if($indice==0 || $inbox->inboxnAsunto!=''): //Muestra a los Usuarios en cabecera los mensajes de Usuarios?>   
                    <input id="idUsuario" value="<?php echo $inbox->inboxnUsuarioId; ?>" type="hidden" />
                    <input id="idRecibe" value="<?php echo $inbox->inboxnUsuarioRecibeId; ?>" type="hidden" />
                    <input id="idConversacion" value="<?php echo $inbox->inboxnConversacionId; ?>" type="hidden" />
                    <?php 
                     $usi=get_complete_userdata($this->session->userdata('id')); ?>
<!--div id='mensaje'-->  <?php
                    if($usi->statusEU==0 && $inbox->inboxnMoneyStatus == 0 || $usi->statusEU==1 &&  $inbox->inboxnMoneyStatus != 0 ): ?>
                      <?php echo form_open(base_url().'index.php/inboxusuarios/responder/',
                                                 array('id'=>'formaResponder', 'class'=>'responder')); ?>
                    <div id="Mensaje-padre" class="span-14 last" style="border-top:1px solid #DFCBDF;margin-top: 10px;margin-bottom: 40px;word-wrap: break-word;"> <!-- Div de contenido del msj-->
                        <div class="prepend-12" style="margin-left:25px"> 
                            <input type="hidden" id="getIndex" value="<?php  echo base_url(); ?>index.php/inboxusuarios/index/"/>  
                                <?php echo anchor('inboxusuarios/borrarConversacion/'.$inbox->inboxnConversacionId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $inbox->inboxnUsuarioRecibeId,'class'=>'lnkEliminarC')); ?>
                        </div>
                        <div class="span-1" style="margin-left: 13px;margin-top:10px">
                                    <?php echo img(array('src'=>get_avatar($inbox->inboxnUsuarioId),
                                                    'height'=>'37px',
                                                    'width'=>'37px')); ?>
                        </div>  

                       
                          
								 <div class="span-12 last">
                            <div class="span-6 last" style="color: #660066;margin-left: 13px">
                                        <?php echo $inbox->nombre; ?>
                            </div>
                            <div class="prepend-6" style="color: #666666;margin-top: 10px">                
                                <div class="span-1 last">
                                    <?php echo img(array('src'=>'statics/img/read.png','id'=>'imagenR', 'class'=>'buzon')); ?>
                                </div>
                                <div class="span-5 last">
                                    <?php  
                                    $fecha = unix_to_human($inbox->inboxnFecha);
                                    $correcta = fecha_acomodo($fecha);
                                    echo $correcta; ?>
                                </div>
                           </div>
                        </div>

                        <div class="span-8 last" style="color: #666666;margin-left: 13px;margin-bottom: 15px">
                            <?php echo $inbox->inboxnAsunto; ?>
                        </div>

                        <div class="span-11 last"  style="color: #666666;margin-left:65px;">
                            <?php echo $inbox->inboxnMensaje; ?>
                            <input type="hidden" id="idInbx" class="idInboxe<?php echo $inbox->inboxnId;?>" value="<?php echo $inbox->inboxnId; ?>" />
                        </div> 
<!-- Manejo de botones para inbox para la empresa Cuando se bonifica desde el usuario-->
                        <?php 
                             $verBoton=get_status_user($this->session->userdata('id'));
                        if($verBoton==1): ?>
                                <div class="span-8 botones" style="margin-top:40px;margin-left:180px" id="opciones-bonificaciones">  
                                    <?php if($inbox->inboxnMoneyStatus ==2){ ?>
                                        <div class="span-4 redondeo-menu"  style="text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px">
                                    <?php
                                            echo anchor('redessociales/post_social_media/'.$inbox->inboxnUsuarioId.'/'.$inbox->inboxnOfertaId.'/'.$inbox->inboxnMoneyUser,'Aceptar',array('id'=>'aceptar', 'class'=>'lnkAceptar_'.$inbox->inboxnId ,'style'=>'text-decoration:none;color:#FFF; display:none;'));
                                            ?>
                                        </div>
                                        <div class="span-4 redondeo-menu rechazar" style="text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px">
                                            <?php 
                                            // echo anchor('redessociales/post_social_media/','Declinar',array('id'=>'rechazar', 'class'=>'lnkRechazado_'.$inbox->inboxnId,'style'=>'text-decoration:none;color:#FFF;'));
                                            ?>
                                        </div>
                                    <?php }else if($inbox->inboxnMoneyStatus == 1){ ?>
                                        <div class="span-4 redondeo-menu" style="text-align:center;color:#FFFFFF;width:170px;height:20px;background-color: #339900;">
                                            <!--Aceptado-->Bonificaci &oacuten aceptada.
                                        </div>
                                    <?php }else if($inbox->inboxnMoneyStatus == 3){ ?>
                                            <div class="span-4 redondeo-menu" style="text-align:center;color:#FFFFFF;width:70px;height:20px;background-color: #D10D00;"-->
                                            Declinado
                                            </div>
                                    <?php } ?>
                                </div>
                            
                                <div class="span-8 rechazado<?php echo $inbox->inboxnId; ?>" style="margin-top: 0px;display:none;margin-left: 60px;" >
                                    <div class="span-4" style="color: #660066;">Razon: </div>
                                        <?php echo form_textarea(array('id'=>'inboxNo',
                                                       'name'=>'',
                                                       'class'=>'InboxNo_'.$inbox->inboxnId,
                                                       'style'=>'width: 435px; height: 22px; border: 1px solid;border-color:#999999;margin-bottom:5px;color:#666666',
                                                       'cols'=>'40',
                                                       'rows'=>'1')); ?>
                                    <div class="opcionesRechazados">
                                        <div id="enviar" class="span-2 redondeo-menu enviarRechazados" style="text-align:center;color:#FFFFFF;background-color: #996699;width: 50px;cursor: pointer">
                                            <span>Enviar</span>
                                        </div>    
                                        <div id="cancelar" class="span-2 redondeo-menu cancelarRechazados" style="text-align:center;color:#FFFFFF;background-color: #996699;width: 60px;cursor:pointer">
                                            <span>Cancelar</span>
                                        </div>
                                    </div>
                                </div>
                                
                                
                      <?php endif; ?> 
                    </div>
                <?php $indice++; ?>
       <div id ="respuesta">
          <div class="prepend-11">
                   <?php echo form_submit(array('id'=>'responderB'.$inbox->inboxnConversacionId,
                                                 'style'=>'border:none;background:none;cursor:pointer;color:#660066',
                                                 'class'=>'respuestaB',
                                                 'value'=>'Responder')); ?>
          </div>
          </div>
           <?php echo form_close(); ?> 
       
       
                     <?php endif;  ?>
    <div class="responderB<?php echo $inbox->inboxnConversacionId; ?>"></div>
           <?php  
                
           foreach($respuestas as $respuesta):   //Muestra los mensajes de respuesta a los mensajes de cabecera para Usuarios 
                if($inbox->inboxnConversacionId == $respuesta->inboxnConversacionId):   ?> 
                <?php echo form_open(base_url().'index.php/inboxusuarios/responder/',
                                             array('id'=>'formaResponder', 'class'=>'responder')); ?>
                <div id="Mensaje-hijo" class="prepend-1" style=""> <!-- Div de contenido del msj-->                                                                                                         
                        <div class="span-12 last" style="margin-bottom: 25px;background-color: #DCCEDD;margin-left: 13px;word-wrap: break-word;"> 
                            <div class="span-1" style="margin-left: 13px;margin-top:10px">
                                    <?php echo img(array('src'=>get_avatar($respuesta->inboxnUsuarioId),
                                                    'height'=>'37px',
                                                    'width'=>'37px')); ?>
                            </div> 
                        

                        <div class="span-8" style="color: #660066;margin-top: 10px;margin-left: 13px">
                                    <?php echo $respuesta->nombre; ?>

                        </div>
                            <div class="prepend-11" style="margin-left: 15px;margin-top:2px" >
                                <input type="hidden" id="principal" value="<?php  echo base_url(); ?>index.php/inboxusuarios/ver/"/>                
                                    <?php 
                                        if($respuesta->inboxnUsuarioRecibeId!=$this->session->userdata('id')):
                                            echo anchor('inboxusuarios/borrar/'.$respuesta->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $respuesta->inboxnUsuarioRecibeId,'class'=>'lnkEliminar'));
                                        else:
                                            echo anchor('inboxusuarios/borrar/'.$respuesta->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $respuesta->inboxnUsuarioId,'class'=>'lnkEliminar'));    
                                        endif;
                                    ?>
                            </div>


                                <div class="span-9 last append-bottom" style="color: #666666;margin-left: 13px">
                                    <?php echo $respuesta->inboxnMensaje; ?>
                                </div>
                                   <div class="span-9 last" style="color: #996699;margin-top: 10px;">
                                        <?php  
                                        $fecha = unix_to_human($respuesta->inboxnFecha);
                                        $correcta = fecha_acomodo($fecha);
                                        echo $correcta; ?>
                                       <div class="span-1 last" style="margin-left: 68px">
                                           <?php echo img(array('src'=>'statics/img/icon-comentar.png'));?>
                                       </div>  

                                   </div>

                                <input type="hidden" id="idInbx" value="<?php echo $respuesta->inboxnId; ?>" />
                                
                    </div>
                </div>
                <?php $indice++;
                endif;
                endforeach;
              
                endif; ?>
<!--/div--> <?php            
            else: 
            $indice=0; 
            //echo '<div style="border-top:1px solid #DFCBDF;margin-left:10px;margin-top:1px;margin-bottom:10px" class="span-13"></div>';
                           
                 
            //Muestra a los usuarios los mensajes de las empresas En Cabecera! >
            if($inbox->inboxnUsuarioId != $this->session->userdata('id')):
            if($indice==0): ?>
<!--div id='mensaje'--> 
                <?php echo form_open(base_url().'index.php/inboxusuarios/responder/',
                                             array('id'=>'formaResponder', 'class'=>'responder')); ?>
                    <div id="Mensaje-padre" class="span-14 last" style="border-top:1px solid #DFCBDF;margin-top: 10px;margin-bottom: 10px"> <!-- Div de contenido del msj-->
                        <div class="prepend-12" style="margin-left:25px"> 
                            
                                <?php echo anchor('inboxusuarios/borrarConversacion/'.$inbox->inboxnConversacionId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $inbox->inboxnUsuarioRecibeId,'class'=>'lnkEliminarC')); ?>
                        </div>
                        
                        <div class="span-1" style="margin-left: 13px;margin-top:10px">
                                    <?php $idNego=get_data_company($inbox->inboxnUsuarioId);
                                            echo img(array('src'=>get_avatar_negocios($idNego->negocioId),
                                                    'height'=>'37px',
                                                    'width'=>'37px')); ?>
                        </div>  
					
                    <div class="span-12"> 
                        

                        <div class="span-8" style="color: #660066;margin-left: 13px">
                                    <?php echo $inbox->nombre; ?>
                        </div>
                        <div class="prepend-8" style="color: #666666;margin-top: 10px">

                            <div class="span-1 last">
                                <?php echo img(array('src'=>'statics/img/read.png','id'=>'imagenR', 'class'=>'buzon')); ?>
                            </div>
                            <div>
                                <?php  
                                $fecha = unix_to_human($inbox->inboxnFecha);
                                $correcta = fecha_acomodo($fecha);
                                echo $correcta; ?>
                            </div>
                        </div>
                    </div>

                                <div class="span-8 last" style="color: #666666;margin-left: 13px;margin-bottom: 15px">
                                    <?php echo $inbox->inboxnAsunto; ?>
                                </div>

                                <div class="span-12 last"  style="color: #666666;margin-left:65px">
                                    <?php echo $inbox->inboxnMensaje; ?>
                                    <input type="hidden" id="idInbx" value="<?php echo $inbox->inboxnId; ?>" />
                                </div>
<!-- Manejo de botones Cuando bonifican desde la empresa -->
                                <div class="span-8 botones" style="margin-top:40px;margin-left:180px" id="opciones-bonificaciones">
                                    <?php $totalDatos_sociales = get_total_datos_socialmedia($this->session->userdata('id')); ?>
                                    <?php if($totalDatos_sociales != 0): ?>
                                        <?php $datos_sociales_usuarios = get_datossociales_usuarios($this->session->userdata('id')); ?>
                                            <?php if((empty($datos_sociales_usuarios->tokenFacebook)) && (empty($datos_sociales_usuarios->twitter_oauth) && empty($datos_sociales_usuarios->twitter_oauth_secret))): ?>
                                                <a href="http://www.pulzos.com/redessociales/intermedio.php?id=<?php echo base64_encode($this->session->userdata('id')); ?>" style="text-decoration: none;color:#660068;font-family: Arial, Helvetica, sans-serif;font-size: 14px;"><!-- http://www.pulzos.com/inicio.php/redessociales/redes_sociales_usuarios/ -->
                                                    Activa tus Redes Sociales
                                                </a>       
                                        <?php else: ?>
                                            <?php if($inbox->inboxnMoneyStatus ==2){ ?>
                                                <div class="span-4 redondeo-menu"  style="text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px">
                                                <?php
                                                    echo anchor('redessociales/post_social_media/'.$this->session->userdata('id').'/'.$inbox->inboxnOfertaId.'/'.$inbox->inboxnMoneyUser,'Aceptar',array('id'=>'aceptar', 'class'=>'lnkAceptar_'.$inbox->inboxnId ,'style'=>'text-decoration:none;color:#FFF;display:none;','rel'=>'usuario'));
                                                ?>
                                                </div>
                                                <div class="span-4 redondeo-menu rechazar" style="text-align:center;background-color: #660066;cursor: pointer;width:70px;height:20px">
                                                    <?php 
                                                    // echo anchor('redessociales/post_social_media/','Declinar',array('id'=>'rechazar', 'class'=>'lnkRechazado_'.$inbox->inboxnId,'style'=>'text-decoration:none;color:#FFF;','rel'=>'usuario'));
                                                    ?>
                                                </div>
                                            <?php }else if($inbox->inboxnMoneyStatus == 1){ ?>
                                                <div class="span-4 redondeo-menu" style="text-align:center;color:#FFFFFF;width:170px;height:20px;background-color: #339900;">
                                                   <!-- Aceptado-->Bonificaci&oacuten aceptada.
                                                </div>
                                            <?php }else if($inbox->inboxnMoneyStatus == 3){ ?>
                                                    <div class="span-4 redondeo-menu" style="text-align:center;color:#FFFFFF;width:70px;height:20px;background-color: #D10D00;">
                                                    Declinado
                                                    </div>
                                            <?php } ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="http://www.pulzos.com/redessociales/intermedio.php?id=<?php echo base64_encode($this->session->userdata('id')); ?>" style="text-decoration: none;color:#660068;font-family: Arial, Helvetica, sans-serif;font-size: 14px;"><!-- http://www.pulzos.com/inicio.php/redessociales/redes_sociales_usuarios/ -->
                                            Activa tus Redes Sociales
                                        </a>
                                    <?php endif; ?>
                               </div>
                    </div>

                <?php $indice++; ?>
    <div id ="respuesta">
          <div class="prepend-11">
                   <?php echo form_submit(array('id'=>'responderB'.$inbox->inboxnConversacionId,
                                                 'style'=>'border:none;background:none;cursor:pointer;color:#660066;display:none',
                                                 'class'=>'respuestaB',
                                                 'value'=>'Responder')); ?>
          </div>
           
    </div>
		 <?php echo form_close(); ?>
    <div class="responderB<?php echo $inbox->inboxnConversacionId; ?>"></div> 
              <?php  foreach($respuestas as $respuesta):   //Muestra los mensajes de respuesta a los mensajes de cabecera para Usuarios 
                if($inbox->inboxnConversacionId == $respuesta->inboxnConversacionId):   ?> 
                <?php echo form_open(base_url().'index.php/inboxusuarios/responder/',
                                             array('id'=>'formaResponder', 'class'=>'responder')); ?>
                <div id="Mensaje-hijo" class="prepend-1" style=""> <!-- Div de contenido del msj-->                                                                                                         
                        <div class="span-12 last" style="margin-bottom: 25px;background-color: #DCCEDD;margin-left: 13px;word-wrap: break-word;"> 
                            <div class="span-1" style="margin-left: 13px;margin-top:10px">
                                    <?php echo img(array('src'=>get_avatar($respuesta->inboxnUsuarioId),
                                                    'height'=>'37px',
                                                    'width'=>'37px')); ?>
                            </div> 
                        

                        <div class="span-8" style="color: #660066;margin-top: 10px;margin-left: 13px">
                                    <?php echo $respuesta->nombre; ?>

                        </div>
                            <div class="prepend-11" style="margin-left: 15px;margin-top:2px" >
                                <input type="hidden" id="principal" value="<?php  echo base_url(); ?>index.php/inboxusuarios/ver/"/>                
                                    <?php 
                                        if($respuesta->inboxnUsuarioRecibeId!=$this->session->userdata('id')):
                                            echo anchor('inboxusuarios/borrar/'.$respuesta->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $respuesta->inboxnUsuarioRecibeId,'class'=>'lnkEliminar'));
                                        else:
                                            echo anchor('inboxusuarios/borrar/'.$respuesta->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $respuesta->inboxnUsuarioId,'class'=>'lnkEliminar'));    
                                        endif;
                                    ?>
                            </div>


                                <div class="span-9 last append-bottom" style="color: #666666;margin-left: 13px">
                                    <?php echo $respuesta->inboxnMensaje; ?>
                                </div>
                                   <div class="span-9 last" style="color: #996699;margin-top: 10px;">
                                        <?php  
                                        $fecha = unix_to_human($respuesta->inboxnFecha);
                                        $correcta = fecha_acomodo($fecha);
                                        echo $correcta; ?>
                                       <div class="span-1 last" style="margin-left: 68px">
                                           <?php echo img(array('src'=>'statics/img/icon-comentar.png'));?>
                                       </div>  

                                   </div>

                                <input type="hidden" id="idInbx" value="<?php echo $respuesta->inboxnId; ?>" />

                    </div>
                </div>
                <?php $indice++;
                endif;
                endforeach;
            endif;   
            endif;
            endif; ?>
<!--/div--> 
  <?php  endforeach; 
         echo '<div style="border-top:1px solid #DFCBDF;margin-left: 10px;margin-top:1px;margin-bottom:10px" class="span-13"></div>';
  ?>
  <?php if($indice<1){//esto es para el internt explorer que detecta un div de mas ?> 
</div>
<?php }else{}?>
