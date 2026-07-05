<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>Generate Summary<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $subjects = [['id','name'], ...] for optional linking, $preselectedSubjectId optional */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">AI · 360</span>
    <h1>Generate a summary</h1>
  </div>
  <a href="/summaries" class="btn btn-ghost">← Back</a>
</div>

<div class="form-card">
  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
  <?php endif; ?>

  <form action="/summaries" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" value="<?= old('title') ?>" placeholder="e.g. Chapter 4 — Normalization" required>
      <?php if (isset($validation) && $validation->getError('title')): ?>
        <div class="field-error"><?= $validation->getError('title') ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="document">PDF document</label>
      <input type="file" id="document" name="document" accept="application/pdf" required>
      <?php if (isset($validation) && $validation->getError('document')): ?>
        <div class="field-error"><?= $validation->getError('document') ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="subject_id">Related subject <span style="opacity:.5;font-weight:400;text-transform:none;">(optional)</span></label>
      <select id="subject_id" name="subject_id">
        <option value="">None — independent summary</option>
        <?php foreach (($subjects ?? []) as $s): ?>
          <option value="<?= esc($s['id']) ?>" <?= (old('subject_id', $preselectedSubjectId ?? '') == $s['id']) ? 'selected' : '' ?>>
            <?= esc($s['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Generate summary</button>
    <p style="font-size:12.5px;opacity:0.6;margin-top:14px;">
      Text is extracted from your PDF and sent to the summarizer through LSPlanner's own backend — never directly from your browser.
    </p>
  </form>
</div>

<?= $this->endSection() ?>
