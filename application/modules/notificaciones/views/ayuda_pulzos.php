<?php
/**
 * Vista que se dedica a la visualizacion
 * de la FAQ de ayuda para los usuarios de
 * pulzos
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
</script>
<div style="display: none">
    <div id="nombre-usuario-plan">Ayuda</div>
    <div id="edad-usuario-plan"></div>
    <div id="relacion-usuario-plan"></div>
    <div id="estado-usuario-plan"></div>
</div>
<div class="span-14 last">
    hola
</div>
