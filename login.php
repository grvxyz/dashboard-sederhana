<?php include 'koneksi.php'; session_start(); ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
  <div class="card p-5 shadow-sm" style="max-width: 400px;">
    <h3 class="text-center mb-4">Login Admin</h3>

    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger text-center"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="login_action.php" method="post">
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Kata Sandi</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="text-center mt-3">
      <small>Belum punya akun? <a href="register.php">Daftar sekarang</a></small>
    </div>
  </div>
</body>
</html>
