<?php
include 'koneksi.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$cek = mysqli_query($conn, "SELECT * FROM logadm WHERE username = '$username' OR email = '$email'");
if (!$cek) {
  die("Query error: " . mysqli_error($conn));
}

if (mysqli_num_rows($cek) > 0) {
  echo "<script>alert('Username atau Email sudah digunakan!'); window.location='register.php';</script>";
  exit;
}

$simpan = mysqli_query($conn, "
  INSERT INTO logadm (username, email, password)
  VALUES ('$username', '$email', '$password')
");

if ($simpan) {
  echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
} else {
  echo "<script>alert('Registrasi gagal!'); window.location='register.php';</script>";
}
