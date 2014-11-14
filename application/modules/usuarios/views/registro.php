<?php
  /**
   * Form's view of user register
   *
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   * @version 0.1
   * @copyright Zavordigital February 22, 2011
   * @package Core
   **/
echo doctype();
echo link_tag('statics/css/ext/noregistro.css');
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/validate/jquery.validate.min.js'; ?>"></script>
<script language="javascript">

$(document).ready(function(){
   
$("#pais").change(function(event){
    event.preventDefault();
    val = $(this).attr("value");
    link = $("#estado_link").attr('href');
    $.post(link, 
           {ciudad:val},
           function(data){
               $("#ciudad > option").remove();
               $.each(data, function(index, value){
                   $("#ciudad").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
           },
           "json"
        );
    });

});


</script>
<?php echo anchor('usuarios/create_estados', '', array('id'=>'estado_link', 'style'=>'display: none')); ?>
<div class="container colorbody">
    <div class="span-12" id="mapa_back1" style="margin-bottom: 60px">
        <div class="prepend-1 span-11" id="texto_slogan">
            <div class="span-11" style="margin-left: 100px; margin-top: -58px">
                <?php echo img(array('src'=>'statics/img/user_Badge.png',
                                     'width'=>'234px',
                                     'height'=>'233px')); ?>
                <!--iframe width="470" height="290" src="http://www.youtube.com/embed/8KrlPgAtU2c" frameborder="0" allowfullscreen>
                </iframe-->
            </div>
        </div>
    </div>
    <div class="prepend-12">
        <div class="span-11 last" id="registro-inicio1" style="margin-top: -3px">
            <?php /*echo form_open('usuarios/guardar', array('id'=>'registro-inicio')); ?>
                <div class="span-10 last">
                    <div class="span-4 first">
                        &nbsp;
                    </div>
                    <div class="prepend-4 first span-7 last" id="top_registro">
                        <font id="aunTexto">¿A&uacute;n no estas inscrito?</font><font id="registrateTexto"> ¡Reg&iacute;strate!</font>
                    </div>
                </div>
                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Nombre:','nombre'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_input(array('id'=>'nombreUsuario',
                                                    'class'=>'inputRegistro',
                                                    'name'=>'Usuarios[nombre]')); ?>
                    </div>
                </div>
                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Apellido:','apellido'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_input(array('id'=>'apellidoUsuario',
                                                    'class'=>'inputRegistro',
                                                    'name'=>'Usuarios[apellidos]')); ?>
                    </div>
                </div>
                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Correo electr&oacute;nico:','email'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_input(array('id'=>'emailUsuario',
                                                    'class'=>'inputRegistro',
                                                    'name'=>'Usuarios[email]')); ?>
                    </div>
                </div>
                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Confirma tu correo electr&oacute;nico:','emailConfirm'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_input(array('id'=>'emailConfirm',   
                                                    'class'=>'inputRegistro',
                                                    'name'=>'Usuarios[emailConfirm]')); ?>
                    </div>
                </div>
                <div class="span-10 last separacion2">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Contrase&ntilde;a:','password'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php echo form_password(array('id'=>'passwordUsuario',
                                                       'class'=>'inputRegistro',
                                                       'name'=>'Usuarios[password]')); ?>
                    </div>
                </div>

                <div class="span-10 last separacion">
                    <div class="span-4 first textForm">
                        <?php echo form_label('Fecha de nacimiento:','fecnacUsuario'); ?>
                    </div>
                    <div class="span-6 last">
                        <?php $dia = 'id="dias"
                                  class="textDays"';
                              $mes = 'id="mes"
                                  class="textMonths"';
                              $ano = 'id="anos"
                                  class="textYears"'; ?>
                        <?php echo form_dropdown('Usuarios[dias]',$dias,'',$dia); ?>
                        <?php echo form_dropdown('Usuarios[mes]', $meses,'',$mes); ?>
                        <?php echo form_dropdown('Usuarios[ano]',$anos,'',$ano); ?>

                    </div>
                </div>
                <div class="span12 last">
                    &nbsp;
                </div>
                <div class="prepend-4">
                            <?php echo anchor('negocios/crear',
                                'Registra tu empresa', array('class'=>'enlaceRegistro')); ?>
                            <?php echo form_submit(array('id'=>'registro',
                                                         'class'=>'',
                                                         'name'=>'registroDeUsuario')); ?>
                </div>
                < ?php echo form_close();*/ ?>
            <div id="fb-root"></div>
            <script type="text/javascript">

                window.fbAsyncInit = function() {//105242036173290
                    FB.init({appId: '223599169655', status: true, cookie: true, xfbml: true, frictionlessRequests: true,});
        
                    /* All the events registered */
                    FB.Event.subscribe('auth.login', function(response) {
                        // do something with response
                        //alert('hola: ' + response.authResponse.accessToken);
                        $("#tokens").text(response.authResponse.accessToken);
                        login();
                    });

                    FB.Event.subscribe('auth.logout', function(response) {
                        // do something with response
                        logout();
                    });
 
                    FB.getLoginStatus(function(response) {
                        if (response.session) {
                            // logged in and connected user, someone you know
                            login();
                        }
                    });
                };

                (function() {
                    var e = document.createElement('script');
                    e.type = 'text/javascript';
                    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                    e.async = true;
                    document.getElementById('fb-root').appendChild(e); 
                }());

                function login(){
                    FB.api('/me', function(response) {
                        user_picture = "https://graph.facebook.com/"+response.id+"/picture?type=normal";
                        user_picture1 = "https://graph.facebook.com/"+response.id+"/picture?type=square";
                        console.log(response);
                        url_avatar = $("#avatar_fb").attr("href");
                        url_send = $("#link_fb").attr("href");
                        access_token = $("#tokens").text();
                        //CHECK THE STATUS OF THE USER THAT WANT TO LOGIN
                        statusEU = $.ajax({
                                            type: "GET",
                                            url: "http://www.test.pulzos.com/inicio.php/usuarios/check_useraccount/"+response.email,
                                            async: false
                                           }).responseText;
                        if(statusEU == 1)
                        {
                            location.href = "http://www.test.pulzos.com/inicio.php/usuarios/login";
                        }
                        else
                        {
                            $.post(url_send,
                                {first_name: response.first_name, last_name: response.last_name, gender: response.gender, email: response.email, token: access_token, birth: response.birthday, FBUid: response.id},
                                function(data){
                                    var idData = data;
                                    $.post(url_avatar,
                                            {avatar1: user_picture, avatar2: user_picture1, id: data},
                                            function(data)
                                            {
                                                location.href= "http://www.test.pulzos.com/inicio.php/usuarios/create/"+idData;
                                            }
                                           );
                                        }
                            );
                        }
                    });
                }

                function logout(){
                    document.getElementById('login').style.display = "none";
                }

                function sendRequestToRecipients() {
                    var user_ids = document.getElementsByName("user_ids")[0].value;
                    FB.ui({method: 'apprequests',
                          message: 'My Great Request',
                          to: user_ids, 
                        }, requestCallback);
                  }

              function sendRequestViaMultiFriendSelector() {
                    FB.ui({method: 'apprequests',
                          message: 'My Great Request'
                        }, requestCallback);
              }
      
              function requestCallback(response) {
                    // Handle callback here
              }
        </script>
            <?php echo anchor('usuarios/login_fb', '', array('id'=>'link_fb', 'style'=>'display: none')); ?>
            <?php echo anchor('usuarios/save_avatar', '', array('id'=>'avatar_fb', 'style'=>'display: none')); ?>
            <div class="span-8" style="margin-top: 50px">
                <?php echo //anchor('',
                                  img(array('src'=>'statics/img/boton_Tutorial.png',
                                            'width'=>'281px',
                                            'height'=>'92px'));//,
                             //     array('style'=>'text-decoration: none')); ?>
            </div>
            <div class="span-8" style="margin-top: 20px; position: relative; margin-left: 10px">
                <!--fb:login-button autologoutlink="true" scope="email,user_birthday,status_update,publish_stream,user_photos,offline_access">
                    <div style="background-color: #531F5B; margin: -50px;" id="fb_button"> 
                    </div>
                </fb:login-button-->
            </div>
            <div>
                <a href="#" onclick="fblogin(); return false;">
                    <?php echo img(array('src'=>'statics/img/FBconnect.png',
                                         'width'=>'281px',
                                         'height'=>'85px',
                                         'style'=>'margin-top: -30px')); ?>
                </a>
                <div id="old-sign">
                    <?php /*echo anchor('usuarios/login',
                                      img(array('src'=>'statics/img/old_users.png',
                                                'width'=>'188px',
                                                'height'=>'20px',
                                                'style'=>'margin-top: -10px; padding-bottom: 0px')),
                                      array('style'=>'text-decoration: none'));*/ ?>
                </div>
            </div>
            <script>
                //your fb login function
                function fblogin() {
                    FB.login(function(response) {
                        if(response.session)
                        {
                            login();
                            console.log(response);
                        }
                    }, {scope:'read_stream,email,user_birthday,status_update,publish_stream,user_photos,offline_access'});
                }
            </script>
            <div id="tokens" style="display: none"></div>
            <div id="login"></div>
            <!--input type="button" onclick="sendRequestToRecipients(); return false;" value="Send Request to Users Directly" />
            <br />
            <input type="button" onclick="sendRequestViaMultiFriendSelector(); return false;" value="Send Request to Many Users with MFS" / -->
        </div>
    </div>
    <div class="span-24 last">
        &nbsp;
    </div>
    <div class="span-24" style="margin-top: 30px; position: relative">
        <div class="prepend-7" style="margin-left: -20px">
            <span style="">
                <?php echo anchor('http://itunes.apple.com/us/app/pulzos/id481729135?l=es&ls=1&mt=8',
                                  img(array('src'=>'statics/img/AppStore_Logo.png',
                                            'width'=>'176px',
                                            'height'=>'63px')),
                                  array('style'=>'text-decoration: none', 'target'=>'_blank')); ?>
            </span>
            <span style="margin-left: 60px">
                <?php echo img(array('src'=>'statics/img/GooglePlay_Logo.png',
                                     'height'=>'64px',
                                     'width'=>'176px')); ?>
            </span>
        </div>
    </div>
<script type="text/javascript">
$("#mes").change(function(event){
    event.preventDefault();
    var mes = $(this).attr("value");
    tamano = $("select[id=dias] > option").size();
    if(tamano == "31" && (mes == "01" || mes == "03" || mes == "05" || mes == "07" || mes == "08" || mes == "10" || mes =="12"))
    {
        $("#dias").append("<option value='31'>31</option>");
    }
    if(tamano == "29" && (mes == "01" || mes == "03" || mes == "05" || mes == "07" || mes == "08" || mes == "10" || mes =="12"))
    {
        $("#dias").append("<option value='29'>29</option>");
        $("#dias").append("<option value='30'>30</option>");
        $("#dias").append("<option value='31'>31</option>");
    }
    if(tamano == "29" && (mes == "04" || mes == "06" || mes == "09" || mes == "11"))
    {
        $("#dias").append("<option value='29'>29</option>");
        $("#dias").append("<option value='30'>30</option>");
    }
    if(mes == "04" || mes == "06" || mes == "09" || mes == "11")
    {
        var dia = $("#dias").attr("value");
        $("#dias option[value='31']").remove();
    }
    if(mes == "02")
    {
        var dia = $("#dias").attr("value");
        $("#dias option[value='29']").remove();
        $("#dias option[value='30']").remove();
        $("#dias option[value='31']").remove();
    }
});
</script>
