
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#formDatosPersonales").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    url = $("#nextP").attr("href");
    nombreU = $("#nombreUsuario").attr('value');
    apellidoU = $("#apellidoUsuario").attr('value');
    relacionesU = $("#relaciones option:selected").text();
    $("#nombre-header").text();
    $("#nombre-header").text(nombreU);
    $("#personalN").text(nombreU);
    $("#personalA").text(apellidoU);
    $("#pim-estado-civil").text(relacionesU);
    $("#edicion-usuario").load(url);
    $("#id_personales").fadeIn(1000);
    $("#id_personales").fadeOut(2000);
    $(".desplegable").delay(3000).hide("slow");
    $(".menu-ocultar").hide();
    $(".menu-editar").show();
}
</script>
<div class="span-14 last" style="margin-left: 10px"><!-- DIV MAIN -->
    <div class="span-13" style="background-color: #A71E9F; color: #FFFFFF; display: none" id="id_personales">
       Tu informacion personal ha sido gudardada.
    </div>
    <?php echo anchor('usuarios/acerca_de_mi/'.$datosU->id, '', array('id'=>'nextP','style'=>'display:none')); ?>
    <?php echo form_open('usuarios/personales/'.$datosU->id, array('id'=>'formDatosPersonales')); ?>
        <div class="desplegable span-13 last" style="margin-top: 10px">
            <div class="span-3">
                <?php echo form_label('Nombre: ','nombreDelUsuario',array('style' => 'color:#666666')) ?>
            </div>
            <div class="span-10 last" style="margin-bottom: 7px">
                <?php echo form_input(array('id'=>'nombreUsuario',
                                            'name'=>'EditarU[nombre]',
                                            'value'=>$datosU->nombre,
                                            'style'=>'width: 217px; border: 1px solid #DFCBDF;')); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Apellido:','apellidoDelUsuario',array('style' => 'color:#666666')); ?>
            </div>
            <div class="span-10 last"  style="margin-bottom:7px">
                <?php echo form_input(array('id'=>'apellidoUsuario',
                                            'name'=>'EditarU[apellidos]',
                                            'value'=>$datosU->apellidos,
                                            'style'=>'width: 217px;border: 1px solid #DFCBDF;')); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Fecha Nacimiento:', 'fechaNcimiento',array('style'=>'color:#666666')); ?>
            </div>
            <div class="span-10 last" style="margin-bottom: 5px">
                <?php $dia = 'id="dias"
                              class="textDays"'; ?>
                <?php $mes = 'id="mes"
                              class="textMonths"'; ?>
                <?php $ano = 'id="anos"
                              class="textYears"'; ?>
                <?php
                    $corte1 = explode(' ', $datosU->edad);
                    $separacion = explode('-', $corte1[0]);
                ?>
                <?php echo form_dropdown('EditarU[dia]',$dias,$separacion[2],$dia); ?>
                <?php echo form_dropdown('EditarU[mes]',$meses,$separacion[1],$mes); ?>
                <?php echo form_dropdown('EditarU[ano]',$anos,$separacion[0],$ano); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Correo Electronico:','emailDelUsuario',array('style' => 'color:#666666')); ?>
            </div>
            <div class="span-10 last" style="margin-bottom: 5px">
                <?php echo form_input(array('id'=>'emailUsuario',
                                            'name'=>'EditarU[email]',
                                            'value'=>$datosU->email,
                                            'style'=>'width: 217px;border: 1px solid #DFCBDF;')); ?>
                
            </div>
            <div class="span-3">
                <?php echo form_label('Sexo:','sexoDelUsuario',array('style' => 'color:#666666')); ?>
            </div>
            <div class="span-10 last" style="margin-bottom: 7px">
                <?php $options = 'id="sexo"
                                  style="width:217px"
                                  value=""'; ?>
                <?php echo form_dropdown('EditarU[sexo]',
                                         array(2=>'Seleccione su sexo',
                                               0=>'Femenino',
                                               1=>'Masculino'),
                                         $datosU->sexo, $options); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Estado Civil:', 'relacionDelUsuario',array('style' => 'color:#666666')); ?>
            </div>
            <div class="span-10 last" style="margin-bottom: 7px">
                <?php $optionsRelations = 'id="relaciones"
                                           style="width:217px"
                                           value=""'; ?>
                <?php echo form_dropdown('EditarP[relaciones]',
                                         $relaciones,
                                         $datos->relaciones,
                                         $optionsRelations); ?>
            </div>
            <div class="span-8" style="text-align:center; margin-bottom:20px">
                <?php echo form_submit(array('id'=>'guardarDatos',
                                             'value'=>'Guardar',
                                             'class'=>'guardar_datos',
                                             'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
            </div>
        </div>
    <?php echo form_close(); ?>
</div><!-- DIV MAIN -->
