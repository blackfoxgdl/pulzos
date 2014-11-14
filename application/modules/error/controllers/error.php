<?php if(! defined('BASEPATH')) exit('No direct Script Access allowed');
/**
 * Controlador de personalizacion
 * de error 404 al momento de que
 * la url no exista o este incorrecta
 *
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright Zavordigital February 22, 2011
 * @package Core
 **/	
class Error extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html'));
	}
	
	/**
	 * Metodo index para que se
	 * cargue la vista personalizada
	 * de los errores 
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	function index()
	{
		$header = $this->load->view('header', '', TRUE);
		$content = $this->load->view('error', '', TRUE);
		$this->load->view('main/template', array('header'=>$header,
												 'content'=>$content));
	}
}
