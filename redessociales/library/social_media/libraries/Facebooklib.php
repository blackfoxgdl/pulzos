<?php
/**
 * Library to handle everything Facebook related on
 * the pulzos platform
 *
 * @author axoloteDeAccion
 * @version 0.1
 * @copyright axoloteDeAccion, 17 February, 2011
 * @package Social Media
 **/

//first load libs
require_once('libs/Facebook_new.php');

class Facebooklib{
    //The Facebook api object
    private $facebook;
    //Extra params for the login page
    private $extra_params;
    //UID of facebook user
    public $uid = "";
    public $accessToken = "";
    //Basic data of current Facebook user
    private $me = array();
    //Session info
    private $session = "";

    /**
     * Constructor. Set every variable necesary for the class
     * Automatically from config file
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function __construct(){
        //load config file 
        $ci =& get_instance();
        $config = $ci->load->config('facebook');
        //prepare data to use in object
        $fb['appId'] = $ci->config->item('FB_appId');
        $fb['secret'] = $ci->config->item('FB_secret');
        $fb['cookie'] = $ci->config->item('FB_cookie');
        //load requred permissions in member
        $this->extra_params['scope'] = $ci->config->item('FB_req_perms');//req_perms'] = $ci->config->item('FB_req_perms');

        //create Facebook object
        $this->facebook = new Facebook($fb);
    }

    /**
     * Get Url to login to Facebook with the necesary permissions
     *
     * @return string link to facebook login
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get_login_url(){
        /*$loginUrl = $this->facebook->getLoginUrl(array(
                                                    'scope'=>'publish_stream,offline_access,email'
                                                    ));//$this->extra_params['scope']);
         */
        return $this->facebook->getLoginUrl($this->extra_params);
    }

    public function get_login_url2()
    {
        $loginUrl = $this->facebook->getLoginUrl(array(
                                                    'scope'=>'publish_stream,offline_access,email'
                                                    ));//$this->extra_params['scope']);
    }

    /**
     * Metodo que se usa para obtener la url en caso de que el usuario no este logueado en
     * facebook para recuperar su token y que pueda ligar su facebook con la red social
     * mas vergas, PULZOS.COM
     *
     * @return string diversos datos
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_user()
    {
        $session = $this->facebook->getUser();
        if($session)
        {
            try{
                $user_profile = $this->facebook->api('/me');
                $this->accessToken = $this->facebook->getAccessToken();

                if($session)
                {
                    $logoutUrl = $this->facebook->getLogoutUrl();
                }
                else
                {
                    $loginUrl = $this->facebook->getLoginUrl(array(
                                                            'scope'=>'publish_stream,offline_access,email'
                                                            ));//$this->extra_params['scope']);
                }   

                if($session)
                {
                     $loginUrl = $this->facebook->getLoginUrl(array(
                                                            'scope'=>'publish_stream,offline_access,email'
                                                            ));//$this->extra_params['scope']);
                    return $loginUrl;
                }

            } 
            catch (FacebookApiException $e){
                error_log($e);
                $session = null;
            } 
        }
        else
        {
            return $this->facebook->getLoginUrl(array(
                                                    'scope'=>'publish_stream,offline_access,email'
                                                ));//$this->extra_params['scope']);        
        } 
    }

    /**
     * Get logout Url. You should make this a toggle or something
     *
     * @return string Logout URL
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get_logout_url()
    {
        return $this->facebook->getLogoutUrl();
        //return $this->facebook->getLogoutUrl();
    }

    /**
     * Get current Facebook user if it exists. If not
     * return exception and try again
     *
     * @return mixed Could be FALSE, could be the userinfo array 
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get_facebook_user(){
        $this->session = $this->facebook->getSession();
        if($this->session){
            try{
                $this->uid = $this->facebook->getUser();
                $this->me = $this->facebook->api('/me');
                return $this->facebook->getLogoutUrl();
            }catch(FacebookApiException $e){
                log_message('error', $e);
            }
        }else{
            return $this->facebook->getLoginUrl($this->extra_params);
        }
    }

    /**
     * Function to recover data from the $me array without any errors
     *
     * @params string name of the property to return
     * @return mixed data asked for in the parameter
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function me($key){
        if (isset($this->me[$key])){
            return $this->me[$key];
        }else{
            return "";
        }
    }
    
    /**
     * function to recover data from Session array and never return error
     *
     * @params string required data
     *
     * @return mixed required data
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function session($key){
        if(isset($this->session[$key])){
            return $this->session[$key];
        }else{
            return "";
        }
    }

    /**
     * Post to current users wall
     *
     * @param long the UID of current User
     * @param mixed data needed for the post to proceed
     *
     * @return mixed whatever the result is
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function post_wall($uid, $data){
        return $this->facebook->api("/$uid/feed", 'post', $data);
    }

    /**
     * Post in wall of facebook's users with the new oauth 2.0
     *
     * @params string token user access
     * @params string message to show in facebook
     *
     * @return i don't know what return facebook
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function post_wall_2($token, $message, $link = null)//post_wall_new($token, $message)
    {
        /*echo "holas"; 
        $access_token = "AAABbu6jbY5IBAJZCyEZA2mY5qRCqmS0Ql3rsKfcsfeuvmZB0qorxBVdFZABpZAqPNa4VZBbLEZCVCzZBBg29fZAFdIdxUkH7Tp7MZD";*/
        $this->facebook->setAccessToken($token);
        $user_id = $this->facebook->getUser();
        var_dump($user_id);
        if($user_id)
        {
            if(!empty($link))
            {
                echo "hola: " . $link;
                return $this->facebook->api('/me/feed', 'POST', array(
                                         'link' => "www.youtube.com/watch?v=cU69BalaI80&feature=feedrec_grec_index",
                                         'message' => 'Foto cargada desde facebook',
                                         )
                                      );
                /*
                return $this->facebook->api("/me/feed", 'POST',
                                            array(
                                             // 'link' => 'www.pulzos.com',
                                              'message' => $message//'y el logueo o ligar tu social media tambien :D'
                                          ));*/
            }
            else
            {
                echo "holas";
                return $this->facebook->api('/me/feed', 'POST', array(
                                         'link' => "www.youtube.com/watch?v=cU69BalaI80&feature=feedrec_grec_index",
                                         'message' => 'Foto cargada desde facebook',
                                         )
                                      );
            }
        }
    }
}
