<?php

class DB
{
	public $blank_array = array();
	
	public $API_KEY = 'AIzaSyCrKrzFlPbauqLNuXy6mdi4xZd13djnIHU';
		
	public $AND_PUSH_URL = 'https://android.googleapis.com/gcm/send';

	function DB()
	{
		error_reporting(1);

		mysql_connect('localhost','simone_wtc','Per8RFmNUsuL') or die('Cannot connect to the DB');
		mysql_select_db('simone_wtc') or die('Cannot select the DB');
		//mysql_connect('localhost','root','') or die('Cannot connect to the DB');
		//mysql_select_db('whotochoose') or die('Cannot select the DB');
		
		if (!defined('WEBSITE')) define('WEBSITE', "http://".$_SERVER['SERVER_NAME']."/admin_wtc/");
	}

	function new_base_rul()
	{
		if(isset($_SERVER['HTTPS']))
		{
			$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
		}
		else
		{
			$protocol = 'http';
		}
		return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

	function run_sql($sql)
	{
		$rs = mysql_query($sql);
		
		if($rs!== false)
		{
			return $rs;
		}
		else
		{
			return false;
		}
	}

	function insert($sql)
	{
		$rs = $this->run_sql($sql);
		
		if($rs !== false)
		{
			return mysql_insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function getLastId()
	{
		return mysql_insert_id();
	}
	
	function fetchRow($rs, $sec="no")
	{
		if($rs !== false)
		{
			$data = mysql_fetch_assoc($rs);
			if($sec == "no" && $data !== false)
			{
				$count = 0;
				foreach($data as $key=>$val)
				{
					$data[$key] = ($data[$key]);
					$count++;
				}
			}
			
			return $data;
		}
		else
		{
			return false;
		}
	}
		
	function getData($sql)
	{
		$rs = $this->run_sql($sql);		
		$totalrows = mysql_num_rows($rs);
		$data = array();
		
		if($totalrows > 0)
		{
			$x=0;
			while($rs_data = mysql_fetch_assoc($rs))
			{
				$count = 0;
				
				foreach($rs_data as $key=>$val)
				{
					$data[$x][$key] = htmlentities($val);
					$count++;
				}
				
				$x++;
			}
			
			return $data;
		}
		else
		{
			return $data;
		}
	}

	function moveToFirstRow($rs)
	{
		if($rs !== false)
		{
			mysql_data_seek($rs,0);
		}
	}

	function makeDataset($rs)
	{
		if($rs !== false)
		{	
			$count = 0;
			while($data = mysql_fetch_assoc($rs))
			{
				$result[$count] = $data;
				$count++;
			}

			return $result;
		}
		else
		{
			return false;
		}
	}

	function getTotalRows($sql)
	{
		$rs = $this->run_sql($sql);		
		$totalrows = mysql_num_rows($rs);
		return $totalrows;
	}

	function formatData($theValue, $theType, $isNull="no")
	{
		$theNull = strtolower($theNull);
		$theValue = addslashes(stripslashes($theValue));
		
		switch ($theType) 
		{
			case "text":
			$theValue = ($theValue != "") ? $theValue  : (($theNull == "yes") ? "NULL" : "");
			break;    
			
			case "long":

			case "int":
			$theValue = ($theValue != "") ? intval($theValue) : (($theNull == "yes") ? "NULL" : 0);
			break;
			
			case "double":
			$theValue = ($theValue != "") ?  doubleval($theValue)  : (($theNull == "yes") ? "NULL" : 0);
			break;
			
			case "date":
			$theValue = ($theValue != "") ?  $theValue  : (($theNull == "yes") ? "NULL" : "");
			break;
			
			case "defined":
			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
			break;
		}
			
		return $theValue;
	}



	function modify($sql)
	{
		$this->run_sql($sql);
		return mysql_affected_rows();
	}


   function get_complete_table_bystatus($table,$status)
	{
		$sql="SELECT * FROM `".$table."` where ".$status."='0'";
		return $this->getData($sql);
	}
  

   function get_complete_table_bystatus1($table,$status)
	{
		$sql="SELECT * FROM `".$table."` where ".$status."='1'";
		return $this->getData($sql);
	}


	function getDataSingleRow($sql, $sec = "yes")
	{
		$rs = $this->run_sql($sql);		
		$totalrows =@mysql_num_rows($rs);
		$data = array();

		if($totalrows > 0)
		{
			$data = mysql_fetch_assoc($rs);
			$count = 0;

			foreach($data as $key=>$val)
			{
				if($sec == "no")
				{
					$data[$key] = $val;
				}
				else
				{
					$data[$key] = htmlentities($val);
				}

				$count++;
			}

			return $data;
		}
		else
		{
			return $this->blank_array;
		}
	}
	
	function getDataSingleRecord($sql)
	{
		$rs = $this->run_sql($sql);		
		$totalrows = mysql_num_rows($rs);
		$data = array();

		if($totalrows > 0)
		{
			$data = mysql_fetch_assoc($rs);
			return htmlentities($data['id']);
		}
		else
		{
			return false;
		}
	}

	function insertdataintable($table,$data,$primary)
	{
		$insertidsql="INSERT INTO `".$table."` (`$primary`) values('')";
		$id=$this->insert($insertidsql);
	
		foreach($data as $key=>$value)
		{
			if($this->findColumn($table, $key))
			{
				$update="UPDATE `".$table."` SET `".$key."`='".$value."' WHERE `$primary`=".$id;
				$result=$this->modify($update);
			}
		}
		
		return $id;
	}

	function updatetablebyid($table,$primary_id, $id, $data)
	{
		if($id==0)
		{
			$sql="INSERT INTO `".$table."` ($primary_id ) value('')";
			$id=$this->insert($sql);
		}

		foreach($data as $key=>$value)
		{
			$sql="UPDATE `".$table."` SET `".$key."`='".$value."' WHERE `$primary_id`=".$id;
			$this->modify($sql);
		}
	
		return $id;
	}

	function deletedataintable($table,$id)
	{
		$sql="DELETE FROM `".$table."` WHERE `id`=".$id;
		$result=$this->modify($sql);
		return $result;
	}

	function deletedataintablebycol($table,$id,$colname)
	{
		$sql="DELETE FROM `".$table."` WHERE $colname=".$id; 
		$result=$this->modify($sql);
		return $result;
	}
	
	function deletedataintablebytwocol($table,$colnameone,$id1,$colnametwo,$id2)
	{
	    $sql="DELETE FROM `".$table."` WHERE $colnameone=".$id1." and  $colnametwo=".$id2.""; 
		$result=$this->modify($sql);
		return $result;
	}

	function findColumn($tableName, $columnName)
	{
		$sql="select * from ".$tableName;
		$result = $this->getDataSingleRow($sql);

		foreach($result as $key=>$value)
		{
			if ($key==$columnName)
			{
				return true;
			}
		}
		
		return false;
	}



	function get_complete_table($table)
	{
		$sql="SELECT * FROM `".$table."` where `isactive`='1'";
		return $this->getData($sql);
	}
	
	function get_complete_table_record($table)
	{
		$sql="SELECT * FROM `".$table."`";
		return $this->getData($sql);
	}

	function get_table_row_byid($table,$primary_id, $id)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$primary_id`=".$id;
		return $this->getDataSingleRow($sql);
	}

   
	function get_table_row_byidvalue($table,$primary_id, $id)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$primary_id`=".$id;
		return $this->getdata($sql);
	}
	
	function get_table_field_byid($field, $table, $id)
	{
		$sql="SELECT `".$field."` FROM `".$table."` WHERE `id`=".$id;
		return $this->getDataSingleRow($sql);
	}

	function get_single_by_type($table,$type, $id)
	{
		 $sql="SELECT * FROM `".$table."` WHERE `$type`='".$id."'";
		return $this->getDataSingleRow($sql);
	}

	function get_table_field_single($table,$tag_onename,$tag_onevalue)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."'";
		return $this->getTotalRows($sql);
	}

	function get_table_field_doubles($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue)
	{
	
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."'";
		
	 
		return $this->getTotalRows($sql);
	}
	
	
	function get_table_field_doubles_type($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue)
	{
	
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."'";
		return $this->getDataSingleRow($sql);
	}
	
	
	function get_table_field_triples($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue,$tag_three,$tag_threevalue)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."' and `$tag_three`='".$tag_threevalue."'";
		return $this->getTotalRows($sql);
	}
	
	function get_table_field_double($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."'";
		return $this->getDataSingleRow($sql);
	}

	function get_table_field_triple($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue,$tag_three,$tag_threevalue)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."' and `$tag_three`='".$tag_threevalue."'";
		return $this->getDataSingleRow($sql);
	}

	function get_active_login_user($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue,$tag_three,$tag_threevalue,$tag_four,$tag_fourvalue)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."' and `$tag_three`='".$tag_threevalue."' and `$tag_four`='".$tag_fourvalue."'";
		return $this->getDataSingleRow($sql);
	}

	function get_email_customer($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`!='".$tag_twovalue."'";
		return $this->getDataSingleRow($sql);
	}

	function get_data_table_field_single($table,$tag_onename,$tag_onevalue,$id)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' order by `$id` Desc";
		return $this->getData($sql);
	}

	function get_data_table_field_double($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."'";
		return $this->getData($sql);
	}

	function get_data_table_field_triple($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue,$tag_threename,$tag_threevalue)
	{
	 	$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."' and `$tag_threename`='".$tag_threevalue."'";
		return $this->getData($sql);
	}

	function get_data_table_multiple_fields($table,$table1,$table2,$table_field,$table1_field,$table1_field2,$table_value,$table2_field)
	{ 
		$sql="SELECT DISTINCT ".$table.".*,".$table1.".*,".$table2.".* FROM ".$table." as ".$table.",".$table1." as ".$table1.",".$table2." as ".$table2." WHERE ".$table.".".$table_field."!=".$table_value." and ".$table.".".$table_field."=".$table1.".".$table1_field." and ".$table1.".".$table1_field2."=".$table2.".".$table2_field." ";
		return $this->getData($sql);
	}

	function get_all_records($table)
	{
		$sql="SELECT * FROM `".$table."`";
		return $this->getData($sql);
	}

	function insertnewrecords($table,$datafield,$data)
	{
		echo $insertidsql="INSERT INTO `".$table."` ($datafield) values($data)";
		
		$id=$this->insert($insertidsql);
		return $id;
	}

	function get_feedback_screen_comments_likes($table,$delicacies_id)
	{
		$sql = "SELECT a. * , b. `id` as `bidd` , b.`first_name`,b.`last_name` FROM `$table` AS a, yum_customers AS b WHERE a.`delicious_id` ='".$delicacies_id."' AND a.`taker_customer_id` = b.id order by a.`id` DESC";
		return $this->getData($sql);
	}

	function get_street_address($lat,$long)
	{
		$url = "http://ws.geonames.org/findNearbyPlaceNameJSON?lat=".$lat."&lng=".$long."";
		$json = file_get_contents($url);
		$data = json_decode($json, true);
		return $data;
	}

	function get_new_street_address($latitude,$longitude,$key)
	{
		$lat=mb_convert_encoding($latitude, 'UTF-8',mb_detect_encoding($latitude, 'UTF-8, ISO-8859-1', true));
		$long=mb_convert_encoding($longitude, 'UTF-8',mb_detect_encoding($longitude, 'UTF-8, ISO-8859-1', true));
		$url="http://maps.google.com/maps/geo?q=$lat,$long&amp;output=json&amp;sensor=false&amp;key=".$key;
		$response =$this->getGeolocation($url);
		return $geo = explode(',', $response);
	}

	function getGeolocation($url)
	{
		$init = curl_init();
		curl_setopt($init, CURLOPT_URL, $url);
		curl_setopt($init, CURLOPT_HEADER,0);
		curl_setopt($init, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
		curl_setopt($init, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($init);
		curl_close($init);
		return $response;
	}

	function get_new_data_table_field_single($table,$tag_onename,$tag_onevalue)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."'";
		return $this->getData($sql);
	}

 	function get_cloumn_row_byid($table,$columns,$id)
	{
		$sql="SELECT $columns FROM `".$table."` WHERE `id`=".$id;
		return $this->getDataSingleRow($sql);
	}

	function update_by_types($table,$id,$data,$type) 
	{
		foreach($data as $key=>$value)
		{
			$sql="UPDATE `".$table."` SET `".$key."`='".$value."' WHERE $type=".$id;
			$this->modify($sql);
		}
	}

	function update_by_types_return($table,$id,$data,$type) 
	{
		foreach($data as $key=>$value)
		{
			$sql="UPDATE `".$table."` SET `".$key."`='".$value."' WHERE $type=".$id;
			return $this->modify($sql);
		}
	}
	
	function get_data_table_field_double_group($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue,$id)
	{
		 $sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."' GROUP BY $id";
		return $this->getData($sql);
	}



function update_by_two_types_return($table,$first,$seccond,$data,$type1,$type2) 
	{
		foreach($data as $key=>$value)
		{
			 $sql="UPDATE `".$table."` SET `".$key."`='".$value."' WHERE $type1=".$first;
		
			$result=$this->modify($sql);
		}
	
	  return $first;
	}

	
	
	function get_data_table_field_double_orderby($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue,$name)
	{
		$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."' ORDER BY `".$name."` ASC";
		return $this->getData($sql);
	}
	
    function get_data_table_field_triple_orderby($table,$tag_onename,$tag_onevalue,$tag_twoname,$tag_twovalue,$tag_threename,$tag_threevalue,$name)
	{
	 	$sql="SELECT * FROM `".$table."` WHERE `$tag_onename`='".$tag_onevalue."' and `$tag_twoname`='".$tag_twovalue."' and `$tag_threename`='".$tag_threevalue."' ORDER BY `".$name."` ASC";
		return $this->getData($sql);
	}	
	
	
	// Push For iPhone
	function sendpushIphone($reg_iph,$push)
	{
		/// --- SEND PUSH IPHONE APNSPHP ----
		foreach($reg_iph['registration_id'] as $key => $regId)
		{
			// Instantiate a new Message with a single recipient
			$message = new ApnsPHP_Message($reg_iph);
			$message->setCustomIdentifier("Message-Badge-".$reg_iph);
			$message->setSound();
			$message->setText('Testing Notification');

			// Set a custom property
			$message->setCustomProperty('title',"Test");
			$message->setCustomProperty('msg',"Test");
			$message->setCustomProperty('type',"Test");
			// Add the message to the message queue
			$push->add($message);
		}
		
		// Send all messages in the message queue
		try{
			$push->send();
		}catch(Exception $e){
			echo "Send Push Failed".$e->getMessage();
			$push->send();
		}
		
		// Disconnect from the Apple Push Notification Service
		$push->disconnect();
		// Examine the error message container
		$aErrorQueue = $push->getErrors();
		if (!empty($aErrorQueue)) 
		{
			return $aErrorQueue;
		}
	}/// --- SEND::sendpushIphone() ---
	
	
	//Push For Android
	function sendpush($message,$type,$user_register)
	{
		/// --- If every thing goes fine then SEND PN code To deserved users once ---
	
		$url = $this->AND_PUSH_URL;
		$contentTitle = "YUM! Market";
		$bundle= array('title'=>$contentTitle,'msg'=>$message,'type'=>$type);
		/// --- Common PUSH Set ---
		 if(isset($user_register) && count($user_register)>1000)
		{
			$result=array_chunk($user_register, 1000);
			if(isset($result) && count($result)>0)
			{
				foreach($result as $key => $regId)
				{
					$urls[]=$url;
					$data[]=array(
								'data' => $bundle,
								'dry_run'=>false,
								"delay_while_idle"=> true,
								'registration_ids' => $regId
							);
				}
				$response=$this->MultiRequests($urls,$data);
			}
		}
		else
		{
			$urls[]=$url;
			$data[]=array(
						'data' => $bundle,
						'dry_run'=>false,
						"delay_while_idle"=> true,
						'registration_ids' =>$user_register
					);
			
			$response=$this->MultiRequests($urls,$data);		
		}
		return $response;
	}/// --- FEND::sendPush() ---
	
	
	/*------------------------------------------------------------
	 | Function for send curl multipal request simultanousaly
	 ------------------------------------------------------------*/
	function MultiRequests($urls , $data) {
		$curlMultiHandle = curl_multi_init();
		$curlHandles = array();
		$responses = array();

		foreach($urls as $id => $url) {
			$curlHandles[$id] = $this->CreateHandle($url , $data[$id]);
			curl_multi_add_handle($curlMultiHandle, $curlHandles[$id]);
		}

		$running = null;
		do {
			curl_multi_exec($curlMultiHandle, $running);
		} while($running > 0);

		foreach($curlHandles as $id => $handle) {
			$responses[$id] = curl_multi_getcontent($handle);
			curl_multi_remove_handle($curlMultiHandle, $handle);
		}
		curl_multi_close($curlMultiHandle);

		return $responses;
	}
	/*--------------------------------------------------------------
	 | Initiate Function for send curl multipal request simultanousaly
	 ----------------------------------------------------------------
	*/
	function CreateHandle($url , $data) {
		$curlHandle = curl_init($url);

		$headers = array("Content-Type:" . "application/json", "Authorization:" . "key=".$this->API_KEY);
		$defaultOptions = array (
			CURLOPT_HTTPHEADER =>$headers,		
			CURLOPT_ENCODING => "gzip" ,
			CURLOPT_FOLLOWLOCATION => true ,
			CURLOPT_RETURNTRANSFER => true ,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => json_encode($data)
		);

		curl_setopt_array($curlHandle , $defaultOptions);

		return $curlHandle;
	}
	
	 function sendEmail($sendto,$subject,$message)
	{
		$headers= "From: YUM! Market <admin@server.com>\r\n";
		$headers.= "Reply-To: YUM! Market <admin@server.com>\r\n";
		$headers.= "X-Mailer: PHP/" . phpversion()."\r\n";
		$headers.= "MIME-Version: 1.0" . "\r\n";
		$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
		mail(trim($sendto), $subject, $message, $headers);
	}
	
//	for find week number
	function week_of_month($date)
	{
	  $date_parts = explode('-', $date);
	  $date_parts[2] = '01';
	  $first_of_month = implode('-', $date_parts);
	  $day_of_first = date('N', strtotime($first_of_month));
	  $day_of_month = date('j', strtotime($date));
	  return floor(($day_of_first + $day_of_month - 1) / 7) + 1;
	}	

	function simple_sql_run($sql)
	{
		return $this->getData($sql);
	}

	
	
}

$db = new DB();
?>