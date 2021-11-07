<?php
    class PaginationTestingModel extends CI_Model { 

    public function  __construct() {
            parent::__construct();  
            
            //laoding  database
            $this->load->database();
        }


    public function fetchCentres(){
        try{
            

            $this->db->select('centreCode as cCode, centreName as cName');
            $this->db->from('centers');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                
                return $query->result_array();
            } else {
           
                return null;
            }
    
            }
            catch(Exception $ee){
                return null;
            }

    }

}
