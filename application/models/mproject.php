<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class MProject extends CI_Model{
		
		public function __construct()
		{
			parent::__construct(); 	
			$this->load->database();	
		}
		
		public function get_all_projects($limit, $start, $capabiltity_search, $status_search) 
		{
			if ($capabiltity_search!='')
			{
				$this->db->where("(capability.id LIKE '%$capabiltity_search%')");
            }
			if ($status_search!='')
			{
				$this->db->where("(project.status LIKE '%$status_search%')");
            }
			
			$this->db->limit($limit, $start);
			$this->db->select('project.proj_id as proj_id, project.proj_name as proj_name, capability.team as team, project.start_date as start_date, project.end_date as end_date, project.status as status');
			$this->db->from('project');
			$this->db->join('capability', 'project.capability_id = capability.id');
			$this->db->order_by("project.proj_id", "desc"); 
			
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				
				return $query;
			}
			$this->session->set_flashdata('message','No Project/s found!');
			redirect('project/display_projects','refresh');
		}
		
		
		
		public function insert_project($data)
		{
			if($this->db->insert('project', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
		
		public function get_all_proj_req($proj_id)
		{
			if($proj_id != '')
			{
					$this->db->where('pr.proj_id',$proj_id);
			}
			
			$this->db->select('pr.proj_req_id as proj_req_id, p.proj_name as proj_name, r.req_name as req_name, pr.doc_link as doc_link, pr.doc_name as doc_name, pr.rvw_link as rvw_link, pr.rvw_name as rvw_name, rev.eid as reviewer, asgnr.eid as assigner, asgne.eid as assignee, pr.status as status, r.req_type_id as req_type_id, pr.proj_id as proj_id', false);
			$this->db->from('project_req as pr');
			$this->db->join('project as p', 'pr.proj_id = p.proj_id');
			$this->db->join('req_type as r', 'r.req_type_id = pr.req_type_id');
			$this->db->join('user as rev', 'pr.reviewer_id = rev.id');
			$this->db->join('user as asgnr', 'pr.assigner_id = asgnr.id');
			$this->db->join('user as asgne', 'pr.assignee_id = asgne.id');
		
			//$this->db->order_by("project.proj_id", "asc"); 
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				return $query;
			}	
			else
			{	
				return FALSE;
			}			
		}
		
		public function get_proj_req_dashbrd($id)
		{
			/*
				$this->db->where('pr.status != ', 'Approved');
				$this->db->where('pr.reviewer_id', $id);
				$this->db->or_where('pr.assignee_id', $id); 
			*/

			$where = "(pr.status != 'Approved' AND (pr.reviewer_id = $id OR pr.assignee_id = $id))";
			$this->db->where($where);
			$this->db->order_by("pr.proj_req_id", "desc"); 
			
			$this->db->select('pr.proj_req_id as proj_req_id, p.proj_name as proj_name, r.req_name as req_name, pr.doc_link as doc_link, pr.doc_name as doc_name, pr.rvw_link as rvw_link, pr.rvw_name as rvw_name, rev.eid as reviewer, asgnr.eid as assigner, asgne.eid as assignee, pr.status as status, pr.reviewer_id as rev_id, pr.assignee_id as assign_id', false);
			$this->db->from('project_req as pr');
			$this->db->join('project as p', 'pr.proj_id = p.proj_id');
			$this->db->join('req_type as r', 'r.req_type_id = pr.req_type_id');
			$this->db->join('user as rev', 'pr.reviewer_id = rev.id');
			$this->db->join('user as asgnr', 'pr.assigner_id = asgnr.id');
			$this->db->join('user as asgne', 'pr.assignee_id = asgne.id');
			$query = $this->db->get();
			
			if($query->num_rows() > 0){
				return $query;
			}	
			else{	
				return FALSE;
			}	
		}
		
		public function get_req_type()
		{	
			$query = $this->db->get('req_type');

			if($query->num_rows() > 0)
			{
				return $query;
			}
			else
			{
				return FALSE;	
			}
		}
		
		public function insert_project_req($data)
		{
			if($this->db->insert('project_req', $data))
			{
				return TRUE;
			}
				return FALSE;
		}
		
		public function update_proj_req_dshbrd($id, $data) # 
		{
			$this->db->where('proj_req_id',$id);
			$this->db->update('project_req',$data);
		}
	}
?>