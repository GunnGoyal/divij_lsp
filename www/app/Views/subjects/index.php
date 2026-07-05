<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>Subjects<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $subjects = [['id','name','description','created_at'], ...] */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">Course Catalog</span>
    <h1>Your subjects</h1>
  </div>
  <a href="/subjects/create" class="btn btn-primary">+ New subject</a>
</div>

<?php if (empty($subjects)): ?>
  <div class="empty-state">
    <h3>No subjects yet</h3>
    <p>Create your first subject to start organizing tasks and documents under it.</p>
    <a href="/subjects/create" class="btn btn-gold">Add a subject</a>
  </div>
<?php else: ?>
  <div class="catalog-list">
    <?php foreach ($subjects as $i => $subject): ?>
      <div class="row">
        <div class="row-main">
          <div class="code">SUBJ · <?= str_pad($i + 1, 3, '0', STR_PAD_LEFT) ?> · added <?= esc($subject['created_at']) ?></div>
          <h3><a href="/subjects/<?= esc($subject['id']) ?>" style="text-decoration:none;color:inherit;"><?= esc($subject['name']) ?></a></h3>
          <p><?= esc($subject['description']) ?></p>
        </div>
        <div class="row-actions">
          <a href="/subjects/<?= esc($subject['id']) ?>" class="btn btn-ghost btn-sm">View</a>
          <a href="/subjects/<?= esc($subject['id']) ?>/edit" class="btn btn-ghost btn-sm">Edit</a>
          <form action="/subjects/<?= esc($subject['id']) ?>/delete" method="post" onsubmit="return confirm('Delete this subject? This cannot be undone.');">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?= $this->endSection() ?>
