<?php
/**
 * Vista que se usa para ver el pulzo del usuario
 * individualmente con el cual se podra ver
 * con mas detalle que es lo que se tiene que hacer
 * por parte de los amigos
 **/

?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
  
    $("#si-pulzo").click(function(event){
        event.preventDefault();
        $("#si-pulzaran").show();
    });

    $("#si-pulzan-cerrar").click(function(event){
        event.preventDefault();
        $("#si-pulzaran").hide();
    });

    $("#no-pulzo").click(function(event){
        event.preventDefault();
        $("#no-pulzaran").show();
    });

    $("#no-pulzan-cerrar").click(function(event){
        event.preventDefault();
        $("#no-pulzaran").hide();
    });

    $("#si-pulzan").click(function(event){
        event.preventDefault();
        siPulzan = $(this).attr("href");
        $.get(siPulzan);
        imagen = $("#val").attr("src");
       
        $("#si").html("<img src='" + imagen + "' width=30 height=30 >");
        $("#opciones-pulzar").hide();
        
    });

    $("#no-pulzan").live('click',function(event){
        event.preventDefault();
        noPulzan = $(this).attr("href");
        $.get(noPulzan);
        imagen = $("#val").attr("src");
        $("#no").html("<img src='" + imagen + "' width=30 height=30 >");
        $("#opciones-pulzar").hide();
       
    });

    $(".comentar-comentario").click(function(event){
        event.preventDefault();
        idComments = $(event.currentTarget).attr('id');
        nombreDiv = ".comentarios-" + idComments;
        $(nombreDiv).show();
    });

    //ENVIAR FORMA Y RECARGAR PANTALLA
    $("#formaPrincipal").submit(function(event){
        event.preventDefault();
     
        var opciones = {
            success: cargarVista
        }
       
        $(this).ajaxSubmit(opciones);
        return false;
    });

    $(".form-secundaria").submit(function(event){
        event.preventDefault();
        var opciones2 = {
            success: cargarVista2
        }
        $(event.currentTarget).ajaxSubmit(opciones2);
        return false;
    });

    function cargarVista()
    {
        urlReload = $("#link-reload").attr("href");
        location.href = urlReload;
    }

    function cargarVista2(){
        urlReload = $("#link-reload").attr("href");
        location.href = urlReload;
    }
});
   

function quitarTexto(val)
{
    if(document.getElementById('main-comment').value == 'Comentar')
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
</script>
<?php echo anchor('planesusuarios/ver_plan/'.$plan->planId,
    '', array('id'=>'link-reload', 'style'=>'display: none')); ?>
<?php echo img(array('src'=>get_avatar($this->session->userdata('id')),
                     'id'=>'val',
                     'style'=>'display: none')); ?>
<div class="span-24 last"><!-- DIV PRINCIPAL DE LA VISTA **INICIO** -->
    <div class="span-4"><!-- DIV DE LA IZQUIERDA **INICIO** -->
        <center>
            <div class="span-4 last" style="margin-top: 12px; margin-bottom: 20px">
                <?php if($plan->planEsEmpresa == '0'): ?>
                    <?php if($plan->planImagenId == '0'): ?>
                        <?php echo img(array('src'=>'statics/img/default/planes.jpg',
                                             'class'=>'foto-medidas'
                                             )); ?>
                    <?php else: ?>
                        <?php echo img(array('src'=>get_avatar_plan($plan->planId),
                                             'class'=>'foto-medidas'
                                            )); ?>
                    <?php endif; ?>
                <?php else: ?>  
                    <?php echo img(array('src'=>get_avatar_negocios($plan->planIdEmpresa),
                                         'class'=>'foto-medidas')); ?>
                <?php endif; ?>
            </div>
        </center>
       
    </div><!-- DIV DE LA IZQUIERDA **FIN** -->
    <div class="span-20 last" style="background-color: #F0F0F0;"><!-- DIV CONTENEDOR DE TODO EL CUERPO Y DERECHA -->
        <div class="span-14" style="margin-top: 15px; margin-left: 20px"><!-- DIV DE LA PARTE CENTRAL **INICIO** -->
            <div class="span-13 last" style="">
                <div class="pulzos_titulo1 span-2">
                    Lugar:
                </div>
                <div class="pulzos_titulo2 prepend-1 span-9 last">
                    <?php echo $plan->planLugar; ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="pulzos_titulo1 span-2">
                    Pulza:
                </div>
                <div class="pulzos_titulo2 prepend-1 span-9 last">
                    <?php echo get_complete_username($plan->planUsuarioId); ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="pulzos_titulo1 span-2">
                    Inicia:
                </div>
                <div class="pulzos_titulo2 prepend-1 span-9 last">
                    <?php $fechaI = unix_to_human($plan->planFechaInicio);
                          $correctaI = fecha_acomodo($fechaI);
                          echo $correctaI . " - " . $plan->planHoraInicio; ?>
                </div>
            </div>
           
                    <?php $fechaF = unix_to_human($plan->planFechaFin);
                          $correctaF = fecha_acomodo($fechaF);
                          echo $correctaF . " - " . $plan->planHoraFin; ?>
                
            <div class="span-13 last">
                <div class="pulzos_titulo1 span-3">
                    Descripci&oacute;n:
                </div>
                <div class="pulzos_titulo2 span-10 last">
                    <?php echo $plan->planDescripcion; ?>
                </div>
            </div>
            <div class="span-13 last">
                <div class="pulzos_titulo1 span-3">
                    Direcci&oacute;n:
                </div>
                <div class="pulzos_titulo2 span-10 last">
                    <?php echo $plan->planDireccion; ?>
                </div>
            </div>
            <?php $val2 = get_user_creator($usuario->id, $plan->planId); ?><!-- VALIDACION PRIMARIA **INICIO** -->
            <?php $im_invited = im_invitated($usuario->id, $plan->planId); ?><!-- VALIDA SI HAY INVITACION AL EVENTO -->
            <?php if($im_invited != 0): ?>
                <?php if($val2 == 0): ?>
                    <?php $valInterno = get_status_invitation($usuario->id, $plan->planId); ?><!-- VALIDACION SECUNDARIA **INICIO** -->
                    <?php //var_dump($valInterno); ?>
                    <?php if($valInterno->invitacionPersonalAceptadoId == 0): ?>
                        <div id="opciones-pulzar" class="span-13 last" style="margin-top: 50px">
                            <div class="prepend-9 span-2" style="margin-left: 16px">
                                <?php echo anchor('planesusuarios/status_planes/'.$usuario->id.'/1/'.$plan->planId,
                                                  img(array('src'=>'statics/img/sipulzo.png',
                                                            'width'=>'54',
                                                            'height'=>'21')), array('id'=>'si-pulzan')); ?>
                            </div>
                            <div class="span-2 last" style="margin-left: -16px">
                                <?php echo anchor('planesusuarios/status_planes/'.$usuario->id.'/2/'.$plan->planId,
                                                  img(array('src'=>'statics/img/nopulzo.png',
                                                            'width'=>'54',
                                                            'height'=>'21')), array('id'=>'no-pulzan')); ?>
                            </div>
                        </div>
                    <?php endif; ?><!-- VALIDACION SECUNDARIA **FIN** -->
                <?php endif; ?><!-- VALIDACION PRIMARIA **FIN** -->
            <?php endif; ?><!-- VALIDA SI HAY INVITACION AL EVENTO **FIN** -->
            <div class="span-13" style="margin-top: 10px; display: none" id="si-pulzaran"><!-- PARTE DE LOS SI PULZAN -->
                <?php $siPulzaran = get_people_pulzan($plan->planId); ?>
                <div class="span-13" style="margin-left: 10px">
                    <div class="span-8" style="color: #339900; margin-top: 5px; font-weight: bold; margin-bottom: 5px">
                        Si pulzan
                    </div>
                    <div class="prepend-12 last" style="margin-left: 10px">
                        <?php echo anchor('#',
                                          img(array('src'=>'statics/img/cerrar.jpg',
                                                    'width'=>'12px',
                                                    'height'=>'12px')),
                                              array('id'=>'si-pulzan-cerrar')); ?>
                    </div>
                </div>
                <?php foreach($siPulzaran as $pulzaranSi): ?>
                    <div class="span-1">
                        <?php echo anchor('usuarios/perfil/'.$pulzaranSi->invitacionInvitadoPersonalId,
                                           img(array('src'=>get_avatar($pulzaranSi->invitacionInvitadoPersonalId),
                                                     'width'=>'37',
                                                     'height'=>'37',
                                                     'title'=>get_complete_username($pulzaranSi->invitacionInvitadoPersonalId))),
                                                array('id'=>'', 'style'=>'text-decoration: none; border: none')); ?>
                    </div>
                <?php endforeach; ?>
            </div><!-- PARTE DE LOS SI PULZAN -->
            <div class="span-13" style="margin-top: 10px; display: none" id="no-pulzaran"><!-- PARTE DE LOS NO PULZAN -->
            <?php $noPulzaran = get_people_no_pulzan($plan->planId); ?>
                <div class="span-13" style="margin-left: 10px">
                    <div class="span-8" style="color: #339900; margin-top: 5px; font-weight: bold; margin-bottom: 5px">
                        No pulzan
                    </div>
                    <div class="prepend-12 last" style="margin-left: 10px">
                        <?php echo anchor('#',
                                          img(array('src'=>'statics/img/cerrar.jpg',
                                                    'width'=>'12px',
                                                    'height'=>'12px')),
                                              array('id'=>'no-pulzan-cerrar', 'style'=>'text-decoration: none; border: none')); ?>
                    </div>
            </div>
            <?php foreach($noPulzaran as $pulzaranNo): ?>
                <div class="span-1">
                    <?php echo anchor('usuarios/perfil/'.$pulzaranNo->invitacionInvitadoPersonalId,
                                      img(array('src'=>get_avatar($pulzaranNo->invitacionInvitadoPersonalId),
                                                'width'=>'37',
                                                'height'=>'37',
                                                'title'=>get_complete_username($pulzaranNo->invitacionInvitadoPersonalId))),
                                          array('id'=>'', 'style'=>'text-decoration: none; border: none')); ?>
                </div>
            <?php endforeach; ?>
        </div><!-- PARTE DE LO NO PULZAN -->
        <div class="span-13 prepend-top last"><!--DIV DEL FORMULARIO PARA COMENTAR EL PLAN **INICIO** -->
            <?php echo form_open('planesusuarios/comentarios_plan_simple/'.$plan->planId.'/'.$this->session->userdata('id'),//$usuario->id,
                                 array('id'=>'formaPrincipal', 'class'=>'')); ?>
                <div class="span-13">
                    <?php echo form_textarea(array('id'=>'main-comment',
                                                   'class'=>'area-textoPublicar',
                                                   'name'=>'comentarios_planes',
                                                   'style'=>'width: 524px; height: 16px; border: 1px solid',
                                                   'onfocus'=>"return quitarTexto('Comentar')",
                                                   'onblur'=>"return ponerTexto('Comentar')",
                                                   'value'=>'Comentar')); ?>
                </div>
                <div class="prepend-11 last" style="margin-top: 8px">
                    <?php echo form_submit(array('id'=>'',
                                                 'class'=>'comment-submit',
                                                 'value'=>'',
                                                 'style'=>'margin-left:10px')); ?>
                </div>
            <?php echo form_close(); ?>
        </div><!-- DIV DEL FORMULARIO PARA COMENTAR EL PLAN **FIN** -->
        <?php $comentarios = get_all_comments_plains($plan->planId); ?><!--INICIO DE MOSTRAR COMENTARIOS -->
  
        <div class="span-14 last" id="comentarios-plan-simple" style="margin-top: 10px; margin-bottom: 10px;">

            <?php foreach($comentarios as $comments): ?><!-- FOREACH DE COMENTARIOS **INICIO** -->
                <div class="span-13 last" style="margin-top: 15px; background-color: #DCCEDD">
                    <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                        <?php echo img(array('src'=>get_avatar($comments->comentarioSimpleUsuarioId),
                                             'width'=>'36',
                                             'height'=>'36')); ?>
                    </div>
                    <div class="span-11 last" style="margin-left: 10px; margin-top: 3px">
                        <?php echo anchor('usuarios/perfil/'.$comments->comentarioSimpleUsuarioId,
                                          get_complete_username($comments->comentarioSimpleUsuarioId),
                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                    </div>
                    <div class="span-11 last" style="margin-top: 3px; margin-left: 10px">
                        <div class="pulzos_titulo2 span-9 last">
                            <?php echo $comments->comentarioSimple; ?>
                        </div>
                        <?php $total = get_likes_total($comments->comentarioSimpleId); ?>
                        <div class="span-9 last" style="margin-top: 20px">
                            <div class="span-1">
                                <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                     'width'=>'14',
                                                     'height'=>'12')); ?>
                            </div>
                            <div class="span-4" style="margin-left: -20px; margin-top: 1px; font-size: 9pt; color: #999999">
                                <?php
                                    $fecha = unix_to_human($comments->comentarioFechaCreacion);
                                    $fecha_comentario = fecha_acomodo($fecha);
                                    echo $fecha_comentario;
                                 ?>
                            </div>
                            <div class="prepend-9 last" style="margin-top: 0px">
                                
                            </div>
                        </div>
                            
                            <?php echo form_open('planesusuarios/subcomentarios_plan_simple/'.$plan->planId.'/'.$usuario->id.'/'.$comments->comentarioSimpleId,
                                                 array('class'=>'form-secundaria', 'id'=>'')); ?>
                                
                                    <?php echo form_textarea(array('id'=>'',
                                                                   'class'=>'',
                                                                   'name'=>'subcomentarios_planes',
                                                                   'cols'=>'25',
                                                                   'rows'=>'2',
                                                                   'style'=>'margin-left: -10px')); ?>
                               
                                    <?php echo form_submit(array('id'=>'',
                                                                 'class'=>'',
                                                                 'value'=>'comentar',
                                                                 'style'=>'margin-top: 10px')); ?>
                            
                            <?php echo form_close(); ?>
                     
                    </div>
                    <div>
                        <div class="prepend-1" style="margin-top: 30px; margin-left: -50px">
                            <?php $subcomments = get_subcomments_plains($comments->comentarioSimplePlanId, '1', $comments->comentarioSimpleId); ?>
                            <?php foreach($subcomments as $subcomentario): ?><!-- FOREACH DE SUBCOMENTARIOS **INICIO** -->
                                <div class="span-9 last">
                                    <div class="span-2 last">
                                        <?php echo img(array('src'=>get_avatar($subcomentario->comentarioSimpleUsuarioId),
                                                             'width'=>'60',
                                                             'height'=>'60')); ?>
                                    </div>
                                    <div class="prepend-1 span-6 last">
                                        <div class="span-6 last">
                                            <?php echo $subcomentario->comentarioSimple; ?>
                                        </div>
                                        <?php $totalS = get_likes_total($subcomentario->comentarioSimpleId); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?><!-- FOREACH DE SUBCOMENTARIOS **FIN** -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?><!-- FOREACH DE COMENTARIOS **FIN** -->
        </div><!-- FIN DE MOSTRAR COMENTARIOS **FIN** -->
    </div><!-- DIV DE LA PARTE CENTRAL **FIN -->
    <div class="span-5 last" style="background-color: #DED2DE"><!-- DIV DE LA DERECHA **INICIO** -->
        <div class="span-5 last" style="margin-top: 28px">
            <div class="soft-header">
                <strong>
                    Si Pulzan
                </strong>
                <span class="right ver-todo-link" style="margin-right: 3px">
                    <?php echo anchor('#',
                                      'ver mas', array('id'=>'si-pulzo', 'class'=>'links')); ?>
                </span>
            </div>
            <div class="span-5 last">
                <?php $sipulzan = get_info_plains($plan->planId, '1'); ?>
                <?php foreach($sipulzan as $pulzan): ?>
                    <div class="span-1" style="margin-left: 5px; margin-top:5px">
                        <?php echo img(array('src'=>get_avatar($pulzan->invitacionInvitadoPersonalId),
                                             'width'=>'30',
                                             'height'=>'30',
                                             'title'=>get_complete_username($pulzan->invitacionInvitadoPersonalId))); ?>
                    </div>
                <?php endforeach; ?>
                <div id="si" class="span-1" style="margin-left: 5px; margin-top: 5px"></div>
            </div>
        </div>
        <div class="span-5 last" style="margin-top: 15px">
            <div class="soft-header">
                <strong>
                    No pulzan
                </strong>
                <span class="right ver-todo-link" style="margin-right: 3px">
                    <?php echo anchor('#',
                                      'ver mas', array('id'=>'no-pulzo', 'class'=>'links')); ?>
                </span>
            </div>
            <div class="span-5 last">
                <?php $noPulzan = get_info_plains($plan->planId, '2'); ?>
                <?php foreach($noPulzan as $pulzan): ?>
                    <div class="span-1" style="margin-left: 5px; margin-top: 5px">
                        <?php echo img(array('src'=>get_avatar($pulzan->invitacionInvitadoPersonalId),
                                             'width'=>'30',
                                             'height'=>'30',
                                             'title'=>get_complete_username($pulzan->invitacionInvitadoPersonalId))); ?>
                    </div>
                <?php endforeach; ?>
                <div id="no" class="span-1" style="margin-left: 5px; margin-top: 5px"></div>
            </div>
        </div>
    </div><!-- DIV DE LA DERECHA **FIN** -->
    </div><!-- DIV CONTENEDOR DE TODO EL CUERPO Y DERECHA -->
</div><!-- DIV PRINCIPAL DE LA VISTA -->

<?php 
