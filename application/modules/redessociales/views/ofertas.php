<?php
/**
 * Metodo que se usa para poder mostrar las
 * ofertas que tiene activas los negocios y las
 * cuales pueden aprovechar los usuario para que
 * puedan solicitar su bonificacion
 **/
?>
<script type="text/javascript">
    $(".activar").click(function(event){
        event.preventDefault();
        urlA = $(event.currentTarget).attr('href');
        flag = $(event.currentTarget).attr('flag');
        $.get(urlA);
        $("#active"+flag).hide();
        $("#desactive"+flag).show();
    });

    $(".desactivar").click(function(event){
        event.preventDefault();
        urlD = $(event.currentTarget).attr('href');
        flag = $(event.currentTarget).attr('flag');
        $.get(urlD);
        $("#desactive"+flag).hide();
        $("#active"+flag).show();
    });

    $(".eliminar-oferta-negocio").click(function(event){
        event.preventDefault();
        urlEO = $(event.currentTarget).attr('href');
        $.get(urlEO);
        $(event.currentTarget).parent().parent().parent().hide();
    });
</script>
<div class="span-14 last" style="margin-top: 10px">
    <?php if(!empty($ofertas)): ?>
        <?php $i = 1; ?>
        <?php foreach($ofertas as $oferta): ?>
            <?php $title = get_data_title_offert($oferta->idPlanUsuarioOfertaNegocio); ?>
            <?php $mensajes = get_social_messages($oferta->idMensajeOferta); ?>
            <div class="span-13" style="margin-left:10px; margin-top:10px; margin-bottom:10px; border-bottom:1px solid #7F7D7D"><!-- DIV OFERTA **INICIO ** -->
                <div class="span-12 last">
                    <?php if($oferta->idPlanUsuarioOfertaNegocio == 0): ?>
                        <?php $nameBussiness = get_name_company($oferta->idNegocioOferta);
                              echo "Oferta de " . $nameBussiness->negocioNombre;
                        ?>
                    <?php else: ?>
                        <?php echo $title->planDescripcion; ?>
                    <?php endif; ?>
                </div>
                <div class="span-12 last" style="margin-top: 10px">
                    <div class="span-4">
                        <?php //echo form_label('Consumo minimo:', 'consumoMinimo', array('style'=>'color: #660066')); ?>
                    </div>
                    <div class="span-7 last" style="color: #7F7D7D">
                        <?php //echo '$ ' . $oferta->consumoMinimo . ' MX'; ?>
                    </div>
                </div>
                <div class="span-12 last">
                    <div class="span-4">
                        <?php echo form_label('Discount:', 'porcentajeBoni', array('style'=>'color: #660066')); ?>
                    </div>
                    <div class="span-7 last" style="color: #7F7D7D">
                        <?php echo $oferta->bonificaPorcentaje . ' %'; ?>
                    </div>
                </div>
                <?php if(!empty($mensajes->mensajeFacebook)): ?>
                    <div class="span-12 last">
                        <div class="span-4">
                            <?php echo form_label('Mensaje Facebook:', 'mensajeFB', array('style'=>'color: #660066')); ?>
                        </div>
                        <div class="span-7 last" style="color: #7F7D7D">
                            <?php echo $mensajes->mensajeFacebook; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($mensajes->mensajeTwitter)): ?>
                    <div class="span-12 last">
                        <div class="span-4">
                            <?php echo form_label('Mensaje Twitter:', 'mensajeTW', array('style'=>'color: #660066')); ?>
                        </div>
                        <div class="span-7 last" style="color: #7F7D7D">
                            <?php echo $mensajes->mensajeTwitter; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="span-12 last">
                    <?php if($oferta->ofertaActivacion == '1'): ?>
                        <div class="prepend-7 span-2" id="desactive<?php echo $oferta->ofertaId; ?>">
                            <?php echo anchor('redessociales/desactivar_oferta/'.$oferta->ofertaId,
                                              'Off',
                                              array('style'=>'color: #660066; text-decoration: none', 'class'=>'desactivar', 'flag'=>$oferta->ofertaId)); ?>
                        </div>
                        <div class="prepend-7 span-2" style="display: none" id="active<?php echo $oferta->ofertaId; ?>">
                            <?php echo anchor('redessociales/activar_oferta/'.$oferta->ofertaId,
                                              'On',
                                              array('style'=>'color: #660066; text-decoration: none', 'class'=>'activar', 'flag'=>$oferta->ofertaId)); ?>
                        </div>
                    <?php elseif($oferta->ofertaActivacion == '2'): ?>
                        <div class="prepend-7 span-2" id="active<?php echo $oferta->ofertaId; ?>">
                            <?php echo anchor('redessociales/activar_oferta/'.$oferta->ofertaId,
                                              'On',
                                              array('style'=>'color: #660066; text-decoration: none', 'class'=>'activar', 'flag'=>$oferta->ofertaId)); ?>
                        </div>
                        <div class="prepend-7 span-2" style="display: none" id="desactive<?php echo $oferta->ofertaId; ?>">
                            <?php echo anchor('redessociales/desactivar_oferta/'.$oferta->ofertaId,
                                              'Off',
                                              array('style'=>'color: #660066; text-decoration: none', 'class'=>'desactivar', 'flag'=>$oferta->ofertaId)); ?>
                        </div> 
                    <?php endif; ?>
                    <div class="span-2">
                        <?php echo anchor('redessociales/eliminar_oferta/'.$oferta->ofertaId,
                                          'Delete',
                                          array('style'=>'color: #660066; text-decoration: none', 'class'=>'eliminar-oferta-negocio')); ?>
                    </div>
                </div>
            </div><!-- DIV OFERTA **FIN** -->
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>
</div>
