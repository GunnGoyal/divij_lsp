<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Sign In<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="wrap" style="padding:90px 0;display:flex;justify-content:center;">
  <div class="form-card">
    <div class="eyebrow" style="color:var(--terracotta);font-family:'IBM Plex Mono',monospace;font-size:12.5px;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:10px;">Welcome back</div>
    <h1 style="font-size:28px;font-weight:500;margin-bottom:8px;">Sign in</h1>
    <p style="font-size:14.5px;opacity:0.7;margin-bottom:28px;">Pick up your semester where you left it.</p>

    <?php if (session()->getFlashdata('message')): ?>
      <div class="alert alert-success"><?= esc(session()->getFlashdata('message')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <form action="/sign-in" method="post">
      <?= csrf_field() ?>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="you@students.salle.url.edu" required>
        <?php if (isset($validation) && $validation->getError('email')): ?>
          <div class="field-error"><?= $validation->getError('email') ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>
        <?php if (isset($validation) && $validation->getError('password')): ?>
          <div class="field-error"><?= $validation->getError('password') ?></div>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Sign in</button>

      <div class="form-foot" style="justify-content:center;">
        <span style="font-size:13.5px;opacity:0.7;">New here? <a href="/sign-up" class="link">Create an account</a></span>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
