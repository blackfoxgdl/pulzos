<?php
/*
	*view MoneyBack negocios
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
<?php echo form_label('Consumo:','consumolb')?>
<?php echo form_input(array('consumo'=>'consumo', 'id'=>'consumo','size'=>'10','value'=>set_value('consumo')))?>
<?php echo'</br>'?>
<?php echo form_label('Bonificacion:','bonificaionlb')?>
	<?php $options = 'id="bonificacion" value=""'; ?>
	<?php echo form_dropdown('EditarU[bonificacion]',
	                             array(0=>'Elije',
                                               1=>'1',
                                               2=>'2',
                                               3=>'3',
                                               4=>'4',
                                               5=>'5',
                                               6=>'6',
                                               7=>'7',
                                               8=>'8',
                                               9=>'9',
                                               10=>'10',
                                               15=>'15',
                                               20=>'20',
                                               25=>'25',
                                               30=>'30',
                                               40=>'40',
                                               50=>'50'),
                                     $options); ?>
<?php echo'%';?>
<?php echo'</br>'?>
<?php echo form_label('eMail:','emaillb')?>
<?php echo form_input(array('email'=>'email','id'=>'email','size'=>'50','value'=>set_value('email')))?>
<?php echo'</br>'?>
<?php echo form_label('Usuarios:','usuarioslb')?>
<?php echo'<div >Contenido</div>'?>
<?php echo form_submit('enviar','Enviar')?>
<?php echo form_close()?>