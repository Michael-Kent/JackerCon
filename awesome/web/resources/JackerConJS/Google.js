var baseURL='https://www.JackerCon.com/';

function googleOnSignIn(googleUser) {
	var id_token=googleUser.getAuthResponse().id_token;
	var postData={};
	postData["googleID"]=id_token;
	$('#google-form').data('postData',postData);

	var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
		$('#google-form').submit();
		console.log('google sign out.');
    });
}
function googleOnRegister(googleUser) {
	var id_token=googleUser.getAuthResponse().id_token;
	var postData=$('#google-form-register').data('postData');
	
	postData["googleID"]=id_token;
	$('#google-form-register').data('postData',postData);

	var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
		$('#google-form-register').submit();
		console.log('google sign out.');
    });
}