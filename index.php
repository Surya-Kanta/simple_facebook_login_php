<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<?php
# this is the config file that initiates all the facebook requests
require 'main.php';

# this method checks for user logout section. when user clicks on logout, this block gets executed
if (isset($_GET['logout'])) {
    if ($_GET['logout'] == true) {
        unset($_SESSION['accessToken']);
        session_destroy();
        header('location:./');
    }
}

# after lgging in, the page can be redirected to any page after Cross forgery checking
# it gets executed only if login is successful
if (isset($_GET['code'])) {
    header('location: ./');
}

# if session has the access token, this block shows the data of the user | else shows the login button
if (isset($_SESSION['accessToken'])) {
	echo $_SESSION['id']. "<br />";
	echo $_SESSION['name']. "<br />";
	echo $_SESSION['email']. "<br />";

	echo '<a style="text-align:center; margin-top: 200px;" href="index.php?logout=true" class="btn col-3 btn-danger"><br/>LogOut</a>';

} else {
	# this method gets an access token for further processing of the user for the current session
    $accessToken = $helper->getAccessToken();
    if (isset($accessToken)) {
    	# set all the required fields according to your permissions to be fetched from API here
        $url = "/me?fields=id,name,email";

        try {
		  # Returns a `Facebook\FacebookResponse` object according to the request url
		  $response = $fb->get($url, $accessToken);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		# this method gets the user profile from the facebook response object of Facebook
		$user = $response->getGraphUser();

		# after getting user data JSON object, we can now set it or print it as wish
		$_SESSION['id'] = $user['id'];
		$_SESSION['name'] = $user['name'];
		$_SESSION['email'] = $user['email'];
        $_SESSION['accessToken'] = (string) $accessToken;
    } else {
    	# paste your redirect url that you set in developer console here.
        $loginUrl = $helper->getLoginUrl('http://localhost/simple_facebook_login_php/index.php', $permissions);
        echo '<a href="' . $loginUrl . '" class="btn col-3 btn-success" style="text-align:center;"><br/>LogIn</a><br />';
    }
}