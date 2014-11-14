<?php
/**
 * Se mostrara la forma para poder realizar la
 * organizacion del evento que desea fuera de la
 * empresa o los negocios, pero le daran como opciones
 * negocios donde se podran surtir las cosas del evento a organizar.
 * Se enviaran invitaciones y se podran asignar encargos de que
 * lleven alguna cosa a cada invitado.
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, April 11, 2011
 * @packacge Invitaciones
 **/
?>
<div class="span-24">
    &nbsp;
</div>
<div class="span-12">
    <div class="span-6 box">
        <div class="span-3 first">
            <?php echo img(array('src'=>get_avatar($usuario->id),
                                 'width'=>90,
                                 'height'=>90)); ?>
        </div>
        <div class="prepend-1" id="titulo1">
            <?php echo $usuario->nombre; ?>
            <br />
            <?php echo $ciudad->nombre . ", " . $pais->nombre; ?>
            <br />
            <?php echo $edad; ?>
        </div>
    </div>
    <div style="height: 25px">
        &nbsp;
    </div>
    <?php echo img('statics/img/flecha1.png'); ?>
    <!-- ?php echo anchor('usuarios/perfil/'.$usuario->id, img(array('src'=>'statics/img/perfil1.png',
                                                                 'border'=>'0'))); ?>
    < ?php echo img('statics/img/flecha1.png'); ? -->
    <?php echo anchor('invitaciones/ver/'.$usuario->id, img(array('src'=>'statics/img/invitaciones1.png',
        'border'=>'0'))); ?>
</div>
<?php echo form_open('invitaciones/organizar/'.$usuario->id); ?>
<div class="span-11">
    <div style="height: 45px;">
        &nbsp;
    </div>
    <div id="imagen">
        	<?php echo form_input(array('name'=>'Invitacion[invitacionPersonalMensaje]',
											'id'=>'comment',
                                            'value'=>set_value('Invitacion[invitacionPersonalMensaje]','Que quieres organizar?'),
                                            'style'=>'height:37px; width: 410px; margin-left:15px; border:none',
                                        )); ?>
    </div>
</div>
<?php echo img('statics/img/div_profile.png'); ?>
<div class="span-24">
    &nbsp;
</div>
<div class="span-16 last">
        <?php foreach($amigos as $amigo): ?>
            <div class="span-3 box" style="margin-left:25px">
                <?php echo img(array('src'=>get_avatar($amigo->id),
                                     'width'=>90,
                                     'height'=>90)); ?>
                <?php echo form_checkbox(array('name'=>'Invitacion[invitacionInvitadoPersonalId]',
                                               'id'=>'invitacionInvitadoId',
                                               'value'=>$amigo->id)); ?>
                <?php echo $amigo->nombre; ?>      
            </div>
        <?php endforeach; ?>
</div>
<div class="span-8 last">
    <?php echo img('statics/img/mapa_invitacion.png'); ?>
    <?php echo form_submit(array('id'=>'Invita',
                                 'name'=>'Invitar')); ?>
</div>
<?php echo form_close(); ?>
