<?php
/**
 * vista para mostrar las subcategoria seleccionada pero abierta
 * esto para que el usuario pueda visualizarla dependiendo
 * de si su categoria tiene una subcategoria
 **/
?>
<script type="text/javascript">
$(".miciudad").click(function(event){
    event.preventDefault();
    var urlCat = $(event.currentTarget).attr('href');
    $("#texto-menu").load(urlCat);
});

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
</script>
<div style="display: none">
<div id="nombre-usuario-plan">
            <a href="<?php echo base_url(); ?>index.php/pulzos/pulzos_usuarios" style="color: #530047; text-decoration: none" class="back-again">
                                            Mi Ciudad </a> / <?php echo $giro->nombre; ?></div>
        <div id="edad-usuario-plan"></div>
        <div id="relacion-usuario-plan"></div>
        <div id="estado-usuario-plan"></div>
</div>
<div class="span-14 last" style="margin-top: 25px">
    <div class="span-13">
        <div class="span-6"><!-- DIV AYUDA TU COMUNIDAD **INICIO** -->
            <a href="#" style="text-decoration: none">
                <div style="width: 200px; height: 14px; border: 1px solid #996699; border-right: 0px" class="pc" name="Ayuda a tu Comunidad">                               <span style="color: #530047; margin-left: 1px; margin-bottom: 1px">
                        +
                    </span>
                    <div style="width: 186px; height: 18px; margin-left: 15px; margin-top: -22px; background-color: #F0F0F0">
                        <?php echo img(array('src'=>'statics/img/miCiudad/cd-ayuda.png',
                                             'width'=>'35',
                                             'height'=>'18',
                                             'style'=>'margin-left: 8px; margin-top: -4px')); ?>
                        <div style="margin-top: -25px; margin-left: 55px; color: #530047">
                            <?php echo $giro->nombre; ?>
                        </div>
                    </div>
                </div>
            </a>
            <div class="span-6" style="display: inline; background-color: #E7DCEC; width: 200px;" id="ac">
                <?php $AC = get_subcategories($id); ?>
                <?php $i = 1; ?>
                <ul>
                <?php foreach($AC as $ac): ?>
                    <?php if($i%2 == 0): ?>
                        <li class="span-6 last" style="display: inline; margin-left: -18px; line-height: 14px; background-color: #DBCCE3; width: 200px;">
                                    <?php echo anchor('pulzos/mostrar_pulzos/'.$ac->id,
                                                      $ac->nombre,
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 14px', 'class'=>'miciudad')); ?>
                            </li>
                        <?php else: ?>
                            <li class="span-6 last" style="display: inline; margin-right: 0px; margin-left: -4px; line-height: 14px">
                                    <?php echo anchor('pulzos/mostrar_pulzos/'.$ac->id,
                                                      $ac->nombre,
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'miciudad')); ?>
                            </li>
                    <?php endif; ?>
                    <?php $i = $i + 1; ?>
                <?php endforeach; ?>
                </ul>
            </div>
        </div><!-- DIV AYUDA A TU COMUNIDAD **FIN** --> 
    </div>
</div>
