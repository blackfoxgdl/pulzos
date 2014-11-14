<?php
 /**
  * View bussines's profile when login
  * to the plataform with the e-mail
  * and password, If is correct the first
  * view will be profile
  *
  * @version 0.1 
  * @copyright ZavorDigital, 21 February, 2011
  * @package Usuarios
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  **/
$result = get_images_company($negocios->negocioUsuarioId);
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery_tools/jquery.tools.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/form/form.js'; ?>"></script>
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

function load(num) {
	
            $('#texto-menu').load(num);
        }

        $.history.init(function(url) {
                load(url == "" ? "<?php echo base_url()?>index.php/negocios/principal/<?php echo $negocios->negocioId;?>" : url);
            });

        $("a[rel='history']").click(function(){
        $.history.load(this.href.replace(/^.*#/, ''));
        return false;
        });
        
function update() {
    urlFollowersCompany = $("#urlFollower").attr("href");
    $.ajax({
        type: 'GET',
        url: urlFollowersCompany,
        timeout: 5000,
        success: function(data) {
            if(data.length > 273)
            {
                $("#followers_company").html(data);
                window.setTimeout(update, 100000);
            }
            else
            {
                window.setTimeout(update, 500000);
            }
        }
    });
}

$(document).ready(function(){
				<?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
				
							if((<?php echo $negocios->negocioPrimerIngreso; ?> == 1)&&(<?php echo $negociosN->statusEU;?>== 1) ){
								urlMain1= '<?php echo base_url()?>index.php/negocios/editar/<?php echo $negocios->negocioId; ?>';
								<?php 
								$this->Negocio->update_data(array('negocioPrimerIngreso'=>'0'), $this->session->userdata('id'),$this->session->userdata('idN') );
								?>
							}else{
							
								urlMain1= '<?php echo base_url()?>index.php/negocios/principal/<?php echo $negocios->negocioUsuarioId.'/'.$negocios->negocioId; ?>';	
							}
					 	if(!sessvars.pagina2){ 
				
							$("#texto-menu").load(urlMain1);
						}else{ 
							paginan=sessvars.pagina2;
							capan=sessvars.capa2;
					//		$("#texto-menu").load(paginan+<?php echo $negocios->negocioId;?>);
                        }
                        $('#texto-menu').load(urlMain1);
                <?php else: ?>
					if((<?php echo $negocios->negocioPrimerIngreso; ?> == 1)&&(<?php echo $negociosN->statusEU;?>== 1)){
						urlMain1= '<?php echo base_url()?>index.php//negocios/editar/<?php echo $negocios->negocioId; ?>';
						<?php 
						$this->Negocio->update_data(array('negocioPrimerIngreso'=>'0'), $this->session->userdata('id'),$this->session->userdata('idN') );
						?>
                    }else{ 
                         urlMain1= '<?php echo base_url()?>index.php/negocios/miperfil/<?php echo $negocios->negocioId; ?>';
                         //alert('holas:' + urlMain1);
				  	}
                    	$('#texto-menu').load(urlMain1);
               <?php endif; ?>
				
update();

$(".mensaje-empresa").click(function(event){
    event.preventDefault();
    var mensajeempresa = $(event.currentTarget).attr('href');
    $("#texto-menu").load(mensajeempresa);
});

function update1()
{
    urlReload = $("#urlFollower").attr("href");
    $.ajax({
        type: "GET",
        url: urlReload,
        success: function(html){
            $("#followers_company").html(html);
        }
    });
}

$("#seguir").click(function(event){
    event.preventDefault();
    var urlSeguir = $(event.currentTarget).attr('href');
    $.ajax({
        type: "GET",
        url: urlSeguir,
        complete: function(html){
            $("#followers_company").html(html);
            update();
        }
    });
    $(event.currentTarget).hide();
    $("#armar-pulzo").show();
    update1();
});


function cargarNuevo()
{
}

$(".link-comentario").click(function(event){
    event.preventDefault();
	 $("#botonPulzar").show();
    $("#cargainicio").hide();
	
   
});

$("#avatar-photo-block, .notification-block").hover(function(event){
    $(".notification-block").css('display', 'block');
    $(".notification-block").css('position', 'absolute');
}, function(event){
    $(".notification-block").css('display', 'none');
});

$("#bannerPrincipal, .banner-block").hover(function(event){
    $(".banner-block").css('display', 'block');
    $(".banner-block").css('position', 'absolute');
}, function(event){
    $(".banner-block").css('display', 'none');
});


$("#pulzosForm").submit(function(event){
    event.preventDefault();
    var opciones = {
        success: loadView
    }
    $(this).ajaxSubmit(opciones);
    return false;
});

function loadView(){
    $("#tituloPulzos").val("");
    $("#comment").val("");
    $("#hora").val("");
    $("#fecha").val("");
    $("#imagenPulzo").val("");

    var url = $("#return").attr("href");
    $("#pulzos_hecho").load(url);
}


urlPulzos = $("#return").attr("href");
$("#pulzos_hecho").load(urlPulzos);


$("#avatar-photo-block, .notification-block").hover(function(event){
    $(".notification-block").css('display', 'block');
    $(".notification-block").css('position', 'absolute');
}, function(event){
    $(".notification-block").css('display', 'none');
});

$("#bannerPrincipal, .banner-block").hover(function(event){
    $(".banner-block").css('display', 'block');
    $(".banner-block").css('position', 'absolute');
}, function(event){
    $(".banner-block").css('display', 'none');
});

$(".middle-menu-link").click(function(event){
    event.preventDefault();
    var urlLoad = $(event.currentTarget).attr("href");
    $("#texto-menu").load(urlLoad);
	
});

$("#negocioNombreId").click(function(event){
    event.preventDefault();
    urlNombre = $(this).attr("href");
    $("#texto-menu").load(urlNombre);
});

$(".bannersNegocios").click(function(event){
    event.preventDefault();
    var urlB = $(this).attr("href");
    $("#texto-menu").load(urlB);
});

});

//aqui inicia

function Enviar(pagina,capa) {
			$(capa).load(pagina);
				sessvars.pagina2=pagina;
				sessvars.capa2=capa;
 }

// sicript para que el usuario navegue utilizando los enlaces internos de la p�gina ajax.

window.dhtmlHistory.create({

	toJSON: function(o){
		return JSON.stringify(o);
	}
	, fromJSON: function(s){
		return JSON.parse(s);
	}
});

var yourListener = function(newLocation, historyData){
//cargar mis_planes cuando la variable newLocation no tenga historial.
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	if(($.browser.safari) && (is_chrome==false)){
				if((newLocation==NULL )){
						<?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
                     urlMain=<?php echo 'negocios/principal/'.$negocios->negocioUsuarioId.'/'.$negocios->negocioId; ?>
                    
                <?php else: ?>
                    urlMain=<?php echo 'negocios/miperfil/'.$negocios->negocioId; ?>
                    
                <?php endif; ?>
				$('#texto-menu').load(urlMain);
			}else{
			Enviar(newLocation,'#texto-menu'); 	
			}
	
	}else{
		if((!newLocation )){
						<?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
                     urlMain=<?php echo 'negocios/principal/'.$negocios->negocioUsuarioId.'/'.$negocios->negocioId; ?>
                    
                <?php else: ?>
                    urlMain=<?php echo 'negocios/miperfil/'.$negocios->negocioId; ?>
                    
                <?php endif; ?>
				$('#texto-menu').load(urlMain);
			}else{
			Enviar(newLocation,'#texto-menu'); 	
			}
	}		

}
window.onload = function(){

	dhtmlHistory.initialize();
	dhtmlHistory.addListener(yourListener);

};
//aqui termina


function quitarTexto(val)
{
    if(document.getElementById('main-comment').value == 'Que quieres comunicar?')
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

$("a#unos").click(function(event){http://localhost/pulzos/index.php/alianzassociales/index_social/7
    $(".seguir").hide();
});

</script>
<?php echo anchor('negocios/reload_follows/'.$negocios->negocioId, '', array('style'=>'display: none', 'id'=>'urlFollower')); ?>
<?php echo img(array('src'=>get_avatar($this->session->userdata('id')),
                     'id'=>'img-follow',
                     'style'=>'display: none')); ?>
<div class="span-24"><!-- PRINCIPAL ** INICIO ** -->
    <div style="display: none">
        <?php echo img(array('id'=>'imagen',
                             'src'=>'statics/img/pin.png')); ?>
        <span class="latitud"><?php echo $negocios->negocioLatitud; ?></span>
        <span class="longitud"><?php echo $negocios->negocioLongitud; ?></span>
        <span class="negocioNombre"><?php echo $negocios->negocioNombre; ?></span>
        <span class="negocioDireccion"><?php echo $negocios->negocioDireccion; ?></span>
    </div>
    <div class="span-4 left-column" style="margin-top: 8px;"><!-- DIV IZQUIERDA ** INICIO ** -->
        <div class="avatar span-4 last"><!-- DIV DEL PERFIL -->
            <?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
                <div class="notification-block">
                    <?php echo anchor('#', 'Change Avatar', array('class'=>'middle-menu-link'))?>
                </div>
                <?php echo anchor('imagennegocios/cambiar_avatar_negocio/',
                                img(array('src'=>get_avatar_negocios($negocios->negocioId), 
                                          'class'=>'foto-medidas', 
                                          'id'=>'avatar-photo-block')), 
                                    array('class'=>'middle-menu-link' )); 
                ?>
            <?php else: ?>
                <?php echo img(array('src'=>get_avatar_negocios($negocios->negocioId),
                                      'class'=>'foto-medidas',
                                      'id'=>'avatar-photo-block')); 
            ?>
            <?php endif; ?>
        </div><!-- ESTE DIV ES DEL PERFIL -->
        <!-- DIV DE LA PARTE DEBAJO DE LA FOTO **INICIO** -->
        <div class="span-4 last"><!-- style="height: 24px; border-bottom: 1px solid #DBDBDB; width: 160px;" --> 
            <div style="margin-top: 3px; margin-left: 9px; color: #83547F">
                
            </div>
            
                
                    
                    <div style="margin-top: 6px; margin-left: 9px; color: #83547F">
                       
                    </div>
        </div>
        <?php if($negocios->negocioId == $this->session->userdata('idN')): ?>
            <div class="span-4 last" style="height: 24px; border-bottom: 1px solid #DBDBDB; width: 160px">
                <div style="margin-top: 3px; margin-left: 9px">
                    <?php echo anchor('money/index/negocio',
                                      'Bonification',
                                      array('style'=>'text-decoration: none; color: #83547F', 'class'=>'menu-negocios', 'id'=>'miperfil-menu','onclick'=>"dhtmlHistory.add('".base_url()."index.php/money/index/".$negocios->negocioId."/negocio',null);Enviar('".base_url()."index.php/money/index/".$negocios->negocioId."/negocio','#texto-menu');return false;")); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if($negocios->negocioId == $this->session->userdata('idN')): ?>
            <div class="span-4 last" style="height: 24px; border-bottom: 1px solid #DBDBDB; width: 160px"> 
                <div style="margin-top: 3px; margin-left: 9px;">
                    <?php echo anchor('',
                                      'Offer',
                                      array('style'=>'text-decoration: none; color: #83547F', 'class'=>'menu-negocios', 'id'=>'ofertas-activas', 'onclick'=>"dhtmlHistory.add('".base_url()."index.php/redessociales/ofertas/".$negocios->negocioId."',null);Enviar('".base_url()."index.php/redessociales/ofertas/".$negocios->negocioId."','#texto-menu');return false;")); ?>
                </div> 
            </div>
        <?php endif; ?>
        <div class="span-4 last" style="height: 24px; border-bottom: 1px solid #DBDBDB; width: 160px">
            <div style="margin-top: 3px; margin-left: 9px">
                <?php echo anchor('#',
                                  'Information',
                                  array('class'=>'menu-negocios', 'style'=>'text-decoration: none; color: #83547F', 'class'=>'menu-negocio', 'id'=>'info-menu','onclick'=>"dhtmlHistory.add('".base_url()."index.php/negocios/informacion_personal/".$negocios->negocioId."',null);Enviar('".base_url()."index.php/negocios/informacion_personal/".$negocios->negocioId."','#texto-menu');return false;")); ?> 
            </div>
        </div>
        <!-- DIV DE LA PARTE DEBAJO DE LA FOTO **FIN** --> 
    </div><!-- DIV IZQUIERDA ** FIN ** -->
    <!-- DIV DE LA PARTE CENTRAL DEL PERFIL DE NEGOCIOS **INICIO** -->
    <div class="span-20 last" style="background-color: #EEEDF4; width: 780px"><!-- PRIMER DIV DE FONDO -->
        <div class="span-20 last" style="background-color: #EEEDF4; width: 800px"><!-- SEGUNDO DIV DE FONDO -->
            <div class="span-19" style="background-color: #EEEDF4"><!-- COLUMNA CENTAL DATOS PERSONALES **INICIO** -->
                <div class="span-20" style="border-left: 1px solid #DBDBDB; border-bottom: 1px solid #DBDBDB; margin-left: 20px; width: 780px; background-color: #EEEDF4">
                    <div class="span-14" style="margin-left: 6px; line-height: 15px; margin-top: 2px">
                        <div class="span-14" style="margin-top: 8px">
                            <span id="nombre-profile" class="titulo-menu">
                                <?php echo $negocios->negocioNombre; ?>
                            </span>
                        </div>
                        <div class="span-19" style="margin-bottom: 3px">
                            <span id="restaurant-type" style="margin-right: 3px" class="informacion-menu">
                                <?php echo get_giro_negocio($negocios->negocioGiro); ?>
                            </span>
                        </div>
                    </div>
                    <div class="span-5 last" id="derecha" style="margin-left: -25px; margin-top: 20px;">
                        <div style="display: inline; margin-top: -500px">
                            <div id="botones-derecha">
                                <?php if($this->session->userdata('idN') != $negocios->negocioId): ?>
                                    <?php if($numeroSeguidor == 0): ?>
                                        <?php echo anchor('seguidores/seguir/'.$negocios->negocioId,
                                                          img(array('src'=>'statics/img/siguiente.png',
                                                                    'width'=>'80px',
                                                                    'heigth'=>'20px')),
                                                          array('style'=>'text-decoration: none', 'id'=>'seguir'));  ?>
                                        <?php echo anchor('#',
                                                          img(array('src'=>'statics/img/mensaje.png',
                                                                    'width'=>'80px',
                                                                    'height'=>'20px')),
                                                          array('style'=>'text-decoration: none', 'class'=>'mensaje-empresa','onclick'=>"Enviar1('".base_url()."index.php/inboxusuarios/crear/".$this->session->userdata('id').'/'.$negocios->negocioUsuarioId."','#texto-menu');")); ?>
                                    <?php else: ?>
                                        <?php echo anchor('#',
                                                          img(array('src'=>'statics/img/mensaje.png',
                                                                    'width'=>'80px',
                                                                    'height'=>'20px')),
                                                          array('style'=>'text-decoration: none', 'class'=>'mensaje-empresa','onclick'=>"Enviar1('".base_url()."index.php/inboxusuarios/crear/".$this->session->userdata('id').'/'.$negocios->negocioUsuarioId."','#texto-menu');")); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- COLUMNA CENTRAL DATOS PERSONALES **FIN** -->
            <!-- DIV CENTRAL DINAMICO **INICIO** -->
            <div class="span-14" id="texto-menu" style="margin-left: 20px">
                <?php if($this->session->userdata('id') == $negocios->negocioUsuarioId): ?>
                    <?php echo anchor('negocios/principal/'.$negocios->negocioUsuarioId.'/'.$negocios->negocioId, '', array('id'=>'centro', 'style'=>'display: none')); ?>
                    <div class="span-14 last" style="height: 1px">&nbsp;</div>
                <?php else: ?>
                    <?php echo anchor('negocios/miperfil/'.$negocios->negocioId, '', array('id'=>'centro', 'style'=>'display: ')); ?>
                    <div class="span-14 last" style="height: 1px">&nbsp;</div>
                <?php endif; ?>
            </div>
            <!-- DIV CENTRAL DINAMICO **FIN** -->
            <input type ="hidden" id="idUsuario" value="<?php echo $this->session->userdata('id')?>"/>
            <!-- DIV DE LA PARTE CENTRAL DEL PERFIL DE NEGOCIOS **FIN** -->
            <!-- DIV DE LA BARRA DERECHA **INICIO** -->
            <div class="span-5 last" id="nav" style="margin-left: -15px; margin-top: 12px; background-color: #F0F0F0">
            </div>
            <!-- DIV DE LA BARRA DERECHA **FIN** -->
        </div>
    </div>
        <div id="maping-overlay" class="kewl-overlay-style"><div id="show-map"></div></div>
</div><!-- DIV PRINCIPAL ** FIN ** -->
