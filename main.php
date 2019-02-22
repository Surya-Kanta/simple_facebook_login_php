<?php
session_start();
require_once "Facebook/autoload.php";
$fb = new \Facebook\Facebook ( [
	'app_id' => 'paste_app_id_here',
	'app_secret' => 'paste_app_secret_here',
	'default_graph_version' => 'paste_graph_version_here'
	]);

# one example is given here
/** 
|$fb = new \Facebook\Facebook ( [
|	'app_id' => '123456789098765',
|	'app_secret' => 'abcd9efgh6ijklm4nop3qrst2uvwxy1z',
|	'default_graph_version' => 'v3.0'
|]);
*/


# this is a set of predefined permissions by the application. User needs to select some choices of this in each request.
# User can choose some or all of the permissions from this set. But he cannot choose other permissions those are not listed here.
$permissions = ['email'];

# this creates a facebook communication object to be used throughoout the session.
$helper = $fb->getRedirectLoginHelper();