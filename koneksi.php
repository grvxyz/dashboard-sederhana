<?php
$host = "localhost";
$user = "root";
$pass = ""; // password MySQL kamu (default kosong di XAMPP)
$db   = "hpmig";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['hapus'])) {
  $id = mysqli_real_escape_string($conn, $_POST['hapus_id']);
  mysqli_query($conn, "DELETE FROM contact WHERE id = '$id'");
  echo "<script>location.href='daftar.php';</script>";
}
?>
