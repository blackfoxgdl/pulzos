<?php
/**
 * View with form for the users
 * contact the personal or support
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
       	Contacto
    </div>
    <div class="span-24 last">
    	<?php echo img('statics/img/division_superior.png'); ?>
    </div>
    <div class="span-24 last">
    <br />
     </div>
    <div class="span-6" id="menu"><!-- menu -->
    	<div class="span-1 last">
        	&nbsp;
        </div>
        <div class="span-5">
            <?php echo anchor('informacion/nosotros','Nosotros',
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
            <?php echo anchor('informacion/contacto','Contacto', 
						array('style'=>'text-decoration:none;
                                        color:#EF3F69;')); ?>
        </div>
        <div class="span-1 last">
        	&nbsp;
        </div>
        <div class="span-5">
            <?php echo anchor('informacion/condiciones','Condiciones',
						array('style'=>'text-decoration:none;
                                        color:#EF3F69;')); ?>
        </div>
        <div class="span-1 last">&nbsp;</div>
        <div class="span-5">
            <?php echo anchor('informacion/prensa','Prensa',
						array('style'=>'text-decoration:none;
                                        color:#EF3F69;')); ?>
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
    <div class="span-13 append-2 last" id="titulos_footer">
        Para recibir mas informacion sobre nosotros ingresa a nuestro blog o contactanos en las siguientes direcciones. 
    </div>
    <div class="span-12 last">
        <?php echo img('statics/img/divisor.png'); ?>
    </div>
    <div class="span-10 last">
        <div class="span-13 append-2 last" id="descripcion">
         <!-- formulario -->
		<div class="span-13 last">
        <div class="span-2">
			<?php echo anchor('http://www.pulzos.com/blog/', 
						img(array('src'=>'statics/img/icono_contacto_uno.png',
								  'border'=>'0',
								  'alt'=>'Blog',
								  'title'=>'Blog'))); ?>
        </div>
        <div class="span-2">
        	<?php echo anchor('http://www.facebook.com/pulzos', 
						img(array('src'=>'statics/img/icono_contacto_fb.png',
								  'border'=>'0',
								  'alt'=>'Facebook',
								  'title'=>'Facebook de Pulzos'))); ?>
        </div>
        <div class="span-2">
        	<?php echo anchor('http://twitter.com/pulzos_oficial',
						img(array('src'=>'statics/img/icono_contacto_twt.png',
								  'border'=>'0',
								  'alt'=>'Twitter',
								  'title'=>'Twitter de Pulzos'))); ?>
        </div>
        <div class="span-2">
        	<?php echo anchor('',
						img(array('src'=>'statics/img/icono_contacto_empresas.png',
								  'border'=>'0',
								  'alt'=>'Empresas',
								  'title'=>'Contacto Empresas'))); ?>
        </div>
        <div class="span-2 last">
        	<?php echo mailto('atencion@pulzos.com',
						img(array('src'=>'statics/img/icono_contacto_mail.png',
								  'border'=>'0',
								  'alt'=>'Mail',
								  'title'=>'Contacto E-mail'))); ?>
        </div>
    </div>
    <div class="span-13">
     <br />
     <br />
     <br />
     <br />
     <br />
     <br />
     <br />
     <br />
     <br />
     <br />
     <br />
     <br />    
   </div>
    </div>
   </div>
</div>




