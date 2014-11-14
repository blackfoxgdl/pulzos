$(document).ready(function(){
    $("#top-menu-albums").click(function(event){
        event.preventDefault();
        urlToLoad = $(this).attr("href");
        $("#texto-menu").load(urlToLoad);
    });
    $("#top-menu-amigos").click(function(event){
        event.preventDefault();
        urlToLoad = $(this).attr("href");
        $("#texto-menu").load(urlToLoad);
    });
    $("#top-menu-editar-datos").click(function(event){
        event.preventDefault();
        urlToLoad = $(this).attr("href");
        $("#texto-menu").load(urlToLoad);
    });
    $("div#boton").click(function(){
        $("div#perfil").hide("fast");
        $("div#boton").css("display", "none");
        $("div#boton-1").css("display", "inline");
        if($("div#boton-1").css("display", "inline")){
            $("div#boton-1").click(function(){
                $("div#perfil").show("fast");
                $("div#boton").css("display", "inline");
                $("div#boton-1").css('display', "none");
            });
        }
    });

    //agregar albums a la madre esta
    $(".menu-accordion").click(function(event){
        event.preventDefault();
        urlToCall = $(event.currentTarget).attr('href');
        $("#canvas").load(urlToCall);
    });
});
