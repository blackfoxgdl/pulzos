<?php
/**
 * Colection of function used to work with system passwords and
 * what not
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 14 February, 2011
 * @package Helpers
 **/

/**
 * Encrypt Password before saving it to Db
 * Using the preconfigured hashkey
 *
 * @param  string  Password to hash
 * @param  string  Secret passphrase
 *
 * @return string The hashed password
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 **/
function encrypt_password($password, $secret){
    return sha1($secret.$password);
}

/**
 * Check if entered password matches hashed string
 *
 * @param string password to compare in plain text
 * @param string hashed password string 
 * @param string phrase used for comparison
 *
 * @return bool result from comparison
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 **/
function check_password($password, $hashed_string, $secret){
    $password = encrypt_password($password, $secret);
    if($password === $hashed_string){
        return TRUE;
    }else{
        return FALSE;
    }
}

/**
 * do a password check before saving
 * with a password confirm no encryption at all
 *
 * @params string password to store
 * @params string password to compare to
 *
 * @return bool result from comparison
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 **/
function same_password($password, $password_check){
    if($password === $password_check){
		return TRUE;
	}
	else{
		return FALSE;
	}
}

/**
 * Generate the email for check if the 
 * confirmation and the real email
 * matches
 *
 * @params string email
 * @params string email confirmation
 *
 * @return flag true or false
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function same_email($email, $email_confirmation)
{
    if($email === $email_confirmation)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

/**
 * Generate the code for the user
 * and he can activate the account
 *
 * @params two strings, email and name
 * @return string sh1 encode
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function generate_code($email, $nombre)
{
    $time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    return sha1($email.$nombre.$time);
}
