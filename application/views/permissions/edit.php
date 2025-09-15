<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><title>Edit Permissions</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>body{background:#f0f2f5}.box{max-width:900px;margin:50px auto;background:#fff;padding:30px 40px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,.2)}</style>
</head>
<body>
<div class="box">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Permissions: <?= htmlspecialchars($role->role_name) ?></h3>
    <a href="<?= site_url('permissions') ?>" class="btn btn-secondary btn-sm">Back</a>
  </div>

  <form method="post">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>Module</th>
            <th>View</th>
            <th>Add</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($modules as $m): 
            $row = isset($existing[$m]) ? $existing[$m] : null; ?>
          <tr>
            <td><strong><?= ucfirst($m) ?></strong></td>
            <td><input type="checkbox" name="<?= $m ?>_view"   <?= $row && $row->can_view   ? 'checked':'' ?>></td>
            <td><input type="checkbox" name="<?= $m ?>_add"    <?= $row && $row->can_add    ? 'checked':'' ?>></td>
            <td><input type="checkbox" name="<?= $m ?>_edit"   <?= $row && $row->can_edit   ? 'checked':'' ?>></td>
            <td><input type="checkbox" name="<?= $m ?>_delete" <?= $row && $row->can_delete ? 'checked':'' ?>></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <button class="btn btn-primary">Save</button>
  </form>
</div>
</body>
</html>
