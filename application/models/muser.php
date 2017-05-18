<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class MUser extends CI_Model{
		
		public function __construct()
		{
			parent::__construct(); 	
			$this->load->database();	
		}
	
		/**
		 *	This function will get the data of a certain user with
		 * 	if the eid, password are matched and if the user is still active.
		 */
		public function verify_user($eid,$password)
		{
			$this->db->where('eid',$eid);
			$this->db->where('password',$password);
			$this->db->where('is_active','1');		
			$query = $this->db->get('user');

			if($query->num_rows() > 0)
			{
				return $query;
			}
			else
			{
				return FALSE;	
			}
		}
		
		public function get_user_details($id)
		{	
			$this->db->where('id',$id);
			$query = $this->db->get('user');
			
			if($query->num_rows() > 0)
			{
				return $query;
			}
			else
			{
				return FALSE;	
			}					
		}
		
		public function update_user($id, $data) # 
		{
			$this->db->where('id',$id);
			$this->db->update('user',$data);
		}
		
		public function get_all_users($limit, $start, $capabiltity_search, $usertype_search) 
		{
			if ($capabiltity_search!='')
			{
				$this->db->where("(capability.id LIKE '%$capabiltity_search%')");
            }
			if ($usertype_search!='')
			{
				$this->db->where("(user.user_type LIKE '%$usertype_search%')");
            }
			
			$this->db->limit($limit, $start);
			$this->db->select('user.id, user.eid, career_level.title, user.user_type, capability.team, user.is_active');
			$this->db->from('user');
			$this->db->join('capability', 'user.team_id = capability.id');
			$this->db->join('career_level', 'career_level.level = user.career_level_id');
			
			$this->db->order_by("capability.id", "asc"); 
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				
				return $query->result();
			}
			$this->session->set_flashdata('message','No Resource found!');
			redirect('user/display_users','refresh');
		}
		
		public function user_count($capabiltity_search='', $usertype_search='') {
			if ($capabiltity_search!='')
			{
				$this->db->where("(capability.id LIKE '%$capabiltity_search%')");
            }
			if ($usertype_search!='')
			{
				$this->db->where("(user.user_type LIKE '%$usertype_search%')");
            }
			
			$this->db->select('user.id, user.eid, career_level.title, user.user_type, capability.team, user.is_active');
			$this->db->from('user');
			$this->db->join('capability', 'user.team_id = capability.id');
			$this->db->join('career_level', 'career_level.level = user.career_level_id');
			$this->db->order_by("capability.id", "asc"); 
			$query = $this->db->get();
			return $query->num_rows();
		}
			
		public function set_to_inactive($eid)
		{		
			$this->db->set('is_active',0);
			$this->db->where('id',$eid);
			$this->db->update('user');
		}
		
		public function set_to_active($eid)
		{		
			$this->db->set('is_active',1);
			$this->db->where('id',$eid);
			$this->db->update('user');
		}
		
		public function reset_password($eid)
		{		
			$this->db->set('password', md5('123456q!'));
			$this->db->where('id',$eid);
			$this->db->update('user');
		}
		
		public function batch_reset($idlist)
		{
			$this->db->where_in('id',`$idlist`);
			$this->db->set('password', md5('123456q!'));
			$this->db->update('user');
		}
		
		public function insert_user($data)
		{
			if($this->db->insert('user', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
		
		public function get_eid($id)
		{
			$this->db->select('id, eid');
			$this->db->from('user');
			$this->db->where('id', $id);
			$this->db->where('is_active !=', 0);
			$query = $this->db->get();
			return $query;
		}
		
		/* Manage User pagination */
		public function get_users_pages( $offset,$count,$capabiltity_search, $usertype_search )
		{
			if ($capabiltity_search!='')
			{
				$this->db->where("(capability.id LIKE '%$capabiltity_search%')");
            }
			if ($usertype_search!='')
			{
				$this->db->where("(user.user_type LIKE '%$usertype_search%')");
            }
			/*$this->db->order_by('eid', 'asc'); 
			$query = $this->db->get('user',$offset,$count);*/
			
			$this->db->limit($offset, $count);
			
			$this->db->select('user.id, user.eid, career_level.title, user.user_type, capability.team, user.is_active');
			$this->db->from('user');
			$this->db->join('capability', 'user.team_id = capability.id');
			$this->db->join('career_level', 'career_level.level = user.career_level_id');
			$this->db->order_by("capability.id", "asc"); 
			$query = $this->db->get();
			
			$config = array();
			$config['base_url'] = site_url('user/display_users');
			$config['uri_segment'] = 3;
			//$config['total_rows']= $query->num_rows();
			$num_row = $this->db->count_all('user');
			
			$config['total_rows'] = $num_row;
			$config['per_page'] = 20;
			
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
			
			return $this->pagination->create_links();	
		}
		
		public function insert_todo($data)
		{
			if($this->db->insert('to_do_list',$data))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		
		public function update_todo($data)
		{
			$this->db->set('end_date', 'NOW()', FALSE);
			$this->db->where('id',$data);
			$this->db->update('to_do_list');
		}
		
		public function get_all_todo($id)
		{

			$this->db->where("(id = '$id')");
			$this->db->where("(end_date = '')");
		
			
			$this->db->select('id, task, create_date, target_date, end_date');
			$this->db->from('to_do_list');
			$this->db->order_by("create_date", "asc"); 
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				return $query;
			}	
			else
			{	
				//$this->session->set_flashdata('message','No tasks');
				//redirect('user/user_dashboard','refresh');
				return FALSE;
			}			
		} 
	}
?>