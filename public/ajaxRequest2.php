<?php
include('koneksi.php');
if(isset($_POST['idtemplate'])) {
	
	$idtemplate = $_POST['idtemplate'];
	
	try {
		$query = $db->query("SELECT template FROM kaprodi WHERE idreq='$idtemplate'")->fetch();
		
		echo $query['template'] ;
	}
	catch(exception $e) {
		// TEST
	}
}
?>