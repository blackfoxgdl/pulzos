<?php
/**
 * Libreria con funciones de los emails que se enviaran
 * por parte de la aplicacion de escritorio hacia los usuarios
 * dependiendo la funcion que se necesita y el proceso que se vaya
 * realizando, con el cual sean envio de correos.
 *
 * @version 1.0
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, Feb 16 2012
 * @package pulzos_desktop
 **/

/**
 * Metodo que se usa para el envio de los correo electronicos una
 * vez que el usuario de mostrador haya dado de alta a un usuario
 * de negocio con el cual el mismo recibira su correo con los
 * datos de su cuenta recien creada por parte del empleado y
 * con ciertos datos de informacion al usuario
 *
 * @params string nombre del usuario nuevo
 * @params int id del usuario creado
 * @params string email of the user
 * @params string url to redirect
 *
 * @return string template email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function new_user_welcome($n1, $id, $e1, $p1)
{
    $message = '<html>
                    <meta name="viewport" content="width=320, initial-scale=1, user-scalable=no">
                    <head>
                    <link media="only screen and (min-device-width: 481px)" href="http://www.pulzos.com/statics/css/ext/emails/iOSDevice.css" type= "text/css" rel="stylesheet">
					</head>
					<body>
						<div style="width: 765px; height: 80px" id="cabeza_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosCabecera.jpg" alt="Pulzos Rewards Network" />
                        </div>
                        <style type="text/css">
                        @media screen and (max-device-width: 481px) {#cabeza_movil
                            {
                                background-image: url("http://www.pulzos.com/statics/img/mailPulzosCabeceraMovil.jpg");
                                background-repeat: no-repeat;
                                width: 320px;
                                height: 100px;
                                margin:auto;
                            }

                            #cabeza_desktop
                            { 
                                display:none;
                            }}
                        </style>
                        <div id="cabeza_movil" align="left">
                        </div>
                        <style type="text/css">
                        @media screen and (max-device-width: 481px) {#cabeza_movil
                            {
                                background-image: url("http://www.pulzos.com/statics/img/mailPulzosCabeceraMovil.jpg");
                                background-repeat: no-repeat;
                                width: 320px;
                                height: 100px;
                                margin:auto;
                            }

                            #cabeza_desktop
                            { 
                                display:none;
                            }}
                        </style>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
						<div id="cuerpo_desktop" style="width: 765px">
							Hola <strong>' . $n1 . '</strong><br /><br />
							Bienvenido a Pulzos Rewards Network, la única plataforma que te da beneficios y 
							te paga por divertirte y recomendar tus sitios favoritos.<br /><br />
                            Ve ahora mismo a enlazar tus <a href="http://www.pulzos.com/">
                            Redes Sociales</a> en tu perfil de Pulzos para que puedas accesar de inmediato a todos los 
							beneficios que te ofrecemos.<br /><br />
							Cada día más empresas se unen a nuestro programa de recompensas, por lo que 
							no olvides comenzar a buscar nuestro logotipo cada vez que vayas a un restaurante, 
							bar, spa … ¡o lo que sea! y preguntar “¿tienes Pulzos?” y así no pierdas ninguna 
							oportunidad de ganar.<br /><br />
							La diversión no termina en la web, ve a la App Store (hiperlink a la liga de la App) 
							y descarga gratis Pulzos GeoTagging en tu Smartphone para que dejes tu huella por todo 
							el mundo y comiences a etiquetar tus lugares favoritos y te enteres al momento de todos 
                            los beneficios disponibles dondequiera que estés.<br /><br />
                            Tus datos para poder accesar a Pulzos.com son:<br />
                            Correo electronico: ' . $e1 . '<br />
                            Y en el siguiente link podrás reestablecer tu contraseña:<br />
                            <a href="' . $p1 . '">' . $p1 . ' </a>.<br /><br />
							Gracias por unirte a nuestra Comunidad,<br /><br />
							<strong>Equipo Pulzos Rewards Network.</strong>
                        </div>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="pie_movil" align="left">
                        </div>
						<div style="width: 765px; height: 80px" id="pie_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
					</body>
				</html>';
    return $message;
}

/**
 * Metodo que se usa para poder crear la plantilla de la
 * empresa con la cual al usuario se le notificara que le ha
 * llegado una bonificacion de pulzos de parte de la
 * empresa hacia el usuario
 *
 * @params string nombre de la empresa
 * @params string nombre del usuario
 * @params string folio/factura
 * @params float monto total
 * @params dloat monto bonificacion
 *
 * @return string email template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function bonificacion_email_negocio($n1, $n2, $f1, $mt, $mb)
{
    $message = '<html>
                    <meta name="viewport" content="width=320, initial-scale=1, user-scalable=no">
                    <head>
                        <link media="only screen and (min-device-width: 481px)" href="http://www.pulzos.com/statics/css/ext/emails/iOSDevice.css" type= "text/css" rel="stylesheet">
                    </head>
                    <body>
                        <div style="width: 765px; height: 80px" id="cabeza_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosCabecera.jpg" alt="Pulzos Rewards Network" />
                        </div>
                        <style type="text/css">
                        @media screen and (max-device-width: 481px) {#cabeza_movil
                            {
                                background-image: url("http://www.pulzos.com/statics/img/mailPulzosCabeceraMovil.jpg");
                                background-repeat: no-repeat;
                                width: 320px;
                                height: 100px;
                                margin:auto;
                            }

                            #cabeza_desktop
                            { 
                                display:none;
                            }}
                        </style>
                        <div id="cabeza_movil" align="left">
                        </div>
                        <style type="text/css">
                        @media screen and (max-device-width: 481px) {#cabeza_movil
                            {
                                background-image: url("http://www.pulzos.com/statics/img/mailPulzosCabeceraMovil.jpg");
                                background-repeat: no-repeat;
                                width: 320px;
                                height: 100px;
                                margin:auto;
                            }

                            #cabeza_desktop
                            { 
                                display:none;
                            }}
                        </style>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="cuerpo_desktop" style="width: 765px">
                            Hola <strong>' . $n1 . ',</strong><br /><br />
                            ' . $n2 . ' ha realizado una solicitud de bonificación con los siguientes datos:<br /><br />
                            Folio/Factura: ' . $f1 . '<br />
                            Monto Consumido: $ ' . $mt . ' MX<br />
                            Monto a bonificar: $ ' . $mb . ' MX<br /><br />
                            Para aceptar o rechazar la bonificacion que se desea realizar, entra a <a href="http://www.pulzos.com">
                            Pulzos Rewards Network</a>.<br /><br />
                            Gracias por unirte a nuestro Proyecto,<br /><br />
							<strong>Equipo Pulzos Rewards Network.</strong>
                        </div>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="pie_movil" align="left">
                        </div>
						<div style="width: 765px; height: 80px" id="pie_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
                    </body>
                </html>';
    return $message;
}

/**
 * Metodo que se usa para poder realizar la plantilla con la
 * cual los usuarios puedan notificar a la empresa una vez que 
 * estos hayan ingresado el folio de la factura para que el
 * negocio se de cuenta que ya le han realizado una bonificacion
 *
 * @params string nombre empresa
 * @params string nombre usuarios
 * @params string folio/factura
 * @params double monto total
 * @params double monto bonificacion
 *
 * @return string email template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function bonificacion_email_usuario($n1, $n2, $f1, $mt, $mb)
{
    $message = '<html>
                    <meta name="viewport" content="width=320, initial-scale=1, user-scalable=no">
                    <head>
                        <link media="only screen and (min-device-width: 481px)" href="http://www.pulzos.com/statics/css/ext/emails/iOSDevice.css" type= "text/css" rel="stylesheet">
                    </head>
                    <body>
                        <div style="width: 765px; height: 80px" id="cabeza_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosCabecera.jpg" alt="Pulzos Rewards Network" />
                        </div>
                        <style type="text/css">
                        @media screen and (max-device-width: 481px) {#cabeza_movil
                            {
                                background-image: url("http://www.pulzos.com/statics/img/mailPulzosCabeceraMovil.jpg");
                                background-repeat: no-repeat;
                                width: 320px;
                                height: 100px;
                                margin:auto;
                            }

                            #cabeza_desktop
                            { 
                                display:none;
                            }}
                        </style>
                        <div id="cabeza_movil" align="left">
                        </div>
                        <style type="text/css">
                        @media screen and (max-device-width: 481px) {#cabeza_movil
                            {
                                background-image: url("http://www.pulzos.com/statics/img/mailPulzosCabeceraMovil.jpg");
                                background-repeat: no-repeat;
                                width: 320px;
                                height: 100px;
                                margin:auto;
                            }

                            #cabeza_desktop
                            { 
                                display:none;
                            }}
                        </style>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="cuerpo_desktop" style="width: 765px">
                            Hola <strong>' . $n2 . ',</strong><br /><br />
                            ' . $n1 . ' te ha enviado una solicitud de bonificación con los siguientes datos:<br /><br />
                            Folio/Factura: ' . $f1 . '<br />
                            Monto Consumido: $ ' . $mt . ' MX<br />
                            Monto a bonificar: $ ' . $mb . ' MX<br /><br />
                            Para aceptar o rechazar la bonificacion que se desea realizar, entra a <a href="http://www.pulzos.com">
                            Pulzos Rewards Network</a>.<br /><br />
                            Gracias por unirte a nuestra Comunidad,<br /><br />
							<strong>Equipo Pulzos Rewards Network.</strong>
                        </div>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="pie_movil" align="left">
                        </div>
						<div style="width: 765px; height: 80px" id="pie_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
                    </body>
                </html>';
    return $message;
}

/**
 * Metodo que se usa para crear la plantilla de correos de email
 * para que el empleado sea notificado de que se ha enviado una
 * bonificacion al usuario que ellos han realizado para que
 * se den cuenta que ya tienen una probable ganancia
 *
 * @params string nombre del empleado
 * @params string nombre del usuario
 * @params string folio/factura
 * @params double monto total
 *
 * @return string email template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function bonificacion_email_empleado($n1, $n2, $f1, $mb)
{
    $message = '<html>
                    <meta name="viewport" content="width=320, initial-scale=1, user-scalable=no">
                    <head>
                        <link media="only screen and (min-device-width: 481px)" href="http://www.pulzos.com/statics/css/ext/emails/iOSDevice.css" type= "text/css" rel="stylesheet">
                    </head>
                    <body>
                        <div style="width: 765px; height: 80px" id="cabeza_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosCabecera.jpg" alt="Pulzos Rewards Network" />
                        </div>
                        <style type="text/css">
                        @media screen and (max-device-width: 481px) {#cabeza_movil
                            {
                                background-image: url("http://www.pulzos.com/statics/img/mailPulzosCabeceraMovil.jpg");
                                background-repeat: no-repeat;
                                width: 320px;
                                height: 100px;
                                margin:auto;
                            }

                            #cabeza_desktop
                            { 
                                display:none;
                            }}
                        </style>
                        <div id="cabeza_movil" align="left">
                        </div>
                        <style type="text/css">
                        @media screen and (max-device-width: 481px) {#cabeza_movil
                            {
                                background-image: url("http://www.pulzos.com/statics/img/mailPulzosCabeceraMovil.jpg");
                                background-repeat: no-repeat;
                                width: 320px;
                                height: 100px;
                                margin:auto;
                            }

                            #cabeza_desktop
                            { 
                                display:none;
                            }}
                        </style>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="cuerpo_desktop" style="width: 765px">
                            Hola <strong>' . $n1 . '</strong><br /><br />,
                            Se ha iniciado el trámite de una bonificación para el usuario ' . $n2 . ' con los siguientes datos:<br />
                            Folio/Factura: ' . $f1 . '<br />
                            Monto Consumido: ' . $mb . '<br /><br />
                            Queda pendiente la aceptación por parte del Cliente, para finalizar este movimiento.<br /><br />
                            Saludos Cordiales,<br /><br />
							<strong>Equipo Pulzos Rewards Network.</strong>
                        </div>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="pie_movil" align="left">
                        </div>
						<div style="width: 765px; height: 80px" id="pie_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
                    </body>
                </html>';
    return $message;
}

/**
 * Metodo que se usa para que se genere el codigo con el cual el 
 * negocio una vez que haya registrado al usuario por parte de la
 * aplicacion de escritorio, con esto recibira un codigo con el cual
 * el usuario podra resetear su password
 *
 * @params string email
 * @params string primer nombre
 *
 * @return string sha1 encode
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function generar_codigo($email, $nombre)
{
    $time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    return sha1($email.$nombre.$time);
}
