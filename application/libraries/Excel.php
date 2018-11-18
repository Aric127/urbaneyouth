<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
// require_once APPPATH."third_party/PHPExcel.php";
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include APPPATH.'third_party/PHPExcel/IOFactory.php';  
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
