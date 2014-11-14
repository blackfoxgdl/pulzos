/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var geoCode = new google.maps.Geocoder();

function initMap()
    {
        
        /**
         * PARTE QUE SE USA PARA LA DECLARACION DE LAS VARIABLES A USAR
         * EN EL MAPA DE GOOGLE MAPS PARA SELECCIONAR LA DIRECCION DEL NEGOCIO
         **/
        try{
            
        
        
            var idN=$('#negocioId').attr('value');
            var latLng;
            $.post('modules/cuenta/get_config.php',{idGeo:idN},function(response){
              
                
                if(response!='empty'){
                    cd=response.split('_');
                    latLng = new google.maps.LatLng(cd[0], cd[1]);
                }else{
                    latLng = new google.maps.LatLng(20.673040, -103.375854);
                }
                
                if(latLng == '(0, 0)'){
                    latLng = new google.maps.LatLng(20.673040, -103.375854);
                }
               
                var markerImage = new google.maps.MarkerImage($("#mapImagen").attr('src'),
                                                                new google.maps.Size(54, 32),
                                                                new google.maps.Point(0, 0),
                                                                new google.maps.Point(0, 32));
                                                                
                var map = new google.maps.Map(document.getElementById('mapa-pulzos'),{
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
            });
        
        
      }catch(e){
                alert('ERROR:'+ e);
            }
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
       // alert('hola: ' + latLng.lng())
        /*document.getElementById('info').innerHTML = [
            latLng.lat(),
            latLng.lng()
            ].join(', ');*/
    }

    /**
     * ACTUALIZA LA DIRECCION DEL MARCADOR PARA
     * MOSTRARLA LA USUARIO
     **/
    function updateMarkerAddress(str){
        //document.getElementById('address').innerHTML = str;
    }

    //EVENTO ONLOAD PARA ACTIVAR LA APLICACION
    google.maps.event.addDomListener(window, 'load', initialize);

    