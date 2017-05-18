<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Class to login or logout as well as authenticate the user
	 * 
	 * @method index 
	 * @method authenticate
	 * @method submit_validate
	 * @method logout
	 */
	class Login extends CI_Controller{
	
		/**
		 * @method __construct
		 * 		Costructor of this class. Use to load all required helpers, libraries and model
		 */
		public function __construct(){	
			parent::__construct();
			
			$this->load->helper('form'); 				// Load form helper library
			$this->load->helper('url'); 				// Load url helper library
			$this->load->library('form_validation'); 	// Load form validation library
			$this->load->library('session'); 			// Load session library
			$this->load->model('muser'); 				// Load database model
			$this->load->helper('security');			// Load use xss_clean
			
			if ($this->session->userdata('eid')){
				header('Location: '.site_url('user/user_dashboard'));
			}
		}
			
		/**
		 * @method index
		 * 		Load and display login_page.php located at /application/views/
		 */
		public function index(){
			$this->load->view('header'); 
			$this->load->view('login_page'); 
			$this->load->view('footer'); 
		}
		
		/**
		 * @method authenticate
		 * 		Validates the credentials of the user and redirect on its respective 
		 */
		public function authenticate()
		{	
			if($this->submit_validate()===FALSE)
			{
				return $this->index();
			}
			else
			{
				$eid = $this->input->post('eid');
				$password = md5($this->input->post('password'));
		
				if($row = $this->muser->verify_user($eid,$password))
				{
					$data['user_detail'] = $row->result();

					foreach($data['user_detail'] as $user_item){
						$_SESSION['id'] = $user_item->id;
						$_SESSION['eid'] = $user_item->eid;
						$_SESSION['user_type'] = $user_item->user_type;
						$_SESSION['is_admin'] = $user_item->is_admin;
						$_SESSION['is_qa_rep'] = $user_item->is_qa_rep;
						$_SESSION['team_id'] = $user_item->team_id;
					}
					
					if($user_item->is_password_changed != 1)
					{
						redirect('user/change_password');
					}
					
					/*$this->session->set_userdata($user_item->eid);
					$this->session->set_userdata($user_item->user_type);
					$this->session->set_userdata($user_item->is_admin);
					$this->session->set_userdata($user_item->is_qa_rep);*/
					
					/*if ($user_item->is_admin == 1)
					{
						redirect('user/display_users',$this->session->set_userdata($user_item->eid));
					}
					else
					{
						redirect('user/user_dashboard',$this->session->set_userdata($user_item->eid));								
					}*/	
					redirect('user/user_dashboard',$this->session->set_userdata($user_item->eid));	
				}
				else
				{
					$this->session->set_flashdata('error','Invalid Enterprise ID or Password');	
					redirect('login/authenticate','refresh');
				}		
			}
		}
		
		public function logout()
		{
			$this->session->set_flashdata('error','You have been logged out!');
			$this->session->unset_userdata('id');
			$this->session->unset_userdata('eid');
			$this->session->unset_userdata('user_type');
			$this->session->unset_userdata('is_admin');
			$this->session->unset_userdata('is_qa_rep');
			$this->session->unset_userdata('team_id');
			
			redirect('login/authenticate','refresh');
		}
		
		private function submit_validate()
		{
			$this->form_validation->set_rules('eid','Enterprise ID','trim|required|min_length[5]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('password', 'Password','trim|required|min_length[5]|max_length[30]|xss_clean');
			return $this->form_validation->run();
		}
	}
?>