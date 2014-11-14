<?php
/**
 * Mostrar la bandeja de entrada del usuario
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 17 May, 2011
 * @package inbox
 **//*
?>
<script type="text/javascript">
$(".inbox-menu").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#canvas").load(urlToLoad);
});
$(".inbox-accion").click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().parent().parent().hide("fast");
});
$(".inbox-marcar").click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().parent().parent().addClass("pulzo-aceptado");
});
</script>
<ul>
    <li><?php echo anchor('inboxes/crear', 'Mandar Mensaje', array('class'=>'inbox-menu')); ?></li>
    <li><?php echo anchor('inboxes/entrada', 'Buzón de Entrada', array('class'=>'inbox-menu seleccionado')); ?></li>
    <li><?php echo anchor('inboxes/salida', 'Buzón de salida', array('class'=>'inbox-menu')); ?></li>
</ul>
<div class="span-18 datatable">
    <?php foreach($convos as $convo): ?>
    <div class="span-17 box <?php echo 'status-'.$convo->inboxStatus; ?>">
        <?php echo img(array(
        'src'=>get_avatar($convo->inboxUsuarioId),
        'width'=>'90',
        'height'=>'90',
        )); ?>
        <ul class="span-14">
            <li><?php echo $convo->nombre;  ?></li>
            <li><?php echo $convo->inboxAsunto; ?></li>
            <li><?php echo $convo->inboxMensaje ?></li>
        </ul>
        <div class="sub-menu">
            <ul>
                <li><?php echo anchor('inboxes/borrar/'.$convo->inboxId, 'Borrar', array('class'=>'inbox-accion')); ?></li>
                <li><?php echo anchor('inboxes/marcar/'.$convo->inboxId, 'Marcar como leido', array('class'=>'inbox-marcar')); ?></li>
            </ul>
        </div>
    </div>
    <?php endforeach; ?>
</div>*/
?>
<script type="text/javascript">
</script>
<div class="span-14 last">
    hola amigos
</div>
