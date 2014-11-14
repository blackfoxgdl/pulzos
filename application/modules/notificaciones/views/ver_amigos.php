<?php
/**
 * Se muestra ya de forma personalizada
 * los datos del pulzo que es de interes por
 * parte del usuario asi como los mismos datos
 * personales del usuario
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, May 11, 2011
 * @package notificaciones
 **/
?>
 <script type="text/javascript">
    $(".comentar-plan").click(function(event){
        event.preventDefault();
        idComentario = $(event.currentTarget).attr('id');
        nombreDiv = ".comentarios-"+idComentario;
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

    function cargarVista()
    {
        url = $("#regresa").attr('href');
        $("#texto-menu").load(url);
    }

$(".apuntar").click(function(event){
    event.preventDefault();
    apuntar = $(event.currentTarget).attr('href');
    idapuntar = $(event.currentTarget).attr('name');
    idSi = "#Si"+idapuntar;
    idNo = "#No"+idapuntar;
    $.get(apuntar);
    $(idSi).hide();
    $(idNo).show();
    $("#apuntados"+idapuntar).show();
});

$(".novoy").click(function(event){
    event.preventDefault();
    var no_voy = $(event.currentTarget).attr('href');
    idapuntar2 = $(event.currentTarget).attr('name');
    idNo2 = "#No"+idapuntar2;
    idSi2 = "#Si"+idapuntar2;
    $(idNo2).hide();
    $(idSi2).show();
    $.get(no_voy);
    $("#texto-menu").load($("#enlace").attr('href'));
    $("#texto-menu").load($("#enlace").attr('href'));
});

    $(".eliminar").click(function(event){
        event.preventDefault();
        var deleteComment = $(event.currentTarget).attr('href');
        var numId = $(event.currentTarget).attr('href');
        var comments = ".comentarios"+numId;
        $.get(deleteComment);
        $(event.currentTarget).parent().parent().parent().parent().hide();
        $(comments).hide();
        $("#texto-menu").load($('#regresa').attr('href'));
    });

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
            document.getElementById('sub-commentario'+id).value = 'Comentar';
        }
    }
</script>
<?php echo anchor('notificaciones/ver/'.$notificacion->notificacionId.'/'.$notificacion->notificacionPlanId, '', array('style'=>'display: none', 'id'=>'enlace')); ?>
<?php echo anchor('notificaciones/index/'.$notificacion->notificacionUsuarioId, '', array('style'=>'display: none', 'id'=>'regresa')); ?>
<div class="span-14 last"><!-- DIV PRINCIPAL **INICIO** -->
    <div class="span-13" style="margin-top: 10px">
        <div class="span-14"><!-- DIV DE DONDE SE MUESTRA EL COMENTARIO **INICIO** -->
            <div class="span-1">
                <?php $status = get_status_user($notificacion->planAmigoUsuarioId);?>
                    <?php if($status == 0): ?>
                        <?php echo anchor('usuarios/perfil/'.$notificacion->planAmigoUsuarioId,
                                          img(array('src'=>get_avatar($notificacion->planAmigoUsuarioId),
                                                    'width'=>'37',
                                                    'height'=>'37',
                                                    'title'=>get_complete_username($notificacion->planAmigoUsuarioId))),
                                          array('style'=>'text-decoration: none;')); ?>
                    <?php else: ?>
                        <?php $datosNeg = get_data_company($notificacion->planAmigoUsuarioId); ?>
                        <?php echo anchor('negocios/perfil/'.$datosNeg->negocioId,
                                            img(array('src'=>get_avatar_negocios($datosNeg->negocioId),
                                                      'width'=>'37',
                                                      'height'=>'37',
                                                      'title'=>get_complete_username($notificacion->planAmigoUsuarioId))),
                                            array('style'=>'text-decoration: none;')); ?>
                    <?php endif; ?>
            </div>
            <div class="interlineado span-12 last" style="margin-top: 3px; color: #8D6E98"><!-- DIV DE LA PARTE DEL CUERPO DEL COMENTARIO SIMPLE **INICIO** -->
                <div style="margin-left: 10px">
                    <?php if($status == 0): ?>
                        <span class="pulzos_titulo1">
                            <?php echo anchor('usuarios/perfil/'.$notificacion->planAmigoUsuarioId,
                                              get_complete_username($notificacion->planAmigoUsuarioId),
                                              array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none')); ?>
                        </span>
                        a
                        <span>
                            <?php echo anchor('usuarios/perfil/'.$notificacion->notificacionUsuarioId,
                                              get_complete_username($notificacion->planUsuarioId),
                                              array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none')); ?>
                        </span>
                    <?php else: ?>
                        <span class="pulzos_titulo1">
                            <?php echo anchor('negocios/perfil/'.$datosNeg->negocioId,
                                              get_complete_username($notificacion->planAmigoUsuarioId),
                                              array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none')); ?>
                        </span>
                        a
                        <span>
                            <?php echo anchor('usuarios/perfil/'.$notificacion->notificacionUsuarioId,
                                              get_complete_username($notificacion->planUsuarioId),
                                              array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none')); ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div style="margin-top: 6px; margin-left: 10px; word-wrap: break-word;">
                    <span class="pulzos_titulo2" style="color: #606060">
                        <?php echo $notificacion->planDescripcion; ?>
                    </span>
                </div>
                <div style="margin-left: 3px; margin-left: 10px; word-wrap: break-word">
                    <?php $total = count_number_register($notificacion->planId, 'anexos'); ?>
                    <?php if($total != 0): ?>
                        <?php $tipo = count_type_register($notificacion->planId, 'anexos'); ?>
                        <?php if($tipo->enlace != ''): ?>
                           <span class="pulzos_titulo2" style="color: #606060">
                                                            <?php $link = get_hipereference($notificacion->planId); ?>
                                                            <?php $return_value = http_request($link->enlace);($return_value==FALSE)?$link->enlace='http://'.$link->enlace:'';
                                                            $divPages=explode('http://',$link->enlace);$page=explode('/',$divPages[1]);$pageMain=$page[0];
                                                            if($pageMain=='vimeo.com'){
                                                                    $pageV=explode('http://vimeo.com/',$link->enlace);?>
                                                                    <iframe src="http://player.vimeo.com/video/<?php echo $pageV[1];?>" width="460" height="290" frameborder="0"></iframe> <?php
                                                            }else if($pageMain=='www.youtube.com'){
                                                                        $lkSharp=explode('&',$link->enlace);
                                                                        $linkY=explode('=',$lkSharp[0]);$id=$linkY[1];$len=strlen($id);
                                                                        for($i=0;$i<$len;$i++){($id[$i]=='&')?$idV=explode('&',$id):'';} ?>
                                                                     <iframe class="youtube-player" type="text/html" width="460" height="290" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe>
                                             <?php 
                                                            }else{
                                                                    echo anchor($link->enlace, $link->enlace, array('target'=>'_blank'));
                                                            }
                                                             ?>
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
            </div><!-- DIV DE LA PARTE DEL CUERPO DEL COMENTARIO SIMPLE **FIN* -->
            <div class="prepend-1 span-14 last" style="margin-top: 8px"><!-- DIV DE LA PARTE DEL MENU **INICIO** -->
                <div class="span-1" style="margin-left: 10px">
                    <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                         'width'=>'16',
                                         'height'=>'12')); ?>
                </div>
                <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                    <?php $fecha = unix_to_human($notificacion->planFechaCreacion);
                          $fechaCreacion = fecha_acomodo($fecha);
                          echo $fechaCreacion; ?>
                </div>
                <!-- MENU DE USUARIOS PARA PODER ELIMINAR O APUNTARSE AL COMENTARIO **INICIO** -->
                <?php if($this->session->userdata('id') != $notificacion->planUsuarioId): ?>
                    <div class="prepend-4 span-2">
                        <?php echo anchor('#',
                                          'Comentar',
                                          array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$notificacion->planId, 'class'=>'comentar-plan')); ?>
                    </div>
                    <div class="span-2">
                        <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $notificacion->planId); ?>
                        <?php if($numeroUsuario == 0): ?>
                            <?php echo anchor('planesusuario/me_apunto/'.$notificacion->planId.'/'.$this->session->userdata('id'),
                                              'Me Apunto',
                                              array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>"Si".$notificacion->planId, 'class'=>'apuntar', 'name'=>$notificacion->planId)); ?>
                            <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$notificacion->planId.'/'.$notificacion->planUsuarioId,
                                              'No voy',
                                              array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>"No".$notificacion->planId, 'class'=>'novoy', 'name'=>$notificacion->planId)); ?>
                        <?php else: ?>
                            <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$notificacion->planId.'/'.$notificacion->planUsuarioId,
                                              'No voy',
                                              array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>"No".$notificacion->planId, 'class'=>'novoy', 'name'=>$notificacion->planId)); ?>
                            <?php echo anchor('planesusuario/me_apunto/'.$notificacion->planId.'/'.$this->session->userdata('id'),
                                              'Me Apunto',
                                              array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>"Si".$notificacion->planId, 'class'=>'apuntar', 'name'=>$notificacion->planId)); ?>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="prepend-4 span-2">
                        <?php echo anchor('#',
                                          'Comentar',
                                           array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$notificacion->planId, 'class'=>'comentar-plan')); ?>
                    </div>
                    <div class="span-3 last" style="margin-left: -5px">
                        <?php echo anchor('planesusuarios/borrar_comentario/'.$notificacion->planId.'/'.$notificacion->notificacionId,
                                          'Eliminar',
                                          array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'eliminar', 'name'=>$notificacion->planId)); ?>
                    </div>
                <?php endif; ?>
                <!-- MENU DE USUARIOS PARA PODER ELIMINAR O APUNTARSE AL COMENTARIO **FIN** -->
                <div class="prepend-1 span-10" style="margin-left: 10px" id="meapunto"> <!-- DIV PARA LOS MENSAJES DE ME APUNTO **INICIO** -->
                            <?php $total = total_register($notificacion->planId); ?>
                            <?php if($total != 0): ?>
                                <?php if($total == 1): ?>
                                    <?php $val = get_point_simple($notificacion->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <span id="apuntados<?php echo $notificacion->planId; ?>" style="display: none">
                                            <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> y
                                        </span> 
                                        <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se han apuntado.
                                    </div>
                                <?php elseif($total == 2): ?>
                                    <?php $apuntados = get_point($notificacion->planId); ?> 
                                    <div class="span-12 last" style="color: #8D6E98">
                                            <?php $i = 1; ?>
                                            <?php foreach($apuntados as $meapunto): ?>
                                                <?php if($i == 2): ?>
                                                    <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                                      get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                                                    <?php break; ?>
                                                <?php endif; ?>
                                                <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                                  get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                                <?php $i = $i + 1; ?>
                                            <?php endforeach; ?>
                                            <span id="apuntados<?php echo $notificacion->planId; ?>" style="display: none">
                                                y <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                                            </span> se han apuntado.
                                    </div>
                                <?php else: ?>
                                    <?php $apuntados = get_point($notificacion->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <?php $i = 1; ?>
                                        <?php foreach($apuntados as $meapunto): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                                   get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                                   array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                        <?php endforeach; ?>
                                        <span id="apuntados<?php echo $notificacion->planId; ?>" style="color: #8D6E98; display: none">
                                           <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>  
                                        </span> se han apuntado.
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="span-8 last" style="color: #8D6E98; display: none" id="apuntados<?php echo $notificacion->planId; ?>">
                                    <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                      get_complete_username($this->session->userdata('id')),
                                                      array('style'=>'color: #8D6E98; text-decoration: none')); ?> se ha apuntado
                                </div>
                            <?php endif; ?>
                        </div><!-- DIV PARA LOS MENSAJES DE ME APUNTO **FIN** -->
            </div><!-- DIV DE LA PARTE DEL MENU **FIN** -->
            <div class="comentarios<?php echo $notificacion->planId; ?>">
                <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                    <?php $comentarios = get_subcomments_wall($notificacion->planId, '1'); ?>
                    <?php foreach($comentarios as $comentario): ?><!-- FOREACH DE SUBCOMENTARIOS **INICIO** -->
                        <div class="span-12 last" style="background-color: #DCCEDD; margin-left: 50px; margin-bottom: 10px">
                            <div class="span-11"><!--DIV INICIAL DE LOS SUBCOMENTARIOS **INICIO** -->
                                <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                    <?php echo img(array('src'=>get_avatar($comentario->id),
                                                         'height'=>'36',
                                                         'width'=>'36')); ?>
                                </div>
                                <div class="span-9 last" style="margin-top: 14px; margin-left: 14px">
                                    <span class="pulzos_titulo1">
                                        <?php echo anchor('usuarios/perfil/'.$comentario->id,
                                                          get_complete_username($comentario->id),
                                                          array('style'=>'text-decoration: none','class'=>'pulzos_titulo1')); ?>
                                    </span>
                                    <br />
                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                        <?php echo $comentario->comentarioSimple; ?>
                                    </span>
                                </div>
                                <div class="prepend-1 span-9 last">
                                    <div class="span-1" style="margin-left: 20px">
                                        <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                             'width'=>'14',
                                                             'height'=>'12')); ?>
                                    </div>
                                    <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999">
                                        <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);
                                              $fechaCreacion = fecha_acomodo($fecha);
                                              echo $fechaCreacion; ?>
                                    </div>
                                </div>
                            </div><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **FIN** -->
                        </div>
                    <?php endforeach; ?><!-- FOREACH DE SUBCOMENTARIOS **FIN** -->
                </div>
            </div>
            <!-- FORMULARIO DE COMENTARIOS **INICIO** -->
            <div class="comentarios-<?php echo $notificacion->planId; ?> prepend-1 span-8 last" style="display: none">
                <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$notificacion->planId.'/'.$this->session->userdata('id'),
                                      array('class'=>'forma-comentar-muro'.$notificacion->planId)); ?>
                    <div class="span-8" style="margin-left: 6px">
                        <?php echo form_textarea(array('id'=>'sub-commentario'.$notificacion->planId,
                                                       'class'=>'secondary-comment'.$notificacion->planId,
                                                       'style'=>'width: 470px; height: 23px; color: #999999',
                                                       'onkeypress'=>'subcomentar_enter(event,'. $notificacion->planId . ')',
                                                       'onfocus'=>"return desaparecer_sub('Comentar',".$notificacion->planId.")",
                                                       'onblur'=>"return aparecer_sub('Comentar',".$notificacion->planId.")",
                                                       'value'=>'Comentar',
                                                       'name'=>'comentar_muro')); ?>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <!-- FORMULARIO DE COMENTARIOS **FIN** -->
        </div><!-- DIV DE DONDE SE MUESTRA EL COMENTARIO **FIN** -->
    </div>
</div><!-- DIV PRINCIPAL **FIN** -->
