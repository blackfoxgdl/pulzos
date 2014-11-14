<?php
/**
 * Vista que se encarga para mostrar sus
 * mensajes enviados, saldra que mensajes
 * se enviaron para poder visualizarlos
 * 
*  @version 0.1
 * @author jorgeLeon <jorge@zavordigital.com>
 * @copyright ZavorDigital, May 6, 2011
 * @package 
 **/
?>
<script type="text/javascript">
$(".menu").click(function(event){
    event.preventDefault();
    urlver = $(event.currentTarget).attr("href");
    $("#inbox").load(urlver);
    
});    
$(".lnkEliminar").click(function(event){
    event.preventDefault();
    urlE = $(this).attr('href');
    $.get(urlE);
    $(event.currentTarget).parent().parent().hide();
}); 

$('.lnkEliminarC').click(function(event){
     event.preventDefault();
     urlEC=$(this).attr('href');
     var deleteC=confirm("Deseas eliminar la conversacion?");
     if(deleteC==true){
     $.get(urlEC);
     urlId=$(this).attr('id');
     urlIndex=$('#getIndex').attr('value')+urlId;
     $('#inbox').load(urlIndex);
     }else{
     }
});
</script>
<div id="linea" class="span-13" style="border-top:1px solid #DFCBDF;margin-top:5px"></div>
    <?php foreach($recibido as $recibidos): //var_dump($recibido);
        $quienRecibe=get_status_user($recibidos->inboxnUsuarioRecibeId);
          if($quienRecibe!='1'){ ?>
            <div id="mensaje" class="span-13" style="border-bottom:1px solid #DFCBDF;margin-top:5px">
                  
                <?php  if($recibidos->inboxnAsunto==''){ ?>  
                    <div class="prepend-12" style="margin-left:16px">  
                    <?php 
                    
                        if($recibidos->inboxnUsuarioRecibeId!=$this->session->userdata('id')):
                            echo anchor('inboxusuarios/borrar/'.$recibidos->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $recibidos->inboxnUsuarioRecibeId,'class'=>'lnkEliminar'));
                        else:
                            echo anchor('inboxusuarios/borrar/'.$recibidos->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $recibidos->inboxnUsuarioId,'class'=>'lnkEliminar'));    
                        endif;
                    ?>
                    </div>
                <?php }else{ ?>
                    <div class="prepend-12" style="margin-left:17px"> 
                        <input type="hidden" id="getIndex" value="<?php  echo base_url(); ?>index.php/inboxusuarios/index/"/>  
                            <?php echo anchor('inboxusuarios/borrarConversacion/'.$recibidos->inboxnConversacionId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $recibidos->inboxnUsuarioRecibeId,'class'=>'lnkEliminarC')); ?>
                     </div>
                <?php } ?>
                 <?php if($recibidos->inboxnUsuarioRecibeId!=$this->session->userdata('id')){ ?>
                    <div class= "span-1" style=""> 
                         <?php echo img(array('src'=>get_avatar($recibidos->inboxnUsuarioRecibeId),
                                                    'height'=>'37px',
                                                    'width'=>'37px')); ?>
                    
                    </div>
                    <div class="span-11 last" style="border-bottom:10px; margin-left: 13px;margin-right:15px">
                        <?php echo anchor('inboxusuarios/ver/'.$recibidos->inboxnUsuarioRecibeId,
                            get_name_user($recibidos->inboxnUsuarioRecibeId), array('class'=>'menu','style'=>'text-decoration: none; color: #660066;','id'=>$recibidos->inboxnId)); ?>
                    </div>
        
               <?php }else{ ?>
                    <div class= "span-1" style="">
                        
                         <?php echo img(array('src'=>get_avatar($recibidos->inboxnUsuarioId),
                                                    'height'=>'37px',
                                                    'width'=>'37px')); ?>
                    
                    </div>
                    <div class="span-11 last" style="border-bottom:10px; margin-left: 13px;margin-right:15px">
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
                        echo img(array('src'=>'statics/img/read.png','id'=>'imagenR', 'class'=>'buzon'/*,
                                                 'width'=>'20',
                                                 'height'=>'18'*/)); ?>
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
                    <?php  echo anchor('inboxusuarios/ver/'.$recibidos->inboxnUsuarioRecibeId,
                                       substr($recibidos->inboxnMensaje,0,25).'...', array('class'=>'menu','style'=>'text-decoration: none; color: #666666;','id'=>$recibidos->inboxnId)); ?>
                </div>
                <div  id="mensajes<?php echo $recibidos->inboxnId;?>" class="span-12 mensajes" style="margin-left: 51px">&nbsp;</div>

            </div>

    <?php } endforeach; ?>

