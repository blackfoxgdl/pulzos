<?php form_open('moneyuser')?>
	<?php echo form_label('Codigo confirmacio:','codconfirmacionlb')?>
	<?php echo form_input(array('codigo'=>'codigo', 'id'=>'codigo','size'=>'15','value'=>set_value('codigoconfirm')))?>
	<?php echo form_submit('enviar','Enviar')?>
<?php echo form_close()?>