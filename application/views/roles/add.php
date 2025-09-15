<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><title>Add Role</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>body{background:#f0f2f5}.box{max-width:600px;margin:50px auto;background:#fff;padding:30px 40px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,.2)}</style>
</head>
<body>
<div class="box">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Add Role</h3>
    <a href="<?= site_url('roles') ?>" class="btn btn-secondary btn-sm">Back</a>
  </div>
  <form method="post">
    <div class="mb-3"><label class="form-label">Role Name</label><input name="role_name" class="form-control" required></div>
    <button class="btn btn-success">Save</button>
  </form>
</div>
</body>
</html>
