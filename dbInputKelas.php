<?php
require_once('dbConnect.php');
if($_SERVER['REQUEST_METHOD']=='POST') {

   $response = array();
   //mendapatkan data
   $id_kelas = $_POST['id_kelas'];
   $nama_kelas = $_POST['nama_kelas'];
   $jurusan = $_POST['jurusan'];
   $angkatan = $_POST['angkatan'];

   
   //Cek npm sudah terdaftar apa belum
   $sql = "SELECT * FROM kelas WHERE id_kelas ='$id_kelas' AND nama_kelas='$nama_kelas'AND jurusan='$jurusan'AND angkatan='$angkatan'";
   $check = mysqli_fetch_array(mysqli_query($con,$sql));
   if(isset($check)){
     $response["value"] = 0;
     $response["message"] = "oops! NPM sudah terdaftar!";
     echo json_encode($response);
   } else {
     $sql = "INSERT INTO kelas (id_kelas,nama_kelas,jurusan,angkatan) VALUES('$id_kelas','$nama_kelas','$jurusan','$angkatan')";
     if(mysqli_query($con,$sql)) {
       $response["value"] = 1;
       $response["message"] = "Sukses mendaftar";
       echo json_encode($response);
     } else {
       $response["value"] = 0;
       $response["message"] = "oops! Coba lagi dong!";
       echo json_encode($response);
     }
   }
   // tutup database
   mysqli_close($con);
} else {
  $response["value"] = 0;
  $response["message"] = "oops! Coba lagi!";
  echo json_encode($response);
}