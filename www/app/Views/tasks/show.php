<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?><?= esc($task['title'] ?? 'Task') ?><?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $task = ['id','title','description','deadline','status','subject_id','subject_name'] */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">Task</span>
    <h1><?= esc($task['title']) ?></h1>
  </div>
  <a href="/tasks" class="btn btn-ghost">← All tasks</a>
</div>

<div class="detail-panel">
  <p style="font-size:15px;opacity:0.85;"><?= nl2br(esc($task['description'])) ?></p>
  <div class="detail-meta">
    <span class="meta-item">Due <?= esc($task['deadline']) ?></span>
    <span class="meta-item">
      <a href="/subjects/<?= esc($task['subject_id']) ?>" style="color:var(--terracotta);"><?= esc($task['subject_name']) ?></a>
    </span>
    <span class="badge <?= $task['status'] === 'completed' ? 'badge-completed' : 'badge-pending' ?>">
      <?= $task['status'] === 'completed' ? 'Completed' : 'Pending' ?>
    </span>
  </div>
</div>

<div class="row-actions">
  <form action="/tasks/<?= esc($task['id']) ?>/toggle" method="post">
    <?= csrf_field() ?>
    <button type="submit" class="btn btn-gold btn-sm">
      Mark as <?= $task['status'] === 'completed' ? 'pending' : 'completed' ?>
    </button>
  </form>
  <a href="/tasks/<?= esc($task['id']) ?>/edit" class="btn btn-ghost btn-sm">Edit</a>
  <form action="/tasks/<?= esc($task['id']) ?>/delete" method="post" onsubmit="return confirm('Delete this task?');">
    <?= csrf_field() ?>
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
  </form>
</div>

<?= $this->endSection() ?>
