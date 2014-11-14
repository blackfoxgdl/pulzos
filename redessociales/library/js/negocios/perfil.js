$(document).ready(function(event){
        //FUNCION PARA CARGAR LA VISTA DIFERENTE
        //DEL MENU, HACER EL EFECTO DE OCULTAR O
        //ABRIR EL PERFIL DEL USUARIO
            $('div#boton').click(function(){
                   $("div#perfil").hide("fast");
                   $("div#boton").css("display","none");
                   $("div#boton-1").css("display","inline");
                   if($("div#boton-1").css("display","inline"))
                   {
                        $("div#boton-1").click(function(){
                                $("div#perfil").show("fast");
                                $("div#boton").css("display","inline");
                                $("div#boton-1").css("display","none");
                            });
                   }
                });

            //PARTE PARA LA CARGA DE ARCHIVOS DINAMICAMENTE SIEMPRE Y CUANDO NO SEAN
            //CAJAS DE TEXTO PARA POSTEAR
            $('.menu').live('click',function(event){
                        event.preventDefault();
                        var url = $(event.currentTarget).attr("href");
                        $("#dinamica").load(url);
                    });

            //SE USA PARA AGREGAR AMIGOS Y LA REDIRECCION DE LOS MISMOS
            //O SEGUIDORES DE LAS EMPRESAS
            $("#seguirEmpresa").click(function(event){
                    event.preventDefault();
                    var url = $(this).attr("href");
                    $.get(url);
                    $(this).hide("fast");
            });

            //SE USA PARA QUE EN LOS FORMULARIOS AL MOMENTO DE PRESIONAR EL BOTON
            //DE GUARDAR O CREAR PARA LOS ALBUMS DE LOS NEGOCIOS ADEMAS DE QUE
            //TAMBIEN SE USAN PARA LA EDICION DE LOS MISMOS
/*            $(".boton-perfil").click(function(event){
                    event.preventDefault();
                    var urlB = $('#NegociosC').attr('action');
                    var urlN = '';
                    var nombre = $('#albumNombre').val();
                    var lugar = $('#albumLugar').val();
                    var descripcion = $('#albumDescripcion').val();
                    $.post(
                        urlB,
                        {nombre: nombre, lugar: lugar, descripcion: descripcion},
                        function(data){
                            $("#dinamica").load(data.url);
                        },
                        "json"
                    );
            });

        //SE HACE LA FUNCION PARA BORRAR LOS ALBUMS DE LOS NEGOCIOS
        $('.borrarA').click(function(event){
                event.preventDefault();
                var urlA = $(this).attr('href');
                //alert('hola: ' + urlA);
                $.get(
                    urlA,
                    function(data){
                        $("#dinamica").load(data.url);
                        //alert("hola:" + data.url + data.id);
                    },
                    "json"
                );
        });

        //CONVERTIR EN AVATAR LA IMAGEN QUE SE DESEA
        //DEL ALBUM PROPIO
        $("#getavatar").click(function(event){
                event.preventDefault();
                var urlA = $(this).attr('href');
                $.get(
                    urlA,
                    function(data){
                        alert(data.id + " " + data.id2);
                        $("#dinamica").load(data.url);
                    },
                    "json"
                );
        });

        //BORRAR LAS IMAGENES DE LOS ALBUMS QUE YA NO SE QUIERAN
        //TENER EN LOS MISMO
        $('.borrar').click(function(event){
                event.preventDefault();
                var urlI = $(this).attr('href');
               // alert('hola: ' + urlI);
                $.get(
                    urlI,
                    function(data){
                        $("#dinamica").load(data.url);
                        //alert("hola: " + data.url);
                    },
                    "json"
                );
        });

        //EDITAR LOS DATOS DE LAS IMAGENES QUE SE TENDRAN
        //EN LSO DISTINTOS ALBUMS DE LOS NEGOCIOS
        $("#editarImagen").click(function(event){
                event.preventDefault();
                var url = $('#formEditarImagen').attr("action");
                var imagenE = $("#nombreImagen").val();
                var imagenD = $("#descripcionImagen").val();
               // alert(url + imagenE);
                $.post(
                    url,
                    {nombre: imagenE, descripcion: imagenD},
                    function(data){
                 //       alert("hola: " + data.url + "," + data.id + "," + data.id2);
                        $("#dinamica").load(data.url);
                    },
                    "json"
                );
        });

        //SE REALIZA LA FUNCION PARA PODER SUBIR UNA FOTO AL
        //ALBUM QUE SE SELECCIONE*/

    });//PARENTESIS Y LLAVE PRINCIPAL
