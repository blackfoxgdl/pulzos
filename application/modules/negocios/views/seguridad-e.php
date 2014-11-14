<?php
/**
 * Vista que se encargara de cargar los datos
 * de seguridad de negocios como lo es
 * los datos de password y confirmacion del
 * mismo para editarlos
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#seguridad_pass").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    $("#id_seguridad").fadeIn(1000);
    $("#id_seguridad").fadeOut(2000);
    $("#desplegable-C").delay(3000).hide('slow');
    $(".ocultar_seguridad").hide();
    $(".mostrarSeguridad").show();
}
</script>
<div class="span-14 last" id="desplegable-C">
    <div class="span-13" style="background-color: #A71E9F; color: #FFFFFF; display: none; margin-bottom: 10px; margin-left: 5px" id="id_seguridad">
        Tus datos privados han sido guardados exitosamente
    </div>
    <div class="span-13" id="desplegable-C">
        <?php echo form_open('negocios/seguridadNegocio/'.$negocios->negocioId, array('id'=>'seguridad_pass')); ?>
            <div class="span-13">
                <div class="span-3">
                    <?php echo form_label('Contrase&ntilde;a: ', 'password', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_password(array('id'=>'passNegocios',
                                                   'name'=>'Seguridad[password]',
                                                   'class'=>'passNegocios')); ?>
                </div>
            </div>
            <div class="span-13">
                <div class="span-3">
                    <?php echo form_label('Confirmar Contrase&ntilde;a: ', 'passConfirm', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">  
                    <?php echo form_password(array('id'=>'passConfirm',
                                                   'name'=>'Seguridad[confirmPass]',
                                                   'class'=>'passNegociosConfirm')); ?>
                </div>
            </div>
            <div class="span-8" style="text-align: center; margin-bottom: 20px">
                <?php echo form_submit(array('id'=>'guardarDatos',
                                             'class'=>'guardar_datos',
                                             'value'=>'Guardar',
                                             'style'=>'background-color: #660066; color: #FFFFFF; border: none; font-size: 12px; height: 20px; margin-top: 8px;')); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
