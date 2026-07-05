<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>New Task<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $subjects = [['id','name'], ...] for the dropdown, $preselectedSubjectId optional */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">Task Register</span>
    <h1>New task</h1>
  </div>
  <a href="/tasks" class="btn btn-ghost">← Back</a>
</div>

<div class="form-card">
  <form action="/tasks" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" value="<?= old('title') ?>" placeholder="e.g. Finish lab report" required>
      <?php if (isset($validation) && $validation->getError('title')): ?>
        <div class="field-error"><?= $validation->getError('title') ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" placeholder="Optional details"><?= old('description') ?></textarea>
    </div>

    <div class="two-col">
      <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="<?= old('deadline') ?>" required>
        <?php if (isset($validation) && $validation->getError('deadline')): ?>
          <div class="field-error"><?= $validation->getError('deadline') ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="subject_id">Subject</label>
        <select id="subject_id" name="subject_id" required>
          <option value="">Select a subject…</option>
          <?php foreach (($subjects ?? []) as $s): ?>
            <option value="<?= esc($s['id']) ?>" <?= (old('subject_id', $preselectedSubjectId ?? '') == $s['id']) ? 'selected' : '' ?>>
              <?= esc($s['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
        <?php if (isset($validation) && $validation->getError('subject_id')): ?>
          <div class="field-error"><?= $validation->getError('subject_id') ?></div>
        <?php endif; ?>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Create task</button>
  </form>
</div>

<?= $this->endSection() ?>
