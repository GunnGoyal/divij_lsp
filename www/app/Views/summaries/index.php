<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>AI Summaries<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php /* Expected: $summaries = [['id','title','created_at','subject_name'], ...] */ ?>

<div class="page-head">
  <div>
    <span class="eyebrow">AI · 360</span>
    <h1>Your summaries</h1>
  </div>
  <a href="/summaries/create" class="btn btn-primary">+ Generate summary</a>
</div>

<?php if (empty($summaries)): ?>
  <div class="empty-state">
    <h3>No summaries yet</h3>
    <p>Upload a PDF and generate your first AI summary.</p>
    <a href="/summaries/create" class="btn btn-gold">Generate one</a>
  </div>
<?php else: ?>
  <div class="catalog-list">
    <?php foreach ($summaries as $summary): ?>
      <div class="row">
        <div class="row-main">
          <div class="code"><?= esc($summary['subject_name'] ?? 'Independent') ?> · <?= esc($summary['created_at']) ?></div>
          <h3><a href="/summaries/<?= esc($summary['id']) ?>" style="text-decoration:none;color:inherit;"><?= esc($summary['title']) ?></a></h3>
        </div>
        <div class="row-actions">
          <a href="/summaries/<?= esc($summary['id']) ?>" class="btn btn-ghost btn-sm">View</a>
          <form action="/summaries/<?= esc($summary['id']) ?>/delete" method="post" onsubmit="return confirm('Delete this summary?');">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?= $this->endSection() ?>
