<?php
    class BackendPaginationAndSearchModel extends CI_Model { 

    public function  __construct() {
            parent::__construct();  
            
            //laoding  database
            $this->load->database();
        }


    public function fetchCentres($limit,$offset,$searchText){
        try{
            
            if($searchText!='' && $searchText!=null){
                $this->db->select('centreCode as cCode, centreName as cName');
                $this->db->from('centers');
                $this->db->like('centreCode',$searchText);
                $this->db->or_like('centreName',$searchText);
                $this->db->limit($limit,$offset);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    
                    return $query->result_array();
                } else {
            
                    return null;
                }
            }
            else{
                $this->db->select('centreCode as cCode, centreName as cName');
                $this->db->from('centers');
                $this->db->limit($limit,$offset);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    
                    return $query->result_array();
                } else {
            
                    return null;
                }
            }
    
            }
            catch(Exception $ee){
                return null;
            }

    }



    public function total_rows($searchText){
        try{
            if($searchText!='' && $searchText!=null){
                $this->db->select('count(*) as total_rows');
                $this->db->from('centers');
                $this->db->like('centreCode',$searchText);
                $this->db->or_like('centreName',$searchText);

                $query = $this->db->get();
                return $query->result_array()[0]['total_rows'];
            }
            else{

                $this->db->select('count(*) as total_rows');
                $this->db->from('centers');
                $query = $this->db->get();
                return $query->result_array()[0]['total_rows'];
            
            }
        }
        catch(Exception $ee){
            return 0;
        }

    }        


}
