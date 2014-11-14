<?php if( ! defined('BASEPATH')) exit('No direct access script allowed.');

class OOR_Exceptions extends CI_Exceptions
{
    public function show_error($heading, $message, $template, $status_code = 404)
    {
        ci =& get_instance();

        if(! $page = $ci->uri->uri_string())
        {
            $page = 'home';
        }
        switch($status_code)
        {
            case 403: $heading = 'Access Forbidden'; break;
            case 404: $heading = 'Page'; break;
            case 503: $heading = 'Undergoing Maintenance'; break;
        }

        log_message('error', $status_code . ' ' . $heading . '---->' . $page);
        return parent::show_error($heading, $message, 'error_general', $status_code);
    }

    function show_404($page = '')
    {
        echo "puta madre funciona";
    }
}
