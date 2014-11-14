<?php
/**
* Form's view of user's login
*
* @author blackfoxgdl <ruben.alonso21@gmail.com>
* @version 0.1
* @copyright Zavordigital February 22, 2011
* @package Core
**/
?>
<script type="text/javascript">
$(document).ready(function(){
    $('#password-clean').show();
    $('#passwordIngreso').hide();

    $('#password-clean').focus(function(){
        $('#password-clean').hide();
        $('#passwordIngreso').show();
        $('#passwordIngreso').focus();
    });
    $('#passwordIngreso').blur(function(){
        if($('#passwordIngreso').val() == ''){
            $('#password-clean').show();
            $('#passwordIngreso').hide();
        }
    });
});
window.onload = function(){
    document.getElementById('emailIngreso').onfocus = function(){
        if(this.value == 'Email'){
            this.value = '';
        }
    };
    document.getElementById('emailIngreso').onblur = function(){
        if(!this.value){
            this.value = 'Email';
        }
    };
};

</script>
<div id="header1"><!-- HEADER LIQUIDO  ** INICIO ** -->
    <div class="container">
        <div class="span-13 first" id="header_login_form">
            <?php echo anchor('usuarios/',
                              img(array('src'=>'statics/img/logo-pulzos_demo.jpg',
                                        'width'=>'192',
                                        'height'=>'55')));//img('statics/img/logo-pulzos.jpg'); ?>
        </div>
        <div class="span-9" id="header_ingreso">
        <?php echo form_open('usuarios/login'); ?>
            <div class="span-7 last">
                <?php echo form_input(array('id'=>'emailIngreso',
                                            'class'=>'defaultText',
                                            'name'=>'Ingreso[email]',
                                            'value'=>'Email',
                                        )); ?>
                <?php echo form_input(array('id'=>'password-clean',
                                            'class'=>'',
                                            'value'=>'Password')); ?>
                <?php echo form_password(array('id'=>'passwordIngreso',
                                               'class'=>'defaultText',
                                               'name'=>'Ingreso[password]'
                                           )); ?>
                </div>
                <div class="span-2 last" style="margin-left: -20px; margin-top: 1px">
                <?php
                    echo form_submit(array('id'=>'entrar',
                                           'class'=>'',
                                           'style'=>'top: 5px',
                                           'name'=>'submit'));              
                ?>
                </div>
        </div>
        <div class="span-8" id="tab_ingreso">
            <div class="span-3 last" style="margin-left: -10px">    
            <?php echo form_checkbox('recordarme','recordarme',FALSE); ?>&nbsp;Recordarme
        <?php echo form_close(); ?>
            </div>
            <div class="span-5 last" style="margin-top: 1px">
                <?php echo anchor('usuarios/olvidar',
                                  'Olvid&eacute; mi contrase&ntilde;a', array('style'=>'margin-top: 3px;color: #FFFFFF;margin-bottom: 8px;text-decoration:none')); ?>
            </div>
        </div>
    </div>
</div><!-- HEADER LIQUIDO ** FIN ** -->
