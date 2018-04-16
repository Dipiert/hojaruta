<?php

class SessionController {
    
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
    }

    public function getUsername() {
        return $_SESSION['username'];
    }

    public function login($username, $isAdmin) {
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
        $_SESSION['admin'] = $isAdmin;
	}

    public function isAdmin() {

    }
    
    public function getAdmins() {
        
    }

}