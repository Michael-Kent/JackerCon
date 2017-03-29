<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account  extends MY_Controller {
	public $apiResponse;
	
	
   function __construct() {
       parent::__construct();
		$this->load->model('ApiResponse');
		$this->apiResponse= new ApiResponse();
		$this->load->model('AccountRepository');
   }
	
	public function index(){
		
		$data=$this->getData();
		
		$this->load->view('shared/header');
		
		$this->load->view('shared/navigation',$data);
		$this->load->view('shared/notification',array('notification'=>$this->input->post('notification')));
		
		$this->load->view('documentation/account');	
		
		
		$this->load->view('shared/footer');
	}
	
	public function Test($username){
		if(!$this->isAdmin())return;
		$this->load->model('Security');
		
		$acc=$this->AccountRepository->loadFromUsername($username);
		if($acc!=null){
			$acc=$this->AccountRepository->updateAuthKey($acc);
			$this->Security->setUserAccount($acc);	
		}
		
		if($this->Security->isLoggedIn()){
			
			if($acc->getVerify()){
				$this->apiResponse->setMessage(
					'#notification'
					,
					'you are successfully logged in.'
				);
				$this->apiResponse->setSuccess(true);
				$this->apiResponse->setRedirectPage(base_url());
			}else{
				$this->apiResponse->setMessage(
					'#notification'
					,
					'The email address for this account hasnt been verified yet.'
				);
				$this->apiResponse->setSuccess(false);
			}
		}else{
				$this->apiResponse->setMessage(
					'#notification'
					,
					'no account was found with those credentials'
				);
				$this->apiResponse->setSuccess(false);
		}

		$this->apiResponse->showResponse();
	}
	
	/*
	Auth
	Post('password','email');
	return apiResponse
	*/
	public function Auth()
	{
		
		$this->load->model('Security');
		
		$acc=$this->AccountRepository->loadFromPasswordEmail(
			$this->input->post('password'),
			$this->input->post('email')
			);
		if($acc!=null){
			$acc=$this->AccountRepository->updateAuthKey($acc);
			$this->Security->setUserAccount($acc);	
		}
		
		if($this->Security->isLoggedIn()){
			
			if($acc->getVerify()){
				$this->apiResponse->setMessage(
					'#notification'
					,
					'you are successfully logged in.'
				);
				$this->apiResponse->setSuccess(true);
				$this->apiResponse->setRedirectPage(base_url());
			}else{
				$this->apiResponse->setMessage(
					'#notification'
					,
					'The email address for this account hasnt been verified yet.'
				);
				$this->apiResponse->setSuccess(false);
			}
		}else{
				$this->apiResponse->setMessage(
					'#notification'
					,
					'no account was found with those credentials'
				);
				$this->apiResponse->setSuccess(false);
		}

		$this->apiResponse->showResponse();
		
	}
	
	public $CLIENT_ID=$this->config->item('google_client_id');
	
	public function Google(){
		$this->load->model('Security');
		
		$google=new Google_Client(['client_id' => $this->CLIENT_ID]);
$payload=false;
		if($this->input->post('googleID')!==null)
			$payload = $google->verifyIdToken($this->input->post('googleID'));
		if ($payload) {
			$userid = $payload['sub'];
			$acc=null;
			if($this->Security->isLoggedIn()){
				$acc=$this->Security->getUserAccount();
			}
			if($acc==null){
			$acc=$this->AccountRepository->loadFromGoogleID(
				$userid
				);
			}
			if($acc==null){
				$acc=$this->AccountRepository->loadFromEmail(
					$payload['email']
					);
			}
			if($acc!=null){
				$acc=$this->AccountRepository->updateAuthKey($acc);
				$this->Security->setUserAccount($acc);				
			}
			
			if($this->Security->isLoggedIn()){
				$acc->setGoogleID($userid);
				$this->AccountRepository->saveAcc($acc);
				$this->apiResponse->setMessage(
					'#notification'
					,
					'you are successfully logged in with google.'
				);
				$this->apiResponse->setSuccess(true);
				$this->apiResponse->setRedirectPage(base_url());
			}else{
				$this->apiResponse->setMessage(
					'#notification'
					,
					'No JackerCon account has been found for your google account.'
				);
				$this->apiResponse->setSuccess(false);
				
				//return $this->google_insert();
				
			}
		}else{
			
		$this->apiResponse->setMessage(
				'#notification'
				,
				'No Google account has been found.'.$this->input->post('googleID')
			);
			$this->apiResponse->setSuccess(false);
		}

		$this->apiResponse->showResponse();
	
	}

	/*
	Logout
	
	no post data
	*/
	
	public function Logout(){
		
		
		$this->AccountRepository->signOut();
		
		if($this->Security->isLoggedIn()){
				$this->apiResponse->setMessage(
					'#notification'
					,
					'Log out unsuccesful, please check if you are logged in and try again.'
				);
				$this->apiResponse->setSuccess(false);
		}else{
				$this->apiResponse->setMessage(
					'#notification'
					,
					'you are successfully logged out.'
				);
				$this->apiResponse->setSuccess(true);
				$this->apiResponse->setRedirectPage(base_url());
		}
		
		$this->apiResponse->showResponse();
	}
	
	private function setAccount($username,$name,$surname,$password,$email,$googleID=null){
		
		$acc= $this->AccountFactory->createAccount();
		
			if(!$acc->setUsername($username)){
				$this->apiResponse->setMessage('#notification','username not received.');
				$this->apiResponse->setSuccess(false);
			}
			if(!$acc->setFirstName($name)){
				$this->apiResponse->setMessage('#notification','name not received.');
				$this->apiResponse->setSuccess(false);
			}
			if(!$acc->setLastName($surname)){
				$this->apiResponse->setMessage('#notification','surname not received.');
					$this->apiResponse->setSuccess(false);
			}
			if(!$acc->setPassword($password)){
				$this->apiResponse->setMessage('#notification','password not received.');
				$this->apiResponse->setSuccess(false);
			}
			if(!$acc->setGoogleID($googleID)){
				$this->apiResponse->setMessage('#notification','google id not set.');
				$this->apiResponse->setSuccess(true);
			}
			if(!$acc->setEmail($email)){
				$this->apiResponse->setMessage('#notification','email not received.');
				$this->apiResponse->setSuccess(false);
			}
		return $acc;
	}
	
	/* Insert
	
	post(username,firstname,surname,password,email);
	*/
	public function Insert()
	{
		$this->load->model('AccountFactory');
		$this->load->model('EmailLinkRepository'); 
		$this->load->model('EmailLinkFactory'); 
		$this->load->model('EmailLink'); 
		$this->load->library('session');
		$this->load->library('email');
		
				
		$this->apiResponse->setSuccess(true);
		
		$acc=$this->setAccount($this->input->post('username'),
			$this->input->post('firstname'),
			$this->input->post('surname'),
			$this->input->post('password'),
			$this->input->post('email'));
		
		if($this->apiResponse->getSuccess())
			$this->AccountRepository->insertAcc($acc);
			
		
		
		if($this->Security->isLoggedIn()){//check queries didnt fuck up
			if(!$acc->getVerify()){
				$this->email->from('no-reply@JackerCon.com');
				$this->email->to($acc->getEmail());
				$this->email->subject('Your account at online-projects has been created');

				$emailLink=$this->EmailLinkFactory->createEmailLink();
				$emailLink->setAction('verify');
				$emailLink->setAccountID($acc->getID());
					$this->EmailLinkRepository->insertEmailLink($emailLink);
				$this->email->message(
					$this->load->view('email/insert_acc',array('acc'=>$acc,'emailLink'=>$emailLink),true).
					$this->load->view('email/footer',array('acc'=>$acc),true)
					);
				
				if ( ! $this->email->send())
				{
					$this->apiResponse->setMessage(
						'#notification'
						,
						'There was an issue sending your verification email.'
					);
					$this->apiResponse->setSuccess(false);
					$this->apiResponse->setMessage(
						'#debug'
						,
						$this->email->print_debugger()
					);
				}else{
					$this->apiResponse->setMessage(
						'#notification'
						,
						'Your account has been created, you have been sent an email, you will need to click the link to verify your email.'
					);
					$this->apiResponse->setRedirectPage(base_url());
					$this->apiResponse->setSuccess(true);
				}
			}
			$this->AccountRepository->signOut();
				
				
		}else{
				$this->apiResponse->setMessage(
					'#notification'
					,
					'Account creation failed, please ensure you have entered all required details.'
				);
				$this->apiResponse->setSuccess(false);
		}
		$this->apiResponse->showResponse();
	}

	public function google_insert(){
		$this->load->model('Security');
		$this->load->model('ProfileRepository');
		
		$this->apiResponse= new ApiResponse();
		
		$this->apiResponse->setSuccess(true);
		
		$google=new Google_Client(['client_id' => $this->CLIENT_ID]);


		$payload = $google->verifyIdToken($this->input->post('googleID'));
		if ($payload) {
			$userid = $payload['sub'];
			
			$acc=$this->setAccount($this->input->post('username'),
					$payload['given_name'],
					$payload['family_name'],
					$this->input->post('password'),
					$payload['email'],
					$userid);
			$acc->setVerify($payload['email_verified']);
				
			if($this->apiResponse->getSuccess())
				$this->AccountRepository->insertGoogleAcc($acc);
					
				
				
			$acc=$this->AccountRepository->loadFromGoogleID($userid);
			
			if($acc!=null){
				$profile=$this->ProfileRepository->loadFromID($acc->getID());
				$profile->setImageLink($payload['picture']);
				$this->ProfileRepository->updateProfile($profile);
				
				$acc=$this->AccountRepository->updateAuthKey($acc);
				$this->Security->setUserAccount($acc);
			
				if($this->Security->isLoggedIn()){
					
					if($acc->getVerify()){
						$this->apiResponse->setMessage(
							'#notification'
							,
							'You are successfully logged in.'
						);
						$this->apiResponse->setSuccess(true);
						$this->apiResponse->setRedirectPage(base_url());
					}else{
		
					$this->email->from('no-reply@JackerCon.com');
						$this->email->to($acc->getEmail());
						$this->email->subject('Your account at online-projects has been created');

						$this->email->message('you dont need to do anything else.'.
							$this->load->view('email/footer',array('acc'=>$acc),true)
							);
						
						if ( ! $this->email->send())
						{
							$this->apiResponse->setMessage(
								'#notification'
								,
								'Your account has been created, but there was an issue sending your verification email.'
							);
							$this->apiResponse->setSuccess(false);
							$this->apiResponse->setMessage(
								'#debug'
								,
								$this->email->print_debugger()
							);
						}else{
							$this->apiResponse->setMessage(
								'#notification'
								,
								'Your account has been created, you have been sent an email, you will need to click the link to verify your email.'
							);
							$this->apiResponse->setRedirectPage(base_url());
							$this->apiResponse->setSuccess(true);
						}
						

						$this->AccountRepository->signOut();
					}
				}else{
					$this->apiResponse->setMessage('#notification',
						'There was an issue creating an account.'
					);
					$this->apiResponse->setSuccess(false);
				}
			}else{
					$this->apiResponse->setMessage('#notification',
						'There was an issue creating an account. (issue 2)'
					);
					$this->apiResponse->setSuccess(false);
			}
		}else{
					$this->apiResponse->setMessage('#notification',
						'There was an issue connecting to google.'
					);
					$this->apiResponse->setSuccess(false);
			}
		$this->apiResponse->showResponse();
	}

	public function update(){
		$this->load->model('ProfileRepository');
		
		
		if($this->isLoggedIn()){
			$acc=$this->Security->getUserAccount();
			
			$profile=$this->ProfileRepository->loadFromID($acc->getId());
			
			if(!$acc->setFirstName($this->input->post('firstname'))){
				//not set
			}
			if(!$acc->setLastName($this->input->post('surname'))){
				//not set
			}
			if($this->input->post('username')!=null){
				$username=preg_replace('/[^0-9a-zA-Z_]/',"",$this->input->post('username'));
				$usernameAvaliable=$this->ProfileRepository->loadFromUsername($username)==null;
				if($usernameAvaliable&&strlen($username)>3){
					if(!$acc->setUsername($this->input->post('username'))){
						//not set
					}
				}
			}
			if(!$profile->setImageLink($this->input->post('imageUrl'))){
				//not set
			}
			if(!$profile->setAboutMe($this->input->post('aboutMe'))){
				//not set
			}
			$this->ProfileRepository->updateProfile($profile);
			$this->AccountRepository->saveAcc($acc);
				$this->apiResponse->setMessage(
					'#notification'
					,
					'Your details have been updated.'
				);
				$this->apiResponse->setSuccess(true);
		}else{
				$this->apiResponse->setMessage(
					'#notification'
					,
					'You must be logged in to change these details.'
				);
				$this->apiResponse->setSuccess(false);
			
		}
		$this->apiResponse->showResponse();
	}
	
	public function Username_Avaliable($username=''){
		$this->load->model('ProfileRepository');
		$username=preg_replace('/[^0-9a-zA-Z_]/',"",$username);
		$usernameAvaliable=$this->ProfileRepository->loadFromUsername($username)==null;
		$this->apiResponse->setSuccess($usernameAvaliable&&strlen($username)>3);
		
		$this->apiResponse->showResponse();
	}
	
	public function Password_Reset(){
		$this->load->model('EmailLinkRepository');
		$this->load->model('EmailLink');
		$this->load->model('Security');
		$this->load->model('AccountRepository');
		
		$acc=null;
		
		$code=$this->input->post('code');
		$emailLink=$this->EmailLinkRepository->loadFromCode($code);
		if($emailLink!==null)
			$acc=$this->AccountRepository->loadFromID($emailLink->getAccountID());
		
		$password=$this->input->post('password');
		$passwordConfirm=$this->input->post('passwordconfirm');
		
		
		if($acc!==null&&$password==$passwordConfirm){
			$acc=$this->AccountRepository->updateAuthKey($acc);
			
			$acc->setPassword($this->Security->salt_hash_password($password,$acc->getEmail()));
			$this->AccountRepository->saveAccPass($acc);
			$this->EmailLinkRepository->deleteEmailLink($emailLink);
			$this->apiResponse->setMessage(
				'#notification'
				,
				'Your password have been updated.'
			);
			$this->apiResponse->setRedirectPage(base_url());
			$this->apiResponse->setSuccess(true);
		}else{
			$this->apiResponse->setMessage(
				'#notification'
				,
				'We have encountered an issue trying to complete this action, please ensure all details are correct.'
			);
			$this->apiResponse->setSuccess(false);
		}
		$this->apiResponse->showResponse();
	}
	
	public function AddComment($targetID=null){
		$this->load->model('GameRepository'); 
		$this->load->model('CommentRepository'); 
		$this->load->model('ProfileRepository');
		$this->load->model('AccountRepository');
		$this->load->model('CommentFactory'); 
			
		$account=$this->AccountRepository->loadFromID($targetID);
		$acc=$this->getAccount();
		$accountID=$acc['id'];
				
		if($account!==null){
			$comment=$this->CommentFactory->createComment();
			$comment->profile_id=$accountID;
			$comment->profile=$this->ProfileRepository->loadFromID($accountID);
			$comment->target_id=$account->getID();
			
			$comment->comment=$this->input->post('comment');
			$comment->target_table='profile-comments';
			$comment->target_feild='account_id';
			$this->CommentRepository->insertComment($comment);
					$this->apiResponse->setMessage(
						'#notification'
						,
						$acc['username'].'\'s comment has been added to this profile'
					);
					$this->apiResponse->setSuccess(true);
					$this->apiResponse->setRedirectPage(base_url('Profile/Search/'.$account->getUsername()));
		}//else account not found.
		$this->apiResponse->showResponse();
	}
}