<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $this->renderSection('title') ?> · LSPlanner</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300..700;1,9..144,400..600&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<div class="app-shell">
  <aside class="sidebar">
    <a href="/home" class="brand"><span class="dot"></span>LSPlanner</a>
    <nav class="side-links">
      <!-- NOTE: add class="active" dynamically based on current route, e.g.
           compare current_url() or uri->getSegment(1) in the controller/view -->
      <a href="/home"><span class="code">01</span> Homepage</a>
      <a href="/subjects"><span class="code">02</span> Subjects</a>
      <a href="/tasks"><span class="code">03</span> Tasks</a>
      <a href="/summaries"><span class="code">04</span> AI Summaries</a>
      <a href="/profile"><span class="code">05</span> Profile</a>
    </nav>
    <div class="sidebar-footer">
      <!-- Logout should be a POST form, not a plain GET link, to avoid CSRF-less state changes -->
      <form action="/logout" method="post">
        <?= csrf_field() ?>
        <button type="submit" class="btn" style="background:none;border:none;color:inherit;opacity:.6;padding:8px 12px;cursor:pointer;font-size:13.5px;">Log out</button>
      </form>
    </div>
  </aside>

  <main class="main-area">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
  </main>
</div>

</body>
</html>
