<?php
/**
* Ver los planes hechos por mi
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
    </script>
    <ul>
        <li><?php echo anchor('planes/index', 'Crear uno nuevo', array('class'=>'planes-link')); ?></li>
        <li><?php echo anchor('planes/hechas', 'Hechos', array('class'=>'planes-link seleccionado', 'id'=>'eventos-hechos')); ?></li>
        <li><?php echo anchor('planes/recibidas', 'Recibidos', array('class'=>'planes-link', 'id'=>'eventos-recibidos')); ?></li>
        <li><?php echo anchor('planes/aceptadas', 'Aceptados', array('class'=>'planes-link', 'id'=>'eventos-aceptados')); ?></li>
        <li><?php echo anchor('conversaciones/', 'Ver Conversaciones', array('class'=>'planes-link')); ?></li>
    </ul>
    <div class="span-18">
        <?php foreach($planes AS $plan): ?>
        <div class="span-5 box">
            <?php echo img(array('src'=>get_avatar($plan->planUsuarioId), 'width'=>'90', 'height'=>'90')); ?>
            <ul>
                <li><?php echo $plan->negocioNombre; ?></li>
                <li><?php echo $plan->planMensaje; ?></li>
                <li><?php echo anchor('planes/borrar/'.$plan->planId, 'Cancelar', array('class'=>'eventos-borrar')); ?></li>
            </ul>
            <h4>Invitados Confirmados</h4>
            <?php foreach($plan->invitaciones as $invitacion): ?>
            <?php if($invitacion->invitacionAceptado == 1): ?>
            <?php echo img(array('src'=>get_avatar($invitacion->invitacionInvitadoId), 'width'=>'30', 'height'=>'30', 'title'=>get_user_name($invitacion->invitacionInvitadoId))); ?>
            <?php endif; ?>
            <?php endforeach; ?>
            <h4>Invitados por Confirmar</h4>
            <?php foreach($plan->invitaciones as $invitacion): ?>
            <?php if($invitacion->invitacionAceptado == 0): ?>
            <?php echo img(array('src'=>get_avatar($invitacion->invitacionInvitadoId), 'width'=>'30', 'height'=>'30', 'title'=>get_user_name($invitacion->invitacionInvitadoId))); ?>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </div>
