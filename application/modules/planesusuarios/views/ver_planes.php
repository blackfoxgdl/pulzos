<?php
/**
 * Vista que se encarga de mostrar los pulzos del usuario
 * para que el mismo pueda ver lo que ha pulzado
 **/
?><!-- script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.min.js"></script -->
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery.textareaCounter.plugin.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery_lightbox/js/jquery.lightbox-0.5.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo base_url().'statics/js/jquery/plugins/jquery_lightbox/css/jquery.lightbox-0.5.css';?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
<script type="text/javascript">
$(".plan-usuario").click(function(event){
    event.preventDefault();
    simplePlan = $(event.currentTarget).attr("href");
    location.href = simplePlan;

});

$("#comentarMuro").submit(function(event){
    event.preventDefault();
    var commentMuro = $("#main-comment").val();
    var commentLinkPost = $("#enlace-comentario").val();
    var commentPhotoPost = $("#foto-comentario").val();
    if(((commentMuro != "¿Qué quieres hacer hoy?") && (commentLinkPost != 'Enlace') && (commentPhotoPost == '')) || ((commentMuro == "¿Qué quieres hacer hoy?") && (commentLinkPost != 'Enlace') && (commentPhotoPost == '')) || ((commentMuro != "¿Qué quieres hacer hoy?") && (commentLinkPost == 'Enlace') && (commentPhotoPost != '')) || ((commentMuro == "¿Qué quieres hacer hoy?") && (commentLinkPost == 'Enlace') && (commentPhotoPost != '')) || (commentMuro != "¿Qué quieres hacer hoy?"))
    {        
        $("input[type=submit]", this).attr('disabled', 'disabled');
        var opciones = {
            success: cargarVista
        }
        $(this).ajaxSubmit(opciones);
        return false;
    }
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
      
        $(".secondary-comment"+idplan).blur();
        $("#oct"+idplan).val(datosAccion).focus();
    
        var clase = "comentarios"+idplan;
        urlReloadC = $("#recarga_comentario").attr("href");
        urlReloadComentario = urlReloadC + '/' + idplan;
        if(datosAccion != "Comentar"){
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

$(".eliminar-sub").click(function(event){
    event.preventDefault();
   
    urlDeleteSub = $(event.currentTarget).attr("href");
    $(event.currentTarget).parent().parent().parent().parent().hide();
    $.get(urlDeleteSub);
});

function quitarTexto(val)
{
    if(document.getElementById('main-comment').value == '¿Dónde quieres ganar hoy?')
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

$(".eliminar-scribble").click(function(event){
    event.preventDefault();
    deletePared = $(event.currentTarget).attr('href');
    numIds = $(event.currentTarget).attr('name');
    comentariosScr = ".comentarios"+numIds;
    $.get(deletePared);
    $(event.currentTarget).parent().parent().parent().parent().hide();
    $(comentariosScr).hide();
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

$(".ver-publicacion-personal").click(function(event){
    event.preventDefault();
    urlPersonalP = $(event.currentTarget).attr('href');
    //alert('hola ' + urlPersonalP);
    $("#texto-menu").load(urlPersonalP);
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

    $("a.lightbox").lightBox();

    //CONTADOR DE PALABRAS PRINCIPAL
    var opciones_textarea_mias = {
        'maxCharacterSize': 350,
        'originalStyle': 'estilo_normal',
        'warningNumber': 50,
        'displayFormat': '#input / #max caracteres'
    };
    $("#main-comment").textareaCount(opciones_textarea_mias);
});

//PARTE PARA CARGAR DE 10 EN 10
$(".ver-mas-publicaciones").click(function(event){
    event.preventDefault();

    url = $(event.currentTarget).attr('href');
    ultimo = $(".ultimos").text();
    urlGet = $("#urlGet").attr("href");
    urlSend = url + '/' + ultimo;
    clases = "ver" + ultimo;
    urlSendGet = urlGet + '/' + ultimo;
    $.ajax({
           type: "POST",
           url: urlSend,
           success: function(html){
               $("#verMasPersonal").append($("<div></div>").addClass(clases));//$("<div></div>").html(html));
               $("."+clases).html(html);
            }
    });
  
    $.get(urlSendGet,
        function(data){
            $(".ultimos").text(data);
            if(data == 0)
            {
                $("#ver-mas-pub-mios").hide();
            }
          }
     );
});
</script>
<style type="text/css">
.estilo_normal {
    font-size: 12px;
    color: #8D6E98;
    text-align: right;
}
</style>
<?php echo anchor('planesusuarios/reload_comment/', '', array('style'=>'display: none', 'id'=>'recarga_comentario')); ?>
<?php echo anchor('planesusuarios/reload_comment_company/', '', array('style'=>'display: none', 'id'=>'recargar_comentario_empresa')); ?>
<?php echo anchor('planesusuarios/mis_planes/'.$usuario, '', array('style'=>'display: none', 'id'=>'enlace')); ?>
<script src="../../../../Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="../../../../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<div class="span-14 last" style="margin-top: 22px">
	
    <div style="display: none"><!-- PARTE DE LOS TITULOS -->
        <?php echo img(array('id'=>'imagen', 'src'=>'statics/img/pin.png')); ?>
        <!-- PARTE DEL BOTON DE LA PARTE SUPERIOR DERECHA **INICIO** -->
        <div id="menu-derecha">
            <?php if($this->session->userdata('id') == $usuarios->id): /* COMENTARIO DE LA PARTE DE BOTON ARMAR PLAN
                
              
            <?php*/ else: ?>
                <div id="menu-opciones">
                    <?php if(! $this->session->userdata('idN')): ?><!-- se usa para checar amistar -->
                        <?php if($this->session->userdata('id') != $usuarios->id): ?>
                            <?php $total = count_data($this->session->userdata('id'), $usuarios->id); ?>
                            <?php if($total != 0): ?>
                                <?php $val = status_friend($this->session->userdata('id'), $usuarios->id); ?>
                                <div style="margin-left: -23px; margin-top: 22px">
                                    <?php echo get_message_status($val->amigoAceptado); ?>
                                </div>
                            <?php else: ?>
                                <?php is_friend($this->session->userdata('id'), $usuarios->id); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?><!-- se usa para checar amistad -->
                </div>
            <?php endif; ?>
        </div>
        <!-- PARTE DEL BOTON DE LA PARTE SUPERIOR DERECHA **FIN** -->
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
        <div id="estado-usuario-plan"><?php if(($usuarios->pais!=0) & ($usuarios->ciudad!=0)){?>
		<?php echo $localidad->nombre;  ?>
        <?php }?></div>
    </div><!-- PARTE DE LOS TITULOS -->
    <div class="span-14 last">
        &nbsp;
    </div>
    <div class="span-14 last">
        <div class="span-14" style="margin-bottom: 30px">
            <?php //echo "hola: " . $usuario; ?>
            <?php echo form_open_multipart('planesusuarios/mi_wall/'.$usuario, array('id'=>'comentarMuro','name'=>'forma-main')); ?>
                <div class="span-13">
                    <?php echo form_textarea(array('id'=>'main-comment',
                                                   'name'=>'comentarios',
                                                   'style'=>'width: 524px; height: 30px; border: 1px solid',
                                                   'onfocus'=>"return quitarTexto('¿Dónde quieres ganar hoy?')",
                                                   'class'=>'area-textoPublicar',
                                                   'onblur'=>"return ponerTexto('¿Dónde quieres ganar hoy?')",
                                                   'value'=>'¿Dónde quieres ganar hoy?')); ?>
                </div>
                <div class="span-13" style="display: none; margin-top: 3px" id="link-comment">
                    <?php echo form_input(array('id'=>'enlace-comentario',
                                                'class'=>'',
                                                'value'=>'Enlace',
                                                'name'=>'enlace',
                                                'style'=>'width: 524px; heigth: 28px; color: #999999',
                                                'onblur'=>"return aparecer('Enlace')",
                                                'onfocus'=>"return desaparecer('Enlace')")); ?> 
                </div>
                <div class="span-13" style="display: none; margin-top: 3px" id="foto-comment">
                    <?php echo form_upload(array('id'=>'foto-comentario',
                                                 'name'=>'imagenP',
                                                 'value'=>'')); ?>
                </div>
                <div class="span-3 last" style="margin-top: 5px">
                    <span style="color: #9C86A0">
                        Aduntar
                    </span>
                    <span style="margin-left: 9px">
                        <?php echo anchor('#',
                                          img(array('src'=>'statics/img/icon-link.png',
                                                    'width'=>'20',
                                                    'height'=>'12px')),
                                          array('id'=>'link-comentario')); ?>
                    </span>
                    <span style="margin-left: 9px">
                        <?php echo anchor('#',
                                          img(array('src'=>'statics/img/icon-foto.png',
                                                    'height'=>'12px',
                                                   'width'=>'14')),
                                          array('id'=>'link-foto')); ?>
                    </span>
                </div>
                <div class="span-13">
                    <div class="span-1">
                        &nbsp;
                    </div>
                    <div class="span-1" style="display: none; background-color: #9D6499; height: 16px; color: #FFFFFF; margin-left: 8px" id="link-hover">
                        <span style="margin-left: 3px">
                            Link
                        </span>
                    </div>
                    <div class="pepend-1 span-2" id="foto-hover" style="display: none">
                        <div class="span-1">
                            &nbsp;
                        </div>
                        <div class="span-1 last" style="background-color: #8D6499; height: 16px; color: #FFFFFF;">
                            <span style="margin-left: 3px">
                                Foto
                            </span>
                        </div>
                    </div>
                </div>
                <div class="prepend-11 last" style="margin-top: 5px; margin-left: 7px">
                    <?php echo form_submit(array('id'=>'',
                                                 'class'=>'comment-submit',
                                                 'value'=>'',
                                                 'style'=>'margin-left: 15px')); ?>
                </div>
            <?php echo form_close(); ?>
        </div> 
       
<!--        <div style="width: 553px;height: 240px" id="calendario"></div>-->
        <div class="span-13"><!-- DIV PRINCIPAL DE LOS COMENTARIO **INICIO** -->
            <?php $valores = obtain_array($planes); 
                  $is = 1; ?>
        	<?php foreach($planes as $plan):?>
                       <?php if($plan->planTipo==1):
                             if($plan->planAmigoUsuarioId==0):?>
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
                                            <div style="margin-top:6px; margin-left: 20px; word-wrap: break-word;">
                                                <span class="pulzos_titulo2" style="color: #606060">
                                                    <?php echo $plan->planDescripcion; ?>
                                                </span>
                                            </div>
                                            <div style="margin-top: 3px; margin-left: 20px; word-wrap: break-word;">
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
                                                           <script type="text/javascript">
AC_AX_RunContent( 'width','353','height','132','src','http://www.goear.com/files/external.swf?file=<?php echo $id; ?>','type','application/x-shockwave-flash','wmode','transparent','quality','high' ); //end AC code
</script><noscript><object width="353" height="132"><embed src="http://www.goear.com/files/external.swf?file=<?php echo $id; ?>" type="application/x-shockwave-flash" wmode="transparent" quality="high" width="353" height="132"></embed></object></noscript><?php     
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
                                            <?php if($this->session->userdata('id') != $plan->planUsuarioId): ?>
                                                <div class="prepend-3 span-2" style="margin-left: -20px">
                                                    &nbsp;
                                                </div>
                                                <div class="span-1">
                                                    <?php
                                                        $totales = count_comments_post($plan->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Ver todos')),
                                                                          //'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                         img(array('src'=>'statics/img/botonComentarios.png',
                                                                                   'width'=>'18px',
                                                                                   'height'=>'15px',
                                                                                   'title'=>'Ver todos')),
                                                                         //'Ver todos',
                                                                         array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                                </div>
                                                <div class="span-1"><!-- 2 -->
                                                    <?php echo anchor('#',
                                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                                'width'=>'18px',
                                                                                'height'=>'15px',
                                                                                'title'=>'Comentar')),
                                                                      array('style'=>'color: #8D6E98; text-decoration: none','id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                                </div>
                                                <div class="span-1"><!-- 2 -->
                                                    <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $plan->planId); ?>
                                                    <?php if($numeroUsuario == 0): ?>
                                                        <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Me apunto')),
                                                                          //'Me apunto',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98;','id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$plan->planId)); ?>
                                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'No voy')),
                                                                          //'No voy',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>
                                                    <?php else: ?>
                                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'No voy')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>
                                                        <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                                    'width'=>'20px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Me apunto')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none','id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$plan->planId)); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="prepend-3 span-2" style="margin-left: -20px">
                                                    &nbsp;
                                                </div>
                                                <div class="span-1">
                                                    <?php
                                                        $totales = count_comments_post($plan->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                   'width'=>'18px',
                                                                                   'height'=>'15px',
                                                                                   'title'=>'Ver todos')),
                                                                          //'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 13px', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                   'width'=>'18px',
                                                                                   'height'=>'15px',
                                                                                   'title'=>'Ver todos')),
                                                                         array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 13px', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                                </div>
                                                <div class="span-1"><!-- 2 -->
                                                    <?php echo anchor('#',
                                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                                'width'=>'18px',
                                                                                'height'=>'15px',
                                                                                'title'=>'Comentar')),
                                                                      //'Comentar',
                                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: 0px','id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                                </div>
                                                <div class="span-1"><!-- 3 last" style="margin-left: -5px" -->
                                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$plan->planId,
                                                                      img(array('src'=>'statics/img/eliminar.png',
                                                                                'width'=>'14px',
                                                                                'height'=>'16px',
                                                                                'title'=>'Eliminar')),
                                                                      //'Eliminar',
                                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -15px','class'=>'eliminar','name'=>$plan->planId)); ?>
                                                </div>
                                            <?php endif; ?>
                                           
                                                    <?php echo img(array('src'=>'statics/img/icon-publicar.png',
                                                                         'width'=>'',
                                                                         'height'=>'12')); ?>
                                                
                                                <?php $fecha = unix_to_human($plan->planFechaCreacion);
                                                      $fechaCreacion = fecha_acomodo($fecha); 
                                                      echo $fechaCreacion; ?>
                                           
                                                <?php echo anchor('#',
                                                                  'Comentar', 
                                                                  array('style'=>'color: #8D6E98; text-decoration: none;', 'id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                           
                                              
                                                    <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                      'Me apunto', 
                                                                       array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'apuntar')); ?>
                                               
                                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$plan->planId,
                                                                      'Eliminar', 
                                                                      array('style'=>'margin-left: 3px; color: #8D6E98; text-decoration: none', 'class'=>'eliminar', 'name'=>$plan->planId)); ?>
                                              
                                           
                                        </div><!-- DIV DE LA PARTE DEL MENU **FIN** -->
                                        <!-- MENU DE USUARIO PARA PODER APUNTARSE O ELIMINAR **FIN** -->
                                        <!-- CODIGO COMENTADO DEL FORMULARIO PARA EL COMENTARIO DEL COMENTARIO **INICIO** -->
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
                                <div class="span-8" style="margin-left: 6px">
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
                                        <?php $valores_comentarios = count_all_subcomments($plan->planId, '1'); ?><!-- cuenta numero de comments-->
                                        <?php if($valores_comentarios != 0): ?>
                                            <?php if($valores_comentarios > 3): ?>
                                                <?php $ids_comments = get_all_ids($plan->planId, '1'); ?><!--obtiene los ids de los comments -->
                                                <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                                <?php $comentarios = get_subcomments_wall1($plan->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                            <?php else: ?>
                                                <?php $comentarios = get_subcomments_wall($plan->planId, '1'); ?>
                                            <?php endif; ?>                                            
                                            <?php foreach($comentarios as $comentario): ?><!-- FOREACH DE LOS SUBCOMENTARIOS **INICIO** DCCEDD-->
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
                                                                    <?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
                                                                        
                                                                    <?php endif; ?>
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
                                                            <div class="prepend-4 span-1 last" style="margin-left: 40px">
                                                            	<?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
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
                                            <?php endforeach; ?><!-- FOREACH DE LOS SUBCOMENTARIOS **FIN** -->
                                        <?php endif; ?>
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
                                        <div style="margin-top: 3px; margin-left: 20px; word-wrap: break-word;">
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
                                                <div class="prepend-3 span-2" style="margin-left: -20px">
                                                    &nbsp;
                                                </div>
                                                <div class="span-1">
                                                    <?php
                                                        $totales = count_comments_post($plan->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                          //'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 12px', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
                                                                         array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 12px', 'class'=>'ver-publicacion-personal'));
                                                        }
                                                    ?>
                                                </div>
                                                <div class="span-1"><!-- 2" style="margin-left: -10px" -->
                                                    <?php echo anchor('#',
                                                                      img(array('src'=>'statics/img/botonEscribir.png',
                                                                                'width'=>'18px',//23px',
                                                                                'height'=>'15px',//20px',
                                                                                'title'=>'Comentar')),//'Comentar',
                                                                      array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -3px','id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                                </div>
                                                <div class="span-1"><!-- 3 last" style="margin-left: -8px" -->
                                                    <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $plan->planId); ?>
                                                    <?php if($numeroUsuario == 0): ?>
                                                        <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                                    'width'=>'20px',//30px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Me apunto')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -20px','id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$plan->planId)); ?>
                                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                                    'width'=>'20px',//30px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'No voy')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>
                                                    <?php else: ?>
                                                        <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                                    'width'=>'20px',//30px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'No voy')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margi-left: -20px', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>
                                                        <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                          img(array('src'=>'statics/img/botonMeApunto.png',
                                                                                    'width'=>'20px',//30px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Me apunto')),
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; display: none; margin-left: -20px','id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$plan->planId)); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="prepend-3 span-2" style="margin-left: -20px">
                                                </div>
                                                <div class="span-1">
                                                    <?php
                                                        $totales = count_comments_post($plan->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$plan->planId,
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
                                                            echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',//23px',
                                                                                    'height'=>'15px',//20px',
                                                                                    'title'=>'Ver todos')),
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
                                                                      array('style'=>'color: #8D6E98; text-decoration: none','id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                                </div>
                                                <div class="span-1"><!-- 3 last" style="margin-left: -5px" -->
                                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$plan->planId,
                                                                      img(array('src'=>'statics/img/eliminar.png',
                                                                                'width'=>'14px',
                                                                                'height'=>'16px',
                                                                                'title'=>'Eliminar')),//'Eliminar',
                                                                      array('style'=>'color: #8D6E98; text-decoration: none','class'=>'eliminar','name'=>$plan->planId)); ?>
                                                </div>
                                            <?php endif; ?>
                                            <!--div class="span-1">
                                                <div class="span-1" style="margin-left: 10px">
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
                                                <?php //if($this->session->userdata('id') != $plan->planUsuarioId): ?>
                                                    <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                                      'Me apunto', 
                                                                       array('style'=>'color: #8D6E98; text-decoration: none', 'class'=>'apuntar')); ?>
                                                <?php //else: ?>
                                                    <?php echo anchor('planesusuarios/borrar_comentario/'.$plan->planId,
                                                                      'Eliminar', 
                                                                      array('style'=>'margin-left: 3px; color: #8D6E98; text-decoration: none', 'class'=>'eliminar', 'name'=>$plan->planId)); ?>
                                                <?php //endif; ?>
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
                            <div class="span-8 last" style="margin-left: 6px">
                                <?php echo form_textarea(array('id'=>'sub-commentario'.$plan->planId,
                                                               'class'=>'secondary-comment'.$plan->planId,
                                                               'style'=>'width: 470px; height: 23px; color; #999999',
                                                               'onkeypress'=>'subcomentar_enter(event,' . $plan->planId . ')',
                                                               'onblur'=>"return aparecer_sub('Comentar'," . $plan->planId . ")",
                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $plan->planId . ")",
                                                               'value'=>'Comentar',
                                                               'name'=>'comentar_muro')); ?>
                            </div>
                            <!--div class="span-1 last right">
                                <?php echo form_submit(array('id'=>$plan->planId,
                                                             'class'=>'comentar-submit',
                                                             'value'=>'comentar',
                                                             'style'=>'margin-left: -10px; margin-top: 15px')); ?>
                            </div-->
                        <?php echo form_close(); ?>
                        <input type="hidden" id="oct<?php echo $plan->planId; ?>" />
                    </div>

                        <div class="comentarios<?php echo $plan->planId; ?>">
                            <div class="span-13" style="margin-top:20px; margin-bottom: 15px">
                                <?php $valores_comentarios = count_all_subcomments($plan->planId, '1'); ?><!-- cuenta numero de comments-->
                                <?php if($valores_comentarios != 0): ?>
                                    <?php if($valores_comentarios > 3): ?>
                                        <?php $ids_comments = get_all_ids($plan->planId, '1'); ?><!--obtiene los ids de los comments -->
                                        <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                        <?php $comentarios = get_subcomments_wall1($plan->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                    <?php else: ?>
                                        <?php $comentarios = get_subcomments_wall($plan->planId, '1'); ?>
                                    <?php endif; ?>
                                    <?php foreach($comentarios as $comentario): ?><!-- FOREACH DE LOS SUBCOMENTARIOS **INICIO** -->
                                        <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px"><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **INICIO** -->
                                            <div class="span-1" style="margin-top: 4px; margin-left: 5px">
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
                                                <div class="prepend-4 span-1" style="margin-left: 40px">
                                                	<?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
                                                        <?php echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                                          img(array('src'=>'statics/img/eliminar.png',
                                                                                    'width'=>'14px',
                                                                                	'height'=>'16px')),
                                                                          array('class'=>'eliminar-sub')); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **FIN** -->
                                    <?php endforeach; ?><!-- FOREACH DE LOS SUBCOMENTARIOS **FIN** -->
                                <?php endif; ?>
                                </div>
                            </div>
                        </div><!-- DIV DEL CUERPO DEL POSTEO EN EL WALL ** FIN ** -->
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(($plan->planTipo == 2) || ($plan->planTipo == 3) || ($plan->planTipo == 4) || 
                         ($plan->planTipo == 5) || ($plan->planTipo == 6)): ?>
                    <?php elseif(($plan->planEmpresaPosteo != 0) && ($plan->planEmpresaPulzoId != 0)): ?>
                    <?php elseif($plan->planTipo == 7): ?>
                    <div class="span-13" style="margin-top: 5px; margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR **INICIO** -->
                        <div class="span-14 last" style="width: 524px"><!-- DIV CUERPO MENSAJE **INICIO** -->
                            <?php //var_dump($planes); ?>
                            <?php $datos_company = get_data_company($plan->planAmigoUsuarioId); ?>
                            <div class="span-1">
                                <?php echo img(array('src'=>get_thumb_avatar($plan->planUsuarioId)/*get_avatar($plan->planUsuarioId),
                                                     'width'=>'37px',
                                                     'height'=>'37px'*/)); ?>
                            </div>
                            <div class="span-12 last" style="margin-left: 20px; word-wrap: break-word">
                                <span class="pulzos_titulo1">
                                    <?php echo anchor('usuarios/perfil/'.$plan->planUsuarioId,
                                                      get_complete_username($plan->planUsuarioId),
                                                      array('id'=>'', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                                </span>
                                <span class="pulzos_titulo2">
                                    <?php echo $plan->planDescripcion; ?>
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
                                <?php $fecha = unix_to_human($plan->planFechaCreacion);
                                      $fecha_humana = fecha_acomodo($fecha);
                                      echo $fecha_humana; ?>
                            </div>
                        </div>
                    </div><!-- DIV CONTENEDOR **FIN** -->
                    
                <?php elseif($plan->planTipo == 8): ?>

            <div class="span-13" style="margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR DE DATOS MAIN **INICIO** -->
                <div class="span-14 last" style="width: 524px"><!-- FONDO **INICIO** -->
                    <div class="span-1">
                        <?php echo img(array('src'=>get_thumb_avatar($plan->planUsuarioId)/*get_avatar($plan->planUsuarioId),
                                              'width'=>'37px',
                                              'height'=>'37px'*/)); ?>
                    </div>
                    <div class="interlineado span-12 last" style="margin-top: 3px"><!-- DIV CUERPO DEL POSTEO **INICIO** -->
                        <div style="margin-left: 20px">
                            <span class="pulzos_titulo1">
                                <?php echo anchor('usuarios/perfil/'.$plan->planUsuarioId,
                                                    get_complete_username($plan->planUsuarioId),
                                                    array('class'=>'pulzos_titulo1', 'style'=>'text-decoration: none; color: #8D6E98')); ?>
                            </span>
                        </div>
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
                                    var map = new google.maps.Map($(".mapa<?php echo $is; ?>").get(0), myOptions);
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
                                        <div class="pulzos_titulo span-6" style="margin-top: 15px; color: #FFFFFF; margin-left: 80px;">
                                            ¿D&oacute;nde lo dijo?
                                        </div>
                                        <div class="mapa<?php echo $is; ?>" style="width: 200px; height: 100px; margin-left: 25px; margin-top: 40px"></div>
                                    </div>
                                </div>
                                <!--div class="span-6 last" style="margin-top: 10px; margin-left: 0px">
                                    <div class="pulzos_titulo1 span-6" style="margin-top: -30px; color: #8D6E98; text-align: center; margin-left: -10px">
                                        ¿Donde lo dijo?
                                    </div>
                                    <div class="mapa<?php echo $is; ?>" style="width: 200px; height: 100px">
                                    </div>
                                </div-->
                                <?php $is = $is + 1; ?>
                            </div>
                        </div> 
                        <div style="margin-top: 3px; margin-left: 20px; word-wrap: break-word;">
                            <?php $total = count_number_register($plan->planId, 'anexos'); ?>
                            <?php if($total != 0): ?>
                                <?php  $tipo = count_type_register($plan->planId, 'anexos'); ?>
                                <?php if($tipo->enlace != ''): ?>
                                    <span class="pulzos_titulo2" style="color: #606060">
                                        <?php 
                                            $link = get_hipereference($plan->planId); 
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
                            <?php $fecha = unix_to_human($plan->planFechaCreacion);
                                  $fechaCreacion = fecha_acomodo($fecha);
                                  echo $fechaCreacion; ?>
                        </div>
                        <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **INICIO -->
                        <?php if($this->session->userdata('id') != $plan->planUsuarioId): ?>
                            <div class="prepend-3 span-2" style="margin-left: -20px">
                                &nbsp;
                            </div>
                            <div class="span-1">
                                <?php
                                                        $totales = count_comments_post($plan->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                           img(array('src'=>'statics/img/botonComentarios.png',
                                                                                     'width'=>'18px',
                                                                                     'height'=>'15px',
                                                                                     'title'=>'Ver todos')),
                                                                          //'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                        img(array('src'=>'statics/img/botonComentarios.png',
                                                                                  'width'=>'18px',
                                                                                  'height'=>'15px',
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
                                                  array('style'=>'color: #8D6E98; text-decoration: none', 'id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                            </div>
                            <div class="span-1">
                                <?php $numeroUsuario = number_of_points_user($this->session->userdata('id'), $plan->planId); ?>
                                <?php if($numeroUsuario == 0): ?>
                                    <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                      img(array('src'=>'statics/img/botonMeApunto.png',
                                                                'width'=>'20px',//30px',
                                                                'height'=>'15px',//20px',
                                                                'title'=>'Me apunto')),
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$planes->planId)); ?>
                                    <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                      img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                'width'=>'20px',//30px',
                                                                'height'=>'15px',//20px',
                                                                'title'=>'No voy')),
                                                      array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>                         
                                <?php else: ?>
                                    <?php echo anchor('planesusuarios/no_voy/'.$this->session->userdata('id').'/'.$plan->planId,
                                                      img(array('src'=>'statics/img/botonNoMeApunto.png',
                                                                'width'=>'20px',//30px',
                                                                'height'=>'15px',//20px',
                                                                'title'=>'No voy')),
                                                      array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'No'.$plan->planId, 'class'=>'novoy', 'name'=>$plan->planId)); ?>
                                    <?php echo anchor('planesusuarios/me_apunto/'.$plan->planId.'/'.$this->session->userdata('id'),
                                                      img(array('src'=>'statics/img/botonMeApunto.png',
                                                                'width'=>'20px',//30px',
                                                                'height'=>'15px',//20px',
                                                                'title'=>'Me apunto')),
                                                      array('style'=>'text-decoration: none; color: #8D6E98; display: none', 'id'=>'Si'.$plan->planId, 'class'=>'apuntar', 'name'=>$plan->planId)); ?>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="prepend-3 span-2" style="margin-left: -20px">
                                &nbsp;
                            </div>
                            <div class="span-1">
                                <?php
                                                        $totales = count_comments_post($plan->planId);
                                                        if($totales > 3){
                                                            $t3 = $totales - 3;
                                                    ?>
                                                        <?php echo anchor('planesusuarios/ver_personal/'.$plan->planId,
                                                                          img(array('src'=>'statics/img/botonComentarios.png',
                                                                                    'width'=>'18px',
                                                                                    'height'=>'15px',
                                                                                    'title'=>'Ver todos')),
                                                                          //'Ver todos (' . $t3 . ')',
                                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 12px', 'class'=>'ver-publicacion-personal')); ?>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            echo anchor('planesusuarios/ver_personal/'.$plan->planId,
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
                                                  array('style'=>'color: #8D6E98; text-decoration: none; margin-left: 0px', 'id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                            </div>
                            <div class="span-1"><!-- 3 last" -->
                                <?php echo anchor('planesusuarios/borrar_comentario_negocio/'.$plan->planId.'/'.$plan->planScribbleId,
                                                  img(array('src'=>'statics/img/eliminar.png',
                                                            'width'=>'14px',
                                                            'height'=>'16px',
                                                            'title'=>'Eliminar')),//'Eliminar',
                                                  array('style'=>'color: #8D6E98; text-decoration: none; margin-left: -15px', 'class'=>'eliminar-scribble', 'name'=>$plan->planId)); ?>
                            </div>
                        <?php endif; ?>
                        <!-- PARTE DEL MENU PARA PODER ELIMINAR EL COMENTARIO O APUNTARSE AL MISMO **FIN** -->
                    </div><!-- DIV DEL MENU **FIN** -->
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
                    </div><!-- FONDO **FIN** -->

                    <div class="comentarios-<?php echo $plan->planId; ?> prepend-1 span-8 last" style="display: none"><!-- DIV DEL FORMULARIO PARA COMENTARIOS **INICIO** -->
                        <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$plan->planId.'/'.$this->session->userdata('id'),//$usuarios->id,
                                             array('class'=>'forma-comentar-muro'.$plan->planId)); ?>
                            <div class="span-8" style="margin-left: 6px">
                                <?php echo form_textarea(array('id'=>'sub-comentario'.$plan->planId,
                                                               'class'=>'secondary-comment'.$plan->planId,
                                                               'style'=>'width: 470px; height: 23px; color: #999999',
                                                               'onkeypress'=>'subcomentar_enter(event,' . $plan->planId . ')',
                                                               'onfocus'=>"return desaparecer_sub('Comentar'," . $plan->planId . ")",
                                                               'onblur'=>"return aparecer_sub('Comentar'," . $plan->planId . ")",
                                                               'value'=>'Comentar',
                                                               'name'=>'comentar_muro')); ?>
                            </div>
                            <?php //echo form_submit('a', 'a'); ?>
                        <?php echo form_close(); ?>
                        <input type="hidden" id="oct<?php echo $plan->planId; ?>" />
                    </div><!-- DIV DEL FORMULARIO PARA COMENTARIOS **FIN** -->                

                    <div class="comentarios<?php echo $plan->planId; ?>"><!-- DIV QUE MUESTRA LOS COMENTARIOS **INICIO** -->
                        <div class="span-13" style="margin-top: 20px; margin-bottom: 15px">
                            <?php $valores_comentarios = count_all_subcomments($plan->planId, '1'); ?><!-- cuenta numero de comments-->
                            <?php if($valores_comentarios != 0): ?>
                                <?php if($valores_comentarios > 3): ?>
                                    <?php $ids_comments = get_all_ids($plan->planId, '1'); ?><!--obtiene los ids de los comments -->
                                    <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                    <?php $comentarios = get_subcomments_wall1($plan->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                <?php else: ?>
                                    <?php $comentarios = get_subcomments_wall($plan->planId, '1'); ?>
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
                                                        <?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
                                                            <?php /*echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                                             img(array('src'=>'statics/img/cerrar.jpg',
                                                                                       'width'=>'14px',
                                                                                       'height'=>'12px')),
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
                                                	<?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
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


                    <?php else: ?>
                        <div class="span-13" style="margin-top: 5px; margin-bottom: 5px; border-bottom: 1px solid #DAD6DB"><!-- DIV CONTENEDOR DEL PLAN **INICIO** -->
                            <div class="span-14 last" style="width: 524px">
                                <div class="span-1">
                                    <?php echo img(array('src'=>get_thumb_avatar($plan->planUsuarioId)/*get_avatar($plan->planUsuarioId),
                                                         'width'=>'36',
                                                         'height'=>'36'*/)); ?>
                                </div>
                                <div class="span-12 last" style="word-wrap: break; margin-left: 10px">
                                    <!--span class="pulzos_titulo1">
                                        Titulo:
                                    </span -->
                                    <span class="pulzos_titulo2">
                                        <?php echo $plan->planMensaje; ?>
                                    </span>
                                    <br />
                                    <span class="pulzos_titulo1">
                                        Lugar:
                                    </span>
                                    <span class="pulzos_titulo2">
                                        <?php if($plan->planEsEmpresa == '0'): ?>
                                            <?php echo $plan->planLugar; ?>
                                        <?php else: ?>
                                            <?php echo anchor('negocios/perfil/'.$plan->planIdEmpresa,
                                                              $plan->planLugar,
                                                              array('style'=>'color: #8D6E98; text-decoration: none')); ?>
                                        <?php endif; ?>
                                    </span>
                                    <br />
                                    <span class="pulzos_titulo1">
                                        Fecha Inicio:
                                    </span>
                                    <span class="pulzos_titulo2">
                                        <?php $fechaI = unix_to_human($plan->planFechaInicio);
                                              $correctaI = fecha_acomodo($fechaI);
                                              echo $correctaI . " - " . $plan->planHoraInicio; ?>
                                    </span>
                                    <span class="pulzos_titulo2">
                                        <?php echo $plan->planDireccion; ?>
                                    </span>
                                    
                                        <?php echo $plan->planDescripcion; ?>
                                  
                                </div>
                                <div class="prepend-1 span-14" style="margin-top: 5px; margin-left: 10px">
                                    <div class="span-2">
                                        <?php if($plan->planEsEmpresa == '0'): ?>
                                            <?php if($plan->planImagenId == '0'): ?>
                                                <?php echo anchor('planesusuarios/ver_plan/'.$plan->planId,
                                                                 img(array('src'=>'statics/img/default/planes.jpg',
                                                                           'width'=>'100',
                                                                           'height'=>'100')),
                                                                  array('id'=>'imagenPlan', 'class'=>'', 'style'=>'text-decoration: none')); ?>
                                            <?php else: ?>
                                                <?php echo anchor('planesusuarios/ver_plan/'.$plan->planId,
                                                                  img(array('src'=>get_avatar_plan($plan->planId),
                                                                            'width'=>'100',
                                                                            'height'=>'100')),
                                                                  array('id'=>'imagenPlan', 'class'=>'', 'style'=>'text-decoration: none')); ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo anchor('planesusuarios/ver_plan/'.$plan->planId,
                                                              img(array('src'=>get_avatar_negocios($plan->planIdEmpresa),
                                                                        'height'=>'100',
                                                                        'width'=>'100'))); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="prepend-1 span-10 last" style="margin-top: 5px">
                                        <span class="pulzos_titulo2" style="word-wrap: break-word">
                                            <?php echo anchor('planesusuarios/ver_plan/'.$plan->planId,
                                                              $plan->planDescripcion,
                                                              array('style'=>'text-decoration: none; color: #8D6E98')); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="prepend-1 span-14 last" style="margin-bottom: 0px">
                                    <div class="span-6">
                                        &nbsp;
                                    </div>
                                    <div class="prepend-1 span-2"> 
                                        <?php echo anchor('planesusuarios/ver_plan/'.$plan->planId,
                                                          'Ver mas',
                                                          array('style'=>'text-decoration: none; color: #8D6E98; margin-left: 15px')); ?>
                                    </div>
                                    <div class="span-2">
                                        <?php echo anchor('#',
                                                          'Comentar',
                                                          array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>$plan->planId, 'class'=>'comentar-plan')); ?>
                                    </div>
                                    <?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
                                        <div class="span-1">
                                            <?php echo anchor('planesusuarios/borrar_comentario/'.$plan->planId,
                                                              'Eliminar',
                                                              array('style'=>'text-decoration: none; color: #8D6E98; margin-left: -5px', 'class'=>'eliminar-plan')); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="comentarios-<?php echo $plan->planId; ?> prepend-1 span-8 last" style="display: none">
                                <?php echo form_open('planesusuarios/guardar_comentarios_wall/'.$plan->planId.'/'.$this->session->userdata('id'),//$usuarios->id,
                                                     array('class'=>'forma-comentar-muro'.$plan->planId)); ?>
                                    <div class="span-8" style="margin-left: 6px">
                                        <?php echo form_textarea(array('id'=>'sub-commentario'.$plan->planId,
                                                                       'class'=>'secondary-comment'.$plan->planId,
                                                                       'style'=>'width: 470px; height: 23px; color: #999999',
                                                                       'onkeypress'=>'subcomentar_enter(event,' . $plan->planId . ')',
                                                                       'onfocus'=>"return desaparecer_sub('Comentar'," . $plan->planId . ")",
                                                                       'onblur'=>"return aparecer_sub('Comentar'," . $plan->planId . ")",
                                                                       'value'=>'Comentar',
                                                                       'name'=>'comentar_muro')); ?>
                                    </div>
                                <?php echo form_close(); ?>
                                <input type="hidden" id="oct<?php echo $plan->planId; ?>" />
                            </div>
                            <div class="comentarios<?php echo $plan->planId; ?>">
                                <div class="span-13" style="margin-top:20px; margin-bottom: 15px;">
                                    <?php $valores_comentarios = count_all_subcomments($plan->planId, '1'); ?><!-- cuenta numero de comments-->
                                    <?php if($valores_comentarios != 0): ?>
                                        <?php if($valores_comentarios > 3): ?>
                                            <?php $ids_comments = get_all_ids($plan->planId, '1'); ?><!--obtiene los ids de los comments -->
                                            <?php $get_last_id = get_last_id_subcomment($ids_comments, $valores_comentarios); ?><!-- obtiene el id comment -->
                                            <?php $comentarios = get_subcomments_wall1($plan->planId, '1', $get_last_id); ?><!-- se obtienen los datos -->
                                        <?php else: ?>
                                            <?php $comentarios = get_subcomments_wall($plan->planId, '1'); ?>
                                        <?php endif; ?>
                                        <?php foreach($comentarios as $comentario): ?><!-- FOREACH DE LOS SUBCOMENTARIOS **INICIO** -->
                                        <div class="span-12 last" style="background-color: #FFFFFF; margin-left: 50px; margin-bottom: 1px">
                                            <div class="span-11 last"><!-- DIV INICIAL DE LOS SUBCOMENTARIOS **INICIO** -->
                                                <div class="span-1" style="margin-left: 5px; margin-top: 4px">
                                                    <?php echo img(array('src'=>get_thumb_avatar($comentarios->id)/*get_avatar($comentario->id),
                                                                         'width'=>'36',
                                                                         'height'=>'36'*/)); ?>
                                                </div>
                                                <div class="span-9 last" style="margin-top: 14px; margin-left: 14px">
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
                                                <div class="prepend-1 span-12 last" style="margin-top: 12px">
                                                    <div class="span-1" style="margin-left: 20px">
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
                                                    <div class="prepend-4 span-1 last" style="margin-left: 40px">
                                                    	<?php if($this->session->userdata('id') == $plan->planUsuarioId): ?>
                                                        	<?php echo anchor('planesusuarios/delete_subcomments/'.$comentario->comentarioSimpleId,
                                                                              img(array('src'=>'statics/img/eliminar.png',
                                                                                        'width'=>'17px',
                                                                                        'height'=>'20px')),
                                                                              array('class'=>'eliminar-sub')); ?>
                                                        <?php endif; ?>
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
            <?php endforeach; ?>
            <div class="span-14 last"><!-- DIV DONDE SE PONDRAN LOS REGISTROS DE VER MAS **INICIO** -->
                <div id="verMasPersonal">
                </div>
            </div><!-- DIV DONDE SE PONDRAN LOS REGISTROS DE VER MAS **FIN** -->
            <div class="span-14 last"><!-- DIV DEL MENU **INICIO** -->
                <div class="span-14" style="display: none">
                <span class="ultimos"><?php echo $valores; ?></span>
                    <?php echo anchor('planesusuarios/get_last_comment_mine/'.$usuario, '', array('style'=>'display: ', 'id'=>'urlGet')); ?>
                </div>
                <div class="prepend-12 last" style="margin-top: 10px; margin-bottom: 10px" id="ver-mas-pub-mios">
                    <?php echo anchor('planesusuarios/ver_siguientes_diez_mios/'.$usuario,
                                      img(array('src'=>'statics/img/botonVerMas.png',
                                                'width'=>'50px',
                                                'height'=>'25px')),
                                      //'Ver más',
                                      array('style'=>'text-decoration: none; color: #660066; margin-left: -20px', 'class'=>'ver-mas-publicaciones')); ?>
                </div>
            </div><!-- DIV DEL MENU **FIN** -->
        </div><!--DIV PRINCIPAL DE LOS COMENTARIOS **FIN** -->
    </div>
</div>
