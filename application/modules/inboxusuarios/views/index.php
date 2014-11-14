<script type="text/javascript">
$(document).ready(function(){
     if($('#idPara').val()== null){
         urlLoad = $("#principalInboxM").attr("href");
         $("#inbox").load(urlLoad);
         
    }else{
         urlPara = $("#inbxPara").attr("href");
         $("#inbox").load(urlPara);
    }
    
    $('#cambiOpciones').html('<span class="principal">Todos</span>');
    $('#todos').hide();
    $('#opcionesInbox').hide();
    
    $('#opcionesInbox').mouseleave(function(){
        $(this).slideUp();
    });
    
    var texto = $("div#menu-derecha").html();
    $("#main-div").html(texto);
    
 
    $('#planesU').click(function(event){
        event.preventDefault();
        nuevo=$('#crear').attr('href');
        $("#inbox").load(nuevo); 
    });
    
    $(".inboxes").click(function(event){
        event.preventDefault();
        urlIn = $(event.currentTarget).attr("href");
        $("#inbox").load(urlIn);
    });
    
   
    name_complete = $("#nombre-usuario-plan").text();
    age_complete = $("#edad-usuario-plan").text();
    relation_complete = $("#relacion-usuario-plan").text();
    state_complete = $("#estado-usuario-plan").text();
    $("#nombre-profile").text(name_complete);
    $("#edad-profile").text(age_complete);
    $("#personal-profile").text(relation_complete);
    $("#localidad-profile").text(state_complete);
    
    //opciones de botones desplegable
    $('#todos, #img, #cambiOpciones').click(function(){
        $('#opcionesInbox').toggle();
    });
    
    $('#todos').click(function(){
         urlTodos = $("#principalInboxM").attr("href"); 
         $('#cambiOpciones').html('<span>Todos</span>');
         $('.opcion').show();
         $(this).hide();
         $('#opcionesInbox').hide();
         $("#inbox").load(urlTodos);
    });
    $('#enviados').click(function(){
         urlSalida = $("#salida").attr("href");
         $('#cambiOpciones').html('<span>Enviados</span>');
         $('.opcion').show();
         $(this).hide();
         $('#opcionesInbox').hide();
         $("#inbox").load(urlSalida);
    });
    
    $('#recibido').click(function(){
         $('#cambiOpciones').html('<span">Recibidos</span>');
         $('.opcion').show();
         $(this).hide();
         urlRecivido = $("#recividos").attr("href");
         $('#opcionesInbox').hide();
         $("#inbox").load(urlRecivido);
    });
    $('#sinLee').click(function(){
         $('#cambiOpciones').html('<span>Sin&nbsp;leer</span>');
         $('.opcion').show();
         $(this).hide();
         urlSLeer = $("#sinLeer").attr("href");
         $('#opcionesInbox').hide();
         $("#inbox").load(urlSLeer);
    });
    
});
</script>
<div id="menu-derecha" style="display: none">
<div id="menu-opciones">
                    <?php echo anchor('planesusuarios',
                                      img(array('src'=>'statics/img/bot-crearmensaje.png',
                                                'id'=>'planesU',
                                                'width'=>'80',
                                                'height'=>'20',
                                                'style'=>'margin-top: 22px; margin-left: -23px','onclick'=>"dhtmlHistory.add('".base_url()."index.php/inboxusuarios/crear/".$this->session->userdata('id')."',null);"))); ?>
</div>
</div>

<div class="prepend-10 last" style="margin-top: 10px;font-size:11px;font-family: Arial, Helvetica, sans-serif;">
    
    <div class="span-1 last" style="color: #660066;">
        Ver:
    </div>
    <div class="span-2 last">
        <div id="todosInbox" style="width:80px;text-align:center;background-color:white;border:1px solid #DFCBDF;cursor:pointer;"> 
                
                <div id="cambiOpciones" class="span-1 last" style="color: #996699;margin-left:18px;"></div>
                     <img id="img" src="<?php echo base_url().'/statics/img/msj-flecha.jpg' ?>" style="margin-left:14px;margin-bottom:2px;" />
                        
                        <div id="opcionesInbox" class="msjs" style="color: #996699;border-top:1px solid #DFCBDF;">
                            <span class="opcion" id="todos">    Todos &nbsp;     </span>
                            <span class="opcion" id="enviados"> Enviados &nbsp;  </span>
                            <span class="opcion" id="recibido"> Recibidos &nbsp; </span>
                            <span class="opcion" id="sinLee">   Sin&nbsp;leer    </span>
                        </div>
                            
        </div>
    </div>
</div>


<div style="display:none">
    <div id="nombre-usuario-plan">Mensajes</div>
</div>
<div class="span-14 last" style="margin-top:10px">

    </div>
    <div class="span-14 last tabs-menu">
        <ul class="tab-3">
            <li>
                <a id="principalInboxM" class="inboxes" href="<?php echo base_url(); ?>index.php/inboxusuarios/todos_mensajes" >

                </a>
            </li>
            <li>
                <a id="crear" href="<?php echo base_url(); ?>index.php/inboxusuarios/crear/<?php echo $this->session->userdata('id'); ?>" class="inboxes">

                </a>
            </li>
            <li>
                <a id="salida" href="<?php echo base_url(); ?>index.php/inboxusuarios/bandeja_salida/<?php echo  $this->session->userdata('id'); ?>" class="inboxes">

                </a>
            </li>
            <li>
                <a id="recividos" href="<?php echo base_url(); ?>index.php/inboxusuarios/recibidos/<?php echo $this->session->userdata('id'); ?>" class="inboxes">

                </a>
            </li>
            <li>
                <a id="sinLeer" href="<?php echo base_url(); ?>index.php/inboxusuarios/sinLeer/<?php echo $this->session->userdata('id'); ?>" class="inboxes">

                </a>
            </li>
            
        </ul>
    </div>
<?php if(isset($idPara)){ ?>
<input type="hidden" id="idPara" value="<?php echo $idPara; ?>" />
<?php echo anchor('inboxusuarios/crearDefined/'.$this->session->userdata('id').'/'.$idPara,'',array('id'=>'inbxPara','style'=>'display:none;')); ?>
 
<?php } ?>
    <div id="inbox"></div>
</div>
