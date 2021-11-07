<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackendPaginationAjaxController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('PaginationTestingModel');

		$this->load->model('CIpaginationModel');

		
		// ********* Loading Model For Backend Pagination And Search ---------------->
		$this->load->model('BackendPaginationAndSearchModel');

	}

	public function index(){
		$this->load->view('backendPaginationAjax');
	}

	// ########### CodeIgniter Pagination -------------------->

	
	public function CIpagination(){
		
		$this->load->library('pagination');

		$config=[
			"base_url" => base_url("BackendPaginationAjaxController/CIpagination"),
			"per_page" => 2,
			"total_rows" => $this->CIpaginationModel->total_rows(),

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

		$data['data']=$this->CIpaginationModel->fetchCentres($config['per_page'],$this->uri->segment(3));

		// $this->load->view('paginationTesting',$data);

		$this->load->view('backendCIpagination',$data);

		
	}


	// <--------------- End ###################################<<

	
	
	// ********************* Backend Pagination And Search ------------------------>
	public function backendPaginationAndSearchView(){
		$this->load->view('backendPaginationAndSearchAjax');
	}

	public function backendPaginationAndSearchAjax(){

		
		$pageNumber = $this->input->post('pgNum');
		$per_page = $this->input->post('perPg');
		$searchText = $this->input->post('searchText');

		//-----------Getting total Number of  Records From database------------------
		
		$total_rows = $this->BackendPaginationAndSearchModel->total_rows($searchText);
		
		

		if($per_page==""){
			$per_page=10;
		}

		$linkData=$this->createLink($pageNumber,$per_page,$total_rows);
        
															   // Limit, offset
		$tableData=$this->BackendPaginationAndSearchModel->fetchCentres($per_page,$linkData['offset'],$searchText);
			
		echo json_encode(array('perPageOptions' => $linkData['perPageOptions'],'pageLink' => $linkData['pageLink'],'tableData' => $tableData));

	}

	// <--------------- End **********************************<<
	
	
    	public function backendPaginationAjax(){

		
		$pageNumber = $this->input->post('pgNum');
		$per_page = $this->input->post('perPg');

		//-----------Getting total Number of  Records From database--------------------------------------
		$total_rows = $this->CIpaginationModel->total_rows();

		if($per_page==""){
			$per_page=10;
		}

		$linkData=$this->createLink($pageNumber,$per_page,$total_rows);
        
															   // Limit, offset
		$tableData=$this->CIpaginationModel->fetchCentres($per_page,$linkData['offset']);
			
		echo json_encode(array('perPageOptions' => $linkData['perPageOptions'],'pageLink' => $linkData['pageLink'],'tableData' => $tableData));

	}

	private function createLink($i,$per_page,$total_rows){ // here $i is requested Page

		//-------------calculating total number of pages---------------------------------------
		$l = 0;  // Total Number Of Page
		if($total_rows % $per_page){
			$l=intval($total_rows/$per_page)+1;
		}
		else{
			$l=intval($total_rows/$per_page);
		}

		if($l==1){ $i=1;}

		//---------------------Page Link Configuration -----------------------------------------------------
		$config=[
			"full_tag_open" => "<ul class='pagination'>",
			"full_tag_close" => "</ul>",

			"first_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'backendPaginationAjax(1)'.'" class="page-link">First'.'</a></li>',
			

			"last_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'backendPaginationAjax('.$l.')'.'" class="page-link">Last'.'</a></li>',


			"next_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'backendPaginationAjax('.($i+1).')'.'" class="page-link">>'.'</a></li>',
			"next_tag_mute" => '<li class="page-item"><p class="page-link">></p></li>',
			 

			"prev_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'backendPaginationAjax('.($i-1).')'.'" class="page-link"><'.'</a></li>',
			"prev_tag_mute" => '<li class="page-item"><p class="page-link"><</p></li>',
			

			"num_tag_open" => '<li class="page-item"><a href="javascript:void(0)" onclick="backendPaginationAjax(',
			"num_tag_mid" => ')" class="page-link">',
			"num_tag_close" =>'</a></li>',

			"cur_tag" => '<li class="page-item active"><a href="javascript:void(0)" onclick="backendPaginationAjax('.$i.')" class="page-link">'.$i.'</a></li>',
			
		];

		
		//--------------- Creating Page Link ---------------------------------------------
			$pageLink = $this->pageLinkFun($config,$i,$l);
		
			
		// ---------------------Creating Per Page Options----------------------------------
			$perPageOptions = $this->perPageOptionsFun($per_page);



		// --------------------- Getting Offset -------------------------------------------

			$offset=$this->calculateOffset($i,$per_page);



			 
		//---------------Putting Page Link, Per Page Options And offset  into one array ------------
			$linkData=array(
				'pageLink' => $pageLink,
				'perPageOptions' => $perPageOptions,
				'offset' => $offset,
			);

			return $linkData;



		

	}

	private function pageLinkFun($config,$i,$l){

		//--------------- Creating Page Link -----------------------------------

		$link=$config['full_tag_open'];

		if($i>3 && $l!=1){
			$link.=$config['first_tag'];
		}
		if($i>1 && $l!=1){
			$link.=$config['prev_tag'];
		}

		if($l==1){
			$link.=$config['prev_tag_mute'];
			
		}

		if(($i-2)>=1){

			$link.=$config['num_tag_open'];
			$link.=$i-2;
			$link.=$config['num_tag_mid'];
			$link.=$i-2;
			$link.=$config['num_tag_close'];

			$link.=$config['num_tag_open'];
			$link.=$i-1;
			$link.=$config['num_tag_mid'];
			$link.=$i-1;
			$link.=$config['num_tag_close'];

			$link.=$config['cur_tag'];
		}
		else if(($i-1)>=1){

			$link.=$config['num_tag_open'];
			$link.=$i-1;
			$link.=$config['num_tag_mid'];
			$link.=$i-1;
			$link.=$config['num_tag_close'];

			$link.=$config['cur_tag'];
		}
		else{
			$link.=$config['cur_tag'];
		}


		if(($i+2)<=$l){

			$link.=$config['num_tag_open'];
			$link.=$i+1;
			$link.=$config['num_tag_mid'];
			$link.=$i+1;
			$link.=$config['num_tag_close'];

			$link.=$config['num_tag_open'];
			$link.=$i+2;
			$link.=$config['num_tag_mid'];
			$link.=$i+2;
			$link.=$config['num_tag_close'];
		}
		else if(($i+1)<=$l){

			$link.=$config['num_tag_open'];
			$link.=$i+1;
			$link.=$config['num_tag_mid'];
			$link.=$i+1;
			$link.=$config['num_tag_close'];
		}

		if(($i+2)<$l){
			$link.=$config['next_tag'];
			$link.=$config['last_tag'];
		}
		else if(($i+1)<=$l){
			$link.=$config['next_tag'];
		}

		if($l==1){
			$link.=$config['next_tag_mute'];
		}

		$link.=$config['full_tag_close'];

		return $link;
	}


	private function perPageOptionsFun($per_page){

		// ---------------------Creating Per Page Options------------------------	

		$perPageOptions='<select id="perPage" name="perPage">';

		for($k=10; $k<=100; $k+=10){
			if($per_page=="".$k){
				$perPageOptions.='<option selected value="';
				$perPageOptions.=$k;
				$perPageOptions.='">';
				$perPageOptions.=$k;
				$perPageOptions.='</option>';
			}
			else{
				$perPageOptions.='<option value="';
				$perPageOptions.=$k;
				$perPageOptions.='">';
				$perPageOptions.=$k;
				$perPageOptions.='</option>';
			}
		}
							 
		$perPageOptions.='</select>';


		return $perPageOptions;
	}

	private function calculateOffset($requestedPg,$per_page){
		// --------------------- Calculating Offset ------------------------

		$offset=($requestedPg-1)*$per_page;

		return $offset;
	}



}
