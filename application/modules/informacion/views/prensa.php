<?php
/**
 * View for information 
 * of journalist
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package Usuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
echo link_tag('statics/css/ext/noregistro.css');
?>
<div class="container" id="f-footer">
    <div class="span-1 last">
        &nbsp;
    </div>
    <div class="span-5" id="titulos_footer">
        Prensa
    </div>
    <div class="span-24 last">
    	<?php echo img('statics/img/division_superior.png'); ?>
    </div>
    <div class="span-24 last">
    <br />
    </div>
    <div class="span-6" id="menu"><!-- menu -->
    	<div class="span-1 last">&nbsp;</div>
        <div class="span-5">
            <?php echo anchor('informacion/nosotros','Nosotros',
							  array('style'=>'text-decoration:none;
							  				  color:#EF3F69')); ?>
        </div>
        <div class="span-1 last">&nbsp;</div>
        <div class="span-5">
            <?php echo anchor('informacion/contacto','Contacto', 
							  array('style'=>'text-decoration:none;
                                              color:#EF3F69;')); ?>
        </div>
        <div class="span-1 last">&nbsp;</div>
        <div class="span-5">
        	<?php echo anchor('informacion/condiciones','Condiciones',
							  array('style'=>'text-decoration:none;
							  				  color:#EF3F69')); ?>
        </div>
        <div class="span-1 last">
            <?php echo img('statics/img/espaciador.png'); ?>
            <?php echo img('statics/img/espaciador.png'); ?>
            <?php echo img('statics/img/espaciador.png'); ?>
            <?php echo img('statics/img/barra_menu.png'); ?>
        </div>
        <div class="span-5">
            Prensa
        </div>
        <div class="span-1 last">&nbsp;</div>
        <div class="span-5">
			<?php echo anchor('informacion/blog','Blog',
							  array('style'=>'text-decoration:none;
                                              color:#EF3F69;')); ?>
        </div>
        <div class="span-1 last">&nbsp;</div>
        <div class="span-5">
            <?php echo anchor('informacion/api','API',
							  array('style'=>'text-decoration:none;
							  				   color:#EF3F69;')); ?>
        </div>
        <div class="span-1 last">&nbsp;</div>
        <div class="span-5">
            <?php echo anchor('informacion/ayuda','Ayuda',
							  array('style'=>'text-decoration:none;
                                              color:#EF3F69;')); ?>
        </div>
    </div><!-- menu -->
    <div class="span-13 append-2 last" id="textos">
        En la fase de maquetación de un documento o una página web o para probar un tipo de letra es necesario visualizar el aspecto del diseño. 
    </div>
    <div class="span-12 last">
        <?php echo img('statics/img/divisor.png'); ?>
    </div>
    <div class="span-10 append-2 last" id="descripcion">
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
        texto ..........<br />
    </div>
    <div class="span-3 last">
        <?php echo img('statics/img/icono_prensa.png'); ?>
    </div>
</div>
<br />
<br />
