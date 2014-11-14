<?php
/**
 * Metodo que se usa para poder realizar los reembolsos
 * de la empresa al usuario, esto para que puedan realizar
 * el money back sin necesidad de un telefono, bueno en 
 * caso de que el usuario no tenga un telefono con la aplicacion
 * de pulzos
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$("#forma-bonificacion").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista()
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function cargarVista()
{
    urlReload = $("#link-reload").attr("href");
    $("#texto-menu").load(urlReload);
}
</script>
<div class="span-14 last" style="margin-top: 20px; margin-left: 20px">
    <?php echo form_open('money/guardar_bonificacion_negocio/'.$this->session->userdata('id'), array('id'=>'forma-bonificacion')); ?>
        <div class="span-12 last">
            <div class="span-3">
                <?php echo form_label('User Email: ', 'emailUsuario', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-8 last">
                <?php echo form_input(array('id'=>'emailUsuarioMoney',
                                            'class'=>'emailUsuario',
                                            'name'=>'Money[moneyUsuarioEmail]',
                                            'style'=>'',
                                            'value'=>'')); ?>
            </div>
        </div>
        <div class="span-12 last">
            <?php echo form_label('Categoria de descuento:', 'categoriaDescuento', array('style'=>'color: #660066')); ?>
        </div>
        <div class="span-12 last">
        </div>
        <div class="span-12 last">
            <div class="span-3">
                <?php echo form_label('Folio / Factura: ', 'folioFactura', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-8 last">
                <?php echo form_input(array('id'=>'folioFacturaMoney',
                                            'class'=>'folioFactura',
                                            'name'=>'Money[moneyFolioFactura]',
                                            'style'=>'',
                                            'value'=>'')); ?>
            </div>
        </div>
        <div class="span-12 last">
            <div class="span-3">
                <?php echo form_label('Monto Consumido: ', 'montoConsumido', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-8 last">
                <?php echo form_input(array('id'=>'montoConsumoMoney',
                                            'class'=>'montoConsumo',
                                            'name'=>'Money[moneyMontoConsumo]',
                                            'style'=>'',
                                            'value'=>'')); ?>
            </div>
        </div>
        <div class="span-12 last">
            <div class="span-3">
                <?php echo form_label('Monto Otorgado:', 'moneyBackOtorgado', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-8 last">
                <?php echo form_input(array('id'=>'montoOtorgadoMoney',
                                            'class'=>'montoOtorgado',
                                            'name'=>'Money[moneyBackOtorgado]',
                                            'style'=>'',
                                            'value'=>'')); ?>
            </div>
        </div>
        <div class="prepend-2 span-8">
            <?php echo form_submit(array('id'=>'pulzarDatos',
                                         'class'=>'pulzarMoney',
                                         'name'=>'pulzar_money_negocios',
                                         'style'=>'background-color: #660066; color: #FFFFFF; border: none; font-size: 12px; height: 20px; margin-top: 8px',
                                         'value'=>'Pulzar')); ?>
        </div>
    <?php echo form_close(); ?>
</div>
