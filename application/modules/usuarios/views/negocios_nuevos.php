<?php
/**
 * Vista que se usa para actualizar a los
 * amigos con los cuales un usuario pueda
 * observar sus empresas, ya sean si se eliminan
 * o se agregan nuevas empresas se vaya
 * actualizando
 **/
?>
<div class="span-4 last" style="width: 160px; border-bottom: 1px solid #DBDBDB; margin-top: 5px">
    <div class="span-4 last" style="margin-left: 15px">
        <?php $business = get_bussines_eight($usuario->id); ?>
        <?php foreach($business as $negociosDatos): ?>
            <div class="span-1" style="margin-right: 10px">
                <?php echo anchor('negocios/perfil/'.$negociosDatos->seguidorNegocioId,
                                    img(array('src'=>get_avatar_negocios($negociosDatos->seguidorNegocioId),
                                              'width'=>'37px',
                                              'height'=>'37px'))); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
