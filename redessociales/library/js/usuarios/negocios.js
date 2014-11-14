$(document).ready(function(){
        var valorDeCampo = "";
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
                'Negocio[negocioGiro]':'number',
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
});
