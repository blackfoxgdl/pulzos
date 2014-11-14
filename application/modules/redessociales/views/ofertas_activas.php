<?php
/**
 * Vista que se usa para poder guardar o para
 * poder visualizar las ofertas que se tienen
 * activas por parte de la empresa, esto solamente
 * se observara si estas logueado como empresa
 **/
?>
<script type="text/javascript">
$(".eliminar-ofertas").click(function(event){
    event.preventDefault();
    urlEliminarOfertas = $(event.currentTarget).attr('href');
    //alert(urlEliminarOfertas);
    $.get(urlEliminarOfertas);
    $(event.currentTarget).parent().parent().hide();
});
</script>
<div class="span-14 last">
    <?php if(!empty($informacion)): ?><!-- IF PARA CONOCER SI ESTA VACIA O NO **INICIO** -->
        <?php $i = 1; ?>
        <?php foreach($informacion as $datos_ofertas): ?>
            <?php $mensajes = get_social_messages($datos_ofertas->idMensajeOferta); ?>
            <div class="span-13" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid #7F7D7D"><!-- DIV PRINCIPAL DEL CUERPO **INICIO** -->
                <div class="span-12 last">
                    Oferta <?php echo $i; ?>
                </div>
                <div class="span-12 last">
                    <div class="span-4">
                        <?php echo form_label('Mensaje en Facebook: ', 'mensajeFacebook', array('style'=>'color: #660066')); ?>
                    </div>
                    <div class="span-7 last" style="color: #7F7D7D">
                        <?php echo $mensajes->mensajeFacebook; ?>
                    </div>
                </div>
                <div class="span-12 last">
                    <div class="span-4">
                        <?php echo form_label('Mensaje en Twitter: ', 'mensajeTwitter', array('style'=>'color: #660066')); ?>
                    </div>
                    <div class="span-7 last" style="color: #7F7D7D">
                        <?php echo $mensajes->mensajeTwitter; ?>
                    </div>
                </div>
                <div class="span-12 last">
                    <div class="span-4">
                        <?php echo form_label('Mensaje en Pulzos: ', 'mensajePulzos', array('style'=>'color: #660066')); ?>
                    </div>
                    <div class="span-7 last" style="color: #7F7D7D">
                        <?php echo $mensajes->mensajePulzos; ?>
                    </div>
                </div>
                <div class="span-12 last">
                    <div class="span-4">
                        <?php echo form_label('Consumo minimo: ', 'consumoMinimo', array('style'=>'color: #660066')); ?>
                    </div>
                    <div class="span-7 last" style="color: #7F7D7D">
                        <?php echo "$" . $datos_ofertas->consumoMinimo . " MX"; ?>
                    </div>
                </div>
                <div class="span-12 last">
                    <div class="span-4">
                        <?php echo form_label('Porcentaje de bonificacion: ', 'porcentajeBonificacion', array('style'=>'color: #660066')); ?>
                    </div>
                    <div class="span-7 last" style="color: #7F7D7D">
                        <?php echo $datos_ofertas->bonificaPorcentaje . ' %'; ?>
                    </div>
                </div>
                <div class="span-12 last">
                    <div class="span-4">
                        <?php echo form_label('Tipo de descuento: ', 'tipoDescuento', array('style'=>'color: #660066')); ?>
                    </div>
                    <div class="span-7 last" style="color: #7F7D7D">
                        <?php if($datos_ofertas->tipoDescuento == 1): ?>
                            Toda la tienda  
                        <?php elseif($datos_ofertas->tipoDescuento == 2): ?>
                            Por Productos                
                        <?php elseif($datos_ofertas->tipoDescuento == 3): ?>
                            Por Categorias
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($datos_ofertas->tipoDescuento != 1): ?>
                    <div class="span-12 last">
                        <div class="span-4">
                            <?php if($datos_ofertas->tipoDescuento == 2): ?>
                                <?php echo form_label('Productos: ', 'productos', array('style'=>'color: #660066')); ?>
                            <?php elseif($datos_ofertas->tipoDescuento == 3): ?>
                                <?php echo form_label('Categorias: ', 'categorias', array('style'=>'color: #660066')); ?>
                            <?php endif; ?>
                        </div>
                        <div class="span-7 last" style="color: #7F7D7D;">
                            <?php if($datos_ofertas->tipoDescuento == 2): ?>
                                <?php $productosCategorias = get_producto_category($datos_ofertas->ofertaId); ?>
                                <?php if(!empty($productosCategorias)): ?>
                                    <?php foreach($productosCategorias as $productos): ?>
                                        <?php echo $productos->product_category . ', '; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php elseif($datos_ofertas->tipoDescuento == 3): ?>
                                <?php $productosCategorias = get_producto_category($datos_ofertas->ofertaId); ?>
                                <?php if(!empty($productosCategorias)): ?>
                                    <?php foreach($productosCategorias as $categorias): ?>
                                        <?php echo $categorias->product_category . ', '; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="prepend-9 last">
                    <?php echo anchor('redessociales/eliminar_oferta/'.$datos_ofertas->ofertaId,
                                      'Eliminar',
                                      array('style'=>'color: #660066; text-decoration: none', 'class'=>'eliminar-ofertas')); ?>
                </div>
            </div><!-- DIV PRINCIPAL DEL CUERPO **FIN** -->
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php else: ?><!-- ELSE PARA CONOCER SI ESTA VACIA O NO **MEDIO** -->
        <div class="span-12 last" style="margin-left: 20px; margin-top: 40px; margin-bottom: 40px">
            <span style="color: #660066; font-size: 14px">No hay ofertas activadas</span>
        </div>
    <?php endif; ?><!-- FIN DEL IF PARA CONOCER SI ESTA VACIA O NO **FIN** -->
</div>
