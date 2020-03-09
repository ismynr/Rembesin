<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  DOMPDF
* 
* Author: Geordy James 
*         @geordyjames
*          
*Location : https://github.com/geordyjames/Codeigniter-Dompdf-v0.7.0-Library
* Origin API Class: https://github.com/dompdf/dompdf
*          
* Created:  24.01.2017
* Created by Geordy James to give support to dompdf 0.7.0 and above 
* 
* Description:  This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
* 
*/
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
		
use Dompdf\Dompdf;
class dompdf_gen {
		
	public function __construct() {
		$pdf = new Dompdf();
		
		$CI =& get_instance();
		$CI->dompdf = $pdf;
		
	}
	
}