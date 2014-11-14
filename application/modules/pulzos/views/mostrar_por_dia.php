<?php
/**
 * Vista para los usuarios con los cuales
 * se pueden ver los pulzos por dia de las empresas para 
 * que los usuarios puedan visualizarlos
 **/
?>
<div class="span-14 last" style="margin-top: 10px">
    <div style="display: none">
    </div>
    <div class="span-14 last">
        <?php foreach($por_dia as $dia): ?>
            <?php $negocios = get_data_by_id_bussiness($dia->pulzoUsuarioId); ?>
            <div class="span-13" style="border-bottom: 1px solid #CBCBCB; margin-top: 15px; margin-bottom: 5px"><!-- DIV PRINCIPAL POR DIA **INICIO** -->
                <div class="span-1">
                    <?php echo anchor('negocios/perfil/'.$negocios->negocioId,
                                      img(array('src'=>get_avatar_negocios($dia->pulzoUsuarioId),
                                                'width'=>'37px',
                                                'height'=>'37px')),
                                      array('id'=>'', 'style'=>'text-decoration: none')); ?>
                </div>
                <div class="span-11 last" style="margin-left: 10px">
                    <div class="span-12">
                        <?php echo anchor('negocios/perfil/'.$negocios->negocioId,
                                          $negocios->negocioNombre,
                                          array('id'=>'', 'style'=>'text-decoration: none; color: #660066')); ?>
                    </div>
                    <div class="span-12" style="color: #8F8F8F">
                        <span class="interlineado" style="line-height: -2px">
                            <?php echo $dia->pulzoTitulo; ?>
                        </span>
                    </div>
                    <div class="span-12" style="color: #8F8F8F">
                        <span class="interlineado" style="line-height. -2px">
                            <?php echo $dia->pulzoAccion; ?>
                        </span>
                    </div>
                    <div class="span-12" style="color: #8F8F8F">
                        <span class="interlineado" style="line-height: -2px">
                            <?php echo $negocios->negocioDireccion; ?>
                        </span>
                    </div>
                </div>
                <div class="span-12" style="margin-bottom: 10px">
                    <div class="prepend-10">
                        <?php echo anchor('negocios/perfil/'.$negocios->negocioId,
                                          'Ver mas',
                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </div>
                </div>
            </div><!-- DIV PRINCIPAL POR DIA **FIN** -->
        <?php endforeach; ?>
    </div>
</div>
