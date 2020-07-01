<?php
include('koneksi.php');
if(isset($_POST['idtemplate'])) {
	
	$idtemplate = $_POST['idtemplate'];
	
	try {
		$query = $db->query("SELECT template FROM jenis_sk WHERE idjenis_sk='$idtemplate'")->fetch();
		
		echo $query['template'] ;
	}
	catch(exception $e) {
		// TEST
	}
}
?>