<?php
/**
 * Vista que se usara para dar de alta
 * a los negocios que no esten registrados en la
 * parte de pulzos, estos los usuarios podran agregar
 * sus lugares favoritos y poder convertirse en padrino
 **/
?>

<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
var geoCode = new google.maps.Geocoder();
function initialize()
{
    
        var latLng = new google.maps.LatLng(20.673040, -103.375854);
    
  
    var myOptions = {
                        zoom: 15,
                        center: latLng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
    var map = new google.maps.Map($(".mapa").get(0), myOptions);
    var markerImage = new google.maps.MarkerImage($("#imagen").attr('src'),
                      new google.maps.Size(60, 32),
                      new google.maps.Point(0, 0),
                      new google.maps.Point(0, 32));
    var marker = new google.maps.Marker({
                                          position: latLng,
                                          map: map,
                                          icon: markerImage,
                                          draggable: true
                                        });


    //ACTUALIZAR LA INFORMACION DE LA POSICION ACTUAL
        updateMarkerPosition(latLng);
        geocodePosition(latLng);

        //AGREGAR EL EVENTO DE ARRASTRAR LOS DATOS
        google.maps.event.addListener(marker, 'dragstart', function(){
            updateMarkerAddress('...');
        });

        google.maps.event.addListener(marker, 'drag', function(){
            updateMarkerStatus('.....');
            updateMarkerPosition(marker.getPosition());
        });

        google.maps.event.addListener(marker, 'dragend', function(){
            updateMarkerStatus('....');
            geocodePosition(marker.getPosition());
        });

}
/**
 * METODO QUE SE USA PARA EL CODIGO
 * DE LA POSICION
 **/
function geocodePosition(pos)
{
    geoCode.geocode({
    latLng: pos
        }, function(responses){
            if(responses && responses.lenght > 0){
              updateMarkerAddress(responses[0].formatted_address);
            } else {
                updateMarkerAddress('');
            }
        }
    );
}

/**
 * ACTUALIZAR EL DATO DE LOS MARKERS
 * EN EL GOOGLE MAPS
 **/
function updateMarkerStatus(str){
}

/**
 * ACTUALIZA LA POSICION DEL MARCADOR PARA
 * QUE CAPTURAR SU LATITUD Y LONGITUD
 **/
function updateMarkerPosition(latLng)
{
    var uno = latLng.lng();
    var dos = latLng.lat(); 
    document.getElementById('longitud').value = uno;
    document.getElementById('latitud').value = dos;
}
/**
 * ACTUALIZA LA DIRECCION DEL MARCADOR PARA
 * MOSTRARLA LA USUARIO
**/
function updateMarkerAddress(str){
}
$(document).ready(function(){
initialize();
    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
	
$("#pais").change(function(event){
    event.preventDefault();
    val = $(this).attr("value");
    link = $("#estado_link").attr('href');
    $.post(link, 
           {ciudad:val},
           function(data){
               $("#estado > option").remove();
               $.each(data, function(index, value){
                   $("#estado").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
           },
           "json"
    );
});	
		
});

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
<?php echo anchor('usuarios/create_estados', '', array('id'=>'estado_link', 'style'=>'display: none')); ?>
<?php echo anchor('usuarios/perfil', '', array('id'=>'enlaces', 'style'=>'display: none')); ?>
<?php echo anchor('usuarios/create_subgiros', '', array('id'=>'subgiro_link', 'style'=>'display: none')); ?>
<div style="display: none">
    <div id="nombre-usuario-plan">Da de alta un negocio</div>
    <div id="edad-usuario-plan"></div>
    <div id="relacion-usuario-plan"></div>
    <div id="estado-usuario-plan"></div>
</div>
<div style="display: none">
        <?php echo img(array('id'=>'imagen','src'=>'statics/img/pin.png')); ?>
    </div>
<div class="span-14 last" style="margin-top: 27px; margin-bottom: 200px">
    <div class="span-14">
        <?php echo form_open_multipart('usuarios/dar_alta/'.$this->session->userdata('id'),
                             array('id'=>'AltaNegocio')); ?>
            <div class="span-13">
                <div class="titulos_formularios_internos span-12 last" style="margin-left: 2px">
                    Datos del negocio
                </div>
                <div class="span-12 last" style="margin-top: 12px; margin-left: 2px">
                    <div class="formularios_internos span-3 last">
                        <?php echo form_label('Nombre:', 'nombre'); ?>
                    </div>
                    <div class="span-8">
                        <?php echo form_input(array('id'=>'nombreAltaN',
                                                    'name'=>'DarAlta[altaNegocioNombre]',
                                                    'class'=>'',
                                                    'style'=>'width: 380px; height: 20px')); ?>
                    </div>
                </div>
                <div class="span-12 last" style="margin-top: 10px; margin-left: 2px">
                    <div class="formularios_internos span-3 last">
                        <?php echo form_label('Direcci&oacute;n:', 'direccion'); ?>
                    </div>
                    <div class="span-8">
                        <?php echo form_input(array('id'=>'direccionAltaN',
                                                    'class'=>'',
                                                    'name'=>'DarAlta[altaNegocioDireccion]',
                                                    'style'=>'width: 380px; height: 20px')); ?>
                        <?php echo form_input(array('id'=>'coloniaAltaN',
                                                    'class'=>'',
                                                    'name'=>'DarAlta[altaNegocioColonia]',
                                                    'style'=>'width: 380px; height:20px')); ?>
                    </div>
                </div>
                <div class="span-12 last">
                    <div class="formularios_internos span-3 last" style="margin-top: 10px; margin-left: 2px">
                        <?php echo form_label('Descripcion: ', 'descripcion'); ?>
                    </div>
                    <div class="span-8 last" style="margin-top: 5px">
                        <?php echo form_textarea(array('id'=>'',
                                                       'name'=>'DarAlta[altaNegocioDescripcion]',
                                                       'class'=>'',
                                                       'style'=>'width: 380px; height: 50px')); ?>
                    </div>
                </div>
                <div class="span-12 last">
                    <div class="formularios_internos span-3 last" style="margin-top: 10px; margin-left: 2px">
                        <?php echo form_label('Telefono: ', 'telefono'); ?>
                    </div>
                    <div class="span-8 last" style="margin-top: 5px">
                        <?php echo form_input(array('id'=>'',
                                                       'name'=>'DarAltaN[negocioTelefono]',
                                                       'class'=>'',
                                                       'style'=>'width: 100px; height: 20px')); ?>
                    </div>
                </div>
                <div class="span-12 last" style="margin-top: 10px; margin-left: 2px">
                    <div class="formularios_internos span-3 last">
                        <?php echo form_label('Giro:', 'giro'); ?>
                    </div>
                    <div class="span-8">
                        <?php $opcionesgiros = 'id="giro"
                                                class=""'; ?>
                        <?php echo form_dropdown('DarAlta[altaNegocioGiro]',
                                                 $giro,
                                                 '24',
                                                 $opcionesgiros); ?>
                    </div>
                </div>
                <div class="span-12 last" style="margin-top: 10px; margin-left: 2px">
                    <div class="formularios_internos span-3 last">
                        <?php echo form_label('Subgiro:', 'subgiro'); ?>
                    </div>
                    <div class="span-8">
                        <?php $opcionesSubgiros = 'id="subgiro"
                                                   class=""'; ?>
                        <?php echo form_dropdown('DarAlta[altaNegocioSubgiro]',
                                                 $subgiros,
                                                 '148',
                                                 $opcionesSubgiros); ?>
                    </div>
                </div>
                <div class="span-12 last" style="margin-top: 10px; margin-left: 2px">
                    <div class="formularios_internos span-3 last">
                        <?php echo form_label('Pais:', 'pais'); ?>
                    </div>
                    <div class="span-8">
                        <?php $opcionespais = 'id="pais"
                                               class=""'; ?>
                        <?php echo form_dropdown('DarAlta[altaNegocioPais]',
                                                 $pais,
                                                 '',
                                                 $opcionespais); ?>
                    </div>
                </div>
                <div class="span-12 last" style="margin-top: 10px; margin-left: 2px">
                    <div class="formularios_internos span-3 last">
                        <?php echo form_label('Estado:', 'estado'); ?>
                    </div>
                    <div class="span-8">
                        <?php $opcionesestado = 'id="estado"
                                                 class=""'; ?>
                        <?php echo form_dropdown('DarAlta[altaNegocioCiudad]',
                                                 $estado,
                                                 '',
                                                 $opcionesestado); ?>
                    </div>
                </div>
                <!-------------------------------------------------------------------------------------->
                 
            
                <?php  echo form_input(array('id'=>'imagenNombre',
                                            'type'=>'hidden',
                                            'name'=>'Imagenes[imagenNegocioNombre]',
                                            'value'=>'null'));  ?>
           
                <?php  echo form_input(array('id'=>'imagenDescripcion',
                                            'type'=>'hidden',
                                            'name'=>'Imagenes[imagenNegocioDescripcion]',
                                            'value'=>'null')); ?>
         
                    <?php echo form_label('Imagen: ', 'imagenRuta',array('style'=>'color:#660068')); ?>
               
                <?php echo form_upload(array('id'=>'imagenRuta',
                                             'name'=>'imagen',
                                             'value'=>'tftfh')); ?><br/>
          
                <!--------------------------------------------------------------------------------------->
				<?php echo form_label('Selecciona tu ubicacion: ', 'seleccionUbicacion', array('style'=>'color: #666666')); ?>
                    <div class="mapa" style="width: 450px; height: 300px; margin-left: 25px; margin-top: 40px"></div>
                    <input type="hidden" name="DarAltaN[negocioLongitud]" id="longitud" />
                    <input type="hidden" name="DarAltaN[negocioLatitud]" id="latitud" />
                <div class="span-12 last" style="margin-top: 10px">
                    <div class="span-3 last">
                        &nbsp;
                    </div>
                    <div class="span-8">
                        <?php echo form_submit(array('id'=>'',
                                                     'value'=>'Guardar',
                                                     'class'=>'guardar_datos',
                                                     'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
