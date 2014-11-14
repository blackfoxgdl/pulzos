<?php
/**
 * View for help to the user to resolve the
 * questions or doubts
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package Usuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
echo link_tag('statics/css/ext/noregistro.css');
?>
<div class="container">
    <div class="span-1 last">
        &nbsp;
    </div>
    <div class="span-24" id="titulos_footer">
        Centro de Ayuda
    </div>
    <div class="span-24 last">
    	<?php echo img('statics/img/division_superior.png'); ?>
    </div>
    <!--opciones-->
    <!--cuadro-->
    <?php echo form_open(); ?>
    <div class="span-8" id="titulos_footer">
    	Algun Problema?
     	<div class="span-7 last">
     		<div class="span-7" style="background-color:#6b6c6d">
     			<div class="span-2">
					<?php echo img('statics/img/problema.png'); ?>
                </div>
     			<div class="span-5 last">
     			<div class="span-5 last" id="descripcion">
					<?php echo form_radio(array('id'=>'sesion',
                                                'name'=>'Ayuda[problema]',
                                                'value'=>'sesion',
                                                'checked'=>'true'
                                                )); ?>Iniciar Sesi&oacute;n
     			</div>
     			<div class="span-5 last" id="descripcion">
					 <?php echo form_radio(array('id'=>'conexion',
                                                 'name'=>'Ayuda[problema]',
                                                 'value'=>'conexion'
                                                 )); ?> Conexiones
                </div>
     			<div class="span-5 last" id="descripcion">
					 <?php echo form_radio(array('id'=>'problemas',
                                                 'name'=>'Ayuda[problema]',
                                                 'value'=>'problemas'
                                                 )); ?> Solucion de Problemas
                </div>
     	</div>
     	<div class="span-4 last" align="right">
				<?php echo img('statics/img/vermas.png'); ?>
        </div>
     </div>
     <!--fin cuadro-->
     </div>
     </div>
     <div class="span-8" id="titulos_footer">
      Novato
     <div class="span-7 last">
      <!--cuadro-->
     <div class="span-7" style="background-color:#6b6c6d">
     <div class="span-2"><?php echo img('statics/img/novato.png'); ?></div>
     <div class="span-5 last">
     <div class="span-5 last" id="descripcion">
	 <?php echo form_radio(array('id'=>'publicar',
								 'name'=>'Ayuda[novato]',
								 'value'=>'Publicar Pulzos',
								 'checked'=>'true'
								 )); ?> Publicar Pulzos
     </div>
     <div class="span-5 last" id="descripcion">
	 <?php echo form_radio(array('id'=>'perfil',
								 'name'=>'Ayuda[novato]',
								 'value'=>'Perfil',
								 )); ?> Perfil
     </div>
     <div class="span-5 last" id="descripcion">
	 <?php echo form_radio(array('id'=>'experiencia',
								 'name'=>'Ayuda[novato]',
								 'value'=>'Experiencias',
                             )); ?> Experiencias
     </div>
     </div>
     <div class="span-4 last" align="right">
        <br />
        <?php echo img('statics/img/vermas.png'); ?>
     </div>
     </div>
     <!--fin cuadro-->
     </div>
   </div>
   <div class="span-8 last" id="titulos_footer">
      Denuncia
      <div class="span-7 last">
    <!--cuadro-->
     <div class="span-7" style="background-color:#6b6c6d">
     <div class="span-2"><?php echo img('statics/img/denuncia.png'); ?></div>
     <div class="span-5 last">
     <div class="span-5 last" id="descripcion">
	 <?php echo form_radio(array('id'=>'falso',
								 'name'=>'Ayuda[denuncia]',
								 'value'=>'Perfil Falso',
								 'checked'=>'true'
								 )); ?> Perfil Falso
     </div>
     <div class="span-5 last" id="descripcion">
	 <?php echo form_radio(array('id'=>'hackeo',
								 'name'=>'Ayuda[denuncia]',
								 'value'=>'Hackeo'
								 )); ?> Hackeo
     </div>
     <div class="span-5 last" id="descripcion">
	 <?php echo form_radio(array('id'=>'derechos',
								 'name'=>'Ayuda[denuncia]',
								 'value'=>'Derechos De Autor'
								 )); ?> Derechos De Autor
     </div>
     </div>
     <div class="span-4 last" align="right">
	 	<?php echo img('statics/img/vermas.png'); ?>
      </div>
     </div>
     <!-- fin cuadro-->
     </div>
   </div>
   <!--Fin Opciones-->
   <div class="span-24">
   		<br /><br />
        <br /><br />
        <br /><br />
        <br /><br />
        <br /><br />
        <br /><br />
        <br /><br />
   </div>
   <?php echo form_close(); ?>
   </div>
</div>
