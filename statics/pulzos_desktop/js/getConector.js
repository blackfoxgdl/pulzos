/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var request = new XMLHttpRequest();
var url='';


setInterval(function(){
    request.open("GET", url);
    request.onload = function()
    {
         ((request.status >= 200 && request.status < 300) || request.status == 304)?'':
            $("#contenido").html('<div id="circleG"> <div id="circleG_1" class="circleG" ></div><div id="circleG_2" class="circleG"></div><div id="circleG_3" class="circleG"></div><p>&nbsp;</p><span style="font-family: Verdana, Geneva, sans-serif;font-size: 20px;margin-left:15px;"><span></div>');
        
    };
    request.onerror = function()
    {
       $("#contenido").html('<div id="circleG"> <div id="circleG_1" class="circleG" ></div><div id="circleG_2" class="circleG"></div><div id="circleG_3" class="circleG"></div><p>&nbsp;</p><span style="font-family: Verdana, Geneva, sans-serif;font-size: 20px;margin-left:15px;"><span></div>');
        var intervalHandle = setInterval(function()
        {
            request.open('GET', url);
            request.onload=function()
            {
                if((request.status >= 200 && request.status < 300) || request.status == 304)
                {
                    requestFine();
                    clearInterval(intervalHandle);
                }
            }
            request.onerror = function(){
            }
           request.send(null);
        },2000);
            
            //alert('se deconecto');//$('#pulzar').show('slow',function(){ check(); });
   };
    request.send(null);

//esto no
                /*$('#contenido').load('modules/home.html', function(responseText, textStatus, XMLHttpRequest){
                        if(textStatus=='success'){
                            $('.home').fadeIn('1000', function(){
                            });
                        }else if(textStatus=='error'){
                            //$("#contenido").html('<img id="loading" src="img/45.gif" width="35" height="35" style="margin-top:22%;margin-left:-15px;" /><p>&nbsp;</p><span style="font-family: Verdana, Geneva, sans-serif;font-size: 18px;margin-left:10px;">Reconectando...</span>');
                            $("#contenido").html('<div id="circleG"> <div id="circleG_1" class="circleG" ></div><div id="circleG_2" class="circleG"></div><div id="circleG_3" class="circleG"></div><p>&nbsp;</p><span style="font-family: Verdana, Geneva, sans-serif;font-size: 20px;margin-left:15px;">Conectando...<span></div>');
                            setTimeout(function(){
                                reLoad();
                            },3000);
                        }
                        
                });
            */ 
},15000); 


function requestFine(){
    $('#imagen').trigger('click');
}