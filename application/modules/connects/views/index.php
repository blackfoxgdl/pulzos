<?php
/**
 * Metodo que se usa para poder hacer un loggin por parte
 * del usuario para poder realizar procesos de pagos de algun
 * servicio o producto que se desee adquirir
 **/
echo link_tag('statics/css/ext/noregistro.css');
?>
<div style="frontend">
    <div class="span-24">
        <div class="letraIndice span-14 last" id="margen" style="margin-top: 50px; margin-bottom: 20px; margin-left: 160px">



        <div class="prepend-3">
            <div class="prepend-2 span-10" style="margin-top: 25px;">
                <?php echo img(array('src'=>'statics/img/PaypulzosHome.png',
                                     'width'=>'146px',
                                     'height'=>'39px')); ?>
            </div>
            <?php echo form_open('connects/index/'.$id_negocio.'/'.$total.'/'.$url); ?>
                <div class="span-10" style="margin-top: 10px">
                    <div class="span-3">
                        <?php echo form_label('E-mail: ', 'email', array('style'=>'font-size: 14px')); ?>
                    </div>
                    <div class="span-7 last">
                        <?php echo form_input(array('id'=>'email_usuario',
                                                    'class'=>'email',
                                                    'name'=>'email',
                                                    'value'=>'',
                                                    'style'=>'')); ?>
                        <br />
                        <?php echo form_error('email'); ?>
                    </div>
                </div>
                <div class="span-10" style="margin-top: 10px;">
                    <div class="span-3">
                        <?php echo form_label('Contrase&ntilde;a: ', 'contrasena', array('style'=>'font-size: 14px')); ?>
                    </div>
                    <div class="span-7 last">
                        <?php echo form_password(array('id'=>'password',
                                                       'class'=>'password_usuario',
                                                       'name'=>'password',
                                                       'value'=>'',
                                                       'style'=>'')); ?>
                        <br />
                        <?php echo form_error('password'); ?>
                    </div>
                </div>
                <div class="span-10" style="margin-top: 10px">
                    <div class="prepend-2" style="margin-bottom: 35px; margin-left: 5px">
                        <?php echo form_submit(array('name'=>'entrar_cuenta',
                                                     'class'=>'imagen-boton-entrar',
                                                     'value'=>'',
                                                     'id'=>'entrar_cuenta_pago')); ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
        </div>
    </div>
</div>
