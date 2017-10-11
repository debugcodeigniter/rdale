<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website_users extends CI_Controller {

	public $tblName 		= 	"website_users";
	public $colPrefix	 	= 	"usr_";
	public $pKey			=	"usr_id";
	public $moduleName 		=	"Website Users";
	public $controller 		=	"website_users";
	public $per_page 		=	"15";
	public $tStatus 		=	"usr_status";
	public $listView 		=	"website_users";
	public $addEditView 	=	"viewWebsiteUser";

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
	
	public function index($sortby="usr_id", $order="DESC", $status="-",$keywords="-", $pg_no="")
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
		
		$search 			= ($keywords!="-") ? array('cols'=>$this->colPrefix.'name,usr_phone,usr_email','value'=>urldecode($keywords)) : array();	
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
	
	public function control($alert="",$orderID="")
	{
		
		$data[$this->controller.'Active'] = 1;
		$data['page_title'] = PROJECT_TITLE." | View ".rtrim($this->moduleName,'s');
		
		$data['record'] = $this->SqlModel->getSingleRecord($this->tblName, array($this->pKey=>$orderID));
		if(empty($data['record']))
		{
		redirect(base_url().'manage/'.$this->controller,'location');
		}
		
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/'.$this->addEditView);
		$this->load->view('admin/footer');
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
	

	
}

