$(document).ready(function(){
        $("#registro-inicio").validate({
            wrapper: "",
            errorElement: "span",
            highlight: function(element, errorClass){
            },
            errorPlacement: function(error, element){
                error.appendTo(element.next("span"));
            },
            rules: {
                'Usuarios[nombre]': 'required',
                'Usuarios[apellidos]': 'required'
                'Usuarios[email]': {
                    required: true,
                    email: true
                },
                'Usuarios[emailConfirm]': {
                    required: true,
                    email: true
                },
                'Usuarios[password]': 'required',
               // 'Usuarios[confirmPassword]': 'required',
                'Usuarios[idPulsera]': 'required',
                'Usuarios[sexo]': {
                    max: 1 
                },
                'Usuarios[pais]': 'number',
                'Usuarios[ciudad]': 'number',
            },
        });
});
