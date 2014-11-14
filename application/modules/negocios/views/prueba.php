<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    var geoCode = new google.maps.Geocoder();    

    function initialize()
    {
        /**
         * PARTE QUE SE USA PARA LA DECLARACION DE LAS VARIABLES A USAR
         * EN EL MAPA DE GOOGLE MAPS PARA SELECCIONAR LA DIRECCION DEL NEGOCIO
         **/
        var latLng = new google.maps.LatLng(20.673040, -103.375854);
        var map = new google.maps.Map(document.getElementById('mapa-direccion'),{
            zoom: 8,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
            position: latLng,
            title: 'hola',
            map: map,
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
                    updateMarkerAddress('putos');
                }
            }
        );
    }

    /**
     * ACTUALIZAR EL DATO DE LOS MARKERS
     * EN EL GOOGLE MAPS
     **/
    function updateMarkerStatus(str){
        document.getElementById('markerStatus').innerHTML = str;
    }

    /**
     * ACTUALIZA LA POSICION DEL MARCADOR PARA
     * QUE CAPTURAR SU LATITUD Y LONGITUD
     **/
    function updateMarkerPosition(latLng)
    {
       document.getElementById('info').innerHTML = [
            latLng.lat(),
            latLng.lng()
            ].join(', ');
    }

    /**
     * ACTUALIZA LA DIRECCION DEL MARCADOR PARA
     * MOSTRARLA LA USUARIO
     **/
    function updateMarkerAddress(str){
        document.getElementById('address').innerHTML = str;
    }

    //EVENTO ONLOAD PARA ACTIVAR LA APLICACION
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<body onload="initialize()">
 <div id="mapa-direccion" style="width: 320px; height: 480px;"></div>
  <div id="infoPanel">
    <b>Marker status:</b>
    <div id="markerStatus"><i>Click and drag the marker.</i></div>
    <b>Current position:</b>
    <div id="info"></div>
    <b>Closest matching address:</b>
    <div id="address"></div>
  </div>
</body>
