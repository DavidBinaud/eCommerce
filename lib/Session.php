<?php
	class Session {
	    public static function is_user($login) {
	        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
	    }


	    public static function is_admin() {
   		 	return (!empty($_SESSION['admin']) && $_SESSION['admin']);
		}


		public static function time_reset_panier($time){
			if (isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] > $time) {
		     	// if last request was more than $time/60  minutes ago
		     	// unset $_SESSION variable for the run-time
		     	unset($_SESSION['panier']);     
	     	}
	 	}


	 	public static function check_last_activity($time){
			if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $time)) {

		     	// if last request was more than $times/60 minutes ago
		     	session_unset();     // unset $_SESSION variable for the run-time 
		     	session_destroy();   // destroy session data in storage
		 	} else {
		     	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
		 	}
	 	}

		
	}
?>