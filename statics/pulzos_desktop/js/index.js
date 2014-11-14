/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
      $("input:submit").button();var cnt;
      $('#imagen').fadeIn('slow', function(){
          $('#pulzar').fadeIn('slow');
      });
      //window.open("http://www.google.com","Putos","resizable=no"); 
 $("#formUser").submit(function(event){
          event.preventDefault();
          var opciones = {
                success: function(data){
                    if(data.length>1){
                        cnt=data.split('|');
                        location.href=cnt[1];
                    }else{
                        if(data=='u'){
                            $('#email').css({'border': '1px solid red','width':'192px','margin-top':'3px'});
                            $('#alertas').html('<strong>El negocio no existe</strong>')
                                .slideDown('slow', function(){
                                    setTimeout(function(){
                                        $('#alertas').slideUp('slow', function(){
                                        });
                                    },1500);  
                                });
                        }else if(data=='p'){
                             $('#email').removeAttr('style');
                             $('#pass').css({'border': '1px solid red','width':'192px','margin-top':'3px','height': '24px'});
                             $('#alertas').html('<strong>Su Contraseña es incorrecta</strong>')
                                .slideDown('slow', function(){
                                    setTimeout(function(){
                                        $('#alertas').slideUp('slow', function(){
                                        });
                                    },1500);  
                                });
                        }else{
                            $('#alertas').html('<strong>Ocurrio un error grave, Reinicie el programa</strong>')
                                .slideDown('slow', function(){
                                    setTimeout(function(){
                                        $('#alertas').slideUp('slow', function(){
                                        });
                                    },1500);  
                                });
                        }
                        
                    } 
                }
          }
        $(this).ajaxSubmit(opciones);
        return false;
      });
});