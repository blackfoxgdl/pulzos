<?php
/**
 * Vista para visualizar los pulzos que se han puesto
 * por parte de la empresa, todas las ofertas publicadas
 * para que los usuarios puedan verlas
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 30 March, 2011
 * @package Pulzos de Negocios
 **/
?>
<div class="span-24">
    &nbsp;
</div>
<div class="span-24 last">
    <div class="span-6 box">
        <div class="span-3">
            <?php echo img(array('src'=>get_avatar_negocios($negocios->negocioUsuarioId),
                                 'width'=>90,
                                 'height'=>90)); ?>
        </div>
        <div class="prepend-1">
            <?php echo $negocios->negocioNombre; ?>
            <br />
            <?php echo $ciudad->nombre . ', ' . $pais->nombre; ?>
            <br />
            <?php echo $giro->nombre; ?>
        </div>
    </div>
    <div style="height: 25px;">
        &nbsp;
    </div>
    <?php echo img('statics/img/flecha1.png'); ?>
    <?php echo anchor('negocios/perfil/'.$negocios->negocioUsuarioId, img(array('src'=>'statics/img/perfil1.png',
                                    'border'=>'0'))); ?>
    <?php echo img('statics/img/flecha1.png'); ?>
    <?php echo img('statics/img/pulzos1.png'); ?>
</div>
<?php echo img('statics/img/div_profile.png'); ?>
<h1>
    <?php echo anchor('pulzosneg/crear/' . $pulzosNeg[0]->pulzosnegNegocioId, 'Pulzar'); ?>
</h1>
<?php  foreach($pulzosNeg as $pulzo): ?>
<div class="row span-23 box">
    <div class="avatar span-3">
        <?php echo img(array('src'=>get_avatar_negocios($pulzo->pulzosnegNegocioId),
                             'width'=>90,
                             'height'=>90            
                            )); ?>
    </div>
    <div class="pulzos span-20 last">
        <p class="nombre_usuario">
            <?php echo $pulzo->nombre; ?>
        </p>
        <p class="pulzos_accion">
            <?php echo $pulzo->pulzosnegAccion; ?>
        </p>
        <p class="menu">
            <?php echo anchor('pulzosneg/borrar/' . $pulzo->pulzosnegId, 'Borrar'); ?>
            <?php echo anchor('', 'Invitar Amigos'); ?>
        </p>
    </div>
</div>
<?php endforeach; ?>
