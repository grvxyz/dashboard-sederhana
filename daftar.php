<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
      <a href="index.php" data-label="Email">
      <span class="icon ti-home"></span>
      <span class="text">Email</span>
      </a>
    </li>

    <li>
      <a href="daftar.php" class="active" data-label="Pesan">
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
</div>

</div>

<div class="main" id="main">
  <div class="content-box">
    <h1>Daftar Pesan</h1>
    <p>Ini adalah halaman berisi pesan yang dikirim pengunjung.</p>
    <table>
      <tr style="background-color: #003366; color: white;">
        <th><center>No</center></th>
        <th><center>ID</center></th>
        <th><center>Nama</center></th>
        <th><center>Email</center></th>
        <th><center>Pesan</center></th>
        <th><center>Tanggal</center></th>
        <th><center>Waktu</center></th>
        <th><center>Aksi</center></th>
      </tr>
      <?php
      $no = 1;
      $query = mysqli_query($conn, "SELECT * FROM contact ORDER BY id DESC");
      while ($row = mysqli_fetch_assoc($query)) {
  echo "<tr>
    <td><center>{$no}</center></td>
    <td><center>{$row['id']}</center></td>
    <td>{$row['nama']}</td>
    <td>{$row['email']}</td>
    <td>{$row['pesan']}</td>
    <td>{$row['tanggal']}</td>
    <td>{$row['waktu']}</td>
    <td>
      <center>
      <form method='POST' onsubmit=\"return confirm('Yakin ingin menghapus pesan ini?');\">
        <input type='hidden' name='hapus_id' value='{$row['id']}'>
        <button type='submit' name='hapus' style='background-color: red; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;' class='ti-trash'></button>
      </form>
      </center>
    </td>
  </tr>";
  $no++;
}
      ?>
    </table>
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
