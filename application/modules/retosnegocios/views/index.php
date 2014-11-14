<?php
/**
 * Vista la cual mostrara el formulario de los retos 
 * asi como los retos debajo del mismo actualizados,
 * en este solo se tendra que especificar el tiempo 
 * de duracion de la promocion, cual es la promocion
 * e incluso se podra subir una imagen
 *
 * @version 0.1
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @copyright ZavorDigital, June 8, 2011
 * @package retosNegocios
 **/ ?>
<script type="text/javascript">
$(".RetosGrupo").change(function(event){
    name = $(event.currentTarget).val();
    if(name == 2)
    {
        $("#numeroAsistentes").hide();
        $("#Detiempo").show();
    }
    else
        if(name == 4)
        {
            $("#Detiempo").hide();
            $("#numeroAsistentes").show();
        }
    else
    {
        $("#Detiempo").hide();
        $("#numeroAsistentes").hide();
    }
});
</script>
<div class="span-14 last" style="margin-top: 10px">
    <div class="span-13 last">
        <div class="span-3" style="margin-top: 1px;">
            <?php echo form_label('Tipo de Reto:','tipoRetos',array('style'=>'color:#660068')); ?>
        </div>
        <div class="span-10 last" style="color:#660068;">
            <?php $deConsumo = array('id'=>'consumoReto',
                                     'class'=>'RetosGrupo',
                                     'name'=>'Pulzos[pulzoTipoEventoId]',
                                     'value'=>'1',
                                     'checked'=>TRUE); ?>
            <?php echo form_radio($deConsumo); ?>De consumo
            <br />
            <?php $deTiempo = array('id'=>'tiempoReto',
                                    'class'=>'RetosGrupo',
                                    'name'=>'Pulzos[pulzoTipoEventoId]',
                                    'value'=>'2',
                                    'checked'=>FALSE    
                                   ); ?>
            <?php echo form_radio($deTiempo); ?>De tiempo
            <br />
            <?php $deActividad = array('id'=>'actividadReto',
                                       'class'=>'RetosGrupo',
                                       'name'=>'Pulzos[pulzoTipoEventoId]',
                                       'value'=>'3',
                                       'checked'=>FALSE); ?>
            <?php echo form_radio($deActividad); ?>De actividad
            <br />
            <?php $deGrupo = array('id'=>'gruposReto',
                                   'class'=>'RetosGrupo',
                                   'name'=>'Pulzos[pulzoTipoEventoId]',
                                   'value'=>'4',
                                   'checked'=>FALSE); ?>
            <?php echo form_radio($deGrupo); ?>De grupo
            <br />
            <?php $otros = array('id'=>'otrosReto',
                                 'class'=>'RetosGrupo',
                                 'name'=>'Pulzos[pulzoTipoEventoId]',
                                 'value'=>'5',
                                 'checked'=>FALSE); ?>
            <?php echo form_radio($otros); ?>Otros
        </div>
        <div class="span-13 last" id="Detiempo" style="display:none">
            <div class="span-3">
                <?php echo form_label('Fecha Inicio:', 'tiempoDuracion', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-10 last">

                <?php $mesI = 'id="mesInicio"
                               class="mesIni"'; ?>
                <?php echo form_dropdown('Pulzos[meses]', $meses, date('m'), $mesI); ?>
        
                <?php $diaFI = 'id="diaInicio",
                                class="diaIni"';   
                      echo form_dropdown('Pulzos[dias]',$dias,date('d'),$diaFI); ?>
            </div>
            <br />
            <div class="span-3">
                <?php echo form_label('Hora Inicio:', 'horaDuracion', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-10 last">
                <select name="Pulzos[hora]" id="hora">
                    <option value=''>HH</option>
                    <option value="00" >00</option>
                    <option value="01" >01</option>
                    <option value="02" >02</option>
                    <option value="03" >03</option>
                    <option value="04" >04</option>
                    <option value="05" >05</option>
                    <option value="06" >06</option>
                    <option value="07" >07</option>
                    <option value="08" >08</option>
                    <option value="09" >09</option>
                    <option value="10" >10</option>
                    <option value="11" >11</option>
                    <option value="12" >12</option>
                    <option value="13" >13</option>
                    <option value="14" >14</option>
                    <option value="15" >15</option>
                    <option value="16" >16</option>
                    <option value="17" >17</option>
                    <option value="18" >18</option>
                    <option value="19" >19</option>
                    <option value="20" >20</option>
                    <option value="21" >21</option>
                    <option value="22" >22</option>
                    <option value="23" >23</option>
                </select>
                    
                <select name="Pulzos[minuto]"  id="minuto" >
                    <option value=''>MM</option>
                    <option value="00" >00</option>
                    <option value="01" >01</option>
                    <option value="02" >02</option>
                    <option value="03" >03</option>
                    <option value="04" >04</option>
                    <option value="05" >05</option>
                    <option value="06" >06</option>
                    <option value="07" >07</option>
                    <option value="08" >08</option>
                    <option value="09" >09</option>
                    <option value="10" >10</option>
                    <option value="11" >11</option>
                    <option value="12" >12</option>
                    <option value="13" >13</option>
                    <option value="14" >14</option>
                    <option value="15" >15</option>
                    <option value="16" >16</option>
                    <option value="17" >17</option>
                    <option value="18" >18</option>
                    <option value="19" >19</option>
                    <option value="20" >20</option>
                    <option value="21" >21</option>
                    <option value="22" >22</option>
                    <option value="23" >23</option>
                    <option value="24" >24</option>
                    <option value="25" >25</option>
                    <option value="26" >26</option>
                    <option value="27" >27</option>
                    <option value="28" >28</option>
                    <option value="29" >29</option>
                    <option value="30" >30</option>
                    <option value="31" >31</option>
                    <option value="32" >32</option>
                    <option value="33" >33</option>
                    <option value="34" >34</option>
                    <option value="35" >35</option>
                    <option value="36" >36</option>
                    <option value="37" >37</option>
                    <option value="38" >38</option>
                    <option value="39" >39</option>
                    <option value="40" >40</option>
                    <option value="41" >41</option>
                    <option value="42" >42</option>
                    <option value="43" >43</option>
                    <option value="44" >44</option>
                    <option value="45" >45</option>
                    <option value="46" >46</option>
                    <option value="47" >47</option>
                    <option value="48" >48</option>
                    <option value="49" >49</option>
                    <option value="50" >50</option>
                    <option value="51" >51</option>
                    <option value="52" >52</option>
                    <option value="53" >53</option>
                    <option value="54" >54</option>
                    <option value="55" >55</option>
                    <option value="56" >56</option>
                    <option value="57" >57</option>
                    <option value="58" >58</option>
                    <option value="59" >59</option>
                </select>
            </div>
        </div>
        <div class="span-13 last" id="numeroAsistentes" style="display: none; margin-right: 10px">
            <div class="span-4 last" style="margin-top: 10px">
                <?php echo form_label('Numero de integrantes: ', 'numeroAsistentes', array('style'=>'color: #660066')); ?>
            </div>
            <div class="span-8 last" style="margin-top: 10px">
                <?php echo form_input(array('id'=>'asistentesNumero',
                                            'class'=>'asistentes_numero',
                                            'name'=>'Pulzos[pulzoNumeroAsistentes]')); ?>
            </div>
        </div>
    </div>
    <div class="span-13 last">
        <div class="span-13 last">
            <span style="color: #660066">
                Descripci&oacute;n:
            </span>
        </div>
        <div class="span-13 last">
            <?php echo form_textarea(array('id'=>'retosDescripcion',
                                           'class'=>'',
                                           'name'=>'Pulzos[pulzoAccion]',
                                           'style'=>'width: 524px; height: 80px')); ?>
        </div>
    </div>
    <div class="span-13 last">
        <div class="span-13 last">
            <span style="color: #660066">
                Aviso Legal:
            </span>
        </div>
        <div class="span-13 last">
            <?php echo form_textarea(array('id'=>'retosLegal',
                                           'class'=>'',
                                           'name'=>'Pulzos[pulzoAvisoLegal]',
                                           'style'=>'width: 524px; height: 60px')); ?>
        </div>
    </div>
    <div class="span-13 last">
        <div class="span-13 last">
            <span style="color: #660066">
                Tipo de Comunicaci&oacute;n:
            </span>
        </div>
        <div class="span-13 last">
            <span style="color: #660066">
                &nbsp &nbsp &nbsp &nbsp<?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '1', TRUE); ?> Privada  (solo a tu seguidores)<br />
                &nbsp &nbsp &nbsp &nbsp<?php echo form_radio('Pulzos[pulzoTipoComunicacion]', '2', FALSE); ?> P&uacute;blica  (solo en tu ciudad)<br />
            </span>
        </div>
    </div>
    <div class="span-14 last">
        <?php $datosDelNegocio = datos_negocios($this->session->userdata('id')); ?>
        <?php echo form_hidden('Pulzos[pulzoSubcategoria]', $datosDelNegocio->negocioSubgiro); ?>
        <?php echo form_hidden('Pulzos[pulzoCategoria]', $datosDelNegocio->negocioGiro); ?>
    </div>
    <div class="span-13 last">
        <div class="span-3 last">
            <span style="color: #660066">
                Cargar Imagen:
            </span>
        </div>
        <div class="span-9 last">
            <?php echo form_upload(array('id'=>'',
                                         'name'=>'imagenR',
                                         'value'=>'Cargar Imagen',
                                         'style'=>'')); ?>
        </div>
    </div>
</div>
