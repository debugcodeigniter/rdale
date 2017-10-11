<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public $moduleName = "Home";
	public $controller = "home";
	public $user_data = array();
	 public function __construct(){

        // Call the Model constructor
	   parent::__construct();
	 
		$this->user_data = $this->SqlModel->authAdmin($this->session->userdata('admin_auth'),$this->session->userdata('admin_id'));
		
		if(empty($this->user_data))
		{
			redirect(base_url('manage/login'));
		}
		
		
    }
	
	public function index()
	{
		$data['dashBoard'] 			= 1;
		$data['page_title']		 	= PROJECT_TITLE." | Dashboard";
		$data['totalAdmins']		= $this->SqlModel->countRecords('admin_users');
		$data['totalSliders'] 		= $this->SqlModel->countRecords('sliders');
		$data['totalPages'] 		= $this->SqlModel->countRecords('pages');
		$data['totalTesti'] 		= $this->SqlModel->countRecords('testimonials');
		$data['totalMembers'] 		= $this->SqlModel->countRecords('team_members');
		$data['totalContactus']		= $this->SqlModel->countRecords('contact_us');
		$data['totalUsers']		= $this->SqlModel->countRecords('website_users');
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
	
	
	public function getDestForIncMenu()
	{
		$dest = $this->SqlModel->getRecords('dest_id, dest_name','destinations','dest_order','ASC');
		$data['inc_menu'] = "";
		$data['gal_menu'] = "";
		$data['vendor_menu'] = "";
		if(!empty($dest))
		{
			foreach($dest as $d)
			{
				$data['inc_menu'] .= '<li id="inc_dest_'.$d['dest_id'].'"><a href="'.base_url('manage/inclusions/index/'.$d['dest_id']).'">'.$d['dest_name'].'</a></li>';
				$data['gal_menu'] .= '<li id="gal_dest_'.$d['dest_id'].'"><a href="'.base_url('manage/galleries/index/'.$d['dest_id']).'">'.$d['dest_name'].'</a></li>';
				$data['vendor_menu'] .= '<li id="vendor_dest_'.$d['dest_id'].'"><a href="'.base_url('manage/vendors/index/'.$d['dest_id']).'">'.$d['dest_name'].'</a></li>';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	public function settings($alert="")
	{
		
		$data['page_title'] = PROJECT_TITLE." | Account Settings";
		$data['alert'] = $alert;
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/adminSettings');
		$this->load->view('admin/footer');
	}
	
	
	
	public function savesettings()
	{
		if($this->input->post('admin_name')=="" || $this->input->post('admin_email')=="")
		{
		redirect(base_url().'manage/home/settings/error', 'location');
		exit();
		}
		
		if($this->SqlModel->countRecords('admin_users' , array('email'=>$this->input->post('admin_email'),'id !='=>$this->user_data['id']))>0)
		{
		redirect(base_url().'manage/home/settings/exist', 'location');
		exit();
		}
		
		
		
		$this->SqlModel->updateRecord('admin_users' , array('full_name'=>$this->input->post('admin_name'), 'email'=>$this->input->post('admin_email')) , array('id'=>$this->user_data['id']));
		
		
		if($this->input->post('admin_current_pwd')!="")
		{
			if(md5($this->input->post('admin_current_pwd'))!=$this->user_data['pwd'])
			{
			redirect(base_url().'manage/home/settings/perror', 'location');	
			exit();
			}
			else{
				$this->SqlModel->updateRecord('admin_users' , array('pwd'=>md5($this->input->post('admin_new_pwd'))) , array('id'=>$this->user_data['id']));
			}
		}
		
		redirect(base_url().'manage/home/settings/success', 'location');
	}
	
	
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'manage','location');
	}
	
	/*
	public function table($alert="")
	{
		$data['page_title'] = PROJECT_TITLE." | Dashboard";
		$data['alert'] = $alert;
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/mainTable');
		$this->load->view('admin/footer');
	}
	
	public function form($alert="")
	{
		$data['page_title'] = PROJECT_TITLE." | Dashboard";
		$data['alert'] = $alert;
		$data['userdata'] = $this->user_data;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/form');
		$this->load->view('admin/footer');
	}
	
	*/
	public function websettings($alert="")
	{
		if($this->SqlModel->checkAccess('access_settings',$this->user_data)==false)
		{
			redirect(ADMIN_URL);
			exit;	
		}
		$data['wsettingActive'] = 1;
		$data['page_title'] = PROJECT_TITLE." | Website Settings";
		

		$data['alert'] = $this->session->flashdata('alert');
		$data['userdata'] = $this->user_data;
		$data['web'] = $this->SqlModel->getSingleRecord('site_settings',array('id'=>1));
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/webSettings');
		$this->load->view('admin/footer');
	}
	
	public function savewebsettings()
	{
		if($this->SqlModel->checkAccess('access_settings',$this->user_data)==false)
		{
			redirect(ADMIN_URL);
			exit;	
		}
		$data = array(
		'website_title'			=> 	htmlspecialchars($this->input->post('website_title')),
		'website_slogan'		=> 	htmlspecialchars($this->input->post('website_slogan')),
		'website_url'			=> 	$this->input->post('website_url'),
		'paypal_email'			=> 	$this->input->post('paypal_email'),
		'paypal_mode'			=> 	$this->input->post('paypal_mode'),
		'head_phone'			=> 	htmlspecialchars($this->input->post('head_phone')),
		'twitter'				=> 	$this->input->post('twitter'),
		'facebook'				=> 	$this->input->post('facebook'),
		'instagram' 			=> 	$this->input->post('instagram'),
		'youtube'				=> 	$this->input->post('youtube'),
		'google'				=> 	$this->input->post('google'),
		'pinterest'				=> 	$this->input->post('pinterest'),
		'linkedin'				=> 	$this->input->post('linkedin'),
		'flickr'				=> 	$this->input->post('flickr'),
		'skype'					=> 	$this->input->post('skype'),
		'analytics'				=>	htmlspecialchars($this->input->post('analytics')),
		'under_construction'	=>	$this->input->post('under_construction'),
		'head_scripts'			=> 	$this->input->post('head_scripts', FALSE),
		'body_scripts'			=> 	$this->input->post('body_scripts', FALSE),
		'foot_scripts'			=> 	$this->input->post('foot_scripts', FALSE),
		'foot_text'				=> 	$this->input->post('foot_text'),
		'foot_copy'				=> 	$this->input->post('foot_copy'),
		'foot_btn1'				=> 	htmlspecialchars($this->input->post('foot_btn1')),
		'foot_btn2'				=> 	htmlspecialchars($this->input->post('foot_btn2')),
		'foot_btn1_url'			=> 	htmlspecialchars($this->input->post('foot_btn1_url')),
		'foot_btn2_url'			=> 	htmlspecialchars($this->input->post('foot_btn2_url')),
		'page_head' 			=> 	htmlspecialchars($this->input->post('page_head')),
		'page_head_color' 		=> 	htmlspecialchars($this->input->post('page_head_color')),
		'page_caption' 			=> 	htmlspecialchars($this->input->post('page_caption')),
		'page_caption_color' 	=> 	htmlspecialchars($this->input->post('page_caption_color')),
		);
		
		$this->load->library('upload');	
		
		if(isset($_FILES['uploadfile']))
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/logo/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '10240';
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);					
			if ($this->upload->do_upload('uploadfile'))
			{
				    
				    $filename_ephoto = $this->upload->data('uploadfile');
					$data['logo'] = $filename_ephoto['file_name'];
			}
			
		}
		
		if(isset($_FILES['uploadfile2']))
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/logo/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '10240';
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);				
			if ($this->upload->do_upload('uploadfile2'))
			{
				    
				    $filename_ephoto = $this->upload->data('uploadfile2');
					$data['logo_sticky'] = $filename_ephoto['file_name'];
			}
			
		}
		if(isset($_FILES['uploadfile3']))
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/logo/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '10240';
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);				
			if ($this->upload->do_upload('uploadfile3'))
			{
				    
				    $filename_ephoto = $this->upload->data('uploadfile3');
					$data['favicon'] = $filename_ephoto['file_name'];
			}
			
		}

		if(isset($_FILES['uploadfile4']))
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/bg/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '10240';
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);				
			if ($this->upload->do_upload('uploadfile4'))
			{	    
				    $filename_ephoto = $this->upload->data('uploadfile4');
					$data['default_bg'] = $filename_ephoto['file_name'];
			}
			
			
		}
		
		if(isset($_FILES['uploadfile5']))
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/bg/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '10240';
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);				
			if ($this->upload->do_upload('uploadfile5'))
			{
				    
				    $filename_ephoto = $this->upload->data('uploadfile5');
					$data['default_bg2'] = $filename_ephoto['file_name'];
			}
			
			
		}
		if(isset($_FILES['uploadfile6']))
		{
			$config = array();
			$config['upload_path'] = './assets/frontend/images/logo/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '10240';
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['remove_spaces'] = true;
			$this->upload->initialize($config);				
			if ($this->upload->do_upload('uploadfile6'))
			{
				    
				    $filename_ephoto = $this->upload->data('uploadfile6');
					$data['logo2'] = $filename_ephoto['file_name'];
			}
			
			
		}
		
		
		$q = $this->SqlModel->updateRecord('site_settings' , $data , array('id'=>1));
		if($q==true)
		{
			$this->session->set_flashdata('alert','success');
		}
		else{
			$this->session->set_flashdata('alert','error');
		}
		redirect(base_url('manage/home/websettings'));
	}
	
	public function contacts($alert="")
	{
		if($this->SqlModel->checkAccess('access_contacts',$this->user_data)==false)
		{
			redirect(ADMIN_URL);
			exit;	
		}
		$data['contactsActive'] = 1;
		$data['page_title'] = PROJECT_TITLE." | Contact Settings";
		
		$data['alert'] = $this->session->flashdata('alert');
		$data['userdata'] = $this->user_data;
		$data['web'] = $this->SqlModel->getSingleRecord('site_settings',array('id'=>1));
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navigation');
		$this->load->view('admin/contactSettings');
		$this->load->view('admin/footer');
	}
	
	public function savecontacts()
	{
		
		if($this->SqlModel->checkAccess('access_contacts',$this->user_data)==false)
		{
			redirect(ADMIN_URL);
			exit;	
		}
		$data = array(
		'address'				=>	$this->input->post('address'),
		'fax'					=>	htmlspecialchars($this->input->post('fax')),
		'phone'					=>	htmlspecialchars($this->input->post('phone')),
		'contact_text'			=>	$this->input->post('contact_text'),
		'lat_long'				=>	$this->input->post('lat_long'),
		'contact_form_email'	=>	$this->input->post('contact_form_email'),
		'email'					=>	$this->input->post('email'),
		'map_iframe'			=>	$this->input->post('map_iframe',false),
		'sender_name'			=>	htmlspecialchars($this->input->post('sender_name')),
		'sender_email'			=>	$this->input->post('sender_email'),
		'thankyou_text'			=>	$this->input->post('thankyou_text'),
		);
		if(isset($_FILES['uploadfile']))
		{
			$config['upload_path'] = './assets/frontend/images/map/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '102400';
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['remove_spaces'] = true;
			$this->load->library('upload', $config);
			$this->load->library('image_lib');
					
			if ($this->upload->do_upload('uploadfile'))
			{
				    $filename_ephoto = $this->upload->data('uploadfile');
					$data['map_image'] = $filename_ephoto['file_name'];
			}
			
		}
		$q = $this->SqlModel->updateRecord('site_settings' , $data , array('id'=>1));
		if($q==true)
		{
			$this->session->set_flashdata('alert','success');
		}
		else{
			$this->session->set_flashdata('alert','error');
		}
		redirect(base_url('manage/home/contacts'));
	}
	
	
	
}

