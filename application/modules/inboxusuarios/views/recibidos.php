
<script type="text/javascript">
$(".menu").click(function(event){
    event.preventDefault();
    urlver = $(event.currentTarget).attr("href");
    $("#inbox").load(urlver);
});
function update() {
    urlReloadSecond = $("#reloadSecond").attr("href");
    $("#header-container").load(urlReloadSecond);
}
</script>
<?php echo anchor('usuarios/reload_header/'.$this->session->userdata('id'), '', array('id'=>'reloadSecond', 'style'=>'display:none')); ?>
<div id="linea" class="span-13" style="border-top:1px solid #DFCBDF;margin-top:5px"></div>
 <?php
 
    foreach($recibido as $recibidos): ?>   
        
    
    <div id="mensaje" class="span-13" <?php if($recibidos->inboxnStatus==1): echo 'style="border-bottom:1px solid #DFCBDF;margin-top:15px;background-color: #DCCEDD"';else:echo 'style="border-bottom:1px solid #DFCBDF;margin-top:15px"';
        endif; ?>>
            <?php if($recibidos->inboxnAsunto==''){ ?>  
              <div class="prepend-12" style="margin-left:16px">
                <?php 

                    if($recibidos->inboxnUsuarioRecibeId!=$this->session->userdata('id')):
                        echo anchor('inboxusuarios/borrar/'.$recibidos->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $recibidos->inboxnUsuarioRecibeId,'class'=>'lnkEliminar'));
                    else:
                        echo anchor('inboxusuarios/borrar/'.$recibidos->inboxnId, img(array('src'=>'statics/img/cerrar.jpg', 'style'=>'cursor:pointer')), array('id'=> $recibidos->inboxnUsuarioId,'class'=>'lnkEliminar'));    
                    endif;
                ?>
              </div>
         <?php } ?>
                <div class= "span-1" style=""> 
                     
                    <?php 
                        if($recibidos->statusEU==0):
                            
                        
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
                <div class="span-11" style="border-bottom:10px; margin-left: 13px;margin-right:15px">
                    <?php echo anchor('inboxusuarios/ver/'.$recibidos->inboxnUsuarioId.'/'.$recibidos->inboxnConversacionId,
                          get_name_user($recibidos->inboxnUsuarioId), array('class'=>'menu','style'=>'text-decoration: none; color: #660066;','id'=>$recibidos->inboxnId,'onclick'=>'update();')); ?>
                </div>
        
                <div class="span-7 last" style="margin-left: 13px">
                    <?php /* echo anchor('inboxusuarios/ver/'.$inboxN->inboxnId,
                                       substr($inboxN->inboxnAsunto,0,25).'...', array('class'=>'menu','style'=>'text-decoration: none; color: #666666;','id'=>$inboxN->inboxnId)); */?>
                </div>
            <?php if($recibidos->inboxnAsunto==''){ ?>
                        <div class="span-7 last" style="color: #339900;margin-left: 13px">Respuesta:</div>  
            <?php }else{ ?>
                  <div class="span-7 last" style="margin-left: 13px">
                        <?php  echo anchor('inboxusuarios/ver/'.$recibidos->inboxnUsuarioId.'/'.$recibidos->inboxnConversacionId,
                                           $recibidos->inboxnAsunto, array('class'=>'menu','style'=>'text-decoration: none; color: #666666;','id'=>$recibidos->inboxnId,'onclick'=>'update();')); ?>
                  </div>
            <?php } ?>            
                <div class="prepend-9" style="color: #666666">
                    <?php if($recibidos->inboxnStatus==0): ?>
                    <div class="span-1 last">
                        <?php
                        echo img(array('src'=>'statics/img/read.png','id'=>'imagenR', 'class'=>'buzon'/*,
                                                 'width'=>'20',
                                                 'height'=>'18'*/)); ?>
                    </div>
                    <?php else: ?>
                    <div class="span-1 last">
                        <?php
                        echo img(array('src'=>'statics/img/unread.png','id'=>'imagenR', 'class'=>'buzon'/*,
                                                 'width'=>'20',
                                                 'height'=>'18'*/)); ?>
                    </div>    
              <?php endif; ?>
                    <div>
                        <?php  
                        $fecha = unix_to_human($recibidos->inboxnFecha);
                        $correcta = fecha_acomodo($fecha);
                        echo $correcta;
                     ?>
                    </div>
                
                </div>
                <div class="span-7 last" style="margin-left: 13px">               
                    <?php  echo anchor('inboxusuarios/ver/'.$recibidos->inboxnUsuarioId.'/'.$recibidos->inboxnConversacionId,
                                        substr($recibidos->inboxnMensaje,0,50).'...', array('class'=>'menu','style'=>'text-decoration: none; color: #666666;','id'=>$recibidos->inboxnId,'onclick'=>'update();')); ?>
                </div>
                <div  id="mensajes<?php echo $recibidos->inboxnId;?>" class="span-12 mensajes" style="margin-left: 51px">&nbsp;</div>
            </div>

<?php 
    endforeach; 
?>
<div id="inbox"></div>