<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>Tasks<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $tasks = [['id','title','deadline','status','subject_name'], ...] */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">Task Register</span>
    <h1>Your tasks</h1>
  </div>
  <a href="/tasks/create" class="btn btn-primary">+ New task</a>
</div>

<?php if (empty($tasks)): ?>
  <div class="empty-state">
    <h3>No tasks yet</h3>
    <p>Create a task and tie it to one of your subjects.</p>
    <a href="/tasks/create" class="btn btn-gold">Add a task</a>
  </div>
<?php else: ?>
  <div class="catalog-list">
    <?php foreach ($tasks as $task): ?>
      <div class="row">
        <div class="row-main">
          <div class="code"><?= esc($task['subject_name'] ?? 'No subject') ?> · due <?= esc($task['deadline']) ?></div>
          <h3><a href="/tasks/<?= esc($task['id']) ?>" style="text-decoration:none;color:inherit;"><?= esc($task['title']) ?></a></h3>
        </div>
        <div class="row-actions">
          <span class="badge <?= $task['status'] === 'completed' ? 'badge-completed' : 'badge-pending' ?>">
            <?= $task['status'] === 'completed' ? 'Completed' : 'Pending' ?>
          </span>
          <a href="/tasks/<?= esc($task['id']) ?>/edit" class="btn btn-ghost btn-sm">Edit</a>
          <form action="/tasks/<?= esc($task['id']) ?>/delete" method="post" onsubmit="return confirm('Delete this task?');">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?= $this->endSection() ?>
