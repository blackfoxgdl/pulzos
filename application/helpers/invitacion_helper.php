<?php
/**
 *
 *
 *
 *
 **/

function invitacion($cadena)
{
    $arreglo = array('cafe', 'cafes', 'cafeteria', 'cafeteras', 'cerveza', 'cerveceria', 'cervezas', 'pastel', 'pasteleria', 'pasteles', 'mariscos', 'camaron', 'camarones', 'pescado', 'comida china', 'china', 'comida mexicana', 'mexicana', 'sopes', 'flautas', 'quesadillas', 'chela', 'carne', 'totopos', 'cortes', 'vino', 'vinos', 'tequila', 'tequilas', 'vodka', 'vodkas', 'camarones', 'pescados', 'cocktail', 'cocktails', 'pulpo', 'diabla', 'bebidas', 'postre', 'postres', 'mariachi', 'caballitos', 'caballito', 'pizza', 'pizzas', 'baguettes', 'baguette', 'platillo', 'platillos', 'variedad', 'variedades');

    $arreglo1 = explode(" ", $cadena);
    foreach($arreglo1 as $a1)
    {
        foreach($arreglo as $a2)
        {
            if($a1 == $a2)
            {
                return $a2;
                die();
            }
        }
    }
}

/**
 * Metodo en el que se vera cual palabra pertenece a
 * que y que recomendaciones se haran para lo que
 * desea el usuario
 *
 * @params string palabra clave
 * @return string palabra del giro
 **/
function palabras_giro($palabra)
{
    if($palabra == 'cafe' || $palabra == 'cafes' || $palabra == 'cafeteria' || $palabra == 'cafeteras')
    {
        return 'Cafeteria';
    }
    if($palabra == 'cerveza' || $palabra == 'cerveceria' || $palabra == 'cervezas' || $palabra == 'vino' || $palabra == 'chela' || $palabra == 'tequila' || $palabra == 'tequilas' || $palabra == 'vino' || $palabra == 'vinos' || $palabra == 'vodka' || $palabra == 'vodkas' || $palabra == 'bebida' || $palabra == 'mairachi' || $palabra == 'caballito' || $palabra == 'caballitos' || $palabra == 'baguette' || $palabra == 'pizza' || $palabra == 'baguettes' || $palabra == 'pizzas' || $palabra == 'variedad' || $palabra == 'platillo' || $palabra == 'platillos' || $palabra == 'variedades')
    {
        return 'Restaurant Bar';
    }
    if($palabra == 'pastel' || $palabra == 'pasteleria' || $palabra == 'pasteles' || $palabra == 'postre' || $palabra == 'postres')
    {
        return 'Reposteria';
    }
    if($palabra == 'mariscos' || $palabra == 'camarones' || $palabra == 'pescado' || $palabra == 'camaron' || $palabra == 'camarones' || $palabra == 'pescados' || $palabra == 'cocktail' || $palabra == 'cocktails' || $palabra == 'pulpo' || $palabra == 'diabla')
    {
        return 'Mariscos';
    }
    if($palabra == 'comida china' || $palabra == 'china')
    {
        return 'Comida China';
    }
    if($palabra == 'comida mexicana' || $palabra == 'sopes' || $palabra == 'mexicana' || $palabra == 'flautas' || $palabra == 'quesadillas' || $palabra == 'carne' || $palabra == 'totopos' || $palabras == 'cortes')
    {
        return 'Comida Mexicana';
    }
}
