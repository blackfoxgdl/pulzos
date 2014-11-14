<script type="text/javascript">
$(".menu-izq-menor").click(function(event){
    event.preventDefault();
    urlE = $(event.currentTarget).attr("href");
    $.ajax({
            type: "GET",
            url: urlE,
            complete: function(){
               update1();
               cargarAmigos();
            }
    });
});

function update1() {
    urlReloadFriends = $("#reloadFriendsA").attr("href");
    $.ajax({
        type: 'GET',
        url: urlReloadFriends,
        timeout: 5000,
        success: function(data) {
            if(data.length > 728)
            {
                $("#amigos-update-new").html(data);
                window.setTimeout(update1, 60000);
            }
            else
            {
                window.setTimeout(update1, 300000);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
              window.setTimeout(update1, 60000);
        }
    });
}


function cargarAmigos()
{
    var recargarPaginaAmigos = $("#reloadPage").attr("href");
    $("#texto-menu").load(recargarPaginaAmigos ,function(){
        $(this).show('slow');
    });
}

$(".eliminar-amistad").click(function(event){
    event.preventDefault();
    var urlDelete = $(event.currentTarget).attr("href");
    var valor = confirm('¿Deseas borrar a tu contacto de la lista de amigos?');
    if(valor == true)
    {        
        $.get(urlDelete);
        $(event.currentTarget).parent().parent().parent().parent().hide('fast');
    }
    else
    {
        return false;
    }
});

$("#ver-todos-recibidas").click(function(event){
    event.preventDefault();
    $("#ver-recibidas").hide();
    $("#vista-corta").hide();
    $("#ocultar-recibidas").show();
    $("#vista-larga").show('fast');
});

$("#ocultar-todas-recibidas").click(function(event){
    event.preventDefault();
    $("#ocultar-recibidas").hide();
    $("#vista-larga").hide();
    $("#ver-recibidas").show();
    $("#vista-corta").show();
});

$("#ver-enviadas").click(function(event){
    event.preventDefault();
    $('#ver-enviadas').hide();
    $('#enviadas-vista-corta').hide();
    $('#ocultar-enviadas').show();
    $('#enviadas-vista-larga').show();
});

$("#ocultar-enviadas").click(function(event){
    event.preventDefault();
    $('#ocultar-enviadas').hide();
    $('#enviadas-vista-larga').hide();
    $('#ver-enviadas').show();
    $('#enviadas-vista-corta').show();
});

$(".mensaje").click(function(event){
    event.preventDefault();
    urlMensaje = $(this).attr('href');
    $("#texto-menu").load(urlMensaje);
});

$(".saludo-amigos").click(function(event){
    event.preventDefault();
    urlAmigosSaludo = $(event.currentTarget).attr("href");
    $.get(urlAmigosSaludo);
    $("#saludo-div").fadeIn(1000);
    $("#saludo-div").fadeOut(2000);
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
});
</script>
<?php echo anchor('usuarios/reload_friends_new/'.$this->session->userdata('id'), '', array('id'=>'reloadFriendsA', 'style'=>'display: none')); ?>
<div style="display: none">
    <div id="nombre-usuario-plan">Amigos</div>
    <?php echo anchor('amigos/index/'.$this->session->userdata('id'), '', array('id'=>'reloadPage')); ?>
</div>
<?php if($this->session->userdata('id') == $id): ?>
    <div class="span-14 last" style="margin-bottom: 10px"><!-- DIV DE SOLICITUDES PENDIENTES DE AMIGOS **INICIO** -->
        <div class="span-13" style="display: none; color: #FFFFFF; background-color: #A71E9F" id="saludo-div">
            Tu saludo ha sido enviado
        </div>
        <div class="span-13" style="margin-top: 30px; margin-bottom: 10px;">
            <span class="span-8" style="color: #68146E; font-size: 10pt">
                Solicitudes de amistades pendientes recibidas (<?php echo $total_recibidas; ?>)
            </span>
            <span class="prepend-3" style="margin-left: 2px" id="ver-recibidas">
                <?php echo anchor('#',
                                  'ver todos',
                                  array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'ver-todos-recibidas')); ?>
            </span>
            <span class="prepend-3" style="margin-left: -2px; display: none" id="ocultar-recibidas">
                <?php echo anchor('#',
                                  'ocultar todos',
                                  array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'ocultar-todas-recibidas')); ?>
            </span>
        </div> 
        <div class="span-13 last" style="border-bottom: 1px solid #DAD6DB;" id="vista-corta">
            <?php foreach($no_autorizados as $noAutorizados): ?>
                <div class="span-1">
                    <?php echo anchor('usuarios/perfil/'.$noAutorizados->id,
                                      img(array('src'=>get_avatar($noAutorizados->id),
                                                'width'=>'36',
                                                'height'=>'36',
                                                'title'=>get_complete_username($noAutorizados->id))),
                                      array('class'=>'imagen'.$noAutorizados->id)); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="span-13 last" style="border-bottom: 1px solid #DAD6DB; display: none" id="vista-larga">
            <?php foreach($no_autorizados as $noAutorizados): ?>
                <div class="span-6" style="border: 1px solid #DAD6DB; margin-bottom: 7px; margin-right: 15px; width: 255px; height: 50px;" id="larga<?php echo $noAutorizados->id; ?>">
                    <div class="span-1" style="margin-left: 4px; margin-top: 4px">
                        <?php echo anchor('usuarios/perfil/'.$noAutorizados->id,
                                          img(array('src'=>get_avatar($noAutorizados->id),
                                                    'width'=>'37px',
                                                    'height'=>'37px',
                                                    'title'=>get_complete_username($noAutorizados->id)))); ?>
                    </div>
                    <div class="span-5 last" style="margin-left: 10px; margin-top: 9px; margin-bottom: 4px">
                        <div class="span-6">
                            <div class="span-5 last" style="margin-top: -5px">
                                <?php echo anchor('usuarios/perfil/'.$noAutorizados->id,
                                                  get_complete_username($noAutorizados->amigoAmigoId),
                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                            </div>
                        </div>
                    </div>
                    <div class="span-5">
                        <div class="span-6" style="margin-top:4px">
                            <div class="prepend-2">
                                <?php echo anchor('amigos/autorizar/'.$noAutorizados->id.'/'.$this->session->userdata('id'),
                                                  'Aceptar',
                                                  array('style'=>'text-decoration: none; margin-left: 15px;margin-top:5px; color: #8D6E98', 'class'=>'menu-izq-menor', 'name'=>$noAutorizados->id)); ?>
                                <?php echo anchor('amigos/rechazar/'.$noAutorizados->id.'/'.$this->session->userdata('id'),
                                                  'Rechazar',
                                                  array('style'=>'text-decoration: none; margin-left: 15px;margin-top:5px; color: #8D6E98', 'class'=>'menu-izq-menor')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div><!-- DIV DE SOLICITUDES PENDIENTES DE AMIGOS **FIN** -->
    <div class="span-14 last" style="margin-bottom: 10px"><!-- DV DE SOLICITUDES PENDIENTES ENVIADAS DE AMIGOS **INICIO** -->
        <div class="span-13" style="margin-top: 10px; margin-bottom: 10px">
            <span class="span-8" style="color: #68146E; font-size: 10pt">
                Solicitudes de amistades pendientes enviadas (<?php echo $total_enviadas; ?>)
            </span>
            <span class="prepend-3" style="margin-left: 2px" id="ver-enviadas">
                <?php echo anchor('#',
                                  'ver todos',
                                  array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'ver-todos-enviados')); ?>
            </span>
            <span class="prepend-3" style="display: none; margin-left: -2px" id="ocultar-enviadas">
                <?php echo anchor('#',
                                  'ocultar todos',
                                  array('style'=>'text-decoration: none; color: #8D6E98', 'id'=>'ocultar-todas-enviadas')); ?>
            </span>
        </div>
        <div class="span-13 last" style="border-bottom: 1px solid #DAD6DB" id="enviadas-vista-corta">
            <?php foreach($pendientes as $pendiente): ?>
                <div class="span-1">
                    <?php echo anchor('usuarios/perfil/'.$pendiente->id,
                                      img(array('src'=>get_avatar($pendiente->id),
                                                'width'=>'36',
                                                'height'=>'36',
                                                'title'=>get_complete_username($pendiente->id)))); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="span-14 last" style="border-bottom: 1px solid #DAD6DB; display: none" id="enviadas-vista-larga">
            <?php foreach($pendientes as $pendiente): ?>
                <div class="span-6" style="border: 1px solid #DAD6DB; margin-bottom: 7px; margin-right: 10px; width: 255px; height: 50px;">
                    <div class="span-1" style="margin-top: 4px; margin-left: 4px">
                        <?php echo img(array('src'=>get_avatar($pendiente->id),
                                             'width'=>'37px',
                                             'height'=>'37px')); ?>
                    </div>
                    <div class="span-5 last" style="margin-left: 10px; margin-top: 9px; margin-bottom: 4px">
                        <div class="span-6">
                            <div class="span-5 last" style="margin-top: -5px">
                                <?php echo anchor('usuarios/perfil/'.$pendiente->id,
                                                  get_complete_username($pendiente->amigoAmigoId),
                                                  array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                            </div>
                        </div>
                    </div>
                    <div class="span-5">
                        <div class="span-6" style="margin-left: 10px">
                            <?php echo anchor('amigos/borrar/'.$pendiente->id.'/'.$this->session->userdata('id'),
                                              'Cancelar Solicitud',
                                              array('style'=>'text-decoration: none; color: #8D6E98', 'class'=>'eliminar-amistad')); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div><!-- DIV DE SOLICITUDES PENDIENTES ENVIADAS DE AMIGOS **FIN** -->
<?php endif; ?>
<div class="span-14 last" style="margin-bottom: 200px; margin-top: 10px"><!-- DIV DE AMIGOS ACEPTADOS **INICIO** --> 
    <?php foreach($amigos as $amistad): ?>
    <div class="span-6" style="border: 1px solid #DAD6DB; margin-bottom: 7px; margin-right: 15px; width: 255px; height: 50px;">
            <div class="span-1" style="margin-left: 4px; margin-top: 4px">
                <?php $total = exists_avatar($amistad->id); ?>
                <?php if($total != 0): ?>
                    <?php echo anchor('usuarios/perfil/'.$amistad->id,
                                      img(array('src'=>get_avatar($amistad->id),
                                                'width'=>'37',
                                                'height'=>'37'))); ?>
                <?php else: ?>
                    <?php if($amistad->sexo == 0): ?>
                        <?php echo anchor('usuarios/perfil/'.$amistad->id,
                                          img(array('src'=>'statics/img/default/nopic-fem.jpg',
                                                    'width'=>'37',
                                                    'height'=>'37'))); ?>
                    <?php elseif($amistad->sexo == 1): ?>
                        <?php echo anchor('usuarios/perfil/'.$amistad->id,
                                          img(array('src'=>'statics/img/default/avatar.jpg',
                                                    'width'=>'37',
                                                    'height'=>'37'))); ?>
                    <?php else: ?>
                        <?php echo anchor('usuarios/perfil/'.$amistad->id,
                                          img(array('src'=>'statics/img/default/avatar.jpg',
                                                    'width'=>'37',
                                                    'height'=>'37'))); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="span-5 last" style="margin-left: 10px; margin-top: 9px; margin-bottom: 4px">
                <div class="span-6">
                    <div class="span-5 last" style="margin-top: -5px">
                        <?php echo anchor('usuarios/perfil/'.$amistad->id,
                                          get_complete_username($amistad->amigoAmigoId),
                                          array('style'=>'text-decoration: none; color: #8D6E98')); ?> 
                    </div>
                    <?php if($this->session->userdata('id') == $amistad->amigoUsuarioId): ?>
                        <div class="span-1" style="margin-top: -4px">
                            <?php echo anchor('amigos/borrar/'.$amistad->id.'/'.$this->session->userdata('id'),
                                              img(array('src'=>'statics/img/cerrar.jpg',
                                                        'width'=>'',
                                                        'height'=>'')),
                                              array('style'=>'margin-top: 10px; margin-left: -7px', 'class'=>'eliminar-amistad')); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="span-5 last">
                    <?php echo anchor('amigos/enviar_saludo/'.$amistad->amigoAmigoId.'/'.$this->session->userdata('id'),
                                      img(array('src'=>'statics/img/ico-saluda.png',
                                                'width'=>'15px',
                                                'height'=>'15px',
                                                'style'=>'margin-right: 6px',
                                                'title'=>'Enviar un saludo')),
                                      array('style'=>'text-decoration: none', 'class'=>'saludo-amigos')); ?>
                    <?php echo img(array('src'=>'statics/img/ico-invita.png',
                                         'width'=>'15px',
                                         'height'=>'15px',
                                         'style'=>'margin-right: 6px',
                                         'title'=>'Invitar a salir')); ?>
                    <?php echo anchor('inboxusuarios/crear/'.$this->session->userdata('id').'/'.$amistad->amigoAmigoId,
                                      img(array('src'=>'statics/img/unread.png',
                                                'width'=>'20',
                                                'height'=>'12',
                                                'title'=>'Enviar un mensaje')),
                                      array('style'=>'text-decoration: none', 'class'=>'mensaje')); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div><!-- DIV DE AMIGOS ACEPTADOS **FIN** ->
