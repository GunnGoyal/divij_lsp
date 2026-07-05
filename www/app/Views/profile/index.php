<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>Profile<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $user = ['id','username','email','profile_pic'] */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">Your Account</span>
    <h1>Profile</h1>
  </div>
</div>

<div class="profile-header">
  <img src="<?= esc($user['profile_pic'] ?? base_url('assets/img/default-avatar.png')) ?>" alt="Profile picture" class="avatar">
  <div>
    <h2 style="font-size:20px;font-weight:600;"><?= esc($user['username']) ?></h2>
    <p style="opacity:0.7;font-size:14px;margin-top:2px;"><?= esc($user['email']) ?></p>
  </div>
</div>

<div class="form-card wide">
  <h3 style="font-size:16px;margin-bottom:18px;">Account details</h3>
  <form action="/profile" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="two-col">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= old('username', $user['username']) ?>">
        <?php if (isset($validation) && $validation->getError('username')): ?>
          <div class="field-error"><?= $validation->getError('username') ?></div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="profile_pic">Profile picture</label>
        <input type="file" id="profile_pic" name="profile_pic" accept="image/*">
      </div>
    </div>

    <hr class="divider">

    <p style="font-size:13px;opacity:0.7;margin-bottom:16px;">Leave the password fields blank to keep your current password.</p>
    <div class="two-col">
      <div class="form-group">
        <label for="password">New password</label>
        <input type="password" id="password" name="password" placeholder="At least 8 characters">
        <?php if (isset($validation) && $validation->getError('password')): ?>
          <div class="field-error"><?= $validation->getError('password') ?></div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="pass_confirm">Repeat new password</label>
        <input type="password" id="pass_confirm" name="pass_confirm">
        <?php if (isset($validation) && $validation->getError('pass_confirm')): ?>
          <div class="field-error"><?= $validation->getError('pass_confirm') ?></div>
        <?php endif; ?>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Save changes</button>
  </form>
</div>

<div class="danger-zone" style="margin-top:28px;max-width:520px;">
  <h4>Delete account</h4>
  <p>This permanently removes your account, subjects, tasks, documents, and summaries. This cannot be undone.</p>
  <form action="/profile/delete" method="post" onsubmit="return confirm('Are you absolutely sure? This will permanently delete your account.');">
    <?= csrf_field() ?>
    <button type="submit" class="btn btn-danger">Delete my account</button>
  </form>
</div>

<?= $this->endSection() ?>
