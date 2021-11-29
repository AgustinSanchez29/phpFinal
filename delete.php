<?php 

	include_once 'conexion.php';
    session_start();

	if(isset($_SESSION['user'])){


	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];
		$delete=$con->prepare('DELETE FROM tallerpfinal WHERE id=:id');
		$delete->execute(array(
			':id'=>$id
		));
		header('Location: pfinal.php');
	}else{
		header('Location: pfinal.php');
	}
 ?>

 <?php
} else {
	header("location:index.php");
	}
 ?>