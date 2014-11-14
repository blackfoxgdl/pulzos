<?php
/**
 * se muestran los comentarios que se actualizaran 
 * cada que se haga un enter, esto solo un div sin necesidad
 * de refrescar otra cosa
 **/
?>
<script type="text/javascript">
$(document).ready(function(){
    $(".eliminar-sub").click(function(event){
        event.preventDefault();
      
        urlDeleteSub = $(event.currentTarget).attr("href");
        $(event.currentTarget).parent().parent().parent().parent().hide();
        $.get(urlDeleteSub);
    });
});
</script>
<div class="span-14">
    <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
    
        <?php $valores_comentarios = count_all_subcomments($planes->planId, '1'); ?><!-- cuenta numero de comments-->
        <?php if($valores_comentarios != 0): ?>
            <?php if($valores_comentarios > 3): ?>
                <?php $ids_comments = get_all_ids($planes->planId, '1'); ?><!--obtiene los ids de los comments -->
                <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                <?php $comentarios = get_subcomments_wall1($planes->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
            <?php else: ?>
                <?php $comentarios = get_subcomments_wall($planes->planId, '1'); ?>
            <?php endif; ?>
            <?php foreach($comentarios as $comentario): ?><!-- FOREACH SUBCOMENTARIOS **INICIO** -->
     
                <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                    <div class="span-11 last"><!-- DIV INICIAL DE SUBCOMENTARIOS **INICIO** -->
                        <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                            <?php if($comentario->statusEU == 0): ?>
                                <?php echo img(array('src'=>get_avatar($comentario->id),
                                                     'width'=>'37px',
                                                     'height'=>'37px')); ?>
                            <?php else: ?>
                                <?php $datos = get_data_company($comentario->id); ?>  
                                <?php echo img(array('src'=>get_avatar_negocios($datos->negocioId),
                                                     'width'=>'37px',
                                                     'height'=>'37px')); ?>
                            <?php endif; ?>
                        </div>
                        <div class="span-9 last" style="margin-top: 5px; margin-left: 20px">
                            <div class="span-12">
                                <div class="span-9">
                                    <span class="pulzos_titulo1">
                                        <?php echo anchor('usuarios/perfil/'.$comentario->id,
                                                           get_complete_username($comentario->id),
                                                           array('style'=>'text-decoration: none', 'class'=>'pulzos_titulo1')); ?>
                                    </span>
                                </div>
                                <div class="span-2 last" style="margin-top: 10px">
                                    
                                </div>
                            </div>
                            <br />
                            <span class="pulzos_titulo2" style="word-wrap: break-word">
                                <?php echo $comentario->comentarioSimple; ?>
                            </span>
                        </div>
                        <div class="prepend-1 span-12 last" style="margin-top: 12px">
                            <div class="span-1" style="margin-left: 25px">
                                <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                     'width'=>'14',
                                                     'height'=>'12')); ?>
                            </div>
                            <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999;">
                                <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);
                                      $fechaCreacionSub = fecha_acomodo($fecha);
                                      echo $fechaCreacionSub; ?>
                            </div>
                           	<div class="prepend-4 span-1 last" style="margin-left: 40px">
                            	<?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                            		<?php echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                          img(array('src'=>'statics/img/eliminar.png',
                                                                    'width'=>'17px',
                                                                    'height'=>'20px')),
                                                          array('class'=>'eliminar-sub')); ?>
                            	<?php endif; ?>
                           	</div>
                        </div>
                    </div>
                </div><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **FIN** -->
            <?php endforeach; ?><!-- FOREACH SUBCOMENTARIOS **FIN** -->
        <?php endif; ?>
    </div>
</div>
