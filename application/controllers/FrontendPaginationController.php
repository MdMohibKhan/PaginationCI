<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendPaginationController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('PaginationTestingModel');

	}

	// public function index(){
	// 	echo "<center>
	// 	<h2>Pagination Examples</h2>
	// 	<br>
	// 	<p>&nbsp;&nbsp;>>&nbsp;&nbsp;
	// 		<a href='".base_url("pagination")."' class='btn btn-primary'>
	// 		Start Pagination&nbsp; >>&nbsp; </a> 
	// 	</p>
	// 	<br>
	// 	<p>&nbsp;&nbsp;>>&nbsp;&nbsp;
	// 		<a href='".base_url("CIpagination")."' class='btn btn-primary'>
	// 		CodeIgniter Pagination &nbsp; >>&nbsp; </a> 
	// 	</p>
	// 	<br>
	// 	<p>&nbsp;&nbsp;>>&nbsp;&nbsp;
	// 		<a href='".base_url("BackendPaginationAjax")."' class='btn btn-primary'>
	// 		Start Backend Pagination Using Ajax &nbsp; >>&nbsp; </a> 
	// 	</p>
	// 	<br>
	// 	<p>&nbsp;&nbsp;>>&nbsp;&nbsp;
	// 		<a href='".base_url("BackendPaginationAndSearchAjax")."' class='btn btn-primary'>
	// 		Start Backend Pagination And Search Using Ajax &nbsp; >>&nbsp; </a> 
	// 	</p>
	// 	</center>";
	// }


	public function frontendPagination(){

		$this->load->view('paginationBootstrapCI');

		
	}

	
	public function paginationBootstrap(){
		$data=$this->PaginationTestingModel->fetchCentres();	
		echo json_encode($data);
	}



}