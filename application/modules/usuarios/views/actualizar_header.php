<?php
/**
 * Metodo que se usa para poder
 * actualizar el header de los usuarios
 * para que se puedan actualizar sin necesidad
 * de que dañe algun campo de texto
 **/
?>

<script type="text/javascript">
function Enviare(pagina,capa) {
				
			sessvars.pagina1=pagina;
				sessvars.capa1=capa;
}
</script>
<div id="header-container"><!-- DIV DEL HEADER DEL SUBMENU **INICIO** -->
    <div class="container"><!-- DIV DEL CONTAINER DEL SUBMENU **INICIO** -->
        <div class="span-24 last">
            <div class="span-5"><!--<div class="span-8"> -->
                &nbsp;
            </div>
            <div id="header-container1"><!-- DIV DEL HEADER DEL SUBMENU **INICIO** -->

                    <div class="span-2">
                       &nbsp;
                    </div>
             </div><!-- DIV DEL CONTAINER DEL SUBMENU **FIN** -->
            <div class="span-1">
                &nbsp;
            </div>
            <div class="span-2">
                <?php if($notificacion > 0): ?>
                    <div class="notificaciones" style="margin-top: -4px; margin-left: -15px"></div>
                    <div style="margin-top: -18px; color: #FFFFFF; margin-left: -9px">
                        <?php if($notificacion > 99): ?>
                            <?php echo "99"; ?>
                        <?php else: ?>
                            <?php echo $notificacion; ?>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    &nbsp;
                <?php endif; ?>
            </div>
            <div class="span-4">
                <?php if($inboxT > 0): ?>
                            <div class="notificaciones" style="margin-left: 2px; margin-top: -4px"></div>
                                <div style="margin-top: -18px; margin-left: 8px; color: #FFFFFF">
                                    <?php if($inboxT > 99): ?>
                                        <?php echo "99"; ?>
                                    <?php else: ?>
                                        <?php echo $inboxT; ?>
                                    <?php endif; ?>
                                </div>
                        <?php else: ?>
                            &nbsp;
                        <?php endif; ?>
            </div>


            <div class="span-4 last">
                <div class="span-8" style="margin-left: 80px">
                     <span style="color: #FFFFFF">
                       
                                          
                        <?php echo anchor('#',
                                          'Editar Cuenta', 
                                           array('id'=>'invitacion-user', 'style'=>'text-decoration: none; margin-left: 15px; color: #FFFFFF','onclick'=>"dhtmlHistory.add('".base_url()."index.php/usuarios/editar_datos/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/usuarios/editar_datos/".$this->session->userdata('id')."','#texto-menu');return false;")); ?>                  
                    </span>
                    <span style="color: #FFFFFF; margin-right: 10px">
                        |
                    </span>
                    <span style="color: #FFFFFF">
                        
                        <?php echo anchor('#',
                                          'Ayuda',
                                          array('id'=>'ayuda-user', 'class'=>'middle-menu-link', 'style'=>'text-decoration: none; margin-left: 0px; margin-right: 10px; color: #FFFFFF','onclick'=>"dhtmlHistory.add('".base_url()."index.php/notificaciones/ayuda/".$this->session->userdata('id')."',null);Enviar('".base_url()."index.php/notificaciones/ayuda/".$this->session->userdata('id')."','#texto-menu');return false;"));?>
                    </span>
                    <span style="color: #FFFFFF; margin-right: 10px">
                        |
                    </span>
                    <span style="color: #FF0000">


                        <div id="fb-root" style="float: left"></div>
                        <script type="text/javascript">
                        window.fbAsyncInit = function() {
                           FB.init({appId: '105242036173290', status: true, cookie: false, xfbml: true});
        
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

                        function logout(){
                            FB.logout(function(response){
                                console.log(response);
                            });
                        }
                        </script>
                        <?php $kindAccount = get_type_of_user($this->session->userdata('id')); ?>
                        <?php if($kindAccount->password == '0'): ?>
                            <?php echo anchor('usuarios/cerrar_sesion',
                                              'Salir', array('style'=>'text-decoration: none; color: #FFFFFF','onclick'=>"logout();")); ?>
                        <?php else: ?>
                            <?php echo anchor('usuarios/cerrar_sesion',
                                              'Salir', array('style'=>'text-decoration: none; color: #FFFFFF','onclick'=>"sessvars.$.clearMem();")); ?>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </div><!-- DIV DEL CONTAINER DEL SUBMENU **FIN** -->
