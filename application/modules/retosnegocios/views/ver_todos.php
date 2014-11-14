<?php
/**
 * Vista que se encarga de mostrar todos los retos que se
 * tengan de las empresas que esten inscritas en la plataforma
 * virtual de pulzos, esto es que al momento de dar ver mas se muestren
 * con sus respectivos links
 **/
?>
<script type="text/javascript">
//METODO PARA REDIRECCIONAR LOS COMENTARIOS
$(".comentar").click(function(event){
    event.preventDefault();
    urlComment = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlComment);
});

//METODO PARA REDIRECCIONAR VER MAS
$(".pulzo-empresa").click(function(event){
    event.preventDefault();
    urlVer = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlVer);
});
</script>
<div class="span-14 last" style="margin-top: 20px">
    <div class="soft-header">
        Retos de mi ciudad
    </div>
    <div class="span-13 last" style="margin-top:10px"><!-- DIV INICIAL PARA MOSTRAR TODOS LOS RETOS -->
        <?php foreach($retos as $reto): ?>
            <div class="span-12">
                <div class="prepend-1 span-2">
                    <?php if($reto->pulzoImagenRuta == '0'): ?>
                        <?php echo img(array('src'=>get_avatar_negocios($reto->pulzoUsuarioId),
                                             'width'=>'100',
                                             'height'=>'100')); ?>
                    <?php else: ?>
                        <?php echo img(array('src'=>get_avatar_pulzo($reto->pulzoId),
                                             'width'=>'100',
                                             'height'=>'100')); ?>
                    <?php endif; ?>
                </div>
                <div class="prepend-1 span-8 last" style="margin-top: 10px; margin-bottom: 20px"><!-- DIV PARA LA MUESTRA DE LOS RETOS -->
                    <div style="margin-top: 10px" class="interlineado"><!-- DIV QUE SE USA PARA CONTENER LA INFO DEL RETO -->
                        <span class="pulzos_titulo1">
                            <?php if($reto->pulzoTitulo != ""): ?>
                                <?php echo $reto->pulzoTitulo; ?>
                            <?php endif; ?>
                        </span>
                        <br />
                        <span class="pulzos_titulo1">
                            Tipo de Reto:
                        </span>
                        <span class="pulzos_titulo2">
                            <?php echo get_tipo_reto($reto->pulzoTipoEventoId); ?>
                        </span>
                        <br />
                        <?php if($reto->pulzoTipoEventoId == 2): ?>
                            <span class="pulzos_titulo1">
                                Tiempo:
                            </span>
                            <span class="pulzos_titulo2">
                                <?php echo $reto->pulzoDuracionReto; ?>
                            </span>
                            <br />
                        <?php endif; ?>
                        <?php if($reto->pulzoTipoEventoId == 4): ?>
                            <span class="pulzos_titulo1">
                                Numero de Asistentes:
                            </span>
                            <span class="pulzos_titulo2">
                                <?php echo $pulzo->pulzoNumeroAsistentes; ?>
                            </span>
                            <br />
                        <?php endif; ?>
                        <span class="pulzos_titulo2">
                            <?php echo $reto->pulzoAccion; ?>
                        </span>
                    </div><!-- TERMINA DIV QUE SE USA PARA CONTENER EL RETO -->
                    <div class="prepend-2" style="margin-top: 10px"><!-- DIV QUE CONTIENEN LOS DATOS DE LINKS DE COMENTAR Y MAS -->
                        <span class="right ver-todo-link">
                            <div class="span-6 last">
                                <?php if($this->session->userdata('idN') != $reto->pulzoUsuarioId): ?>
                                    <div class="span-2 first">
                                        <?php echo anchor('pulzos/pulzo_comentario/'.$reto->pulzoUsuarioId.'/'.$this->session->userdata('id').'/'.$reto->pulzoId,
                                                          'Comentar', array('id'=>'comentarReto', 'class'=>'comentar','style'=>'color: #8D6E98; text-decoration: none; margin-left: 100px')); ?>
                                    </div>
                                <?php endif; ?>
                                <?php echo anchor('retosnegocios/ver_reto/'.$reto->pulzoId,
                                    'ver mas', array('id'=>'', 'class'=>'pulzo-empresa', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: 100px;')); ?>
                            </div>
                        </span>
                    </div><!-- DIV QUE CONTIENEN LOS DATOS DE LINKS DE COMENTAR Y MAS -->
                </div>
            </div><!-- DIV PARA LA MUESTRA DE TODA LA INFORMACION DE LOS RETOS -->
        <?php endforeach; ?>
    </div><!-- DIV FINAL PARA MOSTRAR TODOS LOS RETOS -->
</div>
