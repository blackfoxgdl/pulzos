<?php
/**
 * Vista la cual se usara para filtrar los datos
 * de la busqueda de usuarios en la cual se veran los
 * iconos y las diferentes subcategorias
 **/
?>
<script type="text/javascript">
$(".pc").click(function(event){
    event.preventDefault();
    name = $(event.currentTarget).attr('name');

    if(name == "Ayuda a tu Comunidad")
    {
        $("#cye, #cyt, #rst").hide();
        $("#syt, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
        $("#ac").show();
    }
    if(name == "Cafés")
    {
        $("#ac, #cye, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
    }
    if(name == "Casinos")
    {
        $("#ac, #cye, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
    }
    if(name == "Conciertos y Eventos")
    {
        $("#ac, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
        $("#cye").show();
    }
    if(name == "Cursos y Talleres")
    {
        $("#ac, #cye, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
        $("#cyt").show();
    }
    if(name == "De compras")
    {
        $("#ac, #cye, #cyt").hide();
        $("#rst, #syb, #svs").hide();
        $("#sc, #vyt, #va").hide();
        $("#vf, #vn, #vp").hide();
        $("#dc").show();
    }
    if(name == "Esoterico")
    {
        $("#ac, #cye, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
    }
    if(name == "Eventos Religiosos")
    {
        $("#ac, #cye, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
    }
    if(name == "Expos y Ferias")
    {
        $("#ac, #cye, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
    }

    if(name == "Fuera de lo Comun")
    { 
        $("#ac, #cye, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
    }
    if(name == "Puntos Turisticos")
    {
        $("#ac, #cye, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
    }
    if(name == "Restaurantes")
    {
        $("#ac, #cye, #cyt").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
        $("#rst").show();
    }
    if(name == "Salud y Belleza")
    {
        $("#ac, #cye, #cyt").hide();
        $("#rst, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
        $("#syb").show();
    }
    if(name == "Servicios")
    {
        $("#ac, #cye, #cyt").hide();
        $("#rst, #sc, #vyt").hide();
        $("#syb, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
        $("#svs").show();
    }
    if(name == "Solo Cultura")
    {
        $("#ac, #cye, #cyt").hide();
        $("#rst, #syb, #vyt").hide();
        $("#va, #vf, #svs").hide();
        $("#vn, #vp, #dc").hide();
        $("#sc").show();
    }
    if(name == "Teatro y Cine")
    {
        $("#ac, #cye, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
    }
    if(name == "Viajes y tours")
    {
        $("#ac, #cye, #cyt").hide();
        $("#rst, #svs, #sc").hide();
        $("#syb, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
        $("#vyt").show();
    }
    if(name == "Vida Activa")
    {
        $("#ac, #cye, #cyt").hide();
        $("#rst, #syb, #svs").hide();
        $("#sc, #vyt, #vf").hide();
        $("#vn, #vp, #dc").hide();
        $("#va").show();
    }
    if(name == "Vida Familiar")
    {
        $("#ac, #cye, #cyt").hide();
        $("#rst, #syb, #svs").hide();
        $("#sc, #vyt, #va").hide();
        $("#vn, #vp, #dc").hide();
        $("#vf").show();
    }
    if(name == "Vida Nocturna")
    {
        $("#ac, #cye, #cyt").hide();
        $("#rst, #syb, #svs").hide();
        $("#sc, #vyt, #vf").hide();
        $("#va, #vp, #dc").hide();
        $("#vn").show();
    }
    if(name == "Vida Politica")
    {
        $("#ac, #cye, #cyt").hide();
        $("#rst, #syb, #svs").hide();
        $("#sc, #vyt, #vf").hide();
        $("#vn, #va, #dc").hide();
        $("#vp").show();
    }
    if(name == "Otros")
    {
        $("#ac, #cye, #cyt, #rst").hide();
        $("#syb, #svs, #sc").hide();
        $("#vyt, #va, #vf").hide();
        $("#vn, #vp, #dc").hide();
    }
 
    $(".enlace_miciudad").click(function(event){
        event.preventDefault();
        urlSub = $(event.currentTarget).attr("href");
        urlSubId= $(event.currentTarget).attr("id");
        $(".contenido").load(urlSubId);
    });

});

$(".pc1").click(function(event){
    event.preventDefault();
    name = $(event.currentTarget).attr('name');

    if(name == "Ayuda a tu Comunidad")
    {
        $("#cye1, #cyt1, #rst1").hide();
        $("#syt1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#ac1").show();
    }
    if(name == "Cafés")
    {
        $("#ac1, #cye1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
    }
    if(name == "Casinos")
    {
        $("#ac1, #cye1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
    }
    if(name == "Conciertos y Eventos")
    {
        $("#ac1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#cye1").show();
    }
    if(name == "Cursos y Talleres")
    {
        $("#ac1, #cye1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#cyt1").show();
    }
    if(name == "De compras")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#rst1, #syb1, #svs1").hide();
        $("#sc1, #vyt1, #va1").hide();
        $("#vf1, #vn1, #vp1").hide();
        $("#dc1").show();
    }
    if(name == "Esoterico")
    {
        $("#ac1, #cye1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
    }
    if(name == "Eventos Religiosos")
    {
        $("#ac1, #cye1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
    }
    if(name == "Expos y Ferias")
    {
        $("#ac1, #cye1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
    }

    if(name == "Fuera de lo Comun")
    { 
        $("#ac1, #cye1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
    }
    if(name == "Puntos Turisticos")
    {
        $("#ac1, #cye1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
    }
    if(name == "Restaurantes")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#rst1").show();
    }
    if(name == "Salud y Belleza")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#rst1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#syb1").show();
    }
    if(name == "Servicios")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#rst1, #sc1, #vyt1").hide();
        $("#syb1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#svs1").show();
    }
    if(name == "Solo Cultura")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#rst1, #syb1, #vyt1").hide();
        $("#va1, #vf1, #svs1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#sc1").show();
    }
    if(name == "Teatro y Cine")
    {
        $("#ac1, #cye1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
    }
    if(name == "Viajes y tours")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#rst1, #svs1, #sc1").hide();
        $("#syb1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#vyt1").show();
    }
    if(name == "Vida Activa")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#rst1, #syb1, #svs1").hide();
        $("#sc1, #vyt1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#va1").show();
    }
    if(name == "Vida Familiar")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#rst1, #syb1, #svs1").hide();
        $("#sc1, #vyt1, #va1").hide();
        $("#vn1, #vp1, #dc1").hide();
        $("#vf1").show();
    }
    if(name == "Vida Nocturna")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#rst1, #syb1, #svs1").hide();
        $("#sc1, #vyt1, #vf1").hide();
        $("#va1, #vp1, #dc1").hide();
        $("#vn1").show();
    }
    if(name == "Vida Politica")
    {
        $("#ac1, #cye1, #cyt1").hide();
        $("#rst1, #syb1, #svs1").hide();
        $("#sc1, #vyt1, #vf1").hide();
        $("#vn1, #va1, #dc1").hide();
        $("#vp1").show();
    }
    if(name == "Otros")
    {
        $("#ac1, #cye1, #cyt1, #rst1").hide();
        $("#syb1, #svs1, #sc1").hide();
        $("#vyt1, #va1, #vf1").hide();
        $("#vn1, #vp1, #dc1").hide();
    }
 
    $(".enlace_miciudad").click(function(event){
        event.preventDefault();
        urlSub = $(event.currentTarget).attr("href");
        urlSubId= $(event.currentTarget).attr("id");
        $(".contenido").load(urlSubId);
    });
});


$(".pc2").click(function(event){
    event.preventDefault();
    name = $(event.currentTarget).attr('name');

    if(name == "Ayuda a tu Comunidad")
    {
        $("#cye2, #cyt2, #rst2").hide();
        $("#syt2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#ac2").show();
    }
    if(name == "Cafés")
    {
        $("#ac2, #cye2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
    }
    if(name == "Casinos")
    {
        $("#ac2, #cye2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
    }
    if(name == "Conciertos y Eventos")
    {
        $("#ac2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#cye2").show();
    }
    if(name == "Cursos y Talleres")
    {
        $("#ac2, #cye2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#cyt2").show();
    }
    if(name == "De compras")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#rst2, #syb2, #svs2").hide();
        $("#sc2, #vyt2, #va2").hide();
        $("#vf2, #vn2, #vp2").hide();
        $("#dc2").show();
    }
    if(name == "Esoterico")
    {
        $("#ac2, #cye2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
    }
    if(name == "Eventos Religiosos")
    {
        $("#ac2, #cye2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
    }
    if(name == "Expos y Ferias")
    {
        $("#ac2, #cye2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
    }

    if(name == "Fuera de lo Comun")
    { 
        $("#ac2, #cye2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
    }
    if(name == "Puntos Turisticos")
    {
        $("#ac2, #cye2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
    }
    if(name == "Restaurantes")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#rst2").show();
    }
    if(name == "Salud y Belleza")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#rst2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#syb2").show();
    }
    if(name == "Servicios")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#rst2, #sc2, #vyt2").hide();
        $("#syb2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#svs2").show();
    }
    if(name == "Solo Cultura")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#rst2, #syb2, #vyt2").hide();
        $("#va2, #vf2, #svs2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#sc2").show();
    }
    if(name == "Teatro y Cine")
    {
        $("#ac2, #cye2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
    }
    if(name == "Viajes y tours")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#rst2, #svs2, #sc2").hide();
        $("#syb2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#vyt2").show();
    }
    if(name == "Vida Activa")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#rst2, #syb2, #svs2").hide();
        $("#sc2, #vyt2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#va2").show();
    }
    if(name == "Vida Familiar")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#rst2, #syb2, #svs2").hide();
        $("#sc2, #vyt2, #va2").hide();
        $("#vn2, #vp2, #dc2").hide();
        $("#vf2").show();
    }
    if(name == "Vida Nocturna")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#rst2, #syb2, #svs2").hide();
        $("#sc2, #vyt2, #vf2").hide();
        $("#va2, #vp2, #dc2").hide();
        $("#vn2").show();
    }
    if(name == "Vida Politica")
    {
        $("#ac2, #cye2, #cyt2").hide();
        $("#rst2, #syb2, #svs2").hide();
        $("#sc2, #vyt2, #vf2").hide();
        $("#vn2, #va2, #dc2").hide();
        $("#vp2").show();
    }
    if(name == "Otros")
    {
        $("#ac2, #cye2, #cyt2, #rst2").hide();
        $("#syb2, #svs2, #sc2").hide();
        $("#vyt2, #va2, #vf2").hide();
        $("#vn2, #vp2, #dc2").hide();
    }
 
    $(".enlace_miciudad").click(function(event){
        event.preventDefault();
        urlSub = $(event.currentTarget).attr("href");
        urlSubId= $(event.currentTarget).attr("id");
        $(".contenido").load(urlSubId);
    });
});


$(".pc3").click(function(event){
    event.preventDefault();
    name = $(event.currentTarget).attr('name');

    if(name == "Ayuda a tu Comunidad")
    {
        $("#cye3, #cyt3, #rst3").hide();
        $("#syt3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#ac3").show();
    }
    if(name == "Cafés")
    {
        $("#ac3, #cye3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
    }
    if(name == "Casinos")
    {
        $("#ac3, #cye3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
    }
    if(name == "Conciertos y Eventos")
    {
        $("#ac3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#cye3").show();
    }
    if(name == "Cursos y Talleres")
    {
        $("#ac3, #cye3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#cyt3").show();
    }
    if(name == "De compras")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#rst3, #syb3, #svs3").hide();
        $("#sc3, #vyt3, #va3").hide();
        $("#vf3, #vn3, #vp3").hide();
        $("#dc3").show();
    }
    if(name == "Esoterico")
    {
        $("#ac3, #cye3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
    }
    if(name == "Eventos Religiosos")
    {
        $("#ac3, #cye3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
    }
    if(name == "Expos y Ferias")
    {
        $("#ac3, #cye3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
    }

    if(name == "Fuera de lo Comun")
    { 
        $("#ac3, #cye3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
    }
    if(name == "Puntos Turisticos")
    {
        $("#ac3, #cye3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
    }
    if(name == "Restaurantes")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#rst3").show();
    }
    if(name == "Salud y Belleza")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#rst3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#syb3").show();
    }
    if(name == "Servicios")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#rst3, #sc3, #vyt3").hide();
        $("#syb3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#svs3").show();
    }
    if(name == "Solo Cultura")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#rst3, #syb3, #vyt3").hide();
        $("#va3, #vf3, #svs3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#sc3").show();
    }
    if(name == "Teatro y Cine")
    {
        $("#ac3, #cye3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
    }
    if(name == "Viajes y tours")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#rst3, #svs3, #sc3").hide();
        $("#syb3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#vyt3").show();
    }
    if(name == "Vida Activa")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#rst3, #syb3, #svs3").hide();
        $("#sc3, #vyt3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#va3").show();
    }
    if(name == "Vida Familiar")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#rst3, #syb3, #svs3").hide();
        $("#sc3, #vyt3, #va3").hide();
        $("#vn3, #vp3, #dc3").hide();
        $("#vf3").show();
    }
    if(name == "Vida Nocturna")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#rst3, #syb3, #svs3").hide();
        $("#sc3, #vyt3, #vf3").hide();
        $("#va3, #vp3, #dc3").hide();
        $("#vn3").show();
    }
    if(name == "Vida Politica")
    {
        $("#ac3, #cye3, #cyt3").hide();
        $("#rst3, #syb3, #svs3").hide();
        $("#sc3, #vyt3, #vf3").hide();
        $("#vn3, #va3, #dc3").hide();
        $("#vp3").show();
    }
    if(name == "Otros")
    {
        $("#ac3, #cye3, #cyt3, #rst3").hide();
        $("#syb3, #svs3, #sc3").hide();
        $("#vyt3, #va3, #vf3").hide();
        $("#vn3, #vp3, #dc3").hide();
    }
 
    $(".enlace_miciudad").click(function(event){
        event.preventDefault();
        urlSub = $(event.currentTarget).attr("href");
        urlSubId= $(event.currentTarget).attr("id");
        $(".contenido").load(urlSubId);
    });
});

$(".sin-sub").click(function(event){
    event.preventDefault();
    urlSin = $(event.currentTarget).attr("href");
      if($('.contenido')){
          $('.contenido').load(urlSin);
      }else{
        $("#texto-menu").load(urlSin);
      }
});

$("#directorioMiCiudad").click(function(event){
    event.preventDefault();
    $("#actividades-miciudad").hide();
    $("#directorios-miciudad").show();
});

$("#actividadesMiCiudad").click(function(event){
    event.preventDefault();
    $("#directorios-miciudad").hide();
    $("#actividades-miciudad, #filtros-miciudad").show();
});

$(".filtros").change(function(event){
    event.preventDefault();
    valor = $(event.currentTarget).attr('id');
    if(valor == 'hoyFiltro')
    {
        $("#semanal").hide();
        $("#mensual").hide();
        $("#diarios").show();
    }
    if(valor == 'semanalFiltro')
    {
        $("#diarios").hide();
        $("#mensual").hide();
        $("#semanal").show();
    }
    if(valor == 'mensualFiltro')
    {
        $("#diarios").hide();
        $("#semanal").hide();
        $("#mensual").show();
    }
});

$(document).ready(function(){
    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
    var textoMiCiudad = $("div#menu-derecha").html();
    $("#main-div").html(textoMiCiudad);
});
</script>
<?php $over=true; ?>
<div class="span-14" style="margin-top: 10px"><!--DIV PRINCIPAL QUE CONTIENE TODO **INICIO** -->
    <div class="span-14" style="display: none"><!-- DIV TITULO DINAMICO -->
        <div id="menu-derecha">
            <div id="menu-opciones">
                    <?php echo anchor('planesusuarios',
                                      img(array('src'=>'statics/img/bot-armapulzo.png',
                                                'id'=>'planesU',
                                                'width'=>'80',
                                                'height'=>'20',
                                                'style'=>'margin-top: 22px; margin-left: -23px'))); ?>
            </div>
        </div>
        <div id="nombre-usuario-plan">
            Mi Ciudad
        </div>
    </div><!-- DIV TITULO DINAMICO -->
    <div class="span-13" style=""><!-- DIV DE LOS BOTONES DE OPCIONES A MOSTRAR **INICIO** -->
        <div class="prepend-3 span-3">
            <?php echo form_submit(array('id'=>'actividadesMiCiudad',
                                         'name'=>'',
                                         'value'=>'Actividades',
                                         'style'=>'')); ?>
        </div>
        <div class="prepend-1 span-3">
            <?php echo form_submit(array('id'=>'directorioMiCiudad',
                                         'name'=>'',
                                         'class'=>'',
                                         'name'=>'',
                                         'style'=>'',
                                         'value'=>'Directorio')); ?>
        </div>
    </div><!-- DIV DE LOS BOTONES DE OPCIONES A MOSTRAR **FIN** -->
<div style="display: none" id="directorios-miciudad"><!-- DIV DE LA PARTE DE LOS PULZOS EN DIRECTORIO **INICIO** -->
    <div class="span-13" style="margin-top: 30px"><!-- DIV QUE CONTIENE LA PARTE DEL CUERPO **INICIO** -->
        <div class="span-6">
            <div class="span-6"><!-- DIV AYUDA TU COMUNIDAD **INICIO** -->
                <?php $ayudaComunidad = count_category_pulzos('1'); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Ayuda a tu Comunidad">                                       <span style="color: #530047; margin-left: 1px; margin-bottom: 1px" id="mas-comunidad">
                            +
                        </span>
                        <div style="width: 240px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-ayuda.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                            <div style="margin-top: -25px; margin-left: 55px; color: #530047">
                                Ayuda a tu comunidad (<?php echo $ayudaComunidad; ?>)
                            </div>
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px;" id="ac">
                    <?php $AC = get_subcategories("1"); ?>
                    <?php $i = 1; ?>
                    <ul>
                    <?php foreach($AC as $ac): ?>
                        <?php $subcategorias = count_subcategory_pulzos($ac->id); ?>
                        <?php if($i%2 == 0): ?>
                            <li class="span-6 last" style="display: inline; margin-left: -18px; line-height: 14px; background-color: #DBCCE3; width: 200px;">
                                    <?php echo anchor('#',
                                                      $ac->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px;','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id."','#texto-menu');return false;")); ?>
                            </li>
                        <?php else: ?>
                            <li class="span-6 last" style="display: inline; margin-right: 0px; margin-left: -4px; line-height: 14px">
                                    <?php echo anchor('#',
                                                      $ac->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id."','#texto-menu');return false;"));?>
                            </li>
                        <?php endif; ?>
                        <?php $i = $i + 1; ?>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV AYUDA A TU COMUNIDAD **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CAFES **INICIO** -->
                <?php $cafes = get_categories("2"); ?>
                <?php $cafesComunidad = count_category_pulzos('2'); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id.'/'.$over;?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id;?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id;?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Cafés">

                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-cafes.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                            <div style="margin-top: -25px; margin-left: 55px; color: #530047">
                                Caf&eacute;s (<?php echo $cafesComunidad; ?>)
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE CAFES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CASINOS **INICIO** -->
                <?php $casinos = get_categories("3"); ?>
                <?php $casinosComunidad = count_category_pulzos('3'); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Casinos">

                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-casinos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                        </div>
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Casinos (<?php echo $casinosComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE CASINOS **FIN**-->
           <div class="span-6" style="margin-top: 15px"><!-- DIV DE CONCIERTOS Y EVENTOS **INICIO** -->
                <?php $conciertosYeventos = count_category_pulzos('4'); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Conciertos y Eventos">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 190px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-conciertos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                        </div>
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047; width: 220px">
                        Conciertos y Eventos (<?php echo $conciertosYeventos; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px;" id="cye">
                    <?php $CYE = get_subcategories("4"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($CYE as $cye): ?>
                            <?php $subcategorias = count_subcategory_pulzos($cye->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $cye->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display:inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $cye->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE CONCIERTOS Y EVENTOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CURSOS Y TALLERES **INICIO** -->
                <?php $cursosYtalleres = count_category_pulzos('5'); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Cursos y Talleres">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Cursos y Talleres (<?php echo $cursosYtalleres; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="cyt">
                    <?php $CYT = get_subcategories("5"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($CYT as $cyt): ?>
                            <?php $subcategorias = count_subcategory_pulzos($cyt->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li class="span-5 last" style="display: inline; line-height: 14px; margin-left: -18px; background-color: #DBCCE3; width: 200px">
                                    <?php echo anchor('#',
                                                      $cyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li class="span-5 last" style="display: inline; line-height: 14px; margin-left: -4px">
                                    <?php echo anchor('#',
                                                      $cyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE CURSOS Y TALLERES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE COMPRAS **INICIO** -->
                <?php $deComprasComunidad = count_category_pulzos('6'); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="De compras">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        De Compras (<?php echo $deComprasComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="dc">
                    <?php $DC = get_subcategories("6"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($DC as $dc): ?>
                            <?php $subcategorias = count_subcategory_pulzos($dc->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $dc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $dc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div><!-- DIV DE COMPRAS **FIN** -->
          <div class="span-6" style="margin-top: 15px"><!-- DIV DE ESOTERICO **INICIO** -->
                <?php $esoterico = get_categories("7"); ?>
                <?php $esotericoComunidad = count_category_pulzos('7'); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Esoterico">
                        <!--span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                        </span-->
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-esoterico.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Esoterico (<?php echo $esotericoComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE ESOTERICO **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE EVENTOS RELIGIOSOS **INICIO** -->
                <?php $religiosos = get_categories('8'); ?>
                <?php $religiososComunidad = count_category_pulzos('8'); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Eventos Religiosos">
                        <!--span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                        </span-->
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-religioso.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Eventos Religiosos (<?php echo $religiososComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE EVENTOS RELIGIOSOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE EXPOS Y FERIAS **INICIO** -->
                <?php $exposFerias = get_categories('9'); ?>
                <?php $exposFeriasComunidad = count_category_pulzos('9'); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Expos y Ferias">

                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-expo.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Expos y Ferias (<?php echo $exposFeriasComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE EXPOS Y FERIAS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE FUERA DE LO COMUN **INICIO** -->
                <?php $fueraComun = get_categories('11'); ?>
                <?php $fueraComunComunidad = count_category_pulzos('11'); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Fuera de lo Comun">

                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-raro.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Fuera de lo com&uacute;n (<?php echo $fueraComunComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE FUERA DE LO COMUN **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE PUNTOS TURISTICOS -->
                <?php $puntosTuristicos = get_categories('13'); ?>
                <?php $puntosTuristicosComunidad = count_category_pulzos('13'); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Puntos Turisticos">

                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-turisticos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Puntos tur&iacute;sticos (<?php echo $puntosTuristicosComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE PUNTOS TURISTICOS -->
        </div>
        <div class="span-6" style="margin-left: 30px"><!-- DIV POSICIONAR ELEMENTOS DERECHA **INICIO** -->
        <div class="span-6"><!-- DIV DE LA COLUMNA DERECHA **INICIO** -->
            <div class="span-6"><!-- DIV DE RESTAURANTES **INICIO** -->
                <?php $restaurantesComunidad = count_category_pulzos('14'); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Restaurantes">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-restaurante.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Restaurantes (<?php echo $restaurantesComunidad; ?>)
                        </div>
                    </div>
                </a>                
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="rst">
                    <?php $RTS = get_subcategories("14"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($RTS as $rts): ?>
                            <?php $subcategorias = count_subcategory_pulzos($rts->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $rts->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $rts->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i +1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE RESTAURANTES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SALUD Y BELLEZA **INICIO** -->
                <?php $saludYbellezaC = count_category_pulzos('15'); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Salud y Belleza">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-salud.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Salud y Belleza (<?php echo $saludYbellezaC; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="syb">
                    <?php $SYB = get_subcategories("15"); ?> 
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($SYB as $syb): ?>
                            <?php $subcategorias = count_subcategory_pulzos($syb->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $syb->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $syb->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i+1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE SALUD Y BELLEZA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SERVICIOS **INICIO** -->
                <?php $serviciosComunidad = count_category_pulzos('16'); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Servicios">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Servicios (<?php echo $serviciosComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="svs">
                    <?php $SVS = get_subcategories("16"); ?>
                    <?php $i = 1; ?>
                    <ul>
                    <?php foreach($SVS as $svs): ?>
                        <?php $subcategorias = count_subcategory_pulzos($svs->id); ?>
                        <?php if($i%2 == 0): ?>
                            <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                <?php echo anchor('#',
                                                  $svs->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id."','#texto-menu');return false;")); ?>
                            </li>
                        <?php else: ?>
                            <li style="margin-right: 15px; display: inline; line-height: 14px; margin-left: -4px" class="span-5 last">
                                <?php echo anchor('#',
                                                  $svs->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id."','#texto-menu');return false;")); ?>
                            </li>
                        <?php endif; ?>
                        <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE SERVICIOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SOLO CULTURA **INICIO** -->
                <?php $soloCulturaComunidad = count_category_pulzos('17'); ?>
               <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Solo Cultura">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-cultura.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Solo Cultura (<?php echo $soloCulturaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="sc">
                    <?php $SC = get_subcategories("17"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($SC as $sc): ?>
                            <?php $subcategorias = count_subcategory_pulzos($sc->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-3 last">
                                    <?php echo anchor('#',
                                                      $sc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display:inline; line-height: 14px; width: 200px; margin-left: -4px" class="span-3 last">
                                    <?php echo anchor('#',
                                                      $sc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div> 
            </div><!--DIV DE SOLO CULTURA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE TEATRO Y CINE **INICIO** -->
                <?php $teatroCine = get_categories('18'); ?>
                <?php $teatroCineComunidad = count_category_pulzos('18'); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Teatro y Cine">
                        <!-- span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                        </span -->
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-teatro.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                            Teatro y Cine (<?php echo $teatroCineComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE TEATRO Y CINE **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIAJES Y TOURS **INICIO** -->
                <?php $viajesYToursComunidad = count_category_pulzos('19'); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Viajes y tours">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-viajes.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Viajes y tours (<?php echo $viajesYToursComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vyt">
                    <?php $VYT = get_subcategories("19"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VYT as $vyt): ?>
                            <?php $subcategorias = count_subcategory_pulzos($vyt->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left:-4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div><!-- DIV DE VIAJES Y CINES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA ACTIVA **INICIO** -->
                <?php $vidaActivaComunidad = count_category_pulzos('20'); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Vida Activa">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-activa.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida activa (<?php echo $vidaActivaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="va">
                    <?php $VA = get_subcategories("20"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VA as $va): ?>
                            <?php $subcategorias = count_subcategory_pulzos($va->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $va->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$va->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$va->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$va->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $va->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$va->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$va->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$va->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE VIDA ACTIVA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA FAMILIAR **INICIO** -->
                <?php $vidaFamiliarComunidad = count_category_pulzos('21'); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Vida Familiar">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-familiar.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida familiar (<?php echo $vidaFamiliarComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vf">
                    <?php $VF = get_subcategories("21"); ?>
                    <?php $i = 0; ?>
                    <?php $j = 1; ?>
                    <ul>
                        <?php foreach($VF as $vf): ?>
                            <?php $subcategorias = count_subcategory_pulzos($vf->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vf->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vf->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!--DIV DE VIDA FAMILIAR **FIN** -->
            <div class="span-4" style="margin-top: 15px"><!-- DIV DE LA VIDA NOCTURNA **INICIO** -->
                <?php $vidaNocturnaComunidad = count_category_pulzos('22'); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Vida Nocturna">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-bares.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida nocturna (<?php echo $vidaNocturnaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vn">
                    <?php $VN = get_subcategories("22"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($VN as $vn): ?>
                            <?php $subcategorias = count_subcategory_pulzos($vn->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vn->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vn->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE LA VIDA NOCTURNA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA POLITICA **INICIO** -->
                <?php $vidaPoliticaActiva = count_category_pulzos('23'); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Vida Politica">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-politica.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida politica (<?php echo $vidaPoliticaActiva; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vp">
                    <?php $VP = get_subcategories("23"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VP as $vp): ?>
                            <?php $subcategorias = count_subcategory_pulzos($vp->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vp->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id."','#texto-menu');return false;")); ?>
                                 </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vp->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id."',null);Enviar('".base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id."','#texto-menu');return false;")); ?>
                                 </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE VIDA POLITICA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE OTROS **INICIO** -->
                <?php $otros = get_categories('12'); ?>
                <?php $otrosComunidad = count_category_pulzos('12'); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Otros">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-varios.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Otros (<?php echo $otrosComunidad; ?>)
                        </div>
                    </div>
                </a>
                </div><!-- DIV DE OTROS **FIN** -->
        </div><!-- DIV DE LA COLUMNA DE LA DERECHA **FIN** -->
        </div><!-- DIV ACOMODO DEL MENU DERECHA **FIN** -->
    </div><!-- DIV QUE CONTIENE LA PARTE DEL CUERPO -->
</div><!--  DIV DE LA PARTE DE LOS PULZOS EN DIRECTORIO **FIN** --> 
<div style="display: none" id="actividades-miciudad"><!-- DIV DE LA PARTE DE LOS PULZOS EN DIRECTORIO **INICIO** -->
    <div class="span-10 last" id="filtros-miciudad" style="margin-top: 10px; color: #660066">
        <div class="prepend-3 span-2">
            <?php echo form_radio(array('id'=>'hoyFiltro',
                                        'class'=>'filtros',
                                        'name'=>'filtro',
                                        'value'=>'',
                                        'style'=>'')); ?>Hoy
        </div>
        <div class="span-2">
            <?php echo form_radio(array('id'=>'semanalFiltro',
                                        'class'=>'filtros',
                                        'name'=>'filtro',
                                        'value'=>'',
                                        'style'=>'')); ?>Semanal
        </div>
        <div class="span-2">
            <?php echo form_radio(array('id'=>'mensualFiltro',
                                        'class'=>'filtros',
                                        'name'=>'filtro',
                                        'value'=>'',
                                        'style'=>'')); ?>Mensual
        </div>
    </div>
    <div style="display: none" id="diarios"><!-- DIV DE LA PARTE DONDE SE HARA EL FILTRADO DE LAS ACTIVIDADES DEL DIA -->
    <div class="span-13" style="margin-top: 30px"><!-- DIV QUE CONTIENE LA PARTE DEL CUERPO **INICIO** -->
        <div class="span-6">
            <div class="span-6"><!-- DIV AYUDA TU COMUNIDAD **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $ayudaComunidad = count_all_activities_by_day('1', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Ayuda a tu Comunidad">                                       <span style="color: #530047; margin-left: 1px; margin-bottom: 1px" id="mas-comunidad">
                            +
                        </span>
                        <div style="width: 240px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-ayuda.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                            <div style="margin-top: -25px; margin-left: 55px; color: #530047">
                                Ayuda a tu comunidad (<?php echo $ayudaComunidad; ?>)
                            </div>
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px;" id="ac1">
                    <?php $AC = get_subcategories("1"); ?>
                    <?php $i = 1; ?>
                    <ul>
                    <?php foreach($AC as $ac): ?>
                        <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $ac->id); ?>
                        <?php if($i%2 == 0): ?>
                            <li class="span-6 last" style="display: inline; margin-left: -18px; line-height: 14px; background-color: #DBCCE3; width: 200px;">
                                    <?php echo anchor('#',
                                                      $ac->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$ac->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$ac->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                            </li>
                        <?php else: ?>
                            <li class="span-6 last" style="display: inline; margin-right: 0px; margin-left: -4px; line-height: 14px">
                                    <?php echo anchor('#',
                                                      $ac->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$ac->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$ac->id."/".$fechaActual."','#texto-menu');return false;"));?>
                            </li>
                        <?php endif; ?>
                        <?php $i = $i + 1; ?>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV AYUDA A TU COMUNIDAD **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CAFES **INICIO** -->
                <?php $cafes = get_categories("2"); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $cafesComunidad = count_all_activities_by_day('2', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id.'/'.$over;?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id;?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id;?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Cafés">

                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-cafes.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                            <div style="margin-top: -25px; margin-left: 55px; color: #530047">
                                Caf&eacute;s (<?php echo $cafesComunidad; ?>)
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE CAFES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CASINOS **INICIO** -->
                <?php $casinos = get_categories("3"); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $casinosComunidad = count_all_activities_by_day('3', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Casinos">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-casinos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                        </div>
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Casinos (<?php echo $casinosComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE CASINOS **FIN**-->
           <div class="span-6" style="margin-top: 15px"><!-- DIV DE CONCIERTOS Y EVENTOS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $conciertosYeventos = count_all_activities_by_day('4', $fechaActual); ?>                
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Conciertos y Eventos">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 190px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-conciertos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                        </div>
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047; width: 220px">
                        Conciertos y Eventos (<?php echo $conciertosYeventos; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px;" id="cye1">
                    <?php $CYE = get_subcategories("4"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($CYE as $cye): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $cye->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $cye->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$cye->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$cye->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display:inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $cye->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$cye->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$cye->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE CONCIERTOS Y EVENTOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CURSOS Y TALLERES **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $cursosYtalleres = count_all_activities_by_day('5', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Cursos y Talleres">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Cursos y Talleres (<?php echo $cursosYtalleres; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="cyt1">
                    <?php $CYT = get_subcategories("5"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($CYT as $cyt): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $cyt->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li class="span-5 last" style="display: inline; line-height: 14px; margin-left: -18px; background-color: #DBCCE3; width: 200px">
                                    <?php echo anchor('#',
                                                      $cyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$cyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$cyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li class="span-5 last" style="display: inline; line-height: 14px; margin-left: -4px">
                                    <?php echo anchor('#',
                                                      $cyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$cyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$cyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE CURSOS Y TALLERES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE COMPRAS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $deComprasComunidad = count_all_activities_by_day('6', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="De compras">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        De Compras (<?php echo $deComprasComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="dc1">
                    <?php $DC = get_subcategories("6"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($DC as $dc): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $dc->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $dc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$dc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$dc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $dc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$dc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$dc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div><!-- DIV DE COMPRAS **FIN** -->
          <div class="span-6" style="margin-top: 15px"><!-- DIV DE ESOTERICO **INICIO** -->
                <?php $esoterico = get_categories("7"); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $esotericoComunidad = count_all_activities_by_day('7', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Esoterico">
                        <!--span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                        </span-->
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-esoterico.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Esoterico (<?php echo $esotericoComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE ESOTERICO **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE EVENTOS RELIGIOSOS **INICIO** -->
                <?php $religiosos = get_categories('8'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $religiososComunidad = count_all_activities_by_day('8', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Eventos Religiosos">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-religioso.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Eventos Religiosos (<?php echo $religiososComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE EVENTOS RELIGIOSOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE EXPOS Y FERIAS **INICIO** -->
                <?php $exposFerias = get_categories('9'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $exposFeriasComunidad = count_all_activities_by_day('9', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Expos y Ferias">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-expo.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Expos y Ferias (<?php echo $exposFeriasComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE EXPOS Y FERIAS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE FUERA DE LO COMUN **INICIO** -->
                <?php $fueraComun = get_categories('11'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $fueraComunComunidad = count_all_activities_by_day('11', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Fuera de lo Comun">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-raro.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Fuera de lo com&uacute;n (<?php echo $fueraComunComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE FUERA DE LO COMUN **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE PUNTOS TURISTICOS -->
                <?php $puntosTuristicos = get_categories('13'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $puntosTuristicosComunidad = count_all_activities_by_day('13', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Puntos Turisticos">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-turisticos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                            Puntos tur&iacute;sticos (<?php echo $puntosTuristicosComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE PUNTOS TURISTICOS -->
        </div>
        <div class="span-6" style="margin-left: 30px"><!-- DIV POSICIONAR ELEMENTOS DERECHA **INICIO** -->
        <div class="span-6"><!-- DIV DE LA COLUMNA DERECHA **INICIO** -->
            <div class="span-6"><!-- DIV DE RESTAURANTES **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $restaurantesComunidad = count_all_activities_by_day('14', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Restaurantes">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-restaurante.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Restaurantes (<?php echo $restaurantesComunidad; ?>)
                        </div>
                    </div>
                </a>                
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="rst1">
                    <?php $RTS = get_subcategories("14"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($RTS as $rts): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $rts->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $rts->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$rts->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$rts->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $rts->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$rts->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$rts->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i +1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE RESTAURANTES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SALUD Y BELLEZA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $saludYbellezaC = count_all_activities_by_day('15', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Salud y Belleza">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-salud.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Salud y Belleza (<?php echo $saludYbellezaC; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="syb1">
                    <?php $SYB = get_subcategories("15"); ?> 
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($SYB as $syb): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $syb->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $syb->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$syb->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$syb->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $syb->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$syb->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$syb->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i+1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE SALUD Y BELLEZA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SERVICIOS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $serviciosComunidad = count_all_activities_by_day('16', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Servicios">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Servicios (<?php echo $serviciosComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="svs1">
                    <?php $SVS = get_subcategories("16"); ?>
                    <?php $i = 1; ?>
                    <ul>
                    <?php foreach($SVS as $svs): ?>
                        <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $svs->id); ?>
                        <?php if($i%2 == 0): ?>
                            <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                <?php echo anchor('#',
                                                  $svs->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$svs->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$svs->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                            </li>
                        <?php else: ?>
                            <li style="margin-right: 15px; display: inline; line-height: 14px; margin-left: -4px" class="span-5 last">
                                <?php echo anchor('#',
                                                  $svs->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$svs->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$svs->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                            </li>
                        <?php endif; ?>
                        <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE SERVICIOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SOLO CULTURA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $soloCulturaComunidad = count_all_activities_by_day('17', $fechaActual); ?>
               <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Solo Cultura">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-cultura.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Solo Cultura (<?php echo $soloCulturaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="sc1">
                    <?php $SC = get_subcategories("17"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($SC as $sc): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $sc->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-3 last">
                                    <?php echo anchor('#',
                                                      $sc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$sc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$sc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display:inline; line-height: 14px; width: 200px; margin-left: -4px" class="span-3 last">
                                    <?php echo anchor('#',
                                                      $sc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$sc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$sc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div> 
            </div><!--DIV DE SOLO CULTURA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE TEATRO Y CINE **INICIO** -->
                <?php $teatroCine = get_categories('18'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $teatroCineComunidad = count_all_activities_by_day('18', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Teatro y Cine">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-teatro.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                            Teatro y Cine (<?php echo $teatroCineComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE TEATRO Y CINE **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIAJES Y TOURS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $viajeYToursComunidad = count_all_activities_by_day('19', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Viajes y tours">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-viajes.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Viajes y tours (<?php echo $viajesYToursComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vyt1">
                    <?php $VYT = get_subcategories("19"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VYT as $vyt): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $vyt->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$vyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$vyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left:-4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$vyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$vyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div><!-- DIV DE VIAJES Y CINES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA ACTIVA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaActivaComunidad = count_all_activities_by_day('20', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Vida Activa">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-activa.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida activa (<?php echo $vidaActivaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="va1">
                    <?php $VA = get_subcategories("20"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VA as $va): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $va->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $va->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$va->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$va->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$va->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $va->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$va->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$va->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$va->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE VIDA ACTIVA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA FAMILIAR **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaFamiliarComunidad = count_all_activities_by_day('21', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Vida Familiar">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-familiar.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida familiar (<?php echo $vidaFamiliarComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vf1">
                    <?php $VF = get_subcategories("21"); ?>
                    <?php $i = 0; ?>
                    <?php $j = 1; ?>
                    <ul>
                        <?php foreach($VF as $vf): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $vf->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vf->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$vf->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$vf->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vf->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$vf->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$vf->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!--DIV DE VIDA FAMILIAR **FIN** -->
            <div class="span-4" style="margin-top: 15px"><!-- DIV DE LA VIDA NOCTURNA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaNocturnaComunidad = count_all_activities_by_day('22', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Vida Nocturna">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-bares.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida nocturna (<?php echo $vidaNocturnaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vn1">
                    <?php $VN = get_subcategories("22"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($VN as $vn): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $vn->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vn->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$vn->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$vn->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vn->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$vn->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$vn->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE LA VIDA NOCTURNA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA POLITICA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaPoliticaComunidad = count_all_activities_by_day('23', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc1" name="Vida Politica">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-politica.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida politica (<?php echo $vidaPoliticaActiva; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vp1">
                    <?php $VP = get_subcategories("23"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VP as $vp): ?>
                            <?php $subcategorias = count_all_subactivities_by_day($fechaActual, $vp->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vp->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$vp->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$vp->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                 </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vp->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_dia/".$vp->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_dia/".$vp->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                 </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE VIDA POLITICA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE OTROS **INICIO** -->
                <?php $otros = get_categories('12'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $otrosComunidad = count_all_activities_by_day('12', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Otros">
                        <!--span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                        </span-->
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-varios.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Otros (<?php echo $otrosComunidad; ?>)
                        </div>
                    </div>
                </a>
                </div><!-- DIV DE OTROS **FIN** -->
        </div><!-- DIV DE LA COLUMNA DE LA DERECHA **FIN** -->
        </div><!-- DIV ACOMODO DEL MENU DERECHA **FIN** -->
    </div><!-- DIV QUE CONTIENE LA PARTE DEL CUERPO -->
    </div><!-- DIV DONDE SE HARA EL FILTRADO DE LAS ACTIVIDADES DEL DIA **FIN** -->
    <div style="display: none" id="semanal"><!-- DIV DONDE SE HARA EL FILTRADO DE LAS ACTIVIDADES DE LA SEMANA **INICIO** -->
     <div class="span-13" style="margin-top: 30px"><!-- DIV QUE CONTIENE LA PARTE DEL CUERPO **INICIO** -->
        <div class="span-6">
            <div class="span-6"><!-- DIV AYUDA TU COMUNIDAD **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $ayudaComunidad = count_all_activities_by_week('1', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Ayuda a tu Comunidad">                                       <span style="color: #530047; margin-left: 1px; margin-bottom: 1px" id="mas-comunidad">
                            +
                        </span>
                        <div style="width: 240px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-ayuda.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                            <div style="margin-top: -25px; margin-left: 55px; color: #530047">
                                Ayuda a tu comunidad (<?php echo $ayudaComunidad; ?>)
                            </div>
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px;" id="ac2">
                    <?php $AC = get_subcategories("1"); ?>
                    <?php $i = 1; ?>
                    <ul>
                    <?php foreach($AC as $ac): ?>
                        <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $ac->id); ?>
                        <?php if($i%2 == 0): ?>
                            <li class="span-6 last" style="display: inline; margin-left: -18px; line-height: 14px; background-color: #DBCCE3; width: 200px;">
                                    <?php echo anchor('#',
                                                      $ac->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$ac->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$ac->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                            </li>
                        <?php else: ?>
                            <li class="span-6 last" style="display: inline; margin-right: 0px; margin-left: -4px; line-height: 14px">
                                    <?php echo anchor('#',
                                                      $ac->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$ac->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$rts->id."/".$fechaActual."','#texto-menu');return false;"));?>
                            </li>
                        <?php endif; ?>
                        <?php $i = $i + 1; ?>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV AYUDA A TU COMUNIDAD **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CAFES **INICIO** -->
                <?php $cafes = get_categories("2"); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $cafesComunidad = count_all_activities_by_week('2', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id.'/'.$over;?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id;?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id;?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Cafés">

                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-cafes.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                            <div style="margin-top: -25px; margin-left: 55px; color: #530047">
                                Caf&eacute;s (<?php echo $cafesComunidad; ?>)
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE CAFES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CASINOS **INICIO** -->
                <?php $casinos = get_categories("3"); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $casinosComunidad = count_all_activities_by_week('3', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Casinos">
                        <!-- span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                        </span -->
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-casinos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                        </div>
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Casinos (<?php echo $casinosComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE CASINOS **FIN**-->
           <div class="span-6" style="margin-top: 15px"><!-- DIV DE CONCIERTOS Y EVENTOS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $conciertosYeventos = count_all_activities_by_week('4', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Conciertos y Eventos">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 190px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-conciertos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                        </div>
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047; width: 220px">
                        Conciertos y Eventos (<?php echo $conciertosYeventos; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px;" id="cye2">
                    <?php $CYE = get_subcategories("4"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($CYE as $cye): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $cye->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $cye->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$cye->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$cye->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display:inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $cye->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$cye->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$cye->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE CONCIERTOS Y EVENTOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CURSOS Y TALLERES **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $cursosYtalleres = count_all_activities_by_week('5', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Cursos y Talleres">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Cursos y Talleres (<?php echo $cursosYtalleres; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="cyt2">
                    <?php $CYT = get_subcategories("5"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($CYT as $cyt): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $cyt->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li class="span-5 last" style="display: inline; line-height: 14px; margin-left: -18px; background-color: #DBCCE3; width: 200px">
                                    <?php echo anchor('#',
                                                      $cyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$cyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$cyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li class="span-5 last" style="display: inline; line-height: 14px; margin-left: -4px">
                                    <?php echo anchor('#',
                                                      $cyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$cyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$cyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE CURSOS Y TALLERES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE COMPRAS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $deComprasComunidad = count_all_activities_by_week('6', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="De compras">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        De Compras (<?php echo $deComprasComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="dc2">
                    <?php $DC = get_subcategories("6"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($DC as $dc): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $dc->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $dc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$dc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$dc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $dc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$dc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$dc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div><!-- DIV DE COMPRAS **FIN** -->
          <div class="span-6" style="margin-top: 15px"><!-- DIV DE ESOTERICO **INICIO** -->
                <?php $esoterico = get_categories("7"); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $esotericoComunidad = count_all_activities_by_week('7', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Esoterico">

                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-esoterico.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Esoterico (<?php echo $esotericoComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE ESOTERICO **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE EVENTOS RELIGIOSOS **INICIO** -->
                <?php $religiosos = get_categories('8'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $religiososComunidad = count_all_activities_by_week('8', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Eventos Religiosos">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-religioso.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Eventos Religiosos (<?php echo $religiososComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE EVENTOS RELIGIOSOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE EXPOS Y FERIAS **INICIO** -->
                <?php $exposFerias = get_categories('9'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $exposFeriasComunidad = count_all_activities_by_week('9', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Expos y Ferias">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-expo.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Expos y Ferias (<?php echo $exposFeriasComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE EXPOS Y FERIAS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE FUERA DE LO COMUN **INICIO** -->
                <?php $fueraComun = get_categories('11'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $fueraComunComunidad = count_all_activities_by_week('11', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Fuera de lo Comun">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-raro.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Fuera de lo com&uacute;n (<?php echo $fueraComunComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE FUERA DE LO COMUN **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE PUNTOS TURISTICOS -->
                <?php $puntosTuristicos = get_categories('13'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $puntosTuristicosComunidad = count_all_activities_by_week('13', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Puntos Turisticos">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-turisticos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Puntos tur&iacute;sticos (<?php echo $puntosTuristicosComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE PUNTOS TURISTICOS -->
        </div>
        <div class="span-6" style="margin-left: 30px"><!-- DIV POSICIONAR ELEMENTOS DERECHA **INICIO** -->
        <div class="span-6"><!-- DIV DE LA COLUMNA DERECHA **INICIO** -->
            <div class="span-6"><!-- DIV DE RESTAURANTES **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $restaurantesComunidad = count_all_activities_by_week('14', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Restaurantes">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-restaurante.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Restaurantes (<?php echo $restaurantesComunidad; ?>)
                        </div>
                    </div>
                </a>                
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="rst2">
                    <?php $RTS = get_subcategories("14"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($RTS as $rts): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $rts->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $rts->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$rts->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$rts->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $rts->nombre . ' (' . $subcategorias . ')',array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$rts->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$rts->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i +1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE RESTAURANTES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SALUD Y BELLEZA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $saludYbellezaC = count_all_activities_by_week('15', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Salud y Belleza">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-salud.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Salud y Belleza (<?php echo $saludYbellezaC; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="syb2">
                    <?php $SYB = get_subcategories("15"); ?> 
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($SYB as $syb): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $syb->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $syb->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$syb->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$syb->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $syb->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$syb->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$syb->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i+1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE SALUD Y BELLEZA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SERVICIOS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $serviciosComunidad = count_all_activities_by_week('16', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Servicios">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Servicios (<?php echo $serviciosComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="svs2">
                    <?php $SVS = get_subcategories("16"); ?>
                    <?php $i = 1; ?>
                    <ul>
                    <?php foreach($SVS as $svs): ?>
                        <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $svs->id); ?>
                        <?php if($i%2 == 0): ?>
                            <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                <?php echo anchor('#',
                                                  $svs->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$svs->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$svs->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                            </li>
                        <?php else: ?>
                            <li style="margin-right: 15px; display: inline; line-height: 14px; margin-left: -4px" class="span-5 last">
                                <?php echo anchor('#',
                                                  $svs->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$svs->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$svs->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                            </li>
                        <?php endif; ?>
                        <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE SERVICIOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SOLO CULTURA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $soloCulturaComunidad = count_all_activities_by_week('17', $fechaActual); ?>
               <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Solo Cultura">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-cultura.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Solo Cultura (<?php echo $soloCulturaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="sc2">
                    <?php $SC = get_subcategories("17"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($SC as $sc): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $sc->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-3 last">
                                    <?php echo anchor('#',
                                                      $sc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$sc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$sc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display:inline; line-height: 14px; width: 200px; margin-left: -4px" class="span-3 last">
                                    <?php echo anchor('#',
                                                      $sc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$sc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$sc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div> 
            </div><!--DIV DE SOLO CULTURA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE TEATRO Y CINE **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $teatroCineComunidad = count_all_activities_by_week('18', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Teatro y Cine">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-teatro.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                            Teatro y Cine (<?php echo $teatroCineComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE TEATRO Y CINE **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIAJES Y TOURS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $viajesYToursComunidad = count_all_activities_by_week('19', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Viajes y tours">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-viajes.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Viajes y tours (<?php echo $viajesYToursComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vyt2">
                    <?php $VYT = get_subcategories("19"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VYT as $vyt): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $vyt->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$vyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$vyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left:-4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$vyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$vyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div><!-- DIV DE VIAJES Y CINES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA ACTIVA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaActivaComunidad = count_all_activities_by_week('20', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Vida Activa">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-activa.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida activa (<?php echo $vidaActivaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="va2">
                    <?php $VA = get_subcategories("20"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VA as $va): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $va->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $va->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$va->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$va->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$va->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $va->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$va->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$va->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$va->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE VIDA ACTIVA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA FAMILIAR **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaFamiliarComunidad = count_all_activities_by_week('21', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Vida Familiar">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-familiar.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida familiar (<?php echo $vidaFamiliarComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vf2">
                    <?php $VF = get_subcategories("21"); ?>
                    <?php $i = 0; ?>
                    <?php $j = 1; ?>
                    <ul>
                        <?php foreach($VF as $vf): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $vf->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vf->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$vf->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$vf->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vf->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$vf->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$vf->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!--DIV DE VIDA FAMILIAR **FIN** -->
            <div class="span-4" style="margin-top: 15px"><!-- DIV DE LA VIDA NOCTURNA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaNocturnaComunidad = count_all_activities_by_week('22', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Vida Nocturna">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-bares.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida nocturna (<?php echo $vidaNocturnaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vn2">
                    <?php $VN = get_subcategories("22"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($VN as $vn): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $vn->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vn->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$vn->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$vn->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vn->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$vn->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$vn->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE LA VIDA NOCTURNA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA POLITICA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaPoliticaActiva = count_all_activities_by_week('23', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc2" name="Vida Politica">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-politica.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida politica (<?php echo $vidaPoliticaActiva; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vp2">
                    <?php $VP = get_subcategories("23"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VP as $vp): ?>
                            <?php $subcategorias = count_all_subactivities_by_week($fechaActual, $vp->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vp->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$vp->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$vp->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                 </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vp->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_semana/".$vp->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_semana/".$vp->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                 </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE VIDA POLITICA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE OTROS **INICIO** -->
                <?php $otros = get_categories('12'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $otrosComunidad = count_all_activities_by_week('12', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Otros">

                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-varios.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Otros (<?php echo $otrosComunidad; ?>)
                        </div>
                    </div>
                </a>
                </div><!-- DIV DE OTROS **FIN** -->
        </div><!-- DIV DE LA COLUMNA DE LA DERECHA **FIN** -->
        </div><!-- DIV ACOMODO DEL MENU DERECHA **FIN** -->
    </div><!-- DIV QUE CONTIENE LA PARTE DEL CUERPO -->
    </div><!-- DIV DONDE SE HARA EL FILTRADO DE LAS ACTIVIDADES DE LA SEMANA **FIN** -->
    <div style="display: none" id="mensual"><!-- DIV DE DONDE SE HARA EL FILTRADO DE LAS ACTIVIDADES DEL MES **INICIO** -->
     <div class="span-13" style="margin-top: 30px"><!-- DIV QUE CONTIENE LA PARTE DEL CUERPO **INICIO** -->
        <div class="span-6">
            <div class="span-6"><!-- DIV AYUDA TU COMUNIDAD **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $ayudaComunidad = count_all_activities_by_month('1', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Ayuda a tu Comunidad">                                       <span style="color: #530047; margin-left: 1px; margin-bottom: 1px" id="mas-comunidad">
                            +
                        </span>
                        <div style="width: 240px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-ayuda.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                            <div style="margin-top: -25px; margin-left: 55px; color: #530047">
                                Ayuda a tu comunidad (<?php echo $ayudaComunidad; ?>)
                            </div>
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px;" id="ac3">
                    <?php $AC = get_subcategories("1"); ?>
                    <?php $i = 1; ?>
                    <ul>
                    <?php foreach($AC as $ac): ?>
                        <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $ac->id); ?>
                        <?php if($i%2 == 0): ?>
                            <li class="span-6 last" style="display: inline; margin-left: -18px; line-height: 14px; background-color: #DBCCE3; width: 200px;">
                                    <?php echo anchor('#',
                                                      $ac->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$ac->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$ac->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                            </li>
                        <?php else: ?>
                            <li class="span-6 last" style="display: inline; margin-right: 0px; margin-left: -4px; line-height: 14px">
                                    <?php echo anchor('#',
                                                      $ac->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$ac->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$ac->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$ac->id."/".$fechaActual."','#texto-menu');return false;"));?>
                            </li>
                        <?php endif; ?>
                        <?php $i = $i + 1; ?>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV AYUDA A TU COMUNIDAD **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CAFES **INICIO** -->
                <?php $cafes = get_categories("2"); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $cafesComunidad = count_all_activities_by_month('2', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id.'/'.$over;?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id;?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $cafes->id;?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Cafés">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-cafes.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                            <div style="margin-top: -25px; margin-left: 55px; color: #530047">
                                Caf&eacute;s (<?php echo $cafesComunidad; ?>)
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE CAFES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CASINOS **INICIO** -->
                <?php $casinos = get_categories("3"); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $casinosComunidad = count_all_activities_by_month('3', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $casinos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Casinos">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-casinos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                        </div>
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Casinos (<?php echo $casinosComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE CASINOS **FIN**-->
           <div class="span-6" style="margin-top: 15px"><!-- DIV DE CONCIERTOS Y EVENTOS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $conciertosYeventos = count_all_activities_by_month('4', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Conciertos y Eventos">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 190px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-conciertos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                        </div>
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047; width: 220px">
                        Conciertos y Eventos (<?php echo $conciertosYeventos; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px;" id="cye3">
                    <?php $CYE = get_subcategories("4"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($CYE as $cye): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $cye->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $cye->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$cye->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$cye->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display:inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $cye->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cye->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$cye->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$cye->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE CONCIERTOS Y EVENTOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE CURSOS Y TALLERES **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $cursosYtalleres = count_all_activities_by_month('5', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Cursos y Talleres">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Cursos y Talleres (<?php echo $cursosYtalleres; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="cyt3">
                    <?php $CYT = get_subcategories("5"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($CYT as $cyt): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $cyt->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li class="span-5 last" style="display: inline; line-height: 14px; margin-left: -18px; background-color: #DBCCE3; width: 200px">
                                    <?php echo anchor('#',
                                                      $cyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$cyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$cyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li class="span-5 last" style="display: inline; line-height: 14px; margin-left: -4px">
                                    <?php echo anchor('#',
                                                      $cyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$cyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$cyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$cyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE CURSOS Y TALLERES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE COMPRAS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $deComprasComunidad = count_all_activities_by_month('6', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="De compras">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        De Compras (<?php echo $deComprasComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="dc3">
                    <?php $DC = get_subcategories("6"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($DC as $dc): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $dc->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $dc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$dc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$dc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $dc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$dc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$dc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$dc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div><!-- DIV DE COMPRAS **FIN** -->
          <div class="span-6" style="margin-top: 15px"><!-- DIV DE ESOTERICO **INICIO** -->
                <?php $esoterico = get_categories("7"); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $esotericoComunidad = count_all_activities_by_month('7', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $esoterico->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Esoterico">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-esoterico.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Esoterico (<?php echo $esotericoComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE ESOTERICO **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE EVENTOS RELIGIOSOS **INICIO** -->
                <?php $religiosos = get_categories('8'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $religiososComunidad = count_all_activities_by_month('8', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $religiosos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Eventos Religiosos">
                        <!--span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                        </span-->
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-religioso.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Eventos Religiosos (<?php echo $religiososComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE EVENTOS RELIGIOSOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE EXPOS Y FERIAS **INICIO** -->
                <?php $exposFerias = get_categories('9'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $exposFeriasComunidad = count_all_activities_by_month('9', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $exposFerias->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Expos y Ferias">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-expo.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Expos y Ferias (<?php echo $exposFeriasComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE EXPOS Y FERIAS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE FUERA DE LO COMUN **INICIO** -->
                <?php $fueraComun = get_categories('11'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $fueraComunComunidad = count_all_activities_by_month('11', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $fueraComun->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Fuera de lo Comun">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-raro.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Fuera de lo com&uacute;n (<?php echo $fueraComunComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE FUERA DE LO COMUN **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE PUNTOS TURISTICOS -->
                <?php $puntosTuristicos = get_categories('13'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $puntosTuristicosComunidad = count_all_activities_by_month('13', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $puntosTuristicos->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Puntos Turisticos">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-turisticos.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Puntos tur&iacute;sticos (<?php echo $puntosTuristicosComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE PUNTOS TURISTICOS -->
        </div>
        <div class="span-6" style="margin-left: 30px"><!-- DIV POSICIONAR ELEMENTOS DERECHA **INICIO** -->
        <div class="span-6"><!-- DIV DE LA COLUMNA DERECHA **INICIO** -->
            <div class="span-6"><!-- DIV DE RESTAURANTES **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $restaurantesComunidad = count_all_activities_by_month('14', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Restaurantes">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-restaurante.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Restaurantes (<?php echo $restaurantesComunidad; ?>)
                        </div>
                    </div>
                </a>                
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="rst3">
                    <?php $RTS = get_subcategories("14"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($RTS as $rts): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $rts->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $rts->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$rts->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$rts->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $rts->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$rts->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$rts->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$rts->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i +1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE RESTAURANTES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SALUD Y BELLEZA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $saludYbellezaC = count_all_activities_by_month('15', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Salud y Belleza">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-salud.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Salud y Belleza (<?php echo $saludYbellezaC; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="syb3">
                    <?php $SYB = get_subcategories("15"); ?> 
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($SYB as $syb): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $syb->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $syb->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$syb->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$syb->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $syb->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$syb->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$syb->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$syb->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i+1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE SALUD Y BELLEZA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SERVICIOS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $serviciosComunidad = count_all_activities_by_month('16', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Servicios">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/compras.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Servicios (<?php echo $serviciosComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="svs3">
                    <?php $SVS = get_subcategories("16"); ?>
                    <?php $i = 1; ?>
                    <ul>
                    <?php foreach($SVS as $svs): ?>
                        <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $svs->id); ?>
                        <?php if($i%2 == 0): ?>
                            <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                <?php echo anchor('#',
                                                  $svs->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$svs->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$svs->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                            </li>
                        <?php else: ?>
                            <li style="margin-right: 15px; display: inline; line-height: 14px; margin-left: -4px" class="span-5 last">
                                <?php echo anchor('#',
                                                  $svs->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$svs->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$svs->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$svs->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                            </li>
                        <?php endif; ?>
                        <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE SERVICIOS **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE SOLO CULTURA **INICIO** -->
               <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
               <?php $soloCulturaComunidad = count_all_activities_by_month('17', $fechaActual); ?>
               <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Solo Cultura">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-cultura.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Solo Cultura (<?php echo $soloCulturaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="sc3">
                    <?php $SC = get_subcategories("17"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($SC as $sc): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $sc->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-3 last">
                                    <?php echo anchor('#',
                                                      $sc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$sc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$sc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display:inline; line-height: 14px; width: 200px; margin-left: -4px" class="span-3 last">
                                    <?php echo anchor('#',
                                                      $sc->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$sc->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$sc->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$sc->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div> 
            </div><!--DIV DE SOLO CULTURA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE TEATRO Y CINE **INICIO** -->
                <?php $teatroCine = get_categories('18'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $teatroCineComunidad = count_all_activities_by_month('18', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id.'/'.$over; ?>" class="sin-sub"  onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $teatroCine->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Teatro y Cine">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-teatro.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                            Teatro y Cine (<?php echo $teatroCineComunidad; ?>)
                        </div>
                    </div>
                </a>
            </div><!-- DIV DE TEATRO Y CINE **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIAJES Y TOURS **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $viajesYToursComunidad = count_all_activities_by_month('19', $fechaActual); ?>
                <a href="#" style="text-decoration: none">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Viajes y tours">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-viajes.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Viajes y tours (<?php echo $viajesYToursComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vyt3">
                    <?php $VYT = get_subcategories("19"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VYT as $vyt): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $vyt->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$vyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$vyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left:-4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vyt->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vyt->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$vyt->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$vyt->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div><!-- DIV DE VIAJES Y CINES **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA ACTIVA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaActivaComunidad = count_all_activities_by_month('20', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Vida Activa">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-activa.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida activa (<?php echo $vidaActivaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="va3">
                    <?php $VA = get_subcategories("20"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VA as $va): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $va->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $va->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$va->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$va->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$va->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="display: inline; margin-right: 0px; line-height: 14px; margin-left: -4px" class="span-5 last">
                                    <?php echo anchor('#',
                                                      $va->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$va->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$va->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$va->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE VIDA ACTIVA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA FAMILIAR **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaFamiliarComunidad = count_all_activities_by_month('21', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Vida Familiar">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-familiar.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida familiar (<?php echo $vidaFamiliarComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vf3">
                    <?php $VF = get_subcategories("21"); ?>
                    <?php $i = 0; ?>
                    <?php $j = 1; ?>
                    <ul>
                        <?php foreach($VF as $vf): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $vf->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vf->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$vf->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$vf->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vf->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vf->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$vf->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$vf->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!--DIV DE VIDA FAMILIAR **FIN** -->
            <div class="span-4" style="margin-top: 15px"><!-- DIV DE LA VIDA NOCTURNA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaNocturnaComunidad = count_all_activities_by_month('22', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Vida Nocturna">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-bares.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida nocturna (<?php echo $vidaNocturnaComunidad; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vn3">
                    <?php $VN = get_subcategories("22"); ?>
                    <?php $i = 0; ?>
                    <ul>
                        <?php foreach($VN as $vn): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $vn->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vn->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$vn->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$vn->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vn->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vn->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$vn->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$vn->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE LA VIDA NOCTURNA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE VIDA POLITICA **INICIO** -->
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $vidaPoliticaActiva = count_all_activities_by_month('23', $fechaActual); ?>
                <a href="#">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc3" name="Vida Politica">
                        <span style="color: #530047; margin-left: 1px; border-bottom: 1px">
                            +
                        </span>
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-politica.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Vida politica (<?php echo $vidaPoliticaActiva; ?>)
                        </div>
                    </div>
                </a>
                <div class="span-6" style="display: none; background-color: #E7DCEC; width: 200px" id="vp3">
                    <?php $VP = get_subcategories("23"); ?>
                    <?php $i = 1; ?>
                    <ul>
                        <?php foreach($VP as $vp): ?>
                            <?php $subcategorias = count_all_subactivities_by_month($fechaActual, $vp->id); ?>
                            <?php if($i%2 == 0): ?>
                                <li style="display:inline; background-color: #DBCCE3; line-height: 14px; width: 200px; margin-left: -18px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vp->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 20px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$vp->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$vp->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                 </li>
                            <?php else: ?>
                                <li style="margin-right: 0px; display: inline; line-height: 14px; margin-left: -4px" class="span-4 last">
                                    <?php echo anchor('#',
                                                      $vp->nombre . ' (' . $subcategorias . ')', array('id'=>base_url()."index.php/pulzos/mostrar_pulzos/".$vp->id.'/'.$over,'class'=>'enlace_miciudad', 'style'=>'color: #660066; margin-left: 6px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/pulzos/mostrar_por_mes/".$vp->id."/".$fechaActual."',null);Enviar('".base_url()."index.php/pulzos/mostrar_por_mes/".$vp->id."/".$fechaActual."','#texto-menu');return false;")); ?>
                                 </li>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- DIV DE VIDA POLITICA **FIN** -->
            <div class="span-6" style="margin-top: 15px"><!-- DIV DE OTROS **INICIO** -->
                <?php $otros = get_categories('12'); ?>
                <?php $fechaActual = mktime(0, 0, 0, date('m'), date('d'), date('Y')); ?>
                <?php $otrosComunidad = count_all_activities_by_month('12', $fechaActual); ?>
                <a href="<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id.'/'.$over; ?>" class="sin-sub" onclick="dhtmlHistory.add('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id; ?>',null);Enviar('<?php echo base_url(); ?>index.php/pulzos/mostrar_pulzos/<?php echo $otros->id; ?>','#texto-menu');return false">
                    <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" name="Otros">
                        <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -5px; background-color: #F0F0F0">
                            <?php echo img(array('src'=>'statics/img/miCiudad/cd-varios.png',
                                                 'width'=>'35',
                                                 'height'=>'18',
                                                 'style'=>'margin-left: 8px; margin-top: -4px')); ?>                    
                        </div>                    
                        <div style="margin-top: -25px; margin-left: 70px; color: #530047">
                        Otros (<?php echo $otrosComunidad; ?>)
                        </div>
                    </div>
                </a>
                </div><!-- DIV DE OTROS **FIN** -->
        </div><!-- DIV DE LA COLUMNA DE LA DERECHA **FIN** -->
        </div><!-- DIV ACOMODO DEL MENU DERECHA **FIN** -->
    </div><!-- DIV QUE CONTIENE LA PARTE DEL CUERPO -->
    </div><!-- DIV DONDE SE HARA EL FILTRADO DE LAS ACTIVIDADES DEL MES **FIN** -->
</div><!--  DIV DE LA PARTE DE LOS PULZOS EN DIRECTORIO **FIN** -->
</div><!-- DIV PRINCIPAL QUE CONTIENE TODO **FIN** -->
