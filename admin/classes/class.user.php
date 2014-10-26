<?php 
/**
* Main User class
* 
* @version 0.01
*/

class User extends database
{
	public $error;

	public function __construct()
	{
		parent::__construct();
	} // end of __construct

	/**
	 * Login user and set sessions if givin credentials are in database
	 * @param  array $credentials probably posted form data
	 * @return boolean              
	 */
	public function do_login($credentials)
	{	
//echo sha1(sha1(SALT.$credentials['user_pass'])); exit;
		$this->where('user_name', $credentials['user_name']);
		$this->where('user_pass', sha1(sha1(SALT.$credentials['user_pass'])));
		$this->get('users');
		
		$result = $this->result();
		unset($result->user_pass);

		if ($this->row_count() > 0) {

			$this->logout();

			$_SESSION['is_logged_in'] = true;
			$_SESSION['current_user'] = $result;

			return true;
		}

		return false;
	} // do_login

	/**
	 * Logout user
	 * Unset global $_SESSION variable
	 * Destroy all sessions
	 * Initialize session again
	 * @return boolean
	 */
	function logout()
	{
		session_unset($_SESSION);
		session_destroy();
		session_start();
		$_SESSION['is_logged_in'] = false;
		return true;
	} // logout

	/**
	 * Check logged in status
	 * @param  boolean $redirect Redirect to login page if true
	 * @return boolean           
	 */
	public static function is_logged_in($redirect = true)
	{
		if ($_SESSION['is_logged_in'] != true) {

			self::logout();

			if ($redirect) {
				header('Location:login.php');
			}
			return false;
		}
		return true;
	} // is_logged_in

	


} // end of class
?>