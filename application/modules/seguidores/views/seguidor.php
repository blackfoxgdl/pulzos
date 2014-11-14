<?php
/**
 * Se mostraran todas las empresas que
 * sigue el usuario o de las cuales
 * estan interesados en las promociones
 * que esten dando a los usuarios.
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 05 April, 2011
 * @package Seguidores
 **/
?>
<script type="text/javascript">
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

$(".menu-izq-menor").click(function(event){
    event.preventDefault();
    var deleteCompany = $(event.currentTarget).attr('href');
    $.get(deleteCompany);
    $(event.currentTarget).parent().parent().parent().hide();

</script>
<div style="display: none">
    <div id="nombre-usuario-plan">Negocios</div>
</div>
<div class="span-14 last" style="margin-top: 10px">
    <div class="span-13 last">
        <?php foreach($seguidor as $empresa_sigo): ?>

            <div class="span-4 last" style="margin-top: 10px;">
                <div align="center">
                    <span style="color: #8D6E98; font-size: 9pt; font-weight: normal">
                        <?php echo anchor('negocios/perfil/'.$empresa_sigo->negocioId,
                                          $empresa_sigo->negocioNombre,
                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </span>
                    <p style="margin-top:5px; margin-bottom: 5px">
                        <?php echo anchor('negocios/perfil/'.$empresa_sigo->negocioId,
                                          img(array('src'=>get_avatar_negocios($empresa_sigo->negocioId),
                                                    'width'=>'90',
                                                    'height'=>'90'))); ?>
                    </p>
                    <p>
                        <?php echo anchor('negocios/perfil/'.$empresa_sigo->seguidorNegocioId,
                                          'Ver Perfil', array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                        <br />
                        <?php if($this->session->userdata('id') == $id_usuario): ?>
                            <?php echo anchor('seguidores/borrar/'.$empresa_sigo->seguidorUsuarioId.'/'.$empresa_sigo->seguidorNegocioId,
                                              'Ya no seguir', array('class'=>'menu-izq-menor','style'=>'text-decoration: none')); ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
