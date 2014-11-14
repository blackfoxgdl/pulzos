<?php
/**
 * Pruebas de mapas. 
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright Zavordigital, 29 March, 2011
 * @package Mapas
 **/
?>
<script src="http://ajax.googleapis.com/ajax/libs/dojo/1.6/dojo/dojo.xd.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
dojo.ready(function(){

    var latlng = new google.maps.LatLng(20.67519, -103.35251);
    var myOptions = {
        zoom: 12,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(dojo.byId("mapa_empresa"), myOptions);



    var lugares = new Array();
    lugares[0] = { nombre: "CarnesGaribaldi", descripcion: "Carne en su jugo original" };
    lugares[1] = { nombre: "McDondalds", descripcion: "Hamburguesas del payasito" };
    lugares[2] = { nombre: "DanyYo", descripcion: "Nieves de yogurt y nachos" };
    lugares[3] = { nombre: "BurguerKing", descripcion: "Hamburguesas como tu las quieres" };
    lugares[4] = { nombre: "FarmaciasGuadalajara", descripcion: "La farmacia preferida de la zona" };
    lugares[5] = { nombre: "SantoCoyote", descripcion: "Restaurante medio nice cerca de la oficina" };
    lugares[6] = { nombre: "PizzaHut", descripcion: "Mejor del lugar con la Gacela Vallejo como Repartidor" };
    lugares[7] = { nombre: "PizzayCome", descripcion: "Otro lugar dos tres para comer"};
    lugares[8] = { nombre: "Diavolo", descripcion: "Un lugar mas nice pero no tan genial" };
    lugares[9] = { nombre: "FondaChuchitaPeralta", descripcion: "Supa Fondita de la Supa Deliciosidad"};

    var numeroAzar = Math.floor(Math.random()*10);
    var randLat = 20.70731 + (20.63054 - 20.70731) * Math.random();
    var randLong = -103.42323 + (-103.29723 - (-103.42323)) * Math.random();
    /*var markCord = new google.maps.LatLng(randLat, randLong);*/

    dojo.xhrGet({
        url: "http://localhost/pulzos_bueno/index.php/mapas/ajax/",
            load: function(result){
                
                for(i=0; i<result; i++){
                    var infoWindow = null;
                    randLat += .0120;
                    randLong += .0120;
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(randLat, randLong),
                        draggable: true,
                        map: map
                    });
                    var contentString = "<h1>"+lugares[i].nombre+"</h1>"+
                    "<h4>"+lugares[i].descripcion+"</h4>"+
                    "<p><a href=http://localhost/pulzos_bueno/index.php/mapas/empresa/"+lugares[i].nombre+">Fotos</a></p>"+
                    "<p><a href=http://localhost/pulzos_bueno/index.php/mapas/empresa/"+lugares[i].nombre+">Video</a></p>";
                    
                    infoWindow = new google.maps.InfoWindow({content: contentString});
                    google.maps.event.addListener(marker, 'click', function(){
                        infoWindow.setContent(contentString);
                        infoWindow.open(map, this);
                    });
                }
                
            }});
});


</script>
<div class="span-23 box principal last">
    <div class="pull-3 span-20 last mapa">
        <div id="mapa_empresa" style="width:100%; height:100%">
        </div>
    </div>
    <div class="span-23 box last">
    </div>
</div>
