<?php 
/**
 * Shows apps in a simple and pretty interface
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 24 February, 2011
 * @package Apps
 **/
?>
<div class="container">
<h1><?php echo anchor('apps/crear', 'Crear nueva App'); ?></h1>
<?php foreach($apps as $app): ?>
<div class="row span-6 box">
<h3><?php echo $app->appNombre; ?><h3>
<p>Usuario: <?php echo $app->nombre; ?></p>
<p>appId: <?php echo $app->appId; ?> </p>
<p>apiKey: <?php echo wordwrap($app->appApiKey, 27, '<br />', true); ?></p>
<p>apiSecret: <?php echo wordwrap($app->appApiSecret, 27, '<br />', true); ?></p>
<p><?php echo $app->appEmailSoporte; ?></p>
<p><?php echo anchor('apps/editar/'.$app->appId, 'Editar'); ?></p>
<p><?php echo anchor('apps/borrar/'.$app->appId, 'Borrar'); ?></p>
</div>
<?php endforeach; ?>
</div>
