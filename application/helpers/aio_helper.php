<?php



/////////////////////////////////////
//////////// STARTS HERE ////////////
/////////////////////////////////////

/*
 * Pretty way to debug with <pre> display
 * Usage: print with exit, use second argument false to prevent exit
 */
if ( ! function_exists('printr')) {
	function printr($data, $exit=true) {
		if (is_bool($data)===TRUE) {
			ob_start();
			var_dump($data);
			$output = ob_get_contents();
			ob_end_clean();
			echo "<pre>" . $output . "</pre>";
		
		} else {
			echo "<pre>" . print_r($data, true) . "</pre>";
		}
			if ($exit) exit;
	}
}
/*
 * Get defined variable and their values, all or filtered
 * Sometimes i need to know what value variable stores after execution, It will be much useful if your working with bunch of variables
 */
if ( ! function_exists('getVars')) {
	function getVars($str=NULL, $print=true) {
		if ($str === NULL || strlen(trim($str))==0 ) return printr($GLOBALS, $print);
		$result = array();
		$str = explode(',', $str);
		if (is_array($str)) {
			foreach ($GLOBALS as $var => $value) {
			  foreach($str as $strID) {
				if (strstr($var, $strID)!==FALSE) $result[ $var ] = $value;
			  }
			}
		}
		return printr($result, $print);
	}
}

/*
 * cURL Functionality
 * Need explanation?
 */
if ( ! function_exists('cURL') ) {
	function cURL($url, $post=false, $header=false) {
		$ch = curl_init($url);
		if ($post !== false) {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		curl_setopt($ch, CURLOPT_HEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		return $result;
	}
}

/*
 * Get file extension
 */
if ( ! function_exists('fileExt') ) {
	function fileExt($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}
}

/*
 * Validate Password (Includes no space, upper, lower, number, special, above8)
 */
if ( ! function_exists('validatePassword') ) {
	function validatePassword($password) {
	    $rules = array(
	        'no_whitespace' => '/^\S*$/',
	        'match_upper'   => '/[A-Z]/',
	        'match_lower'   => '/[a-z]/',
	        'match_number'  => '/\d/',
	        'match_special' => '/[\W_]/',
	        'length_abv_8'  => '/\S{8,}/'
	    );
	    
	    $valid = true;
	    foreach($rules as $rule) {
	        $valid = $valid && preg_match($rule, $password);
	    }
	    
	    return (bool) $valid;
	}
}

/*
 * Logging method Custom
 * Made for CODI environment, can be use in flat but need to change log directory path as well.
 */
if ( ! function_exists('myLogger') ) {
	function myLogger($vars=array()) {
		$filename = 'log_' . date('d-m-y') . '.txt';
		$append = true;
		$log = 'get|post'; // URL will also log (Supported: get, post, file, server)

		extract($vars);

		$dir_to_log = 'application/logs/';

		// Configure data to log file
		$data_log_array = explode('|', $log);
		$data_log = 'Time: ' . date("F j, Y, g:i a") . "\n";
		$data_log .= 'URL: ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$data_log .= (in_array('get', $data_log_array)) ? "\n" . 'GET: ' . ( (count($_GET)==0) ? 'Empty' : print_r($_GET, true) ) : '';
		$data_log .= (in_array('post', $data_log_array)) ? "\n" . 'POST: ' . ( (count($_POST)==0) ? 'Empty' : print_r($_POST, true) ) : '';
		$data_log .= (in_array('file', $data_log_array) || in_array('files', $data_log_array)) ? "\n" . 'FILES: ' . ( (count($_FILES)==0) ? 'Empty' : print_r($_FILES, true) ) : '';
		$data_log .= (in_array('server', $data_log_array)) ? "\n" . 'SERVER: ' . ( (count($_SERVER)==0) ? 'Empty' : print_r($_SERVER, true) ) : '';
		$data_log .= (in_array('ip', $data_log_array)) ? "\n" . 'IP: ' . $_SERVER['REMOTE_ADDR'] : '';
		$data_log .= (in_array('useragent', $data_log_array) || in_array('user_agent', $data_log_array)) ? "\n" . 'Useragent: ' . $_SERVER['HTTP_USER_AGENT'] : '';

		// Write log file
		if ($append === true) {
			file_put_contents($dir_to_log . $filename, $data_log . "\n" . str_repeat("=", 20) . "\n\n", FILE_APPEND);
		} else {
			file_put_contents($dir_to_log . $filename,  $data_log . "\n" . str_repeat("=", 20) . "\n" . file_get_contents($dir_to_log . $filename));
		}
	}
}

/*
 * Multidimensional array searcher
 */
if (! function_exists('getIndexOfMultiArray') ) {
	function getIndexOfMultiArray($needle,$haystack) {
		foreach($haystack as $key=>$value) {
		  $current_key=$key;
		  if ($needle === $value OR (is_array($value) && getIndexOfMultiArray($needle,$value) !== false)) {
		    return $current_key;
		  }
		}
		return false;
	}
}

/*
 * Resize image but keeping the aspect ratio as needed by many projects
 * Rename tip: use {rand} for random numbers or {time} for current timestamp
 * Usage: path, width, height, save_path, new_name, {return:type}
 */
if (! function_exists('IMGResize') ) {
	function IMGResize($img, $box_w, $box_h, $save_path='./', $rename='myimage_rand', $param=false) {
	    //create the image, of the required size
	    $new = imagecreatetruecolor($box_w, $box_h);
	    if($new === false) {
	        //creation failed -- probably not enough memory
	        return null;
	    }

	    // Rename Functionality
	    if (trim($rename)!='') {
	    	$needle = array('{rand}', '{time}');
	    	$replace = array(rand(9999,99999), time());
	    	$rename = str_replace($needle, $replace, $rename);
	    } else {
	    	$rename = substr(basename($img), 0, -strlen(strchr(basename($img), '.')));
	    }


	    // Save path
	    if ($save_path=='') {
	    	$save_path = './';
	    }
	    $save_path = substr($save_path, -1)!='/' ? $save_path.'/' : $save_path;

	    if ( $param != false && in_array($param, array('file_path', 'file_name', 'dir_path'))==false ) {
	    	echo 'IMGResize found invalid return parameters';
	    	return false;
	    }

		$mime = GetImageSize($img);
		$mime = $mime['mime'];
	    $type = substr(strrchr($mime, '/'), 1);

		switch ($type) {
		case 'jpeg':
		    $image_create_func = 'ImageCreateFromJPEG';
		    $image_save_func = 'ImageJPEG';
			$new_image_ext = 'jpg';
		    break;

		case 'png':
		    $image_create_func = 'ImageCreateFromPNG';
		    $image_save_func = 'ImagePNG';
			$new_image_ext = 'png';
		    break;

		case 'bmp':
		    $image_create_func = 'ImageCreateFromBMP';
		    $image_save_func = 'ImageBMP';
			$new_image_ext = 'bmp';
		    break;

		case 'gif':
		    $image_create_func = 'ImageCreateFromGIF';
		    $image_save_func = 'ImageGIF';
			$new_image_ext = 'gif';
		    break;

		case 'vnd.wap.wbmp':
		    $image_create_func = 'ImageCreateFromWBMP';
		    $image_save_func = 'ImageWBMP';
			$new_image_ext = 'bmp';
		    break;

		case 'xbm':
		    $image_create_func = 'ImageCreateFromXBM';
		    $image_save_func = 'ImageXBM';
			$new_image_ext = 'xbm';
		    break;

		default:
			$image_create_func = 'ImageCreateFromJPEG';
		    $image_save_func = 'ImageJPEG';
			$new_image_ext = 'jpg';
		}

		$img = $image_create_func($img);

		if(is_null($img)) {
	    	return false;
		}


	    //Fill the image with a light grey color
	    //(this will be visible in the padding around the image,
	    //if the aspect ratios of the image and the thumbnail do not match)
	    //Replace this with any color you want, or comment it out for black.
	    //I used grey for testing =)
	    $fill = imagecolorallocate($new, 255, 255, 255);
	    imagefill($new, 0, 0, $fill);

	    //compute resize ratio
	    $hratio = $box_h / imagesy($img);
	    $wratio = $box_w / imagesx($img);
	    $ratio = min($hratio, $wratio);

	    //if the source is smaller than the thumbnail size, 
	    //don't resize -- add a margin instead
	    //(that is, dont magnify images)
	    if($ratio > 1.0)
	        $ratio = 1.0;

	    //compute sizes
	    $sy = floor(imagesy($img) * $ratio);
	    $sx = floor(imagesx($img) * $ratio);

	    //compute margins
	    //Using these margins centers the image in the thumbnail.
	    //If you always want the image to the top left, 
	    //set both of these to 0
	    $m_y = floor(($box_h - $sy) / 2);
	    $m_x = floor(($box_w - $sx) / 2);

	    //Copy the image data, and resample
	    //If you want a fast and ugly thumbnail,
	    //replace imagecopyresampled with imagecopyresized
	    if(!imagecopyresampled($new, $img,
	        $m_x, $m_y, //dest x, y (margins)
	        0, 0, //src x, y (0,0 means top left)
	        $sx, $sy,//dest w, h (resample to this size (computed above)
	        imagesx($img), imagesy($img)) //src w, h (the full size of the original)
	    ) {
	        //copy failed
	        imagedestroy($new);
	        return false;
	    }
	    //copy successful
	    $file_path = $save_path . $rename . '_' . $box_w.'x'.$box_h . '.' . $new_image_ext;
	    $process = $image_save_func($new, $file_path);

	    if ( $param != false ) {
	    	if ($param == 'file_path') return realpath($file_path);
	    	if ($param == 'file_name') return basename($file_path);
	    	if ($param == 'dir_path') return dirname(realpath($file_path));
	    } else {
	    	return array('result' => $process, 'file_path' => realpath($file_path), 'file_name'=>basename($file_path), 'dir_path'=>dirname(realpath($file_path)));
	    }
	}
}
if (! function_exists('ithumb') ) {
	function ithumb($img, $box_w, $box_h) {
	    
		$ext = strtolower(end(explode(".",$img)));
		
		if(!file_exists($img) || ($ext!="jpg" && $ext!="jpeg" && $ext!="png"))
		{
			$img = './assets/frontend/images/no_image.jpg';
		}
			
		//create the image, of the required size
	    $new = imagecreatetruecolor($box_w, $box_h);
	    if($new === false) {
	        //creation failed -- probably not enough memory
	        return null;
	    }
		
		$rename = end(explode("/",$img));
		$save_path = str_replace($rename,"",$img);
	    $rename = str_replace(".".end(explode(".",$img)),"",$rename);
		// Rename Functionality
	    if (trim($rename)!='') {
	    	$needle = array('{rand}', '{time}');
	    	$replace = array(rand(9999,99999), time());
	    	$rename = str_replace($needle, $replace, $rename);
	    } else {
	    	$rename = substr(basename($img), 0, -strlen(strchr(basename($img), '.')));
	    }
		
		
	    // Save path
	    if ($save_path=='') {
	    	$save_path = './';
	    }
	    $save_path = substr($save_path, -1)!='/' ? $save_path.'/' : $save_path;

		$mime = GetImageSize($img);
		$mime = $mime['mime'];
	    $type = substr(strrchr($mime, '/'), 1);

		switch ($type) {
		case 'jpeg':
		    $image_create_func = 'ImageCreateFromJPEG';
		    $image_save_func = 'ImageJPEG';
			$new_image_ext = 'jpg';
		    break;

		case 'png':
		    $image_create_func = 'ImageCreateFromPNG';
		    $image_save_func = 'ImagePNG';
			$new_image_ext = 'png';
		    break;

		case 'bmp':
		    $image_create_func = 'ImageCreateFromBMP';
		    $image_save_func = 'ImageBMP';
			$new_image_ext = 'bmp';
		    break;

		case 'gif':
		    $image_create_func = 'ImageCreateFromGIF';
		    $image_save_func = 'ImageGIF';
			$new_image_ext = 'gif';
		    break;

		case 'vnd.wap.wbmp':
		    $image_create_func = 'ImageCreateFromWBMP';
		    $image_save_func = 'ImageWBMP';
			$new_image_ext = 'bmp';
		    break;

		case 'xbm':
		    $image_create_func = 'ImageCreateFromXBM';
		    $image_save_func = 'ImageXBM';
			$new_image_ext = 'xbm';
		    break;

		default:
			$image_create_func = 'ImageCreateFromJPEG';
		    $image_save_func = 'ImageJPEG';
			$new_image_ext = 'jpg';
		}

		$img = $image_create_func($img);

		if(is_null($img)) {
	    	return false;
		}


	    //Fill the image with a light grey color
	    //(this will be visible in the padding around the image,
	    //if the aspect ratios of the image and the thumbnail do not match)
	    //Replace this with any color you want, or comment it out for black.
	    //I used grey for testing =)
	    $fill = imagecolorallocate($new, 255, 255, 255);
	    imagefill($new, 0, 0, $fill);

	    //compute resize ratio
	    $hratio = $box_h / imagesy($img);
	    $wratio = $box_w / imagesx($img);
	    $ratio = min($hratio, $wratio);

	    //if the source is smaller than the thumbnail size, 
	    //don't resize -- add a margin instead
	    //(that is, dont magnify images)
	    if($ratio > 1.0)
	        $ratio = 1.0;

	    //compute sizes
	    $sy = floor(imagesy($img) * $ratio);
	    $sx = floor(imagesx($img) * $ratio);

	    //compute margins
	    //Using these margins centers the image in the thumbnail.
	    //If you always want the image to the top left, 
	    //set both of these to 0
	    $m_y = floor(($box_h - $sy) / 2);
	    $m_x = floor(($box_w - $sx) / 2);

	    //Copy the image data, and resample
	    //If you want a fast and ugly thumbnail,
	    //replace imagecopyresampled with imagecopyresized
	    if(!imagecopyresampled($new, $img,
	        $m_x, $m_y, //dest x, y (margins)
	        0, 0, //src x, y (0,0 means top left)
	        $sx, $sy,//dest w, h (resample to this size (computed above)
	        imagesx($img), imagesy($img)) //src w, h (the full size of the original)
	    ) {
	        //copy failed
	        imagedestroy($new);
	        return false;
	    }
	    //copy successful
	    $file_path = $save_path . $rename . '_' . $box_w.'x'.$box_h . '.' . $new_image_ext;
	    $process = $image_save_func($new, $file_path);

	    
	    return array('result' => $process, 'file_path' => realpath($file_path), 'file_name'=>basename($file_path), 'dir_path'=>dirname(realpath($file_path)));
	   
	}
}
/*
 * Simple function to remove certain string from start or at the end, just use the function and avoid extra validation
 * Usage: removeCertainText('cl_name', 'cl_'); //name
 */
if (! function_exists('removeCertainText') ) {
	function removeCertainText($str, $remove, $start=true) {
		if ($start) {
			return (substr($str, 0, strlen($remove)) == $remove) ? substr($str, strlen($remove)) : $str;
		} else {
			return (substr($str, -strlen($remove)) == $remove) ? substr($str, 0, -strlen($remove)) : $str;
		}
	}
}

/*
 * Find element in multi dimensional array
 */
if (! function_exists('recursive_element') ) {
	function recursive_element($needle,$haystack) {
		foreach($haystack as $key=>$value) {
		  $current_key=$key;
		  if ($needle === $value OR (is_array($value) && recursive_element($needle,$value) !== false)) {
		    return $current_key;
		  }
		}
		return false;
	}
}

/*
 * Convert number to days, change according to your need
 * 1=Sun, ..., 7=Sat
 * convertNumtoDay(array(1,3,7)) // Sun, Tue, Sat
 */
if (! function_exists('convertNumtoDay') ) {
	function convertNumtoDay($array) {
		$result = '';
		$daysStr = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
		$days = explode(',', $array);
		foreach ($days as $day) {
			$result .= $daysStr[$day-1] . ', ';
		}

		return substr($result, 0, -2);
	}
}

/**
 * echo default specified value if 1st argument is either null/false/empty
 * @return: String
 * @param:  string, string
 */
if ( !function_exists('defaultValue') ) {
    function defaultValue($str, $default='') {
        if ( $str == '' || $str == NULL || $str == FALSE ) {
            return $default;
        }

        return $str;
    }
}

/**
 * Most demanded function on almost every project!
 * @return: array
 * @param: array, string
 */
if ( !function_exists('array_map_index') ) {
	function array_map_index($array, $index) {
	    $newArray = array();
	    foreach ($array as $key => $arr) {
	        if ( isset($arr[$index]) )
	            $newArray[ $arr[$index] ] = $arr;
	    }

	    return $newArray;
	}
}

?>
