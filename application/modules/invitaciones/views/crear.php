<?php
/**
 * Vista de la creacion de las invitaciones
 * de los usuarios por medio de los pulzos
 * de las empresas
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 04 April, 2011
 * @package invitaciones
 **/
?>
<div class="container">
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
        <?php echo anchor('pulzosneg/ver/'.$negocios->negocioUsuarioId,img(array('src'=>'statics/img/pulzos1.png',
                                                                                 'border'=>'0'))); ?>
    </div>
    <?php echo img('statics/img/div_profile.png'); ?>
    <h1>
        Invita a tus Amigos
    </h1>
    <!-- h3>
        <?php echo anchor($this->agent->referrer(), 'Regresar'); ?>
    </h3 -->
    <?php echo form_open('invitaciones/crear/'.$ids); ?>
        <h3>
            <?php echo $pulzoComment->pulzosnegAccion; ?>
        </h3>
        <?php echo form_hidden('Invitacion[invitacionMensaje]',$pulzoComment->pulzosnegAccion) ?>
        <br />
        <?php foreach($amigos as $amigo): ?>
            <div class="prepend-1 span-3 box">
                <?php echo img(array('src'=>get_avatar($amigo->id),
                                     'width'=>90,
                                     'height'=>90
                                 ));
                ?>
                <?php
                    echo form_checkbox(array('name'=>'Invitacion[invitacionInvitadoId]',
                                          'id'=>'invitacionAmigos',
                                          'value'=>$amigo->id,                                 
                                           )); 
                    echo $amigo->nombre;
                ?>
            </div>
        <?php endforeach; ?>
        <br />
        <?php echo form_submit(array('id'=>'Invita',
                                     'name'=>'Invitacion')); ?>
    <?php echo form_close(); ?>
</div>
