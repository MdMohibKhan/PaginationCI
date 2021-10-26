<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaginationTestingController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('PaginationTestingModel');

	}

	
	public function paginationCI(){
		
		$this->load->library('pagination');

		$config=[
			"base_url" => base_url("PaginationTestingController/paginationCI"),
			"per_page" => 2,
			"total_rows" => $this->PaginationTestingModel->total_rows(),

			"full_tag_open" => "<ul class='pagination'>",
			"full_tag_close" => "</ul>",

			"first_tag_open" => "<li class='page-item'> ",
			"first_tag_close" => "</li>",

			"last_tag_open" => "<li class='page-item'> ",
			"last_tag_close" => "</li>",

			"next_tag_open" => "<li class='page-item'>",
			"next_tag_close" => "</li>",

			"prev_tag_open" => "<li class='page-item'>",
			"prev_tag_close" => "</li>",

			"num_tag_open" => "<li class='page-item'>",
			"num_tag_close" => "<li>",

			"cur_tag_open" => "<li class='page-item active'><a href='javascript:void(0)' class='page-link'>",
			"cur_tag_close" => "</a></li>",

			"data_page_attr"=> "class='page-link'",
		];

		$this->pagination->initialize($config);

		$data['data']=$this->PaginationTestingModel->fetchCentres($config['per_page'],$this->uri->segment(3));

		// $this->load->view('paginationTesting',$data);

		$this->load->view('paginationBootstrapCI',$data);

		
	}

	
	public function paginationBootstrap2(){

		$data2=array(
			0=>array("cCode"=>"123","cName"=>"jhfiuh"),
			1=>array("cCode"=>"173","cName"=>"jhfiuh"),
			2=>array("cCode"=>"193","cName"=>"jhfiuh"),
			3=>array("cCode"=>"124","cName"=>"jhfiuh"),
			4=>array("cCode"=>"153","cName"=>"jhfiuh"),
			5=>array("cCode"=>"173","cName"=>"jhfiuh"),
			6=>array("cCode"=>"128","cName"=>"jhfiuh"),
			7=>array("cCode"=>"129","cName"=>"jhfiuh"),
			8=>array("cCode"=>"323","cName"=>"jhfiuh"),
			9=>array("cCode"=>"983","cName"=>"jhfiuh"),
			10=>array("cCode"=>"823","cName"=>"jhfiuh"),
			11=>array("cCode"=>"593","cName"=>"jhfiuh"),
			12=>array("cCode"=>"1723","cName"=>"jhfiuh"),
			13=>array("cCode"=>"1273","cName"=>"jhfiuh"),
			14=>array("cCode"=>"1234","cName"=>"jhfiuh"),
			15=>array("cCode"=>"1234","cName"=>"jhfiuh"),
			16=>array("cCode"=>"1237","cName"=>"jhfiuh"),
			17=>array("cCode"=>"1238","cName"=>"jhfiuh"),
			18=>array("cCode"=>"1239","cName"=>"jhfiuh"),
			19=>array("cCode"=>"1239","cName"=>"jhfiuh"),
			20=>array("cCode"=>"1234","cName"=>"jhfiuh"),
			21=>array("cCode"=>"1237","cName"=>"jhfiuh"),
			22=>array("cCode"=>"1234","cName"=>"jhfiuh"),
			23=>array("cCode"=>"1237","cName"=>"jhfiuh"),
			24=>array("cCode"=>"1237","cName"=>"jhfiuh"),
			25=>array("cCode"=>"123","cName"=>"jhfiuh"),
			26=>array("cCode"=>"123","cName"=>"jhfiuh"),
			27=>array("cCode"=>"123","cName"=>"jhfiuh"),
			28=>array("cCode"=>"123","cName"=>"jhfiuh"),
			29=>array("cCode"=>"123","cName"=>"jhfiuh"),
			30=>array("cCode"=>"123","cName"=>"jhfiuh"),
			31=>array("cCode"=>"123","cName"=>"jhfiuh"),
			32=>array("cCode"=>"123","cName"=>"jhfiuh"),
			33=>array("cCode"=>"123","cName"=>"jhfiuh"),
			34=>array("cCode"=>"123","cName"=>"jhfiuh"),
			35=>array("cCode"=>"123","cName"=>"jhfiuh"),
		);	
		
		echo json_encode($data2);
	}



}