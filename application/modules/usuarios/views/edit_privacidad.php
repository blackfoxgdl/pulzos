<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#formPrivateUser").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    $("#id_privacidad").fadeIn(1000);
    $("#id_privacidad").fadeOut(2000);
    urlRedirect = $("#reloadPrivate").attr("href");
    location.href = urlRedirect;
}
</script>
<div class="span-14 last" style="margin-left: 10px">
    <div class="span-13" style="background-color: #A71E9F; color: #FFFFFF; display: none" id="id_privacidad">
        Tus datos privados han sido guardados.
    </div>
    <?php echo anchor('usuarios/', '', array('style'=>'display: none', 'id'=>'reloadPrivate')); ?>
    <?php echo form_open('usuarios/privacidad_usuario/'.$id, array('id'=>'formPrivateUser')); ?>
        <div class="desplegable-D span-13 last" style="margin-top: 10px">
            <div class="span-3">
                <?php echo form_label('contrase&ntilde;a:', 'password'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_password(array('id'=>'passwordUser',
                                               'class'=>'user_pass',
                                               'name'=>'EditarP[password]',
                                               'style'=>'width: 217px')); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Confirmar contrase&ntilde;a:','confirmPassword'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_password(array('id'=>'confirmPass',
                                               'class'=>'confirm_password',
                                               'name'=>'EditarP[confirmPass]',
                                               'style'=>'width: 217px')); ?>
            </div>
            <div class="span-8" style="margin-bottom: 20px; text-align: center">
                <?php echo form_submit(array('id'=>'guardarPrivacidad',
                                             'class'=>'guardar_privacidad',
                                             'value'=>'Guardar',
                                             'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>
    
   
