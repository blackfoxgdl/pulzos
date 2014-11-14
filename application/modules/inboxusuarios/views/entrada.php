<?php
/**
 * Vista que se encarga de mostrar los inbox de manera
 * personalizada para poder despues ver los demas
 * inbox y ya me hice bolas pero la cuestion es que muestra
 * un volcado de la base de datos
 **/
?>
<script type="text/javascript">
$(document).ready(function(){
    $(".menu").click(function(event){
        event.preventDefault();
        urlVerr = $(event.currentTarget).attr("href");
        $('#inbox').load(urlVerr);
    });
$('.lnkEliminarC').click(function(event){
    event.preventDefault();
    urlEs = $(this).attr('href');
    $.get(urlEs);
    $(event.currentTarget).parent().parent().hide();
});
});
</script>
<input type="hidden" id="principal" value="<?php  echo base_url(); ?>index.php/inboxusuarios/index/<?php echo $this->session->userdata('id')?>"/>
<div class="span-14 last" style="margin-top: 5px;">
    <div class="span-13" style="border-top:1px solid #DBDBDB;"></div>
    <div class="span-4">
<!--        De-->
    </div>
    <div class="span-6">
<!--        Asunto-->
    </div>
    <div class="span-3 last">
<!--        Fecha-->
    </div>
    <?php foreach($inboxes as $inboxN): ?>
        <?php if($inboxN->inboxnStatus == 1): /* Mensaje No leido ?>
            <div id="mensaje" class="span-13 last" style="border-bottom:1px solid #DFCBDF;margin-top:15px;">
                <div class="span-1" style="margin-right: 13px">
                       <?php echo img(array('src'=>get_avatar($inboxN->inboxnUsuarioId),
                                                    'height'=>'37px',
                                                    'width'=>'37px',
                                                    'style'=>'margin-right: 13px')); ?>
                </div>  
                <div class="span-4" style="border-bottom:10px; margin-left: 13px">
                    <?php echo anchor('inboxusuarios/ver/'.$inboxN->inboxnUsuarioId,
                                       get_name_user($inboxN->inboxnUsuarioId), array('class'=>'menu','style'=>'text-decoration: none; color: #660066;','id'=>$inboxN->inboxnId)); ?>
                </div>
                <div class="span-7 last" style="margin-left: 13px">
                    <?php /* echo anchor('inboxusuarios/ver/'.$inboxN->inboxnId,
                                       substr($inboxN->inboxnAsunto,0,25)."....", array('class'=>'menu','style'=>'text-decoration: none; color: #666666;','id'=>$inboxN->inboxnId)); ?>
                </div>
                <div class="prepend-9" style="color: #666666">
                    <?php
                        echo img(array('src'=>'/statics/img/unread.png','id'=>'imagenU','class'=>'buzon'/*,
                                                 'width'=>'20',
                                                 'height'=>'18')); 
                        $fecha = unix_to_human($inboxN->inboxnFecha);
                        $correcta = fecha_acomodo($fecha);
                        echo $correcta;
                     
                </div> 
                <div  id="mensajes<?php echo $inboxN->inboxnId;?>" class="span-12 mensajes" style="margin-left: 51px">&nbsp;</div>  <?php//borde Inferior?>
            </div> */?>
        <?php else: //Leido?>
              <?php if($inboxN->inboxnAsunto==''){ ?>  
                <div class="span-1" style="margin-left:496px;margin-top:2px"> <?php
                    if($inboxN->inboxnUsuarioRecibeId!=$this->session->userdata('id')):
                        echo anchor('inboxusuarios/borrar/'.$inboxN->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $inboxN->inboxnUsuarioRecibeId,'class'=>'lnkEliminar'));
                    else:
                        echo anchor('inboxusuarios/borrar/'.$inboxN->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $inboxN->inboxnUsuarioId,'class'=>'lnkEliminar'));    
                    endif; ?>
                </div>
              <?php } ?>
                <div id="saj" class="span-13" style="border-bottom:1px solid #DFCBDF;margin-top:4px;">
                    <div class= "span-1" style=""> 
                         <?php 
                            if($inboxN->statusEU=='0'):
                                echo img(array('src'=>get_avatar($inboxN->inboxnUsuarioId),
                                                    'height'=>'37px',
                                                    'width'=>'37px'));
                            else:
                                $idNego=get_data_company($inboxN->inboxnUsuarioId);
                            echo img(array('src'=>get_avatar_negocios($idNego->negocioId),
                                                'height'=>'37px',
                                                'width'=>'37px')); 
                            endif;
                         ?>
                    
                    </div>
                <div class="span-4" style="border-bottom:10px; margin-left: 13px">
                    <?php echo anchor('inboxusuarios/ver/'.$inboxN->inboxnUsuarioId,
                          get_name_user($inboxN->inboxnUsuarioId), array('class'=>'menu',
                                                                                      'style'=>'text-decoration: none; color: #660066;','id'=>$inboxN->inboxnId)); ?>
                </div>
           <?php if($inboxN->inboxnAsunto==''){ ?>
                    <div class="span-8 last" style="margin-left: 13px">Respuesta:</div>
           <?php }else{ ?>
                <div class="span-8 last" style="margin-left: 13px">
                    <?php  echo anchor('inboxusuarios/ver/'.$inboxN->inboxnUsuarioId,
                                       $inboxN->inboxnAsunto, array('class'=>'menu','style'=>'text-decoration: none; color: #666666;','id'=>$inboxN->inboxnId)); ?>
                </div>
          <?php }?>
                <div class="prepend-9" style="color: #666666">
                    <div class="span-1 last">
                        <?php
                        echo img(array('src'=>'statics/img/read.png','id'=>'imagenR', 'class'=>'buzon'/*,
                                                 'width'=>'20',
                                                 'height'=>'18'*/)); ?>
                    </div>
                    <div>
                        <?php  
                        $fecha = unix_to_human($inboxN->inboxnFecha);
                        $correcta = fecha_acomodo($fecha);
                        echo $correcta;
                        ?>
                    </div>
                </div>
                 <div class="span-8 last" style="margin-left: 13px">
                <?php  echo anchor('inboxusuarios/ver/'.$inboxN->inboxnUsuarioId,
                                   substr($inboxN->inboxnMensaje,0,25).'...', array('class'=>'menu','style'=>'text-decoration: none; color: #666666;','id'=>$inboxN->inboxnId)); ?>
                </div>
                <div  id="mensajes<?php echo $inboxN->inboxnId;?>" class="span-12 mensajes" style="margin-left: 51px">&nbsp;</div>

            </div>
        <?php endif; ?>
    <?php endforeach ?>
</div>
