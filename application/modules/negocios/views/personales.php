<?php
/**
 * Vista para la muestra de datos personales
 * que podran ser visualizados por el usuario
 **/
?>
<div class="span-14 last" style="margin-left: 20px">
    <div class="span-13 last bgColor" id="tabs" style="margin-top: 30px">
        <div class="span-10"><!-- INICIO DEL TITULO **INICIO** -->
            <div class="span-13 fondosEP">
                <font class="titulosEP">
                    Datos del Negocio
                </font>
            </div>
        </div><!-- INICIO DEL TITULO **FIN** -->
        <div class="span-12 last letrasColor">
            <?php echo $personales->negocioNombre; ?>
            <br />
            <?php echo $personales->negocioDireccion; ?>
            <br />
            <?php if(!empty($personales->negocioTelefono)): ?>
                <?php echo $personales->negocioTelefono; ?>
                <br />
            <?php endif; ?>
            <?php if($personales->negocioPais != '0' || $personales->negocioCiudad != '0'): ?>
                <?php echo $ciudades->nombre . ", " . $paises->nombre; ?>
                <br />
            <?php endif; ?>
            <?php $return_value = http_request($personales->negocioSitioWeb); ?>
            <?php if($return_value == true): ?>
                <?php echo anchor($personales->negocioSitioWeb,
                                  $personales->negocioSitioWeb,
                                  array('style'=>'text-decoration: none', 'target'=>'_blank')); ?>
            <?php else: ?>
                <?php echo anchor('http://'.$personales->negocioSitioWeb,
                                  $personales->negocioSitioWeb,
                                  array('style'=>'text-decoration: none', 'target'=>'_blank')); ?>
            <?php endif; ?>
            <br />
            <br />
            <?php echo $personales->negocioDescripcion; ?>
            <br />
        </div>
        <br />
        <div class="span-10"><!-- INICIO DEL TITULO **INICIO** -->
            <div class="span-13 fondosEP">
            </div>
        </div><!-- INICIO DEL TITULO **FIN** -->
   </div>
</div>
