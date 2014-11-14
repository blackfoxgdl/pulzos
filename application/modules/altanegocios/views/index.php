<?php
/**
 * Vista del perfil de los negocios que se han dado de
 * alta para que puedan ver el perfil de la empresa
 * y posteriormente se puedan armar planes
 **/
?>
<div class="span-24 last"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="span-4 last"><!-- DIV LADO IZQUIERDO **INICIO** -->
        <div class="span-4 last" style="margin-top: 8px">
             <?php echo img(array('src'=>get_avatarneg($altaN->altaNegocioNegocioId),
                                      'class'=>'foto-medidas',
                                      'id'=>'avatar-photo-block')); 
            ?>
        </div>
        <div class="span-4 last" style="margin-top: 24px; height: 24px; width: 160px">
            <div style="margin-left: 9px; margin-top: 3px; color: #83547F">
                Padrino
            </div>
        </div>
        <div class="span-4 last" style="width: 160px; border-bottom: 1px solid #DBDBDB; margin-top: 5px">
            <div class="span-4 last" style="">
                <?php $sponsor = get_sponsor_company($altaN->altaNegocioId); ?>
                <div class="span-1">
                    <?php echo img(array('src'=>get_avatar($sponsor->apadrinaNegocioUserId),
                                         'width'=>'37px',
                                         'height'=>'37px',
                                         'title'=>get_complete_username($sponsor->apadrinaNegocioUserId))); ?>
                </div>
            </div>
        </div>
    </div><!-- DIV LADO IZQUIERDO **FIN** -->
    <div class="span-20 last" style="background-color: #F0F0F0; width: 790px; margin-left: 10px"><!-- DIV FONDO -->
        <div class="span-20 last" style="background-color: #F0F0F0; width: 790px"><!-- DIV DE PARTE DEL TITULO **INICIO** -->
            <div class="span-19" style="background-color: #F0F0F0">
                <div class="span-20" style="border-left: 1px solid #DBDBDB; border-bottom: 1px solid #DBDBDB; margin-left: 20px; width: 770px; background-color: #F0F0F0">
                    <div class="span-14" style="margin-left: 6px; line-height: 15px; margin-top: 2px">
                        <div class="span-14" style="margin-top: 8px">
                            <span id="nombre-perfil-alta" class="titulo-menu">
                                <?php echo $altaN->altaNegocioNombre; ?>
                            </span> 
                        </div>
                        <div class="span-19" style="margin-bottom: 3px;">
                            <span id="restaurant-type" style="margin-right: 3px" class="informacion-menu">
                                <?php echo get_giro_negocio($altaN->altaNegocioGiro); ?> 
                                <?php if($altaN->altaNegocioSubgiro != NULL): ?>
                                    <?php $subcategoria = get_name_subgiro($altaN->altaNegocioSubgiro); ?>
                                    <?php echo $subcategoria->nombre; ?>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <div class="span-5 last"><!-- BOTONES **INICIO** -->
                        <div style="display:">
                        <div class="" id="botones-derecha" style="margin-left: -20px; margin-top: 20px">
                            <?php $valores = get_name_company($altaN->altaNegocioNegocioId); ?>
                            <?php echo anchor('planesusuarios/planes_negocios/'.$this->session->userdata('id').'/'.$valores->negocioUsuarioId,
                                              img(array('src'=>'statics/img/bot-armapulzo.png',
                                                        'width'=>'80px',
                                                        'heigth'=>'20px')),
                                                  array('style'=>'text-decoration: none; margin-left: -20px')); ?>
                        </div>
                    </div>
                    </div><!-- BOTONES **FIN** -->
                </div>
            </div>
        </div><!-- DIV DE PARTE DEL TITULO **FIN** -->
        <div class="span-14 last"><!-- DIV LADO CENTRO **INICIO** -->
            <div class="span-13 last" style="margin-left: 20px; margin-top: 10px;">
                <div class="span-13" style="margin-bottom: 5px;">
                    <?php echo img(array('src'=>'statics/img/reclamatunegocio.png',
                                         'width'=>'520px',
                                         'height'=>'240px')); ?>
                </div>
                <div class="span-13 last" style="border-bottom: 1px solid #CBCBCB">
                    &nbsp;
                </div>
                <div class="span-12" style="margin-bottom: 15px">
                    <div class="span-2" style="color: #660066; margin-top: 5px">
                        Direcci&oacute;n:
                    </div>
                    <div class="prepend-1" style="color: #7F7D7D; margin-top: 5px">
                        <?php echo $altaN->altaNegocioDireccion; ?>, <?php echo $altaN->altaNegocioColonia; ?>
                    </div>
                </div>
                <div class="span-12" style="margin-bottom: 15px">
                    <div class="span-2" style="color: #660066; margin-top: 5px">
                        Descripci&oacute;n:
                    </div>
                    <div class="prepend-1" style="color: #7D7D7D; margin-top: 5px">
                        <?php echo $altaN->altaNegocioDescripcion; ?>
                    </div>
                </div>
            </div>
        </div><!-- DIV LADO CENTRO **FIN** -->
        <div class="span-5 last" id="nav" style="margin-left: 0px; margin-top: 12px; background-color: #F0F0F0"><!-- DIV LADO DERECHO **INICIO** -->
            <!-- DIV CONTENEDOR **INICIO** -->
            <div class="redondeo-menu span-6 last" style="border: 1px solid #CBCBCB; width: 228px; background-color: #F0F0F0">
                <div class="redondeo-titulo span-6 last" style="height: 20px; background-color: #A71E9F; width: 228px; border-bottom: 1px solid #CBCBCB">
                    <span style="color: #FFFFFF; margin-left: 6px">
                        Personas que tienen planes
                    </span>
                </div>
                <div class="span-6 last" style="height: 32px; width: 228px; background-color: #A71E9F; background-color: #FFFFFF; border-bottom: 1px solid #CBCBCB">
                    <div class="span-1" style="margin-top: 4px; margin-bottom: 4px; margin-left: 4px">
                        &nbsp;
                    </div>
                    <div class="span-4 last" style="margin-top: 8px">
                        <?php echo anchor('',
                                          'Hoy',
                                           array('style'=>'text-decoration: none; color: #7F7D7D')); ?>
                    </div>
                </div>
                <div class="redondeo-div-inferior span-6 last" style="height: 32px; width: 228px; background-color: #FFFFFF">
                    <div class="span-1" style="margin-top: 4px; margin-bottom: 4px; margin-left: 4px">
                        &nbsp;
                    </div>
                    <div class="span-4 last" style="margin-top: 8px; magin-bottom: 5px">
                        <?php echo anchor('',
                                          'Esta semana',
                                           array('style'=>'text-decoration: none; color: #7F7D7D')); ?>
                    </div>
                </div>
            </div>
            <!-- DIV CONTENEDOR **FIN** -->
        </div><!-- DIV LADO DERECHO **FIN** -->
    </div><!-- DIV FONDO -->
</div><!-- DIV PRINCIPAL **FIN** -->
