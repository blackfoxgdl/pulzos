<?php
/**
 * View for check the second sponsor of telcel Demo View
 **/
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
var geoCode = new google.maps.Geocoder();

$(document).ready(function(){
			//var latLng = new google.maps.LatLng(20.691892, -103.39817);
            var ubicacion = [
                    [20.691892,-103.39817],
                    [20.659662,-103.398316],
                    [20.688038,-103.39817],
                    [20.735245,-103.39817],
                    [20.714694,-103.39817],
                    [20.723364,-103.39817],
                    [20.659662,-103.398316]
                ];

            var myOptions = {
                    zoom: 11,
                    center: new google.maps.LatLng(20.714694,-103.39817),//latLng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map($(".mapa").get(0), myOptions);
/*                                    var markerImage = new google.maps.MarkerImage('http://www.gettyicons.com/free-icons/108/gis-gps/png/24/needle_left_yellow_2_24.png',
                                                      new google.maps.Size(40, 40),
                                                      new google.maps.Point(0, 0),
                                                      new google.maps.Point(0, 32));*/
            for(i = 0; i < ubicacion.length; i++)
            {
                var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(ubicacion[i][0], ubicacion[i][1]),//latLng,
                        map: map,
                        //icon: markerImage
                });
            }
                               
        });
</script>
<div style="text-align:center; margin-left: -7px; margin-top: -15px">
    <?php echo img(array('src'=>'statics/inteliguia/Telcel_Head1.png',
                         'width'=>'303px',
                         'height'=>'156px')); ?>
    <br />
    <div class="mapa" style="width: 250px; height: 200px; margin-top:40px; margin-left: auto; margin-right: auto;">
        aqui va el mapa
    </div>
</div>
