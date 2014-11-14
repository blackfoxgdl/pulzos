
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#formAcercaDe").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
  url = $("#reloadNew").attr("href");
  $("#edicion-usuario").load(url);
  $("#id_acerca").fadeIn(1000);
  $("#id_acerca").fadeOut(2000);
  $(".desplegable-A").delay(3000).hide("slow");
  $(".menu-ocultar-A").hide();
  $(".menu-editar-A").show();
}
</script>
<div class="span-14 last" style="margin-left: 10px">
    <div id="id_acerca" style="background-color: #A71E9F; color: #FFFFFF; display: none" class="span-13">
        Tu informacion acerca de ha sido guardada.
    </div>
    <?php echo anchor('usuarios/estudios_usuario/'.$datosP->usuarioId, '', array('id'=>'reloadNew','style'=>'display:none')); ?>
    <?php echo form_open('usuarios/acerca_de_mi/'.$datosP->usuarioId, array('id'=>'formAcercaDe')); ?>
        <div class="desplegable-A span-13 last" style="margin-top: 10px">
            <div class="span-3">
                <?php echo form_label('Acerca de mi:', 'acercaDeMiUsuarios'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_textarea(array('id'=>'acercaUsuario',
                                               'class'=>'acerca_usuario',
                                               'name'=>'EditarA[acercaDe]',
                                               'cols'=>'25',
                                               'rows'=>'10',
                                               'value'=>$datosP->acercaDe)); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Intereses:', 'interesesDelUsuario'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_textarea(array('id'=>'interesesUsuario',
                                               'class'=>'intereses_usuarios',
                                               'name'=>'EditarA[intereses]',
                                               'cols'=>'25',
                                               'rows'=>'10',
                                               'value'=>$datosP->intereses)); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Profesional:', 'profesionalDelUsuario'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_input(array('id'=>'profesionDelUsuario',
                                            'class'=>'profesion_usuario',
                                            'name'=>'EditarA[profesion]',
                                            'style'=>'width: 217px',
                                            'value'=>$datosP->profesion)); ?>
            </div>
            <div class="span-8" style="margin-bottom: 20px; text-align: center">
                <?php echo form_submit(array('id'=>'guardarAcercaDe',
                                             'name'=>'guardar_acerca_de',
                                             'value'=>'Guardar',
                                             'class'=>'guardar_datos',
                                             'style'=>'background-color: #660066; color: #FFFFFF; border: none; font-size: 12px; height: 20px; margin-top: 8px')); ?>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>
