<?php
/**
 * Edicion del mapa donde se tendra la posicion del mismo
 * para asi poder hacer de forma dinamica el mapa que veran
 * los usuarios, donde no se pueden mover los pines
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geoCode = new google.maps.Geocoder();
 function initialize()
    {
        /**
         * PARTE QUE SE USA PARA LA DECLARACION DE LAS VARIABLES A USAR
         * EN EL MAPA DE GOOGLE MAPS PARA SELECCIONAR LA DIRECCION DEL NEGOCIO
         **/
        <?php if($negocios->negocioLatitud == '' && $negocios->negocioLongitud == ''): ?>
            var latLng = new google.maps.LatLng(20.673040, -103.375854);
        <?php else: ?>
            var latLng = new google.maps.LatLng(<?php echo $negocios->negocioLatitud; ?>,<?php echo $negocios->negocioLongitud; ?>);
        <?php endif; ?>
            var markerImage = new google.maps.MarkerImage($("#imagen").attr('src'),
                                                          new google.maps.Size(34, 32),
                                                          new google.maps.Point(0, 0),
                                                          new google.maps.Point(0, 32));
        var map = new google.maps.Map(document.getElementById('mapa-direccion'),{
            zoom: 15,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
            position: latLng,
            title: 'Seleccione su ubicacion',
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
        //document.getElementById('markerStatus').innerHTML = str;
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

    //EVENTO ONLOAD PARA ACTIVAR LA APLICACION
    google.maps.event.addDomListener(window, 'load', initialize);

$(document).ready(function(){
    $("#forma-enviar").submit(function(event){
        event.preventDefault();
        var opciones = {
            success: cargarVista
        }
        $(this).ajaxSubmit(opciones);
        return false;
    });

    function cargarVista()
    {
        location.href = $("#redirect").attr('href');
    }
});

$("#avatar-photo-block, .notification-block").hover(function(event){
    $(".notification-block").css('display', 'block');
    $(".notification-block").css('position', 'absolute');
}, function(event){
    $(".notification-block").css('display', 'none');
});
</script>
<?php echo anchor('negocios/perfil', '', array('id'=>'redirect', 'style'=>'display:none')); ?>
<div class="span-24 last">
    <div style="display: none">
        <?php echo img(array('id'=>'imagen',
                             'src'=>'statics/img/pin.png')); ?>
    </div>
    <div class="avatar span-4 last" style="margin-top: 10px"><!-- DIV DEL PERFIL -->
        <?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
            <div class="notification-block">
                <?php echo anchor('imagennegocios/cambiar_avatar_negocio/', 'Cambiar Avatar', array('class'=>'middle-menu-link'))?>
            </div>
            <?php echo anchor('imagennegocios/cambiar_avatar_negocio/',
                                img(array('src'=>get_avatar_negocios($negocios->negocioId), 
                                          'width'=>'140', 
                                          'height'=>'140', 
                                          'id'=>'avatar-photo-block')), 
                                    array('class'=>'middle-menu-link', )); 
            ?>
        <?php else: ?>
            <?php echo img(array('src'=>get_avatar_negocios($negocios->negocioId),
                                 'width'=>'140',
                                 'height'=>'140',
                                 'id'=>'avatar-photo-block')); 
            ?>
        <?php endif; ?>
        <ul id="pim" class="interlineado">
            <li class="title-name" id="pim-nombre">
                <!-- strong -->
                <span class="menu-izq" id="nombrePim">
                    <?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
                        <?php echo anchor('negocios/editar/'.$negocios->negocioId,
                                            $negocios->negocioNombre,
                                            array('class'=>'nombreNegocio','id'=>'negocioNombreId', 'style'=>'text-decoration: none; color: #8D6E98'));
                        ?>
                    <?php else: ?>
                        <?php echo $negocios->negocioNombre; ?>
                    <?php endif; ?>
                </span>
                <span class="menu-izq-menor">
                <br />
                <span id="giroN">
                    <?php echo get_giro_negocio($negocios->negocioGiro); ?>
                </span>
                <br />
                <span id="negocioD">
                    <?php echo $negocios->negocioDireccion; ?>
                </span>
                <br />
                <span id="negocioT">
                    <?php echo $negocios->negocioTelefono; ?>
                </span>
                <br />
                    <?php if($this->session->userdata('idN') != $negocios->negocioId): ?>
                        <?php if($numeroSeguidor == 0): ?>
                            <?php echo anchor('seguidores/seguir/'.$negocios->negocioId, 
                                'Seguir Negocio', array('id'=>'seguirEmpresa', 'class'=>'seguirE')); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
                <!-- /strong -->
            </li>
        </ul>
    </div><!-- ESTE DIV ES DEL PERFIL -->
    <div class="prepend-1 span-19 last" style="margin-top: 10px">
        <div id="mapa-direccion" style="width: 600px; height: 400px;"></div>
            <?php echo form_open('negocios/editar_mapa/'.$negocios->negocioId, array('id'=>'forma-enviar')); ?>
            <?php echo form_input(array('id'=>'latitud',
                                         'name'=>'Coordenadas[negocioLatitud]',
                                         'style'=>'display: none')); ?>
            <?php echo form_input(array('id'=>'longitud',
                                        'name'=>'Coordenadas[negocioLongitud]',
                                        'style'=>'display: none')); ?>
            <?php echo form_submit('enviar','enviar'); ?>
            <?php echo form_close(); ?>
    </div>
</div>
