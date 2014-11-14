<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#formUbicacionM").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    url = $("#link_update").attr('href');
    url_complete = url + '/' + $("#ciudad").val();
    $.get(url_complete,
          function(data){
              $("#update-links-company").html(data);
          }, 'html');
    ciudadU = $("#ciudad option:selected").text();
    urlU = $("#reloadUbication").attr("href");
    ciudad = $("#ciudad option:selected").text();
    $("#localidad-header").text(ciudad);
    $("#pim-localidad").text(ciudadU);
    $("#edicion-usuario").load(urlU);
    $("#id_ubicacion").fadeIn(1000);
    $("#id_ubicacion").fadeOut(2000);
}

$(document).ready(function(){

    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);

    $("#paisUser").change(function(event){
        event.preventDefault();
        val = $(this).attr("value");
        link = $("#estado_link").attr('href');
        $.post(link, 
               {ciudad:val},
               function(data){
                   $("#ciudad > option").remove();
                   $.each(data, function(index, value){
                       $("#ciudad").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                    });
               },
               "json"
        );
    });
});
</script>
<?php echo anchor('usuarios/create_estados', '', array('id'=>'estado_link', 'style'=>'display: none')); ?>
<div style="display: none">
    <div id="nombre-usuario-plan">
        Cambio de ubicaci&oacute;n
    </div>
</div>
<div class="span-14 last" style="margin-left: 10px">
    <div class="span-13" style="display: none; color: #FFFFFF; background-color: #A71E9F" id="id_ubicacion">
        Tu datos de ubicacion han sido guardados.
    </div>
    <?php echo anchor('usuarios/privacidad_usuario/'.$datosU->id, '', array('id'=>'reloadUbication','style'=>'display:none')); ?>
    <?php echo anchor('usuarios/update_links_company_users', '', array('id'=>'link_update', 'style'=>'display: none')); ?>
    <?php echo form_open('usuarios/ubicacion_usuario/'.$datosU->id, array('id'=>'formUbicacionM')); ?>
        <div class="desplegable-C span-13 last" style="margin-top: 10px;">
            <div class="span-3">
                <?php echo form_label('Pais:','pais'); ?>
            </div>
            <div class="span-10 last">
                <?php $optionsCountry = 'id="paisUser"
                                         class=""
                                         style="width: 217px"
                                         value=""'; ?>
                <?php echo form_dropdown('EditarU[pais]',
                                         $pais,
                                         $datosU->pais,
                                         $optionsCountry); ?>
            </div>
            <div class="span-3">
                <?php echo form_label('Ciudad: ', 'ciudadUser'); ?>
            </div>
            <div class="span-10 last">
                <?php $optionsCity = 'id="ciudad"
                                      class=""
                                      value=""
                                      style="width: 217px"'; ?>
                <?php echo form_dropdown('EditarU[ciudad]',
                                         $ciudad,
                                         $datosU->ciudad,
                                         $optionsCity); ?>
            </div>
            <div class="span-3">    
                <?php echo form_label('Localidad: ', 'localidad'); ?>
            </div>
            <div class="span-10 last">
                <?php echo form_input(array('id'=>'localidadUser',
                                            'name'=>'EditarP[localidad]',
                                            'value'=>$datosP->localidad,
                                            'style'=>'width: 217px')); ?>
            </div>
            <div class="span-8" style="margin-bottom: 20px; text-align: center">  
                <?php echo form_submit(array('id'=>'guardarUbicacion',
                                             'class'=>'guardar_ubicacion',
                                             'value'=>'Guardar',
                                             'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>
