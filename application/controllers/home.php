<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    public $ws;
	public $isMobile;
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->ws = $this->SqlModel->getSingleRecord('site_settings', array('id' => 1));
        if (isset($this->ws['under_construction']) && $this->ws['under_construction'] == "Yes" && $this->input->get('preview') != "1") {
            redirect(base_url('under-construction.html'));
        }
        $sessid = $this->session->userdata('sessid');
        if ($sessid == "") {
            $this->session->set_userdata('sessid', $this->session->userdata('session_id'));
        }
		
		$this->load->library('user_agent');

		if ($this->agent->is_mobile())
		{
				$this->isMobile = true;
		}
		else
		{
				$this->isMobile = false;
		}

	

    }
	private function testemail(){
		
		$this->load->library('email');

		$this->email->from('wakas@outlook.com', 'Waqas Ahmed');
		$this->email->to('waqas@ctechsols.com');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		
		$q = $this->email->send();	
		var_dump($q);
		echo $this->email->print_debugger();
		
		
		$subject = "Quick Contact ".date('M d, Y h:i a');
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		$to  = "waqas@ctechsols.com";
		$headers .= 'To: Waqas Ahmed  <waqas@ctechsols.com>' . "\r\n";
		$headers .= 'From: Waqas Ahmed  <wakas@outlook.com>' . "\r\n";
		$body = "test email";
		// Mail it
		if(mail($to, $subject, $body, $headers))
		{
			echo json_encode(array('status'=>'true'));
		}else{
			echo json_encode(array('status'=>'false'));	
		}
	}
	
	
    public function index()
    {
        $this->page($this->SqlModel->getSingleField('page_uri', 'pages', array('page_id' => 1)));
    }
		
	
	
	
	public function getIPData()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://ipinfo.io/'.$this->session->userdata('ip_address').'/json',
		   
		));
		// Send the request & save response to $resp
		$dataRequest = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);
		
		if($dataRequest)
		{
			
			return json_decode($dataRequest,false);	
		}
		else{
			return array();	
		}
		
	}

    public function page($page_uri = "")
    {
        $preview = $this->input->get('preview');
        $page_uri = str_replace(".html", "", $page_uri);
		$userData = $this->SqlModel->checkUserLogin();
        if ($preview == "1") {
            $where = array('page_uri' => $page_uri);
        } else {
            $where = array('page_uri' => $page_uri, 'page_status' => 'Published');
        }
        $pageData = $this->SqlModel->getSingleRecord('pages', $where);
        if (empty($pageData)) {
            //redirect(base_url());
        	$this->getNotFound();
			
		}
		else if(empty($userData) && $pageData['page_featured'] == "Yes")
		{
			$this->getNotFound();
		}
		else{
			
			
			
			$data = array(
				'pageData' 			=> $pageData,
				'page_title' 		=> $pageData['page_title'],
				'foot1' 			=> $this->SqlModel->getFoot('one'),
				'page_meta_key' 	=> $pageData['page_meta_key'],
				'page_meta_desc' 	=> $pageData['page_meta_desc'],
				'nav' 				=> $this->SqlModel->getNav($pageData['page_id']),
				'slider' 			=> $this->SqlModel->getSlider('slider', $pageData['page_slider']),
				'isPage'			=>	true,
				'login_url'		=>	base_url($this->SqlModel->getSingleField('page_uri','pages',array('page_id' => 2, 'page_status' => 'Published'))),
				'reg_url'		=>	base_url($this->SqlModel->getSingleField('page_uri','pages',array('page_id' => 3, 'page_status' => 'Published'))),
				'forgot_url'	=>	base_url($this->SqlModel->getSingleField('page_uri','pages',array('page_id' => 4, 'page_status' => 'Published'))),
				'userData'		=>	$userData
			);
			if(isset($pageData['page_image']) && $pageData['page_image']!="" && file_exists('./assets/frontend/images/pages/'.$pageData['page_image'])) 
			{
				$data['og_image'] = $this->imagethumb->image('./assets/frontend/images/pages/'.$pageData['page_image'],1200,630);
			}
			
		
			$showView = "page";
			
			if ($pageData['page_id'] == 1 || $pageData['page_id'] == 2 || $pageData['page_id'] == 3 || $pageData['page_id'] == 4 || $pageData['page_id'] == 5 || $pageData['page_id'] == 6) {
				
				$showView = "home";
				$data['no_footer'] 	=	true;
				$data['hNav'] 		=	true;
			} 
			else if($pageData['page_id']==12)
			{
				$data['members']	=	$this->SqlModel->getRecords('*', 'team_members', 'member_order', 'ASC', array('member_status' => 'Enable'));
			}
			else if($pageData['page_id']==7)
			{
				$showView = "contact";
			}
			
		
	
			$this->load->view('header', $data);
			//$this->load->view('slider');
			$this->load->view($showView);
			$this->load->view('footer');
		}

    }
	
	function curl_get_contents($url)
	{
	  $ch = curl_init($url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	  $data = curl_exec($ch);
	  curl_close($ch);
	  return $data;
	}

	

    public function docontact()
    {
		
	
		$con_name		=   trim($this->input->post('con_name'));
		$con_email		=   trim($this->input->post('con_email'));
		$con_phone		=   trim($this->input->post('con_phone'));
		//$con_country	=   trim($this->input->post('con_country'));
		$con_message 	= 	trim($this->input->post('con_message'));
		$con_file = "";
		
		
		
		if($con_name=="" || !filter_var($con_email, FILTER_VALIDATE_EMAIL) )
		{
			$this->session->set_flashdata('alert','error');
			redirect(base_url($this->SqlModel->getSingleField('page_uri','pages',array('page_id'=>7,'page_status'=>'Published'))));
			//echo json_encode(array('status'=>'false','message'=>'Please fill all the required fields'));
			exit;
		}
		
		if(isset($_FILES['con_file'])){
			$fExt = strtolower(end(explode(".",$_FILES['con_file']['name'])));
			$badExt = array('gzquar','exe','zix','jar','swf','dll','sys','scr','lnk','shs','js','wmf','com','chm','ozd','ocx','ws','scr','aru','xlm','bat','xtbl','drv','vbs','pif','bin','vbe','class','dev','xnxx','vexe','exe1','386','tps','php3','pgm','hlp','vb','vxd','buk','pcx','rsc_tmp','dxz','vba','sop','wlpginstall','boo','bkd','cla','tsa','cih','kcd','s7p','osa','exe_renamed','smm','smtmp','dom','hlw','vbx','dyz','rhk','fag','qrn','dlb','fnr','mfu','xir','lik','ctbl','dyv','bll','bxz','mjz','wsc','mjg','dli','ska','dllx','tti','fjl','upa','txs','wsh','cfxxe','xdu','uzy','bup','spam','.9','iws','oar','nls','ezt','cxq','blf','dbd','cc','xlv','rna','tko','delf','bhx','ceo','bps','atm','vzr','ce0','lkh','hsq','pid','zvz','bmw','fuj','ssy','hts','aepl','qit','mcq','dx','lok','let','plc','cyw','bqf','iva','pr','xnt','aut','lpaq5','capxml','php','hmtl','php5');
			if(!in_array($fExt,$badExt))
			{
				$this->load->library('upload');	
				$config = array();
				$config['upload_path'] = './assets/contact_files/';
				$config['allowed_types'] = '*';
				$config['max_size']	= '50240';
				$config['remove_spaces'] = true;
				$this->upload->initialize($config);					
				if ($this->upload->do_upload('con_file'))
				{
						
						$filename_ephoto = $this->upload->data('con_file');
						$con_file = $filename_ephoto['file_name'];
				}
					
				
			}
		}
		
		
		$webTitle = trim($this->ws['website_title']);
		$to = trim($this->ws['contact_form_email']);
		$subject = "[Contact Us] ".date('F d, Y h:i a');
		
		$body = '<html>
	<head>
	<style>
	table{
	border: 1px solid #EAEAEA;
	margin-top:20px;
	border-collapse:collapse;	
	}
	table tr{
	border-bottom: 1px solid #EAEAEA;
	}
	table_span{
	clear:both;
	display:block;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#FF0000;
	margin-bottom:5px;
	}
	table td{
	padding:10px 5px;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#737373;
	}
	table h3{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight:normal;
	color:#666;
	margin:8px 0px;
	}
	</style>
	</head>
	<body>
	<table  width="100%">
       <tr>
		<td colspan="2"><h3>Contact Us</h3></td>
        </tr>
       
	   
		 <tr>
        <td><strong>Name: </strong></td><td>'.$con_name.'</td>
		</tr>
		 
		<tr>
        <td><strong>Email: </strong></td><td>'.$con_email.'</td>
		</tr>
			 
		<tr>
        <td><strong>Phone: </strong></td><td>'.$con_phone.'</td>
		</tr>
		
		<tr>
        <td><strong>Message: </strong></td><td>'.nl2br($con_message).'</td>
		</tr>
		<tr>
        <td><strong>Attachment: </strong></td><td>'.(($con_file!="" && file_exists('./assets/contact_files/'.$con_file)) ? '<a href="'.base_url('assets/contact_files/'.$con_file).'" target="_blank">'.$con_file.'</a>' : 'N/A').'</td>
		</tr>
		
		<tr>
		<td><strong>IP Address: </strong></td><td>'.$this->session->userdata('ip_address').'</td>
		</tr>
		<tr>
		<td><strong>Useragent: </strong></td><td>'.$this->session->userdata('user_agent').'</td>
		</tr>
		 <tr>
        <td><strong>Date/Time: </strong></td><td>'.date('M d, Y h:i a').'</td>
        </tr>
		</table></body></html>';
		$config = array(
		'mailtype'=>'html',
		'useragent'=>$webTitle ,
		
		);
		
		$data = array(
			'con_fname'			=>		$con_name,
			'con_lname'			=>		'',
			'con_email'			=>		$con_email,
			'con_subject'		=>		'',
			'con_phone'			=>		$con_phone,
			'con_country'		=>		'',
			'con_message'		=>		$con_message,
			'con_ip'			=>		$this->session->userdata('ip_address'),
			'con_user_agent'	=>		$this->session->userdata('user_agent'),
			'con_added'			=>		date('Y-m-d H:i:s'),
			'con_updated'		=>		date('Y-m-d H:i:s'),
			'con_file'			=>		$con_file
		
		);
		$this->SqlModel->insertRecord('contact_us',$data);
		$this->load->library('email',$config);
		
		$senderEmail 	= 	$this->ws['sender_email'];
		$sender_name	=	$this->ws['sender_name'];
		$this->email->from($senderEmail, $sender_name );
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body);
		
		if(@$this->email->send())
		{
			$this->session->set_flashdata('alert','success');
			redirect(base_url($this->SqlModel->getSingleField('page_uri','pages',array('page_id'=>7,'page_status'=>'Published'))));
		}
		else{
			$this->session->set_flashdata('alert','error');
			redirect(base_url($this->SqlModel->getSingleField('page_uri','pages',array('page_id'=>7,'page_status'=>'Published'))));
		}
		//echo $this->email->print_debugger();

		
	}
	
	
	 function addOrdinalNumberSuffix($num) {
		if (!in_array(($num % 100),array(11,12,13))){
		  switch ($num % 10) {
			// Handle 1st, 2nd, 3rd
			case 1:  return $num.'st';
			case 2:  return $num.'nd';
			case 3:  return $num.'rd';
		  }
		}
		return $num.'th';
	  }
	  
	public function getNotFound()
    {        
		

        $data = array(
            'page_title' 		=> 'Page not found - '.$this->ws['website_title'],
            'foot1' 			=> $this->SqlModel->getFoot('one'),
            'page_meta_key' 	=> '',
            'page_meta_desc' 	=> '',
            'nav' 				=> $this->SqlModel->getNav(0),
			'slider' 			=> $this->SqlModel->getSlider('slider', 0),
			
			
        );
	    $showView = "pageNotFound";
        $this->load->view('header', $data);
      	// $this->load->view('search-banner');
        $this->load->view($showView);
        $this->load->view('footer');

    }
	
	public function getExt()
	{
		$badExt = array('gzquar','exe','zix','jar','swf','dll','sys','scr','lnk','shs','js','wmf','com','chm','ozd','ocx','ws','scr','aru','xlm','bat','xtbl','drv','vbs','pif','bin','vbe','class','dev','xnxx','vexe','exe1','386','tps','php3','pgm','hlp','vb','vxd','buk','pcx','rsc_tmp','dxz','vba','sop','wlpginstall','boo','bkd','cla','tsa','cih','kcd','s7p','osa','exe_renamed','smm','smtmp','dom','hlw','vbx','dyz','rhk','fag','qrn','dlb','fnr','mfu','xir','lik','ctbl','dyv','bll','bxz','mjz','wsc','mjg','dli','ska','dllx','tti','fjl','upa','txs','wsh','cfxxe','xdu','uzy','bup','spam','.9','iws','oar','nls','ezt','cxq','blf','dbd','cc','xlv','rna','tko','delf','bhx','ceo','bps','atm','vzr','ce0','lkh','hsq','pid','zvz','bmw','fuj','ssy','hts','aepl','qit','mcq','dx','lok','let','plc','cyw','bqf','iva','pr','xnt','aut','lpaq5','capxml');
		echo '<pre>';
		print_r($badExt);
		
	}


	public function doregister()
	{
		$usr_name = $this->db->escape_str(trim($this->input->post('name')));
		$usr_user_name = $this->db->escape_str(trim($this->input->post('username')));
		$usr_email = $this->db->escape_str(trim($this->input->post('email')));
		$usr_phone = $this->db->escape_str(trim($this->input->post('phone')));
		$usr_pwd = trim($this->input->post('password'));
		
		if($usr_name == "" || $usr_user_name == "" || $usr_email == "" || $usr_pwd == "")
		{
			echo json_encode(array('status'=>'false','message'=>'Please complete all fields to register.'));
			
		}
		else if(filter_var($usr_email, FILTER_VALIDATE_EMAIL) === false)
		{
			echo json_encode(array('status'=>'false','message'=>'Please provide valid e-mail address.')); 
		}
		else if($this->SqlModel->countRecords('website_users',array('usr_email'=>$usr_email))>0)
		{
			echo json_encode(array('status'=>'false','message'=>'The email-address you have entered is already registered, please use different e-email.'));
		}
		else if($this->SqlModel->countRecords('website_users',array('usr_user_name'=>$usr_user_name))>0)
		{
			echo json_encode(array('status'=>'false','message'=>'The username you have eneterd is already taken, please use different username.'));
		}
		else{
			$userArr = array(
				'usr_name'		=>		$usr_name,
				'usr_phone'		=>		$usr_phone,
				'usr_email'		=>		$usr_email,
				'usr_user_name'	=>		$usr_user_name,
				'usr_pwd'		=>		md5($usr_pwd),
				'usr_status'	=>		'Enable',
				'usr_regdate'	=>		date('Y-m-d H:i:s'),
				'usr_lastip'	=>		$this->session->userdata('ip_address'),
				'usr_agent'		=>		$this->session->userdata('user_agent'),
				'usr_lastlogin'	=>		date('Y-m-d H:i:s'),
			);
			
			$q = $this->SqlModel->insertRecord('website_users',$userArr);
			if($q>0)
			{
				$this->session->set_userdata('usr_auth','Yes');
				$this->session->set_userdata('usr_id',$q);
				$this->session->set_userdata('usr_lastlogin',$userArr['usr_lastlogin']);
				
				echo json_encode(array('status'=>'true','message'=>'Thank you! Your account has been succesfully registered.')); 
				$webTitle = trim($this->ws['website_title']);
				
				
				$body = '<html>
	<head>
	<style>
	table{
	border: 1px solid #EAEAEA;
	margin-top:20px;
	border-collapse:collapse;	
	}
	table tr{
	border-bottom: 1px solid #EAEAEA;
	}
	table_span{
	clear:both;
	display:block;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#FF0000;
	margin-bottom:5px;
	}
	table td{
	padding:10px 5px;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#737373;
	}
	table h3{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight:normal;
	color:#666;
	margin:8px 0px;
	}
	</style>
	</head>
	<body>
	<table  width="100%"><tr><td>';
				
				$body .= "Hello ".$userArr['usr_name'].", <br/><br/>Your account has been successfully registered at ".$webTitle.". Use the information below to login to your account:<br/><br/>Username: ".$userArr['usr_user_name']."<br/>Password: ".$usr_pwd."<br/><br/>Thank you,</br>".$webTitle.' Team</td></tr></table></body></html>';
				
				
				
				
				$senderEmail 	= 	trim($this->ws['sender_email']);
				$sender_name	=	trim($this->ws['sender_name']);
				$to 			= 	trim($userArr['usr_email']);
				$cc 			= 	trim($this->ws['contact_form_email']);
				$subject		=	"Account Registration";
				$config = array(
				'mailtype'=>'html',
				'useragent'=>$webTitle 
				);

				$this->load->library('email',$config);
				$this->email->from($senderEmail, $sender_name );
				$this->email->to($to);
				$this->email->cc($cc);
				$this->email->subject($subject);
				$this->email->message($body);
				@$this->email->send();
			}
			else{
				echo json_encode(array('status'=>'false','message'=>'Sorry! An unknown error occurred during registration, please try again.')); 
			}
		}
	}
	
	public function dologin()
	{
		$un = $this->db->escape_str(trim($this->input->post('userName')));
		$pwd = $this->db->escape_str(trim($this->input->post('userPassword')));
		if($un=="" || $pwd=="")
		{
			echo json_encode(array('status'=>'false','message'=>'Invalid username or password.'));
			return;
		}
		
		$data = $this->SqlModel->getSingleRecord('website_users', array('usr_user_name'=>$un,'usr_status'=>'Enable'));
		if(empty($data))
		{
			echo json_encode(array('status'=>'false','message'=>"The username that you've entered is incorrect."));
			return;
		}
		
		if(md5($pwd) == $data['usr_pwd'])
		{
			$this->session->set_userdata('usr_auth','Yes');
			$this->session->set_userdata('usr_id',$data['usr_id']);
			$this->session->set_userdata('usr_lastlogin',$data['usr_lastlogin']);
			$this->SqlModel->updateRecord('website_users', array('usr_lastlogin'=>date('Y-m-d H:i:s'),'usr_lastip'=>$this->session->userdata('ip_address'),'usr_agent'=>$this->session->userdata('user_agent')), array('usr_id'=>$data['usr_id']));
			echo json_encode(array('status'=>'true','message'=>'Login Successfull'));
		}
		else{
			echo json_encode(array('status'=>'false','message'=>"The password that you've entered is incorrect."));
			return;
		};
	}
	
	public function logout()
	{
		$this->session->unset_userdata('usr_auth');
		$this->session->unset_userdata('usr_id');
		$this->session->unset_userdata('usr_lastlogin');
		redirect(base_url());
	}
	
	public function doforgot(){
		
		$usr_email = $this->db->escape_str(trim($this->input->post('forgot_email')));
		if($usr_email=="")
		{
			echo json_encode(array('status'=>'false','message'=>'Sorry! We are unable to find any account associated with your provided email.'));
			exit;
			
		}
		else if(filter_var($usr_email, FILTER_VALIDATE_EMAIL) === false)
		{
			echo json_encode(array('status'=>'false','message'=>'Sorry! We are unable to find any account associated with your provided email.')); 
			exit;
		}
		
		
		$userData = $this->SqlModel->getSingleRecord('website_users',array('usr_email'=>$usr_email,'usr_status'=>'Enable'));
		if(!empty($userData))
		{
				$pwd = substr(uniqid(),1,6);
				$this->SqlModel->updateRecord('website_users', array('usr_pwd'=>md5($pwd)), array('usr_id'=>$userData['usr_id']));				
				$webTitle = trim($this->ws['website_title']);
				
				
				$body = '<html>
	<head>
	<style>
	table{
	border: 1px solid #EAEAEA;
	margin-top:20px;
	border-collapse:collapse;	
	}
	table tr{
	border-bottom: 1px solid #EAEAEA;
	}
	table_span{
	clear:both;
	display:block;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#FF0000;
	margin-bottom:5px;
	}
	table td{
	padding:10px 5px;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#737373;
	}
	table h3{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight:normal;
	color:#666;
	margin:8px 0px;
	}
	</style>
	</head>
	<body>
	<table  width="100%"><tr><td>';
				
				$body .= "Hello ".$userData['usr_name'].", <br/><br/>As requested, we're sending you a new password. Use the information below to login to your account:<br/><br/>Username: ".$userData['usr_user_name']."<br/>New Password: ".$pwd."<br/><br/>Thank you,</br>".$webTitle.' Team</td></tr></table></body></html>';
				
				
				
				
				$senderEmail 	= 	trim($this->ws['sender_email']);
				$sender_name	=	trim($this->ws['sender_name']);
				$to 			= 	trim($userData['usr_email']);
				$cc 			= 	trim($this->ws['contact_form_email']);
				$subject		=	"Your ".$webTitle." New Password";
				$config = array(
				'mailtype'=>'html',
				'useragent'=>$webTitle 
				);

				$this->load->library('email',$config);
				$this->email->from($senderEmail, $sender_name );
				$this->email->to($to);
				$this->email->cc($cc);
				$this->email->subject($subject);
				$this->email->message($body);
				if(@$this->email->send())
				{
					echo json_encode(array('status'=>'true','message'=>'Your password has been successfully reset, please check your email for new password.'));
				}
				else{
					echo json_encode(array('status'=>'false','message'=>'An unknown error occurred, please try again.'));
		
				}
						
		}
		else{
				echo json_encode(array('status'=>'false','message'=>'Sorry! We are unable to find any account associated with your provided email.'));
		}
		
	}
	
	
	public function dopwd()
	{
		if($this->session->userdata('usr_auth')!="Yes")
		{
			echo json_encode(array('status'=>'false','message'=>'An unknown error occurred, please try again.'));
			exit;	
		}
		$userData = $this->SqlModel->getSingleRecord('website_users',array('usr_id'=>$this->session->userdata('usr_id'),'usr_status'=>'Enable'));
		if(empty($userData))
		{
			echo json_encode(array('status'=>'false','message'=>'An unknown error occurred, please try again.'));
			exit;
		}
		$cpwd = trim($this->input->post('cpassword'));
		$usr_pwd = trim($this->input->post('password'));
		
		
		if($userData['usr_pwd'] == md5($cpwd))
		{
			$userArr = array(
				'usr_pwd'		=>		md5($usr_pwd),
			);
			
			$q = $this->SqlModel->updateRecord('website_users',$userArr,array('usr_id'=>$this->session->userdata('usr_id')));
			if($q)
			{
				
				echo json_encode(array('status'=>'true','message'=>'Your password has been changed successfully!'));
			}
			else{
				echo json_encode(array('status'=>'false','message'=>'An unknown error occurred, please try again.'));		
			}
			
		}
		else{
			echo json_encode(array('status'=>'false','message'=>'You have provided an incorrect current password.'));
		}
	}

	public function doedit()
	{
		if($this->session->userdata('usr_auth')!="Yes")
		{
			echo json_encode(array('status'=>'false','message'=>'Sorry! We are unable to update your profile, please try again.'));
			exit;	
		}
				
		$usr_name = $this->db->escape_str(trim($this->input->post('name')));
		$usr_phone = $this->db->escape_str(trim($this->input->post('usr_phone')));
		$usr_email = $this->db->escape_str(trim($this->input->post('email')));
		$news = trim($this->input->post('news'));
		
		if($usr_name == "" || $usr_email == "" )
		{
			echo json_encode(array('status'=>'false','message'=>'Sorry! We are unable to update your profile, please try again.'));
			
		}
		else if(filter_var($usr_email, FILTER_VALIDATE_EMAIL) === false)
		{
			echo json_encode(array('status'=>'false','message'=>'Sorry! We are unable to update your profile, please try again.'));
		}
		else if($this->SqlModel->countRecords('website_users',array('usr_email'=>$usr_email,'usr_id !='=>$this->session->userdata('usr_id')))>0)
		{
			echo json_encode(array('status'=>'false','message'=>'The e-mail address you have provided is already registred, please use different email addresss.'));
		}
		else{
			$userArr = array(
				'usr_name'		=>		$usr_name,
				'usr_phone'		=>		$usr_phone,
				'usr_email'		=>		$usr_email,
			);
			
			$q = $this->SqlModel->updateRecord('website_users',$userArr,array('usr_id'=>$this->session->userdata('usr_id')));
			if($q)
			{
				
				echo json_encode(array('status'=>'true','message'=>'Your profile has been successfully updated.'));
			}
			else{
				echo json_encode(array('status'=>'false','message'=>'Sorry! We are unable to update your profile, please try again.'));		}
		}
	}
	//ENd of class
}	

