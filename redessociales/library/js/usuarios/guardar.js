$(document).ready(function(){
        //alert("hola");
        $("#registro-inicio").validate({
            onsubmit:true,
            rules : {
                'Usuarios[nombre]':'required',
                'Usuarios[apellidos]':'required',
                'Usuarios[email]':{
                    required: true,
                    email: true
                },
                'Usuarios[emailConfirm]':{
                    required: true,
                    email: true
                },
                'Usuarios[password]':'required',
                'Usuarios[pais]':{
                    required: true,
                    max: 250
                },
                'Usuarios[ciudad]':{
                    required: true,
                    max: 2202
                },
                'Usuarios[dias]':'required',
                'Usuarios[mes]':'required',
                'Usuarios[ano]':'required'
            },
            messages:{
                'Usuarios[nombre]':'Ingresa tu nombre',
                'Usuarios[apellidos]':'Ingresa tus apellidos',
                'Usuarios[email]':'Ingresa tu correo electronico',
                'Usuarios[emailConfirm]':'Ingresa de nuevo tu correo electronico',
                'Usuarios[password]':'Ingresa tu password'
            }
        });


});

/**
 *   /*     var valorDeCampo = "";
        $('input').focus(function(){
                valorDeCampo = $(this).val();
                $(this).val("");
            });
        
         $('input').blur(function(){
         $(this).val(valorDeCampo);
     })
     */
               /* wrapper: "div",
                errorClass: "error",
                errorElement: "div",
                highlight: function(element, errorClass){
                },
                rules: {
                    'Usuarios[nombre]': 'required',
                    'Usuarios[email]': {
                        required: true,
                        email: true
                    },
                    'Usuarios[password]': 'required',
                    //'Usuarios[confirmPassword]': 'required',
                    //                'Usuarios[idPulsera]': 'required',
                    'Usuarios[sexo]': {
                        max: 1 
                    },
                    'Usuarios[pais]': 'number',
                    'Usuarios[ciudad]': 'number',
                },
                messages:{
                    'Usuarios[nombre]': 'Este campo es requerido',
                    'Usuarios[email]': {
                        required: 'Este campo es requerido',
                        email: 'Escriba un email valido'
                    },
                    'Usuarios[password]': 'Este campo es requerido. De preferencia mas de 10 caracteres'
                  //  'Usuarios[confirmPassword]': 'Este campo es requerido y debe de ser igual a su password',
                    //              'Usuarios[idPulsera]': 'El numero de la pulsera que le toco'
                },
            });

    **/
