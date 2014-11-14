<?php
/**
 * vista para mostrar los comentarios personales de cada
 * usuarios con su post principal, esto para poder visualizarlos
 * ya desplegados y no solo los tres anteriores
 **/
?>
<script type="text/javascript">
$(".comentar-plan").click(function(event){
    event.preventDefault();
    idComentario = $(event.currentTarget).attr('id');
    nombreDiv = ".comentarios-" + idComentario;
    $(nombreDiv).show();
});

$(".eliminar-sub").click(function(event){
    event.preventDefault();
    //alert('hola');
    urlDeleteSub = $(event.currentTarget).attr("href");
    $(event.currentTarget).parent().parent().parent().parent().hide();
    $.get(urlDeleteSub);
});

$(".apuntar").click(function(event){
    event.preventDefault();
    //alert("hola");
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
    var deletePlain = $(event.currentTarget).attr("href");
    var numId = $(event.currentTarget).attr("name");
    var commentsPlain = ".comentarios"+numId;
    $.get(deletePlain);
    $(event.currentTarget).parent().parent().parent().parent().hide();
    $(commentsPlain).hide();
});

function subcomentar_enter(event, idplan)
{
    if(event.keyCode == 13)
    {
        //$("#oct"+idplan).focus();
        var accionAtr = $(".forma-comentar-muro"+idplan).attr("action");
        var datosAccion = $(".secondary-comment"+idplan).attr("value");
        //desenfocada inicio
        $(".secondary-comment"+idplan).blur();
        $("#oct"+idplan).val(datosAccion).focus();
        //desenfocada fin
        var clase = "comentarios"+idplan;
        urlReloadC = $("#recarga_comentario").attr("href");
        urlReloadComentario = urlReloadC + '/' + idplan;
        if(datosAccion != "Comentar"){
             $.post(accionAtr, 
                   {comentar_muro:datosAccion},
                   function(data){
                        url = $("#enlace").attr('href');
                        $("#texto-menu").load(url);
                    });
        }
    }
}

function desaparecer_sub(val, id){
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
<div style="display: none">
	<?php echo img(array('src'=>get_avatar($planes->planUsuarioId),
                                                 'width'=>'37px',
                                                 'height'=>'37px')); ?>
</div>
<?php echo anchor('planesusuarios/ver_personal/'.$plan->planId, '', array('style'=>'display: none', 'id'=>'enlace')); ?>
<div class="span-14" style="margin-top: 20px">
        <?php if($plan->planAmigoUsuarioId==0):?>
                                <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB">
                                    <div class="span-14 last" style="width: 524px"><!-- FONDO --> 
                                        <div class="span-1">
                                            <?php echo img(array('src'=>get_thumb_avatar($plan->planUsuarioId)
                                                                 /*get_avatar($plan->planUsuarioId),'width'=>'36','height'=>'36'*/)); ?>
                                        </div>   
                                        <div class="interlineado span-12 last" style="margin-top: 3px"><!-- DIV DEL CUERPO DEL POSTEO EN EL WALL ** INICIO ** -->    
                                            <div style="margin-left: 20px">
                                                <span class="pulzos_titulo1"> 
                                                    <?php echo anchor('usuarios/perfil/'.$plan->planUsuarioId,
                                                                      get_complete_username($plan->planUsuarioId),
                                                                      array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                </span>
                                            </div>
                                            <?php if($plan->planTipo == 8): ?>
                                            	<div style="margin-top: 6px; margin-left: 20px; word-wrap: break-word;">
                                            		<div class="span-13">
						                                <div class="span-7">
                        						            <span class="pulzos_titulo2">
						                                        <?php echo $plan->planDescripcion; ?>
                        						            </span>
						                                </div>
                        						        <?php $coor = get_data_of_coordenade($plan->planScribbleId); ?>
						                                <!-- PARTE DEL SCRIPT PARA EL MAPA DE PULZOS **INICIO**-->
                        						        <script type="text/javascript">
						                                    var latLng = new google.maps.LatLng(<?php echo $coor->scribbleLat; ?>, <?php echo $coor->scribbleLng; ?>);//20.673040, -103.375854);
                        						            var myOptions = {
					    	                                    zoom: 15,
                    						                    center: latLng,
                                	        					mapTypeId: google.maps.MapTypeId.ROADMAP
						                                    };
                                    						var map = new google.maps.Map($(".mapa").get(0), myOptions);
						                                    var markerImage = new google.maps.MarkerImage($("#imagen").attr('src'),
                        		                              new google.maps.Size(34, 32),
                                		                      new google.maps.Point(0, 0),
                                        		              new google.maps.Point(0, 32));
						                                    var marker = new google.maps.Marker({
                        					                    position: latLng,
                                            					map: map,
					                                            icon: markerImage
                    						                });     
						                                </script>
                        						        <!-- PARTE DEL SCRIPT PARA EL MAPA DE PULZOS **FIN**-->
						                                <div class="span-6 last" style="margin-top: 10px; margin-left: 0px">
                        						            <div class="span-8 last" id="mapa_fondo" style="margin-top: -20px">
						                                        <div class="pulzos_titulo1 span-6" style="margin-top: 15px; color: #FFFFFF; text-align:; margin-left: 80px;">
                        						                    ¿D&oacute;nde lo dijo?
						                                        </div>
                        						                <div class="mapa" style="width: 200px; height: 100px; margin-left: 25px; margin-top: 40px"></div>
						                                    </div>
                	        					            
                        						        </div>
                        						    </div>
                                            	</div>
                                            <?php else: ?>
	                                            <div style="margin-top:6px; margin-left: 20px; word-wrap: break-word;">
    	                                            <span class="pulzos_titulo2" style="color: #606060">
        	                                            <?php echo $plan->planDescripcion; ?>
            	                                    </span>
                	                            </div>
                	                        <?php endif; ?>
                                            <div style="margin-top: 3px; margin-left: 10px; word-wrap: break-word;">
                                                <?php $total = count_number_register($plan->planId, 'anexos'); ?> 
                                                <?php if($total != 0): ?>
                                                    <?php $tipo = count_type_register($plan->planId, 'anexos'); ?>
                                                    <?php if($tipo->enlace != ''): ?>
                                                        <span class="pulzos_titulo2" style="color: #606060">
                                                            <?php $link = get_hipereference($plan->planId); ?>
                                                            <?php $return_value = http_request($link->enlace);($return_value==FALSE)?$link->enlace='http://'.$link->enlace:'';
                                                            $divPages=explode('http://',$link->enlace);$page=explode('/',$divPages[1]);$pageMain=$page[0];
                                                            if($pageMain=='vimeo.com'){
                                                                    $pageV=explode('http://vimeo.com/',$link->enlace);?>
                                                                    <iframe src="http://player.vimeo.com/video/<?php echo $pageV[1];?>" width="460" height="290" frameborder="0"></iframe> <?php
                                                            }else if($pageMain=='www.youtube.com'){
                                                                        $lkSharp=explode('&',$link->enlace);
                                                                        $linkY=explode('=',$lkSharp[0]);$id=$linkY[1];$len=strlen($id);
                                                                        for($i=0;$i<$len;$i++){($id[$i]=='&')?$idV=explode('&',$id):'';}/*(isset($idV[0]))?$id=$idV[0]:$id;*/?>
                                                                     <iframe class="youtube-player" type="text/html" width="460" height="290" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe>
                                             <?php 
                                                            }else if($pageMain=='youtu.be'){
                                                                $lkSharp=explode('http://youtu.be/',$link->enlace);$id=$lkSharp[1];?>
                                                                <iframe class="youtube-player" type="text/html" width="460" height="290" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe> <?php
                                                            }else if($pageMain == 'www.goear.com'){
                                                                $lnkSharp= explode('/listen/', $link->enlace); $lnkSharp2=explode('/',$lnkSharp['1']);$id=$lnkSharp2[0]; ?>
                                                                <object width="353" height="132"><embed src="http://www.goear.com/files/external.swf?file=<?php echo $id; ?>" type="application/x-shockwave-flash" wmode="transparent" quality="high" width="353" height="132"></embed></object><?php
                                                            }else{
                                                                    echo anchor($link->enlace, $link->enlace, array('target'=>'_blank'));
                                                            }
                                                             ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="pulzos_titulo2" style="color: #606060">
                                                            <a href="<?php echo base_url().$tipo->foto; ?>" class="lightbox">
                                                                <img src="<?php echo base_url().$tipo->foto; ?>" width="100" height="85" />
                                                            </a>
                                                          
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>    
                                        <div class="prepend-1 span-14 last" style="margin-top: 8px;"><!-- DIV DE LA PARTE DEL MENU **INICIO** -->
                                            <div class="span-1" style="margin-left: 20px">
                                                <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                                     'width'=>'16',
                                                                     'height'=>'12')); ?>
                                            </div>
                                            <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                                                <?php $fecha = unix_to_human($plan->planFechaCreacion);
                                                      $fechaCreacion = fecha_acomodo($fecha);
                                                      echo $fechaCreacion; ?>
                                            </div>
                                            <!-- MENU DE USUARIOS PARA PODER ELIMINAR O APUNTARSE AL COMENTARIO **INICIO** -->
                                            <?php if($this->session->userdata('id') != $plan->planUsuarioId): ?>
                                                <div class="prepend-4 span-2" style="margin-left: -20px">
                                                    &nbsp;
                                                </div>
                                                <div class="span-1">
                                                    <?php echo anchor('#',
                                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                                'width'=>'18px',
                                                                                'height'=>'15px',
                                                                                'title'=>'Comentar')),
                                                                      //'Comentar',
                                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -4px','id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                                </div>
                                                <div class="span-1">
                                                    <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $plan->planId); ?>
                                                    <?php if($numeroUsuario == 0): ?>
                                                        <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Me apunto')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -20px','id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$plan->planId)); ?>
                                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'No voy')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>
                                                    <?php else: ?>
                                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'No voy')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>
                                                        <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Me apunto')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px','id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$plan->planId)); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="prepend-4 span-2" style="margin-left: -20px">
                                                    &nbsp;
                                                </div>
                                                <div class="span-1">
                                                    <?php echo anchor('#',
                                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                                'width'=>'18px',
                                                                                'height'=>'15px',
                                                                                'title'=>'Comentar')),
                                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: 1px','id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                                </div>
                                                <div class="span-1"><!--3 last" style="margin-left: 10px" -->
                                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$plan->planId,
                                                                      img(array('src'=>'statics/img/eliminar.png',
                                                                                    'width'=>'14px',
                                                                                    'height'=>'16px',
                                                                                    'title'=>'Eliminar')),
                                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -15px','class'=>'eliminar','name'=>$plan->planId)); ?>
                                                </div>
                                            <?php endif; ?>
                                           
                                                    <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                                         'width'=>'',
                                                                         'height'=>'12')); ?>
                                                
                                                <?php $fecha = unix_to_human($plan->planFechaCreacion);
                                                      $fechaCreacion = fecha_acomodo($fecha); 
                                                      echo $fechaCreacion; ?>
                                            </div>
                                            <div class="prepend-4 span-2 last" style="margin-top: -3px">
                                                <?php echo anchor('#',
                                                                  'Comentar', 
                                                                  array('style'=>'color: #8D6E98; text-decoration: none;', 'id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                            </div>
                                            <div class="span-3 last" style="margin-top: -3px; margin-left: -5px;">
                                                
                                                    <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                      'Me apunto', 
                                                                       array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'apuntar')); ?>
                                               
                                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$plan->planId,
                                                                      'Eliminar', 
                                                                      array('style'=>'margin-left: 3px; color: #8D6E98; text-decoration: none', 'class'=>'eliminar', 'name'=>$plan->planId)); ?>
                                                
                                            </div>
                                        </div><!-- DIV DE LA PARTE DEL MENU **FIN** -->
                                        <!-- MENU DE USUARIO PARA PODER APUNTARSE O ELIMINAR **FIN** -->
                                        <!-- CODIGO COMENTADO DEL FORMULARIO PARA EL COMENTARIO DEL COMENTARIO **INICIO** -->
                                      
                                            <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$plan->planId.'/'.$usuarios->id, 
                                                                  array('class'=>'forma-comentar-muro'.$plan->planId)); ?>
                                                <div class="prepend-2 span-5">
                                                    <?php echo form_textarea(array('id'=>'',
                                                                                   'class'=>'secondary-comment'.$plan->planId,
                                                                                   'style'=>'width: 150px; height: 40px',
                                                                                   'onkeypress'=>'subcomentar_enter(event,' . $plan->planId . ')',
                                                                                   'name'=>'comentar_muro')); ?>
                                                </div>
                                                <div class="span-1 right last">
                                                    <?php echo form_submit(array('id'=>$plan->planId,
                                                                                 'class'=>'comentar-submit',
                                                                                 'value'=>'comentar',
                                                                                 'style'=>'margin-left: -10px; margin-top: 15px')); ?>
                                                </div>
                                             <?php echo form_close(); ?>
                                        </div -->
                                        <!-- CODIGO COMENTADO DEL FORMULARIO PARA EL COMENTARIO DEL COMENTARIO **FIN** -->
                                        <div class="prepend-1 span-10" style="margin-left: 20px" id="meapunto"> <!-- DIV PARA LOS MENSAJES DE ME APUNTO **INICIO** -->
                            <?php $total = total_register($plan->planId); ?>
                            <?php if($total != 0): ?>
                                <?php if($total == 1): ?>
                                    <?php $val = get_point_simple($plan->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <span id="apuntados<?php echo $plan->planId; ?>" style="display: none">
                                            <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> y
                                        </span> 
                                        <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se han apuntado.
                                    </div>
                                <?php elseif($total == 2): ?>
                                    <?php $apuntados = get_point($plan->planId); ?> 
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
                                            <span id="apuntados<?php echo $plan->planId; ?>" style="display: none">
                                                y <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                                            </span> se han apuntado.
                                    </div>
                                <?php else: ?>
                                    <?php $apuntados = get_point($plan->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <?php $i = 1; ?>
                                        <?php foreach($apuntados as $meapunto): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                                   get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                                   array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                        <?php endforeach; ?>
                                        <span id="apuntados<?php echo $plan->planId; ?>" style="color: #8D6E98; display: none">
                                           <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>  
                                        </span> se han apuntado.
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="span-8 last" style="color: #8D6E98; display: none" id="apuntados<?php echo $plan->planId; ?>">
                                    <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                      get_complete_username($this->session->userdata('id')),
                                                      array('style'=>'color: #8D6E98; text-decoration: none')); ?> se ha apuntado
                                </div>
                               
                            <?php endif; ?>
                        </div><!-- DIV PARA LOS MENSAJES DE ME APUNTO **FIN** -->
                    </div><!-- FONDO -->

                    <!-- formulario de comentarios -->
                        <div class="comentarios-<?php echo $plan->planId; ?> prepend-1 span-8 last" style="display: none">
                            <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$plan->planId.'/'.$this->session->userdata('id'),//$usuarios->id, 
                                                 array('class'=>'forma-comentar-muro'.$plan->planId)); ?>
                                <div class="span-8" style="margin-left: 10px">
                                    <?php echo form_textarea(array('id'=>'sub-commentario'.$plan->planId,
                                                                   'class'=>'secondary-comment'.$plan->planId,
                                                                   'style'=>'width: 470px; height: 23px; color: #999999',
                                                                   'onkeypress'=>'subcomentar_enter(event,' . $plan->planId . ')',
                                                                   'onfocus'=>"return desaparecer_sub('Comentar'," . $plan->planId . ")",
                                                                   'onblur'=>"return aparecer_sub('Comentar'," . $plan->planId . ")",
                                                                   'value'=>'Comentar',
                                                                   'name'=>'comentar_muro')); ?>
                                </div>
                                <!-- div class="span-1 right last">
                                <?php echo form_submit(array('id'=>$plan->planId,
                                                             'class'=>'comentar-submit',
                                                             'value'=>'comentar',
                                                             'style'=>'margin-left: -10px; margin-top: 15px')); ?>
                                </div -->
                            <?php echo form_close(); ?>
                            <input type="hidden" id="oct<?php echo $plan->planId; ?>" />
                        </div>
                        <!-- formulario de comentarios -->
                                <div class="comentarios<?php echo $plan->planId; ?>">
                                    <div class="span-13" style="margin-top:20px; margin-bottom: 15px;">
                                            <?php $comentarios = get_subcomments_wall($plan->planId, '1'); ?>                                         
                                            <?php foreach($comentarios as $comentario): ?><!-- FOREACH DE LOS SUBCOMENTARIOS **INICIO** -->
                                                <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                                    <div class="span-11 last"><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **INICIO** -->
                                                        <div class="span-1" style="margin-left: 5px; margin-top: 5px">
                                                            <?php echo img(array('src'=>get_thumb_avatar($comentario->id)/*get_avatar($comentario->id),
                                                                                 'width'=>'36',
                                                                                 'height'=>'36'*/)); ?>
                                                        </div>
                                                        <div class="span-9 last" style="margin-top: 5px; margin-left: 20px">
                                                            <div class="span-12">
                                                                <div class="span-9">
                                                                    <span class="pulzos_titulo1">
                                                                        <?php echo anchor('usuarios/perfil/'.$comentario->id,
                                                                                          get_complete_username($comentario->id),
                                                                                          array('style'=>'text-decoration: none', 'class'=>'pulzos_titulo1')); ?>
                                                                    </span>
                                                                </div>
                                                                <div class="span-2 last">
                                                                    
                                                                </div>
                                                            </div>
                                                            <br />
                                                            <span class="pulzos_titulo2" style="word-wrap: break-word;">
                                                                <?php echo $comentario->comentarioSimple; ?>
                                                            </span>
                                                        </div>
                                                        <div class="prepend-1 span-12 last" style="margin-top: 12px">
                                                            <div class="span-1" style="margin-left: 25px">
                                                                <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                                     'width'=>'14',
                                                                                     'height'=>'12')); ?>
                                                            </div>
                                                            <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999">
                                                                <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion); 
                                                                      $fechaCreacionSub = fecha_acomodo($fecha);
                                                                      echo $fechaCreacionSub;
                                                                ?>
                                                            </div>
                                                            <div class="prepend-4 span-1 last" style="margin-left: 40px;">
                                                            	<?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
                                                            		<?php echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                                                      img(array('src'=>'statics/img/eliminar.png',
                                                                                                'width'=>'14px',
                                                                                                'height'=>'16px',
                                                                                                'title'=>'Eliminar')),
                                                                                      array('class'=>'eliminar-sub')); ?>
                                                            	<?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **FIN** -->
                                            <?php endforeach; ?><!-- FOREACH DE LOS SUBCOMENTARIOS **FIN** -->
                                        </div>
                                    </div>
                                </div>
                            <?php else:?>
                                <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB">
                                    <?php $status = get_status_user($plan->planAmigoUsuarioId); ?>
                                    <div class="span-14 last" style="width: 524px">
                                        <div class="span-1">
                                            <?php if($status == '0'): ?>
                                                <?php echo img(array('src'=>get_thumb_avatar($plan->planAmigoUsuarioId)/*get_avatar($plan->planAmigoUsuarioId),
                                                                     'width'=>'37',
                                                                     'height'=>'37'*/)); ?> 
                                            <?php else: ?>
                                                <?php $negocios = datos_negocios($plan->planAmigoUsuarioId); ?>
                                                <?php echo img(array('src'=>get_avatar_negocios($negocios->negocioId),
                                                                     'height'=>'36',
                                                                     'width'=>'36')); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="interlineado span-12 last" style="margin-top: 3px"><!-- DIV DEL CUERPO DEL POSTEO EN EL WALL ** INICIO ** -->
                                            <div style="margin-left: 20px">
                                                <span class="pulzos_titulo1">
                                                    <?php if($status == '0'): ?>
                                                        <?php echo anchor('usuarios/perfil/'.$plan->planAmigoUsuarioId,
                                                                          get_complete_username($plan->planAmigoUsuarioId),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'pulzos_titulo1')); ?> 
                                                        a 
                                                        <?php echo anchor('usuarios/perfil/'.$plan->planUsuarioId,
                                                                          get_complete_username($plan->planUsuarioId),
                                                                          array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                    <?php else: ?>
                                                        <?php echo anchor('negocios/perfil/'.$negocios->negocioId,
                                                                          get_complete_username($plan->planAmigoUsuarioId),
                                                                          array('style'=>'text-decoration: none; color: 8D6E98', 'class'=>'pulzos_titulo1')); ?> 
                                                        a 
                                                        <?php echo anchor('usuarios/perfil/'.$plan->planUsuarioId,
                                                                          get_complete_username($plan->planUsuarioId),
                                                                          array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        <div style="margin-top:6px; word-wrap: break-word; margin-left: 20px">
                                            <span class="pulzos_titulo2" style="color: #606060">
                                                <?php echo $plan->planDescripcion; ?>
                                            </span>
                                        </div>
                                        <div style="margin-top: 3px; margin-left: 10px; word-wrap: break-word;">
                                            <?php $total = count_number_register($plan->planId, 'anexos'); ?> 
                                            <?php if($total != 0): ?>
                                                <?php $tipo = count_type_register($plan->planId, 'anexos'); ?>
                                                <?php if($tipo->enlace != ''): ?>
                                                    <span class="pulzos_titulo2" style="color: #606060">
                                                            <?php $link = get_hipereference($plan->planId); ?>
                                                            <?php $return_value = http_request($link->enlace);($return_value==FALSE)?$link->enlace='http://'.$link->enlace:'';
                                                            $divPages=explode('http://',$link->enlace);$page=explode('/',$divPages[1]);$pageMain=$page[0];
                                                            if($pageMain=='vimeo.com'){
                                                                    $pageV=explode('http://vimeo.com/',$link->enlace);?>
                                                                    <iframe src="http://player.vimeo.com/video/<?php echo $pageV[1];?>" width="460" height="290" frameborder="0"></iframe> <?php
                                                            }else if($pageMain=='www.youtube.com'){
                                                                        $lkSharp=explode('&',$link->enlace);
                                                                        $linkY=explode('=',$lkSharp[0]);$id=$linkY[1];$len=strlen($id);
                                                                        for($i=0;$i<$len;$i++){($id[$i]=='&')?$idV=explode('&',$id):'';}/*(isset($idV[0]))?$id=$idV[0]:$id;*/?>
                                                            <iframe class="youtube-player" type="text/html" width="460" height="290" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe>
                                                                     <?php 
                                                            }else if($pageMain=='youtu.be'){
                                                                $lkSharp=explode('http://youtu.be/',$link->enlace);$id=$lkSharp[1];?>
                                                                <iframe class="youtube-player" type="text/html" width="460" height="290" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe> <?php
                                                            }else{
                                                                echo anchor($link->enlace, $link->enlace, array('target'=>'_blank'));
                                                            }
                                                             ?>
                                                        </span>
                                                <?php else: ?>
                                                    <span class="pulzos_titulo2" style="color: #606060">
                                                        <a href="<?php echo base_url().$tipo->foto; ?>" class="lightbox">
                                                            <img src="<?php echo base_url().$tipo->foto; ?>" width="100" height="85" />
                                                        </a>
                                                        <?php /*echo img(array('src'=>$tipo->foto,
                                                                             'width'=>'100',
                                                                             'height'=>'85'));*/ ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="prepend-1 span-14 last" style="margin-top: 8px;"><!-- DIV DE LA PARTE DEL MENU **INICIO** -->
                                            <div class="span-1" style="margin-left: 20px">
                                                <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                                     'width'=>'16',
                                                                     'height'=>'12')); ?>
                                            </div>
                                            <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                                                <?php $fecha = unix_to_human($plan->planFechaCreacion);
                                                      $fechaCreacion = fecha_acomodo($fecha);
                                                      echo $fechaCreacion; ?>
                                            </div>
                                            <!-- MENU DE USUARIOS PARA PODER ELIMINAR O APUNTARSE AL COMENTARIO **INICIO** -->
                                            <?php if($this->session->userdata('id') != $plan->planAmigoUsuarioId): ?>
                                                <div class="prepend-4 span-2" style="margin-left: -20px">
                                                    &nbsp;
                                                </div>
                                                <div class="span-1">
                                                    <?php echo anchor('#',
                                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                                'width'=>'18px',
                                                                                'height'=>'15px',
                                                                                'title'=>'Comentar')),
                                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -3px','id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                                </div>
                                                <div class="span-1"><!-- 3 last" style="margin-left: -8px" -->
                                                    <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $plan->planId); ?>
                                                    <?php if($numeroUsuario == 0): ?>
                                                        <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Me apunto')),
                                                                          //'Me apunto',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -20px','id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$plan->planId)); ?>
                                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'No voy')),
                                                                          //'No voy',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>
                                                    <?php else: ?>
                                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'No voy')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -20px', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>
                                                        <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Me apunto')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px','id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$plan->planId)); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="prepend-4 span-2" style="margin-left: -20px">
                                                    &nbsp;
                                                </div>
                                                <div class="span-1">
                                                    <?php echo anchor('#',
                                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                                'width'=>'18px',
                                                                                'height'=>'15px',
                                                                                'title'=>'Comentar')),
                                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: 1px','id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                                </div>
                                                <div class="span-1"><!-- 3 last" style="margin-left: -5px" -->
                                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$plan->planId,
                                                                      img(array('src'=>'statics/img/eliminar.png',
                                                                                    'width'=>'14px',
                                                                                    'height'=>'16px',
                                                                                    'title'=>'Eliminar')),//'Eliminar',
                                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -15px','class'=>'eliminar','name'=>$plan->planId)); ?>
                                                </div>
                                            <?php endif; ?>
                                           
                                                    <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                                         'width'=>'',
                                                                         'height'=>'12')); ?>
                                                </div>
                                            </div>
                                            <div class="span-2 left" style="margin-top: -3px">
                                                <?php $fecha = unix_to_human($plan->planFechaCreacion);
                                                      $fechaCreacion = fecha_acomodo($fecha); 
                                                      echo $fechaCreacion; ?>
                                            </div>
                                            <div class="prepend-4 span-2 last" style="margin-top: -3px">
                                                <?php echo anchor('#',
                                                                  'Comentar', 
                                                                  array('style'=>'color: #8D6E98; text-decoration: none;', 'id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                            </div>
                                            <div class="span-3 last" style="margin-top: -3px; margin-left: -5px;">
                                               
                                                    <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                      'Me apunto', 
                                                                       array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'apuntar')); ?>
                                            
                                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$plan->planId,
                                                                      'Eliminar', 
                                                                      array('style'=>'margin-left: 3px; color: #8D6E98; text-decoration: none', 'class'=>'eliminar', 'name'=>$plan->planId)); ?>
                                            
                                            </div -->
                                        </div><!-- DIV DE LA PARTE DEL MENU **FIN** -->
                                        <!-- MENU DE USUARIO PARA PODER APUNTARSE O ELIMINAR **FIN** -->
                                        <!-- CODIGO COMENTADO DEL FORMULARIO PARA LOS SUBCOMENTARIOS **INICIO** -->
                                    <!-- div class="comentarios-<?php echo $plan->planId; ?> prepend-1 span-8 last" style="display: none">
                                        <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$plan->planId.'/'.$usuarios->id, 
                                                            array('class'=>'forma-comentar-muro'.$plan->planId)); ?>
                                            <div class="prepend-2 span-5">
                                                <?php echo form_textarea(array('id'=>'',
                                                                               'class'=>'secondary-comment'.$plan->planId,
                                                                               'style'=>'width: 150px; height: 40px',
                                                                               'onkeypress'=>'subcomentar_enter(event,' . $plan->planId . ')',
                                                                               'name'=>'comentar_muro')); ?>
                                            </div>
                                            <div class="span-1 last right">
                                                <?php echo form_submit(array('id'=>$plan->planId,
                                                                             'class'=>'comentar-submit',
                                                                             'value'=>'comentar',
                                                                             'style'=>'margin-left: -10px; margin-top: 15px')); ?>
                                           </div>
                                     <?php echo form_close(); ?>
                                </div -->
                                <!-- CODIGO COMENTADO DEL FORMULARIO PARA LOS SUBCOMENTARIOS **FIN** -->
                                <div class="prepend-1 span-10" style="margin-left: 20px" id="meapunto"> <!-- DIV PARA LOS MENSAJES DE ME APUNTO **INICIO** -->
                            <?php $total = total_register($plan->planId); ?>
                            <?php if($total != 0): ?>
                                <?php if($total == 1): ?>
                                    <?php $val = get_point_simple($plan->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <span id="apuntados<?php echo $plan->planId; ?>" style="display: none">
                                            <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> y
                                        </span> 
                                        <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se han apuntado.
                                    </div>
                                <?php elseif($total == 2): ?>
                                    <?php $apuntados = get_point($plan->planId); ?> 
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
                                            <span id="apuntados<?php echo $plan->planId; ?>" style="display: none">
                                                y <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                                            </span> se han apuntado.
                                    </div>
                                <?php else: ?>
                                    <?php $apuntados = get_point($plan->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <?php $i = 1; ?>
                                        <?php foreach($apuntados as $meapunto): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                                   get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                                   array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                        <?php endforeach; ?>
                                        <span id="apuntados<?php echo $plan->planId; ?>" style="color: #8D6E98; display: none">
                                           <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>  
                                        </span> se han apuntado.
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="span-8 last" style="color: #8D6E98; display: none" id="apuntados<?php echo $plan->planId; ?>">
                                    <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                      get_complete_username($this->session->userdata('id')),
                                                      array('style'=>'color: #8D6E98; text-decoration: none')); ?> se ha apuntado
                                </div>
                                
                            <?php endif; ?>
                        </div><!-- DIV PARA LOS MENSAJES DE ME APUNTO **FIN** -->
                    </div><!-- FONDO -->

                    <div class="comentarios-<?php echo $plan->planId; ?> prepend-1 span-8 last" style="display: none">
                        <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$plan->planId.'/'.$this->session->userdata('id'),//$usuarios->id, 
                                             array('class'=>'forma-comentar-muro'.$plan->planId)); ?>
                            <div class="span-8 last" style="margin-left: 10px">
                                <?php echo form_textarea(array('id'=>'sub-commentario'.$plan->planId,
                                                               'class'=>'secondary-comment'.$plan->planId,
                                                               'style'=>'width: 470px; height: 23px; color; #999999',
                                                               'onkeypress'=>'subcomentar_enter(event,' . $plan->planId . ')',
                                                               'onblur'=>"return aparecer_sub('Comentar'," . $plan->planId . ")",
                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $plan->planId . ")",
                                                               'value'=>'Comentar',
                                                               'name'=>'comentar_muro')); ?>
                            </div>
                            
                                <?php echo form_submit(array('id'=>$plan->planId,
                                                             'class'=>'comentar-submit',
                                                             'value'=>'comentar',
                                                             'style'=>'margin-left: -10px; margin-top: 15px')); ?>
                         
                        <?php echo form_close(); ?>
                        <input type="hidden" id="oct<?php echo $plan->planId; ?>" />
                    </div>

                        <div class="comentarios<?php echo $plan->planId; ?>">
                            <div class="span-13" style="margin-top:20px; margin-bottom: 15px">
                                    <?php $comentarios = get_subcomments_wall($plan->planId, '1'); ?>
                                    <?php foreach($comentarios as $comentario): ?><!-- FOREACH DE LOS SUBCOMENTARIOS **INICIO** -->
                                        <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px"><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **INICIO** -->
                                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                                <?php echo img(array('src'=>get_thumb_avatar($comentario->id)/*get_avatar($comentario->id),
                                                                     'width'=>'36',
                                                                     'height'=>'36'*/)); ?>
                                            </div>
                                            <div class="span-5 last" style="margin-top: 5px; margin-left: 20px">
                                                <div class="span-9 last" style="margin-top: -5px; margin-left: -5px"><!-- margin-top: 14px; margin-left: 14px" -->
                                                    <div class="span-12">
                                                        <div class="span-9">
                                                            <span class="pulzos_titulo1">
                                                                <?php echo anchor('usuarios/perfil/'.$comentario->id,
                                                                                  get_complete_username($comentario->id),
                                                                                  array('style'=>'text-decoration: none', 'class'=>'pulzos_titulo1')); ?>
                                                            </span>
                                                        </div>
                                                        <div class="span-2 last">
                                                            <?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
                                                              
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>                                            
                                                    <br />
                                                    <span class="pulzos_titulo2" style="word-wrap: break-word;">
                                                        <?php echo $comentario->comentarioSimple; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="prepend-1 span-12 last" style="margin-top: 12px">
                                                <div class="span-1" style="margin-left: 25px">
                                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                         'height'=>'14',
                                                                         'width'=>'12')); ?>
                                                </div>
                                                <div class="span-4" style="margin-left: -20px; font-size: 9pt; color: #999999">
                                                    <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);
                                                          $fechaCreacionSub = fecha_acomodo($fecha);
                                                          echo $fechaCreacionSub; ?>
                                                </div>
                                                <div class="prepend-1 span-4 last" style="margin-left: 40px">
                                                	<?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
                                                		<?php echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                                    	  img(array('src'=>'statics/img/eliminar.png',
                                                                                    'width'=>'14px',
                                                                                    'height'=>'16px',
                                                                                    'title'=>'Eliminar')),
                                                                          array('class'=>'eliminar-sub')); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **FIN** -->
                                    <?php endforeach; ?><!-- FOREACH DE LOS SUBCOMENTARIOS **FIN** -->
                                </div>
                            </div>
                        </div><!-- DIV DEL CUERPO DEL POSTEO EN EL WALL ** FIN ** -->
                    <?php endif; ?>
</div>
