<?php
    $ruta = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    //echo $ruta;
?>
<html>
    <head></head>
    <body>
        <form action="redireccion.php" method="post" name="forma">
            <label>
                Cantidad a pagar:                
            </label>
            <input type="text" name="dinero" />
            <input type="hidden" name="url" value="<?php echo $ruta; ?>" />
            <input type="submit" value="enviar" />
        </form> 
    </body>
</html>
