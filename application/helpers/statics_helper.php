<?php
/**
 * Helper nadamás para cargar los archivos del header. Nada peligroso
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright axoloteDeAccion, 06 April, 2011
 * @package Core
 **/

/**
 * Agregar los estaticos necesarios en la página.
 * En realidad es retornar un string con los datos
 * ya formateados bonito.
 *
 * @param mixed $includes Array con las rutas a incluir
 *
 * @return string los headers con las etiquetas correctas.
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 **/
function agregar_statics($includes)
{
    $CI =& get_instance();
    $CI->load->helper('html');

    // generar los headers necesarios
    $headers = '';
    foreach($includes as $key=>$value)
    {
        if($key == "favicon")
        {
            $headers .= link_tag($value, 'shortcut icon', 'image/ico');
        }else{
            $headers
        }
    }
}
