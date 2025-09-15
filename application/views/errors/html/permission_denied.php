<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><title>Permission Denied</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f8f9fa}
.denied-box{max-width:600px;margin:10% auto;text-align:center;padding:40px;border-radius:15px;background:#fff;box-shadow:0 4px 15px rgba(0,0,0,0.1)}
.denied-icon{font-size:80px;color:#dc3545}
</style>
</head>
<body>
<div class="denied-box">
  <div class="denied-icon">🚫</div>
  <h2 class="text-danger">Permission Denied</h2>
  <p class="text-muted">You don’t have access to this page.<br>Contact your administrator if you think this is a mistake.</p>
  <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary btn-home">⬅ Go to Dashboard</a>
</div>
</body>
</html>
