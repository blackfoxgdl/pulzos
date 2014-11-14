<?php
/**
 * Muestra los pulzos de las experiencias de vida que coinicidan con
 * la palabra que se pasara para poder realizar la busqueda de estos
 * y poder mostrarlos
 **/
?>
<script type="text/javascript">
$(".pulzo-empresa").click(function(event){
    event.preventDefault();
    urlE = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlE);
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
    var textoMiCiudad = $("div#menu-derecha").html();
    $("#main-div").html(textoMiCiudad);
});
</script>
<div class="span-14 last" style="margin-left: 0px; margin-top: 10px">
    <div class="span-14" style="display: none"><!-- DIV TITULO DINAMICO -->
        <div id="menu-derecha">
        </div>
        <div id="nombre-usuario-plan">
            Experiencias de Vida
        </div>
    </div><!-- DIV TITULO DINAMICO -->
    <div class="span-13 last">
        <?php foreach($resultados as $experiencia): ?>
            <div class="span-12" style="margin-bottom: 10px; border-bottom: 1px solid #CBCBCB; margin-top: 10px">
                <div class="span-1">
                    <?php echo anchor('negocios/perfil/'.$experiencia->pulzoUsuarioId,
                                      img(array('src'=>get_avatar_negocios($experiencia->pulzoUsuarioId),
                                                'width'=>'36',
                                                'height'=>'36'))); ?>
                </div>
                <div class="interlineado span-10 last" style="margin-top: 0px; margin-left: 10px;">
                    <div style="margin-top: 5px">
                        <span class="pulzos_titulo1">
                            <?php echo $experiencia->pulzoTitulo; ?>
                        </span>
                        <br />
                        <span class="pulzos_titulo1">
                            Fecha Inicio: 
                        </span>
                        <span class="pulzos_titulo2">
                            <?php $fecha = unix_to_human($experiencia->pulzoFechaInicio);
                                  $correcta = fecha_acomodo($fecha);
                                  echo $correcta; ?> 
                        </span>
                        <br />
                        <span class="pulzos_titulo1">
                            Fecha Fin: 
                        </span>
                        <span class="pulzos_titulo2">
                            <?php $fechaF = unix_to_human($experiencia->pulzoFechaFin);
                                  $correctaF = fecha_acomodo($fechaF);
                                  echo $correctaF; ?>
                        </span>
                        <br />
                        <span class="pulzos_titulo1">
                            Tipo de Experiencia: 
                        </span>
                        <span class="pulzos_titulo2">
                            <?php echo $experiencia->pulzoExperienciaId; ?>
                        </span>
                        <br />
                        <span class="pulzos_titulo2">
                            <?php echo $experiencia->pulzoAccion; ?>
                        </span>
                        <br />
                        <span class="pulzos_titulo1">
                            Paquete: 
                        </span>
                        <span class="pulzos_titulo2">
                            <?php echo substr($experiencia->pulzoPaqueteIncluye, 0, 80) . "...."; ?>
                        </span>
                    </div>
                    <div class="prepend-2" style="margin-top: 10px;">
                        <span class="right ver-todo-link" style="margin-bottom: 10px">
                        <?php if($this->session->userdata('idN') != $experiencia->pulzoUsuarioId): ?>
                                    <?php echo anchor('pulzos/pulzo_comentario/'.$experiencia->pulzoUsuarioId.'/'.$this->session->userdata('id').'/'.$experiencia->pulzoId,
                                              'Comentar', array('id'=>'comentarPulzos','class'=>'comentar', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: 100px;')); ?>
                        <?php endif; ?>
                            <?php echo anchor('experienciasnegocios/ver_experiencia/'.$experiencia->pulzoId,
                                              'ver mas', array('id'=>'', 'class'=>'pulzo-empresa', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: 100px; margin-bottom: 5px')); ?>
                        <?php if($this->session->userdata('idN') == $experiencia->pulzoUsuarioId): ?>
                            <?php echo anchor('pulzos/borrar/'.$experiencia->pulzoId,
                                'Borrar',array('id'=>'eliminarP', 'class'=>'eliminarPulzo', 'style'=>'color: #8D6E98; text-decoration: none; margin-left: 30px;')); ?>
                        <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
