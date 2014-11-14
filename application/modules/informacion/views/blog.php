<?php
/**
 * View for show the blog and redirect 
 * the user to it
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package Usuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
echo link_tag('statics/css/ext/noregistro.css');
?>
<div class="container" id="f-footer">
    <div class="span-5" id="titulos_footer">
       	Blog
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
        <div class="span-1 last">&nbsp;</div>
        <div class="span-5">
            <?php echo anchor('informacion/prensa','Prensa',
							   array('style'=>'text-decoration:none;
                                               color:#EF3F69;')); ?>
        </div>
        <div class="span-1 last">
            <?php echo img('statics/img/espaciador.png'); ?>
            <?php echo img('statics/img/espaciador.png'); ?>
            <?php echo img('statics/img/espaciador.png'); ?>
            <?php echo img('statics/img/barra_menu.png'); ?>
        </div>
        <div class="span-5">
			Blog
        </div>
        <div class="span-1 last">&nbsp;</div>
        <div class="span-5 last">
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
        M&aacute;ntente al tanto de todo lo que integra el universo de Pulzos.
    </div>
    <div class="span-3">
        <?php echo img('statics/img/icono_nosotros.png'); ?>
    </div>
    <div class="span-12 last">
        <?php echo img('statics/img/divisor.png'); ?>
    </div>
    <div class=" prepend-2 span-8 append-2 last" id="descripcion">
        <?php echo anchor('http://www.pulzos.com/blog/', 
						img(array('src'=>'statics/img/icono_blog.png',
								  'border'=>'0',
								  'alt'=>'Blog',
								  'title'=>'Blog'))); ?>
    </div>
</div>
<br />
<br />
