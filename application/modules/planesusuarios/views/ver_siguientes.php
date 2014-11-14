<link rel="stylesheet" href="<?php echo base_url().'statics/js/jquery/plugins/jquery_lightbox/css/jquery.lightbox-0.5.css';?>" type="text/css" media="screen" />
<script type="text/javascript">

$('.ver-aviso').click(function(event){
    event.preventDefault();
    attrName = $(event.currentTarget).attr("name");
    $(event.currentTarget).hide();
    $("#ocultar-"+attrName).show();
    $("#aviso-legal-"+attrName).show();
});

$('.ocultar-aviso').click(function(event){
    event.preventDefault();
    attrNameO = $(event.currentTarget).attr("name");
    $(event.currentTarget).hide();
    $("#ver-"+attrNameO).show();
    $("#aviso-legal-"+attrNameO).hide();
});

$(".ver-mas-empresa").click(function(event){
    event.preventDefault();
    urlRecovery = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlRecovery);
});

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
    alert('hola');
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

$(".comentar-plan").click(function(event){
    event.preventDefault();
    idcomentario = $(event.currentTarget).attr('id');
    nombreDiv = ".comentarios-" + idcomentario;
    $(nombreDiv).show();
});

function subcomentar_enter(event, idplan)
{
    if(event.keyCode == 13)
    {
        var accionAtr = $(".forma-comentar-muro"+idplan).attr("action");
        var datosAccion = $(".secondary-comment"+idplan).attr("value");
       
        $(".secondary-comment"+idplan).blur();
        $("#oct"+idplan).val(datosAccion).focus();
      
        var clase = "comentarios"+idplan;
        urlReloadC = $("#recarga_comentario").attr("href");
        urlReloadComentario = urlReloadC + '/' + idplan;
        if(datosAccion != "Comentar")
        {
            $.post(accionAtr, 
                   {comentar_muro:datosAccion},
                   function(data){
                        $(".comentarios-"+idplan).hide();
                        $("."+clase).load(urlReloadComentario);
                        $(".secondary-comment"+idplan).val("Comentar");
            });
        }
    }
}

function subcomentar_enter_company(event, idplan)
{
    if(event.keyCode == 13)
    {
        var accionAtr = $(".forma-comentar-muro"+idplan).attr("action");
        var datosAccion = $(".secondary-comment"+idplan).attr("value");
        //desenfocada inicio
        $(".secondary-comment"+idplan).blur();
        $("#oct"+idplan).val(datosAccion).focus();
        //desenfocada fin
        var clase = "comentarios"+idplan;
        urlReloadC = $("#recargar_comentario_empresa").attr("href");
        urlReloadComentario = urlReloadC + '/' + idplan;
        if(datosAccion != "Comentar")
        {//if inicio
            //alert('hola' + clase);
            //alert('url: ' + urlReloadC);
            $.post(accionAtr, 
                   {comentar_muro:datosAccion},
                   function(data){
                        $(".comentarios-"+idplan).hide();
                        $("."+clase).load(urlReloadComentario);
                        $(".secondary-comment"+idplan).val("Comentar");
        });
           


            /*       url = $("#enlace").attr('href');
                     $("#texto-menu").load(url);*/
           /* $.ajax({
                    type: "POST",
                    url: accionAtr,
                    data: "comentar_muro="+datosAccion,
                    success: 
        });*/


        }//if final
    }
}

function cargarVista1()
{
    clearTimeout(refreshId);
    url = $("#enlace").attr('href');
    $("#texto-menu").load(url);
}

$(".eliminar-plan").click(function(event){
    event.preventDefault();
    var urlEliminarPulzo = $(event.currentTarget).attr('href');
    $.get(urlEliminarPulzo);
    $(event.currentTarget).parent().parent().parent().parent().hide();
});

$(".eliminar-pulzo").click(function(event){
    event.preventDefault();
    urlDelete = $(event.currentTarget).attr("href");
    $.get(urlDelete);
    $(event.currentTarget).parent().parent().parent().parent().hide().remove();
});

$(".plan-usuario").click(function(event){
    event.preventDefault();
    simplePlan = $(event.currentTarget).attr('href');
    location.href = simplePlan;
});

$(".ver-publicacion-personal").click(function(event){
    event.preventDefault();
    urlPersonalP = $(event.currentTarget).attr('href');
    //alert('hola ' + urlPersonalP);
    $("#texto-menu").load(urlPersonalP);
});


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

$(".eliminar-sub").click(function(event){
    event.preventDefault();
    //alert('hola');
    urlDeleteSub = $(event.currentTarget).attr("href");
    $(event.currentTarget).parent().parent().parent().parent().hide();
    $.get(urlDeleteSub);
});

$(".eliminar").click(function(event){
    event.preventDefault();
    var deletePlan = $(event.currentTarget).attr('href');
    var numid = $(event.currentTarget).attr('name');
    var commentsplan = ".comentarios"+numid;
    $.get(deletePlan);
    $(event.currentTarget).parent().parent().parent().parent().hide();
    $(commentsplan).hide();
});

$(".eliminar-scribble").click(function(event){
    event.preventDefault();
    deletePared = $(event.currentTarget).attr('href');
    numIds = $(event.currentTarget).attr('name');
    comentariosScr = ".comentarios"+numIds;
    $.get(deletePared);
    $(event.currentTarget).parent().parent().parent().parent().hide();
    $(comentariosScr).hide();
});

$(".a").click(function(event){
    event.preventDefault();
    alert('hola');
});



function start(fecha_inicio, fecha_final,div) 
{
	displayCountDown(setCountDown(fecha_inicio, fecha_final),div);
}

function setCountDown(inicio, tiempoactual) 
{	
		
	var fechainicio=new Date(Date.parse(inicio));
	var nuevo =new Date(0);
	var finf=(nuevo.setMilliseconds(fechainicio)+86400000);	
	var nuevo2 =new Date(0);	
	return Math.floor((nuevo2.setMilliseconds(finf-tiempoactual)/1000)+3600);
}

function displayCountDown(countdown,nameDiv) 
{	
    if (countdown < 0) document.getElementById(nameDiv).innerHTML = "<span style=' font-size:15px; color:#FF0000;'>Reto terminado </span>"; //Mensaje de ejemplo para deal finalizado
	else {
		
        var secs = countdown % 60; 
        if (secs < 10) secs = '0'+secs;
        var countdown1 = (countdown - secs) / 60;
        var mins = countdown1 % 60; 
        if (mins < 10) mins = '0'+mins;
        countdown1 = (countdown1 - mins) / 60;
        var hours = countdown1 % 24;
        var days = (countdown1 - hours) / 24;
        
        hours = days * 24 + hours;
        
        document.getElementById(nameDiv).innerHTML ="<span style=' font-size:17px; color:#660068; '>"+'tiempo restante: '+hours+ 'h : ' +mins+ 'm : '+secs+'s'+"<img src='<?php echo base_url().'statics/img/ico_empresas/reloj.jpg'; ?>' width='15' height='15px'/></span>";
        setTimeout('displayCountDown('+(countdown-1)+',\''+nameDiv+'\');',999);
		
	}
}

</script>
<?php echo anchor('planesusuarios/reload_comment/', '', array('style'=>'display: none', 'id'=>'recarga_comentario')); ?>
<?php echo anchor('planesusuarios/reload_comment_company/', '', array('style'=>'display: none', 'id'=>'recargar_comentario_empresa')); ?>
<?php $a=0;
      $ik = 1;
?>
<?php //echo anchor('#', 'perros', array('class'=>'a')); ?>
<?php foreach($siguientes as $planes): ?><!-- FOREACH PRINCIPAL **INICIO** --> 
<?php //var_dump($planes); ?>    
      <?php //$amigos = there_are_friends(); ?>


        <?php if($planes->planTipo == 1): ?><!-- IF TIPO PLAN **INICIO** -->
            <?php if($planes->planUsuarioId == $this->session->userdata('id') && $planes->planAmigoUsuarioId == '0'): ?><!-- CHECAR SI PLAN USUARIO ID ES DEL DUEÑO DEL PERFIL **INICIO** -->
              <?php $valor = get_posibility_friends($planes->planUsuarioId, $this->session->userdata('id')); ?>
             
                <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR DE DATOS MAIN **INICIO** -->
                    <div class="span-14 last" style="width: 524px"><!-- FONDO **INICIO** -->
                        <div class="span-1">
                            <?php echo img(array('src'=>get_thumb_avatar($planes->planUsuarioId))); ?>
                        </div>
                        <div class="interlineado span-12 last" style="margin-top: 3px"><!-- DIV CUERPO DEL POSTEO **INICIO** -->
                            <div style="margin-left: 20px">
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('usuarios/perfil/'.$planes->planUsuarioId,
                                                      get_complete_username($planes->planUsuarioId),
                                                      array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </span>
                            </div>
                            <div style="margin-top: 6px; margin-left: 20px; word-wrap: break-word;">
                                <span class="pulzos_titulo2">
                                    <?php echo $planes->planDescripcion; ?>
                                </span>
                            </div>
                            <div style="margin-top: 3px; margin-left: 20px; word-wrap: break-word;">
                                <?php $total = count_number_register($planes->planId, 'anexos'); ?>
                                <?php if($total != 0): ?>
                                    <?php  $tipo = count_type_register($planes->planId, 'anexos'); ?>
                                    <?php if($tipo->enlace != ''): ?>
                                         <span class="pulzos_titulo2" style="color: #606060">
                                            <?php 
                                              $link = get_hipereference($planes->planId); 
                                              $return_value = http_request($link->enlace);($return_value==FALSE)?$link->enlace='http://'.$link->enlace:'';
                                              $divPages=explode('http://',$link->enlace);$page=explode('/',$divPages[1]);$pageMain=$page[0];
                                              if($pageMain=='vimeo.com'){$pageV=explode('http://vimeo.com/',$link->enlace);?>
                                            <iframe src="http://player.vimeo.com/video/<?php echo $pageV[1];?>" width="310" height="175" frameborder="0"></iframe>    
                                      <?php }else if($pageMain=='www.youtube.com'){
                                                $lkSharp=explode('&',$link->enlace);
                                                $linkY=explode('=',$lkSharp[0]);$id=$linkY[1];$len=strlen($id);
                                                for($i=0;$i<$len;$i++){($id[$i]=='&')?$idV=explode('&',$id):'';}/*(isset($idV[0]))?$id=$idV[0]:$id;*/?>
                                             <iframe class="youtube-player" type="text/html" width="460" height="210" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe>
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
                                            <?php /*echo anchor($tipo->foto,
                                                              img(array('src'=>$tipo->foto,
                                                                        'width'=>'100',
                                                                        'height'=>'85')),
                                                              array('style'=>'text-decoration: none;'));*/ ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div><!-- DIV CUERPO DEL POSTEO **FIN** -->
                        <div class="prepend-1 span-14 last" style="margin-top: 8px;"><!-- DIV DEL MENU **INICIO** -->
                            <div class="span-1" style="margin-left: 20px">
                                <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                     'width'=>'16',
                                                     'height'=>'12')); ?>
                            </div>
                            <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                                <?php $fecha = unix_to_human($planes->planFechaCreacion);
                                      $fechaCreacion = fecha_acomodo($fecha);
                                      echo $fechaCreacion; ?>
                            </div>
                            <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **INICIO -->
                            <?php if($this->session->userdata('id') != $planes->planUsuarioId): ?>
                                <div class="prepend-3 span-2" style="margin-left: -20px">
                                    &nbsp;
                                </div>
                                <div class="span-1">
                                    <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos',
                                                                                    'style'=>'margin-left: 0px')),
                                                                          //'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                  'width'=>'18px',//23px',
                                                                                  'height'=>'15px',//20px',
                                                                                  'title'=>'Ver todos',
                                                                                  'style'=>'margin-left: 0px')),
                                                                        array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                </div>
                                <div class="span-1">
                                    <?php echo anchor('#',
                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                'width'=>'18px',
                                                                'height'=>'15px',
                                                                'title'=>'Comentar')),
                                                      array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                </div>
                                <div class="span-1">
                                    <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $planes->planId); ?>
                                    <?php if($numeroUsuario == 0): ?>
                                        <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                    'width'=>'20px',
                                                                    'height'=>'15px',
                                                                    'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                    'width'=>'20px',
                                                                    'height'=>'15px',
                                                                    'title'=>'No voy')),
                                                          //'No voy',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>                         
                                    <?php else: ?>
                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                    'width'=>'20px',
                                                                    'height'=>'15px',
                                                                    'title'=>'No voy')),
                                                          //'No voy',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>
                                        <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="prepend-3 span-2" style="margin-left: -20px">
                                    &nbsp;
                                </div>
                                <div class="span-1">
                                    <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Ver todos',
                                                                                    'style'=>'margin-left: 0px')),
                                                                         
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 16px', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                  'width'=>'18px',//23px',
                                                                                  'height'=>'15px',//20px',
                                                                                  'title'=>'Ver todos',
                                                                                  'style'=>'margin-left: 0px')),
                                                                        array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 16px', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                </div>
                                <div class="span-1">
                                    <?php echo anchor('#',
                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                'width'=>'18px',
                                                                'height'=>'15px',
                                                                'title'=>'Comentar')),
                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: 1px', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                </div>
                                <div class="span-1"><!-- 3 last" -->
                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$planes->planId,
                                                      img(array('src'=>'statics/img/eliminar.png',
                                                                'width'=>'14px',
                                                                'height'=>'16px',
                                                                'title'=>'Eliminar')),//'Eliminar',
                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -15px', 'class'=>'eliminar', 'name'=>$planes->planId)); ?>
                                </div>
                            <?php endif; ?>
                            <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **FIN** -->
                        </div><!-- DIV DEL MENU **FIN** -->
                        <div class="prepend-1 span-10" style="margin-left: 20px" id="meapunto"> <!-- DIV PARA LOS MENSAJES DE ME APUNTO **INICIO** -->
                            <?php $total = total_register($planes->planId); ?>
                            <?php if($total != 0): ?>
                                <?php if($total == 1): ?>
                                    <?php $val = get_point_simple($planes->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                            <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> y
                                        </span> 
                                        <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se han apuntado.
                                    </div>
                                <?php elseif($total == 2): ?>
                                    <?php $apuntados = get_point($planes->planId); ?> 
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
                                            <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                                y <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                                            </span> se han apuntado.
                                    </div>
                                <?php else: ?>
                                    <?php $apuntados = get_point($planes->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <?php $i = 1; ?>
                                        <?php foreach($apuntados as $meapunto): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                                   get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                                   array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                        <?php endforeach; ?>
                                        <span id="apuntados<?php echo $planes->planId; ?>" style="color: #8D6E98; display: none">
                                           <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>  
                                        </span> se han apuntado.
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="span-8 last" style="color: #8D6E98; display: none" id="apuntados<?php echo $planes->planId; ?>">
                                    <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                      get_complete_username($this->session->userdata('id')),
                                                      array('style'=>'color: #8D6E98; text-decoration: none')); ?> se ha apuntado
                                </div>
                                <?php /*if($total == 1): ?>
                                    <?php $val = get_point_simple($planes->planId); ?>
                                    <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se ha apuntado.
                                <?php elseif($total == 2): ?>
                                    <?php $apuntados = get_point($planes->planId); ?>
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
                                    <?php $apuntados = get_point($planes->planId); ?>
                                    <?php $i = 1; ?>
                                    <?php foreach($apuntados as $meapunto): ?> 
                                        <?php if($i == 2): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                               get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                               array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                            <?php echo anchor('#',
                                                              'ver todos',
                                                              array('class'=>'mas-apuntados', 'style'=>'text-decoration: none; margin-left: 10px; color: #8D6E98')); ?>
                                            <?php echo anchor('#',
                                                              'ocultar todos',
                                                               array('class'=>'ocultar-apuntados', 'style'=>'text-decoration: none; margin-left: 10px; color: #8D6E98; display: none')); ?>
                                        <?php endif; ?> 
                                        <?php if($i == 3): ?>
                                            <?php $contarTodos = get_count_pointed($meapunto->meApuntoPlanId); ?>
                                            <?php $number_register = $contarTodos - 2; ?>
                                            <?php $menosDos = get_count_remaining($meapunto->meApuntoPlanId, $number_register); ?>
                                            <div class="div-muestra-apuntados span-10" style="display: none">
                                            <?php foreach($menosDos as $restantes): ?>
                                                <?php echo anchor('usuarios/perfil/'.$restantes->meApuntoUsuarioApuntadoId,
                                                                  get_complete_username($restantes->meApuntoUsuarioApuntadoId),
                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                            <?php endforeach; ?>
                                            </div>
                                            <?php break; ?>
                                        <?php endif; ?>
                                        <?php if($i == 1): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                              get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'mas-apuntados')); ?>,
                                        <?php endif; ?>
                                        <?php $i = $i + 1; ?>
                                    <?php endforeach; ?>
                                <?php //y <?php echo $total = $total - 2; ? > mas se han apuntado. ?>
                                <?php endif;*/ ?>
                            <?php endif; ?>
                        </div><!-- DIV PARA LOS MENSAJES DE ME APUNTO **FIN** -->
                    </div><!-- FONDO **FIN** -->
                    <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                        <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$planes->planId.'/'.$this->session->userdata('id'),//$usuarios->id,
                                             array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                            <div class="span-8" style="margin-left: 10px">
                                <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                               'class'=>'secondary-comment'.$planes->planId,
                                                               'style'=>'width: 470px; height: 23px; color: #999999',
                                                               'onkeypress'=>'subcomentar_enter(event,' . $planes->planId . ')',
                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                               'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                               'value'=>'Comentar',
                                                               'name'=>'comentar_muro')); ?>
                            </div>
                            <?php //echo form_submit('a', 'a'); ?>
                        <?php echo form_close(); ?>
                        <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                    </div><!-- DIV DEL FORMULARIO PARA COMENTARIOS **FIN** -->
                    <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE MUESTRA LOS COMENTARIOS **INICIO** -->
                        <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                            <?php $valores_comentarios = count_all_subcomments($planes->planId, '1'); ?><!-- cuenta numero de comments-->
                            <?php if($valores_comentarios != 0): ?>
                                <?php if($valores_comentarios > 3): ?>
                                    <?php $ids_comments = get_all_ids($planes->planId, '1'); ?><!--obtiene los ids de los comments -->
                                    <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                    <?php $comentarios = get_subcomments_wall1($planes->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                <?php else: ?>
                                    <?php $comentarios = get_subcomments_wall($planes->planId, '1'); ?>
                                <?php endif; ?>
                                <?php foreach($comentarios as $comentario): ?><!-- FOREACH SUBCOMENTARIOS **INICIO**  #DCCEDD 10px-->
                                    <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                        <div class="span-11 last"><!-- DIV INICIAL DE SUBCOMENTARIOS **INICIO** -->
                                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                                <?php echo img(array('src'=>get_thumb_avatar($comentario->id)/*get_avatar($comentario->id),
                                                                     'width'=>'37px',
                                                                     'height'=>'37px'*/)); ?>
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
                                                        <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                                            <?php /*echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                                             img(array('src'=>'statics/img/eliminar.png',
                                                                                       'width'=>'14px',
                                                                                       'height'=>'16px')),
                                                                             array('class'=>'eliminar-sub'));*/ ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <br />
                                                <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                    <?php echo $comentario->comentarioSimple; ?>
                                                </span>
                                            </div>
                                            <div class="prepend-1 span-12 last" style="margin-top: 12px">
                                                <div class="span-1" style="margin-left: 25px">
                                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                         'width'=>'14',
                                                                         'height'=>'12')); ?>
                                                </div>
                                                <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999;">
                                                    <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);
                                                          $fechaCreacionSub = fecha_acomodo($fecha);
                                                          echo $fechaCreacionSub; ?>
                                                </div>
                                                <div class="prepend-4 span-1 last" style="margin-left: 40px">
                                                    <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
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
                                <?php endforeach; ?><!-- FOREACH SUBCOMENTARIOS **FIN** -->
                            <?php endif; ?>
                        </div>
                    </div><!-- DIV QUE MUESTRA LOS COMENTARIOS **FIN** --> 
                </div><!-- DIV CONTENEDOR DE DATOS MAIN **FIN** -->
            <?php elseif($planes->planAmigoUsuarioId == '0'): ?>
              <?php $val = get_posibility_friends($this->session->userdata('id'), $planes->planUsuarioId); ?>
              <?php if($val > 0): ?>
                <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR DE DATOS MAIN **INICIO** -->
                    <div class="span-14 last" style="width: 524px"><!-- FONDO **INICIO** -->
                        <div class="span-1">
                            <?php echo img(array('src'=>get_thumb_avatar($planes->planUsuarioId)/*get_avatar($planes->planUsuarioId),
                                                 'width'=>'37px',
                                                 'height'=>'37px'*/)); ?>
                        </div>
                        <div class="interlineado span-12 last" style="margin-top: 3px"><!-- DIV CUERPO DEL POSTEO **INICIO** -->
                            <div style="margin-left: 20px">
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('usuarios/perfil/'.$planes->planUsuarioId,
                                                      get_complete_username($planes->planUsuarioId),
                                                      array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </span>
                            </div>
                            <div style="margin-top: 6px; margin-left: 20px; word-wrap: break-word;">
                                <span class="pulzos_titulo2">
                                    <?php echo $planes->planDescripcion; ?>
                                </span>
                            </div>
                            <div style="margin-top: 3px; margin-left: 20px; word-wrap: break-word;">
                                <?php $total = count_number_register($planes->planId, 'anexos'); ?>
                                <?php if($total != 0): ?>
                                    <?php  $tipo = count_type_register($planes->planId, 'anexos'); ?>
                                    <?php if($tipo->enlace != ''): ?>
                                        <span class="pulzos_titulo2" style="color: #606060">
                                            <?php 
                                              $link = get_hipereference($planes->planId); 
                                              $return_value = http_request($link->enlace);($return_value==FALSE)?$link->enlace='http://'.$link->enlace:'';
                                              $divPages=explode('http://',$link->enlace);$page=explode('/',$divPages[1]);$pageMain=$page[0];
                                              if($pageMain=='vimeo.com'){$pageV=explode('http://vimeo.com/',$link->enlace);?>
                                            <iframe src="http://player.vimeo.com/video/<?php echo $pageV[1];?>" width="310" height="175" frameborder="0"></iframe>    
                                      <?php }else if($pageMain=='www.youtube.com'){
                                                $lkSharp=explode('&',$link->enlace);
                                                $linkY=explode('=',$lkSharp[0]);$id=$linkY[1];$len=strlen($id);
                                                for($i=0;$i<$len;$i++){($id[$i]=='&')?$idV=explode('&',$id):'';}/*(isset($idV[0]))?$id=$idV[0]:$id;*/?>
                                             <iframe class="youtube-player" type="text/html" width="460" height="210" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe>
                                             <?php 
                                            }else if($pageMain=='youtu.be'){
                                                $lkSharp=explode('http://youtu.be/',$link->enlace);$id=$lkSharp[1];?>
                                                <iframe class="youtube-player" type="text/html" width="460" height="290" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe> <?php
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
                                            
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div><!-- DIV CUERPO DEL POSTEO **FIN** -->
                        <div class="prepend-1 span-14 last" style="margin-top: 8px;"><!-- DIV DEL MENU **INICIO** -->
                            <div class="span-1" style="margin-left: 20px">
                                <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                     'width'=>'16',
                                                     'height'=>'12')); ?>
                            </div>
                            <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                                <?php $fecha = unix_to_human($planes->planFechaCreacion);
                                      $fechaCreacion = fecha_acomodo($fecha);
                                      echo $fechaCreacion; ?>
                            </div>
                            <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **INICIO -->
                            <?php if($this->session->userdata('id') != $planes->planUsuarioId): ?>
                                <div class="prepend-3 span-2" style="margin-left: -20px">
                                    &nbsp;
                                </div>
                                <div class="span-1">
                                    <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                          //'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                        //'Ver todos',
                                                                        array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 12px', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                </div>
                                <div class="span-1">
                                    <?php echo anchor('#',
                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                'width'=>'18px',//23px',
                                                                'height'=>'15px',//20px',
                                                                'title'=>'Comentar')),//'Comentar',
                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -3px', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                </div>
                                <div class="span-1">
                                    <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $planes->planId); ?>
                                    <?php if($numeroUsuario == 0): ?>
                                        <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -20px', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'No voy')),
                                                          //'No voy',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>
                                    <?php else: ?>
                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'No voy')),
                                                          //'No voy',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -20px', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>
                                        <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="prepend-3 span-2" style="margin-left: -20px">
                                    &nbsp;
                                </div>
                                <div class="span-1">
                                    <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                          //'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                        //'Ver todos',
                                                                        array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                </div>
                                <div class="span-1">
                                    <?php echo anchor('#',
                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                'width'=>'18px',//23px',
                                                                'height'=>'15px',//20px',
                                                                'title'=>'Comentar')),//'Comentar',
                                                      array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                </div>
                                <div class="span-1"><!-- 3 last" -->
                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$planes->planId,
                                                      img(array('src'=>'statics/img/eliminar.png',
                                                                'width'=>'14px',
                                                                'height'=>'16px',
                                                                'title'=>'Eliminar')),//'Eliminar',
                                                      array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'eliminar', 'name'=>$planes->planId)); ?>
                                </div>
                            <?php endif; ?>
                            <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **FIN** -->
                        </div><!-- DIV DEL MENU **FIN** -->
                        <div class="prepend-1 span-10" style="margin-left: 20px" id="meapunto"> <!-- DIV PARA LOS MENSAJES DE ME APUNTO **INICIO** -->
                            <?php $total = total_register($planes->planId); ?>
                            <?php if($total != 0): ?>
                                <?php if($total == 1): ?>
                                    <?php $val = get_point_simple($planes->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                            <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> y
                                        </span> 
                                        <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se han apuntado.
                                    </div>
                                <?php elseif($total == 2): ?>
                                    <?php $apuntados = get_point($planes->planId); ?> 
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
                                            <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                                y <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                                            </span> se han apuntado.
                                    </div>
                                <?php else: ?>
                                    <?php $apuntados = get_point($planes->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <?php $i = 1; ?>
                                        <?php foreach($apuntados as $meapunto): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                                   get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                                   array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                        <?php endforeach; ?>
                                        <span id="apuntados<?php echo $planes->planId; ?>" style="color: #8D6E98; display: none">
                                           <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>  
                                        </span> se han apuntado.
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="span-8 last" style="color: #8D6E98; display: none" id="apuntados<?php echo $planes->planId; ?>">
                                    <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                      get_complete_username($this->session->userdata('id')),
                                                      array('style'=>'color: #8D6E98; text-decoration: none')); ?> se ha apuntado
                                </div>
                               
                            <?php endif; ?>
                        </div><!-- DIV PARA LOS MENSAJES DE ME APUNTO **FIN** -->
                    </div><!-- FONDO **FIN** -->
                    <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                        <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$planes->planId.'/'.$this->session->userdata('id'),//$usuarios->id,
                                             array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                            <div class="span-8" style="margin-left: 10px">
                                <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                               'class'=>'secondary-comment'.$planes->planId,
                                                               'style'=>'width: 470px; height: 23px; color: #999999',
                                                               'onkeypress'=>'subcomentar_enter(event,' . $planes->planId . ')',
                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                               'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                               'value'=>'Comentar',
                                                               'name'=>'comentar_muro')); ?>
                            </div>
                            <?php //echo form_submit('a', 'a'); ?>
                        <?php echo form_close(); ?>
                        <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                    </div><!-- DIV DEL FORMULARIO PARA COMENTARIOS **FIN** -->
                    <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE MUESTRA LOS COMENTARIOS **INICIO** -->
                        <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                            <?php $valores_comentarios = count_all_subcomments($planes->planId, '1'); ?><!-- cuenta numero de comments-->
                            <?php if($valores_comentarios != 0): ?>
                                <?php if($valores_comentarios > 3): ?>
                                    <?php $ids_comments = get_all_ids($planes->planId, '1'); ?><!--obtiene los ids de los comments -->
                                    <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                    <?php $comentarios = get_subcomments_wall1($planes->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                <?php else: ?>
                                    <?php $comentarios = get_subcomments_wall($planes->planId, '1'); ?>
                                <?php endif; ?>
                                <?php foreach($comentarios as $comentario): ?><!-- FOREACH SUBCOMENTARIOS **INICIO** -->
                                    <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                        <div class="span-11 last"><!-- DIV INICIAL DE SUBCOMENTARIOS **INICIO** -->
                                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                                <?php echo img(array('src'=>get_thumb_avatar($comentario->id)/*get_avatar($comentario->id),
                                                                     'width'=>'37px',
                                                                     'height'=>'37px'*/)); ?>
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
                                                <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                    <?php echo $comentario->comentarioSimple; ?>
                                                </span>
                                            </div>
                                            <div class="prepend-1 span-12 last" style="margin-top: 12px">
                                                <div class="span-1" style="margin-left: 25px">
                                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                         'width'=>'14',
                                                                         'height'=>'12')); ?>
                                                </div>
                                                <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999;">
                                                    <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);
                                                          $fechaCreacionSub = fecha_acomodo($fecha);
                                                          echo $fechaCreacionSub; ?>
                                                </div>
                                                <div class="prepend-4 span-1 last" style="margin-left: 40px">
                                                    <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
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
                                <?php endforeach; ?><!-- FOREACH SUBCOMENTARIOS **FIN** -->
                            <?php endif; ?>
                        </div>
                    </div><!-- DIV QUE MUESTRA LOS COMENTARIOS **FIN** -->
                </div><!-- DIV CONTENEDOR DE DATOS MAIN **FIN** -->
              <?php endif; ?>
            <?php else: ?><!-- ELSE DE CONDICION PARA VER SI SON AMIGOS O EMPRESAS  ** MEDIO ** -->
                <?php if(($this->session->userdata('id') == $planes->planAmigoUsuarioId) || ($this->session->userdata('id') == $planes->planUsuarioId)): ?><!-- REVISA SI POSTEA EL USUARIO LOGUEADO O NO **INICIO** -->
                  <?php $val = get_posibility_friends($this->session->userdata('id'), $planes->planUsuarioId); ?>
                  <?php if($val > 0): ?> 
                    <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR DE DATOS MAIN **INICIO** -->
                        <div class="span-14 last" style="width: 524px"><!-- FONDO **INICIO** -->
                            <div class="span-1">
                                <?php $status = get_status_user($planes->planAmigoUsuarioId); ?>
                                <?php if($status == 0): ?> 
                                    <?php echo img(array('src'=>get_thumb_avatar($planes->planAmigoUsuarioId))); ?>
                                <?php else: ?>
                                    <?php $datosNegocio = datos_negocios($planes->planAmigoUsuarioId); ?>
                                    <?php echo img(array('src'=>get_avatar_negocios($datosNegocio->negocioId),
                                                         'width'=>'37px',
                                                         'height'=>'37px')); ?>
                                <?php endif; ?>
                            </div>
                            <div class="interlineado span-12 last" style="margin-top: 3px"><!-- DIV CUERPO DEL POSTEO **INICIO** -->
                                <div style="margin-left: 20px" class="pulzos_titulo1">
                                    <span class="pulzos_titulo1">
                                        <?php if($status == 0): ?>
                                            <?php echo anchor('usuarios/perfil/'.$planes->planAmigoUsuarioId,
                                                              get_complete_username($planes->planAmigoUsuarioId),
                                                              array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        <?php else: ?>
                                            <?php echo anchor('negocios/perfil/'.$datosNegocio->negocioId,
                                                              get_complete_username($planes->planAmigoUsuarioId),
                                                              array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        <?php endif; ?>
                                    </span>
                                    a
                                    <span class="pulzos_titulo1">
                                        <?php echo anchor('usuarios/perfil/'.$planes->planUsuarioId,
                                                          get_complete_username($planes->planUsuarioId),
                                                          array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                    </span>
                                </div>
                                <div style="margin-top: 6px; margin-left: 20px; word-wrap: break-word;">
                                    <span class="pulzos_titulo2">
                                        <?php echo $planes->planDescripcion; ?>
                                    </span>
                                </div>
                                <div style="margin-top: 3px; margin-left: 20px; word-wrap: break-word;">
                                    <?php $total = count_number_register($planes->planId, 'anexos'); ?>
                                    <?php if($total != 0): ?>
                                        <?php  $tipo = count_type_register($planes->planId, 'anexos'); ?>
                                        <?php if($tipo->enlace != ''): ?>
                                            <span class="pulzos_titulo2" style="color: #606060">
                                           <?php 
                                              $link = get_hipereference($planes->planId); 
                                              $return_value = http_request($link->enlace);($return_value==FALSE)?$link->enlace='http://'.$link->enlace:'';
                                              $divPages=explode('http://',$link->enlace);$page=explode('/',$divPages[1]);$pageMain=$page[0];
                                              if($pageMain=='vimeo.com'){$pageV=explode('http://vimeo.com/',$link->enlace);?>
                                            <iframe src="http://player.vimeo.com/video/<?php echo $pageV[1];?>" width="310" height="175" frameborder="0"></iframe>    
                                      <?php }else if($pageMain=='www.youtube.com'){
                                                $lkSharp=explode('&',$link->enlace);
                                                $linkY=explode('=',$lkSharp[0]);$id=$linkY[1];$len=strlen($id);
                                                for($i=0;$i<$len;$i++){($id[$i]=='&')?$idV=explode('&',$id):'';}/*(isset($idV[0]))?$id=$idV[0]:$id;*/?>
                                             <iframe class="youtube-player" type="text/html" width="460" height="210" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe>
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
                            </div><!-- DIV CUERPO DEL POSTEO **FIN** -->
                            <div class="prepend-1 span-14 last" style="margin-top: 8px;"><!-- DIV DEL MENU **INICIO** -->
                                <div class="span-1" style="margin-left: 20px">
                                    <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                         'width'=>'16',
                                                         'height'=>'12')); ?>
                                </div>
                                <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                                    <?php $fecha = unix_to_human($planes->planFechaCreacion);
                                          $fechaCreacion = fecha_acomodo($fecha);
                                          echo $fechaCreacion; ?>
                                </div>
                                <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **INICIO -->
                                <?php if($this->session->userdata('id') != $planes->planUsuarioId): ?>
                                    <div class="prepend-3 span-2" style="margin-left: -20px">
                                        &nbsp;
                                    </div>
                                    <div class="span-1">
                                        <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                             
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                              //'Ver todos,
                                                                         array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                    </div>
                                    <div class="span-1">
                                        <?php echo anchor('#',
                                                          img(array('src'=>'statics/img/botonEscribir.png',
                                                                    'width'=>'18px',//23px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'Comentar')),//'Comentar',
                                                          array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                    </div>
                                    <div class="span-1">
                                        <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $planes->planId); ?>
                                        <?php if($numeroUsuario == 0): ?>
                                            <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                              img(array('src'=>'statics/img/botonMeApunto.png',
                                                                        'width'=>'20px',//30px',
                                                                        'height'=>'15px',//20px',
                                                                        'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                              array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                            <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                              img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                        'width'=>'20px',//30px',
                                                                        'height'=>'15px',//20px',
                                                                        'title'=>'No voy')),
                                                          //'No voy',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>
                                        <?php else: ?>
                                            <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                              img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                        'width'=>'20px',//30px',
                                                                        'height'=>'15px',//20px',
                                                                        'title'=>'No voy')),
                                                          //'No voy',
                                                              array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>
                                            <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                              img(array('src'=>'statics/img/botonMeApunto.png',
                                                                        'width'=>'20px',//30px',
                                                                        'height'=>'15px',//20px',
                                                                        'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="prepend-3 span-2" style="margin-left: -20px">
                                        &nbsp;
                                    </div>
                                    <div class="span-1">
                                        <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                             
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                              
                                                                         array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                    </div>
                                    <div class="span-2">
                                        <?php echo anchor('#',
                                                          img(array('src'=>'statics/img/botonEscribir.png',
                                                                    'width'=>'18px',//23px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'Comentar')),//'Comentar',
                                                          array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                    </div>
                                    <div class="span-3 last">
                                        <?php echo anchor('planesusuarios/borrar_comentario/'.$planes->planId,
                                                          img(array('src'=>'statics/img/eliminar.png',
                                                                'width'=>'14px',
                                                                'height'=>'16px',
                                                                'title'=>'Eliminar')),//'Eliminar',
                                                          array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'eliminar', 'name'=>$planes->planId)); ?>
                                    </div>
                                <?php endif; ?>
                                <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **FIN** -->
                            </div><!-- DIV DEL MENU **FIN** -->
                            <div class="prepend-1 span-10" style="margin-left: 20px" id="meapunto"> <!-- DIV PARA LOS MENSAJES DE ME APUNTO **INICIO** -->
                            <?php $total = total_register($planes->planId); ?>
                            <?php if($total != 0): ?>
                                <?php if($total == 1): ?>
                                    <?php $val = get_point_simple($planes->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                            <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> y
                                        </span> 
                                        <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se han apuntado.
                                    </div>
                                <?php elseif($total == 2): ?>
                                    <?php $apuntados = get_point($planes->planId); ?> 
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
                                            <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                                y <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                                            </span> se han apuntado.
                                    </div>
                                <?php else: ?>
                                    <?php $apuntados = get_point($planes->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <?php $i = 1; ?>
                                        <?php foreach($apuntados as $meapunto): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                                   get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                                   array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                        <?php endforeach; ?>
                                        <span id="apuntados<?php echo $planes->planId; ?>" style="color: #8D6E98; display: none">
                                           <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>  
                                        </span> se han apuntado.
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="span-8 last" style="color: #8D6E98; display: none" id="apuntados<?php echo $planes->planId; ?>">
                                    <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                      get_complete_username($this->session->userdata('id')),
                                                      array('style'=>'color: #8D6E98; text-decoration: none')); ?> se ha apuntado
                                </div>
                                
                            <?php endif; ?>
                        </div><!-- DIV PARA LOS MENSAJES DE ME APUNTO **FIN** -->
                        </div><!-- FONDO **FIN** -->
                        <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                            <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$planes->planId.'/'.$this->session->userdata('id'),//$usuarios->id,
                                                 array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                                <div class="span-8" style="margin-left: 10px">
                                    <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                                   'class'=>'secondary-comment'.$planes->planId,
                                                                   'style'=>'width: 470px; height: 23px; color: #999999',
                                                                   'onkeypress'=>'subcomentar_enter(event,' . $planes->planId . ')',
                                                                   'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                                   'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                                   'value'=>'Comentar',
                                                                   'name'=>'comentar_muro')); ?>
                                </div>
                            <?php echo form_close(); ?>
                            <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                        </div><!-- DIV DEL FORMULARIO PARA COMENTARIOS **FIN** -->
                        <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE MUESTRA LOS COMENTARIOS **INICIO** -->
                            <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                <?php $valores_comentarios = count_all_subcomments($planes->planId, '1'); ?><!-- cuenta numero de comments-->
                                <?php if($valores_comentarios != 0): ?>
                                    <?php if($valores_comentarios > 3): ?>
                                        <?php $ids_comments = get_all_ids($planes->planId, '1'); ?><!--obtiene los ids de los comments -->
                                        <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                        <?php $comentarios = get_subcomments_wall1($planes->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                    <?php else: ?>
                                        <?php $comentarios = get_subcomments_wall($planes->planId, '1'); ?>
                                    <?php endif; ?>
                                    <?php foreach($comentarios as $comentario): ?><!-- FOREACH SUBCOMENTARIOS **INICIO** -->
                                        <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                            <div class="span-11 last"><!-- DIV INICIAL DE SUBCOMENTARIOS **INICIO** -->
                                                <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                                    <?php echo img(array('src'=>get_thumb_avatar($comentario->id)/*get_avatar($comentario->id),
                                                                         'width'=>'37px',
                                                                         'height'=>'37px'*/)); ?>
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
                                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                        <?php echo $comentario->comentarioSimple; ?>
                                                    </span>
                                                </div>
                                                <div class="prepend-1 span-12 last" style="margin-top: 12px">
                                                    <div class="span-1" style="margin-left: 25px">
                                                        <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                             'width'=>'14',
                                                                             'height'=>'12')); ?>
                                                    </div>
                                                    <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999;">
                                                        <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);
                                                              $fechaCreacionSub = fecha_acomodo($fecha);
                                                              echo $fechaCreacionSub; ?>
                                                    </div>
                                                    <div class="prepend-4 span-1 last" style="margin-left: 40px">
                                                        <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
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
                                    <?php endforeach; ?><!-- FOREACH SUBCOMENTARIOS **FIN** -->
                                <?php endif; ?>
                            </div>
                        </div><!-- DIV QUE MUESTRA LOS COMENTARIOS **FIN** -->
                    </div><!-- DIV CONTENEDOR DE DATOS MAIN **FIN** -->
                  <?php endif; ?>
                <?php else: ?><!-- REVISA SI POSTEA EL USUARIO LOGUEADO O NO **MEDIO** -->
                  <?php $val = get_posibility_friends($this->session->userdata('id'), $planes->planUsuarioId); ?>
                  <?php if($val != '0'): ?>
                    <?php $contadorAmigos = count_relation_friends($planes->planUsuarioId, $planes->planAmigoUsuarioId); ?>
                    <?php if($contadorAmigos > 0): ?>
                        <?php $status = get_status_user($planes->planAmigoUsuarioId); ?>
                            <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR DE DATOS MAIN **INICIO** -->
                                <div class="span-14 last" style="width: 524px"><!-- FONDO **INICIO** -->
                                    <div class="span-1">
                                        <?php if($status == '0'): ?>
                                            <?php echo img(array('src'=>get_thumb_avatar($planes->planAmigoUsuarioId)/*get_avatar($planes->planAmigoUsuarioId),
                                                                 'width'=>'37px',
                                                                 'height'=>'37px'*/)); ?>
                                        <?php else: ?>
                                            <?php $negocios = datos_negocios($planes->planAmigoUsuarioId); ?>
                                            <?php echo img(array('src'=>get_avatar_negocios($negocios->negocioId),
                                                                 'width'=>'37px',
                                                                 'height'=>'37px')); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="interlineado span-12 last" style="margin-top: 3px"><!-- DIV CUERPO DEL POSTEO **INICIO** -->
                                        <div style="margin-left: 20px" class="pulzos_titulo1">
                                            <span class="pulzos_titulo1">
                                                <?php if($status == '0'): ?>
                                                    <?php echo anchor('usuarios/perfil/'.$planes->planAmigoUsuarioId,
                                                                      get_complete_username($planes->planAmigoUsuarioId),
                                                                      array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                    a
                                                    <?php echo anchor('usuarios/perfil/'.$planes->planUsuarioId,
                                                                      get_complete_username($planes->planUsuarioId),
                                                                      array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                <?php else: ?>
                                                    <?php echo anchor('negocios/perfil/'.$negocios->negocioId,
                                                                      get_complete_username($planes->planAmigoUsuarioId),
                                                                      array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                    a
                                                    <?php echo anchor('usuarios/perfil/'.$planes->planUsuarioId,
                                                                      get_complete_username($planes->planUsuarioId),
                                                                      array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <div style="margin-top: 6px; margin-left: 20px; word-wrap: break-word;">
                                            <span class="pulzos_titulo2">
                                                <?php echo $planes->planDescripcion; ?>
                                            </span>
                                        </div>
                                        <div style="margin-top: 3px; margin-left: 20px; word-wrap: break-word;">
                                            <?php $total = count_number_register($planes->planId, 'anexos'); ?>
                                            <?php if($total != 0): ?>
                                                <?php  $tipo = count_type_register($planes->planId, 'anexos'); ?>
                                                <?php if($tipo->enlace != ''): ?>
                                                    <span class="pulzos_titulo2" style="color: #606060">
                                                       <?php 
                                                          $link = get_hipereference($planes->planId); 
                                                          $return_value = http_request($link->enlace);($return_value==FALSE)?$link->enlace='http://'.$link->enlace:'';
                                                          $divPages=explode('http://',$link->enlace);$page=explode('/',$divPages[1]);$pageMain=$page[0];
                                                          if($pageMain=='vimeo.com'){$pageV=explode('http://vimeo.com/',$link->enlace);?>
                                                        <iframe src="http://player.vimeo.com/video/<?php echo $pageV[1];?>" width="310" height="175" frameborder="0"></iframe>    
                                                  <?php }else if($pageMain=='www.youtube.com'){
                                                            $lkSharp=explode('&',$link->enlace);
                                                            $linkY=explode('=',$lkSharp[0]);$id=$linkY[1];$len=strlen($id);
                                                            for($i=0;$i<$len;$i++){($id[$i]=='&')?$idV=explode('&',$id):'';}/*(isset($idV[0]))?$id=$idV[0]:$id;*/?>
                                                         <iframe class="youtube-player" type="text/html" width="460" height="210" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe>
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
                                    </div><!-- DIV CUERPO DEL POSTEO **FIN** -->
                                    <div class="prepend-1 span-14 last" style="margin-top: 8px;"><!-- DIV DEL MENU **INICIO** -->
                                        <div class="span-1" style="margin-left: 20px">
                                            <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                                 'width'=>'16',
                                                                 'height'=>'12')); ?>
                                        </div>
                                        <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                                            <?php $fecha = unix_to_human($planes->planFechaCreacion);
                                                  $fechaCreacion = fecha_acomodo($fecha);
                                                  echo $fechaCreacion; ?>
                                        </div>
                                        <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **INICIO -->
                                        <?php if($this->session->userdata('id') != $planes->planUsuarioId): ?>
                                            <div class="prepend-3 span-2" style="margin-left: -20px">
                                                &nbsp;
                                            </div>
                                            <div class="span-1">
                                                <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                  'width'=>'18px',//23px',
                                                                                  'height'=>'15px',//20px',
                                                                                  'title'=>'Ver todos',
                                                                                  'style'=>'margin-left: 0px')),
                                                                        //'Ver todos',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                  'width'=>'18px',//23px',
                                                                                  'height'=>'15px',//20px',
                                                                                  'title'=>'Ver todos',
                                                                                  'style'=>'margin-left: 0px')),
                                                                        //'Ver todos',
                                                                         array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                            </div>
                                            <div class="span-1">
                                                <?php echo anchor('#',
                                                                  img(array('src'=>'statics/img/botonEscribir.png',
                                                                            'width'=>'18px',
                                                                            'height'=>'15px',
                                                                            'title'=>'Comentar')),//'Comentar',
                                                                  array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                            </div>
                                            <div class="span-1">
                                                <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $planes->planId); ?>
                                                <?php if($numeroUsuario == 0): ?>
                                                    <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                                      img(array('src'=>'statics/img/botonMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                                    <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                                      img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'No voy')),
                                                          //'No voy',
                                                                      array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>
                                                <?php else: ?>
                                                    <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                                      img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'No voy')),
                                                          //'No voy',
                                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>
                                                    <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                                      img(array('src'=>'statics/img/botonMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                                      array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="prepend-3 span-2" style="margin-left: -20px">
                                                &nbsp;
                                            </div>
                                            <div class="span-1">
                                                <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                  'width'=>'18px',//23px',
                                                                                  'height'=>'15px',//20px',
                                                                                  'title'=>'Ver todos',
                                                                                  'style'=>'margin-left: 0px')),
                                                                        //'Ver todos',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                  'width'=>'18px',//23px',
                                                                                  'height'=>'15px',//20px',
                                                                                  'title'=>'Ver todos',
                                                                                  'style'=>'margin-left: 0px')),
                                                                        //'Ver todos',
                                                                         array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                            </div>
                                            <div class="span-1">
                                                <?php echo anchor('#',
                                                                  img(array('src'=>'statics/img/botonEscribir.png',
                                                                            'width'=>'18px',
                                                                            'height'=>'15px',
                                                                            'title'=>'Comentar')),//'Comentar',
                                                                  array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                            </div>
                                            <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                                <div class="span-1"><!-- 3 last" -->
                                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$planes->planId,
                                                                      img(array('src'=>'statics/img/eliminar.png',
                                                                                'width'=>'14px',
                                                                                'height'=>'16px',
                                                                                'title'=>'Eliminar')),//'Eliminar',
                                                                      array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'eliminar', 'name'=>$planes->planId)); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **FIN** -->
                                    </div><!-- DIV DEL MENU **FIN** -->
                                    <div class="prepend-1 span-10" style="margin-left: 20px" id="meapunto"> <!-- DIV PARA LOS MENSAJES DE ME APUNTO **INICIO** -->
                            <?php $total = total_register($planes->planId); ?>
                            <?php if($total != 0): ?>
                                <?php if($total == 1): ?>
                                    <?php $val = get_point_simple($planes->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                            <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> y
                                        </span> 
                                        <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se han apuntado.
                                    </div>
                                <?php elseif($total == 2): ?>
                                    <?php $apuntados = get_point($planes->planId); ?> 
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
                                            <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                                y <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                                            </span> se han apuntado.
                                    </div>
                                <?php else: ?>
                                    <?php $apuntados = get_point($planes->planId); ?>
                                    <div class="span-12 last" style="color: #8D6E98">
                                        <?php $i = 1; ?>
                                        <?php foreach($apuntados as $meapunto): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                                   get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                                   array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                        <?php endforeach; ?>
                                        <span id="apuntados<?php echo $planes->planId; ?>" style="color: #8D6E98; display: none">
                                           <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                              get_complete_username($this->session->userdata('id')),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>  
                                        </span> se han apuntado.
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="span-8 last" style="color: #8D6E98; display: none" id="apuntados<?php echo $planes->planId; ?>">
                                    <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                      get_complete_username($this->session->userdata('id')),
                                                      array('style'=>'color: #8D6E98; text-decoration: none')); ?> se ha apuntado
                                </div>
                                <?php /*if($total == 1): ?>
                                    <?php $val = get_point_simple($planes->planId); ?>
                                    <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                      get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se ha apuntado.
                                <?php elseif($total == 2): ?>
                                    <?php $apuntados = get_point($planes->planId); ?>
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
                                    <?php $apuntados = get_point($planes->planId); ?>
                                    <?php $i = 1; ?>
                                    <?php foreach($apuntados as $meapunto): ?> 
                                        <?php if($i == 2): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                               get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                               array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                            <?php echo anchor('#',
                                                              'ver todos',
                                                              array('class'=>'mas-apuntados', 'style'=>'text-decoration: none; margin-left: 10px; color: #8D6E98')); ?>
                                            <?php echo anchor('#',
                                                              'ocultar todos',
                                                               array('class'=>'ocultar-apuntados', 'style'=>'text-decoration: none; margin-left: 10px; color: #8D6E98; display: none')); ?>
                                        <?php endif; ?> 
                                        <?php if($i == 3): ?>
                                            <?php $contarTodos = get_count_pointed($meapunto->meApuntoPlanId); ?>
                                            <?php $number_register = $contarTodos - 2; ?>
                                            <?php $menosDos = get_count_remaining($meapunto->meApuntoPlanId, $number_register); ?>
                                            <div class="div-muestra-apuntados span-10" style="display: none">
                                            <?php foreach($menosDos as $restantes): ?>
                                                <?php echo anchor('usuarios/perfil/'.$restantes->meApuntoUsuarioApuntadoId,
                                                                  get_complete_username($restantes->meApuntoUsuarioApuntadoId),
                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                            <?php endforeach; ?>
                                            </div>
                                            <?php break; ?>
                                        <?php endif; ?>
                                        <?php if($i == 1): ?>
                                            <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                              get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'mas-apuntados')); ?>,
                                        <?php endif; ?>
                                        <?php $i = $i + 1; ?>
                                    <?php endforeach; ?>
                                <?php //y <?php echo $total = $total - 2; ? > mas se han apuntado. ?>
                                <?php endif;*/ ?>
                            <?php endif; ?>
                        </div><!-- DIV PARA LOS MENSAJES DE ME APUNTO **FIN** -->
                                </div><!-- FONDO **FIN** -->
            
                                <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                    <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$planes->planId.'/'.$this->session->userdata('id'),//$usuarios->id,
                                                         array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                                        <div class="span-8" style="margin-left: 20px">
                                            <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                                           'class'=>'secondary-comment'.$planes->planId,
                                                                           'style'=>'width: 470px; height: 23px; color: #999999',
                                                                           'onkeypress'=>'subcomentar_enter(event,' . $planes->planId . ')',
                                                                           'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                                           'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                                           'value'=>'Comentar',
                                                                           'name'=>'comentar_muro')); ?>
                                        </div>
                                    <?php echo form_close(); ?>
                                    <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                                </div><!-- DIV DEL FORMULARIO PARA COMENTARIOS **FIN** -->

                                <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE MUESTRA LOS COMENTARIOS **INICIO** -->
                                    <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                        <?php $valores_comentarios = count_all_subcomments($planes->planId, '1'); ?><!-- cuenta numero de comments-->
                                        <?php if($valores_comentarios != 0): ?>
                                            <?php if($valores_comentarios > 3): ?>
                                                <?php $ids_comments = get_all_ids($planes->planId, '1'); ?><!--obtiene los ids de los comments -->
                                                <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                                <?php $comentarios = get_subcomments_wall1($planes->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                            <?php else: ?>
                                                <?php $comentarios = get_subcomments_wall($planes->planId, '1'); ?>
                                            <?php endif; ?>
                                            <?php foreach($comentarios as $comentario): ?><!-- FOREACH SUBCOMENTARIOS **INICIO** -->
                                                <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                                    <div class="span-11 last"><!-- DIV INICIAL DE SUBCOMENTARIOS **INICIO** -->
                                                        <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                                            <?php echo img(array('src'=>get_thumb_avatar($comentario->id)/*get_avatar($comentario->id),
                                                                                 'width'=>'37px',
                                                                                 'height'=>'37px'*/)); ?>
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
                                                                    <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                                                        <?php echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                                                         img(array('src'=>'statics/img/eliminar.png',
                                                                                                   'width'=>'14px',
                                                                                                   'height'=>'16px')),
                                                                                             array('class'=>'eliminar-sub')); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <br />
                                                            <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                                <?php echo $comentario->comentarioSimple; ?>
                                                            </span>
                                                        </div>
                                                        <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                                            <div class="span-1" style="margin-left: 25px">
                                                                <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                                     'width'=>'14',
                                                                                     'height'=>'12')); ?>
                                                            </div>
                                                            <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999;">
                                                                <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);
                                                                      $fechaCreacionSub = fecha_acomodo($fecha);
                                                                      echo $fechaCreacionSub; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **FIN** -->
                                            <?php endforeach; ?><!-- FOREACH SUBCOMENTARIOS **FIN** -->
                                        <?php endif; ?>
                                    </div>
                                </div><!-- DIV QUE MUESTRA LOS COMENTARIOS **FIN** --> 
                            </div><!-- DIV CONTENEDOR DE DATOS MAIN **FIN** -->
                  <?php endif; ?>
                <?php endif; ?><!-- REVISA SI POSTEA EL USUARIO LOGUEADO O NO **FIN** -->
              <?php endif; ?>
            <?php endif; ?><!-- FIN DE CONDICION PARA VER SI SON AMIGOS O ES DEL USUARIO LOGUEADO **FIN** -->
            <?php elseif($planes->planTipo == 8): ?>

            <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR DE DATOS MAIN **INICIO** -->
                <div class="span-14 last" style="width: 524px"><!-- FONDO **INICIO** -->
                    <div class="span-1">
                        <?php echo img(array('src'=>get_thumb_avatar($planes->planUsuarioId)/*get_avatar($planes->planUsuarioId),
                                              'width'=>'37px',
                                              'height'=>'37px'*/)); ?>
                    </div>
                    <div class="interlineado span-12 last" style="margin-top: 3px"><!-- DIV CUERPO DEL POSTEO **INICIO** -->
                        <div style="margin-left: 20px">
                            <span class="pulzos_titulo1">
                                <?php echo anchor('usuarios/perfil/'.$planes->planUsuarioId,
                                                    get_complete_username($planes->planUsuarioId),
                                                    array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                            </span>
                        </div>
                        <div style="margin-top: 6px; margin-left: 20px; word-wrap: break-word;">
                            <div class="span-13">
                                <div class="span-7">
                                    <span class="pulzos_titulo2">
                                        <?php echo $planes->planDescripcion; ?>
                                    </span>
                                </div>
                                <?php $coor = get_data_of_coordenade($planes->planScribbleId); ?>
                                <!-- PARTE DEL SCRIPT PARA EL MAPA DE PULZOS **INICIO**-->
                                <script type="text/javascript">
                                    var latLng = new google.maps.LatLng(<?php echo $coor->scribbleLat; ?>, <?php echo $coor->scribbleLng; ?>);//20.673040, -103.375854);
                                    var myOptions = {
                                        zoom: 15,
                                        center: latLng,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                    };
                                    var map = new google.maps.Map($(".mapa<?php echo $planes->planId; ?>").get(0), myOptions);
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
                                <div class="span-6 last" style="margin-top: 10px; margin-left: -10px">
                                    <div class="span-8 last" id="mapa_fondo" style="margin-top: -20px">
                                        <div class="pulzos_titulo1 span-6" style="margin-top: 15px; color: #FFFFFF; text-align:; margin-left: 80px;">
                                            ¿D&oacute;nde lo dijo?
                                        </div>
                                        <div class="mapa<?php echo $planes->planId; ?>" style="width: 200px; height: 100px; margin-left: 25px; margin-top: 40px"></div>
                                    </div>
                                    
                                </div>
                                <?php $ik = $ik+1; ?>
                            </div>
                        </div> 
                        <div style="margin-top: 3px; margin-left: 20px; word-wrap: break-word;">
                            <?php $total = count_number_register($planes->planId, 'anexos'); ?>
                            <?php if($total != 0): ?>
                                <?php  $tipo = count_type_register($planes->planId, 'anexos'); ?>
                                <?php if($tipo->enlace != ''): ?>
                                    <span class="pulzos_titulo2" style="color: #606060">
                                        <?php 
                                            $link = get_hipereference($planes->planId); 
                                            $return_value = http_request($link->enlace);($return_value==FALSE)?$link->enlace='http://'.$link->enlace:'';
                                            $divPages=explode('http://',$link->enlace);$page=explode('/',$divPages[1]);$pageMain=$page[0];
                                            //echo $pageMain.'<br>';
                                            if($pageMain=='vimeo.com'){$pageV=explode('http://vimeo.com/',$link->enlace);?>
                                                <iframe src="http://player.vimeo.com/video/<?php echo $pageV[1];?>" width="460" height="290" frameborder="0"></iframe>    
                                        <?php }else if($pageMain=='www.youtube.com'){
                                                $lkSharp=explode('&',$link->enlace);
                                                $linkY=explode('=',$lkSharp[0]);$id=$linkY[1];$len=strlen($id);
                                                for($i=0;$i<$len;$i++){($id[$i]=='&')?$idV=explode('&',$id):'';}/*(isset($idV[0]))?$id=$idV[0]:$id;*/?>
                                             <iframe class="youtube-player" type="text/html" width="460" height="290" src="http://www.youtube.com/embed/<?php echo $id;?>" frameborder="0"></iframe><?php 
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
                                        <?php /*echo anchor($tipo->foto,
                                                              img(array('src'=>$tipo->foto,
                                                                        'width'=>'100',
                                                                        'height'=>'85')),
                                                              array('style'=>'text-decoration: none;'));*/ ?>
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div><!-- DIV CUERPO DEL POSTEO **FIN** -->
                    <div class="span-10 last" style="margin-top: -31px; margin-left: 5px; word-wrap: break-word">
                        <div style="margin-top: 8px" class="span-1">
                            <?php echo img(array('src'=>'statics/img/scribble.jpg',
                                                 'width'=>'16px',
                                                 'height'=>'16px')); ?>
                        </div>
                        <div class="span-5" style="margin-top: 8px; margin-left: -15px; color: #999999">
                            Desde Pulzos GeoTagging 
                        </div>
                    </div>
                    <div class="prepend-1 span-14 last" style="margin-top: 8px;"><!-- DIV DEL MENU **INICIO** -->
                        <div class="span-1" style="margin-left: 20px">
                            <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                 'width'=>'16',
                                                 'height'=>'12')); ?>
                        </div>
                        <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                            <?php $fecha = unix_to_human($planes->planFechaCreacion);
                                  $fechaCreacion = fecha_acomodo($fecha);
                                  echo $fechaCreacion; ?>
                        </div>
                        <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **INICIO -->
                        <?php if($this->session->userdata('id') != $planes->planUsuarioId): ?>
                            <div class="prepend-3 span-2" style="margin-left: -20px">
                                &nbsp;
                            </div>
                            <div class="span-1">
                                <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Ver todos')),
                                                                        //'Ver todos',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 12px', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Ver todos')),
                                                                        //'Ver todos',
                                                                         array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 12px', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                            </div>
                            <div class="span-1">
                                <?php echo anchor('#',
                                                  img(array('src'=>'statics/img/botonEscribir.png',
                                                                'width'=>'18px',//23px',
                                                                'height'=>'15px',//20px',
                                                                'title'=>'Comentar')),//'Comentar',
                                                  array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -3px', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                            </div>
                            <div class="span-1">
                                <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $planes->planId); ?>
                                <?php if($numeroUsuario == 0): ?>
                                    <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                      img(array('src'=>'statics/img/botonMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -20px', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                    <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                      img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'No voy')),
                                                          //'No voy',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>                         
                                <?php else: ?>
                                    <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$planes->planId,
                                                      img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'No voy')),
                                                          //'No voy',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -20px', 'id'=>'No'.$planes->planId, 'class'=>'novoy', 'name'=>$planes->planId)); ?>
                                    <?php echo anchor('planesusuarios/me_apunto/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                      img(array('src'=>'statics/img/botonMeApunto.png',
                                                                    'width'=>'20px',//30px',
                                                                    'height'=>'15px',//20px',
                                                                    'title'=>'Me apunto')),
                                                          //'Me apunto',
                                                      array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px', 'id'=>'Si'.$planes->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="prepend-3 span-2" style="margin-left: -20px">
                                &nbsp;
                            </div>
                            <div class="span-1">
                                <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Ver todos')),
                                                                        //'Ver todos',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 13px', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Ver todos')),
                                                                        //'Ver todos',
                                                                        array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 13px', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                            </div>
                            <div class="span-1">
                                <?php echo anchor('#',
                                                  img(array('src'=>'statics/img/botonEscribir.png',
                                                                'width'=>'18px',//23px',
                                                                'height'=>'15px',//20px',
                                                                'title'=>'Comentar')),//'Comentar',
                                                  array('style'=>'color: #8D6E98; text-decoration: none; margin-left: 0px', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                            </div>
                            <div class="span-1">
                                <?php echo anchor('planesusuarios/borrar_comentario_negocio/'.$planes->planId.'/'.$planes->planScribbleId,
                                                  img(array('src'=>'statics/img/eliminar.png',
                                                                'width'=>'14px',
                                                                'height'=>'16px',
                                                                'title'=>'Eliminar')),//'Eliminar',
                                                  array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -15px', 'class'=>'eliminar-scribble', 'name'=>$planes->planId)); ?>
                            </div>
                        <?php endif; ?>
                        <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **FIN** -->
                    </div><!-- DIV DEL MENU **FIN** -->
                    <div class="prepend-1 span-10" style="margin-left: 20px" id="meapunto"> <!-- DIV PARA LOS MENSAJES DE ME APUNTO **INICIO** -->
                        <?php $total = total_register($planes->planId); ?>
                        <?php if($total != 0): ?>
                            <?php if($total == 1): ?>
                                <?php $val = get_point_simple($planes->planId); ?>
                                <div class="span-12 last" style="color: #8D6E98">
                                    <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                        <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                            get_complete_username($this->session->userdata('id')),
                                                            array('style'=>'text-decoration: none; color: #8D6E98')); ?> y
                                    </span> 
                                    <?php echo anchor('usuarios/perfil/'.$val->meApuntoUsuarioApuntadoId,
                                                        get_complete_username($val->meApuntoUsuarioApuntadoId),
                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?> se han apuntado.
                                </div>
                            <?php elseif($total == 2): ?>
                                <?php $apuntados = get_point($planes->planId); ?> 
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
                                        <span id="apuntados<?php echo $planes->planId; ?>" style="display: none">
                                            y <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                            get_complete_username($this->session->userdata('id')),
                                                            array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                                        </span> se han apuntado.
                                </div>
                            <?php else: ?>
                                <?php $apuntados = get_point($planes->planId); ?>
                                <div class="span-12 last" style="color: #8D6E98">
                                    <?php $i = 1; ?>
                                    <?php foreach($apuntados as $meapunto): ?>
                                        <?php echo anchor('usuarios/perfil/'.$meapunto->meApuntoUsuarioApuntadoId,
                                                            get_complete_username($meapunto->meApuntoUsuarioApuntadoId),
                                                            array('style'=>'text-decoration: none; color: #8D6E98')); ?>,
                                    <?php endforeach; ?>
                                    <span id="apuntados<?php echo $planes->planId; ?>" style="color: #8D6E98; display: none">
                                        <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                        get_complete_username($this->session->userdata('id')),
                                                        array('style'=>'text-decoration: none; color: #8D6E98')); ?>  
                                    </span> se han apuntado.
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="span-8 last" style="color: #8D6E98; display: none" id="apuntados<?php echo $planes->planId; ?>">
                                <?php echo anchor('usuarios/perfil/'.$this->session->userdata('id'),
                                                    get_complete_username($this->session->userdata('id')),
                                                    array('style'=>'color: #8D6E98; text-decoration: none')); ?> se ha apuntado
                            </div>
                                
                            <?php endif; ?>
                        </div><!-- DIV PARA LOS MENSAJES DE ME APUNTO **FIN** -->
                    </div><!-- FONDO **FIN** -->

                    <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                        <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$planes->planId.'/'.$this->session->userdata('id'),//$usuarios->id,
                                             array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                            <div class="span-8" style="margin-left: 10px">
                                <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                               'class'=>'secondary-comment'.$planes->planId,
                                                               'style'=>'width: 470px; height: 23px; color: #999999',
                                                               'onkeypress'=>'subcomentar_enter(event,' . $planes->planId . ')',
                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                               'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                               'value'=>'Comentar',
                                                               'name'=>'comentar_muro')); ?>
                            </div>
                            <?php //echo form_submit('a', 'a'); ?>
                        <?php echo form_close(); ?>
                        <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                    </div><!-- DIV DEL FORMULARIO PARA COMENTARIOS **FIN** -->                

                    <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE MUESTRA LOS COMENTARIOS **INICIO** -->
                        <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                            <?php $valores_comentarios = count_all_subcomments($planes->planId, '1'); ?><!-- cuenta numero de comments-->
                            <?php if($valores_comentarios != 0): ?>
                                <?php if($valores_comentarios > 3): ?>
                                    <?php $ids_comments = get_all_ids($planes->planId, '1'); ?><!--obtiene los ids de los comments -->
                                    <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                    <?php $comentarios = get_subcomments_wall1($planes->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                <?php else: ?>
                                    <?php $comentarios = get_subcomments_wall($planes->planId, '1'); ?>
                                <?php endif; ?>                            
                                <?php foreach($comentarios as $comentario): ?><!-- FOREACH SUBCOMENTARIOS **INICIO** -->
                                    <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                        <div class="span-11 last"><!-- DIV INICIAL DE SUBCOMENTARIOS **INICIO** -->
                                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                                <?php echo img(array('src'=>get_thumb_avatar($comentario->id)/*get_avatar($comentario->id),
                                                                     'width'=>'37px',
                                                                     'height'=>'37px'*/)); ?>
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
                                                <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                    <?php echo $comentario->comentarioSimple; ?>
                                                </span>
                                            </div>
                                            <div class="prepend-1 span-12 last" style="margin-top: 12px">
                                                <div class="span-1" style="margin-left: 25px">
                                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                         'width'=>'14',
                                                                         'height'=>'12')); ?>
                                                </div>
                                                <div class="span-4" style="margin-left: -20px; margin-top: -3px; font-size: 9pt; color: #999999;">
                                                    <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);
                                                          $fechaCreacionSub = fecha_acomodo($fecha);
                                                          echo $fechaCreacionSub; ?>
                                                </div>
                                                <div class="prepend-4 span-1 last" style="margin-left: 40px">
                                                	<?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                                		<?php echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                                             img(array('src'=>'statics/img/eliminar.png',
                                                                                       'width'=>'14px',
                                                                                       'height'=>'16px')),
                                                                             array('class'=>'eliminar-sub')); ?>
                                                	<?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **FIN** -->
                                <?php endforeach; ?><!-- FOREACH SUBCOMENTARIOS **FIN** -->
                            <?php endif; ?>
                        </div>
                    </div><!-- DIV QUE MUESTRA LOS COMENTARIOS **FIN** --> 
                </div><!-- DIV CONTENEDOR DE DATOS MAIN **FIN** -->
        <?php else: ?><!-- SI SON PLANES QUE SE CREARON -->
            <?php $valor = get_posibility_friends($planes->planUsuarioId, $this->session->userdata('id')); ?>
            <?php if(($valor != '0') || ($this->session->userdata('id') == $planes->planUsuarioId)): ?>
                <?php if(($planes->planTipo == 2) || ($planes->planTipo == 3) || ($planes->planTipo == 4) || 
                         ($planes->planTipo == 5) || ($planes->planTipo == 6)): ?>
                <?php elseif(($planes->planEmpresaPosteo != 0) && ($planes->planEmpresaPulzoId != 0)): ?><!-- DIV FORMA DE LOS PULZOS, RETOS Y EXPERIENCIAS DE LAS EMPRESAS -->
                    <div class="span-13" style="margin-top: 5px; margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV FORMA PULZOS **INICIO** -->
                        <?php $datosPulzos = get_data_pulzos($planes->planEmpresaPulzoId, $planes->planEmpresaPosteo); ?>
                        <?php if(! empty($datosPulzos)): ?>
                            <?php if($datosPulzos->pulzoTipo == 0): ?>
                                <div class="span-14 last" style="width: 524px"><!-- DIV CUERPO **INICIO** -->
                                    <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                                        <?php echo img(array('src'=>get_avatar_negocios($datosPulzos->pulzoUsuarioId),
                                                             'width'=>'36px',
                                                             'height'=>'36px')); ?>
                                    </div><!-- DIV AVATAR **FIN** -->
                                    <div class="span-12 last" style="word-wrap: break-word; margin-left: 10px"><!-- DIV CUERPO PRINCIPAL **INICIO** -->
                                        <span class="pulzos_titulo1">
                                            <?php echo anchor('negocios/perfil/'.$datosPulzos->pulzoUsuarioId,
                                                              get_complete_username($planes->planUsuarioId),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo2">
                                            <?php echo $datosPulzos->pulzoTitulo; ?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo1">
                                            Fecha Inicio:
                                        </span>
                                        <span class="pulzos_titulo2">
                                            <?php $fechaI = unix_to_human($datosPulzos->pulzoFechaInicio);
                                                  $inicio = fecha_acomodo($fechaI);
                                                  echo $inicio; ?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo1">
                                            Tipo:
                                        </span>
                                        <span class="pulzos_titulo2">
                                            Pulzo
                                        </span>
                                    </div><!-- DIV CUERPO PRINCIPAL **FIN** -->
                                    <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION PULZO **INICIO** -->
                                        <div class="span-2">
                                            <?php if($datosPulzos->pulzoImagenRuta == '0'): ?>
                                                <?php echo img(array('src'=>get_avatar_negocios($datosPulzos->pulzoUsuarioId),
                                                                     'width'=>'100px',
                                                                     'height'=>'100px')); ?>
                                            <?php else: ?>
                                                <?php echo img(array('src'=>$datosPulzos->pulzoImagenRuta,
                                                                     'width'=>'100px',
                                                                     'height'=>'100px')); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="prepend-1 span-10 last" style="margin-top: 5px">
                                            <span class="pulzos_titulo2">
                                                <?php echo anchor('pulzos/ver_simple/'.$datosPulzos->pulzoId,
                                                                  $datosPulzos->pulzoAccion,
                                                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-empresa')); ?>
                                            </span>
                                        </div>                    
                                    </div><!-- DIV DEL CUERPO DESCRIPCION DEL PULZO **FIN** -->
                                   <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                                        <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                                            <?php echo anchor('#',
                                                              'Aviso Legal:',
                                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$datosPulzos->pulzoId, 'id'=>'ver-'.$datosPulzos->pulzoId)); ?>
                                            <?php echo anchor('#',
                                                              'Aviso Legal:',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$datosPulzos->pulzoId, 'id'=>'ocultar-'.$datosPulzos->pulzoId)); ?>
                                        </div>
                                    </div>
                                    <div style="display: none; margin-bottom: 5px" id="aviso-legal-<?php echo $datosPulzos->pulzoId; ?>">
                                        <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                                            <?php echo $datosPulzos->pulzoAvisoLegal; ?>    
                                        </div>
                                    </div><!-- DIV AVISO LEGAL **FIN** --> 
                                    <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                                        <div class="span-6">
                                            &nbsp;
                                        </div>
                                        <div class="prepend-1 span-2">
                                            <?php echo anchor('pulzos/ver_simple/'.$datosPulzos->pulzoId,
                                                              'Ver mas',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas-empresa')); ?>
                                        </div>
                                        <div class="span-2">
                                            <?php echo anchor('#',
                                                              'Comentar',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px', 'class'=>'comentar-plan', 'id'=>$planes->planId)); ?>
                                        </div>
                                        <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                            <div class="span-1">
                                                <?php echo anchor('planesusuarios/borrar_pulzos/'.$datosPulzos->pulzoId,
                                                                  'Eliminar',
                                                                  array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -5px;', 'class'=>'eliminar-pulzo')); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="span-1">
                                                <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planes->planId.'/'.$datosPulzos->pulzoId,
                                                                  'Reservar',
                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                        <?php echo form_open('planesusuarios/subcomentarios_pulzos_post/'.$datosPulzos->pulzoId.'/'.$datosPulzos->pulzoUsuarioId.'/'.$this->session->userdata('id'),//negocios/guardar_comentarios_pulzo/'.$this->session->userdata('id').'/'.$datosPost->planId,
                                                             array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                                            <div class="span-8" style="margin-left: 6px">
                                                <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                                               'class'=>'secondary-comment'.$planes->planId,
                                                                               'style'=>'width: 470px; height: 23px; color: #999999',
                                                                               'value'=>'Comentar',
                                                                               'onkeypress'=>'subcomentar_enter_company(event,' . $planes->planId . ')',
                                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'name'=>'comentar_muro')); ?>
                                            </div>
                                        <?php echo form_close(); ?>
                                        <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                                    </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                                    <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                                        <?php $valoresPulzos = count_all_pulzos_comments_data($datosPulzos->pulzoId); ?>
                                        <?php if($valoresPulzos != 0): ?>
                                            <?php if($valoresPulzos > 3): ?>
                                                <?php $ids_comments = get_all_ids_pulzo($datosPulzos->pulzoId); ?>
                                                <?php $get_last_id_pulzo = get_last_id_comment_pulzo($ids_comments, $valoresPulzos); ?>
                                                <?php $pulzos_post = get_pulzos_subcomments1($datosPulzos->pulzoId, $get_last_id_pulzo); ?>
                                            <?php else: ?>
                                                <?php $pulzos_post = get_pulzos_subcomments($datosPulzos->pulzoId); ?>
                                            <?php endif; ?>
                                            <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                                <?php foreach($pulzos_post as $posteos): ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **INICIO** -->
                                                    <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                                        <div class="span-11 last"><!-- DIV DE LOS SUBCOMENTARIOS **INICIO** -->
                                                            <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                                                <?php $datos_like_user = get_complete_userdata($posteos->comentarioUsuarioId); ?>
                                                                <?php if($datos_like_user->statusEU == 0): ?>
                                                                    <?php echo img(array('src'=>get_thumb_avatar($posteos->comentarioUsuarioId)/*get_avatar($posteos->comentarioUsuarioId),
                                                                                         'width'=>'36px',
                                                                                         'height'=>'36px'*/)); ?>
                                                                <?php else: ?>
                                                                    <?php $datos_negocios = get_data_company($posteos->comentarioUsuarioId); ?>
                                                                    <?php echo img(array('src'=>get_avatar_negocios($datos_negocios->negocioId),
                                                                                         'width'=>'36px',
                                                                                         'height'=>'36px')); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="span-9 last" style="margin-top: 5px; margin-left: 10px">
                                                                <div class="span-12">
                                                                    <div class="span-9">
                                                                        <span class="pulzos_titulo1">
                                                                            <?php if($datos_like_user->statusEU == 0): ?>
                                                                                <?php echo anchor('usuarios/perfil/'.$posteos->comentarioUsuarioId,
                                                                                                  get_complete_username($posteos->comentarioUsuarioId),
                                                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                            <?php else: ?>
                                                                                <?php echo anchor('negocios/perfil/'.$datos_negocios->negocioId,
                                                                                                  get_complete_username($posteos->comentarioUsuarioId),
                                                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                            <?php endif; ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="span-2 last">
                                                                        <?php if($this->session->userdata('idN') == $datosPulzos->pulzoUsuarioId): ?>
                                                                            <?php echo anchor('#',
                                                                                              img(array('src'=>'statics/img/cerrar.jpg',
                                                                                                        'width'=>'14px',
                                                                                                        'height'=>'12px')),
                                                                                              array('class'=>'eliminar-pulzo')); ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <br />
                                                                <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                                    <?php echo $posteos->comentarioTexto; ?>
                                                                </span>
                                                            </div>
                                                            <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                                                <div class="span-1" style="margin-left: 20px">
                                                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                                         'width'=>'14px',
                                                                                         'height'=>'12px')); ?>
                                                                </div>
                                                                <div class="span-4" style="margin-left: -20px; magin-top: -3px; font-size: 9pt; color: #999999">
                                                                    <?php $fecha = unix_to_human($posteos->comentarioFechaCreacion);
                                                                          $fechaCreacionSub = fecha_acomodo($fecha);
                                                                          echo $fechaCreacionSub;
                                                                     ?>
                                                                </div>
                                                            </div>
                                                        </div><!-- DIV DE LOS SUBCOMENTARIOS **FIN** -->
                                                    </div>
                                                <?php endforeach; ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **FIN** -->
                                            </div>
                                        <?php endif; ?>
                                    </div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **FIN** -->
                                </div><!-- DIV CUERPO **FIN** -->
                            <?php elseif($datosPulzos->pulzoTipo == 1): ?>
                                <?php $a=$a+1;?>
                                <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                                    <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                                        <?php echo img(array('src'=>get_avatar_negocios($datosPulzos->pulzoUsuarioId),
                                                             'width'=>'37px',
                                                             'height'=>'37px')); ?>
                                    </div><!-- DIV AVATAR **FIN** -->
                                    <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word"><!-- DIV DEL CUERPO DEL MENSAJE PULZO **RETO** -->
                                        <span class="pulzos_titulo1">
                                            <?php echo anchor('negocios/perfil/'.$datosPulzos->pulzoUsuarioId,
                                                              get_complete_username($planes->planUsuarioId),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo2">
                                            <?php echo $datosPulzos->pulzoTitulo; ?>
                                        </span>
                                        <br />
                                        <?php if($datosPulzos->pulzoTipoEventoId == 1): ?>
                                            <span class="pulzos_titulo2">
                                                Reto de Consumo
                                            </span>
                                        <?php elseif($datosPulzos->pulzoTipoEventoId == 2): ?>
                                            <span class="pulzos_titulo1">
                                                Vence en:
                                            </span>
                                            <span>
                                            <?php $a=$a+1;?>
                                                 <!--reloj-->
                                                <script language="javascript">
												
												
												var tiempotras=new Date();
												var textofecha='<?php echo $datosPulzos->pulzoDuracionReto; ?>';
												var auxf=textofecha.split("-");
												var nueva=auxf[0]+" "+auxf[1]+","+auxf[2]+" "+auxf[3]+":"+auxf[4]+":00";
												var tiempotras=new Date();
												var textofecha='<?php echo $datosPulzos->pulzoDuracionReto; ?>';
												var auxf=textofecha.split("-");
												var nueva=auxf[0]+" "+auxf[1]+","+auxf[2]+" "+auxf[3]+":"+auxf[4]+":00";
												
											
													maniana=new Date(nueva);
													maniana1=new Date();
													if(maniana<=maniana1){start(nueva,tiempotras,'countdowncontainerq<?php echo $a;?>');}
												
												
												</script>
                                                <div id="countdowncontainerq<?php echo $a;?>" style=" background:#DDEACF;  border:0px; border: 0px solid #399210; color:#006600; width:250px; height:27px;">aun falta para empezar </div>
                                                                                        </span>
                                        <?php elseif($datosPulzos->pulzoTipoEventoId == 3): ?>
                                            <span class="pulzos_titulo2">
                                                Reto de Actividad
                                            </span>
                                        <?php elseif($datosPulzos->pulzoTipoEventoId == 4): ?>
                                            <span class="pulzos_titulo1">
                                                No. de Integrantes:
                                            </span>
                                            <span class="pulzos_titulo2">
                                                <?php echo $datosPulzos->pulzoNumeroAsistentes; ?>
                                            </span>
                                        <?php elseif($datosPulzos->pulzoTipoEventoId == 5): ?>
                                            <span class="pulzos_titulo2">
                                                Otros
                                            </span>
                                        <?php endif; ?>
                                        <br />
                                        <span class="pulzos_titulo1">
                                            Tipo:
                                        </span>
                                        <span class="pulzos_titulo2">
                                            Reto
                                        </span>
                                    </div><!-- DIV DEL CUERPO DEL MENSAJE DEL RETO **FIN** --> 
                                    <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION PULZO **INICIO** -->
                                        <div class="span-2">
                                            <?php if($datosPulzos->pulzoImagenRuta == '0'): ?>
                                                <?php echo img(array('src'=>get_avatar_negocios($datosPulzos->pulzoUsuarioId),
                                                                     'width'=>'100px',
                                                                     'height'=>'100px')); ?>
                                            <?php else: ?>
                                                <?php echo img(array('src'=>$datosPulzos->pulzoImagenRuta,
                                                                     'width'=>'100px',
                                                                     'height'=>'100px')); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="prepend-1 span-10 last" style="margin-top: 5px">
                                            <span class="pulzos_titulo2">
                                                <?php echo anchor('retosnegocios/ver_reto/'.$datosPulzos->pulzoId,
                                                                  $datosPulzos->pulzoAccion,
                                                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-empresa')); ?>
                                            </span>
                                        </div>                    
                                    </div><!-- DIV DEL CUERPO DESCRIPCION DEL PULZO **FIN** -->
                                    <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                                        <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                                            <?php echo anchor('#',
                                                              'Aviso Legal:',
                                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$datosPulzos->pulzoId, 'id'=>'ver-'.$datosPulzos->pulzoId)); ?>
                                            <?php echo anchor('#',
                                                              'Aviso Legal:',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$datosPulzos->pulzoId, 'id'=>'ocultar-'.$datosPulzos->pulzoId)); ?>
                                        </div>
                                    </div>
                                    <div style="display: none; margin-bottom: 5px" id="aviso-legal-<?php echo $datosPulzos->pulzoId; ?>">
                                        <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                                            <?php echo $datosPulzos->pulzoAvisoLegal; ?>    
                                        </div>
                                    </div><!-- DIV AVISO LEGAL **FIN** -->
                                    <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                                        <div class="span-6">
                                            &nbsp;
                                        </div>
                                        <div class="prepend-1 span-2">
                                            <?php echo anchor('retosnegocios/ver_reto/'.$datosPulzos->pulzoId,
                                                              'Ver mas',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas-empresa')); ?>
                                        </div>
                                        <div class="span-2">
                                            <?php echo anchor('#',
                                                              'Comentar',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px', 'class'=>'comentar-plan', 'id'=>$planes->planId)); ?>
                                        </div>
                                        <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                            <div class="span-1">
                                                <?php echo anchor('planesusuarios/borrar_pulzos/'.$datosPulzos->pulzoId,
                                                                  'Eliminar',
                                                                  array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -5px;', 'class'=>'eliminar-pulzo')); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="span-1">
                                                <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planes->planId.'/'.$datosPulzos->pulzoId,
                                                                  'Reservar',
                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                        <?php echo form_open('planesusuarios/subcomentarios_pulzos_post/'.$datosPulzos->pulzoId.'/'.$datosPulzos->pulzoUsuarioId.'/'.$this->session->userdata('id'),//negocios/guardar_comentarios_pulzo/'.$this->session->userdata('id').'/'.$datosPost->planId,
                                                             array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                                            <div class="span-8" style="margin-left: 6px">
                                                <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                                               'class'=>'secondary-comment'.$planes->planId,
                                                                               'style'=>'width: 470px; height: 23px; color: #999999',
                                                                               'value'=>'Comentar',
                                                                               'onkeypress'=>'subcomentar_enter_company(event,' . $planes->planId . ')',
                                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'name'=>'comentar_muro')); ?>
                                            </div>
                                        <?php echo form_close(); ?>
                                        <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                                    </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                                    <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                                        <?php $valoresPulzos = count_all_pulzos_comments_data($datosPulzos->pulzoId); ?>
                                        <?php if($valoresPulzos != 0): ?>
                                            <?php if($valoresPulzos > 3): ?>
                                                <?php $ids_comments = get_all_ids_pulzo($datosPulzos->pulzoId); ?>
                                                <?php $get_last_id_pulzo = get_last_id_comment_pulzo($ids_comments, $valoresPulzos); ?>
                                                <?php $pulzos_post = get_pulzos_subcomments1($datosPulzos->pulzoId, $get_last_id_pulzo); ?>
                                            <?php else: ?>
                                                <?php $pulzos_post = get_pulzos_subcomments($datosPulzos->pulzoId); ?>
                                            <?php endif; ?>
                                            <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                                <?php foreach($pulzos_post as $posteos): ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **INICIO** -->
                                                    <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                                        <div class="span-11 last"><!-- DIV DE LOS SUBCOMENTARIOS **INICIO** -->
                                                            <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                                                <?php $datos_like_user = get_complete_userdata($posteos->comentarioUsuarioId); ?>
                                                                <?php if($datos_like_user->statusEU == 0): ?>
                                                                    <?php echo img(array('src'=>get_thumb_avatar($posteos->comentarioUsuarioId)/*get_avatar($posteos->comentarioUsuarioId),
                                                                                         'width'=>'36px',
                                                                                         'height'=>'36px'*/)); ?>
                                                                <?php else: ?>
                                                                    <?php $datos_negocios = get_data_company($posteos->comentarioUsuarioId); ?>
                                                                    <?php echo img(array('src'=>get_avatar_negocios($datos_negocios->negocioId),
                                                                                         'width'=>'36px',
                                                                                         'height'=>'36px')); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="span-9 last" style="margin-top: 5px; margin-left: 10px">
                                                                <div class="span-12">
                                                                    <div class="span-9">
                                                                        <span class="pulzos_titulo1">
                                                                            <?php if($datos_like_user->statusEU == 0): ?>
                                                                                <?php echo anchor('usuarios/perfil/'.$posteos->comentarioUsuarioId,
                                                                                                  get_complete_username($posteos->comentarioUsuarioId),
                                                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                            <?php else: ?>
                                                                                <?php echo anchor('negocios/perfil/'.$datos_negocios->negocioId,
                                                                                                  get_complete_username($posteos->comentarioUsuarioId),
                                                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                            <?php endif; ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="span-2 last">
                                                                        <?php if($this->session->userdata('idN') == $datosPulzos->pulzoUsuarioId): ?>
                                                                            <?php echo anchor('#',
                                                                                              img(array('src'=>'statics/img/cerrar.jpg',
                                                                                                        'width'=>'14px',
                                                                                                        'height'=>'12px')),
                                                                                              array('class'=>'eliminar-pulzo')); ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <br />
                                                                <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                                    <?php echo $posteos->comentarioTexto; ?>
                                                                </span>
                                                            </div>
                                                            <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                                                <div class="span-1" style="margin-left: 20px">
                                                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                                         'width'=>'14px',
                                                                                         'height'=>'12px')); ?>
                                                                </div>
                                                                <div class="span-4" style="margin-left: -20px; magin-top: -3px; font-size: 9pt; color: #999999">
                                                                    <?php $fecha = unix_to_human($posteos->comentarioFechaCreacion);
                                                                          $fechaCreacionSub = fecha_acomodo($fecha);
                                                                          echo $fechaCreacionSub;
                                                                     ?>
                                                                </div>
                                                            </div>
                                                        </div><!-- DIV DE LOS SUBCOMENTARIOS **FIN** -->
                                                    </div>
                                                <?php endforeach; ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **FIN** -->
                                            </div>
                                        <?php endif; ?>
                                    </div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **FIN** -->
                                </div><!-- DIV DEL CUERPO **FIN** -->
                            <?php elseif($datosPulzos->pulzoTipo == 2): ?>
                                <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                                    <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                                        <?php echo img(array('src'=>get_avatar_negocios($datosPulzos->pulzoUsuarioId),
                                                             'width'=>'37px',
                                                             'height'=>'37px')); ?>
                                    </div><!-- DIV AVATAR **FIN** -->
                                    <div class="interlineado span-12 last" style="margin-left: 10px; word-wrap: break-word"><!-- DIV DEL CUERPO DEL MENSAJE **INICIO** -->
                                        <span class="pulzos_titulo1">
                                            <?php echo anchor('negocios/perfil/'.$datosPulzos->pulzoUsuarioId,
                                                              get_complete_username($planes->planUsuarioId),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo2">
                                            <?php echo $datosPulzos->pulzoTitulo; ?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo1">
                                            Fecha Inicio:
                                        </span>
                                        <span class="pulzos_titulo2">
                                            <?php $fechaI = unix_to_human($datosPulzos->pulzoFechaInicio);
                                                  $inicio = fecha_acomodo($fechaI);
                                                  echo $inicio; ?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo1">
                                            Tipo:
                                        </span>
                                        <span class="pulzos_titulo2">
                                            Experiencia de Vida
                                        </span>
                                    </div><!-- DIV DEL CUERPO DEL MENSAJE **FIN** -->
                                    <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION DE LA EXPERIENCIA **INICIO** -->
                                        <div class="span-2">
                                            <?php if($datosPulzos->pulzoImagenRuta == '0'): ?>
                                                <?php echo img(array('src'=>get_avatar_negocios($datosPulzos->pulzoUsuarioId),
                                                                     'width'=>'100px',
                                                                     'height'=>'100px')); ?>
                                            <?php else: ?>
                                                <?php echo img(array('src'=>$datosPulzos->pulzoImagenRuta,
                                                                     'width'=>'100px',
                                                                     'height'=>'100px')); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="prepend-1 span-10 last" style="margin-top: 5px">
                                            <span class="pulzos_titulo2">
                                                <?php echo anchor('experienciasnegocios/ver_experiencia/'.$datosPulzos->pulzoId,
                                                                  $datosPulzos->pulzoAccion,
                                                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-empresa')); ?>
                                            </span>
                                        </div>                    
                                    </div><!-- DIV DEL CUERPO DESCRIPCION DE LA EXPERIENCIA **FIN** -->
                                    <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                                        <div class="prepend-1 span-6 last" style="margin-left: 10px; color: #8D6E98">
                                            <?php echo anchor('#',
                                                              'Aviso Legal:',
                                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$datosPulzos->pulzoId, 'id'=>'ver-'.$datosPulzos->pulzoId)); ?>
                                            <?php echo anchor('#',
                                                              'Aviso Legal:',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$datosPulzos->pulzoId, 'id'=>'ocultar-'.$datosPulzos->pulzoId)); ?>
                                        </div>
                                    </div>
                                    <div style="display: none; margin-bottom: 5px" id="aviso-legal-<?php echo $datosPulzos->pulzoId; ?>">
                                        <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                                            <?php echo $datosPulzos->pulzoAvisoLegal; ?>    
                                        </div>
                                    </div><!-- DIV AVISO LEGAL **FIN** -->
                                    <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                                        <div class="span-6">
                                            &nbsp;
                                        </div>
                                        <div class="prepend-1 span-2">
                                            <?php echo anchor('experienciasnegocios/ver_experiencia/'.$datosPulzos->pulzoId,
                                                              'Ver mas',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas-empresa')); ?>
                                        </div>
                                        <div class="span-2">
                                            <?php echo anchor('#',
                                                              'Comentar',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px', 'class'=>'comentar-plan', 'id'=>$planes->planId)); ?>
                                        </div>
                                        <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                            <div class="span-1">
                                                <?php echo anchor('planesusuarios/borrar_pulzos/'.$datosPulzos->pulzoId,
                                                                  'Eliminar',
                                                                  array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -5px;', 'class'=>'eliminar-pulzo')); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="span-1">
                                                <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planes->planId.'/'.$datosPulzos->pulzoId,
                                                                  'Reservar',
                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                        <?php echo form_open('planesusuarios/subcomentarios_pulzos_post/'.$datosPulzos->pulzoId.'/'.$datosPulzos->pulzoUsuarioId.'/'.$this->session->userdata('id'),//negocios/guardar_comentarios_pulzo/'.$this->session->userdata('id').'/'.$datosPost->planId,
                                                             array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                                            <div class="span-8" style="margin-left: 6px">
                                                <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                                               'class'=>'secondary-comment'.$planes->planId,
                                                                               'style'=>'width: 470px; height: 23px; color: #999999',
                                                                               'value'=>'Comentar',
                                                                               'onkeypress'=>'subcomentar_enter_company(event,' . $planes->planId . ')',
                                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'name'=>'comentar_muro')); ?>
                                            </div>
                                        <?php echo form_close(); ?>
                                        <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                                    </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                                    <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                                        <?php $valoresPulzos = count_all_pulzos_comments_data($datosPulzos->pulzoId); ?>
                                        <?php if($valoresPulzos != 0): ?>
                                            <?php if($valoresPulzos > 3): ?>
                                                <?php $ids_comments = get_all_ids_pulzo($datosPulzos->pulzoId); ?>
                                                <?php $get_last_id_pulzo = get_last_id_comment_pulzo($ids_comments, $valoresPulzos); ?>
                                                <?php $pulzos_post = get_pulzos_subcomments1($datosPulzos->pulzoId, $get_last_id_pulzo); ?>
                                            <?php else: ?>
                                                <?php $pulzos_post = get_pulzos_subcomments($datosPulzos->pulzoId); ?>
                                            <?php endif; ?>
                                            <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                                <?php foreach($pulzos_post as $posteos): ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **INICIO** -->
                                                    <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                                        <div class="span-11 last"><!-- DIV DE LOS SUBCOMENTARIOS **INICIO** -->
                                                            <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                                                <?php $datos_like_user = get_complete_userdata($posteos->comentarioUsuarioId); ?>
                                                                <?php if($datos_like_user->statusEU == 0): ?>
                                                                    <?php echo img(array('src'=>get_thumb_avatar($posteos->comentarioUsuarioId)/*get_avatar($posteos->comentarioUsuarioId),
                                                                                         'width'=>'36px',
                                                                                         'height'=>'36px'*/)); ?>
                                                                <?php else: ?>
                                                                    <?php $datos_negocios = get_data_company($posteos->comentarioUsuarioId); ?>
                                                                    <?php echo img(array('src'=>get_avatar_negocios($datos_negocios->negocioId),
                                                                                         'width'=>'36px',
                                                                                         'height'=>'36px')); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="span-9 last" style="margin-top: 5px; margin-left: 10px">
                                                                <div class="span-12">
                                                                    <div class="span-9">
                                                                        <span class="pulzos_titulo1">
                                                                            <?php if($datos_like_user->statusEU == 0): ?>
                                                                                <?php echo anchor('usuarios/perfil/'.$posteos->comentarioUsuarioId,
                                                                                                  get_complete_username($posteos->comentarioUsuarioId),
                                                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                            <?php else: ?>
                                                                                <?php echo anchor('negocios/perfil/'.$datos_negocios->negocioId,
                                                                                                  get_complete_username($posteos->comentarioUsuarioId),
                                                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                            <?php endif; ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="span-2 last">
                                                                        <?php if($this->session->userdata('idN') == $datosPulzos->pulzoUsuarioId): ?>
                                                                            <?php echo anchor('#',
                                                                                              img(array('src'=>'statics/img/cerrar.jpg',
                                                                                                        'width'=>'14px',
                                                                                                        'height'=>'12px')),
                                                                                              array('class'=>'eliminar-pulzo')); ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <br />
                                                                <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                                    <?php echo $posteos->comentarioTexto; ?>
                                                                </span>
                                                            </div>
                                                            <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                                                <div class="span-1" style="margin-left: 20px">
                                                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                                         'width'=>'14px',
                                                                                         'height'=>'12px')); ?>
                                                                </div>
                                                                <div class="span-4" style="margin-left: -20px; magin-top: -3px; font-size: 9pt; color: #999999">
                                                                    <?php $fecha = unix_to_human($posteos->comentarioFechaCreacion);
                                                                          $fechaCreacionSub = fecha_acomodo($fecha);
                                                                          echo $fechaCreacionSub;
                                                                     ?>
                                                                </div>
                                                            </div>
                                                        </div><!-- DIV DE LOS SUBCOMENTARIOS **FIN** -->
                                                    </div>
                                                <?php endforeach; ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **FIN** -->
                                            <?php endif; ?>
                                        </div>
                                    </div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **FIN** -->
                                </div><!-- DIV DEL CUERPO **FIN** -->


                                <?php elseif($datosPulzos->pulzoTipo == 4): ?>
                                     <div class="span-14 last" style="width: 524px"><!-- DIV CUERPO **INICIO** -->
                                        <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                                            <?php echo img(array('src'=>get_avatar_negocios($datosPulzos->pulzoUsuarioId),
                                                                 'width'=>'36px',
                                                                 'height'=>'36px')); ?>
                                        </div><!-- DIV AVATAR **FIN** -->
                                    <div class="span-12 last" style="word-wrap: break-word; margin-left: 10px"><!-- DIV CUERPO PRINCIPAL **INICIO** -->
                                        <span class="pulzos_titulo1">
                                            <?php echo anchor('negocios/perfil/'.$datosPulzos->pulzoUsuarioId,
                                                              get_complete_username($planes->planUsuarioId),
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo2">
                                            <?php echo $datosPulzos->pulzoTitulo; ?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo1">
                                            Lugar:
                                        </span>
                                        
                                        <span class="pulzos_titulo2">
                                            <?php echo $datosPulzos->pulzoUbicacion;?>
                                        </span>
                                        <br />
                                        <span class="pulzos_titulo1">
                                            Fecha Termino:
                                        </span>
                                        <span class="pulzos_titulo2">
                                            <?php $fechaI = unix_to_human($datosPulzos->pulzoFechaFin);
                                                  $inicio = fecha_acomodo($fechaI);
                                                  echo $inicio; ?>
                                        </span>
                                        <br />

                                    </div><!-- DIV CUERPO PRINCIPAL **FIN** -->
                                    <div class="prepend-1 span-14" style="margin-top: 10px; margin-left: 10px"><!-- DIV DE DESCRIPCION PULZO **INICIO** -->
                                        <div class="span-2">
                                            <?php if($datosPulzos->pulzoImagenRuta == '0'): ?>
                                                <?php echo img(array('src'=>base_url().'statics/img/default/avatar90.png',
                                                                     'width'=>'100px',
                                                                     'height'=>'100px')); ?>
                                            <?php else: ?>
                                                <?php echo img(array('src'=>$datosPulzos->pulzoImagenRuta,
                                                                     'width'=>'100px',
                                                                     'height'=>'100px')); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="prepend-1 span-9 last" style="margin-top: 5px">
                                       <?php if($datosPulzos->pulzoAccion==null): ?>
                                            <span class="pulzos_titulo2">
                                                <?php echo anchor('pulzos/ver_simple/'.$datosPulzos->pulzoId,
                                                                  $datosPulzos->pulzoTitulo,
                                                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-empresa')); ?>
                                            </span>   
                                       <?php else: ?>
                                            <span class="pulzos_titulo2">
                                                <?php echo anchor('pulzos/ver_simple/'.$datosPulzos->pulzoId,
                                                                  $datosPulzos->pulzoAccion,
                                                                  array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-mas-empresa')); ?>
                                            </span>
                                        <?php endif; ?> 
                                        </div>                    
                                    </div><!-- DIV DEL CUERPO DESCRIPCION DEL PULZO **FIN** -->
                                   <div class="span-13"><!-- DIV AVISO LEGAL **INICIO** -->
                                        <div class="prepend-1 span-11 last" style="margin-left: 10px; color: #8D6E98">
                                            <?php echo anchor('#',
                                                              'Aviso Legal:',
                                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-aviso', 'name'=>$datosPulzos->pulzoId, 'id'=>'ver-'.$datosPulzos->pulzoId)); ?>
                                            <?php echo anchor('#',
                                                              'Aviso Legal:',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'class'=>'ocultar-aviso', 'name'=>$datosPulzos->pulzoId, 'id'=>'ocultar-'.$datosPulzos->pulzoId)); ?>
                                        </div>
                                    </div>
                                    <div style="display: none; margin-bottom: 5px" id="aviso-legal-<?php echo $datosPulzos->pulzoId; ?>">
                                        <div class="interlineado prepend-1 span-12 last" style="margin-left: 10px; color: #8D6E98; margin-bottom: 10px">
                                            <?php echo $datosPulzos->pulzoAvisoLegal; ?>    
                                        </div>
                                    </div><!-- DIV AVISO LEGAL **FIN** --> 
                                    <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                                        <div class="span-6">
                                            &nbsp;
                                        </div>
                                        <div class="prepend-1 span-2">
                                            <?php echo anchor('pulzos/ver_simple/'.$datosPulzos->pulzoId,
                                                              'Ver mas',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px', 'class'=>'ver-mas-empresa')); ?>
                                        </div>
                                        <div class="span-2">
                                            <?php echo anchor('#',
                                                              'Comentar',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 5px', 'class'=>'comentar-plan', 'id'=>$planes->planId)); ?>
                                        </div>
                                        <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                            <div class="span-1">
                                                <?php echo anchor('planesusuarios/borrar_pulzos/'.$datosPulzos->pulzoId,
                                                                  'Eliminar',
                                                                  array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -5px;', 'class'=>'eliminar-pulzo')); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="span-1">
                                                <?php echo anchor('planesusuarios/reservacion_promocion/'.$this->session->userdata('id').'/'.$planes->planId.'/'.$datosPulzos->pulzoId,
    //'planesusuarios/planes_negocios/'.$this->session->userdata('id').'/'.$planes->planUsuarioId,
                                                                  'Reservar',
                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE SE USA PARA LOS COMENTARIOS **INICIO** -->
                                        <?php $pulzos_post = get_pulzos_subcomments($datosPulzos->pulzoId); ?>
                                        <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                        <?php foreach($pulzos_post as $posteos): ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **INICIO** -->
                                            <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                                <div class="span-11 last"><!-- DIV DE LOS SUBCOMENTARIOS **INICIO** -->
                                                    <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                                        <?php $datos_like_user = get_complete_userdata($posteos->comentarioUsuarioId); ?>
                                                        <?php if($datos_like_user->statusEU == 0): ?>
                                                            <?php echo img(array('src'=>get_thumb_avatar($posteos->comentarioUsuarioId))); ?>
                                                        <?php else: ?>
                                                            <?php $datos_negocios = get_data_company($posteos->comentarioUsuarioId); ?>
                                                            <?php echo img(array('src'=>get_avatar_negocios($datos_negocios->negocioId),
                                                                                 'width'=>'36px',
                                                                                 'height'=>'36px')); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="span-9 last" style="margin-top: 5px; margin-left: 10px">
                                                        <div class="span-12">
                                                            <div class="span-9">
                                                                <span class="pulzos_titulo1">
                                                                    <?php if($datos_like_user->statusEU == 0): ?>
                                                                        <?php echo anchor('usuarios/perfil/'.$posteos->comentarioUsuarioId,
                                                                                          get_complete_username($posteos->comentarioUsuarioId),
                                                                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                    <?php else: ?>
                                                                        <?php echo anchor('negocios/perfil/'.$datos_negocios->negocioId,
                                                                                          get_complete_username($posteos->comentarioUsuarioId),
                                                                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                    <?php endif; ?>
                                                                </span>
                                                            </div>
                                                            <div class="span-2 last">
                                                                <?php if($this->session->userdata('idN') == $datosPulzos->pulzoUsuarioId): ?>
                                                                    <?php echo anchor('#',
                                                                                      img(array('src'=>'statics/img/cerrar.jpg',
                                                                                                'width'=>'14px',
                                                                                                'height'=>'12px')),
                                                                                      array('class'=>'eliminar-pulzo')); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                            <?php echo $posteos->comentarioTexto; ?>
                                                        </span>
                                                    </div>
                                                    <div class="prepend-1 span-9 last" style="margin-top: 12px">
                                                        <div class="span-1" style="margin-left: 20px">
                                                            <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                                 'width'=>'14px',
                                                                                 'height'=>'12px')); ?>
                                                        </div>
                                                        <div class="span-4" style="margin-left: -20px; magin-top: -3px; font-size: 9pt; color: #999999">
                                                            <?php $fecha = unix_to_human($posteos->comentarioFechaCreacion);
                                                                  $fechaCreacionSub = fecha_acomodo($fecha);
                                                                  echo $fechaCreacionSub;
                                                             ?>
                                                        </div>
                                                    </div>
                                                </div><!-- DIV DE LOS SUBCOMENTARIOS **FIN** -->
                                            </div>
                                        <?php endforeach; ?><!-- FOREACH DE LOS COMENTARIOS DEL POST **FIN** -->
                                        </div>
                                    </div><!-- DIV QUE SE USA PARA LOS COMENTARIOS **FIN** -->
                                    <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                        <?php echo form_open('planesusuarios/subcomentarios_pulzos_post/'.$datosPulzos->pulzoId.'/'.$datosPulzos->pulzoUsuarioId.'/'.$this->session->userdata('id'),//negocios/guardar_comentarios_pulzo/'.$this->session->userdata('id').'/'.$datosPost->planId,
                                                             array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                                            <div class="span-8" style="margin-left: 6px">
                                                <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                                               'class'=>'secondary-comment'.$planes->planId,
                                                                               'style'=>'width: 470px; height: 23px; color: #999999',
                                                                               'value'=>'Comentar',
                                                                               'onkeypress'=>'subcomentar_enter_company(event,' . $planes->planId . ')',
                                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'name'=>'comentar_muro')); ?>
                                            </div>
                                        <?php echo form_close(); ?>
                                        <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                                    </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                                </div><!-- DIV CUERPO **FIN** -->


                            <?php elseif($datosPulzos->pulzoTipo == 3): ?>
                                <div class="span-14" style="width: 524px"><!-- DIV DEL CUERPO **INICIO** -->
                                    <div class="span-1"><!-- DIV AVATAR **INICIO** -->
                                        <?php if($planes->planAmigoUsuarioId == 0): ?>
                                            <?php echo img(array('src'=>get_avatar_negocios($datosPulzos->pulzoUsuarioId),
                                                                 'width'=>'37',
                                                                 'height'=>'37')); ?>
                                        <?php else: ?>
                                            <?php echo img(array('src'=>get_thumb_avatar($planes->planAmigoUsuarioId))); ?>
                                        <?php endif; ?>
                                    </div><!-- DIV AVATAR **FIN** -->
                                    <div class="interlineado span-12 last"><!-- DIV DEL CUERPO DEL MENSAJE DE POST **INICIO** -->
                                        <div style="margin-left: 10px">
                                            <?php if($planes->planAmigoUsuarioId == 0): ?>
                                                <span class="pulzos_titulo1">
                                                    <?php echo anchor('negocios/perfil/'.$datosPulzos->pulzoUsuarioId,
                                                                      get_complete_username($planes->planUsuarioId),
                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="pulzos_titulo1">
                                                    <?php echo anchor('usuarios/perfil/'.$planes->planAmigoUsuarioId,
                                                                      get_complete_username($planes->planAmigoUsuarioId),
                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                    a
                                                    <?php echo anchor('negocios/perfil/'.$datosPulzos->pulzoUsuarioId,
                                                                      get_complete_username($planes->planUsuarioId),
                                                                      array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div style="margin-top: 6px; margin-left: 10px; word-wrap: break-word">
                                            <span class="pulzos_titulo2">
                                                <?php echo $planes->planDescripcion; ?>
                                            </span>
                                        </div>
                                    </div><!-- DIV DEL CUERPO DEL MENSAJE DE POST **FIN** -->
                                    <div class="prepend-1 span-14 last" style="margin-top: 8px"><!-- DIV DEL MENU **INICIO** -->
                                        <div class="span-1" style="margin-left: 10px">
                                            <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                                 'width'=>'16px',
                                                                 'height'=>'12px')); ?>
                                        </div>
                                        <div class="span-4" style="margin-left: -10px; font-size: 9pt; color: #999999">
                                            <?php $fecha = unix_to_human($datosPulzos->pulzoFechaCreacion);
                                                  $fechaCreacion = fecha_acomodo($fecha);
                                                  echo $fechaCreacion; ?>
                                        </div>
                                        <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                            <div class="prepend-2 span-2">
                                                <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        'Ver todos',
                                                                         array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                            </div>
                                            <div class="span-2">
                                                <?php echo anchor('#',
                                                                  'Comentar',
                                                                  array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                            </div>  
                                            <div class="span-3 last">
                                                <?php echo anchor('planesusuarios/borrar_comentarios_pulzos/'.$datosPulzos->pulzoId.'/'.$planes->planId,
                                                                  'Eliminar',
                                                                  array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'eliminar-pulzo', 'name'=>$planes->planId)); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="prepend-4 span-2">
                                                <?php
                                                        $totales = count_comments_post($planes->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                          'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$planes->planId,
                                                                        'Ver todos',
                                                                         array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                            </div>
                                            <div class="span-2">
                                                <?php echo anchor('#',
                                                                  'Comentar',
                                                                  array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'comentar-plan', 'id'=>$planes->planId)); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div><!-- DIV DEL MENU **FIN** -->
                                    <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                                        <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$planes->planId.'/'.$this->session->userdata('id'),
                                                             array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                                            <div class="span-8" style="margin-left: 6px">
                                                <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                                               'class'=>'secondary-comment'.$planes->planId,
                                                                               'style'=>'width: 470px; height: 23px; color: #999999',
                                                                               'onkeypress'=>'subcomentar_enter(event,' . $planes->planId . ')',
                                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                                               'value'=>'Comentar',
                                                                               'name'=>'comentar_muro')); ?>
                                            </div>
                                        <?php echo form_close(); ?>
                                        <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                                    </div><!-- DIV DE FORMULARIOS PARA COMENTARIOS **FIN** -->
                                    <div class="comentarios<?php echo $planes->planId; ?>"><!-- DIV QUE MUESTRA LOS COMENTARIOS **INICIO** -->
                                        <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                                            <?php $valores_comentarios = count_all_subcomments($planes->planId, '1'); ?><!-- cuenta numero de comments-->
                                            <?php if($valores_comentarios != 0): ?>
                                                <?php if($valores_comentarios > 3): ?>
                                                    <?php $ids_comments = get_all_ids($planes->planId, '1'); ?><!--obtiene los ids de los comments -->
                                                    <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                                    <?php $comentarios = get_subcomments_wall1($planes->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                                <?php else: ?>
                                                    <?php $comentarios = get_subcomments_wall($planes->planId, '1'); ?>
                                                <?php endif; ?>
                                                <?php foreach($comentarios as $comentario): ?>
                                                    <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                                        <div class="span-11 last"><!-- DIV INICIAL SUBCOMENTARIOS **INICIO** -->
                                                            <?php $status = get_complete_userdata($comentario->comentarioSimpleUsuarioId); ?>
                                                            <div class="span-1" style="margin-top: 5px; margin-left: 5px">
                                                                <?php if($status->statusEU == 0): ?>
                                                                    <?php echo img(array('src'=>get_thumb_avatar($comentario->id),/*get_avatar($comentario->id),
                                                                                         'width'=>'37px',
                                                                                         'height'=>'37px',*/
                                                                                         'style'=>'margin-top: 5px; margin-left: 5px')); ?>
                                                                <?php else: ?>
                                                                    <?php $datos = datos_negocios($comentario->id); ?> 
                                                                    <?php echo img(array('src'=>get_avatar_negocios($datos->negocioId),
                                                                                         'width'=>'37px',
                                                                                         'height'=>'37px',
                                                                                         'style'=>'margin-top: 5px; margin-left: 5px')); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="span-9 last" style="margin-top: 6px; margin-left: 14px">
                                                                <div class="span-12">
                                                                    <div class="span-9">
                                                                        <span class="pulzos_titulo1">
                                                                            <?php if($status->statusEU == 0): ?>
                                                                                <?php echo anchor('usuarios/perfil/'.$comentario->id,
                                                                                                  get_complete_username($comentario->id),
                                                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                            <?php else: ?>
                                                                                <?php echo anchor('negocios/perfil/'.$datos->negocioId,
                                                                                                  get_complete_username($comentario->id),
                                                                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                                                            <?php endif; ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="span-2 last">
                                                                        <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                                                            <?php echo anchor('#',
                                                                                              img(array('src'=>'statics/img/cerrar.jpg',
                                                                                                        'width'=>'14px',
                                                                                                        'height'=>'12px')),
                                                                                              array('class'=>'eliminar-sub')); ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <br />
                                                                <span class="pulzos_titulo2" style="word-wrap: break-word">
                                                                    <?php echo $comentario->comentarioSimple; ?>
                                                                </span>
                                                            </div>
                                                            <div clasS="span-9 last" style="margin-top: 12px">
                                                                <div class="span-1" style="margin-left: 20px">
                                                                    <?php echo img(array('src'=>'statics/img/icon-comentar.png',
                                                                                         'width'=>'14px',
                                                                                         'height'=>'12px')); ?>
                                                                </div>
                                                                <div class="span-4 last" style="margin-left: -22px; margin-top: -3px; font-size: 9pt; color: #999999">
                                                                    <?php $fecha = unix_to_human($comentario->comentarioFechaCreacion);                                                                                                   $fechaCreacionSub = fecha_acomodo($fecha);
                                                                          echo $fechaCreacionSub; ?>
                                                                </div>
                                                            </div>
                                                        </div><!-- DIV INICIAL SUBCOMENTARIOS **FIN** -->
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div><!-- DIV QUE MUESTRA LOS COMENTARIOS **FIN** -->
                                </div><!-- DIV DEL CUERPO **FIN** -->
                            <?php endif; ?>
                                
                                
                                
                        <?php endif; ?>
                    </div><!-- DIV FORMAS PULZOS **FIN** -->
                                
                <?php elseif($planes->planTipo == 7): ?>
                    <div class="span-13" style="margin-top: 5px; margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR **INICIO** -->
                        <div class="span-14 last" style="width: 524px"><!-- DIV CUERPO MENSAJE **INICIO** -->
                            <?php //var_dump($planes); ?>
                            <?php $datos_company = get_data_company($planes->planAmigoUsuarioId); ?>
                            <div class="span-1">
                                <?php echo img(array('src'=>get_thumb_avatar($planes->planUsuarioId)/*get_avatar($planes->planUsuarioId),
                                                     'width'=>'37px',
                                                     'height'=>'37px'*/)); ?>
                            </div>
                            <div class="span-12 last" style="margin-left: 20px; word-wrap: break-word">
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('usuarios/perfil/'.$planes->planUsuarioId,
                                                      get_complete_username($planes->planUsuarioId),
                                                      array('id'=>'', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </span>
                                <span class="pulzos_titulo2">
                                    <?php echo $planes->planDescripcion; ?>
                                </span>
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('negocios/perfil/'.$datos_company->negocioId,
                                                      $datos_company->negocioNombre,
                                                     array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </span>
                            </div>
                        </div><!-- DIV CUERPO MENSAJE **FIN** -->
                        <div class="prepend-1 span-11 last" style="margin-bottom: 20px">
                            <div class="span-1" style="margin-left: 20px">
                                <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                     'width'=>'14px',
                                                     'height'=>'12px')); ?>
                            </div>
                            <div class="span-9" style="color: #8D6E98; margin-left: -12px; margin-top: -3px">
                                <?php $fecha = unix_to_human($planes->planFechaCreacion);
                                      $fecha_humana = fecha_acomodo($fecha);
                                      echo $fecha_humana; ?>
                            </div>
                        </div>
                    </div><!-- DIV CONTENEDOR **FIN** -->
                <?php else: ?>
                    <div class="span-13" style="margin-top: 5px; margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR DEL PLAN **INICIO** -->
                        <div class="span-14 last" style="width: 524px">
                            <div class="span-1">
                                <?php echo img(array('src'=>get_thumb_avatar($planes->planUsuarioId)/*get_avatar($planes->planUsuarioId),
                                                     'width'=>'36',
                                                     'height'=>'36'*/)); ?>
                            </div>
                            <div class="span-12 last" style="word-wrap: break; margin-left: 10px">
                                            <!--span class="pulzos_titulo1">
                                                Titulo:
                                            </span -->
                                <span class="pulzos_titulo2">
                                    <?php echo $planes->planMensaje; ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo1">
                                    Lugar:
                                </span>
                                <span class="pulzos_titulo2">
                                    <?php if($planes->planEsEmpresa == '0'): ?>
                                        <?php echo $planes->planLugar; ?>
                                    <?php else: ?>
                                        <?php echo anchor('negocios/perfil/'.$planes->planIdEmpresa,
                                                          $planes->planLugar,
                                                          array('style'=>'color: #8D6E98; text-decoration: none')); ?>
                                    <?php endif; ?>
                                </span>
                                <br />
                                <span class="pulzos_titulo1">
                                    Fecha Inicio:
                                </span>
                                <span class="pulzos_titulo2">
                                    <?php $fechaI = unix_to_human($planes->planFechaInicio);
                                          $correctaI = fecha_acomodo($fechaI);
                                          echo $correctaI . " - " . $planes->planHoraInicio; ?>
                                </span>
                                          
                                                <?php echo $planes->planDescripcion; ?>
                                            
                            </div>
                            <div class="prepend-1 span-14" style="margin-top: 5px; margin-left: 10px">
                                <div class="span-2">
                                    <?php if($planes->planEsEmpresa == '0'): ?>
                                        <?php if($planes->planImagenId == '0'): ?>
                                            <?php echo anchor('planesusuarios/ver_plan/'.$planes->planId,
                                                              img(array('src'=>'statics/img/default/planes.jpg',
                                                                        'width'=>'100',
                                                                        'height'=>'100')),
                                                               array('id'=>'imagenPlan', 'class'=>'', 'style'=>'text-decoration: none')); ?>
                                        <?php else: ?>
                                            <?php echo anchor('planesusuarios/ver_plan/'.$planes->planId,
                                                              img(array('src'=>get_avatar_plan($planes->planId),
                                                                        'width'=>'100',
                                                                        'height'=>'100')),
                                                              array('id'=>'imagenPlan', 'class'=>'', 'style'=>'text-decoration: none')); ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo anchor('planesusuarios/ver_plan/'.$planes->planId,
                                                           img(array('src'=>get_avatar_negocios($planes->planIdEmpresa),
                                                                     'width'=>'100',
                                                                     'height'=>'100')),
                                                           array('id'=>'imagenPlan', 'class'=>'', 'style'=>'text-decoration: none')); ?> 
                                    <?php endif; ?>
                                </div>
                                <div class="prepend-1 span-10 last" style="margin-top: 5px">
                                    <span class="pulzos_titulo2" style="word-wrap: break-word">
                                        <?php echo anchor('planesusuarios/ver_plan/'.$planes->planId,
                                                            $planes->planDescripcion,
                                                            array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                                <div class="span-6">
                                    &nbsp;
                                </div>
                                <div class="prepend-1 span-2"> 
                                    <?php echo anchor('planesusuarios/ver_plan/'.$planes->planId,
                                                      'Ver mas',
                                                       array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px')); ?>
                                </div>
                                <div class="span-2">
                                    <?php echo anchor('#',
                                                      'Comentar',
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>$planes->planId, 'class'=>'comentar-plan')); ?>
                                </div>
                                <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                    <div class="span-1">
                                        <?php echo anchor('planesusuarios/borrar_comentario/'.$planes->planId,
                                                          'Eliminar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -5px', 'class'=>'eliminar-plan')); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="comentarios-<?php echo $planes->planId; ?> prepend-1 span-8 last" style="display: none">
                            <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$planes->planId.'/'.$this->session->userdata('id'),//$usuarios->id,
                                                  array('class'=>'forma-comentar-muro'.$planes->planId)); ?>
                                <div class="span-8" style="margin-left: 6px">
                                    <?php echo form_textarea(array('id'=>'sub-comentario'.$planes->planId,
                                                                   'class'=>'secondary-comment'.$planes->planId,
                                                                   'style'=>'width: 470px; height: 23px; color: #999999',
                                                                   'onkeypress'=>'subcomentar_enter(event,' . $planes->planId . ')',
                                                                   'onfocus'=>"return desaparecer_sub('Comentar'," . $planes->planId . ")",
                                                                   'onblur'=>"return aparecer_sub('Comentar'," . $planes->planId . ")",
                                                                   'value'=>'Comentar',
                                                                   'name'=>'comentar_muro')); ?>
                                </div>
                            <?php echo form_close(); ?>
                            <input type="hidden" id="oct<?php echo $planes->planId; ?>" />
                        </div>
                        <div class="comentarios<?php echo $planes->planId; ?>">
                            <div class="span-13" style="margin-top:20px; margin-bottom: 15px;">
                                <?php $valores_comentarios = count_all_subcomments($planes->planId, '1'); ?><!-- cuenta numero de comments-->
                                <?php if($valores_comentarios != 0): ?>
                                    <?php if($valores_comentarios > 3): ?>
                                        <?php $ids_comments = get_all_ids($planes->planId, '1'); ?><!--obtiene los ids de los comments -->
                                        <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                        <?php $comentarios = get_subcomments_wall1($planes->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                    <?php else: ?>
                                        <?php $comentarios = get_subcomments_wall($planes->planId, '1'); ?>
                                    <?php endif; ?>
                                    <?php foreach($comentarios as $comentario): ?><!-- FOREACH DE LOS SUBCOMENTARIOS **INICIO** -->
                                        <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                            <div class="span-11 last"><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **INICIO** -->
                                                <div class="span-1" style="margin-left: 5px; margin-top: 4px">
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
                                                            <?php if($this->session->userdata('id') == $planes->planUsuarioId): ?>
                                                                <?php echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                                                 img(array('src'=>'statics/img/eliminar.png',
                                                                                           'width'=>'14px',
                                                                                           'height'=>'16px')),
                                                                                 array('class'=>'eliminar-sub')); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>                                            
                                                    <br />
                                                    <span class="pulzos_titulo2" style="word-wrap: break-word;">
                                                        <?php echo $comentario->comentarioSimple; ?>
                                                    </span>
                                                </div>
                                                <div class="prepend-1 span-9 last" style="margin-top: 12px">
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
                                                </div>
                                            </div>
                                        </div><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **FIN** -->
                                    <?php endforeach; ?><!-- FOREACH DE LOS SUBCOMENTARIOS **FIN** -->
                                <?php endif; ?>
                            </div>
                        </div>
                    </div> 
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?><!-- IF TIPO PLAN **FIN** -->
    <?php endforeach; ?><!-- FOREACH PRINCIPAL **FIN** -->
