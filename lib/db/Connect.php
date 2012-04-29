<?php
class Connect
{
	static private $error_message = true;
	static private $db_list = array();
	
	static public function show_error(){
		if(self::$error_message==0){
			echo "<p>ERROR ".mysql_errno()." ".mysql_error()."</p>";
		}
	}
	
	static public function auth($settings){
		if(isset($settings)){
			if (!mysql_connect($settings['host'],
							   $settings['username'],
							   $settings['password'])){
				self::show_error();
				
				exit;
			}else{
				$db_list = mysql_query("SHOW TABLES FROM {$settings['dbname']}");
				self::$db_list = mysql_fetch_array($db_list,MYSQL_ASSOC);
				
				mysql_select_db($settings['dbname']);
				self::show_error();
			}
		}else{
			return null;
		}
	}
	
	static public function query($sql,$flag=''){
		if(isset($sql)){
			$sql = mysql_query($sql);
			self::show_error();
			
			if(isset($flag)){
				switch($flag){
					case 'b':$data = mysql_fetch_array($sql,MYSQL_BOTH);
								break;
					case 'o':$data = mysql_fetch_object($sql);
								break;
					case 'as':$data = mysql_fetch_array($sql,MYSQL_ASSOC);
								break;
					case 'all':$data = array();
								while ($row = mysql_fetch_array($sql,MYSQL_ASSOC)) {
									$data[]=$row;
								}
								return $data;
								break;
					default: break;
				}
				if(isset($data)){
					return $data;
				}else return $sql;
			}else{
				return $sql;
			}
		}else{return null;}
	}
	
	static public function insert($data,$table){
		
		if(in_array($table,self::$db_list)){
		
			$res = mysql_query("SHOW COLUMNS FROM {$table}");
			$fields = array();
			while ($row = mysql_fetch_array($res,MYSQL_ASSOC)) {
				$fields[]=$row;
			}
			
			$value = '';
			for($i=0;$i<count($fields);$i++){
				if($fields[$i]['Extra']=='auto_increment'){
					$value .="'NULL'";
				}elseif(isset($data[$fields[$i]['Field']])){
					$value .= "'".$data[$fields[$i]['Field']]."'";
				}else{
					if($fields[$i]['Type']=='date'){
						$value .= "'".date("Y-m-d")."'";
					}elseif($fields[$i]['Type']=='text'){
						$value .='';
					}elseif($fields[$i]['Type']=='varchar'){
						$value .='';
					}else{$value .='0';}
					
				}
				if($i<>count($fields)-1) $value .= ', ';
			}
			$sql = mysql_query("INSERT INTO {$table} VALUES ({$value})");
		}else{
			echo $table.' is not in this database!';
		}
	}
	
	static public function delete($id,$table){
		if(in_array($table,self::$db_list)){
			$sql = mysql_query("DELETE FROM {$table} WHERE id='$id'");
		}else{
			echo $table.' is not in this database!';
		}
	}
	
	static public function edit($date,$table){
		
		
		
		
		pa(1,1);
		$sql = mysql_query("UPDATE {$table} SET name='$name',description='$description',date_change='$date',category_id='$category_id')");
	}
	
	
	/*
	function get_data($resource){
		$data = mysql_fetch_array($resource);
		$res = array('title'=>array('value'=>$data['title']),'body'=>array('value'=>$data['body']));
		return $res;
	}
	
	function count_row($resource){
		$data = mysql_num_rows($resource);
		return $data;
	}

	*/
	
	
	/*
	function get_menu($resource){
		$data = mysql_fetch_array($resource,MYSQL_ASSOC);
		return $data;
	}
	
	function select($field,$table,$where = NULL, $limit=NULL){
		if(($where==NULL)&&($limit==NULL)) $sql = mysql_query('SELECT $field FROM $table');
		elseif($where==NULL) $sql = mysql_query('SELECT $field FROM $table LIMIT=$limit');
		elseif($limit==NULL) $sql = mysql_query('SELECT $field FROM $table WHERE $where');
		else $sql = mysql_query('SELECT $field FROM $table WHERE $where LIMIT=$limit');
		
		$sql = mysql_fetch_array($sql);
		
		return $sql;
	}
	
	function insert_menu($alias, $description){
		$sql = mysql_query("INSERT INTO menu VALUES (NULL, '$alias','$description',0)");
		$this->show_error();
		return $sql;
	}

	function rewrite_menu($arr){
		$sql = mysql_query("DELETE FROM menu");
		
		for($i=0;$i<count($arr);$i++){
			if(isset($arr['id-'.$i])){
				$id = $arr['id-'.$i];
				$alias = $arr['alias-'.$i];
				$description = $arr['description-'.$i];
				$id_content = $arr['id_content-'.$i];

				$sql = mysql_query("INSERT INTO menu VALUES ('$id', '$alias','$description','$id_content')");
			}
		}
		$this->show_error();
		return $sql;
	}
	
	function insert($value){
		
		$id = mysql_insert_id();
	
		if(isset($value['title'])){
			if(isset($value['body'])){
				echo '1';
				$sql = mysql_query('INSERT INTO \'content\'(\'title\',\'body\') VALUE (\'$value[\'title\']\',\'$value[\'body\']\')');
			}
		}
		
		echo $id.'<<new<br/>';
		return $id;
	}*/
	
}

?>