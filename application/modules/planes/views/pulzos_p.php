<?php
/**
 * Mostrar planes en dos secciones: Eventos y Pulzos
 * TODO: Barra lateral Es promociones y barra inferior son las actividades de tus amigos.
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 10 May, 2011
 * @package Planes
 **/
?>
<script type="text/javascript">
$("#eventos-link").click(function(event){
   event.preventDefault();
   urlToLoad = $(this).attr("href"); 
   $("#canvas").load(urlToLoad);
});
$('.elemento-link').click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
});
</script>
<h1>Planes (Pulzos)</h1>
<h3><?php echo anchor('planes/eventos/'.$this->session->userdata('id'), 'Eventos', array('id'=>'eventos-link')); ?></h3>
<div class="span-18" id="sub-canvas">
<div class="span-17 box">
<?php foreach($planes as $plan): ?>
    <div class="span-17 event">
        <div class="span-5 box avatar">
            <?php echo img(array('src'=>get_avatar($plan->planUsuarioId), 'width'=>'90', 'height'=>'90')); ?>
        </div>
        <p><?php echo $plan->planMensaje; ?></p>
        <p><?php echo $plan->pulzoAccion; ?></p>
        <p>
        <?php foreach($plan->invitaciones as $invitacion): ?>
        <?php echo img(array('src'=>get_avatar($invitacion->invitacionInvitadoId), 'width'=>'30', 'height'=>'30', 'title'=>get_user_name($invitacion->invitacionInvitadoId))); ?>
        <?php endforeach; ?>
        </p>
        <ul>
            <li><?php echo anchor('planes/aceptar/'.$plan->planId, 'Aceptar', array('class'=>'elemento-link')); ?></li>
            <li><?php echo anchor('planes/rechazar/'.$plan->planId, 'Rechazar', array('class'=>'elemento-link')); ?></li>
        </ul>
    </div>
<?php endforeach; ?>
</div>
</div>
