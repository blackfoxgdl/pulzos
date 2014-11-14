<?php
/*
 * Uso de apuntadores con idHistorial para interpretacion
 * con Jquery
 */
include ('../../library/conexion.php');

 $idN=$_GET['idNegocio'];
 $query='SELECT * FROM historialDeposito where historialEmpresaId='.$idN;
 $codigo;
 
 $n=$db->Execute($query) or die (GetDbError($myDB->ErrorMsg()));
 $c=$n->FetchNextObj();
 $h=$db->Execute($query);
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pulzos</title>

</head>
    <link rel="stylesheet" type="text/css" href="css/jquery.confirm.css" />
    <script type="text/javascript" src="js/confirm.jquery.js"></script>
    <script type="text/javascript">
        $(".btnDeposito").click(function(event){
            event.preventDefault();
            flag = $(event.currentTarget).attr('flag');
            numeroReferencia = $("#numerosReferencias"+flag).val();
            if(numeroReferencia != '')
            {
                $.confirm({
                    'title'     : 'Confirmacion de Deposito',
                    'message'   : 'Seguro que deseas confirmar el deposito bancario?<br /> No. Referencia: ' + numeroReferencia,
                    'buttons'   : {
                        'Aceptar'   : {
                            'class' : 'blue',
                            'action': function(){
                                depositoBtn(flag, numeroReferencia);
                            }
                        },
                        'Cancelar'  : {
                            'class' : 'gray',
                            'action': function(){}
                        }
                    }
                });
            }
            else
            {
                alertas('Ingrese el # de referencia del deposito.');
                $("#numerosReferencias"+flag).focus().css({'border': '1px solid red','height':'15px'});

            }
        });
    </script>
    <body>
<table class="redondeo" width="679px" border="0" style="background: white;color:black;margin-left:auto;margin-right:auto;">
<tbody id="sinG" style="align-text:center;">
          <tr>
            <th noWrap>No. Referencia</th>
            <th noWrap>Total Bonificacion</th>
            <th noWrap>Fecha Inicio</th>
            <th noWrap>Fecha Fin</th>
            <th noWrap>Ver Mas</th>
          </tr>
<?php 
//Desglozado
//Sin desgloce, Principal

while($row=$h->FetchNextObj()){ 
    if($row->historialCodigo=='' || $row->historialCodigo=='0'){
        //get days for check buttons
        $dia = date('d');
        $mes = date('m');
        $date_ini = date('d-m-Y', $row->historialFechaInicio);
        $date_fin = date('d-m-Y', $row->historialFechaFin);
        $recorte_ini = explode('-', $date_ini);
        $recorte_fin = explode('-', $date_fin);
        if(($recorte_ini[0] == '01') && ($recorte_fin[0] == '15'))
        {
            if((($recorte_ini[1] == $mes) && ($recorte_fin[1] == $mes) && ($recorte_fin[0] == '15')) || (($recorte_ini[1] > $mes) && ($recorte_fin[1] > $mes)))
            {
                $codigo='<div style="border-bottom: 5px">
                            <input type="text" name="numero_referencia' . $row->idHistorial . '" id="numerosReferencias' . $row->idHistorial . '" style="background-color: #FFFFFF; height: 15px;" />
                         </div>
                         <div id="depositar'.$row->idHistorial.'" class="btnDeposito" flag="' . $row->idHistorial .'"> Depositar </div>';
                        //<div onclick="depositoBtn1('.$row->idHistorial.')" id="depositar1'.$row->idHistorial.'" class="btnDeposito1" flag="' . $row->idHistorial .'"> Depositar </div>';
            }
            else
            {
                $codigo = '......';
            }
        }
        if((($recorte_ini[0] == '16') && ($recorte_fin[0] == '30')) || (($recorte_ini[0] == '16') && ($recorte_fin[0] == '31')) || (($recorte_ini[0] == '16') && ($recorte_fin[0] == '28')) || (($recorte_ini[0] == '16') && ($recorte_fin[0] == '29')))
        {
            if(($recorte_ini[1] > $mes) && ($recorte_fin[1] > $mes))
            {
                $codigo='<div style="border-bottom: 5px">
                            <input type="text" name="numero_referencia' . $row->idHistorial . '" id="numerosReferencias' . $row->idHistorial . '" style="background-color: #FFFFFF; height: 15px;" />
                         </div>
                         <div id="depositar'.$row->idHistorial.'" class="btnDeposito" flag="' . $row->idHistorial .'"> Depositar </div>';
                        //<div onclick="depositoBtn1('.$row->idHistorial.')" id="depositar1'.$row->idHistorial.'" class="btnDeposito1" flag="' . $row->idHistorial .'"> Depositar </div>';
            }
            else
            {
                $codigo = '......';
            }
        }
   }else{
       $codigo=$row->historialCodigo;
   }
   echo '
          <tr style="background-color:#C1C1C1">
            <td align="center" valign="middle" id="noR'.$row->idHistorial.'">'.$codigo.'</td>
            <td>'.$row->historialTotalQuincenal.'</td>
            <td noWrap>'.date("d-m-Y", $row->historialFechaInicio).'</td>
            <td noWrap>'.date("d-m-Y", $row->historialFechaFin).'</td>
            <td id="ver'.$row->idHistorial.'" onClick="verBtn('.$row->idHistorial.');" style="cursor:pointer">VER</td>
            <td id="ocultar'.$row->idHistorial.'"  style="display:none;cursor:pointer" onClick="ocultarBtn('.$row->idHistorial.')">OCULTAR</td>
          </tr>'; ?>    
</tbody>  
<?php 

 //Hacer desgloce de cada uno
   $desglose='SELECT *, usuarios.nombre as usuario FROM comisionRecibida INNER JOIN usuarios ON comisionRecibida.comisionRecibidaUsuarioId = usuarios.id Where comisionRecibidaHistorialId = '.$row->idHistorial; 
   $d=$db->Execute($desglose);
   
     ?>
   
<tbody class="data" id="conD<?php echo $row->idHistorial; ?>" style="display: none">
        <tr>
            <th noWrap>No. Referencia</th>
            <th noWrap>Usuario</th>
            <th noWrap>Folio/Factura</th>
            <th noWrap>Bonificacion</th>
        </tr>
<?php
   while($dsg=$d->FetchNextObj()){ ?>
     <tr style="border-color: black;">
         <td> <?php echo $dsg->comisionRecibidaNumeroReferencia; ?></td>
         <td noWrap><?php echo $dsg->usuario;?></td>
         <td> # <?php echo $dsg->comisionRecibidaFolioTransaccion; ?></td>
         <td> $ <?php echo $dsg->comisionRecibidaUsuarioBonificacion; ?></td>
     </tr>
     
   <?php }   ?>
   </tbody>
<?php //Termino de desgloce
   } //Termino sin desgloce

 ?>
        </table>
      </body>
  
</html>
