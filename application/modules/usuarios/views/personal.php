<?php
/**
 * Vista para mostrar los datos de personales
 * del usuario, los cuales son los datos que
 * edita en la parte de cuenta
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 25, 2011
 * @package usuarios
 **/
?>

<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){

$("#agregar").click(function(event){
    event.preventDefault();
    var rutaUrl = $(this).attr('href');
    $.get(rutaUrl);
    $(this).hide();
    $("#pendiente").show();
});

    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
    var texto = $("div#menu-derecha").html();
    $("#main-div").html(texto);
});
</script>

<div>
    <div id="menu-derecha1">
        <?php if($this->session->userdata('id') == $usuarios->id): ?>
            <div id="menu-opciones" style="display: none">
                <?php echo anchor('planesusuarios',
                                  img(array('src'=>'statics/img/bot-armapulzo.png',
                                            'id'=>'planesU',
                                            'width'=>'80',
                                            'height'=>'20',
                                            'style'=>'margin-top: 22px; margin-left: -23px'))); ?>
            </div>
        <?php else: ?>
            <div id="menu-opciones">
                <?php if(! $this->session->userdata('idN')): ?><!-- se usa para checar amistar -->
                    <?php if($this->session->userdata('id') != $usuarios->id): ?>
                        <?php $total = count_data($this->session->userdata('id'), $usuarios->id); ?>
                        <?php if($total != 0): ?>
                            <?php $val = status_friend($this->session->userdata('id'), $usuarios->id); ?>
                            <div style="background-color: #A9A9A9; color: #FFFFFF; margin-left: 550px; margin-top: -20px; width: 120px">
                                <?php echo get_message_status($val->amigoAceptado); ?>
                            </div>
                        <?php else: ?>
                            <div style="margin-left: 546px; margin-top: -25px">
                            <?php $a = is_friend($this->session->userdata('id'), $usuarios->id); ?>
                                <?php if($a == 1): ?>
                                    <a href="<?php echo base_url(); ?>index.php/amigos/agregar/<?php echo $usuarios->id; ?>" id="agregar" style="text-decoration: none;margin-left: 0px; margin-top: 0px">
                                        <div style="background-color: #339900; color: #FFFFFF; margin-top: -26px; margin-left: 0px; width: 90px; height:20px; padding-left: 6px" class="agr">
                                            Agregar amigo
                                        </div>
                                    </a>
                                <?php endif; ?>
                                <div style="background-color: #A9A9A9; color: #FFFFFF; margin-top: -20px; margin-left: 0px; width: 120px; padding-left: 6px; display: none" id="pendiente">
                                    Amistad pendiente
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?><!-- se usa para checar amistad -->
            </div>
        <?php endif; ?>
    </div>
    <!-- PARTE DEL BOTON DE LA PARTE SUPERIOR DERECHA **FIN** -->
    <div style="display: none">
        <div id="nombre-usuario-plan"><?php echo $usuarios->nombre . " " . $usuarios->apellidos ?></div>
        <div id="edad-usuario-plan">
            <?php if($usuarios->edad != '0000-00-00 00:00:00'): ?>
                <?php echo $edad; ?> a&ntilde;os
            <?php endif; ?>
        </div>
        <div id="relacion-usuario-plan">
            <?php if($this->session->userdata('id') == $usuarios->id): ?>
                <?php if($personal->id != 1): ?>
                    <?php echo $personal->nombre; ?>
                <?php else: ?>
                    <?php echo ""; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if($personal->id != 1): ?>
                    <?php echo $personal->nombre; ?>
                <?php else: ?>
                    <?php echo ""; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div id="estado-usuario-plan">
            <?php if(!empty($localidad)): ?>
                <?php echo $localidad->nombre; ?>
            <?php endif; ?>
        </div>
    </div>
    </div><!-- PARTE DE LOS TITULOS -->

    <div class="span-14 last bgColor" id="tabs" style="margin-top: 30px">
    <div class="span-10">
        <div class="span-14 fondosEP">
            <font class="titulosEP">
                Datos Personales
            </font>
        </div>
        <div class="span-9 last letrasColor">
            <?php echo $personales->nombre . " " . $personales->apellidos; ?>
            <br />
            <?php if(edad_usuario($personales->edad) == date('Y')): ?>
                No Especificado
            <?php else: ?>
                <?php echo edad_usuario($personales->edad); ?> a&ntilde;os
            <?php endif; ?>
            <br />
            <?php if($personales->ciudad != '0'): ?>
                <?php echo ciudad_usuario($personales->ciudad) . " " . pais_usuario($personales->pais); ?>
                <br />
            <?php endif; ?>
            <?php
                if($personales->sexo == 2)    
                {
                    echo "No Especificado";//Sexo no disponible";
                }
                else if($personales->sexo == 1)
                {
                    echo "Masculino";
                }
                else
                {
                    echo "Femenino";
                }
            ?>
            <br />
            <?php if(estado_civil_usuario($personales->relaciones) == "Seleccione su estatus de relacion"): ?>
                No Especificado
            <?php else: ?>
                <?php echo estado_civil_usuario($personales->relaciones); ?>
            <?php endif; ?>
        </div>
        <br />
        <div class="span-14 last prepend-top fondosEP">
            <font class="titulosEP">
                Acerca de mi:
            </font>
        </div>
        <div class="span-9 last prepend-top letrasColor">
            <?php echo $personales->acercaDe; ?>
        </div>
        <br />
        <div class="span-14 last fondosEP">
            <font class="titulosEP">
                Educacion:
            </font>
        </div>
        <div class="span-9 last letrasColor">
            <?php echo $personales->escuela; ?>
            <br />
            <?php echo $personales->escuela2; ?>
            <br />
            <?php echo $personales->escuela3; ?>
        </div>
    </div>    
</div>

