<?php
/**
 * Metodo que se usa para poder visualizar los pulzos en la plataforma del 
 * usuario, estos se van mostrando uno por uno de todos los negocios
 * que esten registrados en la plataforma, por el momento.
 **/
?>
<script type="text/javascript">
    $('.pulzo-simple').click(function(event){
        event.preventDefault();
        urlToCall = $(event.currentTarget).attr("href");
        $("#texto-menu").load(urlToCall);
    });
</script>
<div class="span-14 last" style="margin-top: 10px">
    <div class="soft-header">
        Pulzos de mi ciudad
    </div>
    <div class="span-13 last" style="margin-top: 10px">
        <?php foreach($usuarios as $pulzo): ?> 
            <div class="span-12">
                <div class="prepend-1 span-2">
                    <?php if($pulzo->pulzoImagenRuta == '0'): ?>
                        <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzoUsuarioId),
                                             'width'=>'100',
                                             'height'=>'100')); ?>
                    <?php else: ?>
                        <?php echo img(array('src'=>get_avatar_pulzo($pulzo->pulzoId),
                                             'width'=>'100',
                                             'height'=>'100')); ?>
                    <?php endif; ?>
                </div>
                <div class="prepend-1 span-8 last" style="margin-top: 10px; margin-bottom: 20px;">
                    <div style="margin-top: 10px" class="interlineado">
                        <span class="pulzos_titulo1">
                            <?php echo $pulzo->pulzoTitulo; ?>
                        </span>
                        <br />
                        <span class="pulzos_titulo2">
                            <?php echo $pulzo->pulzoAccion; ?>
                        </span>
                    </div>
                </div>
                <div class="prepend-2">
                    <span class="right ver-todo-link">
                        <div class="span-7 last">
                            <?php echo anchor('pulzos/ver_simple/'.$pulzo->pulzoId,
                                'ver mas', array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 200px; font-weight: bold', 'class'=>'pulzo-simple')); ?>
                        </div>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
