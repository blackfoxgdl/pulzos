<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(".plan-usuario").click(function(event){
    event.preventDefault();
    simplePlan = $(event.currentTarget).attr("href");
    location.href = simplePlan;

});

$("#comentarMuro").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: cargarVista
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

$(".comentar-submit").click(function(event){
    event.preventDefault();
    var idPS = $(event.currentTarget).attr('id');
    var attrAction = $(".forma-comentar-muro"+idPS).attr("action");
    var textDesc = $(".secondary-comment"+idPS).attr("value");
    $.ajax({
        type: "POST",
        url: attrAction,
        data: "comentar_muro="+textDesc,
        success: cargarVista
    });
});

function cargarVista()
{

    url = $("#enlace").attr("href");
    $("#texto-menu").load(url);
}

$(".comentar-plan").click(function(event){
    event.preventDefault();
    idComentario = $(event.currentTarget).attr('id');

    nombreDiv = ".comentarios-" + idComentario;
    $(nombreDiv).show();
});


function subcomentar_enter(event, idplan)
{
    if(event.keyCode == 13)
    {
        var accionAtr = $(".forma-comentar-muro"+idplan).attr("action");
        var datosAccion = $(".secondary-comment"+idplan).attr("value");
        $.ajax({
            type: "POST",
            url: accionAtr,
            data: "comentar_muro="+datosAccion,
            success: cargarVista
        });
    }
}

function quitarTexto(val)
{
    if(document.getElementById('main-comment').value == '¿Qué quieres hacer hoy?')
    {
        document.getElementById('main-comment').value = '';
    }
}

function ponerTexto(val)
{
    if(document.getElementById('main-comment').value == '')
    {
        document.getElementById('main-comment').value = val;
    }
}

$(".apuntar").click(function(event){
    event.preventDefault();
    var apunta = $(event.currentTarget).attr("href");
    $.get(apunta);
    $("#texto-menu").load($("#enlace").attr("href"));
});

$(".novoy").click(function(event){
    event.preventDefault();
    var novoy1 = $(event.currentTarget).attr('href');
    $.get(novoy1);
    $("#texto-menu").load($("#enlace").attr('href'));
});

$(".eliminar").click(function(event){
    event.preventDefault();
    var deletePlain = $(event.currentTarget).attr("href");
    var numId = $(event.currentTarget).attr("name");
    var commentsPlain = ".comentarios"+numId;
    $.get(deletePlain);
    $(event.currentTarget).parent().parent().parent().parent().hide();
    $(commentsPlain).hide();
});

$("#link-comentario").click(function(event){
    event.preventDefault();
    $("#link-comment").show();
    $("#foto-comment").hide();
    $("#foto-comentario").val('');
});

$('#link-foto').click(function(event){
    event.preventDefault();
    $('#foto-comment').show();
    $("#link-comment").hide();
    $("#enlace-comentario").val('Enlace');
});

function desaparecer(val)
{
    if(document.getElementById('enlace-comentario').value == 'Enlace')
    {
        document.getElementById('enlace-comentario').value = '';
    }
}

function aparecer(val)
{
    if(document.getElementById('enlace-comentario').value == '')
    {
        document.getElementById('enlace-comentario').value = val;
    }
}

function desaparecer_sub(val, id)
{
    if(document.getElementById('sub-commentario'+id).value == 'Comentar')
    {
        document.getElementById('sub-commentario'+id).value = '';
    }
}

function aparecer_sub(val, id)
{
    if(document.getElementById('sub-commentario'+id).value == '')
    {
        document.getElementById('sub-commentario'+id).value = val;
    }
}

$("#link-comentario").hover(
    function(){
        $("#link-hover").show();
    },
    function(){
        $("#link-hover").hide();
    }
);

$("#link-foto").hover(
    function(){
        $("#foto-hover").show();
    },
    function(){
        $("#foto-hover").hide();
    }
);

$(".mas-apuntados").click(function(event){
    event.preventDefault();
    $(".div-muestra-apuntados").show();
    $(".ocultar-apuntados").show();
    $(event.currentTarget).hide();
});

$(".ocultar-apuntados").click(function(event){
    event.preventDefault();
    $(".mas-apuntados").show();
    $(".div-muestra-apuntados").hide();
    $(event.currentTarget).hide();
});

$(".eliminar-plan").click(function(event){
    event.preventDefault();
    var urlEliminarPulzo = $(event.currentTarget).attr('href');
    $.get(urlEliminarPulzo);
    $(event.currentTarget).parent().parent().parent().parent().hide();
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
    var texto = $("div#menu-derecha").html();
    $("#main-div").html(texto);
});

</script>
<?php echo anchor('planesusuarios/ver/'.$usuario->id, '', array('style'=>'display: none', 'id'=>'enlace')); ?>
<div class="span-14">
<?php if($total != 0): ?>
    <?php foreach($valor as $valores): ?>
        <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB">
            <div class="span-14 last" style="width: 524px"><!-- FONDO -->
                <div class="span-1">
                    <?php echo img(array('src'=>get_avatar($valores->planUsuarioId),
                                         'width'=>'36px',
                                         'height'=>'36px')); ?>
                </div>
                <div class="interlineado span-12 last"><!-- DIV DEL CUERPO DEL POSTEO EN EL WALL **INICIO** -->
                    <div style="margin-left: 10px">
                        <span class="pulzos_titulo1">
                            <?php echo anchor('usuarios/perfil/'.$valores->planUsuarioId,
                                               get_complete_username($valores->planUsuarioId),
                                               array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                        </span>
                    </div>
                    <div style="margin-top: 6px; margin-left: 10px; word-wrap: break-word">
                        <span class="pulzos_titulo2">
                            <?php echo $valores->planDescripcion; ?>
                        </span>
                    </div>
                    <div style="margin-top: 3px; margin-left: 10px; word-wrap: break-word">
                        <?php $total = count_number_register($valores->planId, 'anexos'); ?>
                        <?php if($total != 0): ?>
                            <?php $tipo = count_type_register($valores->planId, 'anexos'); ?>
                            <?php if($tipo->enlace != ''): ?>
                                <span class="pulzos_titulo2" style="">
                                    <?php $link = get_hipereference($valores->planId); ?>
                                    <?php echo anchor('http://'.$link->enlace, $link->enlace, array('target'=>'_blank')); ?>
                                </span>
                            <?php else: ?>
                                <span class="pulzos_titulo2" style="color: #606060">
                                    <?php echo img(array('src'=>$tipo->foto,
                                                         'width'=>'100',
                                                         'height'=>'85')); ?>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="span-14 last" style="margin-top: 8px;"><!-- DIV DE LA PARTE DEL MENU **INICIO** -->
                        <div class="span-1" style="margin-left: 10px">
                            <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                 'width'=>'16',
                                                 'height'=>'12')); ?>
                        </div>
                        <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                            <?php $fecha = unix_to_human($valores->planFechaCreacion);
                                  $fechaCreacion = fecha_acomodo($fecha);
                                  echo $fechaCreacion; ?>
                        </div>
                        <!-- MENU DE USUARIOS PARA PODER ELIMINAR O APUNTARSE AL COMENTARIO **INICIO** -->
                        <?php if($this->session->userdata('id') != $valores->planUsuarioId): ?>
                            <div class="prepend-4 span-2">
                                <?php echo anchor('#',
                                                  'Comentar',
                                                  array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$valores->planId, 'class'=>'comentar-plan')); ?>
                            </div>
                            <div class="span-2">
                                <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $valores->planId); ?>
                                <?php if($numeroUsuario == 0): ?>
                                    <?php echo anchor('planesusuarios/me_apunto/'.$valores->planId.'/'.$this->session->userdata('id'),
                                                      'Me apunto',
                                                      array('style'=>'text-decoration: none; color: #8D6E98;', 'id'=>$valores->planId, 'class'=>'apuntar')); ?>
                                <?php else: ?>
                                    <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$valores->planId,
                                                      'No voy',
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>$valores->planId, 'class'=>'novoy')); ?>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="prepend-4 span-2">
                                <?php echo anchor('#',
                                                  'Comentar',
                                                  array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$valores->planId, 'class'=>'comentar-plan')); ?>
                            </div>
                            <div class="span-3 last" style="margin-left: -5px">
                                <?php echo anchor('planesusuarios/borrar_comentario/'.$valores->planId,
                                                  'Eliminar',
                                                  array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'eliminar', 'name'=>$valores->planId)); ?>
                            </div>
                        <?php endif; ?>
                        <!-- MENU DE USUARIOS PARA PODER ELIMINAR O APUNTARSE AL COMENTARIO **FIN** -->
                    </div><!-- DIV DE LA PARTE DEL MENU **FIN** -->
                    <div class="prepend-1 span-10" style="margin-left: 10px" id="meapunto"><!-- DIV PARA LOS MENSAJES DE ME APUNTO **INICIO** -->
                        <?php $total = total_register($valores->planId); ?><!-- VALIDACION PARA APUNTARSE A ESTO -->
                        <?php if($total != 0): ?><!-- CHECAR SU HAY REGISTROS -->
                            <?php if($total == 1): ?>
                                <?php $val = get_point_simple($valores->planId); ?>
                                <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                  get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?> se ha apuntado.
                            <?php elseif($total == 2): ?>
                                <?php $apuntado = get_point($valores->planId); ?>
                                <?php $i = 1; ?>
                                <?php foreach($apuntados as $meapunto): ?>
                                    <?php if($i == 2): ?>
                                        <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                          get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?> se han apuntado.
                                        <?php break; ?>
                                    <?php endif; ?>
                                    <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> y
                                    <?php $i = $i + 1; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php $apuntados = get_point($valores->planId); ?>
                                <?php $i = 1; ?>
                                <?php foreach($apuntados as $meapunto): ?>
                                    <?php if($i == 2): ?>
                                        <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                          get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        <?php echo anchor('#',
                                                          'Ver todos',
                                                          array('class'=>'mas-apuntado', 'style'=>'text-decoration: none; margin-left: 10px; color: #8D6E98')); ?>
                                        <?php echo anchor('#',
                                                          'ocultar todos',
                                                           array('class'=>'ocultar-apuntados', 'style'=>'text-decoration: none; margin-left: 10px; color: #8D6E98; display: none')); ?>
                                    <?php endif; ?>
                                    <?php if($i == 3): ?>
                                        <?php $contarTodos = get_count_pointed($meapunto->meApuntoId); ?>
                                        <?php $number_register = $contarTodos - 2; ?>
                                        <?php $menosDos = get_count_remaining($meapunto->meApuntoPlanId, $number_register); ?>
                                        <div class="div-muestra-apuntado span-10" style="display: none">
                                            <?php foreach($menosDos as $restantes): ?>
                                                <?php echo anchor('usuarios/perfil/'.$restantes->meApuntoUsuarioApuntadoId,
                                                                  get_complete_username($restantes->meApuntoUsuarioApuntadoId),
                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                            <?php endforeach; ?>
                                        <div>
                                        <?php break; ?>
                                    <?php endif; ?>
                                    <?php if($i == 1): ?>
                                        <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                          get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'mas-apuntados')); ?>
                                    <?php endif; ?>
                                    <?php $i = $i + 1; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div><!-- DIV PARA LOS MENSAJES DE ME APUNTO **FIN** -->
                </div><!--  DIV DEL CUERPO DEL POSTEO EN EL WALL **FIN** -->
                </div><!-- FONDO -->
            <!-- COMENTARIOS QUE SE HAN HECHO **INICIO** -->
            <div class="comentarios<?php echo $valores->planId; ?>">
                <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                    <?php $comentarios = get_subcomments_wall($valores->planId, '1'); ?>
                    <?php foreach($comentarios as $comentario): ?>
                       <div class="span-12 last" style="background-color: #DCCEDD; margin-left: 50px; margin-bottom: 10px">
                            <div class="span-11"><!-- DIV INICIAL DEL SUBCOMENTARIOS **INICIO** -->
                                <div class="span-1">
                                    <?php echo img(array('src'=>get_avatar($comentario->id),
                                                          'width'=>'36',
                                                          'height'=>'36')); ?>
                                </div>
                                <div class="span-9 last" style="margin-top: 14px; margin-left: 14px">
                                    <span class="pulzos_titulo1">
                                        <?php echo anchor('usuarios/perfil/'.$comentario->id,
                                                          get_complete_username($comentario->id),
                                                          array('style'=>'text-decoration: none', 'class'=>'pulzos_titulo1')); ?>
                                    </span>
                                    <br />
                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                        <?php echo $comentario->comentarioSimple; ?>
                                    </span>
                                </div>
                                <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                    <div class="span-1" style="margin-left: 20px">
                                        <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                             'width'=>'14',
                                                             'height'=>'12')); ?>
                                    </div>
                                    <div class="span-4">
                                        <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);
                                              $fechaCreacionSub = fecha_acomodo($fecha);
                                              echo $fechaCreacionSub; ?>
                                    </div>
                                </div>
                            </div><!-- DIV INICIAL DE SUBCOMENTARIOS INICIO **FIN** -->
                            </div>
                    <?php endforeach; ?>
                </div>
                    </div>
            <!-- COMENTARIOS QUE SE HAN HECHO **FIN** -->
            <!-- FORMULARIOS DE COMENTARIOS **INICIO** -->
            <div class="comentarios-<?php echo $valores->planId; ?> prepend-1 span-8 last" style="display: none">
                <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$valores->planId.'/'.$usuario->id,
                                     array('class'=>'forma-comentar-muro'.$valores->planId)); ?>
                    <div class="span-8" style="margin-left: 6px">
                        <?php echo form_textarea(array('id'=>'sub-commentario'.$valores->planId,
                                                       'class'=>'secondary-comment'.$valores->planId,
                                                       'style'=>'width: 470px; height: 23px; color: #999999',
                                                       'onkeypress'=>'subcomentar_enter(event,' . $valores->planId . ')',
                                                       'onfocus'=>"return desaparecer_sub('Comentar'," . $valores->planId . ")",
                                                       'onblur'=>"return aparecer_sub('Comentar'," . $valores->planId . ")",
                                                       'value'=>'Comentar',
                                                       'name'=>'comentar_muro')); ?>
                    </div>                        
                <?php echo form_close(); ?>
            </div>
            <!-- FORMULARIOS DE COMENTARIOS **FIN** -->
        </div>
    <?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>
