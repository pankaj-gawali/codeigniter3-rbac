<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><title>Permissions</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>body{background:#f0f2f5}.box{max-width:700px;margin:50px auto;background:#fff;padding:30px 40px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,.2)}</style>
</head>
<body>
<div class="box">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Permissions</h3>
    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary btn-sm">Back</a>
  </div>
  <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
  <?php endif; ?>

  <ul class="list-group">
    <?php foreach($roles as $r): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span><?= htmlspecialchars($r->role_name) ?></span>
        <a class="btn btn-warning btn-sm" href="<?= site_url('permissions/edit/'.$r->id) ?>">Edit Permissions</a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
</body>
</html>
