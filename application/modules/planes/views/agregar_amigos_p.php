<?php
/**
* MOstrar una lista de amigos con checkbox para agregar.
*
* @author axoloteDeAccion <mario.r.vallejo@gmail.com>
* @version 0.1
* @copyright ZavorDigital, 09 May, 2011
* @package default
**/
?>
<h1>Agregar amigos</h1>
<h3><?php echo anchor('pulzos/', 'Regresar')?></h3>
<?php echo form_open('planes/agregar_amigos/'.$last_insert); ?>
<?php foreach($amigos as $amigo): ?>
<div class="span-5 box">
    <?php echo img(array('class'=>'avatar', 'src'=>get_avatar($amigo->amigoAmigoId), 'width'=>'90', 'height'=>'90')); ?>
    <ul>
        <li><?php echo $amigo->nombre; ?></li>
        <li><?php echo $amigo->email; ?></li>
    </ul>
    <p><?php echo form_checkbox(array('name'=>'Amigos[]', 'value'=>'$amigo->amigoAmigoId', 'checked'=>FALSE)); ?></p>
</div>
<? endforeach; ?>
<?php echo form_submit(array('value'=>'Invitar')); ?>
<?php echo form_close(); ?>
