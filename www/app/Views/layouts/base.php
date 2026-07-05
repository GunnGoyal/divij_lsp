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

<nav class="public-nav">
  <div class="nav-inner">
    <a href="/" class="brand"><span class="dot"></span>LSPlanner</a>
    <div class="nav-links">
      <a href="/#catalog">Features</a>
      <a href="/#timetable">How it works</a>
      <a href="/sign-in">Sign in</a>
      <a href="/sign-up" class="btn btn-primary">Sign up</a>
    </div>
  </div>
</nav>

<?= $this->renderSection('content') ?>

<footer class="wrap" style="border-top:1px solid var(--line);padding:28px 0;font-family:'IBM Plex Mono',monospace;font-size:12.5px;opacity:0.55;display:flex;justify-content:space-between;">
  <div>© 2026 LSPlanner — La Salle Community</div>
  <div>Built for students, by students</div>
</footer>

</body>
</html>
