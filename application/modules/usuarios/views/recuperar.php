<?php
   /**
    * Form of recover the user's
    * password when forgot it or lost it
    * 
    * @author blackfoxgdl <ruben.alonso21@gmail.com>
    * @version 0.1
    * @copyright Zavordigital February 22, 2011
    * @package Core
    **/
echo doctype();
echo link_tag('statics/css/ext/noregistro.css');
?>
<script type="text/javascript">
function cargar()
{
    email = $("#email").attr('value');
    email = email.replace('@','---');
    url = 'inicio.php?usuarios/checar_email_existe/'+email;
    $.get(url, 
            function(data){
                if(data.id == '1')
                {
                    send = $("#forma_recuperar").attr('action');
                    $.get(send);
                }
                else
                {
                    $("#msj-error").show();
                }
            }, 'json');
    return false;
}

function redireccion()
{
    location.href="http://www.pulzos.com"
}
</script>
	<div class="container">
    	<div class="prepend-24 last">
            &nbsp;
        </div>
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
                    <div id="msj-error" class="prepend-2 span-7 last" style="color: #CE99C9; margin-top: 5px; display: none">
                        El Email no esta registrado. Registrate por favor.
                    </div>
                	<div class="prepend-3 last">
                    	&nbsp;
                    </div>
                    <?php echo form_error(); ?>
			        <?php echo form_open('usuarios/olvidar'); ?>
                        <p>
                            <div class="prepend-2 span-2 last">
                                <?php echo form_label('E-mail','email',array('style'=>'color: #CE99C9')); ?>
                            </div>
                            <?php echo form_input(array('name'=>'email',
                                                        'id'=>'email')); ?>
                            <div class="prepend-2" id="Error">
                                <?php echo form_error('email'); ?>
                            </div>
                        </p>
                        <br />
                        <p>
                        	<div class="prepend-3" style="color: #CE99C9">
                                <?php echo form_submit(array('id'=>'recuperar',
                                                             'name'=>'Recupera')); ?> &oacute;
                    			<?php echo anchor('usuarios', 'registrate en pulzos',
								     	 		array('id'=>'links', 'style'=>'color:#CE99C9; text-decoration: none')); ?>
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
