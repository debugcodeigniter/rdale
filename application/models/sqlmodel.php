<?php

class SqlModel extends CI_Model
{

    private $table;

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }




    /****************************** Start General Functions ***********************/

    //insert function
    function insertRecord($table, $colums)
    {
        if ($this->db->insert($table, $colums))
            return $this->db->insert_id();
        else
            return false;
    }

    //update function
    function updateRecord($table, $colums, $condition)
    {
        if ($this->db->update($table, $colums, $condition))
            return true;
        else
            return false;
    }

    function batchInsert($table, $data)
    {
        if ($this->db->insert_batch($table, $data))
            return true;
        else
            return false;
    }

    function batchUpdate($table, $data, $whereKey)
    {
        if ($this->db->update_batch($table, $data, $whereKey))
            return true;
        else
            return false;
    }

    // delete function
    function deleteRecord($table, $condition)
    {
        if ($this->db->delete($table, $condition)) {
            //echo $this->db->last_query();
            return true;
        } else {
            return false;
        }
    }

    function runQuery($sql, $flag = '')
    {
        $this->result = $this->db->query($sql);
        if ($flag)
            return $this->result->row_array();
        else
            return $this->result->result_array();
    }


    public function getSingleRecord($table, $where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $count = $this->db->count_all_results();
        if ($count == "1") {
            $query = $this->db->get_where($table, $where);
            $data = $query->row_array();
            return $data;
        } else {
            return null;
        }
    }
	
	 public function getSingleRecordWithCols($cols="*", $table, $where)
     {
        $this->db->select($cols);
        $this->db->from($table);
        $this->db->where($where);
        $count = $this->db->count_all_results();
        if ($count == "1") {
            $query = $this->db->get_where($table, $where);
            $data = $query->row_array();
            return $data;
        } else {
            return null;
        }
    }

    public function getSingleField($col, $table, $where)
    {
        $this->db->select($col);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        $data = $query->row_array();
        if (isset($data[$col])) {
            return $data[$col];
        } else {
            return null;
        }
    }


    public function getRecords($fields, $table, $sortby = "", $order = "", $where = "", $search = array(), $limit = "0", $start = "0", $addqoutes = TRUE)
    {
        $this->db->select($fields, $addqoutes);
        $this->db->from($table);
        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($search) && isset($search['cols']) && isset($search['value']) && $search['cols'] != "" && $search['value'] != "") {
            $like = "(";
            $colArray = explode(",", $search['cols']);
            foreach ($colArray as $c) {
                $like .= " " . trim($c) . " LIKE '%" . $this->db->escape_like_str(trim($search['value'])) . "%' OR ";
            }

            $vs = explode(" ", $search['value']);
            if (count($vs) > 1) {
                foreach ($vs as $v) {
                    foreach ($colArray as $c) {
                        $like .= " " . trim($c) . " LIKE '%" . $this->db->escape_like_str(trim($v)) . "%' OR ";
                    }
                }
            }

            $like = rtrim($like, "OR ");
            $like .= ")";
            $this->db->where($like);
        }

        if ($sortby != "" && $order != "") {
            $this->db->order_by($sortby, $order);
        }

        if ($limit != "0") {
            $this->db->limit($limit, $start);

        }
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;

    }


    public function countRecords($table, $where = array(), $search = array())
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($search) && isset($search['cols']) && isset($search['value']) && $search['cols'] != "" && $search['value'] != "") {
            $like = "(";
            $colArray = explode(",", $search['cols']);
            foreach ($colArray as $c) {
                $like .= " " . trim($c) . " LIKE '%" . $this->db->escape_like_str($search['value']) . "%' OR ";
            }

            $vs = explode(" ", $search['value']);
            if (count($vs) > 1) {
                foreach ($vs as $v) {
                    foreach ($colArray as $c) {
                        $like .= " " . trim($c) . " LIKE '%" . $this->db->escape_like_str($v) . "%' OR ";
                    }
                }
            }

            $like = rtrim($like, "OR ");
            $like .= ")";
            $this->db->where($like);
        }
        $records = $this->db->count_all_results();
        return $records;
    }

    public function checkCookie()
    {
        if ($this->input->cookie('zenvita_remember') && $this->input->cookie('zenvita_remember') != "" && $this->session->userdata('usr_auth') != "Yes") {

            $data = $this->SqlModel->getSingleRecord('zen_users', array('user_id' => $this->encrypt->decode($this->input->cookie('zenvita_remember', true)), 'user_status' => 'Enable'));

            if (!empty($data)) {
                $this->session->set_userdata('usr_auth', 'Yes');
                $this->session->set_userdata('usr_id', $data['user_id']);
                $this->session->set_userdata('user_type', $data['user_type']);
            }
        }
    }

    public function truncate($table = "")
    {
        if ($table == "") {
            return;
        }
        if ($this->db->truncate($table)) {
            return true;
        } else {
            return false;
        }
    }

    public function seostring($rstring = "")
    {
        $string = preg_replace('/\%/', ' percentage', $rstring);
        $string = preg_replace('/\@/', ' at ', $string);
        $string = preg_replace('/\&/', ' and ', $string);
        $string = preg_replace('/\s[\s]+/', '-', $string);    // Strip off multiple spaces
        $string = preg_replace('/[\s\W]+/', '-', $string);    // Strip off spaces and non-alpha-numeric
        $string = preg_replace('/^[\-]+/', '', $string); // Strip off the starting hyphens
        $string = preg_replace('/[\-]+$/', '', $string); // // Strip off the ending hyphens
        $string = strtolower($string);
        $string = str_replace(" ", "-", $string) . '.html';
        return $string;
    }


    public function authAdmin($authKey = "", $adminID = "")
    {
        if ($authKey == "allow" && $adminID != "") {
            $adminData = $this->getSingleRecord('admin_users', array('id' => $adminID, 'status' => 'Enable'));
            if (empty($adminID)) {
                return false;
            } else {
                $this->setTitle();
                return $adminData;
            }
        } else {
            return false;
        }

    }

    public function setTitle()
    {
        $webTitle = $this->getSingleField('website_title', 'site_settings', array('id' => 1));
        
		if(!defined("PROJECT_TITLE"))
		{
			define('PROJECT_TITLE', $webTitle);
		}
    }

    //For getting slider images
    public function getSlider($table = "", $id = "0")
    {
        $d = array();
        if ($table != "") {
            $query = "SELECT *, slider_large as image FROM " . $table . " s WHERE s.slider_cat='" . $id . "' AND s.`slider_status`='Enable' ORDER BY slider_order ASC";
            $d = $this->runQuery($query);
        }
        return $d;
    }

    //For getting navigation
    public function getNav($page_id = 0)
    {
		$uData = $this->checkUserLogin();
		$where1 = array('page_status' => 'Published', 'menu_active' => 1, 'menu_parent_id' => 0);
		if(empty($uData))
		{
			$where1['page_featured'] = "No";	
		}
        $nav = $this->getRecords('page_parent_id,menu_parent_id,menu_name,page_name,page_uri,page_id', 'pages', 'menu_order', 'ASC', $where1);
        
		$html = "";
        if (!empty($nav)) {
            foreach ($nav as $n) {
				$where2 = array('page_status' => 'Published', 'menu_active' => 1, 'menu_parent_id' => $n['page_id']);
				if(empty($uData))
				{
					$where2['page_featured'] = "No";	
				}
                $nnav = $this->getRecords('page_parent_id,menu_parent_id,menu_name,page_name,page_uri,page_id', 'pages', 'menu_order', 'ASC', $where2);

                $innerHtml = "";
                if (!empty($nnav)) {
                    $innerHtml = '<ul id="collapse'.$n['page_id'].'"  class="dropdown-menu panel-collapse collapse" role="menu">';
                    foreach ($nnav as $nn) {
                       
                        $innerHtml .= '<li><a  title="' . $nn['menu_name'] . '" href="' . base_url($nn['page_uri'] . '') . '">' . $nn['menu_name'] . '</a></li>';
                    }
                    $innerHtml .= '</ul>';
                }
				
			
				
				if($n['page_id'] == "2")
				{
				
					if(!empty($uData)){
							$html.='<li class="dropdown panel simple-dropdown">
                                    <a href="#collapse7" class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#myaccount" data-hover="dropdown">My Account <i class="fa fa-angle-down"></i></a>
                                    <!-- sub menu single -->
                                    <!-- sub menu item  -->
                                    <ul id="myaccount" class="dropdown-menu panel-collapse collapse" role="menu">
                                        <li><a href="'.base_url($this->SqlModel->getSingleField('page_uri','pages',array('page_id' => 6, 'page_status' => 'Published'))).'">- '.$this->SqlModel->getSingleField('menu_name','pages',array('page_id' => 6, 'page_status' => 'Published')).'</a></li>
                                        <li><a href="'.base_url($this->SqlModel->getSingleField('page_uri','pages',array('page_id' => 5, 'page_status' => 'Published'))).'">- '.$this->SqlModel->getSingleField('menu_name','pages',array('page_id' => 5, 'page_status' => 'Published')).'</a></li>
                                        <li><a href="'.base_url('sign-out').'">- Sign Out</a></li>
                                    </ul>
                                    <!-- end sub menu item  -->
                                    <!-- end sub menu single -->
                                </li>';
					}else if($page_id == "1" || $page_id == "2" || $page_id == "3" || $page_id == "4"){
					$html .= '<li class="hidden-md hidden-lg"><a title="' . $n['menu_name'] . '" data-href="#login-box" class=" rd-factions" href="' . base_url($n['page_uri'] . '') . '">' . $n['menu_name'] .  '</a>' . $innerHtml;
					$html .= '</li>';
					$html .= '<li class="hidden-sm hidden-xs"><a title="' . $n['menu_name'] . '" data-href="#login-box" class="ilogin rd-factions" href="' . base_url($n['page_uri'] . '') . '">' . $n['menu_name'] .  '</a>' . $innerHtml;
					$html .= '</li>';
					}else{
						$html .= '<li class="hidden-md hidden-lg"><a title="' . $n['menu_name'] . '" class="" href="' . base_url($n['page_uri'] . '') . '">' . $n['menu_name'] .  '</a>' . $innerHtml;
					$html .= '</li>';
					$html .= '<li class="hidden-sm hidden-xs"><a title="' . $n['menu_name'] . '"  class="ilogin " href="' . base_url($n['page_uri'] . '') . '">' . $n['menu_name'] .  '</a>' . $innerHtml;
					$html .= '</li>';
					}
				}
				else if(($n['page_id'] == "3" && !empty($this->checkUserLogin())) || ($n['page_id'] == "4" && !empty($this->checkUserLogin())))
				{
					
				}
				else{
				
					$html .= '<li '.(($innerHtml!="") ? 'class="dropdown panel simple-dropdown"' : '').'><a '.(($innerHtml!="") ? 'class="dropdown-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-hover="dropdown"' : '').' title="' . $n['menu_name'] . '" href="' . (($innerHtml!="") ? '#collapse'.$n['page_id'] : base_url($n['page_uri'] . '')) . '">' . $n['menu_name'] .(($innerHtml!="") ? ' <i class="fa fa-angle-down"></i>' : '').  '</a>' . $innerHtml;
					$html .= '</li>';
				}

            }
        }

        return $html;
    }


    public function checkAccess($type = "", $uD = array())
    {
        if ($type == "" || empty($uD)) {
            redirect(ADMIN_URL);
            exit;
        }
        //echo $type.'<Br>'.$uD['user_role'].'<br/>'.$uD[$type];
        //exit;
        if ($uD['user_role'] == "Admin" && $uD[$type] == "No") {
            return false;
        } else {
            return true;
        }


    }

    public function publish()
    {
        $page_pub = "UPDATE pages p SET page_status='Published', page_pdate='0000-00-00 00:00:00' WHERE p.`page_pdate`<='" . date('Y-m-d H:i:s') . "' AND p.`page_pdate`!='0000-00-00 00:00:00'";
        @$this->db->query($page_pub);

        $page_pub = "UPDATE pages p SET page_status='Un-Published', page_update='0000-00-00 00:00:00' WHERE p.`page_update`<='" . date('Y-m-d H:i:s') . "' AND p.`page_update`!='0000-00-00 00:00:00'";
        @$this->db->query($page_pub);

        $blog_pub = "UPDATE blogs p SET blog_status='Published', blog_pdate='0000-00-00 00:00:00' WHERE p.`blog_pdate`<='" . date('Y-m-d H:i:s') . "' AND p.`blog_pdate`!='0000-00-00 00:00:00'";
        @$this->db->query($page_pub);

        $blog_pub = "UPDATE blogs p SET blog_status='Un-Published', blog_update='0000-00-00 00:00:00' WHERE p.`blog_update`<='" . date('Y-m-d H:i:s') . "' AND p.`blog_update`!='0000-00-00 00:00:00'";
        @$this->db->query($page_pub);

    }

    //For Sub pages
    public function getSubPages($page_id, $html)
    {
        $subhtml = "";
        if (strpos($html, '{subpages}') !== FALSE) {
            $subPages = $this->runQuery("SELECT p.`page_uri`,p.`page_name` FROM pages p WHERE p.`page_status`='Published' AND p.`page_pdate`='0000-00-00 00:00:00' AND p.`page_parent_id`=" . $page_id . " ORDER BY p.`page_order` ASC");
            if (!empty($subPages)) {
                $subhtml .= '<blockquote class="orange"><div class="button-wrapper">';
                $i = 1;
                foreach ($subPages as $s) {
                    $subhtml .= '<a href="' . base_url($s['page_uri']) . '">' . $s['page_name'] . '</a>';
                    if ($i < count($subPages)) {
                        $subhtml .= '<br><br>';
                    }
                    $i++;
                }
                $subhtml .= '</div></blockquote>';
                $html = str_replace("{subpages}", $subhtml, $html);
                return $html;

            }

        } else {
            return $html;
        }


    }

    public function getFoot($type = "")
    {
        $html = "";
        if ($type != "one" && $type != "two" && $type != "three") {
            return $html;
        } else {
            $type = "_" . strtolower($type);
            $foot = $this->runQuery("SELECT page_id,menu_name,page_uri FROM pages WHERE menu_parent_id" . $type . " = '0' AND menu_active" . $type . " = 1 ORDER BY menu_order" . $type . " ASC");
            $totalFoot = count($foot);
            $footCnt = (int)1;
            if (count($foot) > 0) {
                foreach ($foot as $f) {
                    $html .= '<li><a ' . (($type == "_two" && $totalFoot == $footCnt) ? 'class="menu-signup-btn"' : '') . ' href="';


                    $html .= base_url($f['page_uri'] . '');


                    $html .= '">' . $f['menu_name'] . '</a></li>';
                    $footCnt++;
                }
            }

            return $html;
        }
    }

    public function checkUserLogin()
	{
		
		$data = array();
		if($this->session->userdata('usr_auth')=="Yes")
		{			
			$data = $this->SqlModel->getSingleRecord('website_users',array('usr_id'=>$this->session->userdata('usr_id'),'usr_status'=>'Enable'));
		}
		return $data;
	}
	public function getGallery($gallery_id=0)
	{
		$gal = $this->SqlModel->getSingleRecord('galleries',array('gallery_id'=>$gallery_id,'gallery_status'=>'Enable'));
		if(!empty($gal))
		{
			$query = "SELECT image_name, image_image image,image_desc FROM gallery_images WHERE image_gallery_id = ".$gallery_id." AND image_status='Enable' ORDER BY image_order ASC";
			$gal['images'] = $this->runQuery($query);
		}
		return $gal;
	}
	
    
}

?>