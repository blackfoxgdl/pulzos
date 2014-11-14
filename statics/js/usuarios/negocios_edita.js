$(document).ready(function(){
            $('$editar').validate({
                    wrapper: "div",
                    errorClass: "error",
                    errorElement: "div",
                    highlight: function(element, errorClass){
                    },
                    rules{
                        'NegocioE[negocioNombre]':'required',
                        'NegocioE[negocioDireccion]':'required',
                        'NegocioE[negocioGiro]':'number',
                        'NegocioE[negocioDescripcion]':'required',
                        'NegocioE[negocioEmail]':{
                            required: true,
                            email: true
                        },
                        'NegocioE[negocioPais]':'required',
                        'NegocioE[negocioCiudad]':'required',
                    },
                    message{
                        'NegocioE[negocioNombre]':'Este campo es requerido',
                        'NegocioE[negocioDireccion]':'Este campo es requerido',
                        'NegocioE[negocioGiro]':'Este campo es requerido',
                        'NegocioE[negocioDescripcion]':'Este campo es requerido. De preferencia escriba una descripcion del negocio',
                        'NegocioE[negocioEmail]':{
                            required:'Este campo es requerido',
                            email:'Escriba un email valido'
                        },
                        'NegocioE[negocioPais]':'Este campo es requerido',
                        'NegocioE[negocioCiudad]':'Este campos es requerido'
                    },
                });
        });
