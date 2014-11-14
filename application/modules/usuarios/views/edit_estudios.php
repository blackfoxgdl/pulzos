
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
        $("#formEstudios").submit(function(event){
            event.preventDefault();
            var opciones = {
                success: cargarVista
            }
            $(this).ajaxSubmit(opciones);
            return false;
        });

        function cargarVista()
        {
            urlE = $("#nextEstudios").attr("href"); 
            $("#edicion-usuario").load(urlE);
            $("#id_estudios").fadeIn(1000);
            $("#id_estudios").fadeOut(2000);
            $(".desplegable-B").delay(3000).hide("slow");
            $(".menu-ocultar-B").hide();
            $(".menu-editar-B").show();
        }
</script>
<div class="span-14 last" style="margin-left: 10px">
    <div class="span-13" style="display: none; background-color: #A71E9F; color: #FFFFFF" id="id_estudios">
       La informacion de tus estudios ha sido guardada.
    </div>
    <?php echo anchor('usuarios/ubicacion_usuario/'.$datosP->usuarioId, '', array('id'=>'nextEstudios', 'style'=>'display: none')); ?>
    <?php echo form_open('usuarios/estudios_usuario/'.$datosP->usuarioId, array('id'=>'formEstudios')); ?>
        <div class="desplegable-B span-13 last" style="margin-top: 10px">
            <div class="span-3">
                <?php echo form_label('Universidad:','escuelaUniversidad'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_input(array('id'=>'escuelaUniversitaria',
                                            'name'=>'EditarE[escuela]',
                                            'value'=>$datosP->escuela,
                                            'style'=>'width: 217px')); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Preparatoria:','escuelaPrepa'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_input(array('id'=>'escuelaPreparatoria',
                                            'name'=>'EditarE[escuela2]',
                                            'value'=>$datosP->escuela2,
                                            'style'=>'width: 217px')); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Secundaria: ', 'escuelaSecu'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_input(array('id'=>'escuelaSecundaria',
                                            'name'=>'EditarE[escuela3]',
                                            'value'=>$datosP->escuela3,
                                            'style'=>'width:217px')); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Primaria: ', 'escuelaPrima'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_input(array('id'=>'escuelaPrimaria',
                                            'name'=>'EditarE[escuela4]',
                                            'value'=>$datosP->escuela4,
                                            'style'=>'width: 217px')); ?>
            </div>
            <div class="span-8" style="text-align: center; margin-bottom: 20px">
                <?php echo form_submit(array('id'=>'guardarDatos',
                                             'class'=>'guardar_datos',
                                             'name'=>'guardar_estudios_usuarios',
                                             'value'=>'Guardar',
                                             'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>
