<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactuss extends CI_Controller {

	public $tblName 		= 	"contact_us";
	public $colPrefix	 	= 	"con_";
	public $pKey			=	"";
	public $moduleName 		=	"Contact Us";
	public $controller 		=	"";
	public $per_page 		=	"15";
	public $tStatus 		=	"";
	public $listView 		=	"contacts";
	public $addEditView 	=	"viewContact";

	public function __construct(){

        // Call the Model constructor
	   parent::__construct();
	    $this->user_data = $this->SqlModel->authAdmin($this->session->userdata('admin_auth'),$this->session->userdata('admin_id'));
		if(empty($this->user_data))
		{
			redirect(base_url('manage/login'));
		}
		if($this->SqlModel->checkAccess('access_contacts',$this->user_data)==false) {
                    redirect(ADMIN_URL);
                    exit;	
		}
		$this->controller = $this->router->fetch_class();
		$this->pKey			=	$this->colPrefix."id";
		$this->tStatus 		=	$this->colPrefix."status";
		
    }
	
	public function index($sortby="con_id", $order="DESC",$keywords="-", $pg_no="")
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
		
		
		$search 			= ($keywords!="-") ? array('cols'=>'con_fname,con_email,con_message','value'=>urldecode($keywords)) : array();	
		$base_url 			= base_url().'manage/'.$this->controller.'/index/'.$sortby."/".$order."/".$keywords;
		$total_rows 		= $data['total_rows'] =$this->SqlModel->countRecords($this->tblName,$where,$search);
		$per_page 			= $data['per_page'] = $this->per_page;
		$uri_segment 		= 7;
	
		$data['page_title'] = PROJECT_TITLE." | ".$this->moduleName;
		$data['userdata'] = $this->user_data;
		$data[$this->controller.'Active'] = 1;
		
		//Pagination START
			$pconfig['base_url'] = $base_url;
			$pconfig['total_rows'] = $data['total_rows'] =  $total_rows;
			$pconfig["uri_segment"] = $uri_segment ;
			$pconfig['per_page'] = $data['per_page'] = $this->per_page;
			$pconfig['num_links'] = 1;
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
	

	
}

