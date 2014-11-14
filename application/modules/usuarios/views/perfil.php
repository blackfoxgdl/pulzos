<?php
/**
 * Vista del perfil de usuarios
 * donde se mostraran al ingresar
 * los pulzos del mismo
 **/

?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery_tools/jquery.tools.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/json2005.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/rsh.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery-1.4.1.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/sessvars.js'; ?> "></script>
<script type="text/javascript">
(function($) {
    var locationWrapper = {
        put: function(hash, win) {
            (win || window).location.hash = this.encoder(hash);
        },
        get: function(win) {
            var hash = ((win || window).location.hash).replace(/^#/, '');
            try {
                return $.browser.mozilla ? hash : decodeURIComponent(hash);
            }
            catch (error) {
                return hash;
            }
        },
        encoder: encodeURIComponent
    };

    var iframeWrapper = {
        id: "__jQuery_history",
        init: function() {
            var html = '<iframe id="'+ this.id +'" style="display:none" src="javascript:false;" />';
            $("body").prepend(html);
            return this;
        },
        _document: function() {
            return $("#"+ this.id)[0].contentWindow.document;
        },
        put: function(hash) {
            var doc = this._document();
            doc.open();
            doc.close();
            locationWrapper.put(hash, doc);
        },
        get: function() {
            return locationWrapper.get(this._document());
        }
    };

    function initObjects(options) {
        options = $.extend({
                unescape: false
            }, options || {});

        locationWrapper.encoder = encoder(options.unescape);

        function encoder(unescape_) {
            if(unescape_ === true) {
                return function(hash){ return hash; };
            }
            if(typeof unescape_ == "string" &&
               (unescape_ = partialDecoder(unescape_.split("")))
               || typeof unescape_ == "function") {
                return function(hash) { return unescape_(encodeURIComponent(hash)); };
            }
            return encodeURIComponent;
        }

        function partialDecoder(chars) {
            var re = new RegExp($.map(chars, encodeURIComponent).join("|"), "ig");
            return function(enc) { return enc.replace(re, decodeURIComponent); };
        }
    }

    var implementations = {};

    implementations.base = {
        callback: undefined,
        type: undefined,

        check: function() {},
        load:  function(hash) {},
        init:  function(callback, options) {
            initObjects(options);
            self.callback = callback;
            self._options = options;
            self._init();
        },

        _init: function() {},
        _options: {}
    };

    implementations.timer = {
        _appState: undefined,
        _init: function() {
            var current_hash = locationWrapper.get();
            self._appState = current_hash;
            self.callback(current_hash);
            setInterval(self.check, 100);
        },
        check: function() {
            var current_hash = locationWrapper.get();
            if(current_hash != self._appState) {
                self._appState = current_hash;
                self.callback(current_hash);
            }
        },
        load: function(hash) {
            if(hash != self._appState) {
                locationWrapper.put(hash);
                self._appState = hash;
                self.callback(hash);
            }
        }
    };

    implementations.iframeTimer = {
        _appState: undefined,
        _init: function() {
            var current_hash = locationWrapper.get();
            self._appState = current_hash;
            iframeWrapper.init().put(current_hash);
            self.callback(current_hash);
            setInterval(self.check, 100);
        },
        check: function() {
            var iframe_hash = iframeWrapper.get(),
                location_hash = locationWrapper.get();

            if (location_hash != iframe_hash) {
                if (location_hash == self._appState) {    // user used Back or Forward button
                    self._appState = iframe_hash;
                    locationWrapper.put(iframe_hash);
                    self.callback(iframe_hash); 
                } else {                              // user loaded new bookmark
                    self._appState = location_hash;  
                    iframeWrapper.put(location_hash);
                    self.callback(location_hash);
                }
            }
        },
        load: function(hash) {
            if(hash != self._appState) {
                locationWrapper.put(hash);
                iframeWrapper.put(hash);
                self._appState = hash;
                self.callback(hash);
            }
        }
    };

    implementations.hashchangeEvent = {
        _init: function() {
            self.callback(locationWrapper.get());
            $(window).bind('hashchange', self.check);
        },
        check: function() {
            self.callback(locationWrapper.get());
        },
        load: function(hash) {
            locationWrapper.put(hash);
        }
    };

    var self = $.extend({}, implementations.base);

    if($.browser.msie && ($.browser.version < 8 || document.documentMode < 8)) {
        self.type = 'iframeTimer';
    } else if("onhashchange" in window) {
        self.type = 'hashchangeEvent';
    } else {
        self.type = 'timer';
    }

    $.extend(self, implementations[self.type]);
    $.history = self;
})(jQuery);

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

function update2() {

    urlReloadCompanies = $("#reloadCompaniesC").attr("href");
    $.ajax({
        type: 'GET',
        url: urlReloadCompanies,
        timeout: 5000,
        success: function(data) {
            if(data.length > 744)
            {
                $("#negocios_siguiendo").html(data);
                window.setTimeout(update1, 60000);
            }
            else
            {
                window.setTimeout(update2, 300000);
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
              window.setTimeout(update2, 60000);
        }
    });
}
function load(num) {
	
            $('#texto-menu').load(num);
        }

        $.history.init(function(url) {
                load(url == "" ? "<?php echo base_url()?>index.php/perfil/" : url);
//planesusuarios/ver/<?php echo $usuario->id;?>" : url);
            });

        $("a[rel='history']").click(function(){
        $.history.load(this.href.replace(/^.*#/, ''));
        return false;
    });


$(document).ready(function(){
    
    update1();
    update2();

    var noAmigos = $("#no-amigos").attr("href");
    $("#noAmigos").load(noAmigos);

// DE AQUI AGREGUE
$(".menu-usuarios1").click(function(event){
    event.preventDefault();
    urlMenu = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlMenu);
	
});

$(".links1").click(function(event){
        event.preventDefault();
        urlLink = $(event.currentTarget).attr("href");
        $("#texto-menu").load(urlLink);
});

// HASTA AQUI AGREGUE

$("#avatar-photo-block, .notification-block").hover(function(){
    $(".notification-block").css('display', 'block');
    $(".notification-block").css('position', 'absolute');
    }, function(){
    $(".notification-block").css('display', 'none');
});

$("#borrar_avatar").click(function(event){
    urlDeleteAvatar = $(this).attr("href");
    usuarioSexo = $(this).attr('name');
    $.get(urlDeleteAvatar);

});

if($("#hmensaje").attr('value')=='msj'){
    urls=$("#inbox-user").attr("href");
    timer=120;setTimeout(function(){$("#texto-menu").load(urls);},timer);
}

 urlMain='<?php echo base_url()?>index.php/money/index/<?php echo $usuario->id; ?>';//planesusuarios/ver/<?php echo $usuario->id;?>';
 urlInicio='<?php echo base_url()?>index.php/money/index/<?php echo $usuario->id;?>';
 
 if(!sessvars.pagina1){$("#texto-menu").load(urlInicio);
 			
 		}else{
 		if((<?php echo $usuario->id ?>)==(<?php echo $this->session->userdata('id'); ?>))
				{
				pagina=sessvars.pagina1;
				capa=sessvars.capa1;
				$(capa).load(pagina); 

				}else{ 

				$("#texto-menu").load(urlMain);

				sessvars.close();
				}	
			}

});

//funcion para recargar el div

function Enviar(pagina,capa) {

				sessvars.pagina1=pagina;
				sessvars.capa1=capa;
			
				if((<?php echo $usuario->id ?>)==(<?php echo $this->session->userdata('id'); ?>))
				{
					
					$(capa).load(pagina); 

				}else{

				$(capa).load(pagina);				
				sessvars.close();
				}	
				
}

// sicript para que el usuario navegue utilizando los enlaces internos de la página ajax.

window.dhtmlHistory.create({

	toJSON: function(o){
		return JSON.stringify(o);
	}
	, fromJSON: function(s){
		return JSON.parse(s);
	}
});

var yourListener = function(newLocation, historyData){
var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	if(($.browser.safari) && (is_chrome==false)){
				if((newLocation==NULL )){
						if(!(sessvars.pagina1)){
							$(document).ready(function() {
							urlMain='<?php echo base_url()?>index.php/money/index/<?php echo $usuario->id; ?>';
							$("#texto-menu").load(urlMain);
							$("#no-amigos").load(urlMain);
							});	
						}else{
							if(<?php echo $usuario->id ?>==<?php echo $this->session->userdata('id'); ?>){
								pagina=sessvars.pagina1;
								capa=sessvars.capa1;
								$(capa).load(pagina); 
							}else{
                                urlMain='<?php echo base_url()?>index.php/money/index/<?php echo $usuario->id; ?>';
                                //planesusuarios/ver/<?php echo $usuario->id; ?>';
								$("#texto-menu").load(urlMain);
							}
						}
				}else{
					Enviar(newLocation,'#texto-menu'); 	
				}
	
	}else{
		if((!newLocation )){
						if(!(sessvars.pagina1)){
							$(document).ready(function() {
							urlMain='<?php echo base_url()?>index.php/money/index/<?php echo $usuario->id; ?>';
							$("#texto-menu").load(urlMain);
							$("#no-amigos").load(urlMain);
							});	
						}else{
							if(<?php echo $usuario->id ?>==<?php echo $this->session->userdata('id'); ?>){
								pagina=sessvars.pagina1;
								capa=sessvars.capa1;
								$(capa).load(pagina); 
							}else{
                                urlMain='<?php echo base_url()?>index.php/money/index/<?php echo $usuario->id; ?>';//planesusuarios/ver/<?php echo $usuario->id; ?>';
								$("#texto-menu").load(urlMain);
							}
						}
			}else{
			Enviar(newLocation,'#texto-menu'); 	
			}
	}		

}
window.onload = function(){

	dhtmlHistory.initialize();
	dhtmlHistory.addListener(yourListener);

};
function EnviarN(pagina,capa){
			sessvars.pagina2=pagina;
				sessvars.capa2=capa;
}

</script>

<?php echo anchor('usuarios/reload_friends_new/'.$usuario->id, '', array('id'=>'reloadFriendsA', 'style'=>'display: none')); ?>
<?php echo anchor('usuarios/reload_companies_new/'.$usuario->id, '', array('id'=>'reloadCompaniesC', 'style'=>'display: none')); ?>
<?php echo anchor('usuarios/perfil', '', array('style'=>'display: none;', 'id'=>'redireccion')); ?>
<?php 
if(isset($mensaje)){ ?>
<input type="hidden" id="hmensaje" value="<?php echo $mensaje; ?>" />
<?php echo anchor('inboxusuarios/index/'.$this->session->userdata('id'),'',array('id'=>'inbox-user', 
                                                                                'style'=>'display:none', 
                                                                                'class'=>'uno'));
} ?>
<?php 
    $totales = exists_avatar($usuario->id); 
    if($totales == 1)
    {
        $avatarId = avatar_id($usuario->id);
        $idAvatar = $avatarId->imagenId;
    }
    else
    {
        $idAvatar = 0;
    }
?>
<div class="span-24 last"><!-- DIV PRINCIPAL **INICIO** --> 
    <div class="span-4 left-column" style="margin-top: 0px;"><!--  margin-right:30px --><!-- DIV COLUMNA DERECHA **INICIO** -->
        <div class="avatar span-4 last">
            <div class="notification-block">
                <?php $total = exists_avatar($usuario->id); ?>
                <?php echo anchor('#', 'Cambiar Avatar', array('class'=>'middle-menu-link','onclick'=>"dhtmlHistory.add('".base_url()."index.php/imagenes/cambiar_avatar',null);Enviar('".base_url()."index.php/imagenes/cambiar_avatar','#texto-menu');return false;")); ?>
                <?php if($total != 0): ?>
                    <?php echo anchor('usuarios/update_avatar/'.$idAvatar, img(array('src'=>'statics/img/cerrar.jpg', 'width'=>'14', 'height'=>'12', 'style'=>'margin-top: 3px')), array('class'=>'middle-menu-link','style'=>'margin-left: 50px;', 'id'=>'borrar_avatar', 'name'=>$usuario->sexo)); ?>
                <?php endif; ?>
            </div>
            <?php if($this->session->userdata('id') == $usuario->id): ?>
                <?php if($total != 0): ?>
                    <?php echo anchor('#',
                                      img(array('src'=>get_avatar($usuario->id), 
                                                'class'=>'foto-medidas',
                                                'id'=>'avatar-photo-block')), 
                                      array('class'=>'middle-menu-link', 'id'=>'avatar-photo-block', 'onclick'=>"dhtmlHistory.add('".base_url()."index.php/imagenes/cambiar_avatar',null);Enviar('".base_url()."index.php/imagenes/cambiar_avatar','#texto-menu');return false;")); ?>
                <?php else: ?>
                    <?php if($usuario->sexo == '1'): ?>
                        <?php echo anchor('#',
                                      img(array('src'=>'statics/img/default/avatar.jpg', 
                                                'class'=>'foto-medidas',
                                                'id'=>'avatar-photo-block')), 
                                      array('class'=>'middle-menu-link', 'id'=>'avatar-photo-block', 'onclick'=>"dhtmlHistory.add('".base_url()."index.php/imagenes/cambiar_avatar',null);Enviar('".base_url()."index.php/imagenes/cambiar_avatar','#texto-menu');return false;")); ?>
                    <?php elseif($usuario->sexo == '0'): ?>
                        <?php echo anchor('#',
                                      img(array('src'=>'statics/img/default/nopic-fem.jpg', 
                                                'class'=>'foto-medidas',
                                                'id'=>'avatar-photo-block')), 
                                      array('class'=>'middle-menu-link', 'id'=>'avatar-photo-block', 'onclick'=>"dhtmlHistory.add('".base_url()."index.php/imagenes/cambiar_avatar',null);Enviar('".base_url()."index.php/imagenes/cambiar_avatar','#texto-menu');return false;")); ?>
                    <?php else: ?>
                        <?php echo anchor('#',
                                      img(array('src'=>get_avatar($usuario->id), 
                                                'class'=>'foto-medidas',
                                                'id'=>'avatar-photo-block')), 
                                      array('class'=>'middle-menu-link', 'id'=>'avatar-photo-block', 'onclick'=>"dhtmlHistory.add('".base_url()."index.php/imagenes/cambiar_avatar',null);Enviar('".base_url()."index.php/imagenes/cambiar_avatar','#texto-menu');return false;")); ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php $total = exists_avatar($usuario->id); ?>
                <?php if($total != '0'): ?>
                    <?php echo img(array('src'=>get_avatar($usuario->id),
                                         'class'=>'foto-medidas')); ?>
                <?php else: ?>
                    <?php if($usuario->sexo == '1'): ?>
                        <?php echo img(array('src'=>'statics/img/default/avatar.jpg',
                                             'class'=>'foto-medidas')); ?>
                    <?php elseif($usuario->sexo == '0'): ?>
                        <?php echo img(array('src'=>'statics/img/default/nopic-fem.jpg',
                                             'class'=>'foto-medidas')); ?>
                    <?php else: ?>
                        <?php echo img(array('src'=>'statics/img/default/avatar.jpg',
                                             'class'=>'foto-medidas')); ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
       </div>
       <!-- DIV DE LA PARTE DEBAJO DE LA FOTO **INICIO** -->
        <?php $type_of_user = get_type_of_user($this->session->userdata('id')); ?>  
        <?php if($type_of_user->statusEU == 0): ?>
            <?php if($this->session->userdata('id') != $usuario->id): ?>
                <div class="span-4 last" style="margin-top: 24px; border-bottom: 1px solid #DBDBDB; height: 24px; width: 160px">
                    <div style="margin-left: 9px; margin-top: 3px">
                        <?php echo anchor('planesusuarios/ver/'.$usuario->id,
                                          'Inicio',
                                          array('id'=>'ver-datos-amigo', 'class'=>'menu-usuarios1', 'style'=>'text-decoration: none; color: #83547F','onclick'=>"dhtmlHistory.add('".base_url()."index.php/planesusuarios/ver/".$usuario->id."',null);Enviar('".base_url()."index.php/planesusuarios/ver/".$usuario->id."','#texto-menu');return false;")); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->session->userdata('id') == $usuario->id): ?>
                <?php $val = 'margin-top: 24px; border-bottom: 1px solid #DBDBDB; height: 24px; width: 160px'; ?>
            <?php else: ?>
                <?php $val = 'margin-top: 0px; border-bottom: 1px solid #DBDBDB; height: 24px; width: 160px'; ?>
            <?php endif; ?>

            <!--div class="span-4 last" style="height: 24px; border-bottom: 1px solid #DBDBDB; width: 160px;">
                <div style="margin-top: 3px; margin-left: 9px">
                    <?php echo anchor('usuarios/datos_personales/'.$usuario->id,
                        'Informacion', 
    					array('class'=>'menu-usuarios1','style'=>'text-decoration: none; color: #83547F;','onclick'=>"dhtmlHistory.add('".base_url()."index.php/usuarios/datos_personales/".$usuario->id."',null),''")); ?>
                </div>
            </div-->

            <!--div class="span-4 last" style="height: 24px; border-bottom: 1px solid #DBDBDB; width: 160px">
                <div style="margin-left: 9px; margin-top: 3px">
                    <?php echo anchor('albums/ver_albums/'.$usuario->id,
                                      'Fotos',
                                      array('class'=>'menu-usuarios1', 'style'=>'text-decoration: none; color: #83547f;','onclick'=>"dhtmlHistory.add('".base_url()."index.php/albums/ver_albums/".$usuario->id."',null),''")); ?>
                </div>
            </div-->
            <!--div class="span-4 last" style="height: 24px; width: 160px">
                <div style="margin-left: 9px; margin-top: 3px">
                    <?php echo anchor('amigos/index/'.$usuario->id,
                                      'Amigos', 
                                      array('style'=>'text-decoration: none; color: #83547F;', 'class'=>'menu-usuarios1','onclick'=>"dhtmlHistory.add('".base_url()."index.php/amigos/index/".$usuario->id."',null),''")); ?>
                    <span class="ver-todos-link right">
                        <?php echo anchor('amigos/index/'.$usuario->id,
                                          'Ver todos', array('class'=>'links1', 'style'=>'text-decoration: none; margin-right: 5px; font-size: 10px; color: #8D6E98','onclick'=>"dhtmlHistory.add('".base_url()."index.php/amigos/index/".$usuario->id."',null),''")); ?>
                    </span>
                </div>
            </div-->
            <!--div id="amigos-update-new">
                <div class="span-4 last" style="width: 160px; border-bottom: 1px solid #DBDBDB; margin-top: 5px">
                    <div class="span-4 last" style="margin-left: 15px">
                        <?php $friends = get_friends_recently($usuario->id); ?>
                        <?php foreach($friends as $friend): ?>
                            <div class="span-1" style="margin-right: 10px">
                                <?php $tipos = exists_avatar($friend->amigoAmigoId); ?>
                                <?php if($tipos != 0): ?>
                                    <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                      img(array('src'=>get_thumb_avatar($friend->amigoAmigoId),
                                                                'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                <?php else: ?>
                                    <?php $datos = get_sex_of_user($friend->amigoAmigoId); ?>
                                    <?php if($datos->sexo == 0): ?>
                                        <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                          img(array('src'=>'statics/img/default/nopic-fem.jpg',
                                                                    'width'=>'45px',
                                                                    'height'=>'55px',
                                                                    'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                    <?php elseif($datos->sexo == 1): ?>
                                        <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                          img(array('src'=>'statics/img/default/avatar.jpg',
                                                                    'width'=>'45px',
                                                                    'height'=>'55px',
                                                                    'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                    <?php else: ?>
                                        <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                          img(array('src'=>'statics/img/default/avatar.jpg',
                                                                    'width'=>'45px',
                                                                    'height'=>'55px',
                                                                    'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div-->
            <!--div class="span-4 last" style="width: 160px; margin-top: 5px"> 
                <div id="update-links-company">
                    <div style="margin-left: 9px; margin-top: 3px">
                        <?php echo anchor('seguidores/mostrar_negocios/'.$usuario->ciudad,
                                          'Negocios',
                                          array('class'=>'menu-usuarios1', 'id'=>'negocios_perfil_usuarios', 'style'=>'text-decoration: none; color: #83547F;','onclick'=>"dhtmlHistory.add('".base_url()."index.php/seguidores/mostrar_negocios/".$usuario->ciudad."',null),''")); ?>
                        <span class="ver-todos-link right" id="ver_todos_negocios_perfil_usuarios">
                            <?php echo anchor('seguidores/mostrar_negocios/'.$usuario->ciudad,
                                              'Ver todos', array('class'=>'links1', 'id'=>'negocios_perfil_usuarios', 'style'=>'text-decoration: none; margin-right: 5px; font-size: 10px; color: #8D6E98','onclick'=>"dhtmlHistory.add('".base_url()."index.php/seguidores/mostrar_negocios/".$usuario->ciudad."',null),''"));?>
                        </span>
                    </div>
                </div>
            </div>
            <div id="negocios_siguiendo">
                <div class="span-4 last" style="width: 160px; border-bottom: 1px solid #DBDBDB; margin-top: 5px">
                    <div class="span-4 last" style="margin-left: 15px">
                        <?php $business = get_bussines_eight($usuario->id); ?>
                        <?php foreach($business as $negociosDatos): ?>
                            <div class="span-1" style="margin-right: 10px">
                                <?php echo anchor('negocios/perfil/'.$negociosDatos->seguidorNegocioId,
                                                  img(array('src'=>get_avatar_negocios($negociosDatos->seguidorNegocioId),
                                                            'width'=>'37px',
                                                            'height'=>'37px'))); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div-->
            <?php /* COMENTARIO DE DAR DE ALTA */
                if($this->session->userdata('id') == $usuario->id): ?>
                <div class="span-4 last" style="width: 160px; background-color: #999999; margin-top: 11px">
                    <?php echo anchor('#',
                                      'Dar de alta un negocio',
                                      array('style'=>'color: #FFFFFF; text-decoration: none; margin-left: 4px', 'class'=>'menu-usuarios', 'onclick'=>"dhtmlHistory.add('".base_url()."index.php/usuarios/dar_alta/".$usuario->id."',null);Enviar('".base_url()."index.php/usuarios/dar_alta/".$usuario->id."','#texto-menu');return false;")); ?>
                    <?php echo anchor('',
                                      '?',
                                      array('style'=>'color: #FFFFFF; text-decoration: none; margin-left: 14px', 'onclick'=>"dhtmlHistory.add('".base_url()."index.php/usuarios/dar_alta/".$usuario->id."',null);Enviar('".base_url()."index.php/usuarios/dar_alta/".$usuario->id."','#texto-menu');return false;")); ?>
                </div>
            <?php endif; ?>
            <!-- DIV DE LA PARTE DEBAJO DE LA FOTO ** FIN ** --> 
    <?php else: ?>
        <div class="span-4 last" style="height: 24px; border-bottom: 1px solid #DBDBDB; width: 160px;">
                <div style="margin-top: 3px; margin-left: 9px">
                    <?php echo anchor('usuarios/datos_personales/'.$usuario->id,
                        'Informacion', 
    					array('class'=>'menu-usuarios1','style'=>'text-decoration: none; color: #83547F;','onclick'=>"dhtmlHistory.add('".base_url()."index.php/usuarios/datos_personales/".$usuario->id."',null),''")); ?>
                </div>
        </div>
        <div class="span-4 last" style="height: 24px; width: 160px">
            <div style="margin-left: 9px; margin-top: 3px">
                <?php echo anchor('amigos/index/'.$usuario->id,
                                  'Amigos', 
                                  array('style'=>'text-decoration: none; color: #83547F;', 'class'=>'menu-usuarios1','onclick'=>"dhtmlHistory.add('".base_url()."index.php/amigos/index/".$usuario->id."',null),''")); ?>
                <span class="ver-todos-link right">
                    <?php echo anchor('amigos/index/'.$usuario->id,
                                      'Ver todos', array('class'=>'links1', 'style'=>'text-decoration: none; margin-right: 5px; font-size: 10px; color: #8D6E98','onclick'=>"dhtmlHistory.add('".base_url()."index.php/amigos/index/".$usuario->id."',null),''")); ?>
                </span>
            </div>
        </div>
        <div id="amigos-update-new">
            <div class="span-4 last" style="width: 160px; border-bottom: 1px solid #DBDBDB; margin-top: 5px">
                <div class="span-4 last" style="margin-left: -9px">
                    <?php $friends = get_friends_recently($usuario->id); ?>
                    <?php $contador = 1; ?>
                    <?php foreach($friends as $friend): ?>
                        <div class="span-4" style="margin-right: 10px">
                            <div class="span-4">
                                <div class="span-1">
                                    <?php $tipos = exists_avatar($friend->amigoAmigoId); ?>
                                    <?php if($tipos != 0): ?>
                                        <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                            img(array('src'=>get_avatar($friend->amigoAmigoId),
                                                                      'height'=>'37px',
                                                                      'width'=>'37px',
                                                                      'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                    <?php else: ?>
                                        <?php $datos = get_sex_of_user($friend->amigoAmigoId); ?>
                                        <?php if($datos->sexo == 0): ?>
                                            <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                                img(array('src'=>'statics/img/default/nopic-fem.jpg',
                                                                          'width'=>'37px',
                                                                          'height'=>'37px',
                                                                          'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                        <?php elseif($datos->sexo == 1): ?>
                                            <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                                img(array('src'=>'statics/img/default/avatar.jpg',
                                                                          'width'=>'37px',
                                                                          'height'=>'37px',
                                                                          'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                        <?php else: ?>
                                            <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                                img(array('src'=>'statics/img/default/avatar.jpg',
                                                                          'width'=>'37px',
                                                                          'height'=>'37px',
                                                                          'title'=>get_complete_username($friend->amigoAmigoId)))); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="span-2" style="margin-left: 20px; margin-top: 10px; color: #93547F">
                                    <?php
                                        $nombre = get_user_name($friend->amigoAmigoId);
                                        $cortes_nombre = cut_name_user($nombre);
                                        $apellido = get_last_user_name($friend->amigoAmigoId);
                                        $cortes_apellidos = cut_name_user($apellido);
                                        $nombre_mostrar = $cortes_nombre . ' ' . $cortes_apellidos;
                                    ?>
                                    <?php echo anchor('usuarios/perfil/'.$friend->amigoAmigoId,
                                                      $nombre_mostrar,
                                                      
                                                      array('style'=>'text-decoration: none; color: #83547F')); ?>
                                </div>
                            <div>
                        </div>
                        <?php $contador++; ?>
                        <?php if($contador >= 4): ?>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="span-4 last" style="width: 160px; margin-top: 5px">
            <div style="margin-left: 9px; margin-top: 3px">
                <?php echo anchor('seguidores/siguiendo/'.$usuario->id,
                                  'Negocios',
                                  array('class'=>'menu-usuarios1', 'style'=>'text-decoration: none; color: #83547F;','onclick'=>"dhtmlHistory.add('".base_url()."index.php/seguidores/siguiendo/".$usuario->id."',null),''")); ?>
            </div>
        </div>
        <div id="negocios_siguiendo">
            <div class="span-4 last" style="width: 160px; border-bottom: 1px solid #DBDBDB; margin-top: 5px">
                <div class="span-4 last" style="margin-left: -9px">
                    <?php $business = get_bussines_eight($usuario->id); ?>
                    <?php foreach($business as $negociosDatos): ?>
                        <div class="span-1" style="margin-right: 10px">
                            <?php echo anchor('negocios/perfil/'.$negociosDatos->seguidorNegocioId,
                                                img(array('src'=>get_avatar_negocios($negociosDatos->seguidorNegocioId),
                                                          'width'=>'37px',
                                                          'height'=>'37px'))); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div><!-- DIV COLUMNA DERECHA **FIN** -->
    <div class="span-20 last" style="background-color: #EEEDF4; width: 780px"><!-- PRIMER DIV DE FONDO  #F0F0F0-->
        <div class="span-20 last" style="background-color: #EEEDF4; width: 800px"><!-- SEGUNDO DIV DE FONDO #F0F0F0-->
            <div class="span-19" style="background-color: #EEEDF4">
                <div class="span-20" style="border-left: 1px solid #DBDBDB; border-bottom: 1px solid #DBDBDB; margin-left: 20px; width: 780px; background-color: #EEEDF4">
                    <div class="span-14" style="margin-left: 6px; line-height: 15px; margin-top: 2px;"><!--CONTENEDOR DEL CENTRO -->
                        <div class="span-14" style="margin-top: 8px"><!-- DIV NOMBRE -->
                            <span id="nombre-profile" class="titulo-menu">
                    
                            </span>
                        </div><!-- DIV NOMBRE -->
                        <div class="span-19" style="margin-bottom: 3px"><!-- DIV LINEA SECUNDARIA -->
                            <span id="edad-profile" style="margin-right: 3px" class="informacion-menu">
                                
                            </span>
                            <span class="informacion-menu" id="personal-profile" style="margin-right: 3px">

                            </span>
                            <span class="informacion-menu" id="localidad-profile">
                                
                            </span>
                        </div><!-- DIV LINEA SECUNDARIA -->
                    </div><!-- CONTENEDOR DEL CENTRO -->
                    <div class="span-5 last" id="main-div">
                        <div class="span-6" style="margin-top: 22px" id="menus-botones">
                      
                        </div>
                    </div>
                </div>
            </div><!-- DIV COUMNA CENTRO DATOS PERSONALES ** FIN ** -->
            <div class="span-14" id="centro" style="margin-left: 20px; background-color: #EEEDF4"><!-- COLUMNA CENTRAL DE PULZOS -CARGA DINAMICA- **INICIO** -->
                <?php if(($this->session->userdata('id') == $usuario->id) || ($amistad == 3)): ?>
                    <?php if($this->session->userdata('id') == $usuario->id): ?>
                        <?php echo anchor('planesusuarios/calendario_usuarios', '',
                                         array('class'=>'menu-usuarios', 'id'=>'menu-main', 'style'=>'display: none')); ?>
                    <?php else: ?>
                    
                        <?php echo anchor('planesusuarios/ver/'.$usuario->id, '', 
                                          array('class'=>'menu-usuarios', 'id'=>'menu-main', 'style'=>'display:none')); ?>
                    <?php endif; ?>
                    <div class="span-14" style="height: 1px">&nbsp;</div>
                    <div id="texto-formulario" style="background-color: #EEEDF4">
                    </div>
                    <div id="texto-menu" style="background-color: #EEEDF4">
                    </div>
                <?php else: ?>
                    <div class="span-14" style="height: 1px">&nbsp;</div>
                    <div id="noAmigos" style="margin-top: -10px"></div>
                    <?php echo anchor('usuarios/datos_personales/'.$usuario->id, '', array('style'=>'display: none', 'id'=>'no-amigos')); ?>
                <?php endif; ?>
            </div><!-- COLUMNA CENTRAL DE PULZOS - CARGA DINAMICA - ** FIN ** -->
            <!-- DIV DE LA BARRA DERECHA **INICIO** -->
            <div id="nav" class="span-5 last" style="margin-left: -16px; margin-top: 12px; background-color: #F0F0F0;">
                <!-- DIV CONTENEDOR **INICIO** -->
                	<?php if( isset($usuariosU->statusEU) ): ?>
                    	<?php if( $usuariosU->statusEU=1 ): ?>
                    	<div class="span-5 last" id="nav" style="margin-left: 0px; margin-top: 12px; background-color: #F0F0F0">
                <!-- DIV CONTENEDOR **INICIO** -->
                <div class="redondeo-menu span-6 last" style="border: 1px solid #CBCBCB; width: 228px; background-color: #F0F0F0">
                    <div class="redondeo-titulo span-6 last" style="height: 20px; background-color: #A71E9F; width: 228px; border-bottom: 1px solid #CBCBCB">
                        <span style="color: #FFFFFF; margin-left: 6px">
                            Personas que tienen planes
                        </span>
                    </div>
                    <div class="span-6 last" style="height: 32px; width: 228px; background-color: #A71E9F; background-color: #FFFFFF; border-bottom: 1px solid #CBCBCB">
                        <div class="span-1" style="color: white;background-color: #A71E9F;width: 20px;height: 20px;margin-top: 6px; margin-bottom: 4px; margin-left: 6px;margin-right:17px">
                            &nbsp;
                            
                            <?php  echo count(get_invitedToday($usuario->id)); ?>
                        </div>
                        <div class="span-4 last" style="margin-top: 8px" >
                            <?php echo anchor('usuarios/','Hoy',array('id'=>'hoy','style'=>'text-decoration: none; color: #7F7D7D','onclick'=>"EnviarN('".base_url()."index.php/negocios/pulzos_hoy/','#texto-menu');")); ?>
                        </div>
                    </div>
                    <div class="redondeo-div-inferior span-6 last" style="height: 32px; width: 228px; background-color: #FFFFFF">
                       <div class="span-1" style="color: white;background-color: #A71E9F;width: 20px;height: 20px;margin-top: 6px; margin-bottom: 4px; margin-left: 6px;margin-right:17px">
                            <?php $c=0; foreach(get_invitedWeek($usuario->id) as $matcH):$roW=get_invitedWeeCont($matcH->planFechaInicio);$c=$c+count($roW);endforeach;echo '<span style="margin-left:4px">'.$c; ?>
                       </div>
                        <div class="span-4 last" style="margin-top: 8px; magin-bottom: 5px">
                            <?php echo anchor('#',
                                              'Esta semana',
                                              array('style'=>'text-decoration: none; color: #7F7D7D','onclick'=>"EnviarN('".base_url()."index.php/negocios/pulzos_semana/','#texto-menu');")); ?>
                        </div>
                    </div>
                </div>
                <!-- DIV CONTENEDOR **FIN** -->
                <!-- DIV CONTENEDOR-2 **INICIO** -->
                <div class="redondeo-menu span-6 last" style="margin-top: 23px; width: 228px; border: 1px solid #CBCBCB">
                    <div class="redondeo-titulo span-6 last" style="height: 20px; background-color: #A71E9F; width: 228px; border-bottom: 1px solod #CBCBCB">
                        <span style="color: #FFFFFF; margin-left: 6px">
                           Testimonios
                        </span>
                    </div>
                    <?php  $testimonios=get_emperiencias($this->session->userdata('idN'), $this->session->userdata('id')); ?>
                    <div class="redondeo-div-inferior span-6 last" style="width: 228px; background-color: #FFFFFF; border-bottom: 1px solid #CBCBCB">
                          <?php if(empty($testimonios)){ echo "<span class='menu-derecha' style='margin-left: 8px'> Se el primero en comentar</span>";}else{ ?>
                        <div class="span-1" style="margin-top: 4px; margin-bottom: 4px; margin-left: 4px">
                            <?php echo 
                                             img(array('src'=>get_avatar($testimonios->comentarioUsuarioId),
                                                        'width'=>'30',
                                                        'height'=>'30')); ?>
                        </div>
                        <div class="span-4 last" style="margin-top: 8px">
                            <span class="menu-derecha">
                                <?php echo $testimonios->comentarioTexto; ?>
                            </span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- DIV CONTENEDOR-2 **FIN** -->
                <!-- DIV CONTENEDOR-3 **INICIO** -->
                <div class="redondeo-menu span-6 last" style="margin-top: 23px; width: 228px; border: 1px solid #CBCBCB">
                    <div class="redondeo-titulo span-6 last" style="height: 20px; background-color: #A71E9F; width: 228px; border-bottom: 1px solod #CBCBCB">
                        <span style="color: #FFFFFF; margin-left: 6px">
                            Pulzos
                        </span>
                    </div>
                    <div class="span-6 last" style="height: 32px; width: 228px; background-color: #A71E9F; background-color: #FFFFFF; border-bottom: 1px solid #CBCBCB">
                        <div class="span-1" style="margin-top: 4px; margin-bottom: 4px; margin-left: 4px">
                            <?php echo img(array('src'=>'statics/img/icon-pulzo-amigos.jpg',
                                                 'width'=>'24px',
                                                 'height'=>'24px')); ?>
                        </div>
                        <div class="span-4 last" style="margin-top: 8px"><span class="span-4 last" style="margin-top: 0px"><?php echo anchor('usuarios/',
                                              'Pulzos',
                                              array('style'=>'text-decoration: none; color: #7F7D7D','onclick'=>"EnviarN('".base_url()."index.php/pulzos/ver/','#texto-menu');")); ?></span></div>
                    </div>
                <div class="span-6 last" style="height: 32px; width: 228px; background-color: #A71E9F; background-color: #FFFFFF; border-bottom: 1px solid #CBCBCB">
                        <div class="span-1" style="margin-top: 4px; margin-bottom: 4px; margin-left: 4px">
                            <?php echo img(array('src'=>'statics/img/icon-pulzo-ciudad.jpg',
                                                 'width'=>'24px',
                                                 'height'=>'24px')); ?>
                        </div>
                        <div class="span-4 last" style="margin-top: 8px"><span class="span-4 last" style="margin-top: 0px"><?php echo anchor('usuarios/',
                                              'Retos',
                                              array('style'=>'text-decoration: none; color: #7F7D7D','onclick'=>"EnviarN('".base_url()."index.php/retosnegocios/ver/','#texto-menu');")); ?></span></div>
                  </div>
                    <div class="redondeo-div-inferior span-6 last" style="width: 228px; background-color: #FFFFFF; border-bottom: 1px solid #CBCBCB">
                        <div class="span-1" style="margin-top: 4px; margin-bottom: 4px; margin-left: 4px">
                            <?php echo img(array('src'=>'statics/img/icon-pulzo-empresas.jpg',
                                            'width'=>'24px',
                                            'height'=>'24px')); ?>
                        </div>
                        <div class="span-4 last" style="margin-top: 8px">
                            <span class="menu-derecha">
                                <?php echo anchor('usuarios/',
                                                  'Experiencias de Vida',
                                                  array('style'=>'text-decoration: none; color: #7F7D7D','onclick'=>"EnviarN('".base_url()."index.php/experienciasnegocios/ver/','#texto-menu');")); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- DIV CONTENEDOR-3 **FIN** -->
            </div>
                     <?php endif; ?>
                    <?php else: ?>

                </div><!-- DIV CONTENEDOR 2 **FIN** -->
                    <?php endif; ?>
                    
            </div>
        </div><!-- SEGUNDO DIV DE FONDO -->
    </div><!-- PRIMER DIV DE FONDO -->
    <!-- DIV DE LA BARRA DERECHA **FIN** -->
    <div id="maping-overlay" class="kewl-overlay-style">
        <div id="show-map"></div>
    </div>
</div>

    <!-- aqui /div -->
    <!-- DIV DEL CENTRO DEL PERFIL DE USUARIO -->


