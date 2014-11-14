<?php
/**
 * Vista con el formulario de la recuperacion
 * del password, en el cual se tendra que teclear
 * los dos password para conocer que sean el mismo,
 * en caso de que sean diferentes se rechazara la solicitud
 **/
echo link_tag('statics/css/ext/noregistro.css');
?>
<script type="text/javascript">
    function cargar()
    {
        password1 = $("#password1").attr('value');
        password2 = $("#password2").attr('value');
        url_check = $("#recovery-pass").attr('href')+'/'+password1+'/'+password2;
        url_form = $("#form-direction").attr('action')+'/'+password1;
        $.get(url_check,
              function(data){
                  if(data.id == '1')
                  {
                      $("#message-error").hide();
                      $.get(url_form);
                      $("#message-success").show();
                      valor = setTimeout("location.href='http://www.pulzos.com/'", 3000);
                  }
                  else
                  {
                      $("#message-error").show();
                  }
              }, 'json');
        return false;
    }
</script>
<?php echo anchor('usuarios/check_password_same/', '', array('style'=>'display: none;', 'id'=>'recovery-pass')); ?>
<div class="container">
    <div class="span-6" style="margin-left: -20px">
        &nbsp;
    </div>
    <div class="letraIndice span-11 last" id="margen" style="margin-top:95px; margin-bottom: 20px">
        <div class="span-10 last" style="margin-top: 20px">
            <div class="span-3">
                &nbsp;
            </div>
            <div class="span-6 last">
                Introduce tu nueva contrase&ntilde;a
            </div>
            <div class="span-1 last">
                &nbsp;
            </div>
        </div>
        <br />
        <div class="span-10 last" style="margin-top: 12px">
            <div class="span-3">
                &nbsp;
            </div>
            <div class="span-7 last" style="font-size: 8pt; display: none" id="message-success">
                Tu passwoird se ha cambiado correctamente. <br />
                En breve te redireccionaremos a la pagina principal.
            </div>
            <div class="span-7 last" style="font-size: 8pt; display: none" id="message-error">
                Las contrase&ntilde;as introducidas no coinciden.<br />
                Por favor revisalas.
            </div>
            <div class="span-1 last">
                &nbsp;
            </div>
        </div>
        <div clasS="span-10 last">
            <?php echo form_open('usuarios/resetear_pass/'.$id, array('onsubmit'=>'return cargar();', 'id'=>'form-direction')); ?>
                <div class="span-3 textForm">
                    <?php echo form_label('Contraseña: ','new_pass'); ?>
                </div>
                <div class="span-6 last">
                    <?php echo form_password(array('name'=>'pass',
                                                   'id'=>'password1',
                                                   'style'=>'width: 248px',
											       'value'=>'')); ?>
                </div>
                <div class="span-1 last">
                    &nbsp;
                </div>
                <div class="span-3 textForm" style="margin-top: 12px">
                    <?php echo form_label('Confirmar Contraseña:','password_confirm'); ?>
                </div>
                <div class="span-6 last" style="margin-top: 20px">
                    <?php echo form_password(array('name'=>'pass2',
                                                   'id'=>'password2',
                                                   'style'=>'width: 248px',
												   'value'=>'')); ?>
                </div>
                <div class="span-1">
                    &nbsp;
                </div>
                <div class="span-3">
                    &nbsp;
                </div>
                <div class="span-7 last" style="margin-top: 14px">
                    <div class="prepend-3 span-4 last" align="right" style="margin-left: -20px">
                        <?php echo form_submit(array('id'=>'enter',
                                                     'class'=>'',
                                                     'value'=>'')); ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
        <div class="interlineado2 span-10 last" style="margin-bottom: 25px">
            &nbsp;

        </div>
    </div>
</div>
