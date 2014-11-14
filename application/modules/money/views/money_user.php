<?php
/*
	*view MoneyBack usuarios
	* @version 0.1 
	* @copyright ZavorDigital, 19 Julio, 2011
  	* @package Money
  	* @author icharlydy <icharlydy@gmail.com>
  

*/
?>
<?php echo'<title>Pulzos</title>'?>
<?php form_open('money')?>
<?php echo'</br>'?>
<?php echo form_label('Folio:','foliolb')?>
<?php echo form_input(array('folio'=>'folio', 'id'=>'folio','size'=>'10','value'=>set_value('folio')))?>
<?php echo'</br>'?>
<?php echo form_label('Codigo Activacion:','codigolb')?>
<?php echo form_input(array('codigo'=>'codigo', 'id'=>'codigo','size'=>'10','value'=>set_value('codigo')))?>
<?php echo'</br>'?>
<?php echo form_submit('post','Postear')?>
<?php echo form_close()?>