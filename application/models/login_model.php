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
      function get_record_where_orderby($table_name,$orderby=''){
    	 if($orderby !='')
        {
            $this->db->order_by($orderby,'DESC');
        }
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
	//  //for count records for specific part
    //***************************************************************//    
    function count_records_where($table,$where='')
    {
    $this->db->select('*');
    $this->db->from($table);
    if($where != '')
    {
            $this->db->where($where);
    }
    $query = $this->db->get();
    return $query -> num_rows();
    
    }
//***************************************************************//    
    //  // for count all records
    //***************************************************************//    
    function count_records($table)
    {
        $count=$this->db->count_all($table);
        return $count;
    }
	 function get_data_where_condition($table,$where,$orderby='')//fatch all data with where condition
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
         if($orderby !='')
        {
            $this->db->order_by($orderby,'DESC');
        }
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
            $this->db->order_by($orderby,'DESC');
        }
        $query = $this->db->get();
        return $query->result();
    }
    
	
	 public function get_data_orderby($table,$orderby='') {
        
        $this->db->select('*');
        $this->db->from($table);
        if($orderby !='')
        {
            $this->db->order_by($orderby,'DESC');
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
    function get_data_join_four_tabel_where($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$orderby='',$where = '',$column='')
	  {  
	  if($column !='')
            {
                $this->db->select($column);
            }
            else
            {
                $this->db->select('*');
            }
	  $this->db->from($table1);
	  $this->db->join($table2,$table2.'.'.$id1.'='.$table1.'.'.$id2);
	  $this->db->join($table3,$table3.'.'.$id3.'='.$table1.'.'.$id4);
	  $this->db->join($table4,$table4.'.'.$id5.'='.$table1.'.'.$id6);
	 if($where != ''){
			$this->db->where($where);	
		}
	  if($orderby!='')
			{
				$this->db->order_by($orderby, 'desc');
			}
	  $query=$this->db->get();
	 
	 //echo $this->db->last_query();die;
	  return $query->result(); 
	}
	     function get_data_join_four_tabel_where_group($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$orderby='',$where = '',$column='',$groupby='')
	  {  
	  if($column !='')
            {
                $this->db->select($column);
            }
            else
            {
                $this->db->select('*');
            }
	  $this->db->from($table1);
	  $this->db->join($table2,$table2.'.'.$id1.'='.$table1.'.'.$id2);
	  $this->db->join($table3,$table3.'.'.$id3.'='.$table1.'.'.$id4);
	  $this->db->join($table4,$table4.'.'.$id5.'='.$table1.'.'.$id6);
	 if($where != ''){
			$this->db->where($where);	
		}
	  if($orderby!='')
			{
				$this->db->order_by($orderby, 'desc');
			}
			if($groupby != ''){
            $this->db->group_by($groupby);
        }
	  $query=$this->db->get();
	 
	// echo $this->db->last_query();
	  return $query->result(); 
	}
	  
 /*
      function get_data_join_four_tabel_where_leftjoin($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$orderby='',$where = '',$column='')
       {  
       if($column !='')
             {
                 $this->db->select($column);
             }
             else
             {
                 $this->db->select('*');
             }
       $this->db->from($table1);
       $this->db->join($table2,$table2.'.'.$id1.'='.$table1.'.'.$id2);
       $this->db->join($table3,$table3.'.'.$id3.'='.$table1.'.'.$id4,'LEFT');
       $this->db->join($table4,$table4.'.'.$id5.'='.$table3.'.'.$id6,'LEFT');
      if($where != ''){
             $this->db->where($where);	
         }
       if($orderby!='')
             {
                 $this->db->order_by($orderby, 'desc');
             }
       $query=$this->db->get();
                //echo $this->db->last_query();die;
       return $query->result(); 
     }*/
 function get_data_join_four_tabel_where_leftjoin($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$orderby='',$where = '',$column='',$groupby='')
	  {  
	  if($column !='')
            {
                $this->db->select($column);
            }
            else
            {
                $this->db->select('*');
            }
	  $this->db->from($table1);
	  $this->db->join($table2,$table2.'.'.$id1.'='.$table1.'.'.$id2);
	  $this->db->join($table3,$table3.'.'.$id3.'='.$table1.'.'.$id4,'LEFT');
	  $this->db->join($table4,$table4.'.'.$id5.'='.$table3.'.'.$id6,'LEFT');
	 if($where != ''){
			$this->db->where($where);	
		}
	  if($orderby!='')
			{
				$this->db->order_by($orderby, 'desc');
			}
			if($groupby != ''){
            $this->db->group_by($groupby);
        }
	  $query=$this->db->get();
	 
	 //echo $this->db->last_query();die;
	  return $query->result(); 
	}
	//---------------------four table jjoin----------------//
function get_join_three_table_where($table1,$table2,$table3,$id1,$id2,$id3,$id4,$where = '',$column=''){
		if($column !='')
                {
                    $this->db->select($column);
                }
                else
                {
                    $this->db->select('*');
                }
		$this->db->from($table1);
		$this->db->join($table2,$table2.'.'.$id1.'='.$table1.'.'.$id2);
	  	$this->db->join($table3,$table3.'.'.$id3.'='.$table1.'.'.$id4);
		if($where != ''){
			$this->db->where($where);	
		}
	  	$query=$this->db->get();
      //  echo $this->db->last_query();
	  	return $query->result();
	}
	function get_join_three_table_where_leftjoin($table1,$table2,$table3,$id1,$id2,$id3,$id4,$where = '',$column=''){
		if($column !='')
                {
                    $this->db->select($column);
                }
                else
                {
                    $this->db->select('*');
                }
		$this->db->from($table1);
		$this->db->join($table2,$table2.'.'.$id1.'='.$table1.'.'.$id2);
	  	$this->db->join($table3,$table3.'.'.$id3.'='.$table1.'.'.$id4,'LEFT');
		if($where != ''){
			$this->db->where($where);	
		}
	  	$query=$this->db->get();
	  	return $query->result();
	}
	function get_record_join_two_table($table1,$table2,$id1,$id2,$column='',$where='',$orderby=''){
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
		if($orderby!='')
			{
				$this->db->order_by($orderby, 'desc');
			}
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();
    }
    function get_record_join_two_table_groupby($table1,$table2,$id1,$id2,$column='',$where='', $groupby = ''){
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
        if($groupby != ''){
            $this->db->group_by($groupby);
        }
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();
    }
	 function get_record_leftjoin_two_table($table1,$table2,$id1,$id2,$column='',$where='',$orderby=''){
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
		  if($orderby!='')
			{
				$this->db->order_by($orderby, 'desc');
			}
         //   $this->db->group_by('wt_user_id');
   
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
		function check_unique($table_name, $check_unique) {
	$this -> db -> select('*');
	$this -> db -> from($table_name);
	$this -> db -> where($check_unique);
	$query = $this -> db -> get();
	if ($query -> num_rows() > 0) {
		return FALSE;
	} else {
		return TRUE;
	}
	}
	// Multiple table join function
	function get_all_list_join($star, $table_name, $table_foreign_key_1, $table_foreign_key_2, $join_type, $order_by = "", $group_by = "", $where = "", $having = "", $limit = "", $where_in = "",$table_date_param='',$first_date='',$second_date='') {
        $this->db->select($star);
        $this->db->from($table_name[0]);
        $j = 1;
        for ($i = 0; $i < count($table_foreign_key_1); $i++) {
            $this->db->join($table_name[$j], "$table_foreign_key_1[$i] = $table_foreign_key_2[$i]", $join_type[$i]);
            $j++;
        }

        if (!empty($where)) {
            $this->db->where($where);
        }
	if($table_date_param !='' && $first_date !='' && $second_date !='')
	$this->db->where($table_date_param.' BETWEEN "'. $first_date .'" and "'. $second_date .'"');
        if (!empty($where_in)) {
            foreach ($where_in as $key => $value) {
                $dj_genres = trim($value, "'");
                $dj_genres_array = explode(",", $dj_genres);
                $this->db->where_in($key, $dj_genres_array);
            }
        }

        if (!empty($order_by)) {
            $this->db->order_by($order_by[0], $order_by[1]);
        }

        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }

        if (!empty($having)) {
            $this->db->having($having);
        }

        if (!empty($limit)) {
            $this->db->limit($limit[0], $limit[1]);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            foreach ($query->result() as $v) {
                $data[] = $v;
            }
            return $data;
        }
    }
    
    function get_simple_query($sql) {
       $query = $this->db->query($sql);
       //echo $this->db->last_query();die();
       if ($query->num_rows() > 0) {
           foreach ($query->result() as $v) {
               $data[] = $v;
           }
	   //print_r($data);die();
           return $data;
       }
   }
	
}