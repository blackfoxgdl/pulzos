<?php
/**
 * Controller for manipulate the footer's
 * file that will be just information
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package Usuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
  
class Informacion extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('html','url','form','cyp'));
		$this->load->library(array('user_agent','session'));
	}
	
	/**
	 * Method index, void
	 * 
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function index()
	{
	}
	
	/**
	 * Method for load the view
	 * us of the footer
	 *
	 * @return string header and string content with
	 *		   the main template
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function nosotros()
	{
		if($this->session->userdata('id'))
		{
			$header = $this->load->view('header', '', TRUE);
		}
		else
		{
			$header = $this->load->view('usuarios/ingreso', '', TRUE);
		}
		$content = $this->load->view('nosotros', '', TRUE);
		$this->load->view('main/template', array('header'=>$header,
												 'content'=>$content));
	}
	
	/**
	 * Method for load the view
	 * contact where load a form
	 * that send us a email
	 *
	 * @return string header and string content with
	 *		   the main template
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function contacto()
	{
		if($this->session->userdata('id'))
		{
			$header = $this->load->view('header', '', TRUE);
		}
		else
		{
			$header = $this->load->view('usuarios/ingreso', '', TRUE);
		}
		$content = $this->load->view('contacto', '', TRUE);
		$this->load->view('main/template', array('header'=>$header,
												 'content'=>$content));
	}
	
	/**
	 * Method for show the view with
	 * the conditions for use the platform
	 *
	 * @return string header and string content with
	 *		   the main template
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function condiciones()
	{
		if($this->session->userdata('id'))
		{
			$header = $this->load->view('header', '', TRUE);
		}
		else
		{
			$header = $this->load->view('usuarios/ingreso', '', TRUE);
		}
		$content = $this->load->view('condiciones', '', TRUE);
		$this->load->view('main/template', array('header'=>$header,
												 'content'=>$content));
	}
	
	/**
	 * Method for the view
	 * of journalistic
	 *
	 * @return string header and string content with
	 *		   the main template
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function prensa()
	{
		if($this->session->userdata('id'))
		{
			$header = $this->load->view('header', '', TRUE);
		}
		else
		{
			$header = $this->load->view('usuarios/ingreso', '', TRUE);
		}
		$content = $this->load->view('prensa', '', TRUE);
		$this->load->view('main/template', array('header'=>$header,
												 'content'=>$content));
	}
	
	/**
	 * Method for show
	 * the API and the new developers
	 * can add his applications
	 *
	 * @return string header and string content with
	 *		   the main template
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function api()
	{
		if($this->session->userdata('id'))
		{
			$header = $this->load->view('header', '', TRUE);
		}
		else
		{
			$header = $this->load->view('usuarios/ingreso', '', TRUE);
		}
		$content = $this->load->view('api', '', TRUE);
		$this->load->view('main/template', array('header'=>$header,
												 'content'=>$content));
	}
	
	/**
	 * Method for show the help to
	 * the platform's user's and
	 * can resolve the doubts
	 *
	 * @return string header and string content with
	 *		   the main template
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function ayuda()
	{
		if($this->session->userdata('id'))
		{
			$header = $this->load->view('header', '', TRUE);
		}
		else
		{
			$header = $this->load->view('usuarios/ingreso', '', TRUE);
		}
		$content = $this->load->view('ayuda', '', TRUE);
		$this->load->view('main/template', array('header'=>$header,
												 'content'=>$content));
	}
	
	/**
	 * Method for show to the user
	 * the information about pulzos's
	 * blog
	 * 
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
   public function blog()
   {
   		if($this->session->userdata('id'))
		{
			$header = $this->load->view('header', '', TRUE);
		}
		else
		{
			$header = $this->load->view('usuarios/ingreso', '', TRUE);
		}
		$content = $this->load->view('blog', '', TRUE);
		$this->load->view('main/template', array('header'=>$header,
												 'content'=>$content));
   }
}
