<?php
 /**
  * Vista para el reseteo de
  * la contraseña de usuario
  * usando la liga con la clave
  * encriptada
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  * @version 0.1
  * @copyright Zavordigital February 22, 2011
  * @package Core
  **/
  
  echo doctype();
?>
	<div class="container">
    	<p>
            <div class="prepend-24 last">
                &nbsp;
            </div>
        </p>
        <div class="prepend-3 span-4 last">
            <p id="titulo">
                Recuperar Contrase&ntilde;a
            </p>
        </div>
            <div class="prepend-18 last">
                &nbsp;
        	</div>
        <p>
        	<div class="span-3">
                &nbsp;
            </div>    
            <div class="span-18 last" id="margen">
            	<br />
                <br />
                <div class="prepend-29 last">
                  &nbsp;
                </div>
                <div class="span-4">
                  &nbsp;
                </div>
                <div class="span-10" id="bordes">
                	<div class="prepend-3 last">
                    	&nbsp;
                    </div>
                    <?php echo form_error(); ?>
			        <?php echo form_open('usuarios/nuevo'); ?>
                    	<p>
                            <div class="prepend-2 span-3 last">
                                <?php echo form_label('Contrase&ntilde;a','password'); ?>
                            </div>
                            	<?php echo form_input(array('name'=>'Nuevo[password]',
                                                        	'id'=>'password')); ?>
                            <div class="prepend-2" id="Error">
                                <?php echo form_error('Nuevo[password]'); ?>
                            </div>
                            <br />
                            <div class="prepend-2 span-3 last">
                            	<?php echo form_label('Confirmacion de Contrase&ntilde;a',
													  'password1'); ?>
                            </div>
                            	<?php echo form_input(array('name'=>'Nuevo[password1]',
															'id'=>'password1')); ?>
                            <div class="prepend-2" id="Error">
                            	<?php echo form_error('Nuevo[password1]'); ?>
                            </div>
                        </p>
                        <br />
                        <p>
                        	<div class="prepend-4">
                    			<?php echo form_submit('submit','Recuperar'); ?>
                            </div>
                        </p>
                	<?php echo form_close(); ?>
                    <br />
            	</div>
                <div class="span-10 last">
                	<p>
                    &nbsp;
                    <br />
                    <br />
                    </p>
                </div>
                <div style="height:300px;">
                    <br />
                </div>
            </div>
        </p>
	</div>
    <br />
