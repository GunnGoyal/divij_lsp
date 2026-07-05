<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?>Home<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php
  /*
    Expected variables from HomeController::index():
    - $monthLabel       e.g. "July 2026"
    - $daysInMonth      array of ['num' => 1, 'isToday' => bool, 'tasks' => [...]]
      each task: ['id'=>, 'title'=>, 'status'=>'pending|completed']
    - $leadingBlanks    int, empty cells before day 1 to align weekday columns
    - $upcomingTasks    array of tasks for the sidebar list (title, subject, deadline_date, status, id)
  */
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Academic Calendar</span>
    <h1><?= esc($monthLabel ?? 'This Month') ?></h1>
  </div>
  <a href="/tasks/create" class="btn btn-primary">+ New task</a>
</div>

<div class="calendar-grid">
  <div class="cal-day-name">Mon</div>
  <div class="cal-day-name">Tue</div>
  <div class="cal-day-name">Wed</div>
  <div class="cal-day-name">Thu</div>
  <div class="cal-day-name">Fri</div>
  <div class="cal-day-name">Sat</div>
  <div class="cal-day-name">Sun</div>

  <?php for ($i = 0; $i < ($leadingBlanks ?? 0); $i++): ?>
    <div class="cal-cell" style="background:var(--parchment);"></div>
  <?php endfor; ?>

  <?php foreach (($daysInMonth ?? []) as $day): ?>
    <div class="cal-cell <?= !empty($day['isToday']) ? 'today' : '' ?>">
      <span class="date-num"><?= esc($day['num']) ?></span>
      <?php foreach (($day['tasks'] ?? []) as $task): ?>
        <a href="/tasks/<?= esc($task['id']) ?>" class="cal-task <?= $task['status'] === 'completed' ? 'completed' : '' ?>">
          <?= esc($task['title']) ?>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
</div>

<div style="margin-top:44px;">
  <h2 style="font-size:22px;font-weight:600;margin-bottom:18px;">Upcoming &amp; recent</h2>

  <?php if (empty($upcomingTasks)): ?>
    <div class="empty-state">
      <h3>Nothing on the books yet</h3>
      <p>Create your first task to see it show up on the calendar.</p>
      <a href="/tasks/create" class="btn btn-gold">Add a task</a>
    </div>
  <?php else: ?>
    <div class="catalog-list">
      <?php foreach ($upcomingTasks as $task): ?>
        <div class="row">
          <div class="row-main">
            <div class="code"><?= esc($task['subject'] ?? 'No subject') ?> · due <?= esc($task['deadline']) ?></div>
            <h3><a href="/tasks/<?= esc($task['id']) ?>" style="text-decoration:none;color:inherit;"><?= esc($task['title']) ?></a></h3>
          </div>
          <div class="row-actions">
            <span class="badge <?= $task['status'] === 'completed' ? 'badge-completed' : 'badge-pending' ?>">
              <?= $task['status'] === 'completed' ? 'Completed' : 'Pending' ?>
            </span>
            <a href="/tasks/<?= esc($task['id']) ?>/edit" class="btn btn-ghost btn-sm">Edit</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
