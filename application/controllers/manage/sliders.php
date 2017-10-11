<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sliders extends CI_Controller {

	public $tblName = 'sliders';
	public $pKey = 'sliders_id';
	public $moduleName = "Sliders";
	public $controller = "sliders";
	public $per_page = '15';
	public $tStatus = "sliders_status";
	public $colPrefix	 	= 	"sliders_";

	public function __construct(){

        // Call the Model constructor
	   parent::__construct();
	    $this->user_data = $this->SqlModel->authAdmin($this->session->userdata('admin_auth'),$this->session->userdata('admin_id'));
		if(empty($this->user_data))
		{
			redirect(base_url('manage/login'));
		}
		if($this->SqlModel->checkAccess('access_sliders',$this->user_data)==false) {
                    redirect(ADMIN_URL);
                    exit;	
		}
    }
	
	//For listing the brands
	public function index($sortby="sliders_date", $order="DESC", $status="-",$keywords="-", $pg_no="")
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
		
		$search 			= ($keywords!="-") ? array('cols'=>'sliders_title','value'=>urldecode($keywords)) : array();	
		$base_url 			= base_url().'manage/'.$this->controller.'/index/'.$sortby."/".$order."/".$status."/".$keywords;
		$total_rows 		= $data['total_rows'] =$this->SqlModel->countRecords($this->tblName,$where,$search);
		$per_page 			= $data['per_page'] = $this->per_page;
		$uri_segment 		= 8;
	
		$data['page_title'] = PROJECT_TITLE." | Image Sliders";
		$data['userdata'] = $this->user_data;
		$data['sliderActive'] = 1;
		
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
			$data['sliders'] = $this->SqlModel->getRecords('*, (SELECT COUNT(*) FROM slider WHERE slider.slider_cat='.$this->tblName.'.sliders_id) images', $this->tblName, $sortby, $order,  $where, $search, $per_page, $offset,false);
			
			$data['paginate'] = $this->pagination->create_links();	
		//Pagination END
			$data['sortby'] 	= $sortby;
			$data['order'] 		= 	($order=="ASC") ? "DESC" : "ASC";
			$data['page_numb'] 	= 	$offset;
			$data['status']		=	$status;
			$data['keywords']	=	$keywords;
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/sliders');
		$this->load->view('admin/footer');
	}
	
	//For adding/edting colors
	public function control($alert="",$editID="",$editerror="")
	{
		
		$data['sliderActive'] = 1;
		$data['alert'] = $alert;
		$data['editerror'] = $editerror;
		$type = ($editID=="") ? "Add" : "Edit";
		$data['page_title'] = PROJECT_TITLE." | ".$type." Image Sliders";
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
			$count = $this->SqlModel->countRecords($this->tblName, array('sliders_id'=>$editID));
			if($count==0)
			{
			redirect(base_url().'manage/'.$this->controller,'location');
			}
			
			$data['tbl_data'] = $this->SqlModel->getSingleRecord($this->tblName, array($this->pKey=>$editID));
		}
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/addSliders');
		$this->load->view('admin/footer');
	}
	
	
	
	
	//For add record form post
	public function addRecord()
	{	
		if($this->input->post('sliders_title')=="")
		{
		redirect(base_url().'manage/'.$this->controller.'/index/error','location');	
		exit();
		}
		
		$data = array(
		'sliders_title' 	=> htmlspecialchars($this->input->post('sliders_title')),
		'sliders_status' => $this->input->post('sliders_status'),
		'sliders_date' 	=> date('Y-m-d H:i:s')
		);
		
		
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
		if($editID=="")
		{
		redirect(base_url().'manage/'.$this->controller,'location');	
		exit();	
		}
		
		if($this->input->post('sliders_title')=="")
		{
		redirect(base_url().'manage/'.$this->controller.'/index/error','location');	
		exit();
		}
		$data = array(
		'sliders_title' 	=> htmlspecialchars($this->input->post('sliders_title')),
		'sliders_status' 	=> $this->input->post('sliders_status'),
		);
	
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
			$data['sliders_date'] = date('Y-m-d H:i:s');
			$data[$this->colPrefix.'title'] = $data[$this->colPrefix.'title']. " Duplicate";
			$q = $this->SqlModel->insertRecord($this->tblName , $data);
			if($q>0)
			{
				$child = $this->SqlModel->getRecords('*', 'slider', 'slider_id', 'ASC',  array('slider_cat'=>$id));
				if(!empty($child))
				{
					foreach($child as $k=>$c)
					{
						unset($child[$k]['slider_id']);
						$child[$k]['slider_cat'] = $q;
						$child[$k]['slider_date'] = date('Y-m-d H:i:s');
					}
					$this->SqlModel->batchInsert('slider',$child);
				}
				redirect(base_url('manage/'.$this->controller.'/control/edit/'.$q));
			}
			else{
				$this->session->set_flashdata('alert','error');
			}
		}
		redirect(base_url('manage/'.$this->controller));
	}

	
}

