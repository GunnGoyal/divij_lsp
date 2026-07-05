<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?><?= esc($summary['title'] ?? 'Summary') ?><?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $summary = ['id','title','summary_text','created_at','subject_id','subject_name'] */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">AI Summary</span>
    <h1><?= esc($summary['title']) ?></h1>
  </div>
  <a href="/summaries" class="btn btn-ghost">← All summaries</a>
</div>

<div class="detail-panel">
  <div class="detail-meta" style="margin-top:0;margin-bottom:20px;">
    <span class="meta-item">Generated <?= esc($summary['created_at']) ?></span>
    <?php if (!empty($summary['subject_name'])): ?>
      <span class="meta-item">
        <a href="/subjects/<?= esc($summary['subject_id']) ?>" style="color:var(--terracotta);"><?= esc($summary['subject_name']) ?></a>
      </span>
    <?php endif; ?>
  </div>
  <div style="font-size:15.5px;line-height:1.75;white-space:pre-line;">
    <?= esc($summary['summary_text']) ?>
  </div>
</div>

<div class="row-actions">
  <form action="/summaries/<?= esc($summary['id']) ?>/delete" method="post" onsubmit="return confirm('Delete this summary?');">
    <?= csrf_field() ?>
    <button type="submit" class="btn btn-danger btn-sm">Delete summary</button>
  </form>
</div>

<?= $this->endSection() ?>
