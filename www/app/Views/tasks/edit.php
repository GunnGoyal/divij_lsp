<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>Edit Task<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $task = ['id','title','description','deadline','status','subject_id'], $subjects = [['id','name'], ...] */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">Task Register</span>
    <h1>Edit task</h1>
  </div>
  <a href="/tasks/<?= esc($task['id']) ?>" class="btn btn-ghost">← Back</a>
</div>

<div class="form-card">
  <form action="/tasks/<?= esc($task['id']) ?>/update" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" value="<?= old('title', $task['title']) ?>" required>
      <?php if (isset($validation) && $validation->getError('title')): ?>
        <div class="field-error"><?= $validation->getError('title') ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description"><?= old('description', $task['description']) ?></textarea>
    </div>

    <div class="two-col">
      <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="<?= old('deadline', $task['deadline']) ?>" required>
      </div>

      <div class="form-group">
        <label for="subject_id">Subject</label>
        <select id="subject_id" name="subject_id" required>
          <?php foreach (($subjects ?? []) as $s): ?>
            <option value="<?= esc($s['id']) ?>" <?= (old('subject_id', $task['subject_id']) == $s['id']) ? 'selected' : '' ?>>
              <?= esc($s['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="status">Status</label>
      <select id="status" name="status">
        <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
        <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Save changes</button>
  </form>
</div>

<?= $this->endSection() ?>
