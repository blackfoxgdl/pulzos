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
$("#pulzos-link").click(function(event){
    event.preventDefault();
    urlToLoad = $(this).attr("href");
    $("#canvas").load(urlToLoad);
});
$('.elemento-link-aceptar').click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().addClass("pulzo-aceptado");
});
$('.elemento-link-rechazar').click(function(event){
    event.preventDefault();
    urlToCall = $(event.currentTarget).attr("href");
    $.get(urlToCall);
    $(event.currentTarget).parent().parent().hide("fast");
});
</script>
<h1>Planes (Eventos)</h1>
<h3><?php echo anchor('planes/pulzos/'.$this->session->userdata('id'), 'Pulzos', array('id'=>'pulzos-link')); ?></h3>
<div class="span-18" id="sub-canvas">
<div class="span-17 box">
<?php foreach($planes as $plan): ?>
    <div class="span-17 event">
        <div class="span-5 box avatar">
            <?php echo img(array('src'=>get_avatar($plan->planUsuarioId), 'width'=>'90', 'height'=>'90')); ?>
        </div>
        <p><?php echo $plan->planMensaje; ?></p>
        <p><?php echo $plan->eventoAccion; ?></p>
        <p>
        <?php foreach($plan->invitaciones as $invitacion): ?>
        <?php echo img(array('src'=>get_avatar($invitacion->invitacionInvitadoId), 'width'=>'30', 'height'=>'30', 'title'=>get_user_name($invitacion->invitacionInvitadoId))); ?>
        <?php endforeach; ?>
        </p>
        <ul>
            <li><?php echo anchor('planes/aceptar/'.$plan->planId, 'Aceptar', array('id'=>'elemento-link-aceptar')); ?></li>
            <li><?php echo anchor('planes/rechazar/'.$plan->planId, 'Rechazar', array('class'=>'elemento-link-rechazar')); ?></li>
        </ul>
    </div>
<?php endforeach; ?>
</div>
</div>
