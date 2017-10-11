<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/PHPWord/PHPWord.php';
class Word extends PHPWord
{
	
    function __construct()
    {
		
        parent::__construct();
		
    }
}

?>
