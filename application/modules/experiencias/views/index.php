<?php
/**
 * Vista que se genera para ver las experiencias,
 * en la cual tambien se mostraran los datos de
 * los negocios a los que has apadrinado
 **/
?>
<script type="text/javascript">

$("#ver-todos-padrinos").click(function(event){
    event.preventDefault();
    $("#ver-recibidas").hide();
    $("#vista-corta-padrino").hide();
    $("#ocultar-recibidas").show();
    $("#vista-larga-padrino").show();
});

$("#ocultar-todos-padrinos").click(function(event){
    event.preventDefault();
    $("#ocultar-recibidas").hide();
    $("#vista-larga-padrino").hide();
    $("#ver-recibidas").show();
    $("#vista-corta-padrino").show();
});

$(document).ready(function(){
    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
});
</script>
<div style="display: none">
    <div id="nombre-usuario-plan">Experiencias</div>
</div>
<div class="span-14 last"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="span-14" style="margin-bottom: 10px"><!-- DIV SECUNDARIO **INICIO** -->
        <div class="span-13" style="margin-top: 30px; margin-bottom: 10px">
            <span class="span-8" style="color: #68146E; font-size: 10pt">
                Empresas que apadrino (<?php echo $contar; ?>)
            </span>
            <span class="prepend-3" style="margin-left: 2px;" id="ver-recibidas">
                <?php echo anchor('#',
                                  'ver todos',
                                  array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'ver-todos-padrinos')); ?>
            </span>
            <span class="prepend-3" style="margin-left: -2px; display: none" id="ocultar-recibidas">
                <?php echo anchor('#',
                                  'ocultar todos',
                                  array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'ocultar-todos-padrinos')); ?>
            </span>
            <div class="span-13" style="border-bottom: 1px solid #DAD6DB; margin-top: 10px" id="vista-corta-padrino">
                <?php foreach($padrino as $padrinos): ?>
                    <div class="span-1">
                        <?php echo anchor('altanegocios/index/'.$padrinos->altaNegocioNegocioId,
                                          img(array('src'=>'statics/img/default/avatarempresas.jpg',
                                                    'width'=>'36px',
                                                    'height'=>'36px',
                                                    'title'=>$padrinos->altaNegocioNombre))); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="span-14 last" style="border-bottom: 1px solid #DAD6DB; display: none; margin-top: 10px" id="vista-larga-padrino">
                <?php foreach($padrino as $apadrinados): ?>
                    <div class="span-6" style="border: 1px solid #DAD6DB; margin-bottom: 7px; margin-right: 15px; width: 255px; height: 50px">
                        <div class="span-1" style="margin-left: 4px; margin-top: 4px">
                            <?php echo anchor('altanegocios/index/'.$apadrinados->altaNegocioNegocioId,
                                              img(array('src'=>'statics/img/default/avatarempresas.jpg',
                                                        'width'=>'37px',
                                                        'height'=>'37px',
                                                        'title'=>$apadrinados->altaNegocioNombre))); ?>
                        </div>
                        <div class="span-5 last" style="margin-top: 5px">
                            <div class="span-6">
                                <div class="span-5 last">
                                    <?php echo anchor('altanegocios/index/'.$apadrinados->altaNegocioNegocioId,
                                                      $apadrinados->altaNegocioNombre,
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 10px; margin-top: 10px')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div><!-- DIV SECUNDARIO **FIN** -->
</div><!-- DIV PRINCIPAL **FIN** -->
