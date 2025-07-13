<?php
include 'koneksi.php';
session_start();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM logadm WHERE username = '$username'");

if ($admin = mysqli_fetch_assoc($query)) {
  if (password_verify($password, $admin['password'])) {
    $_SESSION['login'] = true;
    $_SESSION['id'] = $admin['id'];
    $_SESSION['username'] = $admin['username'];

    header("Location: index.php");
    exit;
  }
}

// Jika gagal login
header("Location: login.php?error=Username atau password salah");
exit;
