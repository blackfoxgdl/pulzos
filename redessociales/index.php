<?php
session_start();
if(isset($_SESSION['id']))
{//START TO MAIN IF
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="library/css/screen.css" />
        <link rel="shortcut icon" href="http://www.pulzos.com/statics/img/pulzos.ico" />
        <title> Pulzos - El pulzos de tu ciudad </title>
        <script type="text/javascript" src="library/js/jquery-1.7.1.js"></script>
        <style type="text/css">
            .foto-medidas-redes {
                height: auto !important;
                width: 160px;
            }

            #header-menu-redes {
                background-image: url("library/css/bg-header.gif");
                color: #FFFFFF;
                height: 28px;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".face-delete").click(function(event){
                    event.preventDefault();
                    get_url = $(event.currentTarget).attr('href');
                    $("#facebook_borrar").hide();
                    $("#tf").val('');
                    $.get(get_url);
                    var cssFB = {
                        'color' : 'RED',
                        'margin-left' : '10px',
                        'font-size' : '14px'
                    }
                    $("#mensaje_activate_deactivate_fb").text('Desactivada').css(cssFB);
                });

                $(".twett-delete").click(function(event){
                    event.preventDefault();
                    get_url = $(event.currentTarget).attr('href');
                    $("#twitter_borrar").hide();
                    $("#to").val('');
                    $("#tos").val('');
                    $.get(get_url);
                    var cssTW = {
                        'color' : 'RED',
                        'margin-left' : '10px',
                        'font-size' : '14px'
                    }
                    $("#mensaje_activate_deactivate_tw").text('Desactivada').css(cssTW);
                });
            });
        </script>
    </head>
    <body>
        <div>
            <div class="container">
                <div class="span-4">
                    <a href="http://www.pulzos.com/">
                    <img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/statics/img/logo-blanco.jpg" width="160" height="68" />
                    </a>
                </div> 
                <div class="span-14">
                    <div class="span-14" style="margin-top: 17px">
                        &nbsp;
                    </div>
                    <div class="span-13" style="margin-top: 10px; width: 420px" id="header-menu-redes">
                        <div style="float: left; width: 60px; margin-top: 8px">
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/inicio.php/usuarios/perfil#http://<?php echo $_SERVER['SERVER_NAME']; ?>/index.php/planesusuarios/ver/4" style="margin-left: 15px; text-decoration: none; color: #FFFFFF">
                                Inicio
                            </a>
                        </div>
                        <div style="float: left; margin-top: 8px">
                            |
                        </div>
                        <div style="float: left; width: 70px; margin-top: 9px">
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/inicio.php/usuarios/perfil#http://<?php echo $_SERVER['SERVER_NAME']; ?>/index.php/planesusuarios/mis_planes/4" style="text-decoration: none; color: #FFFFFF; margin-left: 13px">
                                Mi perfil
                            </a>
                        </div>
                        <div style="float: left; margin-top: 8px">
                            |
                        </div>
                        <div style="float: left; margin-top: 9px; width: 85px">
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/inicio.php/usuarios/perfil#http://<?php echo $_SERVER['SERVER_NAME']; ?>/index.php/inboxusuarios/index/4" style="text-decoration: none; color: #FFFFFF; margin-left: 15px">
                                Mensajes
                            </a>
                        </div>
                        <div style="float: left; margin-top: 8px;">
                            |
                        </div>
                        <div style="float: left; margin-top: 9px; width: 105px">
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/inicio.php/usuarios/perfil#http://<?php echo $_SERVER['SERVER_NAME']; ?>/index.php/notificaciones/index/4" style="text-decoration: none; color: #FFFFFF; margin-left: 15px">
                                Notificaciones
                            </a>
                        </div>
                        <div style="float: left; margin-top: 8px">
                            |
                        </div>
                        <div style="float: left; margin-top: 9px">
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/inicio.php/usuarios/perfil#http://<?php echo $_SERVER['SERVER_NAME']; ?>/index.php/money/index/4" style="text-decoration: none; color: #FFFFFF; margin-left: 15px">
                                Mi cartera
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="background-color: #660068; color: #BE8898; height: 20px;">
            <div class="container">
                <div class="span-24">
                    <div class="prepend-19">
                        <span style="color: #FFFFFF; margin-left: 0px">
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/inicio.php/usuarios/perfil#http://<?php echo $_SERVER['SERVER_NAME']; ?>/index.php/usuarios/editar_datos/4" style="text-decoration: none; margin-left: 15px; color: #FFFFFF">
                                Editar Cuenta
                            </a>
                        </span>
                        <span style="color: #FFFFFF; margin-right: 10px">
                            |
                        </span>
                        <span style="color: #FFFFFF">
                            <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/inicio.php/developers/index" style="margin-left: 0px; margin-right: 10px; color: #FFFFFF; text-decoration: none">
                                API
                            </a>
                        </span>
                        <span style="color: #FFFFFF; margin-right: 10px">
                            |
                        </span>
                        <span style="color: #FFFFFF">
                            <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/inicio.php/usuarios/cerrar_sesion" style="text-decoration: none; color: #FFFFFF">
                                Salir
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
<?php
//before the if
            include('library/social_media_user/libraries/Facebooklib2.php');
            include('library/social_media_user/libraries/libs/tweet.php');
            require_once('conexion.php');

            $conexion = conectar();
            $sql = "select * from social_media where socialUsuarioId = " . $_SESSION['id'];
            $query = mysql_query($sql, $conexion)
                or die('Error en el query de consulta de formulario: ' . $sql . '<br />' . mysql_error());
            $total = mysql_num_rows($query);
            /** FACEBOOK START **/
            //inicializa la libreria facebook
            $config = array();
            $config['FB_appId'] = '105242036173290';
            $config['FB_secret'] = '690132721bf0e38bbe449c4d5208eef0';
            $config['FB_cookie'] = FALSE;

            //Facebook required permissions
            $config['FB_req_perms'] = 'publish_stream,offline_access,email';

            $facebook = new Facebooklib2($config);
            $user_link = $facebook->get_user();
            /** FACEBOOK END **/
            /** TWITTER START **/
            $config_t = array();
            $config_t['tweet_consumer_key'] = 'IKWIRAjsnSEEGV69WWakQ';
            $config_t['tweet_consumer_secret'] = 'M73YmextkSYAuqbRJwJfrK8pErTHQvVRds3rkI4Fnc';

            $tokens = new tweetOauth($config_t);
            /** TWITTER END **/

            //QUERY FOR THE IMAGE
            $query_image = "select * from albums left join imagenes on imagenAlbumId = albumId where albumUsuarioId = " . $_SESSION['id'] . " and imagenAvatar = 1";
            $imagen = mysql_query($query_image, $conexion)
                or die('Error en la imagen: ' . $query_image . '<br />' . mysql_error());
            $total_imagenes = mysql_num_rows($imagen);
            if($total_imagenes != 0)
            {
                $imagenes_datos = mysql_fetch_row($imagen);
                $imagen_data = $imagenes_datos[13];
            }
            else
            {
                $imagen_data = 'statics/img/default/avatar.jpg';
            }
        ?>
        <div class="container">
            <div class="span-4 last" style="width: 160px">
                <img src="http://<?php echo $_SERVER['SERVER_NAME'] . '/' . $imagen_data; ?>" alt="" class="foto-medidas-redes" />
            </div>
            <div class="span-20 last" style="background-color: #EEEDF4">
                <div class="span-1">
                    &nbsp;
                </div>
                <div class="prepend-4 span-12 last" style="margin-top: 20px; background-color: #EEEDF4"><!-- FALTA CERRARLO -->
                    <span class="span-12" style="font-size: 18px; color: #660066">
                        Tus redes sociales
                    </span>
                    <div class="span-12" style="margin-top: 10px">
                        <a href="<?php echo $user_link; ?>" style="text-decoration: none">
                            <img src="http://www.pulzos.com/statics/img/facebook_original.png" alt="Facebook" style="width: 80px; height: 80px" />
                        </a>
                        <a href="http://www.pulzos.com/inicio.php/redessociales/get_twitter_tokens_bonficacionU">
                            <img src="http://www.pulzos.com/statics/img/twitter_original.png" alt="Twitter" style="height: 80px; width: 80px" />
                        </a>
                    </div>
                <?php
                    if($total == 1)
                    {
                ?>
                        <div class="span-12">
                <?php
                        $query_update = "SELECT * FROM social_media WHERE socialUsuarioId = " . $_SESSION['id'];
                        $sql_update = mysql_query($query_update, $conexion)
                            or die('Error en la consulta: ' . $query_update . '<br />' . mysql_error());
                        $result = mysql_fetch_row($sql_update);
                        //PART VALIDATE FACEBOOK **BEGIN*
                        ?>
                        <div class="span-1" style="margin-left: -10px">
                        <div id="mensaje_activate_deactivate_fb">
                            <?php
                                if(empty($result[2]))
                                {
                                    if(empty($facebook->accessToken))
                                    {
                                    ?>
                                        <span style="color: #FF0000; margin-left: 5px; font-size: 14px">
                                            Desactivada
                                        </span>
                                    <?php
                                    }
                                    if(!empty($facebook->accessToken))
                                    {
                                    ?>
                                        <span style="color: #8D6E98; font-size: 14px; margin-left: 12px">
                                            Guardar
                                        </span>
                                    <?php
                                    }
                                }
                                if(!empty($result[2]))
                                {
                                    if($result[2] == '')
                                    {
                                        if(empty($facebook->accessToken))
                                        {
                                        ?>
                                            <span style="color: #FF0000; margin-left: 5px; font-size: 14px">
                                                Desactivada
                                            </span>
                                        <?php
                                        }
                                        if(!empty($facebook->accessToken))
                                        {
                                        ?>
                                            <span style="color: #8D6E98; font-size: 14px; margin-left: 12px">
                                                Guardar
                                            </span>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                    <span style="color: #339900; font-size: 14px; margin-left: 12px">
                                        Activada
                                    </span>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div id="facebook_borrar">
                            <?php
                                if(!empty($result[2]))
                                {
                                    if($result[2] != '')
                                    {
                                    ?>
                                        <a href="http://www.pulzos.com/inicio.php/redessociales/borrar_facebook/<?php echo $_SESSION['id']; ?>" style="color: #FF0000; margin-left: 10px; font-size: 14px; text-decoration: none;" class="face-delete">
                                            Borrar
                                        </a>
                                    <?php
                                    }
                                }
                            ?>
                            </div>
                        </div>
                        <?php
                        //PART ACTIVATE FACEBOOK **END**
                        //PART ACTIVATE TWITTER **BEGIN**
                        ?>
                        <div class="prepend-1 span-1" style="margin-left: 7px">
                        <div id="mensaje_activate_deactivate_tw">
                            <?php
                                if(empty($result[3]) && empty($result[4]))
                                {
                                    if(empty($_SESSION['twitter_oauth_tokens']['access_key']) && empty($_SESSION['twitter_oauth_tokens']['access_secret']))
                                    {
                                    ?>
                                        <span style="color: #FF0000; margin-left: 10px; font-size: 14px">
                                            Desactivada
                                        </span>
                                    <?php
                                    }
                                    if(!empty($_SESSION['twitter_oauth_tokens']['access_key']) && !empty($_SESSION['twitter_oauth_tokens']['access_secret']))
                                    {
                                    ?>
                                        <span style="color: #8D6E98; font-size: 14px; margin-left: 10px">
                                            Guardar
                                        </span>
                                    <?php
                                    }
                                }
                                if(!empty($result[3]) && !empty($result[4]))
                                {
                                    if($result[3] == '' && $result[4] == '')
                                    {
                                        if(empty($_SESSION['twitter_oauth_tokens']['access_key']) && empty($_SESSION['twitter_oauth_tokens']['access_secret']))
                                        {
                                        ?>
                                            <span style="color: #FF0000; margin-left: 10px; font-size: 14px">
                                                Desactivada
                                            </span>
                                        <?php
                                        }
                                        if(!empty($_SESSION['twitter_oauth_tokens']['access_key']) && !empty($_SESSION['twitter_oauth_tokens']['access_secret']))
                                        {
                                        ?>
                                            <span style="color: #8D6E98; font-size: 14px; margin-left: 10px">
                                                Guardar
                                            </span>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                    ?>
                                        <span style="color: #339900; font-size: 14px; margin-left: 10px">
                                            Activada
                                        </span>
                                    <?php
                                    }
                                }
                                ?>
                            </div>
                            <div id="twitter_borrar">
                                <?php
                                    if(!empty($result[3]) && !empty($result[4]))
                                    {
                                        if($result[3] != '' && $result[4] != '')
                                        {
                                        ?>
                                            <a href="http://www.pulzos.com/inicio.php/redessociales/borrar_twitter/<?php echo $_SESSION['id']; ?>" class="twett-delete" style="color: #FF0000; margin-left: 10px; font-size: 14px; text-decoration: none">
                                                Borrar
                                            </a>
                                        <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                        //PART ACTIVATE TWITTER **END**
                        if(!empty($facebook->accessToken))
                        {
                            $facebook->accessToken;
                        }
                        else
                        {
                            $facebook->accessToken = $result[2];
                        }
                        if((!isset($result[3]) && !isset($result[4])) || ($result[3] == '' && $result[4] == ''))
                        {
                            $_SESSION['twitter_oauth_tokens']['access_key'];
                            $_SESSION['twitter_oauth_tokens']['access_secret'];
                        }
                        else
                        {
                            $_SESSION['twitter_oauth_tokens']['access_key'] = $result[3];
                            $_SESSION['twitter_oauth_tokens']['access_secret'] = $result[4];
                        }
                    ?>
                        </div>
                        <form method="post" action="insercion.php">
                            <input type="hidden" id="tf" name="tokenFacebook" value="<?php echo $facebook->accessToken; ?>" />
                            <input type="hidden" id="to" name="twitter_oauth" value="<?php echo $_SESSION['twitter_oauth_tokens']['access_key']; ?>" />
                            <input type="hidden" id="tos" name="twitter_oauth_secret" value="<?php echo $_SESSION['twitter_oauth_tokens']['access_secret']; ?>" />
                            <input type="hidden" name="status" value="1" />
                            <input type="submit" value="Guardar" style="margin-left: 30px; background-color: #660066; color: #FFFFFF; border: none; font-size: 12px; height: 20px; margin-top: 8px; width: 70px" />
                        </form>
                        <br /><br />
                <?php
                        }
                        else
                        {
                ?>
                        <div class="span-12">
                            <?php 
                            if(empty($facebook->accessToken))
                            {
                            ?>
                                <span style="color: #FF0000; margin-left: 5px; font-size: 14px">
                                    Desactivada
                                </span>
                            <?php
                            }
                            if(!empty($facebook->accessToken))
                            {
                            ?>
                                <span style="color: #8D6E98; font-size: 14px; margin-left: 12px">
                                    Guardar
                                </span>
                            <?php
                            }
                            if(empty($_SESSION['twitter_oauth_tokens']['access_key']) && empty($_SESSION['twitter_oauth_tokens']['access_secret']))
                            {
                            ?>
                                <span style="color: #FF0000; margin-left: 10px; font-size: 14px">
                                    Desactivada
                                </span>
                            <?php
                            }
                            if(!empty($_SESSION['twitter_oauth_tokens']['access_key']) && !empty($_SESSION['twitter_oauth_tokens']['access_secret']))
                            {
                            ?>
                                <span style="color: #8D6E98; font-size: 14px; margin-left: 10px">
                                    Guardar
                                </span>
                            <?php
                            }
                            ?>
                        </div>
                        <form action="insercion.php" method="post">
                            <input type="hidden" name="tokenFacebook" value="<?php echo $facebook->accessToken; ?>" />
                            <input type="hidden" name="twitter_oauth" value="<?php echo $_SESSION['twitter_oauth_tokens']['access_key']; ?>" />
                            <input type="hidden" name="twitter_oauth_secret" value="<?php echo $_SESSION['twitter_oauth_tokens']['access_secret']; ?>" />
                            <input type="hidden" name="status" value="0" /> 
                            <input type="submit" value="Guardar" style="margin-left: 50px; background-color: #660066; color: #FFFFFF; border: none; font-size: 12px; height: 20px; margin-top: 8px; width: 70px" />
                        </form>
                        <br /><br />
                <?php
                }
                ?>
                </div>
            </div>
            <div class="span-24">
                <div class="prepend-9 span-1">
                    <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/inicio.php/developers/index" style="text-decoration: none; color: #511E59; margin-top: 10px">
                        API
                    </a>
                </div>
                <div class="span-1">
                    <a href="http://www.pulzos.com/blog" style="text-decoration: none; color: #511E59; margin-top: 10px" target="_blanl">
                        Blog
                    </a>
                </div>
                <div class="span-3" style="margin-left: 10px; color: #929497">
                    &#169 2012 Pulzos&nbsp;
                </div>
            </div>
        </div>
    <?php
    }//END TO MAIN IF
    else
    {
        header('Location: http://www.pulzos.com/');
    }
    ?>
    </body>
</html>
