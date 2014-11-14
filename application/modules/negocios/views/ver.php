<?php
 /**
  * Vista donde muestra el listado
  * de las empresas que se han dado
  * de alta en pulzos
  *
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  * @version 0.1
  * @copyright Zavordigital February 22, 2011
  * @package Core
  **/
?>
<div class="container">
	<div class="span-3">
    	&nbsp;
    </div>
    <div class="span-18">
    	<br />
        <br />
    	<?php foreach($datosN as $datos): ?>
        	<div class="span-4">
            	imagen
            </div>
            <div class="span-10">
            	<?php echo $datos->negocioNombre; ?><br />
                <?php echo $datos->negocioGiro; ?><br />
				<?php echo $datos->negocioDescripcion; ?><br />
                <?php echo $datos->nombre; ?>, <?php echo $datos->nombre; ?><br />
                <?php echo anchor('', 'Ver Perfil', array('id'=>'footer',
														  'style'=>'text-decoration:none')); ?>
            </div>
            <div class="span-3">
            	<?php echo anchor('', img(array('src'=>'statics/img/agregar_contacto.png',
												'border'=>'0'))); ?>
            </div>
            <div class="span-17">
            	&nbsp;
            </div>
        <?php endforeach; ?>
    </div>
    <div class="span-3">
    	&nbsp;
    </div>
</div>
