<?php 
/*
vista para el contenido , esto es solo relleno. xD
El boton manada a la vistra principal de pulzos con el 
objetivo que el usuario que no este registrado se registre.
*/
?>
			<?php echo form_open('usuarios', array('id'=>'registro-inicio')); ?>
                <div class="span-24 last" style=" background:#521f5a;" align="center">
                     <?php echo form_submit(array('id'=>'registro',
                                                  'class'=>'',
                                                  'name'=>'registroDeUsuario')); ?>
                                                                         
                           
                </div>
            <?php echo form_close(); ?>
            <div class="span-24" style="margin-top: 50px; position: relative">
                    <?php echo img(array('src'=>'statics/img/main_bottom.png',
                                     'height'=>'175px',
                                     'width'=>'928px',
                                     'style'=>'margin-left: -5px; margin-top: -50px')); ?>
                    <br /><br /><br /><br />
                    <?php echo anchor('http://itunes.apple.com/us/app/pulzos/id481729135?l=es&ls=1&mt=8',
                                      img(array('src'=>'statics/img/AppStore2.png',
                                                'height'=>'120px',
                                                'width'=>'810px',
                                                'style'=>'text-decoration: none; margin-left: 45px; margin-top: -50px;')),
                                      array('style'=>'text-decoration: none;', 'target'=>'_blank'));
                    ?>
            </div>
