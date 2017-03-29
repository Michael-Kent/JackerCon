<?
class MY_Controller extends CI_Controller {
	

    function __construct()
    {
        parent::__construct();
		$this->load->model('Security');
		$this->load->model('Notification'); 
		$this->load->model('NotificationCollection'); 
		$this->load->library('session');
		
		$this->data=array(
		'account'=>$this->getAccount(),
		'loggedIn'=>$this->isLoggedIn(),
		'isMod'=>$this->isModerator(),
		'isAdmin'=>$this->isAdmin()
		);
		if($this->isLoggedIn())$this->data['profile']=$this->ProfileRepository->loadFromID($this->getAccount()['id'])->toArray();
		$notifications=$this->session->userdata('notifications');
		//print_r($notifications);
    }
	
	private $data;
	
	public function getData()
	{
		return $this->data;
	}
	
	public function getAccount()
	{
		$this->load->model('AccountRepository');
		$this->load->model('ProfileRepository');
		$this->load->library('session');
		
		$acc=$this->AccountRepository->loadFromAuth(
			$this->session->userdata('auth_key')
		);
			
		$this->Security->setUserAccount($acc);
		
		if($acc!=null){
			return $acc->toArray();
		}else{
			return null;
		}
	}
	
	public function isLoggedIn()
	{
		return $this->Security->isLoggedIn();
	}
	
	public function isModerator()
	{
		return $this->Security->isMod();
	}
	
	public function isAdmin()
	{
		return $this->Security->isAdmin();
	}
	
	private $notifications=null;
	
	public function addNotification($text,$color='#F0F0F0'){
		
		if($this->notifications==null)
			$this->notifications=new $this->NotificationCollection();
		
		$note=new Notification();
		$note->setText($text);
		$note->setColor($color);
		$this->notifications->add($note);
	}
	
	public function displayNotifications(){
		if($this->notifications!==null)
			$this->load->view('shared/notification',array('notifications'=>$this->notifications->toArray()));
	}
	public function saveNotifications(){
		$this->load->library('session');
		$this->session->set_userdata('notifications',$this->notifications);
	}
	
}
?>