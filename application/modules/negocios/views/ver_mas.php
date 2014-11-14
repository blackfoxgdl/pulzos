<?php
/**
 * vista para ver mas de negocios
 *
 **/
$result = get_images_company($negocios->negocioUsuarioId);
?>
<div class="span-11 box_address append-bottom" class="color: #240004;">
            Nombre: <?php echo $negocios->negocioNombre; ?>
            <br />
            Direcci&oacute;n: <?php echo $negocios->negocioDireccion; ?>
            <br />
            E-mail: <?php echo $negocios->negocioEmail; ?>
        </div>
        <div class="span-11 append-bottom" style="font-size: 1.5em; color:#EF3F69;">
            GALERIAS
        </div>
        <?php if($albums == 0): ?>
            <div class="span-6">
                <?php echo "No hay imagenes del negocio actualmente."; ?>
            </div>
        <?php else: ?>
        <?php foreach($result as $images): ?>
            <div class="span-3">
                <?php echo img(array('src'=>$images->imagenNegocioRuta,
                                     'width'=>90,
                                     'height'=>90)); ?>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <div class="span-12">
            &nbsp;
        </div>
        <div class="span-11">
            <div style="color: #EF3F69; font-size: 1.5em">
                DESCRIPCION
            </div>
            <br />
            <div style="color: #240004">
                <?php echo $negocios->negocioDescripcion; ?>
            </div>
        </div>
        <?php echo anchor('amigos/ver_amigos/'.$negocios->negocioUsuarioId, 'Invitar', array('id'=>'amigos_invitar')); ?> 
</div><!-- COLUMNA CENTRO - MITAD - ->
