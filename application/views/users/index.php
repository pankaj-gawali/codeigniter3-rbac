<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Users</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f0f2f5}
.users-box{max-width:1000px;margin:50px auto;background:#fff;padding:30px 40px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.2)}
.action-links a{margin-right:5px}
</style>
</head>
<body>
<div class="users-box">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Users</h2>
    <div>
      <?php if ($this->Permission_model->has_permission($this->session->userdata('role_id'), 'users', 'add')): ?>
        <a href="<?php echo site_url('users/add'); ?>" class="btn btn-success btn-sm">Add User</a>
      <?php endif; ?>
      <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>
  </div>

  <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="table-light">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>
      </thead>
      <tbody>
        <?php foreach($users as $u): ?>
        <tr>
          <td><?php echo $u->id; ?></td>
          <td><?php echo htmlspecialchars($u->name); ?></td>
          <td><?php echo htmlspecialchars($u->email); ?></td>
          <td><?php echo $u->role_name; ?></td>
          <td class="action-links">
            <?php if ($this->Permission_model->has_permission($this->session->userdata('role_id'), 'users', 'edit')): ?>
              <a href="<?php echo site_url('users/edit/'.$u->id); ?>" class="btn btn-primary btn-sm">Edit</a>
            <?php endif; ?>
            <?php if ($this->Permission_model->has_permission($this->session->userdata('role_id'), 'users', 'delete')): ?>
              <a href="<?php echo site_url('users/delete/'.$u->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
