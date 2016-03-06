<?php   
session_start(); //to ensure you are using same session
if(isset($_SESSION)) {
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],
              $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
    print('<meta charset= "utf-8" />');
    print('<script>alert("Vous vous êtes déconnecté. Redirection vers la page de connexion.");</script>');
    print('<meta http-equiv="refresh" content="0;url=index.php" />'); //to redirect back to "index.php" after logging
    exit();
}
?>