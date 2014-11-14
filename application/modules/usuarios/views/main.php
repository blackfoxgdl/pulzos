<?php
/**
 * Main view where the user can select where he want to
 * register or access in the platform, if select users
 * he can login with facebook and companies register in
 * the part of form
 **/
echo link_tag('statics/css/ext/noregistro.css');
?>
<div class="container colorbody">
    <div class="span-12" style="margin-top: 65px; margin-left: 50px">
        <?php echo anchor('usuarios/guardar',
                          img(array('src'=>'statics/img/user_boton.png',
                                    'width'=>'321px',
                                    'height'=>'328px')),
                          array('style'=>'text-decoration: none')); ?>
    </div>
    <div class="span-10 last" style="margin-top: 65px">
        <?php echo anchor('negocios/crear',
                          img(array('src'=>'statics/img/empresa_boton.png',
                                    'width'=>'310px',
                                    'height'=>'318px')),
                          array('style'=>'text-decoration: none')); ?>
    </div>
</div>
