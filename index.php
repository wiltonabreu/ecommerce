<?php 
require("vendor/autoload.php");

use \Slim\Slim;
use Hcode\Page;
use Hcode\DB\Sql;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
     

	$page = new Page();

	$page->setTpl("index");

/*
	$sql = new Sql();
	$results = $sql->select("SELECT * FROM tb_users");

	echo json_encode($results);
*/
});

$app->run();

 ?>