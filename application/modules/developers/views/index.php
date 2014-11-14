<?php
/**
 * Vista para la realizacion de las formas que
 * se usan para visualizar la API de pulzos
 * con la cual los usuarios podran conocer la
 * forma de uso de la api
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/jquery-1.4.1.js'; ?> "></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/rsh.js'; ?> "></script>
<script type="text/javascript">
//inicio para botones de navegador
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



	

//fin botones navegador

$(document).ready(function(){
    urlDocuments = $("#mainLoad").attr('href');
    $("#textos-api").load(urlDocuments);

    $("#documentosApi").click(function(event){
        event.preventDefault();
        urlDocuments = $("#mainLoad").attr("href");
        $("#textos-api").load(urlDocuments);
    });

    $("#metodosApi").click(function(event){
        event.preventDefault();
        urlMethod = $("#methodLoad").attr('href');
        $("#textos-api").load(urlMethod);
    });

    $("#ejemplosApi").click(function(event){
        event.preventDefault();
        urlExample = $("#exampleLoad").attr('href');
        $("#textos-api").load(urlExample);
    });
	
	
	 function load(num) {
	
            $('#textos-api').load(num);
        }

        $.history.init(function(url) {
                load(url == "" ? "<?php echo base_url()?>index.php/developers/ver_documentos/" : url);
            });

        $("a[rel='history']").click(function(){
        $.history.load(this.href.replace(/^.*#/, ''));
        return false;
    });
	
		
});
</script>
<?php echo anchor('developers/ver_documentos', '', array('style'=>'display: none', 'id'=>'mainLoad')); ?>
<?php echo anchor('developers/ver_metodos', '', array('style'=>'display: none', 'id'=>'methodLoad')); ?>
<?php echo anchor('developers/ver_ejemplos', '', array('style'=>'display: none', 'id'=>'exampleLoad')); ?>
<div class="span-24" style="margin-top: 0px">
    <div class="span-4 last" style="height: 350px; width: 160px">
        <div class="span-4 last">
            <?php if($this->session->userdata('idN')): ?>
                <?php echo img(array('src'=>get_avatar_negocios($this->session->userdata('idN')),
                                     'class'=>'foto-medidas')); ?>
            <?php elseif($this->session->userdata('id')): ?>
                <?php echo img(array('src'=>get_avatar($this->session->userdata('id')),
                                     'class'=>'foto-medidas')); ?>
            <?php endif; ?>
        </div>
        <div class="span-4 last" style="border-bottom:solid 1px #660068; width: 160px;">
            <div class="span-4 last" style="margin-top: 3px; margin-bottom: 3px">
                <a href="#<?php echo base_url();?>index.php/developers/ver_documentos/" style="text-decoration: none; color: #660068; margin-left: 10px">
                    Documentos
                </a>
            </div>

        </div>
        <div class="span-4 last" style="border-bottom: solid 1px #660068; width: 160px">
            <div class="span-4 last" style="margin-top: 3px; margin-bottom: 3px">
                <a href="#<?php echo base_url();?>index.php/developers/ver_metodos/" style="text-decoration: none; color: #660068; margin-left: 10px">
                    Metodos
                </a>
            </div>

        </div>

    </div>
    <div class="span-19 last" style="background-color: #EEEDF3;">
        <div class="span-19 last" style="margin-left: 20px; border-right: solid 1px #EEEDF3; background-color: #EEEDF3;" id="textos-api">
        </div>
    </div>
</div>
<div class="span-19 last" style="margin-top: 20px">
    &nbsp;
</div>

