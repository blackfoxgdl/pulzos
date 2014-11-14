<?php
/**
* Index view. Show capture form on the appside and 
* generate dinamically all of the other required values
*
* @author axoloteDeAccion <mario.r.vallejo@gmail.com>
* @version 0.1
* @copyright ZavorDigital, 22 February, 2011
* @package Apps
**/
?>
<div class="prepend-4 span-19 box form">
    <?php echo form_open('apps/crear');?>
    <p>
    <?php echo form_label('Nombre de tu Aplicación', 'app-nombre'); ?>
    <?php echo form_input(array(
    'id'=>'app-nombre',
    'name'=>'Apps[appNombre]',
    'value'=>'',
    ));?>
    </p>
    <p>
    <?php echo form_label('Descripción', 'app-descripcion');?>
    <?php echo form_textarea(array(
    'id'=>'app-descripcion',
    'name'=>'Apps[appDescripcion]',
    'value'=>'',
    'cols'=>'30',
    'rows'=>'10',
    ));?>
    </p>
    <p>
    <?php echo form_label('URL del developer', 'app-developer'); ?>
    <?php echo form_input(array(
    'id'=>'app-url_developer',
    'name'=>'Apps[appUrl]',
    'value'=>'',
    ));?>
    </p>
    <p>
    <?php echo form_label('Email de soporte', 'app-soporte');?>
    <?php echo form_input(array(
    'id'=>'app-email_soporte',
    'name'=>'Apps[appEmailSoporte]',
    'value'=>'',
    )); ?>
    </p>
    <p>
    <?php echo form_submit(array(
    'id'=>'app-submit',
    'class'=>'app-submit',
    'value'=>'Crear App',
    )); ?>
    </p>
    <?php echo form_close(); ?>
</div>
</div>
