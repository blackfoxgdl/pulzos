$(document).ready(function(){
    $("#registro-negocio").validate({
        onsubmit: true,
        rules: {
            'Negocio[negocioNombre]':'required',
            'Negocio[negocioDireccion]':'required',
            'Negocio[negocioGiro]':'required',
            'Negocio[negocioEmail]': {
                email: true,
                required: true
            },
            'Negocio[emailConfirm]':{
                email: true,
                required: true
            },
            'Negocio[password]':'required',
            'Negocio[negocioPais]':{
                required: true,
                max: 1
            },
            'Negocio[negocioCiudad]':{
                required: true,
                max: 7
            }
        },
        messages:{
            'Negocio[negocioNombre]':'Ingresa el nombre del negocio',
            'Negocio[negocioDireccion]':'Ingresa la dirección del negocio',
            'Negocio[negocioGiro]':'Selecciona el giro del negocio',
            'Negocio[negocioEmail]':'Ingresa tu correo electronico',
            'Negocio[emailConfirm]':'Ingresa tu correo electronico',
            'Negocio[password]':'Ingresa el password de tu negocio',
            'Negocio[negocioPais]':'Selecciona el pais de tu negocio',
            'Negocio[negocioCiudad]':'Selecciona la ciudad de tu negocio'
        }
    });
});
       /* var valorDeCampo = "";
        $('input').focus(function(){
            valorDeCampo = $(this).val();
            $(this).val("");
            });

        $('#registro').validate({
wrapper: "div" ,
errorClass: "error",
errorElement: "div",
highlight: function(element, errorClass){
},
rules: {
'Negocio[negocioNombre]':'required',
'Negocio[negocioDireccion]':'required',
'Negocio[negocioEmail]': {
required: true,
email: true
},
'Negocio[negocioDescripcion]':'required',
'Negocio[password]':'required',
'Negocio[negocioConfirmacion]':'required',
'Negocio[negocioPais]':'number',
'Negocio[negocioCiudad]':'number',
'Negocio[negocioGiro]':'number'
},
messages:{
             'Negocio[negocioNombre]':'Este campo es requerido',
             'Negocio[negocioDireccion]':'Este campo es requerido',
             'Negocio[negocioEmail]': {
required:'Este campo es requerido',
         email:'Escriba un email valido'
             },
             'Negocio[negocioDescripcion]':'Este campo es requerido. Escriba la descripcion de su negocio',
             'Negocio[password]':'Este campo es requerido. De preferencia mas de caracteres',
             'Negocio[negocioConfirmacion]':'Este campo es requerido y debe ser igual al password'
         },
         });
});*/
