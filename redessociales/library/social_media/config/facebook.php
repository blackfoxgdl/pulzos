<?php 
/**
* Configuration Files for social media connections
* Allow a separation between controller and external 
* logic in a nicely packaged thing
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 17 February, 2011
 * @package Social Media
 **/

//Facebook necesary info
$config['FB_appId'] = '100861549962130';//'199080933609';//308365856365';
$config['FB_secret'] = '5bf46cab01dca6710d90bd618725f67b';//'5c0cb59abdacca3dd213a951de4db918';//411312023dd812e156cc03b5743bedc3';
$config['FB_cookie'] = FALSE;

//Facebook required permissions
$config['FB_req_perms'] = 'publish_stream,offline_access,email';

//Twitter necesary info
