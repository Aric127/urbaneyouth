<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function get_record($table_name){
        $query = $this->db->get($table_name);
        return $query->result();
    }
    
    function get_record_where($table_name,$where){
        $query = $this->db->get_where($table_name, $where);
        if($query -> num_rows() > 0){
            foreach($query->result() as $v){
                $data[] = $v;
            }
            return $data;
        } else {
            return FALSE;
        }
    }
	
	 function get_data_where_condition($table,$where)//fatch all data with where condition
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$query=$this->db->get();
		return $query->result();
	}
	
//*************** Function for Update Data**************************//	
    
    function update_data($table,$data,$where) {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
//***********************End Update Data******************************//	
//*************** Function for Insert Data**************************//	
    
    function insert_data($table,$data) {
        $sql = $this->db->insert_string($table,$data);
        $this->db->query($sql);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
//***********************End Insert Data******************************//
   
    public function get_column_data_where($table,$column='',$where='',$orderby='') {
        if($column !='')
        {
            $this->db->select($column);
        }
        else
        {
            $this->db->select('*');
        }
        $this->db->from($table);
        if($where !='')
        {
            $this->db->where($where);
        }
        if($orderby !='')
        {
            $this->db->order_by($orderby,'ASC');
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    //------------------Delete Record-------------------------//
    
    function delete_record($table,$where){
        $this->db->delete($table, $where);
        if (!$this->db->affected_rows()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    //--------------End Delete Record-------------------------//
    
    
    #------------------four table join----------------------------
    function get_data_join_four_tabel_where($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$orderby='')
	  {  
	  $this->db->select('*');
	  $this->db->from($table1);
	  $this->db->join($table2,$table2.'.'.$id1.'='.$table1.'.'.$id2);
	  $this->db->join($table3,$table3.'.'.$id3.'='.$table1.'.'.$id4);
	  $this->db->join($table4,$table4.'.'.$id5.'='.$table1.'.'.$id6);
	  //$this->db->where($where);
	  if($orderby!='')
			{
				$this->db->order_by($orderby, 'desc');
			}
	  $query=$this->db->get();
	 
	 //echo $this->db->last_query();die;
	  return $query->result(); 
	}
    
	//---------------------four table jjoin----------------//

	function get_join_three_table_where($table1,$table2,$table3,$id1,$id2,$id3,$id4,$where = ''){
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2,$table2.'.'.$id1.'='.$table1.'.'.$id2);
	  	$this->db->join($table3,$table3.'.'.$id3.'='.$table1.'.'.$id4);
		if($where != ''){
			$this->db->where($where);	
		}
	  	$query=$this->db->get();
	  	return $query->result();
	}
	function get_record_join_two_table($table1,$table2,$id1,$id2,$column='',$where=''){
        if($column !='')
        {
            $this->db->select($column);
        }
        else
        {
            $this->db->select('*');
        }    
        $this->db->from($table1);
        $this->db->join($table2,$table2.'.'.$id2.'='.$table1.'.'.$id1);        
        if($where !='')
        {
            $this->db->where($where);
        }
        $query=$this->db->get();
        return $query->result();
    }
	function get_record_leftjoin_two_table($table1,$table2,$id1,$id2,$column='',$where=''){
        if($column !='')
        {
            $this->db->select($column);
        }
        else
        {
            $this->db->select('*');
        }    
        $this->db->from($table1);
        $this->db->join($table2,$table2.'.'.$id2.'='.$table1.'.'.$id1,'LEFT');        
        if($where !='')
        {
            $this->db->where($where);
        }
        $query=$this->db->get();
        return $query->result();
    }
		public function check_data($table_name, $where) {
		$this -> db -> select("*");
		$this -> db -> from($table_name);
		$this -> db -> where($where);
		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			return $query -> first_row();
		} else {
			return FALSE;
		}
	}
	
}