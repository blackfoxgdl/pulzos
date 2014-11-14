<?php
/**
* Vista para crear albumes. Esto solo es la unidad lógica de información. En 
* verdad no tiene nada que ver con el subir imágenes. Son cosas diferentes.
*
* @author axoloteDeAccion <mario.r.vallejo@gmail.com>
* @version 0.1
* @copyright ZavorDigital, 07 March, 2011
* @package Albums
**/
?>
<!-- formulario de captura de albumes. -->
<div class="formulario">
    <p>
    <?php echo form_open('albums/crear'); ?>
    </p>
    <p>
    <?php echo form_label('Nombre del albúm', 'albumNombre'); ?>
    <?php echo form_input(array(
    'id'=>'albumNombre',
    'name'=>'Albums[albumNombre]',
    'value'=>'',
    )); ?>
    </p>
    <p>
    <?php echo form_label('Lugar', 'albumLugar'); ?>
    <?php echo form_input(array(
    'id'=>'albumLugar',
    'name'=>'Albums[albumLugar]',
    'value'=>'',
    ));?>
    </p>
    <p>
    <?php echo form_label('Descripción', 'albumDescripcion'); ?>
    <?php echo form_input(array(
    'id'=>'albumDescripcion',
    'name'=>'Albums[albumDescripcion]',
    'value'=>'',
    ));?>
    </p>
    <p>
    <?php echo form_submit(array(
    'id'=>'albumSubmit',
    'value'=>'Crear Albúm',
    )); ?>
    </p>
    <?php echo form_close(); ?>
</div>
