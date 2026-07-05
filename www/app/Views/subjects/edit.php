<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>Edit Subject<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $subject = ['id','name','description'] */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">Course Catalog</span>
    <h1>Edit subject</h1>
  </div>
  <a href="/subjects/<?= esc($subject['id']) ?>" class="btn btn-ghost">← Back</a>
</div>

<div class="form-card">
  <form action="/subjects/<?= esc($subject['id']) ?>/update" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="name">Subject name</label>
      <input type="text" id="name" name="name" value="<?= old('name', $subject['name']) ?>" required>
      <?php if (isset($validation) && $validation->getError('name')): ?>
        <div class="field-error"><?= $validation->getError('name') ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description"><?= old('description', $subject['description']) ?></textarea>
      <?php if (isset($validation) && $validation->getError('description')): ?>
        <div class="field-error"><?= $validation->getError('description') ?></div>
      <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Save changes</button>
  </form>
</div>

<?= $this->endSection() ?>
