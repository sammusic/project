<?php
	function pa($mixed, $stop = false) {
		$ar = debug_backtrace(); $key = pathinfo($ar[0]['file']); $key = $key['basename'].':'.$ar[0]['line'];
		$print = array($key => $mixed); echo( '<pre>'.(print_r($print,1)).'</pre>' );
		if($stop == 1) exit();
	}
	
	include 'classes/connect.php';
	
	/**
	 * Creating Path
	*/
	$url=$_SERVER['REQUEST_URI'];
	$url_arr = array();
	$url_arr = preg_split('/[\/]/', $url);
	$url_arr = array_reverse($url_arr);
	$get_alias = $url_arr[0];
	
	
	
	if(empty($get_alias)or($get_alias=='index.php')) $file = 'home'; else $file=$get_alias;
	
	$base_path = '/'.$url_arr[count($url_arr)-2].'/';
	$theme_path = 'template/';
	
	$path_to_file = $_SERVER['DOCUMENT_ROOT'].$base_path.$theme_path.'page-'.$file.'.php';
	
	if(file_exists($path_to_file)){
		$content_page = $path_to_file;
	}else{$content_page = '404.php';}
	
	
	include 'template/inc/head.php'; //doctype+head
	include 'lib/inc/connect.php'; // Connect to base
	include 'lib/inc/menu.php'; // Creating Menu
	
	
	
?>