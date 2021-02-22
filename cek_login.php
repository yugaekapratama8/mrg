<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:halaman_admin.php");

	// cek jika user login sebagai supeno
	}else if($data['level']=="supeno"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "supeno";
		// alihkan ke halaman dashboard supeno
		header("location:\multi_user\pelanggan\supeno.html");

	// cek jika user login sebagai supangat
	}else if($data['level']=="supangat"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "supangat";
		// alihkan ke halaman dashboard supangat
		header("location:\multi_user\pelanggan\supangat.html");

	}else{

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}

	
}else{
	header("location:index.php?pesan=gagal");
}



?>