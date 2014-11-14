<?php
/**
 * View where the company can create new companies
 * with the same name, the people know like branch.
 * With this form the people can create new branch
 **/
var_dump($negocioSucursal);
?>
<div style="display: none">
    <?php echo img(array('id'=>'imagen','src'=>'statics/img/pin.png')); ?>
</div>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
var geoCode = new google.maps.Geocoder();
function initialize()
{
    <?php if($negocioSucursal->negocioLatitud == '' && $negocioSucursal->negocioLongitud == ''): ?>
        var latLng = new google.maps.LatLng(20.673040, -103.375854);
    <?php else: ?>
        var latLng = new google.maps.LatLng(<?php echo $negocioSucursal->negocioLatitud; ?>, <?php echo $negocioSucursal->negocioLongitud; ?>);
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
</script>
<div class="span-24">
    <?php echo form_open_multipart('negocios/create_branch'); ?>
        <div>
            <?php echo form_label('Nombre de la Sucursal: ', 'nombreSucursal'); ?>
            <?php echo form_input(array('id'=>'',
                                        'name'=>'Branch[negocioNombre]',
                                        'class'=>'',
                                        'style'=>'')); ?>
        </div>
        <div>
            <?php echo form_label('Direccion de la Sucursal: ', 'direccionSucursal'); ?>
            <?php echo form_input(array('id'=>'',
                                        'class'=>'',
                                        'name'=>'Branch[negocioDireccion]',
                                        'style'=>'')); ?>
        <div>
        <div>
            <?php echo form_label('Correo Electronico Sucursal: ', 'emailSucursal'); ?>
            <?php echo form_input(array('id'=>'',
                                        'class'=>'',
                                        'name'=>'Branch[negocioEmail]',
                                        'style'=>'')); ?>
        </div>
        <div>
            <?php echo form_label('Telefono de la Sucursal: ', 'telefonoSucursal'); ?>
            <?php echo form_input(array('id'=>'',
                                        'class'=>'',
                                        'name'=>'Branch[negocioTelefono]',
                                        'style'=>'')); ?>
        </div>
        <div>
            <?php echo form_label('Horario de sucursal: ', 'horarioSucursal'); ?>
            <?php echo form_input(array('id'=>'',
                                        'class'=>'',
                                        'name'=>'Branch[negocioHorario]',
                                        'style'=>'')); ?>
        </div>
        <div>
            <?php echo form_label('Contraseña: ', 'passwordSucursal'); ?>
            <?php echo form_password(array('id'=>'',
                                           'class'=>'',
                                           'name'=>'Password',
                                           'style'=>'')); ?>
        </div>
        <div>
            Mapa
            <div class="mapa" style="width: 450px; height: 300px; margin-left: 25px; margin-top: 40px"></div>
            <?php echo form_hidden('Branch[negocioGiro]', $negocioSucursal->negocioGiro); ?>
            <?php echo form_hidden('Branch[negocioSubgiro]', $negocioSucursal->negocioSubgiro); ?>
            <?php echo form_hidden('Branch[negocioPais]', $negocioSucursal->negocioPais); ?>
            <?php echo form_hidden('Branch[negocioCiudad]', $negocioSucursal->negocioCiudad); ?>
            <input type="hidden" id="latitud" class="" name="Branch[negocioLatitud]" />
            <input type="hidden" id="longitud" class="" name="Branch[negocioLongitud]" />
        </div>
        <div>
            <?php echo form_submit(array('id'=>'',
                                         'class'=>'',
                                         'name'=>'',
                                         'value'=>'Guardar',
                                         'style'=>'')); ?>
        </div>
    <?php echo form_close(); ?>
</div>
