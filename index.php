<?php 
ini_set('display_errors','1');
error_reporting(E_ALL);
session_start();
include_once ('layout/header.php'); //require - fatal error if there is no file
include_once ('layout/left_menu.php');

if(isset($_GET["action"]) && file_exists('./views/' . $_GET["action"] . '.php')){ 
	include_once('./views/' . $_GET["action"] . '.php'); 
} 
else { 
	include_once("views/main.php"); 
}        
require_once('layout/right_menu.php');
require_once('layout/footer.php');

?>
        


