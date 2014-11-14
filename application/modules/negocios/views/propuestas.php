<?php
/**
 * Mostrara los datos del usuario en cuanto
 * a los negocios como opciones de que podria elegir
 * para realizar su invitacion
 *
 **/
?>
<div class="span-12">
    <?php foreach($info_negocios as $negocios): ?>
        <div class="span-12">
            <div class="span-3">
                <?php echo img(array('src'=>get_avatar_negocios($negocios->negocioUsuarioId),
                                     'width'=>90,
                                     'height'=>90)); ?>
            </div>
            <div class="span-6">
                <div style="height: 15px;">
                </div>
                Nombre: <?php echo $negocios->negocioNombre; ?>
                <br />
                Direccion: <?php echo $negocios->negocioDireccion; ?>
                <br />
                e-mail: <?php echo $negocios->negocioEmail; ?>
            </div>
        <div>
    <?php echo anchor('negocios/ver_mas/'.$negocios->negocioUsuarioId, "Ver Mas", array('id'=>'ver_mas_negocio')); ?>
    <?php endforeach; ?>
</div>
