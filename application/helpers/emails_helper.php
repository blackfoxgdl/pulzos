<?php
/**
 * Helper que se usa para poder obtener todos los
 * formatos de los correos electronicos que se tengan por
 * el momento, solo se manda a llamar este helper, se usa
 * la plantilla que se tengan con ciertos parametros y se obtiene
 * toda la vista ya definida
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, Nov 29, 2011
 * @package Helpers
 **/

/**
 * Funcion para armar la plantilla que los usuarios podran visualizar
 * en cuanto otro haya comentado alguna geotagging que haya colocado,
 * esto para que los usuarios dueños del comentario principal conoscan que
 * se esta comentando la etiqueta y que es lo que se esta poniendo
 *
 * @params string nombre persona comentario principal
 * @params string nombre persona comento
 * @params string texto que comento
 * @params string texto que mandaron del comentario
 *
 * @return string plantilla email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function comment_geotagging($n1, $n2, $c1, $c2)
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
                        <div style="width: 765px" id="cuerpo_desktop">
                            Hola <strong>' . $n1 . '</strong>,<br /><br />
                            ' . $n2 . ' comento:<br /><br />
                                "' . $c2 . '"<br /><br />
                            En tu publicacion:<br /><br />
                                "' . $c1 . '" <br /><br />
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
 * Metodo que se usa para crear la plantilla de correos a los usuarios
 * que han comentado la publicacion principal de la geoetiqueta que
 * ha puesto algun usuarios de pulzos. Esto es para que se den cuenta que
 * hay un comentario en la geoetiqueta y se siga con la dinamica del
 * comentario
 *
 * @params string nombre persona comentario principal
 * @params string nombre persona que se le enviara el correo
 * @params string nombre de la persona que realizo el comentario
 * @params string texto que comento
 * @params string texto que mandaron del comentario
 *
 * @return string plantilla email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function comment_geotagging_secondary($n1, $n2, $n3, $c1, $c2)
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
                        <div style="width: 765px" id="cuerpo_desktop">
                            Hola <strong>' . $n3 . '</strong>,<br /><br />
                            ' . $n2 . ' comento:<br /><br />
                                "' . $c2 . '"<br /><br />
                            En la publicacion de ' . $n1 . ':<br /><br />
                                "' . $c1 . '" <br /><br />
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
 * Funcion util para poder obtener la plantilla que podra ser observada
 * por parte de la empresa la cual le notificara que ya un usuario ha
 * pasado la voz a sus redes sociales y asi la empresa se entere que
 * ya tiene tambien un pasa la voz menos antes de que la oferta caduque
 *
 * @params string nombre del negocio
 * @params string nombre usuario paso la voz
 * @params string texto de la promocion
 *
 * @return string plantilla a enviar
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function comment_pass_voice($n1, $n2, $c1)
{
	$message = '
							<div style="height: 60px; width: 800px; background-color: #511E59">
							<img src="http://www.pulzos.com/statics/img/logo-pulzos_demo.jpg" title="Pulzos" alt="Pulzos" />
							</div>
                
     						<div style=" width: 800px; background-color: #511E59;" align="center"> 
     
							<img src="http://www.pulzos.zavordigital.com/statics/img/mailTop1.jpg" width="706" height="14" style="margin:0px; float:left; margin-left:48px"/>              
							<div style=" background-color: #eeedf3; width:706px; margin-left:48px; float:left; ">
                                 <p align="justify">
                                    Hola<strong> ' . $n1 . ',</strong><br />' .
                   				 $n2 . ' ha pasado la voz a sus amigos en tu promocion.
                                                                 
                                  </p>
							</div>
							<img src="http://www.pulzos.zavordigital.com/statics/img/mailabajo1.jpg"  width="706" style="margin-left:2px; margin-top:0px; padding:0px; border:0px;"/> 
                   
    						</div> 
                            <div style="height: 60px; width: 800px; background-color: #511E59">               
               				<img  src="http://www.pulzos.zavordigital.com/statics/img/mailBottom.png"/>
                            </div>';			
    return $message;
}

/**
 * Funcion que se usa para saber o darle a conocer a la empresa que
 * un usuario ha hecho o a realizado una bonificacion de alguna de las
 * promociones que ha hecho el mismo y que los usuarios han aprovechado,
 * este correo sera para que pueda realizar o completar la bonificacion el 
 * usuario
 *
 * @params string nombre de la empresa
 * @params string nombre del usuario
 * @params string folio/factura
 * @params float monto total
 * @params float monto bonificacion
 *
 * @return string template de emial
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function bonification_email_template($n1, $n2, $f1, $mt, $mb)
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
                            ' . $n2 . ' ha realizado una solicitud de bonificacion con los siguientes datos:<br /><br />
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
 * Helper que se usa para poder realizar el template del correo electronico
 * que se mandara al usuario una vez que se haya realizado la bonificacion por parte
 * del negocio hacia el usuario con el cual se daran cuenta los usuarios si realmente
 * se envio correctamente el folio y la cantidad consumida para que se pueda
 * conocer la informacion de la bonificacion
 *
 * @params
 **/
function bonification_email_template_user($n1, $n2, $f1, $mt, $mb)
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
                            ' . $n2 . ' te ha enviado una solicitud de bonificación con los siguientes datos:<br /><br />
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
 * Funcion que se usa para conocer que un usuario ha mandado un inbox a
 * algun amigo o a alguna empresa que sigue, con este se creara la plantilla
 * que veran las personas que reciben el inbox y el email en donde se vera una
 * notificacion que se tiene.
 *
 * @params string nombre de usuario recibe
 * @params string nombre de usuario envia
 * @params string inbox del mensaje
 *
 * @return string template de email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function create_inbox_email($n1, $n2, $c1)
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
                        <div id="cabeza_desktop" style="width: 765px">
                            Hola <strong>' . $n1 . '</strong>,<br /><br />
                            Has recibido un nuevo mensaje de ' . $n2 . ' en Pulzos Rewards Network.<br /><br />
                            Sigue el siguiente <a href="http://www.pulzos.com/">enlace</a> para que puedas revisarlo.<br /><br />
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
 * Funcion que se usara para poder dar a conocer al usuario o a la empresa la respuesta
 * que ha generado algun usuario a algun inbox que se le haya mandado, esto para que
 * lo puedan ver por parte de la empresa en su email, es una notificacion que se le
 * hara por si no esta en su cuenta pueda checarlo ingresando a la misma
 *
 * @params string nombre recibe
 * @params string nombre envia
 * @params string mensaje enviado
 *
 * @return string template para email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function response_inbox_email($n1, $n2, $c1)
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
                        <div style="width: 765px" id="cuerpo_desktop">
							Hola <strong>' . $n1 . ',</strong><br /><br />
                            Has recibido un nuevo mensaje de ' . $n2 . ' en Pulzos Rewards Network.<br /><br />
							Sigue el siguiente <a href="http://www.pulzos.com">enlace</a> para que puedas revisarlo.<br /><br />
							Saludos Cordiales,<br /><br />
							<strong>Equipo Pulzos Rewards Network</strong>.
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
				</htm>';
    return $message;
}

/**
 * Funcion que se usa para poder realizar la notificacion por medio de correo electronico
 * en la cual se declina o se acepta la bonificacion que esta realizando el usuario en 
 * cuanto a una promocion que haya hecho la empresa, asi le avisara al usuario si fue aceptada
 * o fue rechazada
 *
 * @params string nombre recibe email
 * @params string nombre envia email
 * @params string mensaje a enviar
 *
 * @return string template de email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function response_bonification_company($n1, $n2)
{
	$message = '<html>
					<head>
					</head>
					<body>
						<div style="width: 765px; height: 80px">
							<img src="http://www.pulzos.com/statics/img/mailPulzosCabecera.jpg" alt="Pulzos Rewards Network" />
						</div>
						<div style="width: 765px">
							Hola<strong> ' . $n1 . ',</strong><br /><br />' .
                   			 $n2 . ' te ha enviado un mensaje acerca de la solicitud de 
                   			 bonificacion que has solicitado.
						</div>
						<div style="width: 765px; height: 80px">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
					</body>
				</html>';
    return $message;
}

/**
 * Metodo que se usa para poder notificar al usuario en que tiene una solicitud de amistad de
 * algun otro usuario que quiere compartir con ellos la parte de sus muros y tener en 
 * general una amistad y ser amigos y noc que mas decir
 *
 * @params string nombre
 * @params string nombre
 *
 * @return string template email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function email_friends($n1, $n2)
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
                            Hola <strong>' . $n2 . '</strong>,<br /><br />
                            ' . $n1 . ' quiere ser tu amigo.<br /><br />
                            Para acetar o rechazar la solicitud entra a <a href="http://www.pulzos.com">
                            Pulzos Rewards Network
                            </a>.<br /><br />
                            Saludos Cordiales,
        					<br /><br />
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
 * Metodo que se usa para poder enviar la plantilla al correo
 * electronico que se enviara al usuario que se registro como
 * nuevo, esto desde el movil, en el cual se le explicara que
 * es lo que puede hacer en pulzos, los beneficios que tiene por
 * el momento
 *
 * @params string nombre del usuario
 * @return string template a enviar por email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function email_welcome($n1, $id)
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
                            Ve ahora mismo a enlazar tus <a href="http://www.pulzos.com/inicio.php/redessociales/redes_sociales_usuarios/"' . $id . '">
                            Redes Sociales</a> en tu perfil de Pulzos para que puedas accesar de inmediato a todos los 
							beneficios que te ofrecemos.<br /><br />
							Cada dia mas empresas se unen a nuestro programa de recompensas, por lo que 
							no olvides comenzar a buscar nuestro logotipo cada vez que vayas a un restaurante, 
							bar, spa … ¡o lo que sea! y preguntar “¿tienes Pulzos?” y asi no pierdas ninguna 
							oportunidad de ganar.<br /><br />
							La diversion no termina en la web, ve a la App Store (hiperlink a la liga de la App) 
							y descarga gratis Pulzos GeoTagging en tu Smartphone para que dejes tu huella por todo 
							el mundo y comiences a etiquetar tus lugares favoritos y te enteres al momento de todos 
							los beneficios disponibles dondequiera que estes.<br /><br />
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
 * Helper util para crear las plantillas de email en cuanto a la bienvenida
 * pero esta vez de la empresa, con la cual una vez que se registren les llegaran
 * los correos para que los mismos sepan de que trata la red socila de pulzos, en
 * caso de que ya conoscan, solo es una cortesia o un buen gesto que se les da a los
 * usuarios
 *
 * @params string nombre del negocio
 * @return string email template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function email_welcome_company($n1)
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
                            Bienvenido al programa Empresarial de Pulzos Rewards Network, la mejor herramienta en linea para promover tu Negocio 
                            y recibir micropagos electronicos.<br /><br />
                            Muy pronto recibiras en tu correo el contrato para inscribirte al Programa de Bonificaciones Pulzos. 
                            Es necesario que lo regreses por paqueteria, debidamente completado y firmado, junto con una copia de la credencial de elector 
                            del representante legal, a la siguiente direccion:<br /><br />
                            Zavordigital<br />
                            Juan Ruiz de Alarcon #123 <br />
                            Col. Lafayette<br />
                            CP 44160<br />
                            Guadalajara, Jalisco. Mexico<br /><br />
                            Una vez recibido y verificado, procederemos a la activacion de tu cuenta.<br /><br />
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
 * Helper que crea la plantilla del email que se le enviara al usuario propietario de 
 * pulzos con los cuales se tendran que enviar el correo electronico con los formatos y asi
 * poder habilitar la cuenta del cliente para que el mismo pueda comenzar a públicar todas
 * las ofertas que desee
 *
 * @params string name of company
 * @return string email template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function email_company_pulzos($n1, $e1, $d1, $d2)
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
                                Hola <strong>Administrador de Pulzos</strong>,<br /><br />
                                Se ha registrado una nueva empresa en el programa de Pulzos Rewards Network.<br /><br />
                                Los datos de la empresa son:<br />
                                Nombre: ' . $n1 . '<br />
                                Email : ' . $e1 . '<br />
                                Direccion: ' . $d1 . '<br />
                                Descripcion: ' . $d2 . '<br /><br />
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
 * Metodo que se usa para poder realizar la plantilla que se mostrara una vez que
 * el usuario haya comentado en alguna publicacion de un usuario en la cual este mismo
 * se podra enterar de quien es el usuario que comento y que fue lo que puso
 * una vez que este ya haya comentado, para que se de una idea de que es lo que
 * le estan diciendo en cierto comentario
 *
 * @params string nombre usuario envio
 * @params string nombre usuario comenta
 * @params string comentario hecho
 *
 * @return string template email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_comment_wall_email($n1, $n2, $c1)
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
                        <div id="cabeza_movil">
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
                            <div style="width: 765px" id="cuerpo_desktop">
							Hola <strong>' . $n1 . ',</strong><br /><br />
							' . $n2 . ' ha comentado en tu publicacion de Pulzos Rewards Network.<br /><br />
							Saludos Cordiales,<br /><br />
							<strong>Equipo Pulzos Rewards Network.</strong>
                        </div>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="pie_movil">
                        </div>
						<div style="width: 765px; height: 80px" id="pie_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
					</body>
				</html>';	
    return $message;
}

/**
 * Helper que se usa para poder mostrar que se han comentado
 * una publicacion pero que ese comentario ha sido un usuario 
 * diferente al dueño de la publicacion principal, esto es que 
 * se mostrara que otro usuario ha escrito y se les notifica por medio
 * de un correo electronico
 *
 * @params string nombre usuario principal
 * @params string nombre usuario comento
 * @params string nombre usuario a comentar
 *
 * @return string email template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_comment_wall_email_users($n1, $n2, $n3)
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
                        <div id="cabeza_movil">
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
                            <div style="width: 765px" id="cuerpo_desktop">
							Hola <strong>' . $n1 . ',</strong><br /><br />
							' . $n2 . ' ha comentado en tu publicacion de ' . $n3 . ' en Pulzos Rewards Network.<br /><br />
							Saludos Cordiales,<br /><br />
							<strong>Equipo Pulzos Rewards Network.</strong>
                        </div>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="pie_movil">
                        </div>
						<div style="width: 765px; height: 80px" id="pie_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
					</body>
				</html>';	
    return $message;
}

/**
 * Helper que se usa para crear la plantilla de envio de correo electronico en las cuales
 * los usuarios se daran cuenta de que el usuario de la publicacion principal ha comentado
 * en su misma publicacion, si hay mas de uno y es diferente al mismo entonces recibira
 * este formato de correo, con el cual se le notificara la accion que se realizo
 *
 * @params string nombre de usuario principal
 * @params string nombre de usuario secundario
 *
 * @return string template email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_comment_wall_email_mine($n1, $n2)
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
                        <div id="cabeza_movil">
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
                            <div style="width: 765px" id="cuerpo_desktop">
							Hola <strong>' . $n1 . ',</strong><br /><br />
							' . $n2 . ' ha comentado en su publicacion de Pulzos Rewards Network.<br /><br />
							Saludos Cordiales,<br /><br />
							<strong>Equipo Pulzos Rewards Network.</strong>
                        </div>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="pie_movil">
                        </div>
						<div style="width: 765px; height: 80px" id="pie_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
					</body>
				</html>';	
    return $message;
}

/**
 * Metodo que se usa para poder enviar los correos electronicos con
 * los cuales los usuarios puedan conocer que alguien se ha apuntado a su
 * comentario, asi saber que si les interesa o les ha gustado a tus
 * amigos
 *
 * @params string nombre usuario plan
 * @params string nombre usuario apunta
 * @params string comentario al que se apuntan
 * @params string plan al que se apunto
 *
 * @return string template email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_email_point_comment($n1, $n2, $c1, $idP)
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
						<div style="width: 765px" id="cuerpo_desktop">
							Hola <strong>' . $n1 . '</strong>,<br /><br />
							' . $n2 . ' se ha apuntado a tu comentario:<br /><br />
							<center>
								“<a href="http://www.pulzos.com/inicio.php/comentados/index/'.$idP.'" style="text-decoration: none; color: #511E59"><p>" '.$c1.'"</p></a>”
							</center><br /><br />
							Saludos Cordiales,<br /><br />
							<strong>Equipo Pulzos Rewards Network.</strong>
                        </div>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="pie_movil">
                        </div>
						<div style="height: 80px; width: 765px" id="pie_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
					</body>
				</html>';
    return $message;
}

/**
 * Metodo que se usa para mandar correos a los usuarios que se han apuntado
 * al comentario que ha hecho el usuario, con este le llegaran los correos
 * a todos los usuarios que se han apuntado antes del usuario que se acaba
 * de apuntar, esto para notificarles que se han apuntado a una publicacion
 *
 * @params string nombre del usuario que ya se ha apuntado
 * @params string nombre de usuario apuntado 
 * @params string nombre de usuario publicante
 * @params string comentario a apuntarse
 * @params int id del plan
 *
 * @return string message email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_email_point_comment_users($n1, $n2, $n3, $c1, $idP)
{		
	$message = '<html>
					<meta name="viewport" content="width=320, initial-scale=1, user-scalable=no">
                    <head>
                        <link media="only screen and (min-device-width: 481px)" href="http://www.pulzos.com/statics/css/ext/emails/iOSDevice.css" type= "text/css" rel="stylesheet">
					</head>
					<body>
						<div style="width: 765px;" id="cabeza_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosCabecera.jpg" alt="Pulzos Rewards Network" />
                        </div>
                        <div id="cabeza_movil">
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
						<div style="width: 765px" id="cuerpo_desktop">
							Hola <strong>' . $n1 . '</strong>,<br /><br />
							' . $n2 . ' se ha apuntado al comentario de ' . $n3 . ':<br /><br />
							<center>
								“<a href="http://www.pulzos.com/inicio.php/comentados/index/'.$idP.'" style="text-decoration: none; color: #511E59"><p>" '.$c1.'"</p></a>”
							</center><br /><br />
							Saludos Cordiales,<br /><br />
							<strong>Equipo Pulzos Rewards Network.</strong>
                        </div>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div id="pie_movil">
                        </div>
						<div style="height: 80px; width: 765px" id="pie_desktop">
							<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
						</div>
					</body>
				</html>';
    return $message;
}


/**
 * Metodo que se encarga de crear la plantilla del email
 * que se enviara al usuario que ha enviado un saludo a otro con
 * la intencion de que este vea cuando un usuario ha estado visitando
 * su perfil o le interesa saber mas sobre el mismo
 *
 * @params string nombre usuario a enviar
 * @params string nombre usuario a recibir
 *
 * @return string email template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_hello_email_template()
{
    $message = '<html>
    				<head>
    				</head>
    				<body>
    					<div style="height: 80px; width: 765px">
    						<img src="http://www.pulzos.com/statics/img/mailPulzosCabecera.jpg" alt="Pulzos Rewards Network" />
    					</div>
    					<div style="width: 765px">
    						
    					</div>
    					<div style="height: 80px; width: 765px">
    						<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
    					</div>
    				</body>
    			</html>';
    return $message;
}

/**
 * Metodo que se usa para crear la plantilla del correo que se enviara
 * para confirmar la cuenta de correo electronico que se acaba de crear
 * por medio de la pagina web, la cual se tiene que crear un codigo que se
 * necesita colocar por parte del negocio para el usuario y que este al dar
 * click pueda activarse la cuenta y pueda accesar a pulzos.
 *
 * @params
 *
 * @return string email template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_email_template_confirmation($n1, $link)
{
	$message='
							<div style="height: 60px; width: 800px; background-color: #511E59">
							<img src="http://www.pulzos.com/statics/img/mailPulzosCabecera.jpg" title="Pulzos" alt="Pulzos" />
							</div>
                
     						<div style=" width: 800px; background-color: #511E59;" align="center"> 
     
							<img src="http://www.pulzos.zavordigital.com/statics/img/mailTop1.jpg" width="706" height="14" style="margin:0px; float:left; margin-left:48px"/>              
							<div style=" background-color: #eeedf3; width:706px; margin-left:48px; float:left; ">
                                 <p align="justify">
                                     Hola<strong> ' . $n1 . ',</strong><br />
							Es necesario que confirmes tu cuenta en Pulzos mediante el siguiente enlace: <br />
							<a href="">url a indicar</a>.<br /><br />
                            Una vez realizado esto, tendras acceso a Pulzos y recibiras todas las notificaciones a este correo electronico.<br />
							<strong>El equipo de Pulzos</strong><br /><br />
							*Si recibiste este correo por error y no has creado ninguna cuenta en Pulzos entra <a href="http://www.pulzos.com" style="text-decoration: none; color: #511E59">aquí</a>.<br />
							Por favor no respondas a este mensaje ya que fue generado automaticamente y fue enviado en relacion con la nueva apertura de tu cuenta.<br />
							Si requieres de mayor informacion puedes visitarnos en Soporte de Pulzos.
                                                         
                                  </p>
							</div>
							<img src="http://www.pulzos.zavordigital.com/statics/img/mailabajo1.jpg"  width="706" style="margin-left:2px; margin-top:0px; padding:0px; border:0px;"/> 
                   
    						</div> 
                            <div style="height: 60px; width: 800px; background-color: #511E59">               
               				<img  src="http://www.pulzos.zavordigital.com/statics/img/mailPulzosPie.jpg"/>
                            </div>
	';			
    return $message;
}

/**
 * Metodo que se usara para el formato del correo de olvido de contraseña 
 * para que el usuario pueda solicitarla y que este pueda recuperarla sin la necesidad
 * de crear otra cuenta, solo te mandaremos un link donde ellos podran resetear su
 * contraseña
 *
 * @params string nombre de usuario
 * @params string link a presionar
 * @params int id del usuario
 *
 * @return string email tamplate 
 * @author 
 **/
function get_password_email($n1,$link, $id)
{
    $message='<htm>
              <meta name="viewport" content="width=320, initial-scale=1, user-scalable=no">
              <head>
                <link media="only screen and (min-device-width: 481px)" href="http://www.pulzos.com/statics/css/ext/emails/iOSDevice.css" type= "text/css" rel="stylesheet">
			  </head>
			  <body>
			  	<div style="height: 80px; width: 770px;" id="cabeza_desktop">
					<img src="http://www.pulzos.com/statics/img/mailPulzosCabecera.jpg" title="Pulzos" alt="Pulzos" />
                </div>
                <div id="cabeza_movil">
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
                <div style="width: 765px;" align="left" id="cuerpo_desktop">
                	Hola <strong>' . $n1 . '</strong><br /><br />,
                	Has solicitado el restablecimiento de tu contraseña en Pulzos Rewards Network. 
                	Para llevarlo a cabo sigue el siguiente enlace:<br /><br />
                	<a href="http://www.pulzos.com/inicio.php/usuarios/recuperar_password/'.$id.'/'.$link.'" style="text-decoration: none">
                		Recuperar Password
                	</a>.<br /><br />
                	Si no has solicitado el cambio de tu contrase&ntilde;a, haz caso omiso de este correo y desechalo por favor.<br /><br />
					Saludos Cordiales,<br /><br />
					<strong>Equipo Pulzos Rewards Network</strong>.<br /><br />
					*Si recibiste este correo por error y aun no tienes tu cuenta, entra <a href="http://www.pulzos.com" style="text-decoration: none">aqui</a>.
                </div>
                <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                </style>
                <div id="pie_movil">
                </div>
                <div style="height: 80px; width: 770px;" id="pie_desktop">
                	<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" />
                </div>
			 </body>
			 </htm>';
	return $message;		
}


/**
 * Helper del formato del correo que se usa para que el usuario
 * pueda recibir un correo el cual sera el que se necesite para
 * cuando este solicite la trasferencia de dinero por medio de 
 * su llave clabe, esto para que los usuarios conoscan el proceso
 * que se llevara una vez que el usuario haga este paso
 *
 * @params string nombre del usuario
 * @params double valor del usuario
 *
 * @return string template email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
 function email_retire_money($str, $total)
 {
    $message = '<html>
                <meta name="viewport" content="width=320, initial-scale=1, user-scalable=no">
                <head>
                    <link media="only screen and (min-device-width: 481px)" href="http://www.pulzos.com/statics/css/ext/emails/iOSDevice.css" type= "text/css" rel="stylesheet">
                </head>
                <body>
                <div style="height: 80px; width; 765px;" id="cabeza_desktop">
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
 				<div class="width: 765px" id="cuerpo_desktop">
 					Hola <strong>' . $str . '</strong>,<br /><br />
 					Has solicitado el retiro de <strong>$ ' . $total . '</strong> de tu cuenta en Pulzos Rewards Network. 
 					Te recordamos que se cobrará una comision de $15.00 por dicho movimiento, la cual 
 					se descontara del monto total de tu retiro.
 					<br /><br />
					En un maximo de 7 dias habiles veras el deposito reflejado en tu cuenta bancaria, 
					siempre y cuando todos los datos alimentados en tu informacion sean correctos.
					<br /><br />
					Saludos Cordiales,
					<br /><br />
					<strong>Equipo Pulzos Rewards Network.</strong>
                </div>
                <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                </style>
                <div id="pie_movil" align="left">
                </div>
 				<div style="height: 110px; width: 765px" id="pie_desktop">
 					<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
                </div>
                </body>
                </html>';
	return $message;
 }
 
/**
 * Helper que se usa para poder notificar al administrador de los transfer
 * los cuales los debe de realizar una vez que el usuario haya hecho el
 * proceso necesario con el cual se podra realizar la trasnferencia pues se pasan
 * ciertos datos de los usuarios
 *
 * @params string name
 * @params double total
 * @params string another name
 * @params string clabe
 * @params string banco
 *
 * @return string template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
  function email_notification_admin($name, $total, $name_trans, $clabe, $banco)
  {
    $total_depo = $total - 15;
    $message = '<html>
                <meta name="viewport" content="width=320, initial-scale=1, user-scalable=no">
                <head>
                    <link media="only screen and (min-device-width: 481px)" href="http://www.pulzos.com/statics/css/ext/emails/iOSDevice.css" type= "text/css" rel="stylesheet"> 
                </head>
                <body>
                <div style="height: 80px; width; 765px;" id="cabeza_desktop">
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
 				<div class="width: 765px" id="cuerpo_desktop">
 					Hola Administrador de Pulzos<br /><br />
 					El usuario ' . $name . ' ha solicitado un retiro de su cuenta en Pulzos Rewards
                    Network. No olvides cobrar la comision de $ 15.00 por dicho movimiento.<br /><br />
 					Nombre Usuario: ' . $name_trans . '<br /> '.
                    'No. CLABE: ' . $clabe . '<br />' .
                    'Monto: $' . $total_depo . 'MX (- $15.00 pesos)<br />' .
 					'Banco:' . $banco . '
					<br /><br />
					Saludos Cordiales,
					<br /><br />
					Equipo Pulzos Rewards Network.
                </div>
                <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                </style>
                <div id="pie_movil" align="left">
                </div>
 				<div style="height: 110px; width: 765px" id="pie_desktop">
 					<img src="http://www.pulzos.com/statics/img/mailPulzosPie.jpg" alt="" />
                </div>
                </body>
                </html>';
    return $message;
  }

/**
 * Helper de la plantilla de email con la cual se llenaran los datos
 * o se enviaran los datos a los usuarios con los cuales se les dara a 
 * conocer que la transaccion del usuario ha sido correctamente hecha
 * y con este template el usuario conocera que si se realizo la transaccion
 *
 * @params string username
 * @params string company name
 * @params double monto
 *
 * @return string template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function email_transaction_user_accept($n1, $c1, $p1)
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
                                }
                            }
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
                                }
                            }
                        </style>
                        <style type="text/css">
                            @media screen and (max-device-width: 481px) {#cuerpo_desktop { width: 320px; }}
                        </style>
                        <div style="width: 765px" id="cuerpo_desktop">
                            Hola <strong>' . $n1 . '</strong>,<br /><br />
                            Tu transferencia al pago que se realizo al negocio ' . $c1 . '  por un monto
                            total de $' . $p1 . ' MX se ha realizado exitosamente.
                            <br /><br />
        					Saludos Cordiales,
		        			<br /><br />
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
 * Helper de plantilla de email que se usa para que el negocio
 * pueda ser notificado por parte de la plataforma pulzos acerca
 * de que ha recibido una transaccion de parte de un usuario por
 * cierta cantidad, esta cantidad despues sera depositada por la
 * plataforma internacional pulzos
 *
 * @params string nombre de la empresa
 * @params string nombre del usuario
 * @params double cantidad transferida
 *
 * @return string message array
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function email_transaction_company_accept($c1, $n1, $p1)
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
                        <div style="width: 765px" id="cuerpo_desktop">
                            Hola <strong>' . $c1 . '</strong>,<br /><br />
                            El usuario ' . $n1 . ' ha realizado una transaccion con exito a tu negocio por la 
                            cantidad de $' . $p1 . ' MX como pago de un servicio.<br /><br />
                            Saludos Cordiales,
		        			<br /><br />
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
 * Helper de la plantilla de los correos electronicos para los negocios
 * con los cuales se les dara a conocer a la empresa o al usuario que
 * se ha aceptado la bonificacion y ya se ha posteado el mensaje en su
 * red social, este mensaje es el que la empresa coloca para las bonificaciones
 * que postearan los usuarios en sus walls
 *
 * @params string company name
 * @params string user name
 * @params string folio/factura
 * @params double monto total
 * @params souble monto bonificacion
 *
 * @return string template email
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function notificate_user_to_company($c1, $c2, $f1, $mt, $mb)
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
                        <div style="width: 765px" id="cuerpo_desktop">
                            Hola <strong>' . $c1 . '</strong>,<br /><br />
                            El usuario ' . $c2 . ' acepto la bonificacion realizada con los siguientes datos:<br />
                            Folio/Factura: ' . $f1 . '<br />
                            Monto Consumido: ' . $mt . '<br />
                            Monto a Bonificar: ' . $mb . '<br /><br />
                            Por lo que ya se han transmitido exitosamente en sus redes sociales los mensajes correspondientes.<br /><br />
                            Es muy importante que se realice oportunamente el deposito que corresponda al  periodo, para evitar 
                            una afectacion al usuario o, en su defecto, una apreciacion negativa de su parte.<br /><br />
                            Saludos Cordiales,
		        			<br /><br />
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
 * Helper de la plantilla de los correos electronicos para los empleados
 * con los cuales se les dara a conocer a la empresa o al usuario que
 * se ha aceptado la bonificacion y ya se ha posteado el mensaje en
 * su red social. Este solamente es para el empleado por parte del
 * usuario que acepta la bonificacion
 **/
function notificate_user_to_employee()
{
    /*$message = '<html>
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
                        <div style="width: 765px" id="cuerpo_desktop">
                            Hola <strong>' . $c1 . '</strong>,<br /><br />
                            El usuario ' . $c2 . ' aceptó la bonificación realizada con los siguientes datos:<br />
                            Folio/Factura: ' . $f1 . '<br />
                            Monto Consumido: ' . $mt . '<br />
                            Monto a Bonificar: ' . $mb . '<br /><br />
                            Por lo que ya se han transmitido exitósamente en sus redes sociales los mensajes correspondientes.<br /><br />
                            Es muy importante que se realice oportunamente el depósito que corresponda al  período, para evitar 
                            una afectación al usuario o, en su defecto, una apreciación negativa de su parte.<br /><br />
                            Saludos Cordiales,
		        			<br /><br />
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
                        return $message;*/
}


/**
 * Helper que se usa para crear la plantilla del usuario para
 * que la empresa le notifique que se ha hecho la aceptacion de
 * la bonificacion correctamente con la cual el usuario podra
 * ya ver reflejado su dinero como pendiente de deposito
 * en la parte de su cartera
 *
 * @params string username
 * @params string company name
 * @params string folio/factura
 * @params double monto total
 * @params double monto bonificacion
 *
 * @return string email template
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function notificate_company_to_user($c1, $c2, $f1, $mt, $mb)
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
                        <div style="width: 765px" id="cuerpo_desktop">
                            Hola <strong>' . $c1 . '</strong>,<br /><br />
                            ' . $c2 . ' acepto tu bonificacion solicitada con los siguientes datos:<br />
                            Folio/Factura: ' . $f1 . '<br />
                            Monto Consumido: ' . $mt . '<br />
                            Monto a Bonificar: ' . $mb . '<br /><br />
                            Muy pronto veras reflejada la cantidad correspondiente en “Mi Cartera/Movimientos” dentro de tu 
                            cuenta en Pulzos.com.<br /><br />
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
