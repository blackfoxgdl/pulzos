<?php
/**
 * Vista que se encarga de mostrar todos los pulzos
 * que se tienen por categoria, esto para que el usuario
 * pueda visualizarlos
 **/
?>
<script type="text/javascript">
$(document).ready(function(){
    name_complete = $("#nombre-usuario-plan").html();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").html(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
});

$(".back-again").live('click', function(event){
    event.preventDefault();
    attrBack = $(event.currentTarget).attr('href');
    $("#texto-menu").load(attrBack);
});

$("#ciudad-header").click(function(event){
    event.preventDefault();
    var urlBackGiro = $(this).attr('href');
    $("#texto-menu").load(urlBackGiro);
});
</script>
<div class="span-14 last" style="margin-top: 10px;">
    <div style="display: none">
        <?php $datosGiro = get_id_category($subcategoria->id); ?>
        <?php $total = get_count_number_subcategories($datosGiro->idGiro); ?>
        <?php if($total == 1): ?>
            <div id="nombre-usuario-plan"><a href="<?php echo base_url(); ?>index.php/pulzos/pulzos_usuarios" style="color: #530047; text-decoration: none" class="back-again">
                                            Mi Ciudad </a> / <?php echo $datosGiro->nombre; ?></div>
        <?php else: ?>
            <?php $nombre = get_name_giro($datosGiro->idGiro); ?>
            <div id="nombre-usuario-plan"><a href="<?php echo base_url(); ?>index.php/pulzos/pulzos_usuarios" style="text-decoration: none; color: #530047" class="back-again">
                                            Mi Ciudad </a>/ <?php echo anchor('pulzos/ver_categoria/'.$datosGiro->idGiro, $nombre->nombre, array('style'=>'text-decoration: none; color: #530047', 'id'=>'ciudad-header')); ?><?php echo ' / ' . $datosGiro->nombre; ?></div>
        <?php endif; ?>
        <div id="edad-usuario-plan"></div>
        <div id="relacion-usuario-plan"></div>
        <div id="estado-usuario-plan"></div>
    </div>
    <div class="span-14 last">
        <?php foreach($pulzos as $pulzo): ?>
            <?php $pulzos_totales = get_total_pulzo($pulzo->negocioId); ?>
            <?php $valoresKnow = get_data_by_user_bussiness($pulzo->negocioUsuarioId); ?>
                <div class="span-13" style="border-bottom: 1px solid #CBCBCB; margin-top: 15px; margin-bottom: 5px"><!-- DIV PRINCIPAL DE DIRECTORIO -->
                    <div class="span-1">
                        <?php if($valoresKnow->statusEU == 1): ?>
                            <?php echo anchor('negocios/perfil/'.$pulzo->negocioId,
                                              img(array('src'=>get_avatar_negocios($pulzo->negocioId),
                                                        'width'=>'37',
                                                        'height'=>'37')),
                                              array('id'=>'', 'style'=>'text-decoration: none')); ?>
                        <?php else: ?>
                            <?php echo anchor('altanegocios/index/'.$pulzo->negocioId,
                                              img(array('src'=>get_avatar_negocios($pulzo->negocioId),
                                                        'width'=>'37',
                                                        'height'=>'37')),
                                              array('id'=>'', 'style'=>'text-decoration: none')); ?>
                        <?php endif; ?>
                    </div>
                    <div class="span-11 last" style="margin-left: 10px">
                        <div class="span-12">
                            <?php if($valoresKnow->statusEU == 1): ?>
                                <?php echo anchor('negocios/perfil/'.$pulzo->negocioId,
                                                  $pulzo->negocioNombre,
                                                  array('id'=>'', 'style'=>'text-decoration: none; color: #660066;')); ?>
                            <?php else: ?>
                                <?php echo anchor('altanegocios/index/'.$pulzo->negocioId,
                                                  $pulzo->negocioNombre,
                                                  array('id'=>'', 'style'=>'text-decoration: none; color: #660066;')); ?>
                            <?php endif; ?>
                        </div>
                        <div class="span-12" style="color: #8F8F8F">
                            <span class="interlineado" style="line-height: -2px">
                                <?php echo $pulzo->negocioDescripcion; ?>
                            </span>
                        </div>
                        <div class="span-12" style="color: #8F8F8F">
                            <span class="interlineado" style="line-height: -2px">
                                <?php echo $pulzo->negocioTelefono; ?>
                            </span>
                        </div>
                        <div class="span-12" style="color: #8F8F8F">
                            <span class="interlineado" style="line-height: -2px">
                                <?php echo $pulzo->negocioDireccion; ?>
                            </span>
                        </div>
                    </div>
                    <div class="span-12" style="margin-bottom: 10px">
                        <div class="prepend-10">
                            <?php if($valoresKnow->statusEU == 1): ?>
                                <?php echo anchor('negocios/perfil/'.$pulzo->negocioId,
                                                  'Ver mas',
                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                            <?php else: ?>
                                <?php echo anchor('altanegocios/index/'.$pulzo->negocioId,
                                                  'Ver mas',
                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!-- DIV PRINCIPAL DE DIRECTORIO -->
        <?php endforeach; ?>
    </div> 
</div>
