<?php
function pa($mixed, $stop = false) {
    $ar = debug_backtrace(); $key = pathinfo($ar[0]['file']); $key = $key['basename'].':'.$ar[0]['line'];
    $print = array($key => $mixed); echo( '<pre>'.(print_r($print,1)).'</pre>' );
    if($stop == 1) exit();
}

//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);

require_once __DIR__ ."/lib/MVC/Settings.php";
require_once __DIR__ ."/lib/db/Connect.php";

MVC_Settings::init(require_once __DIR__.'/app/config/settings.php');

Connect::auth(MVC_Settings::get('database'));

$data = array(
    'name' => 'Some Name ololo',
    'description' => 'Some description ololo',
    'category_id' => 0
);

//pa(Connect::insert($data,'content'));
//pa(Connect::delete(5,'content'));


//pa(Connect::query("SELECT * FROM content",'b'));
//pa(Connect::query("SELECT * FROM content WHERE id=2",'as'));
//pa(Connect::query("SELECT * FROM content",'o'));
pa(Connect::query("SELECT * FROM content",'all'));