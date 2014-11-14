<?php
/**
 * Ver mis invitaciones aceptadas
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 12 May, 2011
 * @package planes
 **/
?>
<script type="text/javascript">
$(".planes-link").click(function(event){
    event.preventDefault();
    urlToLoad = $(event.currentTarget).attr("href");
    $("#canvas").load(urlToLoad);
});
$(".eventos-borrar").click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().parent().hide("fast");
});
$(".eventos-rechazar").click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().parent().hide("fast");
});
</script>
<ul>
        <li><?php echo anchor('planes/index', 'Crear uno nuevo', array('class'=>'planes-link')); ?></li>
    <li><?php echo anchor('planes/hechas', 'Hechos', array('class'=>'planes-link', 'id'=>'eventos-hechos')); ?></li>
    <li><?php echo anchor('planes/recibidas', 'Recibidos', array('class'=>'planes-link', 'id'=>'eventos-recibidos')); ?></li>
    <li><?php echo anchor('planes/aceptadas', 'Aceptados', array('class'=>'planes-link, seleccionado', 'id'=>'eventos-aceptados')); ?></li>
        <li><?php echo anchor('conversaciones/', 'Ver Conversaciones', array('class'=>'planes-link')); ?></li>
</ul>
<div class="span-18">
<?php foreach($invitaciones AS $invitacion): ?>
    <div class="span-5 box">
        <?php echo img(array('src'=>get_avatar($invitacion->id), 'width'=>'90', 'height'=>'90')); ?>
        <ul>
            <li><?php echo $invitacion->nombre; ?></li>
            <li><?php echo $invitacion->planMensaje; ?></li>
            <li><?php echo anchor('planes/rechazar/'.$invitacion->invitacionId, 'Cancelar', array('class'=>'eventos-rechazar')); ?></li>
        </ul>
    </div>
<?php endforeach; ?>
</div>
