<?php
session_start(); 
include 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Utama - Admin Dashboard</title>


  <link rel="stylesheet" href="assets/style/style.css">
  <link rel="stylesheet" href="assets/themify-icons/themify-icons.css">
</head>
<body>

<div class="sidebar" id="sidebar">
  
  <div class="sidebar-toggle">
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
  </div>
  <!-- <h2 id="logoText">Admin HPMIG</h2> -->
  <ul>
    <li>
      <a href="index.php" class="active" data-label="Email">
      <span class="icon ti-home"></span>
      <span class="text">Email</span>
      </a>
    </li>

    <li>
      <a href="daftar.php" data-label="Pesan">
        <span class="icon ti-comment-alt"></span>
        <span class="text">Pesan</span>
      </a>
    </li>

    <li>
      <a href="#" data-label="Settings">
        <span class="icon ti-settings"></span>
        <span class="text">Settings</span>
      </a>
    </li>
  </ul>
  <li>
  <a href="logout.php" data-label="Keluar">
    <span class="icon ti-power-off"></span>
    <span class="text">Keluar</span>
  </a>
</li>

</div>

<div class="main" id="main">
  <div class="content-box">
    <h1>Halaman Utama</h1>
    <h4>Selamat datang, <strong><?= $_SESSION['username']; ?></strong></h4>
    <p>Ini adalah halaman utama dashboard Admin HPMIG.</p>
    
    <div style="display: flex; align-items: stretch; gap: 20px; margin-top: 20px;">
      <div style="flex:1; min-width: 250px; background: linear-gradient(150deg, #075197, #FBB803); color: white; padding: 30px; border-radius: 10px;">
        <h2>Total Pesan</h2>
        <div style="align-self: flex-start; margin-top: 20px;">
        <?php
        $pesan = mysqli_query($conn, "SELECT COUNT(*) as total FROM contact");
        $row = mysqli_fetch_assoc($pesan);
        echo "<p style='font-size: 20px;'>{$row['total']} Pesan</p>";
        ?>
        </div>
      </div>

      <div style="flex:1; min-width: 250px; background: linear-gradient(150deg, #FBB803, #075197); color: white; padding: 30px; border-radius: 10px;">
        <h2>Pesan Terbaru Dari</h2>
        <?php
        $terbaru = mysqli_query($conn, "SELECT nama, tanggal, waktu FROM contact ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($terbaru);
        echo "<p style='font-size: 20px;'><strong>{$row['nama']}</strong></p>";
        echo "<p style='font-size: 20px;'>{$row['waktu']}</p>";
        ?>
      </div>
    </div>
  </div>
</div>

<script>
  // Jalankan saat halaman selesai dimuat
  document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');
    const logo = document.getElementById('logoText');
    const isClosed = localStorage.getItem('sidebarClosed') === 'true';

    if (isClosed) {
      sidebar.classList.add('closed');
      main.classList.add('shrink');
      if (logo) logo.style.display = 'none';

      sidebar.querySelectorAll('a .text').forEach(el => el.remove());
    }
  });

  // Fungsi toggle
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');
    const logo = document.getElementById('logoText');

    sidebar.classList.toggle('closed');
    main.classList.toggle('shrink');

    const isClosed = sidebar.classList.contains('closed');
    if (logo) logo.style.display = isClosed ? 'none' : 'block';

    localStorage.setItem('sidebarClosed', isClosed);

    const links = sidebar.querySelectorAll('a');
    links.forEach(link => {
      const text = link.querySelector('.text');
      if (isClosed) {
        if (text) text.remove();
      } else {
        if (!text) {
          const label = link.getAttribute('data-label');
          const span = document.createElement('span');
          span.classList.add('text');
          span.textContent = label;
          link.appendChild(span);
        }
      }
    });
  }
</script>


</body>
</html>
