<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Project extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->load->helper(array('url','form'));
			$this->load->library('form_validation');
			$this->load->library('pagination');	
			$this->load->model('mproject','m_project');
			$this->load->model('muser','m_user'); 
			$this->load->library('session');
			$this->load->library('email'); 
			
			$this->load->library('excel');
			
			$this->load->library('My_PHPMailer');

			$config['upload_path'] = './assets/';
			$config['allowed_types'] = 'gif|jpg|png';
			
			$this->load->library('upload', $config);
			
			if (!$this->session->userdata('eid')){
				header('Location: '.site_url('login/authenticate'));
			}
		}
		
		public function display_projects() 
		{
			if(($this->session->userdata('user_type') == 'Lead') || ($this->session->userdata('is_admin') != 0) || ($this->session->userdata('is_qa_rep') != 0))
			{				
				$config = array();				
				$config['base_url'] = site_url('project/display_projects');

				if ($this->session->userdata('is_admin') == 1)
				{
					$config['total_rows'] = $this->db->count_all('project');
				}
				else
				{
					$query = $this->db->where('team_id', $this->session->userdata('team_id'))->get('project');
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

				$projects_result = $this->m_project->get_all_projects($config["per_page"], $page, $team_id, '');
				$data["projects_table"] = $projects_result->result();
				$data["pagination"] = $this->pagination->create_links();

				$this->load->view('header');
				$this->load->view('display_projects',$data);
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
			if(($this->session->userdata('user_type') == 'Lead') || ($this->session->userdata('is_admin') != 0) || ($this->session->userdata('is_qa_rep') != 0))
			{
				/*$id = $this->session->userdata('id');
				$usr_row = $this->m_user->get_user_details($id);
				$user_data['user_detail'] = $usr_row->result();*/
				
				// if the user_type is lead, just display its respective resource capability_search
				if($this->session->userdata('user_type') == 'Lead' && ($this->session->userdata('is_admin') != 1)) 
				{ 
					$capabiltity_search = $this->session->userdata('team_id');
					$status_search = '';
				}
				else
				{
					$capabiltity_search = ($this->input->post("capability_search"))? $this->input->post("capability_search") : '';
					$capabiltity_search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $capabiltity_search;
					
					$status_search = ($this->input->post("status_search"))? $this->input->post("status_search") : '';
					$status_search = ($this->uri->segment(5)) ? $this->uri->segment(5) : $status_search;
				}

				// pagination settings
				$config = array();
				$config['base_url'] = site_url("project/filter/$capabiltity_search");
				$config['total_rows'] = $this->m_project->proj_count($capabiltity_search,$status_search);
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
				$project_result = $this->m_project->get_all_projects($config['per_page'], $data['page'], $capabiltity_search,$status_search);
				$data['projects_table'] = $project_result->result();
				$data['pagination'] = $this->pagination->create_links();

				//load view
				$this->load->view('header');
				$this->load->view('display_projects',$data);
				$this->load->view('footer');
				
			}
			else
			{
				$this->session->set_flashdata('message','You are not allowed to view this page!');
				redirect('user/user_dashboard');
			}
		}
		
		
		public function show_project_requirements($proj_id)
		{    	
			
			if($row = $this->m_project->get_all_proj_req($proj_id))
			{
				$data['proj_req_tbl'] = $row->result();
			}
			
			// forbidden jutsu! :)
			// did this just to get the project name to be placed inside the modal
			$this->db->select('proj_name, proj_id');
			$this->db->from('project');
			$this->db->where('proj_id',$proj_id);
			$query = $this->db->get();
			$data['proj_name'] = $query->result();
			
			$this->db->select('id, eid');
			$this->db->from('user');
			if($this->session->userdata('is_admin') != 1)
			{
				$this->db->where('team_id', $this->session->userdata('team_id'));
			}
			$this->db->where('is_active !=', 0);
			$query = $this->db->get();
			$data['eid'] = $query->result();
			
			// requirement type
			$row = $this->m_project->get_req_type();
			$data['req_type_tbl'] = $row->result();
			
			$data['title'] = 'Project Requirements';
			$data['norecord'] = '';
			$this->load->view('header');
			$this->load->view('project_requirements',$data);
			$this->load->view('footer');
		}
		
		public function add_project()
		{
			if($this->submit_validate()===FALSE)
			{
				$this->session->set_flashdata('message','End Date should not be greater than the Start Date');
				redirect('project/display_projects/','refresh');	
			}
			else
			{
				$data['proj_name'] = $this->input->post('proj_name');
				$data['capability_id'] = $this->input->post('capability_id');
				$data['start_date'] = $this->input->post('start_date');
				$data['end_date'] = $this->input->post('end_date');
				$data['status'] = $this->input->post('status');

				$this->m_project->insert_project($data);
		
				$this->session->set_flashdata('message','New project has been added!');
				redirect('project/add_project','refresh');
			}	
		}
		
		public function add_project_requirements()
		{
			$data['proj_id'] = $this->input->post('proj_id');
			$data['assigner_id'] = $this->input->post('assigner_id');
			$data['req_type_id'] = $this->input->post('req_type_id');
			$data['doc_name'] = $this->input->post('doc_name');
			$data['doc_link'] = $this->input->post('doc_link');
			$data['rvw_name'] = $this->input->post('rvw_name');
			$data['status'] = $this->input->post('status');
			$data['rvw_link'] = $this->input->post('rvw_link');
			$data['assignee_id'] = $this->input->post('assignee_id');
			$data['reviewer_id'] = $this->input->post('reviewer_id');
			
			$this->m_project->insert_project_req($data);
			$this->session->set_flashdata('message','New project requirement has been added!');
			redirect('project/show_project_requirements/'.$data['proj_id'],'refresh');		
		}
		
		function check_date() 
		{
			$start_date = strtotime($this->input->post('start_date'));
			$end_date = strtotime($this->input->post('end_date'));

			if ($end_date >= $start_date){
				return TRUE;
			}
			else {
				$this->form_validation->set_message('check_date', 'End Date should be greater than the Start Date.');
			return FALSE;
		  }
		}
		
		private function submit_validate()
		{	
			$this->form_validation->set_rules('proj_name', 'Project Name','trim|required');
			$this->form_validation->set_rules('start_date', 'Start Date','trim|required');
			if($this->input->post('end_date')!='')
			{
				$this->form_validation->set_rules('end_date', 'End Date','trim|required|callback_check_date');
			}
			
			return $this->form_validation->run();	
		}
		
		public function update_proj_req_dshbrd()
		{
				$id = $this->input->post('proj_req_id');		
				
				$data['doc_name'] = $this->input->post('doc_name');
				$data['doc_link'] = $this->input->post('doc_link');
				$data['rvw_name'] = $this->input->post('rvw_name');
				$data['rvw_link'] = $this->input->post('rvw_link');
				$data['status'] = $this->input->post('status');
			
				$this->m_project->update_proj_req_dshbrd($id, $data);
				$this->session->set_flashdata('message', 'Project Requirement has been updated!');
				redirect('user/user_dashboard');	
		}
		
		/******* EXPORT TO EXCEL FUNCTIONS *******/
		
		public function projects_export_to_xls()
		{
			$year = '2016';
			$mon = '06';
			
			$rs = $this->db->query("SELECT project.proj_name, capability.team, project.start_date, project.end_date, project.status from project join capability ON project.capability_id = capability.id WHERE project.start_date LIKE '$year-$mon-__'");
			if($rs->num_rows() > 0)
			{
				// Convert date to string
				$fname = date(  "F Y", strtotime( $year.'-'.$mon ));
				
				$this->excel->setActiveSheetIndex(0);
				//name the worksheet
				$this->excel->getActiveSheet()->setTitle($fname.' Projects');
				//set cell A1 content with some text
				$this->excel->getActiveSheet()->setCellValue('A1', $fname.' Projects');
				$this->excel->getActiveSheet()->setCellValue('A3', 'Project Name');
				$this->excel->getActiveSheet()->setCellValue('B3', 'Assigned Team');
				$this->excel->getActiveSheet()->setCellValue('C3', 'Start Date');
				$this->excel->getActiveSheet()->setCellValue('D3', 'End Date');
				$this->excel->getActiveSheet()->setCellValue('E3', 'Status');
				
				//merge cell A1 until C1
				$this->excel->getActiveSheet()->mergeCells('A1:E1');
				//set aligment to center for that merged cell (A1 to C1)
				$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
				$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
				
				for($col = ord('A'); $col <= ord('C'); $col++)
				{ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
				 //change the font size
					$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}
				//retrive contries table data
				$exceldata="";
				
				foreach ($rs->result_array() as $row)
				{
					$exceldata[] = $row;
				}
				
				for ($col = ord('A'); $col <= ord('E'); $col++)
				{
					$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
				}
				
				//Fill data 
				$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');
				 
				$this->excel->getActiveSheet()->getStyle('A3:A500')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3:B500')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('C3:C500')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D3:D500')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('E3:E500')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$this->excel->getActiveSheet()->getStyle('A3:E3')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
				$this->excel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true);
				 	 
				$filename = $fname.' Projects.xls'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache

				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			}
			else
			{
				$this->session->set_flashdata('message', 'No projects found. Generating report failed!');
				redirect('project/display_projects');
			}	 
		}
	}
?>