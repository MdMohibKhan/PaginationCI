<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendPaginationController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('PaginationTestingModel');

	}


	public function frontendPagination(){

		$this->load->view('paginationBootstrapCI');

		
	}

	
	public function paginationBootstrap(){
		$data=$this->PaginationTestingModel->fetchCentres();	
		echo json_encode($data);
	}



}