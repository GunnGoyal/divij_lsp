<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?><?= esc($subject['name'] ?? 'Subject') ?><?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php
  /*
    Expected variables:
    - $subject = ['id','name','description','created_at']
    - $activeTab = 'tasks' | 'documents' | 'notes' | 'summaries'  (default 'tasks')
    - $tasks = [['id','title','deadline','status'], ...]
    - $documents = [['id','filename','uploaded_at','file_path'], ...]
    - $notes = [['id','content','created_at'], ...]
    - $summaries = [['id','title','created_at'], ...]
  */
  $tab = $activeTab ?? 'tasks';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Subject</span>
    <h1><?= esc($subject['name']) ?></h1>
  </div>
  <div class="row-actions">
    <a href="/subjects/<?= esc($subject['id']) ?>/edit" class="btn btn-ghost btn-sm">Edit subject</a>
    <a href="/subjects" class="btn btn-ghost btn-sm">← All subjects</a>
  </div>
</div>

<div class="detail-panel">
  <p style="font-size:15px;opacity:0.8;"><?= esc($subject['description']) ?></p>
  <div class="detail-meta">
    <span class="meta-item">Created <?= esc($subject['created_at']) ?></span>
  </div>
</div>

<div class="tab-nav">
  <a href="/subjects/<?= esc($subject['id']) ?>?tab=tasks" class="<?= $tab === 'tasks' ? 'active' : '' ?>">Tasks</a>
  <a href="/subjects/<?= esc($subject['id']) ?>?tab=documents" class="<?= $tab === 'documents' ? 'active' : '' ?>">Documents</a>
  <a href="/subjects/<?= esc($subject['id']) ?>?tab=notes" class="<?= $tab === 'notes' ? 'active' : '' ?>">Notes</a>
  <a href="/subjects/<?= esc($subject['id']) ?>?tab=summaries" class="<?= $tab === 'summaries' ? 'active' : '' ?>">AI Summaries</a>
</div>

<?php if ($tab === 'tasks'): ?>
  <div style="display:flex;justify-content:flex-end;margin-bottom:16px;">
    <a href="/tasks/create?subject_id=<?= esc($subject['id']) ?>" class="btn btn-primary btn-sm">+ New task</a>
  </div>
  <?php if (empty($tasks)): ?>
    <div class="empty-state"><h3>No tasks yet</h3><p>Add a task tied to this subject.</p></div>
  <?php else: ?>
    <div class="catalog-list">
      <?php foreach ($tasks as $task): ?>
        <div class="row">
          <div class="row-main">
            <div class="code">Due <?= esc($task['deadline']) ?></div>
            <h3><a href="/tasks/<?= esc($task['id']) ?>" style="text-decoration:none;color:inherit;"><?= esc($task['title']) ?></a></h3>
          </div>
          <div class="row-actions">
            <span class="badge <?= $task['status'] === 'completed' ? 'badge-completed' : 'badge-pending' ?>"><?= $task['status'] === 'completed' ? 'Completed' : 'Pending' ?></span>
            <a href="/tasks/<?= esc($task['id']) ?>/edit" class="btn btn-ghost btn-sm">Edit</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

<?php elseif ($tab === 'documents'): ?>
  <div class="form-card wide" style="margin-bottom:24px;">
    <form action="/subjects/<?= esc($subject['id']) ?>/documents" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="form-group">
        <label for="document">Upload a PDF document</label>
        <input type="file" id="document" name="document" accept="application/pdf" required>
      </div>
      <button type="submit" class="btn btn-primary btn-sm">Upload</button>
    </form>
  </div>
  <?php if (empty($documents)): ?>
    <div class="empty-state"><h3>No documents yet</h3><p>Upload a PDF to keep it with this subject.</p></div>
  <?php else: ?>
    <div class="catalog-list">
      <?php foreach ($documents as $doc): ?>
        <div class="row">
          <div class="row-main">
            <div class="code">Uploaded <?= esc($doc['uploaded_at']) ?></div>
            <h3><?= esc($doc['filename']) ?></h3>
          </div>
          <div class="row-actions">
            <a href="<?= esc($doc['file_path']) ?>" target="_blank" class="btn btn-ghost btn-sm">View</a>
            <a href="/summaries/create?document_id=<?= esc($doc['id']) ?>" class="btn btn-gold btn-sm">Summarize</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

<?php elseif ($tab === 'notes'): ?>
  <div class="form-card wide" style="margin-bottom:24px;">
    <form action="/subjects/<?= esc($subject['id']) ?>/notes" method="post">
      <?= csrf_field() ?>
      <div class="form-group">
        <label for="note">Write a note</label>
        <textarea id="note" name="content" placeholder="Plain text notes or explanations for this subject"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-sm">Save note</button>
    </form>
  </div>
  <?php if (empty($notes)): ?>
    <div class="empty-state"><h3>No notes yet</h3><p>Jot down explanations or reminders for this subject.</p></div>
  <?php else: ?>
    <div class="catalog-list">
      <?php foreach ($notes as $note): ?>
        <div class="row">
          <div class="row-main">
            <div class="code">Added <?= esc($note['created_at']) ?></div>
            <p style="margin-top:6px;"><?= nl2br(esc($note['content'])) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

<?php elseif ($tab === 'summaries'): ?>
  <div style="display:flex;justify-content:flex-end;margin-bottom:16px;">
    <a href="/summaries/create?subject_id=<?= esc($subject['id']) ?>" class="btn btn-primary btn-sm">+ Generate summary</a>
  </div>
  <?php if (empty($summaries)): ?>
    <div class="empty-state"><h3>No summaries yet</h3><p>Generate an AI summary from one of this subject's documents.</p></div>
  <?php else: ?>
    <div class="catalog-list">
      <?php foreach ($summaries as $summary): ?>
        <div class="row">
          <div class="row-main">
            <div class="code">Generated <?= esc($summary['created_at']) ?></div>
            <h3><a href="/summaries/<?= esc($summary['id']) ?>" style="text-decoration:none;color:inherit;"><?= esc($summary['title']) ?></a></h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?= $this->endSection() ?>
