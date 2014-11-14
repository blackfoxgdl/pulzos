/* 
 * Encargado de mostrar las notificaciones
 * en el panel principal de Aplicacion de escritorio
 */
//alert('Hola notificaciones!!');
(function($){
/*
*@description: function checa las notificaciones de la pagina principal o Home
*              la app Desktop.
*              
*@parameters: int->id
*
*@author: jorgeLegon
*
**/
    $.fn.notificacion=function(id)
    {
       return this.each(function() 
       {
             var $this = $(this);
             
             $.get('library/get_notificaciones.php',{msj:id},function(msj){ 
                 if(msj!='0'){
                    $this.append('<span class="ntfMsj">'+msj+'</span>');
                 }
             });
             
             $.get('library/get_notificaciones.php',{cuenta:id},function(cuenta){
                 $this.append('<span class="ntfCuenta">'+cuenta+'</span>');
             });
             
        });  
    }
/*
*@description: Funcion para los inputs que se encarga de quitar o poner los estilos para los formularios
*
*@parameters: null
*
*@author: jorgeLegon
*
**/



    $.fn.hbInput=function()
    {
        return this.each(function()
        {
            var $this = '#'+this.id;
            if($($this).attr('style','border: 1px solid red') && $($this).val() != '')
            {
                $($this).css('border','none');
            }
            
            
        });
    }
/*
*@description: Function para checar los botones de las 'ofertas' (activar y desactivar ofertas)
*
*@parameters: int status
*
*@author: jorgeLegon
*
**/

    $.fn.chkbntOf=function(){
        return this.each(function()
        {
            var $this = $(this);
            status=$this.attr('cb-status');
            if(status==1){
                 $(this).attr('style','left:41px');
            }
            
        });
    }
/*
*@description: Function para Eliminar o actualizar directamente de la base de datos 
*              mostrando un dialogo para aceptar o rechazar la peticion
*
*@parameters: int id->referenciaDB, 
*             String->dialogo, 
*             String->url, 
*             boolean->update, drop
*
*@author: jorgeLegon
*
**/
   $.fn.dropUpOf=function(options){
       
       return this.each(function()
       {
          var $this = $(this);
          $this.html('<div id="dialog-confirm" title="Borrar" style="display: none"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>'+options.dialog+'</p></div>');
          $(function(){
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog-confirm" ).dialog({
                                            show:'blind',
                                            resizable: false,
                                            height: 155,
                                            modal: true,
                                            hide: 'fold',
			buttons: {
				"Eliminar": function(){
					$( this ).dialog( "close" );
                                        //Drop Row    
                                            if(options.drop){
                                                $.get(options.url,{erase:options.id}, function(data){
                                                    $('#'+options.id).parent().hide('slow');
                                                    alertas(data);
                                                }); 
                                       //Update Row     
                                            }else if(options.update){
                                                $.post(options.url, {change:options.change, id:options.id}, function(datas){
                                                    $('#'+options.id).parent().hide('slow');
                                                    alertas(datas);
                                                });
                                            }else{
                                                alert('Ha ocurrido un error Grave!!');
                                            }
                                            
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
          
       });
   }
})(jQuery);
