<?php
/**
 * Vista que se usara para poder actualizar
 * los followers una vez que se hayan aceptado o
 * que se hayan rechazado
 **/
?>
<div class="span-4 last" style="width: 160px; border-bottom: 1px solid #DBDBDBD; margin-top: 5px">
    <div class="span-4 last" style="margin-left: 15px">
        <?php $friends = get_followers_company($negocios->negocioId); ?>
        <?php if($friends != ""): ?>
            <?php foreach($friends as $followers): ?>
                <div class="span-1">
                    <?php echo img(array('src'=>get_avatar($followers->seguidorUsuarioId),
                                         'width'=>'37px',
                                         'height'=>'37px',
                                         'title'=>get_complete_username($followers->seguidorUsuarioId))); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
