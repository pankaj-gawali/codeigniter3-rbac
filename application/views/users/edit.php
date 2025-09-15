<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .form-box {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
<div class="form-box">
    <h2 class="mb-4">Edit User</h2>
    <?php echo form_open('users/edit/'.$user->id); ?>

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $user->name; ?>" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $user->email; ?>" required>
    </div>

    <div class="mb-3">
        <label>Password (leave blank if not changing)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role_id" class="form-select" required>
            <?php foreach($roles as $r): ?>
                <option value="<?php echo $r->id; ?>" <?php echo ($r->id == $user->role_id) ? 'selected' : ''; ?>>
                    <?php echo $r->role_name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?php echo site_url('users'); ?>" class="btn btn-secondary">Back</a>
    <?php echo form_close(); ?>
</div>
</body>
</html>
