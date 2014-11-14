<?php
    session_start();
    require_once('funciones_procesos.php');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/screen.css" />
        <link rel="shortcut icon" href="http://www.pulzos.com/statics/img/pulzos.ico" />
        <title>
            Pulzos Administrador
        </title>
    </head>
    <body>
        <div class="container showgrid">
            <div class="prepend-10" style="margin-top: 100px; font-size: 16px; color: #53847F">
                Administrador
            </div>
            <div class="prepend-10 span-5" style="margin-top: 40px"><!-- INICIO DEL FORMULARIO -->
                <form name="forma_inicio" action="cotejamiento.php" method="post">
                    <div class="span-2" style="margin-top: 7px">
                        <label for="usuario">
                            Usuario:
                        </label>
                    </div>
                    <div class="span-3 last">
                        <input type="text" name="usuario" value="" />
                    </div>
                    <div class="span-2">
                        <label for="password">
                            Contrase&ntilde;a:
                        </label>
                    </div>
                    <div class="span-3 last">
                        <input type="password" name="pass" value="" />
                    </div>
                    <div class="prepend-2 last">
                        <input type="submit" name="enviar" value="Ingresar" />
                    </div>
                </form>
            </div><!-- FIN DEL FORMULARIO -->
        </div>
    </body>
</html>
