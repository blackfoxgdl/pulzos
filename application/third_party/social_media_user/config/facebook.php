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
$config['FB_appId'] = '223599169655';//'105242036173290';
//100861549962130';//'199080933609';//308365856365'; DEPRECATED
$config['FB_secret'] = 'd62c9535008f4bb128caff76f9667523';//'690132721bf0e38bbe449c4d5208eef0';
//5bf46cab01dca6710d90bd618725f67b';//'5c0cb59abdacca3dd213a951de4db918';//411312023dd812e156cc03b5743bedc3'; DEPRECATED
$config['FB_cookie'] = FALSE;

//Facebook required permissions
$config['FB_req_perms'] = 'publish_stream,offline_access,email';

//Twitter necesary info
