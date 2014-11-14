$(document).ready(function(){
        var url = "http://localhost/pulzos_bueno/index.php/albumnegocios/pruebas/";
        $('.prueba').click(function(e){
            e.preventDefault();
            $('.holas').html('hola');
        $.get(
                url,
                function(data)
                {
                    alert(data.nombre);
                },
                "json"
            );
        });
    });
