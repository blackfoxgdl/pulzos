<?php
/**
 * Vista con la informacion del negocio para que este
 * pueda ser editable y que aparescan los cambios en la
 * parte del perfil de empresas
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#editarNegocio").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    $("#id_personal").fadeIn(1000);
    $("#id_personal").fadeOut(2000);
    $("#desplegable").delay(3000).hide('slow');
    $(".menu-ocultar").hide();
    $(".menu-editar").show();
}
$("#giro").change(function(event){
    event.preventDefault();
    val = $(this).attr("value");
    link = $("#subgiro_link").attr('href');
    $.post(link, 
           {subgiro:val},
           function(data){
               $("#subgiro > option").remove();
               $.each(data, function(index, value){
                   $("#subgiro").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
           },
           "json"
    );
});
</script>
<?php echo anchor('negocios/create_subgiros', '', array('id'=>'subgiro_link', 'style'=>'display: none')); ?>
<div class="span-14 last" id="desplegable"><!-- DIV PRINCIPAL -->
    <div class="span-13" style="background-color: #A71E9F; color: #FFFFFF; display: none; margin-bottom: 10px; margin-left: 5px" id="id_personal">
        Tu informacion personal ha sido guardada
    </div>
    <div class="span-13">
        <?php echo form_open('negocios/personal_negocios/'.$negocios->negocioId, array('id'=>'editarNegocio','name'=>'editarNegocio')); ?>
            <div class="span-13 last">
                <div class="span-2">
                    <?php echo form_label('Nombre:', 'negocioNombre', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'nombreNegocio',
                                                'name'=>'NegociosE[negocioNombre]',
                                                'value'=>$negocios->negocioNombre)); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-2">
                    <?php echo form_label('Direccion: ', 'direccionNegocio', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'negocioDireccion',
                                                'name'=>'NegociosE[negocioDireccion]',
                                                'value'=>$negocios->negocioDireccion)); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-2">
                    <?php echo form_label('Descripcion: ', 'negocioDescripcion', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_textarea(array('id'=>'negocioDescripcion',
                                                   'name'=>'NegociosE[negocioDescripcion]',
                                                   'value'=>$negocios->negocioDescripcion,
                                                   'style'=>'width: 300px; height: 60px')); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-2">
                    <?php echo form_label('Giro: ', 'negocioGiro', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php $opcionesgiros = 'id="giro"
                                            class=""'; ?>
                    <?php echo form_dropdown('NegociosE[negocioGiro]',
                                              $giros,
                                              $negocios->negocioGiro,
                                              $opcionesgiros); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-2">
                    <?php echo form_label('Subcategoria:', 'subcategoriaNegocio', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">                                             
                      <?php $opcionesSubgiros = 'id="subgiro"
                                                   class=""'; ?>
                      <?php echo form_dropdown('NegociosE[negocioSubgiro]',
                                                $subgiros,
                                                $negocios->negocioSubgiro,
                                                $opcionesSubgiros); ?>
               
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-2">
                    <?php echo form_label('Email: ', 'emailNegocio', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'negocioEmail',
                                                'name'=>'NegociosE[negocioEmail]',
                                                'value'=>$negocios->negocioEmail)); ?>
                </div>
            </div>
            <div class="span--13 last">
                <div class="span-2">
                    <?php echo form_label('Telefono: ', 'telefonoNegocio', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'negocioTelefono',
                                                'name'=>'NegociosE[negocioTelefono]',
                                                'value'=>$negocios->negocioTelefono)); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-2">
                    <?php echo form_label('Sitio Web: ', 'sitioWebNegocio', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php echo form_input(array('id'=>'negocioWeb',
                                                'name'=>'NegociosE[negocioSitioWeb]',
                                                'value'=>$negocios->negocioSitioWeb)); ?>
                </div>
            </div>
            <div class="span-8" style="text-align: center; margin-bottom: 20px">
                <?php echo form_submit(array('id'=>'guardarDatos',
                                             'value'=>'Guardar',
                                             'class'=>'guardar_datos',
                                             'style'=>'background-color: #660066; color: #FFFFFF; border: none; font-size: 12px; height: 20px; margin-top: 8px')); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div><!-- DIV PRINCIPAL -->
