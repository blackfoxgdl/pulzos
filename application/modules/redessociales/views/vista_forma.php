<?php
/**
 * Vista que se usa para poder realizar la previsualizacion
 * de los datos que se han ingresado anteriormente
 **/
?>
<script type="text/javascript">
$("#regresar-dos").click(function(event){
    event.preventDefault();
    $("#segundo_formulario").hide();
    urlReloadPrimero = $("#url_formularios").attr('href');
    $("#forma_creacion").load(urlReloadPrimero);
    $("#primer_formulario").show();
});

$("#activarPromocion").click(function(event){
    event.preventDefault();
    $("#segundo_formulario").hide();
    urlClean = $("#url_clean").attr('href');
    urlUpdate = $("#actualizar").attr('href');
    parametro = $(this).attr('flag');
    crear = urlUpdate + '/' + parametro;
    $.get(crear);
    $("#primer_formulario").show();
    $("#forma_creacion").load(urlClean);
    $("#mensaje").fadeIn(1000);
    $("#mensaje").fadeOut(2000);
});
</script>
<div class="span-13">
    <?php $valores = get_data_social_media($this->session->userdata('idN')); ?>
    <?php $valores2 = get_data_offers_company($this->session->userdata('idN')); ?>
    <?php echo anchor('redessociales/primer_formulario/'.$valores->socialEmpresaId.'/'.$valores2->ofertaId, '', array('id'=>'url_formularios', 'style'=>'display: none')); ?>
    <?php echo anchor('redessociales/actualizar_datos', '', array('id'=>'actualizar', 'style'=>'display: none')); ?>
    <?php echo anchor('redessociales/primer_formulario/', '', array('id'=>'url_clean', 'style'=>'display: none')); ?>
    <?php if(!empty($valores->mensajeFacebook)): ?>
        <div class="span-12 last">
            <div class="span-4">
                <?php echo form_label('Mensaje Facebook: ', 'mensajeFacebook', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-7 last" style="color: #7F7D7D">
                <?php echo $valores->mensajeFacebook; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if(!empty($valores->mensajeTwitter)): ?>
        <div class="span-12 last">
            <div class="span-4">
                <?php echo form_label('Mensaje Twitter: ', 'mensajeTwitter', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-7 last" style="color: #7F7D7D">
                <?php echo $valores->mensajeTwitter; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if(!empty($valores->mensajePulzos)): ?>
        <div class="span-12 last">
            <div class="span-4">
                <?php echo form_label('Mensaje Pulzos: ', 'mensajePulzos', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-7 last" style="color: #7F7D7D">
                <?php echo $valores->mensajePulzos; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="span-12 last">
        <div class="span-4">
            <?php echo form_label('Consumo minimo: ', 'consumoMinimo', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-7 last" style="color: #7F7D7D">
            $<?php echo $valores2->consumoMinimo; ?> MX
        </div>
    </div>
    <div class="span-12 last">
        <div class="span-4">
            <?php echo form_label('Bonificacion: ', 'bonificacion', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-7 last" style="color: #7F7D7D">
            <?php echo $valores2->bonificaPorcentaje; ?>%
        </div>
    </div>
    <div class="span-12 last">
        <div class="span-4">
            <?php echo form_label('Tipo de descuento: ', 'tipoDescuento', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-7 last" style="color: #7F7D7D">
            <?php if($valores2->tipoDescuento == 1): ?>
                Toda la tienda.
            <?php elseif($valores2->tipoDescuento == 2): ?>
                Por producto.
            <?php else: ?>
                Por categoria.
            <?php endif; ?>
        </div>
    </div>
    <div class="span-12">
        <?php if($valores2->tipoDescuento == 2): ?>
            <div class="span-4">
                <?php echo form_label('Productos: ', 'productoDescuento', array('style'=>'color: #660066')); ?>
            </div>
        <?php elseif($valores2->tipoDescuento == 3): ?>
            <div class="span-4">
                <?php echo form_label('Categorias: ', 'categoriasDescuentos', array('style'=>'color: #660066')); ?>
            </div>
        <?php endif; ?>
        <?php $valores3 = get_double_value($valores2->ofertaId); ?>
        <?php if(($valores2->tipoDescuento == 2) || ($valores2->tipoDescuento == 3)): ?>
            <div class="span-6 last" style="color: #7F7D7D">
                <?php $i = 1; ?>
                <?php foreach($valores3 as $producto): ?>
                    <?php echo $i.'.-'.$producto->product_category; ?>
                    <?php if($i%2 == 0): ?>
                        <br />
                    <?php endif; ?>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="span-12 last">
        <div class="prepend-1 span-5" style="text-align: right">
            <?php echo form_submit(array('id'=>'activarPromocion',
                                         'class'=>'guardar_redessociales',
                                         'flag'=>$valores2->ofertaId,
                                         'value'=>'Activar',
                                         'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
        </div>
        <div class="span-6 last">
            <?php echo form_submit(array('id'=>'regresar-dos',
                                         'class'=>'regresar_anterior',
                                         'value'=>'Regresar',
                                         'style'=>'background-color:#660066;color:#FFF;border:none;font-size:12px;height:20px;margin-top:8px;')); ?>
        </div>
    </div>
</div>
