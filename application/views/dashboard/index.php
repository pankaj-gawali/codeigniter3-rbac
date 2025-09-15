<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Welcome, <?= htmlspecialchars($user_name) ?> 👋</h3>
    <div>
      <a class="btn btn-secondary btn-sm" href="<?= site_url('users') ?>">Users</a>
      <a class="btn btn-secondary btn-sm" href="<?= site_url('roles') ?>">Roles</a>
      <a class="btn btn-secondary btn-sm" href="<?= site_url('permissions') ?>">Permissions</a>
      <a class="btn btn-danger btn-sm" href="<?= site_url('auth/logout') ?>">Logout</a>
    </div>
  </div>
  <div class="alert alert-info">This is a simple RBAC demo on CodeIgniter 3., Role Base access Control</div>
</div>
</body>
</html>
