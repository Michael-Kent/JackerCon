<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google extends MY_Controller 
{
	
	
	public function index()
	{




	?>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="72091352785-7ios0f6p4d2jp39u4pissgnsq0d5vkd0.apps.googleusercontent.com">
<div class="g-signin2" data-onsuccess="onSignIn"></div>
<script>
function onSignIn(googleUser) {
  var id_token = googleUser.getAuthResponse().id_token;
  var profile = googleUser.getBasicProfile();
  console.log('ID-Token: ' + id_token);
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
}
</script>

<a href="#" onclick="signOut();">Sign out</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
<?

	}

	public $google;
	public $CLIENT_ID=$this->config->item('google_client_id');
	public function token($id){
		$this->google=new Google_Client(['client_id' => $this->CLIENT_ID]);


		$payload = $this->google->verifyIdToken($id);
		if ($payload) {
		  $userid = $payload['sub'];
		  // If request specified a G Suite domain:
		  //$domain = $payload['hd'];
		  print_r($payload);
		  
		} else {
		  print_r($payload);
		  echo 'invalid';
		  // Invalid ID token
		}		
	}
}