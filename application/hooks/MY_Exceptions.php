<?php if( ! defined('BASEPATH')) exit('No direct script access allowed.');

class MY_Exceptions extends CI_Exceptions
{
    function MY_Exceptions()
    {
        parent::CI:Exceptions();
    }

    function show_404($page = '')
    {
        echo "test";
    }
}
