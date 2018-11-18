<?php

class DB {

    public $blank_array = array();

    function DB() {
        error_reporting(1);
        
       
           mysql_connect('localhost','root','') or die('Cannot connect to the DB');
         mysql_select_db('recharge_db') or die('Cannot select the DB');
//      
          // mysql_connect('localhost','root','root') or die('Cannot connect to the DB');
        // mysql_select_db('recharge_db') or die('Cannot select the DB');
        if (!defined('WEBSITE'))
            define('WEBSITE', "http://" . $_SERVER['SERVER_NAME'] . "/noupays/");
    }

    function new_base_rul() {
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
     
       function insert_data($table,$data) {
        $sql = $this->db->insert_string($table,$data);
        $this->db->query($sql);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    function run_sql($sql) {
        $rs = mysql_query($sql);

        if ($rs !== false) {
            return $rs;
        } else {
            return false;
        }
    }

    function insert($sql) {
        $rs = $this->run_sql($sql);

        if ($rs !== false) {
            return mysql_insert_id();
        } else {
            return false;
        }
    }

    function getLastId() {
        return mysql_insert_id();
    }

    function fetchRow($rs, $sec = "no") {
        if ($rs !== false) {
            $data = mysql_fetch_assoc($rs);
            if ($sec == "no" && $data !== false) {
                $count = 0;
                foreach ($data as $key => $val) {
                    $data[$key] = ($data[$key]);
                    $count++;
                }
            }

            return $data;
        } else {
            return false;
        }
    }

    function getData($sql) {
        $rs = $this->run_sql($sql);
        $totalrows = mysql_num_rows($rs);
        $data = array();

        if ($totalrows > 0) {
            $x = 0;
            while ($rs_data = mysql_fetch_assoc($rs)) {
                $count = 0;

                foreach ($rs_data as $key => $val) {
                    $data[$x][$key] = htmlentities($val);
                    $count++;
                }

                $x++;
            }

            return $data;
        } else {
            return $data;
        }
    }

    function moveToFirstRow($rs) {
        if ($rs !== false) {
            mysql_data_seek($rs, 0);
        }
    }

    function makeDataset($rs) {
        if ($rs !== false) {
            $count = 0;
            while ($data = mysql_fetch_assoc($rs)) {
                $result[$count] = $data;
                $count++;
            }

            return $result;
        } else {
            return false;
        }
    }

    function getTotalRows($sql) {
        $rs = $this->run_sql($sql);
        $totalrows = mysql_num_rows($rs);
        return $totalrows;
    }

    function formatData($theValue, $theType, $isNull = "no") {
        $theNull = strtolower($theNull);
        $theValue = addslashes(stripslashes($theValue));

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? $theValue : (($theNull == "yes") ? "NULL" : "");
                break;

            case "long":

            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : (($theNull == "yes") ? "NULL" : 0);
                break;

            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : (($theNull == "yes") ? "NULL" : 0);
                break;

            case "date":
                $theValue = ($theValue != "") ? $theValue : (($theNull == "yes") ? "NULL" : "");
                break;

            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }

        return $theValue;
    }

    function modify($sql) {
        $this->run_sql($sql);
        return mysql_affected_rows();
    }

    function getDataSingleRow($sql, $sec = "yes") {
        $rs = $this->run_sql($sql);
        $totalrows = @mysql_num_rows($rs);
        $data = array();

        if ($totalrows > 0) {
            $data = mysql_fetch_assoc($rs);
            $count = 0;

            foreach ($data as $key => $val) {
                if ($sec == "no") {
                    $data[$key] = $val;
                } else {
                    $data[$key] = htmlentities($val);
                }

                $count++;
            }

            return $data;
        } else {
            return $this->blank_array;
        }
    }

    function getDataSingleRecord($sql) {
        $rs = $this->run_sql($sql);
        $totalrows = mysql_num_rows($rs);
        $data = array();

        if ($totalrows > 0) {
            $data = mysql_fetch_assoc($rs);
            return htmlentities($data['id']);
        } else {
            return false;
        }
    }

  
    function updatetablebyid($table, $primary_id, $id, $data) {
       foreach ($data as $key => $value) {
        $sql = "UPDATE `" . $table . "` SET `" . $key . "`='" . $value . "' WHERE `$primary_id`=" . $id;
      
           $this->modify($sql);
        }

        return $id;
    }

    function deletedataintablebycol($table, $id, $colname) {
        $sql = "DELETE FROM `" . $table . "` WHERE $colname='" . $id . "'";
        $result = $this->modify($sql);
        return $result;
    }

    function deletedataintablebytwocol($table, $colnameone, $id1, $colnametwo, $id2) {
        $sql = "DELETE FROM `" . $table . "` WHERE $colnameone='" . $id1 . "' and  $colnametwo='" . $id2 . "'";
        $result = $this->modify($sql);
        return $result;
    }

    function findColumn($tableName, $columnName) {
        $sql = "select * from " . $tableName;
        $result = $this->getDataSingleRow($sql);

        foreach ($result as $key => $value) {
            if ($key == $columnName) {
                return true;
            }
        }

        return false;
    }

    function get_all_records($table) {
        $sql = "SELECT * FROM `" . $table . "`";
        return $this->getData($sql);
    }
    function get_table_row_count($table, $primary_id, $id) {
        //SELECT count(*) FROM `quick_contacts` WHERE `quick_contact_user_id`=1
       $sql = "SELECT * FROM `" . $table . "` WHERE `$primary_id`='" . $id . "'";

        return $this->getTotalRows($sql);
    }
    function get_table_row_byidvalue($table, $primary_id, $id) {
       $sql = "SELECT * FROM `" . $table . "` WHERE `$primary_id`='" . $id . "'";

        return $this->getData($sql);
    }
    function get_table_row_byidvalue_sum($table, $primary_id, $id,$sum_varible) {
       $sql = "SELECT sum($sum_varible) as total FROM `" . $table . "` WHERE `$primary_id`='" . $id . "'";

        return $this->getData($sql);
    }
    function get_table_row_byidvalue_groupby($table, $primary_id, $id, $groupby) {
       $sql = "SELECT * FROM `" . $table . "` WHERE `$primary_id`='" . $id . "' GROUP BY '".$groupby."' ";

        return $this->getData($sql);
    }
     function get_table_row_byidvalue_order($table, $primary_id, $id, $order,$group) {
      $sql = "SELECT * FROM `" . $table . "` WHERE `$primary_id`='" . $id . "' GROUP BY ".$group." ORDER BY " . $order . " DESC ";

        return $this->getData($sql);
    }
  function get_table_row_byidvalue_orderby($table, $primary_id, $id,$orderby) {
       $sql = "SELECT * FROM `" . $table . "` WHERE `$primary_id`='" . $id . "'  ORDER BY " . $orderby . " DESC";

        return $this->getData($sql);
    }
    function get_cloumn_row_byid($table, $columns, $id) {
        $sql = "SELECT $columns FROM `" . $table . "` WHERE `id`=" . $id;
        return $this->getData($sql);
    }

    function get_table_field_doubles($table, $tag_onename, $tag_onevalue, $tag_twoname, $tag_twovalue) {

        $sql = "SELECT * FROM `" . $table . "` WHERE `$tag_onename`='" . $tag_onevalue . "' and `$tag_twoname`='" . $tag_twovalue . "'";


        return $this->getData($sql);
    }
     function get_table_field_triple_rechargeplan($table, $tag_onename, $tag_onevalue, $tag_twoname, $tag_twovalue, $tag_threename, $tag_threevalue) {

        $sql = "SELECT * FROM `" . $table . "` WHERE `$tag_onename`='" . $tag_onevalue . "' and `$tag_twoname`='" . $tag_twovalue . "' and `$tag_threename`!=''";


        return $this->getData($sql);
    }
     function get_table_field_doubles_by_date($table, $tag_onename, $tag_onevalue, $tag_twoname, $tag_twovalue,$date1) {

         $sql = "SELECT * FROM `" . $table . "` WHERE `$tag_onename`='" . $tag_onevalue . "' and `$tag_twoname`='" . $tag_twovalue . "' and $date1>=NOW()";


        return $this->getData($sql);
    }
      function get_table_row_byidvalue_by_date($table, $primary_id, $id,$date1) {
       $sql = "SELECT * FROM `" . $table . "` WHERE `$primary_id`='" . $id . "'and $date1>=NOW()";

        return $this->getData($sql);
    }
    /*
     function get_table_field_doubles_orderby($table, $tag_onename, $tag_onevalue, $tag_twoname, $tag_twovalue,$orderby) {
                 $sql = "SELECT * FROM `" . $table . "` WHERE `$tag_onename`='" . $tag_onevalue . "' and `$tag_twoname`='" . $tag_twovalue . "' ORDER BY " . $orderby . " DESC";
                      return $this->getData($sql);
        }*/
     function get_table_field_doubles_orderby($table, $tag_onename, $tag_onevalue, $tag_twoname, $tag_twovalue,$orderby,$groupby,$limit) {

        $sql = "SELECT * FROM `" . $table . "` WHERE `$tag_onename`='" . $tag_onevalue . "' and `$tag_twoname`='" . $tag_twovalue . "' GROUP BY ".$groupby." ORDER BY " . $orderby . " DESC limit " . $limit . "";
     return $this->getData($sql);
     }
     
     function get_custom_query($sql)
     {
         return $this->getData($sql);
     }

      function get_table_field_doubles_order($table, $tag_onename, $tag_onevalue, $tag_twoname, $tag_twovalue,$orderby) {

        $sql = "SELECT * FROM `" . $table . "` WHERE `$tag_onename`='" . $tag_onevalue . "' and `$tag_twoname`='" . $tag_twovalue . "'  ORDER BY " . $orderby . " DESC ";
     return $this->getData($sql);
     }
     
    function get_table_field_doubles_not($table, $tag_onename, $tag_onevalue, $tag_twoname, $tag_twovalue) {

        $sql = "SELECT * FROM `" . $table . "` WHERE `$tag_onename`='" . $tag_onevalue . "' and `$tag_twoname`!='" . $tag_twovalue . "'";
        
        return $this->getData($sql);
    }
    function insertnewrecords($table,$datafield,$data)
    {
        
         $insertidsql="INSERT INTO `".$table."` ($datafield) values($data)";
        
        $id=$this->insert($insertidsql);
        return $id;
    }
    function join_two_table($table1,$table2,$id1,$id2,$where,$value)
    {
        
       $sql = "SELECT * FROM `" . $table1 . "` join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "` where  `$where`='" . $value . "'";
       return $this->getData($sql);
    }
    
        function join_two_table_where_groupby($table1,$table2,$id1,$id2,$where,$value,$groupby)
    {
        
        $sql = "SELECT * FROM `" . $table1 . "` join  `" . $table2 . "` on `" . $id1 . "`=`" . $id2 . "` where  `$where`='" . $value . "' group by $groupby DESC";
       return $this->getData($sql);
    }
    
    
    function join_two_table_where_two_field($table1,$table2,$id1,$id2,$where1,$value1,$where2,$value2)
    {
        
       $sql = "SELECT * FROM `" . $table1 . "` join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "` where  $where1='" . $value1 . "' and $where2='" . $value2 . "'";
       return $this->getData($sql);
    }
    function join_three_table($table1,$table2,$table3,$id1,$id2,$id3,$id4,$where,$value)
    {
 $sql = "SELECT * FROM `" . $table1 . "`   join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join `" . $table3 . "` on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "`  where  `$where`='" . $value . "'";
       return $this->getData($sql);
    }
    function join_three_table_leftjoin($table1,$table2,$table3,$id1,$id2,$id3,$id4,$where,$value,$orderby)
    {

        $sql = "SELECT * FROM `" . $table1 . "`left join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join $table3 on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "`  where  `$where`='" . $value . "' ORDER BY $orderby DESC";
       return $this->getData($sql);
    }
    function join_three_table_join_where_two_field($table1,$table2,$table3,$id1,$id2,$id3,$id4,$where1,$value1,$where2,$value2,$orderby)
    {

        $sql = "SELECT * FROM `" . $table1 . "`join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join $table3 on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "`  where  `$where1`='" . $value1 . "' and `$where2`='" . $value2 . "' ORDER BY $orderby DESC";
       return $this->getData($sql);
    }
    function join_three_table_leftjoin_where_two_field($table1,$table2,$table3,$id1,$id2,$id3,$id4,$where1,$value1,$where2,$value2,$orderby)
    {

        $sql = "SELECT * FROM `" . $table1 . "`left join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join $table3 on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "`  where  `$where1`='" . $value1 . "' and `$where2`='" . $value2 . "' ORDER BY $orderby DESC";
       return $this->getData($sql);
    }
    function join_three_table_leftjoin_where($table1,$table2,$table3,$id1,$id2,$id3,$id4,$id5,$id6,$where,$value,$orderby)
        {
                 $sql = "SELECT * FROM `" . $table1 . "`left join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join $table3 on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "`  where  `$where`='" . $value . "'";
           return $this->getData($sql);
        }
        function join_three_table_leftjoin_where_new($table1,$table2,$table3,$id1,$id2,$id3,$id4,$where,$value)
    {
         $sql = "SELECT * FROM `" . $table1 . "`left join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join $table3 on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "`  where  `$where`='" . $value . "'";
       return $this->getData($sql);
    }
    function join_four_table($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$where,$value)
    {
//select * from wallet_transaction wt left join recharge r on wt.wt_user_id = r.recharge_user_id left join operator_list ol on ol.operator_id = r.operator_id where wt_user_id=7
        
        $sql = "SELECT * FROM `" . $table1 . "`   join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join `" . $table3 . "` on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "` join $table4 on `" . $table4 . "`.`" . $id5 . "`=`" . $table2 . "`.`" . $id6 . "` where  `$where`='" . $value . "'";
       return $this->getData($sql);
    }
    function join_four_table_leftjoin($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$where,$value,$orderby,$groupby)
    {
        //SELECT * FROM `wallet_transaction`left join  `church_donate` on `wallet_transaction`.`transaction_id`=`church_donate`.`transaction_id`  join church_list on `church_list`.`church_id`=`church_donate`.`donate_church_id` join church_area on `church_area`.`church_id`=`church_list`.`church_id`  where  `wt_user_id`='6' group by wt_id ORDER BY wt_id DESC
         $sql = "SELECT * FROM `" . $table1 . "`   join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join `" . $table3 . "` on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "` join $table4 on `" . $table4 . "`.`" . $id5 . "`=`" . $table3 . "`.`" . $id6 . "` where  `$where`='" . $value . "' group by $groupby ORDER BY $orderby DESC";
          return $this->getData($sql);
    }
    function join_four_table_new($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$where,$value,$orderby)
    {
//select * from wallet_transaction wt left join recharge r on wt.wt_user_id = r.recharge_user_id left join operator_list ol on ol.operator_id = r.operator_id where wt_user_id=7
        
        $sql = "SELECT * FROM `" . $table1 . "`   join  `" . $table2 . "` on `".$table1."`.`" . $id1 . "`=`" .$table2 . "`.`" . $id2 . "`  join `" . $table3 . "` on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "` join $table4 on `" . $table4 . "`.`" . $id5 . "`=`" . $table1 . "`.`" . $id6 . "` where  `$where`='" . $value . "' ORDER BY " . $orderby . "  ";
       return $this->getData($sql);
    }
    function join_four_table_new_with_two_field($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$where1,$value1,$where2,$value2,$orderby)
    {
//select * from wallet_transaction wt left join recharge r on wt.wt_user_id = r.recharge_user_id left join operator_list ol on ol.operator_id = r.operator_id where wt_user_id=7
        
        $sql = "SELECT * FROM `" . $table1 . "`   join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join `" . $table3 . "` on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "` join $table4 on `" . $table4 . "`.`" . $id5 . "`=`" . $table1 . "`.`" . $id6 . "` where  `$where1`='" . $value1 . "' and `$where2`='" . $value2 . "' ORDER BY " . $orderby . "  ";
       return $this->getData($sql);
    }
    function join_four_table_new_with_three_field($table1,$table2,$table3,$table4,$id1,$id2,$id3,$id4,$id5,$id6,$where1,$value1,$where2,$value2,$where3,$value3,$orderby)
    {
     $sql = "SELECT * FROM `" . $table1 . "`   join  `" . $table2 . "` on `" . $table1 . "`.`" . $id1 . "`=`" . $table2 . "`.`" . $id2 . "`  join `" . $table3 . "` on `" . $table3 . "`.`" . $id3 . "`=`" . $table2 . "`.`" . $id4 . "` join $table4 on `" . $table4 . "`.`" . $id5 . "`=`" . $table1 . "`.`" . $id6 . "` where  `$where1`='" . $value1 . "' and `$where2`='" . $value2 . "'  and `$where3`='" . $value3 . "' ORDER BY " . $orderby . "  ";
       return $this->getData($sql);
    }
    function get_record_find_in_set($tbl_name,$key,$value)
    
    {
         $sql = "SELECT * FROM `" . $tbl_name . "`  where FIND_IN_SET($key,'$value') ";
       return $this->getData($sql);
    }
    
    function get_record_in($tbl_name,$key,$value)
    
    {
         $sql = "SELECT * FROM `" . $tbl_name . "`  where `".$key."` IN($value) ";
       return $this->getData($sql);
    }
     function get_record_in_two_where($tbl_name,$key,$value,$key1,$value1)
    
    {
         $sql = "SELECT * FROM `" . $tbl_name . "`  where `".$key."` IN($value) and `".$key."`=`".$value1."`";
       return $this->getData($sql);
    }
}
