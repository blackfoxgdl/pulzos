<?php
/**
 * Vista que carga los datos de ubicacion del negocio
 * los cuales desde este apartado se podran modificar
 * o editar para que se actualicen en el negocio
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
var geoCode = new google.maps.Geocoder();
function initialize()
{
    <?php if($negocios->negocioLatitud == '' && $negocios->negocioLongitud == ''): ?>
        var latLng = new google.maps.LatLng(20.673040, -103.375854);
    <?php else: ?>
        var latLng = new google.maps.LatLng(<?php echo $negocios->negocioLatitud; ?>, <?php echo $negocios->negocioLongitud; ?>);
    <?php endif; ?>
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
});

$("#forma-ubicacion").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    $("#id_ubicacion").fadeIn(1000);
    $("#id_ubicacion").fadeOut(2000);
    $("#desplegable-U").delay(3000).hide('slow');
    $(".ocultar_ubicacion").hide();
    $(".mostrarUbicacion").show();
}

$("#editar-mapa").click(function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    location.href = url;
});

$("#paisNegocio").change(function(event){
    event.preventDefault();
    val = $(this).attr("value");
    link = $("#estado_link").attr('href');
    $.post(link, 
           {ciudad:val},
           function(data){
               $("#ciudadNegocio > option").remove();
               $.each(data, function(index, value){
                   $("#ciudadNegocio").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
           },
           "json"
    );
});
</script>
<?php echo anchor('usuarios/create_estados', '', array('id'=>'estado_link', 'style'=>'display: none')); ?>
<div class="span-14 last" id="desplegable-U">
    <div style="display: none">
        <?php echo img(array('id'=>'imagen','src'=>'statics/img/pin.png')); ?>
    </div>
    <div class="span-13" style="display: none; color: #FFFFFF; background-color: #A71E9F" id="id_ubicacion">
        Tu ubicacion ha sido guardada exitosamente
    </div>
    <div class="span-13">
        <?php echo form_open('negocios/ubicacionNegocio/'.$negocios->negocioId, array('id'=>'forma-ubicacion')); ?>
            <div class="span-13">
                <div class="span-3">
                    <?php echo form_label('Pais: ', 'paisNegocio', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php $pais = 'id="paisNegocio"'; ?>
                    <?php echo form_dropdown('Ubicacion[negocioPais]',
                                             $paises,
                                             $negocios->negocioPais,
                                             $pais); ?>
                </div>
            </div>
            <div class="span-13">
                <div class="span-3">
                    <?php echo form_label('Ciudad: ', 'ciudadNegocio', array('style'=>'color: #666666')); ?>
                </div>
                <div class="span-10 last">
                    <?php $ciudad = 'id="ciudadNegocio"'; ?>
                    <?php echo form_dropdown('Ubicacion[negocioCiudad]',
                                             $ciudades,
                                             $negocios->negocioCiudad,
                                             $ciudad); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="span-12 last" style="margin-top: 10px"> 
                    <?php echo form_label('Selecciona tu ubicacion: ', 'seleccionUbicacion', array('style'=>'color: #666666')); ?>
                    <div class="mapa" style="width: 450px; height: 300px; margin-left: 25px; margin-top: 40px"></div>
                    <input type="hidden" name="Ubicacion[negocioLongitud]" id="longitud" />
                    <input type="hidden" name="Ubicacion[negocioLatitud]" id="latitud" />
                </div>
            </div>
            <div class="span-8" style="text-align: center; margin-bottom: 20px">
                <?php echo form_submit(array('id'=>'guardarDatos',
                                             'value'=>'Guardar',
                                             'class'=>'guardar_datos',
                                             'style'=>'background-color: #660066; color: #FFFFFF; border: none; font-size: 12px; height: 20px; margin-top: 8px;')); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
