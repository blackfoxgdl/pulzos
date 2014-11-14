<?php

/*
 * Vista que se encarga para mostrar sus
 * mensajes enviados, saldra que mensajes
 * que no se han leido para poder visualizarlos
 * 
 * @version 0.1
 * @author jorgeLeon <jorge@zavordigital.com>
 * @copyright ZavorDigital, May 6, 2011
 * @package 
 * 
 **/

?>
<script type="text/javascript">
$(".menu").click(function(event){
    event.preventDefault();
    urlver = $(event.currentTarget).attr("href");
    $("#inbox").load(urlver);
});
</script>
<div id="linea" class="span-13" style="border-top:1px solid #DFCBDF;margin-top:5px"></div>
<?php foreach($recibido as $recibidos):
         if($recibidos->inboxnUsuarioRecibeId == $this->session->userdata('id')/*||$recibidos->inboxnUsuarioId==$this->session->userdata('id')*/):?>

    <div id="mensaje" class="span-13" style="border-bottom:1px solid #DFCBDF;margin-top:15px;background-color: #DCCEDD" >
                
         <?php if($recibidos->inboxnUsuarioRecibeId!=$this->session->userdata('id')){ ?>
          
                <div class= "span-1" style=""> 
                         <?php echo img(array('src'=>get_avatar($recibidos->inboxnUsuarioRecibeId),
                                                    'height'=>'37px',
                                                    'width'=>'37px')); ?>
                    
                 </div>
                <div class="span-4" style="border-bottom:10px; margin-left: 13px;margin-right:17px;">
                    <?php echo anchor('inboxusuarios/ver/'.$recibidos->inboxnUsuarioId,
                          get_name_user($recibidos->inboxnUsuarioRecibeId), array('class'=>'menu','style'=>'text-decoration: none; color: #660066;','id'=>$recibidos->inboxnId)); ?>
                </div>
        
        
        <?php }else{ ?>
             <div class= "span-1" style=""> 
                         <?php 
                            if($recibidos->statusEU=='0'):
                                echo img(array('src'=>get_avatar($recibidos->inboxnUsuarioId),
                                                    'height'=>'37px',
                                                    'width'=>'37px')); 
                            else:
                                $idNego=get_data_company($recibidos->inboxnUsuarioId);
                                echo img(array('src'=>get_avatar_negocios($idNego->negocioId),
                                                'height'=>'37px',
                                                'width'=>'37px')); 
                            endif;
                         ?>
                    
                    </div>
                <div class="span-11" style="border-bottom:10px; margin-left: 13px;margin-right:17px;">
                    <?php echo anchor('inboxusuarios/ver/'.$recibidos->inboxnUsuarioId,
                          get_name_user($recibidos->inboxnUsuarioId), array('class'=>'menu','style'=>'text-decoration: none; color: #660066;','id'=>$recibidos->inboxnId)); ?>
                </div>
       <?php } 
         if($recibidos->inboxnAsunto==''){ ?>
                        <div class="span-7 last" style="color: #339900;margin-left: 13px">Respuesta:</div>  
               <?php }else{ ?>
                    
                    <div class="span-7 last" style="margin-left: 13px">
                        <?php  echo anchor('inboxusuarios/ver/'.$recibidos->inboxnUsuarioRecibeId,
                                           $recibidos->inboxnAsunto, array('class'=>'menu','style'=>'text-decoration: none; color: #666666;','id'=>$recibidos->inboxnId)); ?>
                    </div>
              <?php } ?>
                <div class="prepend-9" style="color: #666666">
                    <div class="span-1 last">
                        <?php
                        echo img(array('src'=>'statics/img/unread.png','id'=>'imagenR', 'class'=>'buzon')); ?>
                    </div>
                    <div>
                        <?php  
                        $fecha = unix_to_human($recibidos->inboxnFecha);
                        $correcta = fecha_acomodo($fecha);
                        echo $correcta;
                     ?>
                    </div>
                </div>
                <div class="span-7 last" style="margin-left: 13px">
                    <?php  echo anchor('inboxusuarios/ver/'.$recibidos->inboxnUsuarioId,
                                       substr($recibidos->inboxnMensaje,0,25).'...', array('class'=>'menu','style'=>'text-decoration: none; color: #666666;','id'=>$recibidos->inboxnId)); ?>
                </div>
                <div  id="mensajes<?php echo $recibidos->inboxnId;?>" class="span-12 mensajes" style="margin-left: 51px">&nbsp;</div>
            </div>
<?php       endif;
       endforeach; ?>