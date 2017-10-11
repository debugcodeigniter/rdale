<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public $tblName = 'pages';
	public $pKey = 'page_id';
	public $moduleName = "Web Pages";
	public $controller = "pages";
	public $per_page = '15';
	public $tStatus = "page_status";
	public $colPrefix	 	= 	"page_";
	
	
	
	
	 public function __construct(){

        // Call the Model constructor
	   parent::__construct();
	    $this->user_data = $this->SqlModel->authAdmin($this->session->userdata('admin_auth'),$this->session->userdata('admin_id'));
		if(empty($this->user_data))
		{
			redirect(base_url('manage/login'));
		}
		if($this->SqlModel->checkAccess('access_pages',$this->user_data)==false) {
                    redirect(ADMIN_URL);
                    exit;	
		}
    }
	
	
	public function index($parent_id=0,$sortby="page_name", $order="ASC", $status="-",$keywords="-", $pg_no="")
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
			'page_parent_id'	=>	$parent_id
		);
		$keywords = urldecode($keywords);
		if($status=="Published" || $status=="Un-Published")
		{
			$where[$this->tStatus] = $status;	
		}
		
		$search 			= ($keywords!="-") ? array('cols'=>'page_name,page_title,menu_name,page_uri','value'=>urldecode($keywords)) : array();	
		$base_url 			= base_url().'manage/'.$this->controller.'/index/'.$parent_id.'/'.$sortby."/".$order."/".$status."/".$keywords;
		$total_rows 		= $data['total_rows'] =$this->SqlModel->countRecords($this->tblName,$where,$search);
		$per_page 			= $data['per_page'] = $this->per_page;
		$uri_segment 		= 9;
	
		$data['page_title'] = PROJECT_TITLE." | ".$this->moduleName;
		$data['userdata'] = $this->user_data;
		$data['pagesActive'] = 1;
		
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
			$data['listing'] = $this->SqlModel->getRecords('page_id,page_name,page_status,page_uri,page_added', $this->tblName, $sortby, $order,  $where, $search, $per_page, $offset,false);
			$data['parent_id'] = $parent_id;
			if($parent_id!="0")
			{
				$data['parent_name'] = $this->SqlModel->getSingleField('page_name','pages',array('page_id'=>$parent_id));	
			}
			$data['paginate'] = $this->pagination->create_links();	
		//Pagination END
			$data['sortby'] 	= 	$sortby;
			$data['order'] 		= 	($order=="ASC") ? "DESC" : "ASC";
			$data['page_numb'] 	= 	$offset;
			$data['status']		=	$status;
			$data['keywords']	=	$keywords;
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/webPages');
		$this->load->view('admin/footer');
	}
	
	//For adding/edting colors
	public function control($parent_id="",$editID="")
	{
	
		if($parent_id!="0")
		{
			$data['parent_name'] = $this->SqlModel->getSingleField('page_name','pages',array('page_id'=>$parent_id));	
		}
		$data['parent_id'] = $parent_id;
		$alert = $this->session->flashdata('alert');
		$data['sliders'] = $this->SqlModel->getRecords('sliders_id,sliders_title', 'sliders', 'sliders_title', 'ASC');
		$data['datePicker'] = 1;
		$data['pagesActive'] = 1;
		$data['alert'] = $alert;
		$type = ($editID=="") ? "Add" : "Edit";
		$data['page_title'] = PROJECT_TITLE." | ".$type." ".$this->moduleName;
		//CKEditor
		$this->load->library('ckeditor');
		$this->load->library('ckfinder');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['removePlugins'] ='save, preview, newpage, forms';
		$this->ckeditor->config['height'] = '340px';            
			
		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'../../../../assets/ckfinder/'); 
		
		//CKEdtior
		if($editID=="")
		{
			$data['tbl_data'] = $this->session->userdata($this->controller.'_data');	
		}
		else 
		{
			$data['tbl_data'] = $this->SqlModel->getSingleRecord($this->tblName, array($this->pKey=>$editID));
			if(empty($data['tbl_data']))
			{
				redirect(base_url().'manage/'.$this->controller,'location');
			}
					}
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/addPage');
		$this->load->view('admin/footer');
	}
	
	
	
	
	//For add record form post
	public function addRecord($parent_id="0")
	{	
		if($this->input->post('page_name')=="")
		{
		$this->session->set_flashdata('alert','error');
		redirect(base_url().'manage/'.$this->controller.'/index/'.$parent_id,'location');	
		exit();
		}
		
		$data = array(
		'page_name' 			=> htmlspecialchars($this->input->post('page_name')),
		'page_title' 			=> htmlspecialchars($this->input->post('page_title')),
		'page_head_color' 		=> htmlspecialchars($this->input->post('page_head_color')),
		'page_caption_color' 	=> htmlspecialchars($this->input->post('page_caption_color')),	
		'page_uri'				=> $this->input->post('page_uri'),
		'page_caption'			=> $this->input->post('page_caption'),
		'page_head'				=> $this->input->post('page_head'),
		'page_search'			=> $this->input->post('page_search'),
		'page_text' 			=> $_REQUEST['page_text'],
		'page_meta_key' 		=> $this->input->post('page_meta_key'),
		'page_meta_desc' 		=> $this->input->post('page_meta_desc'),
		'page_extra_tags' 		=> $_REQUEST['page_extra_tags'],
		'page_status' 			=> $this->input->post('page_status'),
		'page_added' 			=> date('Y-m-d H:i:s'),
		'page_updated'		 	=> date('Y-m-d H:i:s'),
		'page_year' 			=> date('Y'),
		'page_month' 			=> date('m'),
		'page_featured'			=> $this->input->post('page_featured'),
		'page_month_year'		=> date('F Y'),
		'page_slider'			=> $this->input->post('page_slider'),
		'menu_name'				=> htmlspecialchars($this->input->post('menu_name')),
		'on_home'				=> $this->input->post('on_home'),
		'color'					=> $this->input->post('color'),
		'on_side'				=> $this->input->post('on_side'),
		'page_facebook'			=> $this->input->post('page_facebook'),
		'page_news'				=> $this->input->post('page_news'),
		'page_side_page'		=> $this->input->post('page_side_page'),
		'page_testi'			=> $this->input->post('page_testi'),
		'page_links'			=> $this->input->post('page_links'),
		'page_parent_id'		=> $parent_id
		);
		
		
		if($this->SqlModel->countRecords('pages',array('page_uri'=>$data['page_uri']))>0)
		{
			$data['page_uri'] = $this->input->post('page_uri').'-1';
		}
		
		if($this->SqlModel->countRecords('pages',array('page_uri'=>$data['page_uri']))>0)
		{
			$data['page_uri'] = uniqid().'-'.$this->input->post('page_uri');
		}
		
		if($this->input->post('pub_date')!="" )
		{
			$pub_date = $this->input->post('pub_date'). " ".$this->input->post('pub_time');
			$pub_date = date('Y-m-d h:i:s',strtotime($pub_date));
			$data['page_pdate'] = $pub_date;	
		}
		else{
			$data['page_pdate'] = "0000-00-00 00:00:00";
		}
		
		if($this->input->post('unpub_date')!="")
		{
			$unpub_date = $this->input->post('unpub_date'). " ".$this->input->post('unpub_time');
			$unpub_date = date('Y-m-d h:i:s',strtotime($unpub_date));
			$data['page_update'] = $unpub_date;	
		}
		else{
			$data['page_update'] = "0000-00-00 00:00:00";
		}
		$this->load->library('upload');
		if(isset($_FILES['uploadfile'])&&$_FILES['uploadfile']['tmp_name']!="")
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/pages/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '51200';;
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('uploadfile'))
			{
					$filename_ephoto = $this->upload->data('uploadfile');
					$thumb = $this->imagethumb->image('./assets/frontend/images/pages/'.$filename_ephoto['file_name'],300,0);	
					$data['page_thumb_image'] = str_replace(FRONTEND_ASSETS."images/pages/","",$thumb);
					$data['page_image'] = $filename_ephoto['file_name'];
			}
		}
		if(isset($_FILES['uploadfile2'])&&$_FILES['uploadfile2']['tmp_name']!="")
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/pages/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '51200';;
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('uploadfile2'))
			{
					$filename_ephoto = $this->upload->data('uploadfile2');
					$data['page_image2'] = $filename_ephoto['file_name'];
			}
		}
		
		$q = $this->SqlModel->insertRecord($this->tblName, $data);
		$this->session->unset_userdata($this->controller.'_data');
		if($q!="")
		{
			$this->session->set_flashdata('alert','success');
			redirect(base_url().'manage/'.$this->controller.'/index/'.$parent_id,'location');		
		}
		else{
			$this->session->set_flashdata('alert','error');
			redirect(base_url().'manage/'.$this->controller.'/index/'.$parent_id,'location');		
		}	
	}
		
	//For add record form post
	public function editRecord($parent_id="0",$editID="")
	{
		if($this->input->post('page_name')=="" || $editID=="")
		{
			$this->session->set_flashdata('alert','error');
			redirect(base_url().'manage/'.$this->controller.'/index/'.$parent_id,'location');	
			exit();
		}
		$data = array(
		'page_name' 			=> htmlspecialchars($this->input->post('page_name')),
		'page_title' 			=> htmlspecialchars($this->input->post('page_title')),
		'page_head_color'	 	=> htmlspecialchars($this->input->post('page_head_color')),
		'page_caption_color' 	=> htmlspecialchars($this->input->post('page_caption_color')),
		'page_uri'				=> $this->input->post('page_uri'),
		'page_search'			=> $this->input->post('page_search'),
		'page_text' 			=> $_REQUEST['page_text'],
		'page_meta_key' 		=> $this->input->post('page_meta_key'),
		'page_meta_desc' 		=> $this->input->post('page_meta_desc'),
		'page_extra_tags' 		=> $_REQUEST['page_extra_tags'],
		'page_status' 			=> $this->input->post('page_status'),
		'page_updated' 			=> date('Y-m-d H:i:s'),
		'page_featured'			=> $this->input->post('page_featured'),
		'page_caption'			=> $this->input->post('page_caption'),
		'page_head'				=> $this->input->post('page_head'),
		'page_slider'			=> $this->input->post('page_slider'),
		'on_home'				=> $this->input->post('on_home'),
		'color'					=> $this->input->post('color'),
		'on_side'				=> $this->input->post('on_side'),
		'menu_name'				=> htmlspecialchars($this->input->post('menu_name')),
		'page_facebook'			=> $this->input->post('page_facebook'),
		'page_news'				=> $this->input->post('page_news'),
		'page_side_page'		=> $this->input->post('page_side_page'),
		'page_testi'			=> $this->input->post('page_testi'),
		'page_links'			=> $this->input->post('page_links'),
		);
		$data['page_pdate']  =		"";
		$data['page_update'] =  	"";
		if($this->input->post('pub_date')!="")
		{
			$pub_date = $this->input->post('pub_date'). " ".$this->input->post('pub_time');
			$pub_date = date('Y-m-d h:i:s',strtotime($pub_date));
			$data['page_pdate'] = $pub_date;	
		}
		else{
			$data['page_pdate'] = "0000-00-00 00:00:00";
		}
		if($this->input->post('unpub_date')!="")
		{
			$unpub_date = $this->input->post('unpub_date'). " ".$this->input->post('unpub_time');
			$unpub_date = date('Y-m-d h:i:s',strtotime($unpub_date));
			$data['page_update'] = $unpub_date;	
		}
		else{
			$data['page_update'] = "0000-00-00 00:00:00";
		}
		
		if($this->SqlModel->countRecords('pages',array('page_uri'=>$data['page_uri'],'page_id !='=>$editID))>0)
		{
			$data['page_uri'] = $this->input->post('page_uri').'-1';
		}
		
		if($this->SqlModel->countRecords('pages',array('page_uri'=>$data['page_uri'],'page_id !='=>$editID))>0)
		{
			$data['page_uri'] = uniqid().'-'.$this->input->post('page_uri');
		}
		$this->load->library('upload');
		if(isset($_FILES['uploadfile'])&&$_FILES['uploadfile']['tmp_name']!="")
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/pages/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '51200';;
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('uploadfile'))
			{
					$filename_ephoto = $this->upload->data('uploadfile');
					$thumb = $this->imagethumb->image('./assets/frontend/images/pages/'.$filename_ephoto['file_name'],300,0);	
					$data['page_thumb_image'] = str_replace(FRONTEND_ASSETS."images/pages/","",$thumb);
					$data['page_image'] = $filename_ephoto['file_name'];
			}
		}
		if(isset($_FILES['uploadfile2'])&&$_FILES['uploadfile2']['tmp_name']!="")
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/pages/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '51200';;
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('uploadfile2'))
			{
					$filename_ephoto = $this->upload->data('uploadfile2');
					$data['page_image2'] = $filename_ephoto['file_name'];
			}
		}
		
		
		$q = $this->SqlModel->updateRecord($this->tblName, $data, array($this->pKey=>$editID));
		if($q==true)
		{
			
			$this->session->set_flashdata('alert','editsuccess');
			redirect(base_url().'manage/'.$this->controller.'/index/'.$parent_id,'location');		
		}
		else{
			$this->session->set_flashdata('alert','error');
			redirect(base_url().'manage/'.$this->controller.'/index/'.$parent_id,'location');		
		}	
	}
	
	
	public function delete($deleteID="")
	{
		$parent_id = $this->SqlModel->getSingleField('page_parent_id','pages',array('page_id'=>$deleteID));
		$q = $this->SqlModel->deleteRecord($this->tblName , array($this->pKey=>$deleteID));
		if($q==true)
		{
			$this->SqlModel->deleteRecord($this->tblName , array('page_parent_id'=>$deleteID));
			$this->session->set_flashdata('alert','deletesuccess');
			redirect(base_url().'manage/'.$this->controller.'/index/'.$parent_id,'location');		
		}
		else{
			$this->session->set_flashdata('alert','deleteerror');
			redirect(base_url().'manage/'.$this->controller.'/index/'.$parent_id,'location');		
		}
		
		
	}
	
	//For delete selected colors
	public function deleteall()
	{
		$ids = $this->input->post('records');
		$parent_id = $this->SqlModel->getSingleField('page_parent_id','pages',array('page_id'=>$ids[0]));
		if(!empty($ids))
		{
			foreach($ids as $id)
			{
				
			$this->SqlModel->deleteRecord($this->tblName,  array($this->pKey=>$id));
			$this->SqlModel->deleteRecord($this->tblName , array('page_parent_id'=>$id));	
			}
		}
		$this->session->set_flashdata('alert','deletesuccess');
		redirect(base_url().'manage/'.$this->controller.'/index/'.$parent_id,'location');		
		
	}
	
	
	public function removeimage($id="")
	{
		$q = $this->SqlModel->updateRecord($this->tblName , array('page_image'=>'','page_thumb_image'=>''), array($this->pKey=>$id));
	}
	public function removeimage2($id="")
	{
		$q = $this->SqlModel->updateRecord($this->tblName , array('page_image2'=>''), array($this->pKey=>$id));
	}

	public function pageorder()
	{
		
		$pData = $this->input->post('table-page');	
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
	
	public function changestatus($id="0",$status="Published")
	{
		if($status=="Published" || $status=="Un-Published")
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
			$data[$this->colPrefix.'uri'] = $data[$this->colPrefix.'uri']. "-".uniqid();
			$q = $this->SqlModel->insertRecord($this->tblName , $data);
			if($q>0)
			{
				redirect(base_url('manage/'.$this->controller.'/control/'.$data['page_parent_id'].'/'.$q));
			}
			else{
				$this->session->set_flashdata('alert','error');
			}
		}
		redirect(base_url('manage/'.$this->controller));
	}
	
	
}

