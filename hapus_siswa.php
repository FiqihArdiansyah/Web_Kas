<?php 
	require 'connection.php';
	$id_mahasiswa = $_GET['id_mahasiswa'];
	if (isset($id_mahasiswa)) {
		if (deletemahasiswa($id_mahasiswa) > 0) {
			setAlert("mahasiswa has been deleted", "Successfully deleted", "success");
		    header("Location: mahasiswa.php");
	    }
	} else {
	   header("Location: mahasiswa.php");
	}