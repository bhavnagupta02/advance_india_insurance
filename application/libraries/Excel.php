<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  ======================================= 
 *  Author     : Bhavna Web Developer
 *  License    : Protected 
 *  Email      : bhavna.gupta612@gmail.com 
 * 
 *  ======================================= 
 */
require_once APPPATH . "/third_party/PHPExcel.php";
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
?>