<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery/plugins/jquery_tools/jquery.tools.min.js'; ?>"></script>
<link href="<?php echo base_url();?>statics/css/ext/calendario.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>statics/css/ext/redondeo.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    $(document).ready(function(){
       
        var wscr =$('#mainalendario').width();
        var hscr = $('#mainalendario').height()-1-$('#barcal').height()-$('#footer').height();
        
        var counttr = $("#minical tr").length-1; 
        var counttd = $("#minical th").length; 

        $('#minical').css("width", wscr);
        $('#minical').css("height", hscr);
        $('.bodybox').css("height",(hscr/counttr)-($('.headbody').height()+$('#barcal').height()))
        $('#minical th').css("width",(wscr/counttd));
        $('#minical td').css("height",'50px');
        $('#texto-menu').css('height',$('#minical').height()+30+$('#barcal').height());
        name_complete = $("#nombre-usuario-plan").text();
        age_complete = $("#edad-usuario-plan").html();
        relation_complete = $("#relacion-usuario-plan").text();
        state_complete = $("#estado-usuario-plan").text();
        $("#nombre-profile").text(name_complete);
        $("#edad-profile").html(age_complete);
        $("#personal-profile").text(relation_complete);
        $("#localidad-profile").text(state_complete);
        var texto = $("div#menu-derecha").html();
        $("#main-div").html(texto);

        
        });
        
	var urlC=$('#dirCalendario').attr('href');
        var idUsuario=$('#usuarioId').attr('value');
	$('.mesAnt').click(function(){

                var mes=$('#mesOculto').val()-1;
                var anio=$('#anioOculto').val();
                $.ajax({
                url: urlC+'/'+idUsuario,
                type: "POST",
                data: 'antMes='+mes+'&anioA='+anio,
                success: function(datos){
                        $("#texto-menu").html(datos);       
                }
                });
                
        });
	$('.mesSig').click(function(){
                var mes=parseInt($('#mesOculto').val())+parseInt(1);
                var anio=$('#anioOculto').val();
                $.ajax({
                url: urlC+'/'+idUsuario,
                type: "POST",
                data: 'sigMes='+mes+'&anioS='+anio,
                success: function(datos){
                        $("#texto-menu").html(datos);
                }
                });
                
    });

    $("#descubre").click(function(event){
        event.preventDefault();
        urlRedirectDescubre =$(this).attr("href");
        $("#texto-menu").load(urlRedirectDescubre);
    });
</script>

<input id="usuarioId" type="hidden" value="<?php echo $id_usuario; ?>" />
<div id="menu-derecha" style="display: none">
        <div id="menu-opciones">
               <?php echo anchor('planesusuarios',
                                              img(array('src'=>'statics/img/bot-armapulzo.png',
                                                        'id'=>'planesU',
                                                        'width'=>'80',
                                                        'height'=>'20',
                                                        'style'=>'margin-top: 22px; margin-left: -23px')));?>
        </div>              
</div>

<div style="display:none">
    <div id="nombre-usuario-plan">Pulzos</div>
    <div id="edad-usuario-plan">
        <?php echo anchor('pulzos/pulzos_usuarios/'.$id_usuario,
                          'Descubre tu ciudad',
                          array('style'=>'text-decoration: none; color: #339900', 'id'=>'descubre')); ?>
    </div>
</div>
<?php
 echo anchor('planesusuarios/calendario_usuarios','',array('id'=>'dirCalendario','style'=>'display:none')); 
        $nombre_dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
        $nombre_meses= array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $anio=date('Y',time());
        $mes=date('m',time());
        
        if($mes[0]=='0' || $mes=='09'){
           $cortMes = explode('0', $mes);
           $mes=$cortMes[1];
           $mesActual=$nombre_meses[$cortMes[1]];
           
        }else{
           $mesActual=$nombre_meses[$mes];
        }
        //cambio adelante atras
        if(isset ($mesNuevo) && ($anioNuevo)){
            $mes=$mesNuevo;
            $anio=$anioNuevo;
            $mesActual=$nombre_meses[$mes];
            
            
        }else{
    
        }?>
<div id="mainalendario" style="margin-top: 10px;width: 530px;height:350px">
      <div class="redondeo-titulo" id="barcal" style="height: 40px;">
            <div class="span-20" style="margin-top: 5px">
                <div class="span-5" style="margin-left: 5px">
                <?php echo img(array('src'=>'statics/img/bntIzCal.png','id'=>'bntIzCal', 'class'=>'mesAnt','style'=>'cursor:pointer',
                                                 'width'=>'23',
                                                 'height'=>'23')); ?>
                </div>
                
                 <div class="span-7 last" style="color: #339900;margin-left:15px;margin-right:8px;font-size: 14px">
                 <?php echo $mesActual.' '.$anio;?>
                 </div>
                <input type="hidden" id="mesOculto" value="<?php echo $mes; ?>" />
                <input type="hidden" id="anioOculto" value="<?php echo $anio; ?>" />
                
                <div class="span-1">
                 <?php echo img(array('src'=>'statics/img/bntDeCal.png','id'=>'bntDeCal', 'class'=>'mesSig','style'=>'cursor:pointer',
                                                 'width'=>'23',
                                                 'height'=>'23')); ?>
                </div>
            </div>
              
       </div> <?php 
        
       
        //dias mes anterior
        if($mes==1){
             $mes_anterior=12; 
             $anio_anterior = $anio-1;
            }
        else{
             $mes_anterior = $mes-1; 
             $anio_anterior = $anio;
            }
        
        $ultimo_dia_mes_anterior = date('t',mktime(0,0,0,$mes_anterior,1,$anio_anterior));

        $dia=1;
        if(strlen($mes)==1) $mes='0'.$mes;
        ?>

            <table id="minical" cellpadding="0" cellspacing="0">
                    
                
                    <thead>
                             <tr >
                                  <th><?php echo $nombre_dias[0]?></th>
                                  <th><?php echo $nombre_dias[1]?></th>
                                  <th><?php echo $nombre_dias[2]?></th>
                                  <th><?php echo $nombre_dias[3]?></th>
                                  <th><?php echo $nombre_dias[4]?></th>
                                  <th><?php echo $nombre_dias[5]?></th>
                                  <th><?php echo $nombre_dias[6]?></th>
                             </tr>
                    </thead>
                    <tbody id="calendarios">
                            <?php
                           
                            $numero_primer_dia = date('w', mktime(0,0,0,$mes,$dia,$anio)); //numero dia en semana

                            $ultimo_dia = date('t', mktime(0,0,0,$mes,$dia,$anio));

                            $diferencia_mes_anterior = $ultimo_dia_mes_anterior - ($numero_primer_dia-1);

                            $total_dias=$numero_primer_dia+$ultimo_dia;
                            $diames=1;
                            $j=1;
                            while($j<=$total_dias){
                                    
                                    echo "<tr> \n";
                           
                                    $i=0;
                                    $k=1; //dias proximo mes
                                    while($i<7){
                                            if($j<=$numero_primer_dia){
                                                    echo "<td class=\"disabled\"> \n";
                                                    echo "<div class=\"headbox\"> \n";
                                                    echo $diferencia_mes_anterior;
                                                    echo "</div>";
                                                    echo "<div class=\"bodybox\"></div> \n";
                                                    echo "</td> \n";
                                                    $diferencia_mes_anterior++;
                                            }elseif($diames>$ultimo_dia){
                                                    echo "<td class=\"disabled\"> \n";
                                                    echo "<div class=\"headbox\"> \n";
                                                    echo $k;
                                                    echo "</div>";
                                                    echo "<div class=\"bodybox\"></div> \n";
                                                    echo"</td> \n";
                                                    $k++; //dias proximo mes
                                            }else{
                                                    if($diames<10) $diames_con_cero='0'.$diames;
                                                    else $diames_con_cero=$diames;

                                                    echo "<td>";
                                                    echo "<div class=\"headbox\"> \n";
                                                    echo $diames;
                                                    echo "</div> \n";
                                                    foreach ($eventosC as $eventosCalendario):
                                                        $partefecha=explode(" ", $eventosCalendario->planfechaCalendario);
                                                        $hoyy=$partefecha[0];
                                                        $pHoy=explode('-',$hoyy);
                                                        $pDia = $pHoy[2];
                                                        ($pDia[0]=='0')?$day=$pDia[1]:$day=$pDia;
                                                        $hoy=$pHoy[0].'-'.$pHoy[1].'-'.$day;$diaEvento = $anio.'-'.$mes.'-'.$diames;
                                                            if($diaEvento==$hoy){
                                                                if(!isset($eventosCalendario->planVirtual)){$eventosCalendario->planVirtual='';}
                                                                
                                                                if($eventosCalendario->planVirtual=='cumple'){
                                                                    echo "<div class=\"bodybox\">".
                                                                       anchor('usuarios/perfil/'.$eventosCalendario->planId,'<img src="'.base_url().'statics/img/cumple.png" width="10" height="10" />'.substr($eventosCalendario->planMensaje,0,25).'',array('id'=>'dirCalendario','style'=>'display:block','title'=>'Cumpleaños')) 
                                                                    ."</div> \n";
                                                                    
                                                                }else if($eventosCalendario->planVirtual=='pulzante'){
                                                                    echo "<div class=\"bodybox\">".
                                                                       anchor('planesusuarios/ver_plan/'.$eventosCalendario->planId,'<img src="'.base_url().'statics/img/voy.png" width="11" height="9" />'.substr($eventosCalendario->planMensaje,0,10).'...',array('id'=>'dirCalendario','style'=>'display:block','title'=>'Pulzan')) 
                                                                    ."</div> \n";
                                                                }else{
                                                                echo "<div class=\"bodybox\">".
                                                                       anchor('planesusuarios/ver_plan/'.$eventosCalendario->planId,'<img src="'.base_url().'statics/img/pulzoC.png" width="9" height="10" />'.substr($eventosCalendario->planMensaje,0,8).'...',array('id'=>'dirCalendario','style'=>'display:block','title'=>'Te invita')) 
                                                                    ."</div> \n";}
                                                            }else{
                                                               
                                                            }
                                                       
                                                    endforeach; 
                                             
                                                    echo "</td> \n";
                                                    $diames++;
                                            }
                                            $i++;
                                            $j++;
                                    }
                                    echo "</tr> \n";
                            }
                            ?>
                        
                     </tbody>
            </table>

    </div>

