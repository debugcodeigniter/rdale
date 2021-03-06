<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testi extends CI_Controller {

	public $tblName 		= 	"testimonials";
	public $colPrefix	 	= 	"testi_";
	public $pKey			=	"testi_id";
	public $moduleName 		=	"Testimonials";
	public $controller 		=	"testi";
	public $per_page 		=	"15";
	public $tStatus 		=	"testi_status";
	public $listView 		=	"testi";
	public $addEditView 	=	"addTesti";

	public function __construct(){

        // Call the Model constructor
	   parent::__construct();
	    $this->user_data = $this->SqlModel->authAdmin($this->session->userdata('admin_auth'),$this->session->userdata('admin_id'));
		if(empty($this->user_data))
		{
			redirect(base_url('manage/login'));
		}
		if($this->SqlModel->checkAccess('access_testimonials',$this->user_data)==false) {
                    redirect(ADMIN_URL);
                    exit;	
		}
    }
	
	public function index($sortby="testi_order", $order="ASC", $status="-",$keywords="-", $pg_no="")
	{
		//PER_PAGE_START
		if($this->input->get('per_page')!="" && is_numeric($this->input->get('per_page')) && (int)$this->input->get('per_page')<=100)
		{
			$this->session->set_userdata('per_page', $this->input->get('per_page'));
		}
		if($this->session->userdata('per_page')!="")
		{
			$this->per_page = $this->session->userdata('per_page');	
		}
		
		//PER_PAGE_END
		$data['alert'] = $this->session->flashdata('alert');
		$where =  array(
			
		);
		$keywords = urldecode($keywords);
		if($status=="Enable" || $status=="Disable")
		{
			$where[$this->tStatus] = $status;	
		}
		
		$search 			= ($keywords!="-") ? array('cols'=>$this->colPrefix.'name','value'=>urldecode($keywords)) : array();	
		$base_url 			= base_url().'manage/'.$this->controller.'/index/'.$sortby."/".$order."/".$status."/".$keywords;
		$total_rows 		= $data['total_rows'] =$this->SqlModel->countRecords($this->tblName,$where,$search);
		$per_page 			= $data['per_page'] = $this->per_page;
		$uri_segment 		= 8;
	
		$data['page_title'] = PROJECT_TITLE." | ".$this->moduleName;
		$data['userdata'] = $this->user_data;
		$data[$this->controller.'Active'] = 1;
		
		//Pagination START
			$pconfig['base_url'] = $base_url;
			$pconfig['total_rows'] = $data['total_rows'] =  $total_rows;
			$pconfig["uri_segment"] = $uri_segment ;
			$pconfig['per_page'] = $data['per_page'] = $this->per_page;
			$pconfig['num_links'] = 4;
			$pconfig['prev_link'] = '<i class="entypo-left-open-mini"></i>';
			$pconfig['next_link'] = '<i class="entypo-right-open-mini"></i>';
			$pconfig['cur_tag_open'] = '<li  class="active"><a href="javascript:void(0)">';
			$pconfig['cur_tag_close'] = '</a></li>';
			$pconfig['full_tag_open'] = '<ul class="pagination pull-right">';
   			$pconfig['full_tag_close'] = '</ul>';
			$pconfig['num_tag_open'] = "<li>";
			$pconfig['num_tag_close']= "</li>";
			$pconfig['next_tag_open'] = "<li>";
			$pconfig['next_tag_close']= "</li>";
			$pconfig['prev_tag_open'] = "<li>";
			$pconfig['prev_tag_close']= "</li>";
			$pconfig['last_tag_open'] = "<li>";
			$pconfig['last_tag_close']= "</li>";
			$pconfig['first_tag_open'] = "<li>";
			$pconfig['first_tag_close']= "</li>";
			$offset = ($this->uri->segment($uri_segment )) ? $this->uri->segment($uri_segment ) : 0;
			$this->pagination->initialize($pconfig);
			$data['records'] = $this->SqlModel->getRecords('*', $this->tblName, $sortby, $order,  $where, $search, $per_page, $offset);
			$data['paginate'] = $this->pagination->create_links();	
		//Pagination END
			$data['sortby'] 	= $sortby;
			$data['order'] 		= 	($order=="ASC") ? "DESC" : "ASC";
			$data['page_numb'] 	= 	$offset;
			$data['status']		=	$status;
			$data['keywords']	=	$keywords;
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/'.$this->listView);
		$this->load->view('admin/footer');
	}
	
	//For adding/edting colors
	public function control($alert="",$editID="",$editerror="")
	{
		
		$data[$this->controller.'Active'] = 1;
		$data['alert'] = $alert;
		$data['editerror'] = $editerror;
		$type = ($editID=="") ? "Add" : "Edit";
		$data['page_title'] = PROJECT_TITLE." | ".$type." ".rtrim($this->moduleName,'s');
		if($alert=="error" || $alert=="image_error")
		{
		$data['tbl_data'] = $this->session->userdata($this->controller.'_data');	
		}
		else if($alert=="edit")
		{
			if($editID=="")
			{
			redirect(base_url().'manage/'.$this->controller.'/control','location');	
			exit();	
			}
			$count = $this->SqlModel->countRecords($this->tblName, array($this->pKey=>$editID));
			if($count==0)
			{
			redirect(base_url().'manage/'.$this->controller,'location');
			}
			
			$data['tbl_data'] = $this->SqlModel->getSingleRecord($this->tblName, array($this->pKey=>$editID));
		}
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/'.$this->addEditView);
		$this->load->view('admin/footer');
	}
	
	
	
	
	//For add record form post
	public function addRecord()
	{	
		if($this->input->post($this->colPrefix.'name')=="" || $this->input->post($this->colPrefix.'desc')=="")
		{
			$this->session->set_flashdata('alert','error');
			redirect(base_url().'manage/'.$this->controller,'location');	
			exit();
		}
		
		$data = array(
			$this->colPrefix.'name' 		=>		htmlspecialchars($this->input->post($this->colPrefix.'name')),
			$this->colPrefix.'name_color' 	=>		htmlspecialchars($this->input->post($this->colPrefix.'name_color')),
			$this->colPrefix.'rating' 		=>		htmlspecialchars($this->input->post($this->colPrefix.'rating')),
			$this->colPrefix.'rating_color' 		=>		htmlspecialchars($this->input->post($this->colPrefix.'rating_color')),
			$this->colPrefix.'desc' 		=>		$this->input->post($this->colPrefix.'desc'),
			$this->colPrefix.'desc_color' 	=>		$this->input->post($this->colPrefix.'desc_color'),
			$this->tStatus				 	=> 		$this->input->post($this->tStatus),
			$this->colPrefix.'added' 		=>		date('Y-m-d H:i:s'),
			$this->colPrefix.'updated' 		=> 		date('Y-m-d H:i:s')
		);
		if(isset($_FILES['uploadfile'])&&$_FILES['uploadfile']['tmp_name']!="")
		{
			$config['upload_path'] = './assets/frontend/images/'.$this->controller.'/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= 51200;
			$config['remove_spaces'] = true;
			$this->load->library('upload', $config);
			$this->load->library('image_lib');
			if ($this->upload->do_upload('uploadfile'))
			{
				$filename_ephoto = $this->upload->data('uploadfile');
				$data[$this->colPrefix.'image'] = $filename_ephoto['file_name'];
			}
			
		}
		
		$q = $this->SqlModel->insertRecord($this->tblName, $data);
		$this->session->unset_userdata($this->controller.'_data');
		if($q!="")
		{
			$this->session->set_flashdata('alert','success');
		}
		else{
			$this->session->set_flashdata('alert','error');	
		}
		redirect(base_url().'manage/'.$this->controller);	
	}
		
	//For add record form post
	public function editRecord($editID="")
	{
		if($this->input->post($this->colPrefix.'name')=="" || $this->input->post($this->colPrefix.'desc')=="" || $editID=="")
		{
			$this->session->set_flashdata('alert','error');
			redirect(base_url().'manage/'.$this->controller,'location');	
			exit();
		}
		
		$data = array(
			$this->colPrefix.'name' 		=>		htmlspecialchars($this->input->post($this->colPrefix.'name')),
			$this->colPrefix.'name_color' 	=>		htmlspecialchars($this->input->post($this->colPrefix.'name_color')),
			$this->colPrefix.'rating' 		=>		htmlspecialchars($this->input->post($this->colPrefix.'rating')),
			$this->colPrefix.'rating_color' 		=>		htmlspecialchars($this->input->post($this->colPrefix.'rating_color')),
			$this->colPrefix.'desc' 		=>		$this->input->post($this->colPrefix.'desc'),
			$this->colPrefix.'desc_color' 	=>		$this->input->post($this->colPrefix.'desc_color'),
			$this->tStatus				 	=> 		$this->input->post($this->tStatus),
			$this->colPrefix.'updated' 		=> 		date('Y-m-d H:i:s')
		);
		if(isset($_FILES['uploadfile'])&&$_FILES['uploadfile']['tmp_name']!="")
		{
			$config['upload_path'] = './assets/frontend/images/'.$this->controller.'/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= 51200;
			$config['remove_spaces'] = true;
			$this->load->library('upload', $config);
			$this->load->library('image_lib');
			if ($this->upload->do_upload('uploadfile'))
			{
				$filename_ephoto = $this->upload->data('uploadfile');
				$data[$this->colPrefix.'image'] = $filename_ephoto['file_name'];
			}
			
		}
	
		$q = $this->SqlModel->updateRecord($this->tblName, $data, array($this->pKey=>$editID));
		if($q==true)
		{
			$this->session->set_flashdata('alert','editsuccess');	
		}
		else{
			$this->session->set_flashdata('alert','error');
		}
		redirect(base_url('manage/'.$this->controller));	
	}
	
	public function delete($deleteID="")
	{
		$q = $this->SqlModel->deleteRecord($this->tblName , array($this->pKey=>$deleteID));
		if($q==true)
		{
		$this->session->set_flashdata('alert','deletesuccess');
		}
		else{
		$this->session->set_flashdata('alert','deleteerror');
		}
		redirect(base_url().'manage/'.$this->controller,'location');		
	}
	
	public function deleteall()
	{
		$ids = $this->input->post('records');
		if(!empty($ids))
		{
			foreach($ids as $id)
			{
			$this->SqlModel->deleteRecord($this->tblName,  array($this->pKey=>$id));	
			}
		}
		$this->session->set_flashdata('alert','deletesuccess');
		redirect(base_url().'manage/'.$this->controller,'location');		
		
	}
	
	public function sortrecords()
	{
		$pData = $this->input->post('table-'.$this->controller);	
		if(!empty($pData))
		{	
			$o = (int)1;
			$data = array();
			foreach($pData as $p)
			{
				array_push($data,array($this->pKey=>$p,$this->colPrefix.'order'=>$o));
				$o++;	
			}
			if(!empty($data))
			{
				$this->SqlModel->batchUpdate($this->tblName,$data,$this->pKey);
			}
		}
	}
	
	public function changestatus($id="0",$status="Enable")
	{
		if($status=="Enable" || $status=="Disable")
		{
			$this->SqlModel->updateRecord($this->tblName, array($this->tStatus=>$status), array($this->pKey=>$id));
			echo json_encode(array('status'=>'true','id'=>$id,'currentStatus'=>$this->SqlModel->getSingleField($this->tStatus,$this->tblName,array($this->pKey=>$id))));	
		}
		else{
			echo json_encode(array('status'=>'false'));	
		}
		
	}
	
	public function duplicate($id="")
	{
		$data = $this->SqlModel->getSingleRecord($this->tblName,array($this->pKey=>$id));
		if(empty($data))
		{
			$this->session->set_flashdata('alert','error');
		}
		else{
			unset($data[$this->pKey]);
			$data[$this->colPrefix.'added'] = date('Y-m-d H:i:s');
			$data[$this->colPrefix.'updated'] = date('Y-m-d H:i:s');
			$data[$this->colPrefix.'name'] = $data[$this->colPrefix.'name']. " Duplicate";
			$q = $this->SqlModel->insertRecord($this->tblName , $data);
			if($q>0)
			{
				redirect(base_url('manage/'.$this->controller.'/control/edit/'.$q));
			}
			else{
				$this->session->set_flashdata('alert','error');
			}
		}
		redirect(base_url('manage/'.$this->controller));
	}

	
}

