<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Sign Up<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="wrap" style="padding:70px 0;display:flex;justify-content:center;">
  <div class="form-card">
    <div class="eyebrow" style="color:var(--terracotta);font-family:'IBM Plex Mono',monospace;font-size:12.5px;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:10px;">Enrollment</div>
    <h1 style="font-size:28px;font-weight:500;margin-bottom:8px;">Create your account</h1>
    <p style="font-size:14.5px;opacity:0.7;margin-bottom:28px;">Use your La Salle email — students, ext, or salle.url.edu.</p>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <form action="/sign-up" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>

      <div class="form-group">
        <label for="username">Username <span style="opacity:.5;font-weight:400;text-transform:none;">(optional)</span></label>
        <input type="text" id="username" name="username" value="<?= old('username') ?>" placeholder="Defaults to the part before @ in your email">
        <?php if (isset($validation) && $validation->getError('username')): ?>
          <div class="field-error"><?= $validation->getError('username') ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="you@students.salle.url.edu" required>
        <?php if (isset($validation) && $validation->getError('email')): ?>
          <div class="field-error"><?= $validation->getError('email') ?></div>
        <?php endif; ?>
      </div>

      <div class="two-col">
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="At least 8 characters" required>
          <?php if (isset($validation) && $validation->getError('password')): ?>
            <div class="field-error"><?= $validation->getError('password') ?></div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="pass_confirm">Repeat password</label>
          <input type="password" id="pass_confirm" name="pass_confirm" placeholder="Same as above" required>
          <?php if (isset($validation) && $validation->getError('pass_confirm')): ?>
            <div class="field-error"><?= $validation->getError('pass_confirm') ?></div>
          <?php endif; ?>
        </div>
      </div>

      <div class="form-group">
        <label for="profile_picture">Profile picture <span style="opacity:.5;font-weight:400;text-transform:none;">(optional)</span></label>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
        <?php if (isset($validation) && $validation->getError('profile_picture')): ?>
          <div class="field-error"><?= $validation->getError('profile_picture') ?></div>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Create account</button>

      <div class="form-foot" style="justify-content:center;">
        <span style="font-size:13.5px;opacity:0.7;">Already enrolled? <a href="/sign-in" class="link">Sign in</a></span>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
