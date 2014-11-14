<script type="text/javascript">
$(".eliminar-sub").click(function(event){
    event.preventDefault();
    urlDeleteSub = $(event.currentTarget).attr("href");
    $.get(urlDeleteSub);
    $(event.currentTarget).parent().parent().parent().parent().parent().hide().remove();
});
</script>
<?php $pulzos_post = get_pulzos_subcomments($anuncios->pulzoId); ?>
    <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
        <?php foreach($pulzos_post as $posteos): ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **INICIO** -->
                            <div class="span-12 last" style="background-color: #DCCEDD; margin-left: 50px; margin-bottom: 10px">
                                <div class="span-11 last"><!-- DIV DE LOS SUBCOMENTARIOS **INICIO** -->
                                    <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                        <?php $datos_like_user = get_complete_userdata($posteos->comentarioUsuarioId); ?>
                                        <?php if($datos_like_user->statusEU == 0): ?>
                                            <?php echo img(array('src'=>get_avatar($posteos->comentarioUsuarioId),
                                                                 'width'=>'36px',
                                                                 'height'=>'36px')); ?>
                                        <?php else: ?>
                                            <?php $datos_negocios = get_data_company($posteos->comentarioUsuarioId); ?>
                                            <?php echo img(array('src'=>get_avatar_negocios($datos_negocios->negocioId),
                                                                 'width'=>'36px',
                                                                 'height'=>'36px')); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="span-9 last" style="margin-top: 5px; margin-left: 10px">
                                        <div class="span-12">
                                            <div class="span-9">
                                                <span class="pulzos_titulo1">
                                                    <?php if($datos_like_user->statusEU == 0): ?>
                                                        <?php echo anchor('usuarios/perfil/'.$posteos->comentarioUsuarioId,
                                                                            get_complete_username($posteos->comentarioUsuarioId),
                                                                            array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                    <?php else: ?>
                                                        <?php echo anchor('negocios/perfil/'.$datos_negocios->negocioId,
                                                                           get_complete_username($posteos->comentarioUsuarioId),
                                                                           array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        <div class="span-2 last">
                                            <?php if($this->session->userdata('idN') == $anuncios->pulzoUsuarioId): ?>
                                                <?php echo anchor('negocios/delete_subcomments_plains/'.$anuncios->pulzoId.'/'.$posteos->comentarioId,
                                                                  img(array('src'=>'statics/img/cerrar.jpg',
                                                                            'width'=>'14px',
                                                                            'height'=>'12px')),
                                                                  array('class'=>'eliminar-sub')); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <br />
                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                        <?php echo $posteos->comentarioTexto; ?>
                                    </span>
                                </div>
                                <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                    <div class="span-1" style="margin-left: 20px">
                                        <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                             'width'=>'14px',
                                                             'height'=>'12px')); ?>
                                    </div>
                                    <div class="span-4" style="margin-left: -20px; magin-top: -3px; font-size: 9pt; color: #999999">
                                        <?php $fecha = unix_to_human($posteos->comentarioFechaCreacion);
                                              $fechaCreacionSub = fecha_acomodo($fecha);
                                              echo $fechaCreacionSub;
                                        ?>
                                    </div>
                                </div>
                            </div><!-- DIV DE LOS SUBCOMENTARIOS **FIN** -->
                        </div>
        <?php endforeach; ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **FIN** -->
    </div>
