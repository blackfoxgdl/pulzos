<?php
  /**
   * View for the email or password incorrect
   * when the user try to login to the account
   *
   * @version 0.1 
   * @copyright ZavorDigital, 21 February, 2011
   * @package Usuarios
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
echo doctype();
echo link_tag('statics/css/ext/noregistro.css');
?>
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
                Vuelve a introducir tus datos.
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
            <div class="span-7 last" style="font-size: 8pt">
                El correo electr&oacute;nico o la contrase&ntilde;a no es v&aacute;lida.
                <br />
                Revisa el uso de may&uacute;sculas.
            </div>
            <div class="span-1 last">
                &nbsp;
            </div>
        </div>
        <div clasS="span-10 last">
            <?php echo form_open('comentados/login/'.$idplan.''); ?>
                <div class="span-3 textForm">

                    <?php echo form_label('e-mail:','email'); ?>
                </div>
                <div class="span-6 last">
                    <?php echo form_input(array('name'=>'Ingreso[email]',
                                                'id'=>'email',
                                                'style'=>'width: 248px',
											    'value'=>set_value('Ingreso[email]'))); ?>
                </div>
                <div class="span-1 last">
                    &nbsp;
                </div>
                <div class="span-3 textForm" style="margin-top: 12px">
                    <?php echo form_label('Password:','password'); ?>
                </div>
                <div class="span-6 last" style="margin-top: 12px">
                    <?php echo form_password(array('name'=>'Ingreso[password]',
                                                   'id'=>'password',
                                                   'style'=>'width: 248px',
												   'value'=>set_value('Ingreso[password]'))); ?>
                </div>
                <div class="span-1">
                    &nbsp;
                </div>
                <div class="span-3">
                    &nbsp;
                </div>
                <div class="span-7 last" style="margin-top: 14px">
                    <div class="span-3" style="margin-top: 4px">
                        <?php echo form_checkbox('recordarme', 'recordarme', FALSE); ?>Recordarme 
                    </div>
                    <div class="span-4 last" align="right" style="margin-left: -20px">
                        <?php echo form_submit(array('id'=>'enter',
                                                     'class'=>'',
                                                     'value'=>'')); ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
        <div class="interlineado2 span-10 last" style="margin-bottom: 25px">
            <div class="span-3">
                &nbsp;
            </div>
            <div class="span-6" style="margin-top: 18px; font-size: 8pt">
                ¿Olvidaste la contrase&ntilde;a? <?php echo anchor('usuarios/olvidar',
                                                                   'pide una nueva', array('class'=>'link-verde')); ?>
            </div>
            <div class="span-3">
                &nbsp;
            </div>
            <div class="span-6" style="margin-top: 10px;font-size: 8pt">
                Si a&uacute;n no eres miembro de pulzos, <?php echo anchor('usuarios',
                                                                           'registrate!', array('class'=>'link-verde')); ?>
            </div>
        </div>
    </div> 
</div>
