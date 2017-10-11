<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends CI_Controller {

	public $tblName = 'slider';
	public $pKey = 'slider_id';
	public $moduleName = "Slider";
	public $controller = "slider";
	public $colPrefix	 	= 	"slider_";
	public $tStatus = "slider_status";
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
	public function index($alert="page",$slider_cat="",$pg_no="")
	{
		$sortby="slider_order";
		$order="ASC";
		if($this->SqlModel->countRecords('sliders',array('sliders_id'=>$slider_cat))=="0")
		{
			redirect(base_url('manage/sliders'));
		}
		$data['slider_cat'] = $slider_cat;
		$data['slider_name'] = $this->SqlModel->getSingleField('sliders_title','sliders',array('sliders_id'=>$slider_cat));
		$data['page_title'] = PROJECT_TITLE." | Image Slider";
		$data['alert'] = $alert;
		$data['userdata'] = $this->user_data;
		$data['sliderActive'] = 1;
		$data['per_page'] = 200;
		//Pagination START
			$count_rows = $this->SqlModel->countRecords($this->tblName, array('slider_cat'=>$slider_cat));
			$pconfig['base_url'] = base_url().'manage/'.$this->controller.'/index/page/'.$slider_cat;
			$data['total_rows'] = $count_rows;
			$pconfig['total_rows'] =  $count_rows;
			$pconfig["uri_segment"] = 6;
			$pconfig['per_page'] = $data['per_page'];
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
			$page = ($this->uri->segment($pconfig["uri_segment"])) ? $this->uri->segment($pconfig["uri_segment"]) : 0;
			if($pg_no!="")
			{
				$page = $pg_no;
			}
		
			$this->pagination->initialize($pconfig);
			$data['slider'] = $this->SqlModel->getRecords('*', $this->tblName, $sortby, $order, array('slider_cat'=>$slider_cat), $pconfig["per_page"], $page);
			$data['paginate'] = $this->pagination->create_links();	
		//Pagination END
			$data['sortby'] = $sortby;
			if($order=="ASC")
			{
				$order = "DESC";	
			}
			else if($order=="DESC")
			{
				$order = "ASC";	
			}
			$data['order'] = $order;
			$data['page_numb'] = $page;
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/slider');
		$this->load->view('admin/footer');
	}
	
	//For adding/edting colors
	public function control($slider_cat="",$alert="",$editID="",$editerror="")
	{
		if($this->SqlModel->countRecords('sliders',array('sliders_id'=>$slider_cat))=="0")
		{
			redirect(base_url('manage/sliders'));
		}
		$data['slider_name'] = $this->SqlModel->getSingleField('sliders_title','sliders',array('sliders_id'=>$slider_cat));
		$data['slider_cat'] = $slider_cat;
		$data['sliderActive'] = 1;
		$data['alert'] = $alert;
		$data['editerror'] = $editerror;
		$type = ($editID=="") ? "Add" : "Edit";
		$data['page_title'] = PROJECT_TITLE." | ".$type." Image Slider";
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
			$count = $this->SqlModel->countRecords($this->tblName, array('slider_id'=>$editID));
			if($count==0)
			{
			redirect(base_url().'manage/'.$this->controller,'location');
			}
			
			$data['tbl_data'] = $this->SqlModel->getSingleRecord($this->tblName, array($this->pKey=>$editID));
		}
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/addSlider');
		$this->load->view('admin/footer');
	}
	
	
	
	
	//For add record form post
	public function addRecord($slider_cat="")
	{	
		if($this->SqlModel->countRecords('sliders',array('sliders_id'=>$slider_cat))=="0")
		{
			redirect(base_url('manage/sliders'));
		}
		
		if($_FILES['uploadfile']['tmp_name']=="")
		{
		//redirect(base_url().'manage/'.$this->controller.'/index/error','location');	
		exit();
		}
		
		$data = array(
		'slider_title' 	=> htmlspecialchars($this->input->post('slider_title')),
		'slider_btn' 	=> htmlspecialchars($this->input->post('slider_btn')),
		'slider_heading' 	=> htmlspecialchars($this->input->post('slider_heading')),
		'url_target' 	=> $this->input->post('url_target'),
		'slider_status' => $this->input->post('slider_status'),
		'slider_desc' => $this->input->post('slider_desc'),
		'slider_url'	=> $this->input->post('slider_url'),
		'slider_cat'	=>$slider_cat,
		'slider_date' 	=> date('Y-m-d H:i:s'),
		'slider_tour_btn' 	=> htmlspecialchars($this->input->post('slider_tour_btn')),
		'slider_heading_color' 	=> htmlspecialchars($this->input->post('slider_heading_color')),
		'slider_desc_color' 	=> htmlspecialchars($this->input->post('slider_desc_color')),
		'slider_tour_btn' 	=> htmlspecialchars($this->input->post('slider_tour_btn')),
		'slider_tour_url' 	=> $this->input->post('slider_tour_url'),
		'tour_url_target' 	=> $this->input->post('tour_url_target'),
		);
		
		$this->load->library('upload');
		if(isset($_FILES['uploadfile'])&&$_FILES['uploadfile']['tmp_name']!="")
		{
			$config['upload_path'] = './assets/frontend/images/slider/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '51200';
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('uploadfile'))
			{
				
				$this->session->set_userdata($this->controller.'_data', $data);
				redirect(base_url().'manage/'.$this->controller.'/control/image_error','location');	
			}
			else{
					$filename_ephoto = $this->upload->data('uploadfile');
					$thumb = $this->imagethumb->image('./assets/frontend/images/slider/'.$filename_ephoto['file_name'],150,0);	
					$data['slider_thumb'] = str_replace(FRONTEND_ASSETS."images/slider/","",$thumb);
					$data['slider_large'] = $filename_ephoto['file_name'];
					
			}
		}
		
		
		$q = $this->SqlModel->insertRecord($this->tblName, $data);
		$this->session->unset_userdata($this->controller.'_data');
		if($q!="")
		{
			redirect(base_url().'manage/'.$this->controller.'/index/success/'.$slider_cat,'location');		
		}
		else{
			redirect(base_url().'manage/'.$this->controller.'/index/error/'.$slider_cat,'location');		
		}	
	}
		
	//For add record form post
	public function editRecord($slider_cat="",$editID="")
	{
		if($this->SqlModel->countRecords('sliders',array('sliders_id'=>$slider_cat))=="0")
		{
			redirect(base_url('manage/sliders'));
		}
		if($editID=="")
		{
		redirect(base_url().'manage/'.$this->controller,'location');	
		exit();	
		}
		
		
		$data = array(
		'slider_title' 		=> htmlspecialchars($this->input->post('slider_title')),
		'slider_btn' 		=> htmlspecialchars($this->input->post('slider_btn')),
		'slider_heading' 	=> htmlspecialchars($this->input->post('slider_heading')),
		'url_target' 		=> $this->input->post('url_target'),
		'slider_status'		=> $this->input->post('slider_status'),
		'slider_desc'		=> $this->input->post('slider_desc'),
		'slider_url'		=> $this->input->post('slider_url'),
		'slider_heading_color' 	=> htmlspecialchars($this->input->post('slider_heading_color')),
		'slider_desc_color' 	=> htmlspecialchars($this->input->post('slider_desc_color')),
		'slider_cat'		=> $slider_cat,
		'slider_tour_btn' 	=> htmlspecialchars($this->input->post('slider_tour_btn')),
		'slider_tour_url' 	=> $this->input->post('slider_tour_url'),
		'tour_url_target' 	=> $this->input->post('tour_url_target'),
		
		);
		
		$this->load->library('upload');
		if(isset($_FILES['uploadfile'])&&$_FILES['uploadfile']['tmp_name']!="")
		{
			$config['upload_path'] = './assets/frontend/images/slider/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '51200';;
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('uploadfile'))
			{
				$this->session->set_userdata($this->controller.'_data', $data);
				redirect(base_url().'manage/'.$this->controller.'/control/image_error','location');	
			}
			else{
					$filename_ephoto = $this->upload->data('uploadfile');
					$thumb = $this->imagethumb->image('./assets/frontend/images/slider/'.$filename_ephoto['file_name'],150,0);	
					$data['slider_thumb'] = str_replace(FRONTEND_ASSETS."images/slider/","",$thumb);
					$data['slider_large'] = $filename_ephoto['file_name'];
					
			}
		}
		
		
		
		
		$q = $this->SqlModel->updateRecord($this->tblName, $data, array($this->pKey=>$editID));
		if($q==true)
		{
		redirect(base_url().'manage/'.$this->controller.'/index/editsuccess/'.$slider_cat,'location');		
		}
		else{
		redirect(base_url().'manage/'.$this->controller.'/index/error/'.$slider_cat,'location');		
		}	
	}
	
	//For delete color
	public function delete($deleteID="")
	{
		$slider_cat = $this->SqlModel->getSingleField('slider_cat','slider',array('slider_id'=>$deleteID));
		$q = $this->SqlModel->deleteRecord($this->tblName , array($this->pKey=>$deleteID));
		if($q==true)
		{
		redirect(base_url().'manage/'.$this->controller.'/index/deletesuccess/'.$slider_cat,'location');		
		}
		else{
		redirect(base_url().'manage/'.$this->controller.'/index/deleteerror/'.$slider_cat,'location');		
		}
		
		
	}
	
	//For delete selected colors
	public function deleteall()
	{
		$ids = $this->input->post('records');
		$slider_cat = $this->SqlModel->getSingleField('slider_cat','slider',array('slider_id'=>$ids[0]));
		if(!empty($ids))
		{
			foreach($ids as $id)
			{
			$this->SqlModel->deleteRecord($this->tblName,  array($this->pKey=>$id));	
			}
		}
		redirect(base_url().'manage/'.$this->controller.'/index/deletesuccess/'.$slider_cat,'location');		
		
	}
	
	//Multip Images
	public function uploadimages($slider_cat="")
	{
		if($this->SqlModel->countRecords('sliders',array('sliders_id'=>$slider_cat))=="0")
		{
			redirect(base_url('manage/sliders'));
		}
		$data['slider_name'] = $this->SqlModel->getSingleField('sliders_title','sliders',array('sliders_id'=>$slider_cat));
		$data['slider_cat'] = $slider_cat;
		$data['sliderActive'] = 1;
		$data['suploadscript'] = 1;
		$data['page_title'] = PROJECT_TITLE." | Upload Slider Images";
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/sliderImages');
		$this->load->view('admin/footer');
	}
	
	public function do_upload()
	{	$this->load->library('imagethumb');
		$config['upload_path'] = './assets/frontend/images/slider/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '51200';;
		$config['remove_spaces'] = true;
		$this->load->library('upload', $config);
		$this->load->library('image_lib');
				
					if ( ! $this->upload->do_upload('upl'))
					{
						$ephoto_error = "Unable to upload cover photo, please check the file format and size.";
						echo json_encode(array('status'=>'error'));
						
					}
					else{
						
					$filename_ephoto = $this->upload->data('upl');
					$large = $filename_ephoto['file_name'];
					$thumb = $this->imagethumb->image('./assets/frontend/images/slider/'.$filename_ephoto['file_name'],150,0);	
					$thumb = str_replace(FRONTEND_ASSETS."images/slider/","",$thumb);
					
							echo json_encode(array('status'=>'success','file_name'=>$large,'thumb_image'=>$thumb));
					}
	}	
	
	public function saveimages($slider_cat="")
	{
		
		$totalImages = $this->input->post('totalImages');
		if($totalImages>0)
		{
			$c = "0";
			for($i=1;$i<=$totalImages;$i++)
			{	unset($data);
				$data = array();
				
				$data['slider_title'] = htmlspecialchars($this->input->post('slider_title'.$i));
				$data['slider_large'] = $this->input->post('slider_image'.$i);
				$data['slider_thumb'] = $this->input->post('slider_thumb_image'.$i);
				$data['slider_status'] = 'Enable';
				$data['slider_cat'] = $slider_cat;
				$data['slider_date'] =  date('Y-m-d H:i:s');
				
				if($data['slider_large']!="")
				{
					$this->SqlModel->insertRecord($this->tblName,$data);
				}
				$c++;
			}
			
			
			if($c=="0")
			{
				redirect(base_url().'manage/'.$this->controller.'/index/success/'.$slider_cat,'location');	
			}
			else{
				redirect(base_url().'manage/'.$this->controller.'/index/success/'.$slider_cat,'location');		
			}
			
		}
		else{
			redirect(base_url().'manage/'.$this->controller.'/index/page/'.$slider_cat,'location');	
		}
		
		
		
	}
	
	
	public function sliderorder()
	{
		$pData = $this->input->post('table-slider');	
		if(!empty($pData))
		{	
			$o = (int)1;
			foreach($pData as $p)
			{
				//echo $p.'<br/>';
				$this->SqlModel->updateRecord('slider',array('slider_order'=>$o),array('slider_id'=>$p));
				$o++;	
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
			$data['slider_date'] = date('Y-m-d H:i:s');
			$data[$this->colPrefix.'title'] = $data[$this->colPrefix.'title']. " Duplicate";
			$q = $this->SqlModel->insertRecord($this->tblName , $data);
			if($q>0)
			{
				redirect(base_url('manage/'.$this->controller.'/control/'.$data['slider_cat'].'/edit/'.$q));
			}
			else{
				$this->session->set_flashdata('alert','error');
			}
		}
		redirect(base_url('manage/'.$this->controller));
	}
	

	
}

