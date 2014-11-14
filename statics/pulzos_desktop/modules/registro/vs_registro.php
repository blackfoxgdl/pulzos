<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro</title>
</head>

<body>

<script type="text/javascript">
$("input:submit").button();
    $('form :input[type=text]').blur(function(){
            $(this).hbInput(); 
    });
</script>
    <div style="margin-top: 6%;margin-bottom: 5%;">
        <form id="frmRegistro" method="post" action="modules/registro/registro.php" onsubmit="frmRgstro(event, id)" >
            <p>&nbsp;</p>
            <p>

                <div class="div-input redondeo"><input type="text" name="registro[nombre]" style="background-color: transparent;" placeholder="Nombre:" id="nombre" /></div>
            </p>
            <p>

            <div class="div-input redondeo">  <input type="text" name="registro[apellido]" placeholder="Apellido:" id="apellido" /></div>
            </p>
            <p>

            <div class="div-input redondeo"><input type="text" name="registro[correo]" placeholder="Correo Electronico:" id="correo" onblur="chkMailLog();"  /></div>
            </p>
            <p>
                <div class="div-input redondeo"><input type="password" name="registro[pass]" placeholder="Contraseña:" id="pass" /></div>
            </p>
            <p style="margin-top:50px">

            <select id="dia" name="registro[dia]" style="height:25px;width:65px">
                <option value="">&nbsp;Día&nbsp;</option>
                <?php for ($i = 1; $i <= 31 ; $i++) { ?>
                <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                <?php } ?>
            </select>

                <?php
            // defaults
            $meses = array(
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Setiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
            );
            ?>
            <select id="mes" name="registro[mes]" style="height:25px;width:65px">
                <option value="">Mes</option>
                <?php
                $to = count($meses);
                $i = 0;

                foreach($meses as $key => $mes)
                {
                $i = $i+1;
                ?>
                <option value="<?php echo $key;?>" ><?php echo $mes; ?></option>
                <?php
                }
                ?>
            </select>

            <select id="ano" name="registro[ano]" style="height:25px">
                <option value="">&nbsp;&nbsp; Año &nbsp;&nbsp;</option>
                <?php for ($i = 1997; $i >= 1905 ; $i--) { ?>
                <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                <?php } ?>
            </select>
            </p>
            <p><p>&nbsp;</p>
                <input type="submit" name="button" id="button" value="Registrar" />
            </p>

        </form>
    </div>
<!--<a id="twtter" href="http://www.pulzos.com/inicio.php/redessociales/get_twitter_tokens_bonficacionU" target="_contenido">Activa tu red social</a>-->
</body>
</html>