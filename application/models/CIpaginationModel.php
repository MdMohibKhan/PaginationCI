<?php
    class CIpaginationModel extends CI_Model { 

        public function  __construct() {
                parent::__construct();  
                
                //laoding  database
                $this->load->database();
            }
    
    
        public function fetchCentres($limit,$offset){
                        try{
                            
                
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
                            catch(Exception $ee){
                                return null;
                            }
                
                    }
                
            
            
        public function total_rows(){
            try{
                

                $this->db->select('count(*) as total_rows');
                $this->db->from('centers');
                $query = $this->db->get();
                return $query->result_array()[0]['total_rows'];
                
        
                }
                catch(Exception $ee){
                    return 0;
                }

        }


}