/*
 * Se necesita para versiones de Internet explorer
 * anteriores al 8 con el fin de cargar hojas de estilo
 * o para usos especiales en modo compatibilidad
 * 
 *  @author JorgeLeon  
 */
// Use Native XHR, if available
//engine = null;
if (window.XMLHttpRequest) {
    // If IE7+, Gecko, WebKit: Use native object
    var xmlHttp = new XMLHttpRequest();
}
else if(window.ActiveXObject){
    // ...if not, try the ActiveX control 
    var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
}
else {
    // No XMLHTTPRequest mechanism is available.
}

$(document).ready(function(){
    if($.browser.msie)
    {
        if(parseInt($.browser.version) < 8)
        {
            $('#comp').addClass('cabecera').html('<div id="texto" class="prepend-20 span-9 last">Tu version de explorer es Obsoleta. Descarga nueva version.</div>\n\
                                     <div class="span-2" id="s"><span>Aceptar</span></div>\n\
                                     <div class="span-2" id="n"><span>Rechazar</span></div>');
            setTimeout('$("#comp").show("slow")',1000);
          
          //Estilos
          $('#texto').addClass('texto');
          
          $('#s').addClass('btnAceptar');
          $('#n').addClass('btnRechazar');
          
          //acciones de botones
          $('#s').click(function(){
              location.href='http://view.atdmt.com/action/mrtiex_FY12IE9StaPrdIE9MSCOMProductPageFNL_1?href=http://download.microsoft.com/download/8/6/D/86DB5DC9-5706-4A5B-BD46-FFBA6FA67D44/IE9-Windows7-x86-esn.exe';
              setTimeout('$("#comp").hide("slow")',1000);
          });
          $('#n').click(function(){
              setTimeout('$("#comp").hide("slow")',1000);
          });
//        var downIE= confirm('Tu version de explorer es Obsoleta.Deseas descargar nueva version?');
//        if(downIE==true){
//            location.href='http://view.atdmt.com/action/mrtiex_FY12IE9StaPrdIE9MSCOMProductPageFNL_1?href=http://download.microsoft.com/download/8/6/D/86DB5DC9-5706-4A5B-BD46-FFBA6FA67D44/IE9-Windows7-x86-esn.exe';
//        }
        }
        
        if (document.compatMode == "CSS1Compat"){
            document.documentMode = 8; // standards mode
        }

       
        //si el explorador es igual o mayor
        
    }
    
});




