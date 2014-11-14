<?php
/**
 * Vista que se usara para mostrar todos los negocios dependiendo la ciudad
 * del usuario o la ciudad que tenga asignada por el momento en la
 * configuracion de la cuenta para que puedan ver solamente los negocios de
 * la ciudad donde se localiza
 **/
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery_tools/jquery.tools.min.js'; ?>"></script>
<script type="text/javascript">
   $(document).ready(function(){
        name_complete = $("#nombre-usuario-plan").text();
        age_complete = $("#edad-usuario-plan").text();
        relation_complete = $("#relacion-usuario-plan").text();
        state_complete = $("#estado-usuario-plan").text();
        $("#nombre-profile").text(name_complete);
        $("#edad-profile").text(age_complete);
        $("#personal-profile").text(relation_complete);
        $("#localidad-profile").text(state_complete);

        $(".idss").click(function(event){
            event.preventDefault();
            var ids = $(event.currentTarget).attr('rel');
            $('#overlay'+ids).fadeIn('fast',function(){
                $('#box'+ids).animate({'top':'160px'},500);
            });
        });

        $(".boxclose").click(function(event){
            event.preventDefault();
            var ids1 = $(event.currentTarget).attr('rel');
            $("#box"+ids1).animate({'top':'-300px'},500, function(){
                $('#overlay'+ids1).fadeOut('fast');
            });
        });
   });

    $(".seguir_empresa").click(function(event){
        event.preventDefault();
        var url_seguir = $(event.currentTarget).attr('href');
        var flag_seguir = $(event.currentTarget).attr('flag');
        $(event.currentTarget).hide();
        $("#no_seguir"+flag_seguir).show();
        $.get(url_seguir);
    });

    $(".no_seguir_empresa").click(function(event){
        event.preventDefault();
        var url_no_seguir = $(event.currentTarget).attr('href');
        var flag_no_seguir = $(event.currentTarget).attr('flag');
        $(event.currentTarget).hide();
        $("#seguir"+flag_no_seguir).show();
        $.get(url_no_seguir)
    });
</script>
<style>
    .box{
            position:fixed;
            top:-300px;
            left:30%;
            right:30%;
            background-color:#fff;
            color:#7F7F7F;
            padding:20px;
            border:2px solid #ccc;
            -moz-border-radius: 20px;
            -webkit-border-radius:20px;
            -khtml-border-radius:20px;
            -moz-box-shadow: 0 1px 5px #333;
            -webkit-box-shadow: 0 1px 5px #333;
            z-index:101;
        }

    .overlay{
            background:transparent url(../../statics/img/overlay.png) repeat top left;
            position:fixed;
            top:0px;
            bottom:0px;
            left:0px;
            right:0px;
            z-index:100;
        }

    a.boxclose{
            float:right;
            width:26px;
            height:26px;
            background:transparent url(../../statics/img/cancel.png) repeat top left;
            margin-top:-20px;
            margin-right:-20px;
            cursor:pointer;
        }
</style>
<div class="span-14" style="display: none">
    <div id="nombre-usuario-plan">
        Negocios
    </div>
    <div id="edad-usuario-plan"></div>
    <div id="relacion-usuario-plan"></div>
    <div id="estado-usuario-plan"></div>
    <?php echo img(array('id'=>'imagen','src'=>'statics/img/pin.png', 'style'=>'display: none')); ?>
</div>
<div class="span-14 last" style="margin-top: 10px;">
    <?php if(! empty($negocios)): ?>
        <?php $is = 1; ?>
        <?php foreach($negocios as $negocio): ?>
            <div class="span-12 last" style="border: 1px; margin-top: 10px; color: #8D6E98">
                <div class="span-2">
                    <?php $total = get_total_count_thumb($negocio->negocioUsuarioId); ?>
                    <?php $values_pic = get_thumb_avatar($negocio->negocioUsuarioId); ?>
                    <?php if($total != 0): ?>
                        <?php if(!empty($values_pic)): ?>
                            <?php echo img(array('src'=>get_thumb_avatar($negocio->negocioUsuarioId))); ?>
                        <?php else: ?>
                            <?php echo img(array('src'=>'statics/img/default/avatarempresas.jpg',
                                                 'width'=>'45px',
                                                 'height'=>'51px')); ?>
                        <?php endif; ?>
                    <?php else: ?>
                    <?php echo img(array('src'=>'statics/img/default/avatarempresas.jpg',
                                                 'width'=>'45px',
                                                 'height'=>'51px')); ?>
                    <?php endif; ?>
                </div>
                <div class="span-6" style="word-wrap: break-word;">
                    <?php echo $negocio->negocioNombre; ?>
                    <br />
                    <?php if(!empty($negocio->negocioDescripcion)): ?>
                        <?php echo $negocio->negocioDescripcion; ?>
                        <br />
                    <?php endif; ?>
                    <?php if(!empty($negocio->negocioCiudad)): ?>
                        <?php echo ciudad_usuario($negocio->negocioCiudad); ?>
                    <?php endif; ?>
                </div>
                <div class="span-4 last">
                    <?php if(!empty($negocio->negocioLatitud) || !empty($negocio->negocioLongitud)): ?>
                        <div class="span-6 last" style="margin-top: 10px; margin-left: 0px">
                            <div class="span-8 last" id="mapa_fondo11" style="margin-top: -20px">
                                <div class="pulzos_titulo1 span-6" style="margin-top: 1px; color: ; margin-left: 60px">
                                    <?php $totales = know_follow_company($this->session->userdata('id'), $negocio->negocioId); ?>
                                    <?php if($totales >= 1): ?>
                                        <?php echo anchor('seguidores/borrar/'.$this->session->userdata('id').'/'.$negocio->negocioId,
                                                          img(array('src'=>'statics/img/ya_no_seguir.png',
                                                                    'width'=>'68px',
                                                                    'height'=>'33px')),
                                                          array('style'=>'margin-right: 10px', 'class'=>'no_seguir_empresa', 'id'=>'no_seguir'.$negocio->negocioId, 'flag'=>$negocio->negocioId)); ?>
                                        <?php echo anchor('seguidores/seguir/'.$negocio->negocioId,
                                                          img(array('src'=>'statics/img/seguir.png',
                                                                    'width'=>'68px',
                                                                    'height'=>'33px')),
                                                          array('style'=>'margin-right: 10px; display: none', 'class'=>'seguir_empresa', 'id'=>'seguir'.$negocio->negocioId, 'flag'=>$negocio->negocioId)); ?>
                                    <?php else: ?>
                                        <?php echo anchor('seguidores/borrar/'.$this->session->userdata('id').'/'.$negocio->negocioId,
                                                          img(array('src'=>'statics/img/ya_no_seguir.png',
                                                                    'width'=>'68px',
                                                                    'height'=>'33px')),
                                                          array('style'=>'margin-right: 10px; display: none', 'class'=>'no_seguir_empresa', 'id'=>'no_seguir'.$negocio->negocioId, 'flag'=>$negocio->negocioId)); ?>
                                        <?php echo anchor('seguidores/seguir/'.$negocio->negocioId,
                                                          img(array('src'=>'statics/img/seguir.png',
                                                                    'width'=>'68px',
                                                                    'height'=>'33px')),
                                                          array('style'=>'margin-right: 10px', 'class'=>'seguir_empresa', 'id'=>'seguir'.$negocio->negocioId, 'flag'=>$negocio->negocioId)); ?>
                                    <?php endif; ?>
                                    <a href="#" class="idss" rel="<?php echo $is; ?>">
                                        <img src="http://www.pulzos.com/statics/img/Mapa.png" alt="Mapa" style="width: 67px; height: 60px" />
                                    </a>
                                </div>
                            </div>
                            <div class="overlay" id="overlay<?php echo $is; ?>" style="display:none;"></div>
                                <div class="box" id="box<?php echo $is; ?>">
                                    <a class="boxclose" id="boxclose<?php echo $is; ?>" rel="<?php echo $is; ?>"></a>
                                    <div class="mapa<?php echo $is; ?>" style="width: 450px; height: 200px; margin-left: 25px; margin-top: 0px" >
                                    </div>
                                    <script type="text/javascript">
                                        var latLng = new google.maps.LatLng(<?php echo $negocio->negocioLatitud; ?>, <?php echo $negocio->negocioLongitud; ?>);
                                        var myOptions = {
                                            zoom: 15,
                                            center: latLng,
                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                        };
                                        var map = new google.maps.Map($(".mapa<?php echo $is; ?>").get(0), myOptions);
                                        var markerImage = new google.maps.MarkerImage($("#imagen").attr('src'),
                                                          new google.maps.Size(34, 50),
                                                          new google.maps.Point(0, 0),
                                                          new google.maps.Point(0, 32));
                                        var marker = new google.maps.Marker({
                                                     position: latLng,
                                                     map: map,
                                                     icon: markerImage        
                                        });
                                    </script>
                                </div>
                                <?php $is = $is + 1; ?>
                            </div>
                        <?php else: ?>
                            <div class="span-6 last" style="margin-top: 10px; margin-left: 0px">
                                <div class="span-8 last" id="mapa_fondo11" style="margin-top: -20px">
                                    <div class="pulzos_titulo1 span-6" style="margin-top: 1px; color: ; margin-left: 60px">
                                        <?php $totales = know_follow_company($this->session->userdata('id'), $negocio->negocioId); ?>
                                        <?php if($totales >= 1): ?>
                                            <?php echo anchor('seguidores/borrar/'.$this->session->userdata('id').'/'.$negocio->negocioId,
                                                               img(array('src'=>'statics/img/ya_no_seguir.png',
                                                                         'width'=>'68px',
                                                                         'height'=>'33px')),
                                                               array('style'=>'margin-right: 10px', 'class'=>'no_seguir_empresa', 'id'=>'no_seguir'.$negocio->negocioId, 'flag'=>$negocio->negocioId)); ?>
                                            <?php echo anchor('seguidores/seguir/'.$negocio->negocioId,
                                                              img(array('src'=>'statics/img/seguir.png',
                                                                        'width'=>'68px',
                                                                        'height'=>'33px')),
                                                              array('style'=>'margin-right: 10px; display: none', 'class'=>'seguir_empresa', 'id'=>'seguir'.$negocio->negocioId, 'flag'=>$negocio->negocioId)); ?>
                                            <?php echo img(array('src'=>'statics/img/NoMapa.png',
                                                                 'width'=>'67px',
                                                                 'height'=>'60px')); ?>
                                        <?php else: ?>
                                            <?php echo anchor('seguidores/borrar/'.$this->session->userdata('id').'/'.$negocio->negocioId,
                                                               img(array('src'=>'statics/img/ya_no_seguir.png',
                                                                         'width'=>'68px',
                                                                         'height'=>'33px')),
                                                               array('style'=>'margin-right: 10px; display: none', 'class'=>'no_seguir_empresa', 'id'=>'no_seguir'.$negocio->negocioId, 'flag'=>$negocio->negocioId)); ?>
                                            <?php echo anchor('seguidores/seguir/'.$negocio->negocioId,
                                                              img(array('src'=>'statics/img/seguir.png',
                                                                        'width'=>'68px',
                                                                        'height'=>'33px')),
                                                              array('style'=>'margin-right: 10px', 'class'=>'seguir_empresa', 'id'=>'seguir'.$negocio->negocioId, 'flag'=>$negocio->negocioId)); ?>
                                            <?php echo img(array('src'=>'statics/img/NoMapa.png',
                                                                 'width'=>'67px',
                                                                 'height'=>'60px')); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="span-14">
            <div class="prepend-2" style="color: #660066; font-size: 14px">
                <?php echo $message; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
