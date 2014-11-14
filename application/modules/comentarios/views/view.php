<?php
/**
 * Vista de comentarios de un elemento. También esta es redundante. Ya que toda 
 * la interacción debe de ser asincrona.
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 28 March, 2011
 * @package Comentarios
 **/
?>
<div class="span-24">
    &nbsp;
</div>
<?php echo img('statics/img/div_profile.png'); ?>
<h1><?php echo anchor('comentarios/crear/'.$id_elemento.'/'.$api, 'Comentar'); ?></h1>
<?php foreach($comentarios as $comentario): ?>
<div class="row span-23 box">
    <div class="avatar span-3">
        <?php echo img(array(
        'src'=>get_avatar($comentario->comentarioUsuarioId),
        'width'=>'90', 'height'=>'90')); ?>
    </div>
    <div class="comentario span-20 last">
    <p class="nombre_usuario"><?php echo $comentario->nombre; ?></p>
    <p class="comentario_contenido"><?php echo $comentario->comentarioTexto; ?></p>
    <p class="menu"><?php echo anchor('comentarios/borrar/'.$comentario->comentarioId, 'Borrar'); ?></p>
    </div>
</div>
<?php endforeach; ?>
