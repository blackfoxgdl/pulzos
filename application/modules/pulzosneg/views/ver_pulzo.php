<?php
/**
 * Se usara para mostrar el pulzo que
 * el usuario a seleccionado de sus empresas
 * que aparecen promocionando cosas
 * en la barra lateral de su perfil.
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 11 April. 2011
 * @package Pulzos del Negocio
 **/
?>
<div class="span-24">
    &nbsp;
</div>
<div class="span-24 last">
    <div class="span-6 box">
        <div class="span-3 first">
            <?php echo img(array('src'=>get_avatar_negocios($pulzos->negocioUsuarioId),
                                 'width'=>90,
                                 'height'=>90)); ?>
        </div>
        <div class="prepend-1">
            <?php echo $pulzos->negocioNombre; ?>
            <br />
            <?php echo $ciudad->nombre . ", " . $pais->nombre; ?>
            <br />
            <?php echo $giro->nombre; ?>
        </div>
    </div>
    <div style="height: 25px:">
        &nbsp;
    </div>
    <?php echo img('statics/img/flecha1.png'); ?>
    <?php echo anchor('negocios/perfil/'.$pulzos->negocioUsuarioId, img(array('src'=>'statics/img/perfil1.png',
                                                                              'border'=>'0'))); ?>
    <?php echo img('statics/img/flecha1.png'); ?>
    <?php echo anchor('pulzosneg/ver/'.$pulzos->negocioUsuarioId, img(array('src'=>'statics/img/pulzos1.png',
                                                                            'border'=>'0'))); ?>
</div>
<?php echo img('statics/img/div_profile.png'); ?>
<div class="span-24 last">
    &nbsp;
    &nbsp;
</div>
<div class="span-6">
    <?php echo img(array('src'=>get_avatar_negocios($pulzos->negocioUsuarioId),
                         'width'=>150,
                         'height'=>150)); ?>
</div>
<div class="span-14">
    <?php echo $pulzos->pulzosnegAccion; ?>
</div>
<div class="span-6 first">
    &nbsp;
</div>
<div class="span-14 last">
    <?php echo anchor('invitaciones/crear/'.$pulzos->pulzosnegId.'/'.$pulzos->pulzosnegNegocioId, 'Invitar a mis amigos'); ?>
    &nbsp;&nbsp;&nbsp;
    <?php echo anchor('pulzosneg/ver/'.$pulzos->negocioUsuarioId, 'Ver otras promociones'); ?>
</div>
<div class="span-15 last" style="height: 150px;">
    &nbsp;
</div>
