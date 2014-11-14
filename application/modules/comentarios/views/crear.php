<?php
/**
 * Formulario provisional de creación de contenidos. 
 * Esto debe de funcionar como un simple servicio REST
 * Por lo tanto este formulario es redundante. Pero sirve para propósitos de 
 * pruebas
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 28 March, 2011
 * @package default
 **/
?>
<div class="span-24">
    &nbsp;
</div>
<?php echo img('statics/img/div_profile.png'); ?>
<h1>Agregar Comentario</h1>
<div class="formulario">
    <?php echo form_open('comentarios/crear/'.$appData['idContenido'].'/'.$appData['apiKey'].'/'.$appData['id']); ?>
    <p>
    <?php
    form_label('Comentario', 'comentarios-texto');
    ?>
    <?php
    echo form_input(array(
    'name'=>'Comentarios[comentarioTexto]',
    'value'=>'',
    'id'=>'comentarios-texto',
    ));
    ?>
    </p>
    <p>
    <?php 
    echo form_submit(array(
    'value'=>'Comentar'
    ));
    ?>
    </p>
</div>
