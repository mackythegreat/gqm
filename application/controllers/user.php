<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class User extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->CI = & get_instance();
			
			$this->load->helper(array('url','form'));
			$this->load->helper('date');
			$this->load->library('form_validation');
			$this->load->library('pagination');	
			$this->load->model('muser','m_user'); 
			$this->load->model('mproject','m_project');
			$this->load->library('session');	

			$config['upload_path'] = './assets/';
			$config['allowed_types'] = 'gif|jpg|png';
			
			
			$this->load->library('upload', $config);
			
			if (!$this->session->userdata('eid')){
				header('Location: '.site_url('login/authenticate'));
			}
		}
		
		public function user_dashboard()
		{
			if($this->session->userdata('id'))
			{
				$eid = $this->session->userdata('eid');
				$id = $this->session->userdata('id');
				$row = $this->m_user->get_user_details($id);
				$data['users_detail'] = $row->result();
				
				// get all requirements tagged to this user
				$result = $this->m_project->get_proj_req_dashbrd($id);
				if($result != FALSE)
				{
					$data['proj_req'] = $result->result();
				}
				else
				{
					$data['proj_req'] = $result;
				}
				
				
				$capabiltity_search = $this->session->userdata('team_id');
				$project_results = $this->m_project->get_all_projects('','',$capabiltity_search, '');
				$data['projects'] = $project_results->result();
				
				/* Retrieve TO-DO List */
				if($row = $this->m_user->get_all_todo($eid))
				{
					$data['todo_table'] = $row->result();
				}
				
				/* Retrieve technical design */
				
				
				$td = $this->m_project->get_all_proj_req('');
				$data['td'] = $td->result();
				
				$this->load->view('header',$data);
				$this->load->view('user_dashboard',$data);
				$this->load->view('footer',$data);
			}
			else
			{
				header('Location: '.site_url('login/authenticate'));
			}
		}
				
		public function display_users() 
		{
			if(($this->session->userdata('user_type') == 'Lead') or ($this->session->userdata('is_admin') == 1))
			{				
				$config = array();				
				$config['base_url'] = site_url('user/display_users');

				if ($this->session->userdata('is_admin') == 1)
				{
					$config['total_rows'] = $this->db->count_all('user');
				}
				else
				{
					$query = $this->db->where('team_id', $this->session->userdata('team_id'))->get('user');
					$config['total_rows'] = $query->num_rows();
				}
				
				$config['per_page'] = 10;
				$config["uri_segment"] = 3;
				$choice = $config["total_rows"]/$config["per_page"];
				$config["num_links"] = floor($choice);
				
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = '&#171';
				$config['last_link'] = '&#187';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&#139';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&#155';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				
				$this->pagination->initialize($config);

				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$team_id = '';
				if($this->session->userdata('is_admin') != 1)
				{
					$team_id = $this->session->userdata('team_id');
				}

				$data["users_table"] = $this->m_user->get_all_users($config["per_page"], $page, $team_id, '');
				$data["pagination"] = $this->pagination->create_links();

				$this->load->view('header');
				$this->load->view('display_users',$data);
				$this->load->view('footer');
			}
			else
			{
				$this->session->set_flashdata('message','You are not allowed to view this page!');
				redirect('user/user_dashboard');
			}
		}
		
		public function filter()
		{
			if(($this->session->userdata('user_type') == 'Lead') or ($this->session->userdata('is_admin') == 1))
			{
				$id = $this->session->userdata('id');
				$usr_row = $this->m_user->get_user_details($id);
				$user_data['user_detail'] = $usr_row->result();
				
				// if the user_type is lead, just display its respective resource capability_search
				if($this->session->userdata('user_type') == 'Lead' && ($this->session->userdata('is_admin') != 1)) 
				{ 
					$capabiltity_search = $this->session->userdata('team_id');
					$usertype_search = '';
				}
				else
				{
					$capabiltity_search = ($this->input->post("capability_search"))? $this->input->post("capability_search") : '';
					$capabiltity_search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $capabiltity_search;
					
					$usertype_search = ($this->input->post("usertype_search"))? $this->input->post("usertype_search") : '';
					$usertype_search = ($this->uri->segment(5)) ? $this->uri->segment(5) : $usertype_search;
				}

				// pagination settings
				$config = array();
				$config['base_url'] = site_url("user/filter/$capabiltity_search");
				$config['total_rows'] = $this->m_user->user_count($capabiltity_search,$usertype_search);
				$config['per_page'] = 10;
				$config["uri_segment"] = 4;
				$choice = $config["total_rows"]/$config["per_page"];
				$config["num_links"] = floor($choice);

				// integrate bootstrap pagination
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = 'Prev';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = 'Next';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$this->pagination->initialize($config);

				$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
				$data['users_table'] = $this->m_user->get_all_users($config['per_page'], $data['page'], $capabiltity_search,$usertype_search);
				$data['pagination'] = $this->pagination->create_links();

				//load view
				$this->load->view('header');
				$this->load->view('display_users',$data);
				$this->load->view('footer');
				
			}
			else
			{
				$this->session->set_flashdata('message','You are not allowed to view this page!');
				redirect('user/user_dashboard');
			}
		}
		
		public function change_password()
		{
			$id = $this->session->userdata('id');
			
			if($this->validate_change_password()===FALSE)
			{
				$row = $this->m_user->get_user_details($id);
				$data['user_detail'] = $row->result();
				return $this->load->view('change_user_password',$data);
			}
			else
			{
				$row = $this->m_user->get_user_details($id);
				$user_data['user_detail'] = $row->result();
				
				$data['password'] = md5($this->input->post('password'));
				$data['is_password_changed'] = 1;
				$this->m_user->update_user($id,$data);
				
				foreach ($user_data['user_detail'] as $users_item){}
				
				$this->session->set_flashdata('message','Your password has been updated!');
				if($users_item->is_admin != 0)
				{
					redirect('user/display_users');
				}
				else
				{
					redirect('user/user_dashboard');	
				}
			}
		}
		
		private function validate_change_password()
		{
			$this->form_validation->set_rules('password','Password','trim|required|min_length[5]|max_length[30]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password','trim|required|min_length[5]|max_length[30]|matches[password]');
			return $this->form_validation->run();
		}
		
		public function set_to_inactive($id=0,$eid)
		{	
			$this->m_user->set_to_inactive($id);
			$this->session->set_flashdata('message',$eid.'\'s acccount has been deactivated!');
			redirect('user/display_users');
		}
		
		public function set_to_active($id=0,$eid)
		{	
			$this->m_user->set_to_active($id);
			$this->session->set_flashdata('message',$eid.'\'s account has been reactivated!');
			redirect('user/display_users');
		}
		
		public function reset_password($id=0,$eid)
		{	
			$this->m_user->reset_password($id);
			$this->session->set_flashdata('message',$eid.'\'s password has been reset!');
			redirect('user/display_users');
		}
		
		public function batch_reset($uri = 0)
		{
			if($this->input->post('submit'))
			{ 
				if($this->input->post('id') > 0)
				{
					$arr = $this->input->post('id');
					$size = count($arr); //get the array elements
					//$user =  reset($arr); //get the first element of the array
					$idlist = implode(', ', ($this->input->post('id')));
					$this->m_user->batch_reset($idlist);
					
					
					if ($size > 1)
					{
						$this->session->set_flashdata('message',($size).' resources password have been reset!');
					}
					else
					{
						$this->session->set_flashdata('message',$user.'\' password has been reset!');
					}
					//redirect('user/display_users/'.$uri,'refresh');
				}
				else
				{
					$this->session->set_flashdata('message','No resource were selected');
					redirect('user/display_users/'.$uri,'refresh');		
				}
			}
		}
		
		public function add_user()
		{
			if(($this->session->userdata('user_type') == 'Lead') or ($this->session->userdata('is_admin') == 1))
			{
				if($this->submit_validate('')===FALSE)
				{
					$this->session->set_flashdata('message','Enterprise ID already exists!');
					redirect('user/display_users/','refresh');		
				}
				else
				{
					$data['eid'] = $this->input->post('eid');
					$data['password'] = md5('123456q!');
					$data['career_level_id'] = $this->input->post('career_level_id');
					$data['email_address'] = $data['eid'].'@accenture.com';
					$data['team_id'] = $this->input->post('team_id');
					$data['user_type'] = $this->input->post('user_type');
					$data['is_admin'] = $this->input->post('is_admin');
					$data['is_qa_rep'] = $this->input->post('is_qa_rep');

					$this->m_user->insert_user($data);
			
					$this->session->set_flashdata('message','New resource '.$data['eid'].' has been added!');
					redirect('user/display_users','refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('message','You are not allowed to view this page!');
				redirect('user/user_dashboard');
			}
			
		}
		
		private function submit_validate($eid)
		{	
			if($eid != ''){
				$is_unique =  '';
			}
			else{
				$is_unique = '|is_unique[user.eid]';  
			}
			
			$this->form_validation->set_rules('eid', 'Enterprise ID','trim|required|min_length[5]|max_length[30]'.$is_unique);
			
			return $this->form_validation->run();	
		}
		
		public function update_user($id='')
		{
			if(($this->session->userdata('user_type') == 'Lead') or ($this->session->userdata('is_admin') == 1))
			{
				$id = $this->input->post('id');
			
				if($this->submit_validate($id)===FALSE){
					$row = $this->m_user->get_user_details($id);
					$data['users_detail'] = $row->result();
					return $this->load->view('update_user',$data);
				}
				else
				{
					$id = $this->input->post('id');		
					
					$data['eid'] = $this->input->post('eid');
					$data['career_level_id'] = $this->input->post('career_level_id');
					$data['email_address'] = $data['eid'].'@accenture.com';
					$data['team_id'] = $this->input->post('team_id');
					$data['user_type'] = $this->input->post('user_type');
					$data['is_admin'] = $this->input->post('is_admin');
					$data['is_qa_rep'] = $this->input->post('is_qa_rep');
				
					$this->m_user->update_user($id, $data);
					$this->session->set_flashdata('message', $data['eid'].'\'s information has been updated');
					redirect('user/display_users');	
				}
			}
			else
			{
				$this->session->set_flashdata('message','You are not allowed to view this page!');
				redirect('user/user_dashboard');
			}
		}
		
		public function create_todo()
		{
			$data['eid'] = $this->session->userdata('eid');
			$data['title'] = $this->input->post('title');
			$data['create_date'] = date('Y-m-d');
			
			$this->m_user->insert_todo($data);
			
			$this->session->set_flashdata('message','New to-do item has been added!');
			redirect('user/user_dashboard','refresh');
		}
		
		public function complete_todo($todo_id)
		{
			$this->m_user->set_end_date($todo_id);
			
			$this->session->set_flashdata('message','to-do item marked complete');
					redirect('user/user_dashboard');
		}
		
		
		public function update_todo()
		{
			$id = $this->input->post('tsk_id');
			
			$data['title'] = $this->input->post('tsk_title');
			$data['extra_notes'] = $this->input->post('tsk_ext_notes');
			$data['target_date'] = $this->input->post('tsk_tg_date');

			
			$this->m_user->update_todo_item($id, $data);
			
			redirect('user/user_dashboard');	
		}
	}
?>