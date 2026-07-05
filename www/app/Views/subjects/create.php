<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>New Subject<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="page-head">
  <div>
    <span class="eyebrow">Course Catalog</span>
    <h1>New subject</h1>
  </div>
  <a href="/subjects" class="btn btn-ghost">← Back</a>
</div>

<div class="form-card">
  <form action="/subjects" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="name">Subject name</label>
      <input type="text" id="name" name="name" value="<?= old('name') ?>" placeholder="e.g. Database Systems" required>
      <?php if (isset($validation) && $validation->getError('name')): ?>
        <div class="field-error"><?= $validation->getError('name') ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" placeholder="What this subject covers"><?= old('description') ?></textarea>
      <?php if (isset($validation) && $validation->getError('description')): ?>
        <div class="field-error"><?= $validation->getError('description') ?></div>
      <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Create subject</button>
  </form>
</div>

<?= $this->endSection() ?>
