<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><title>Roles</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>body{background:#f0f2f5}.box{max-width:800px;margin:50px auto;background:#fff;padding:30px 40px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,.2)}</style>
</head>
<body>
<div class="box">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Roles</h3>
    <div>
      <a href="<?= site_url('roles/add') ?>" class="btn btn-success btn-sm">Add Role</a>
      <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>
  </div>

  <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
  <?php endif; ?>

  <table class="table table-bordered">
    <thead><tr><th>ID</th><th>Name</th><th>Action</th></tr></thead>
    <tbody>
      <?php foreach($roles as $r): ?>
      <tr>
        <td><?= $r->id ?></td>
        <td><?= htmlspecialchars($r->role_name) ?></td>
        <td>
          <a class="btn btn-primary btn-sm" href="<?= site_url('roles/edit/'.$r->id) ?>">Edit</a>
          <a class="btn btn-danger btn-sm" href="<?= site_url('roles/delete/'.$r->id) ?>" onclick="return confirm('Delete role?')">Delete</a>
          <a class="btn btn-warning btn-sm" href="<?= site_url('permissions/edit/'.$r->id) ?>">Permissions</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
