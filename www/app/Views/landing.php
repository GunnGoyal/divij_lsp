<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Home<?= $this->endSection() ?>
<?= $this->section('content') ?>

<style>
  .hero{padding:88px 0 110px;display:grid;grid-template-columns:1.1fr 1fr;gap:60px;align-items:center;}
  .eyebrow{font-family:'IBM Plex Mono', monospace;font-size:13px;font-weight:500;color:var(--terracotta);text-transform:uppercase;letter-spacing:0.12em;margin-bottom:22px;display:flex;align-items:center;gap:10px;}
  .eyebrow::before{content:'';width:26px;height:1px;background:var(--terracotta);}
  .hero h1{font-size:56px;font-weight:500;line-height:1.05;letter-spacing:-0.01em;}
  .hero h1 em{font-style:italic;font-weight:400;color:var(--terracotta);}
  .hero p{margin-top:24px;font-size:18px;line-height:1.6;opacity:0.85;max-width:480px;}
  .hero-ctas{margin-top:36px;display:flex;gap:14px;align-items:center;}
  .hero-ctas .btn{padding:14px 26px;font-size:15px;}
  .hero-note{margin-top:18px;font-size:12.5px;opacity:0.55;}
  .stack{position:relative;height:420px;}
  .card{position:absolute;width:280px;background:#fff;border:1px solid var(--line);border-radius:6px;padding:22px;box-shadow:0 20px 40px -20px rgba(27,42,74,0.25);transition:transform .35s ease;}
  .card .code{font-family:'IBM Plex Mono',monospace;font-size:12px;color:var(--terracotta);font-weight:500;}
  .card h3{font-size:19px;margin-top:8px;font-weight:600;}
  .card p{font-size:13.5px;margin-top:6px;opacity:0.75;line-height:1.5;}
  .card .tag{margin-top:14px;display:inline-block;font-family:'IBM Plex Mono',monospace;font-size:11px;padding:3px 9px;border-radius:20px;background:var(--parchment-dark);color:var(--ink);}
  .card-1{top:0;left:20px;transform:rotate(-6deg);z-index:1;}
  .card-2{top:70px;left:120px;transform:rotate(3deg);z-index:2;}
  .card-3{top:170px;left:40px;transform:rotate(-2deg);z-index:3;}
  .stack:hover .card-1{transform:rotate(-10deg) translate(-14px,-6px);}
  .stack:hover .card-2{transform:rotate(6deg) translate(10px,-10px);}
  .stack:hover .card-3{transform:rotate(1deg) translate(-4px,10px);}
  .stamp{position:absolute;top:-18px;right:10px;width:112px;height:112px;border-radius:50%;border:2.5px solid var(--gold);display:flex;align-items:center;justify-content:center;background:var(--parchment);transform:rotate(-14deg) scale(0.5);opacity:0;animation:stamp-in .7s cubic-bezier(.2,.8,.3,1.2) .5s forwards;z-index:4;}
  .stamp::before{content:'';position:absolute;inset:6px;border-radius:50%;border:1px dashed var(--gold);}
  .stamp span{font-family:'IBM Plex Mono', monospace;font-size:12px;font-weight:500;color:var(--gold);text-align:center;line-height:1.3;transform:rotate(-8deg);}
  @keyframes stamp-in{to{opacity:1;transform:rotate(-8deg) scale(1);}}
  .catalog{padding:90px 0;border-top:1px solid var(--line);}
  .section-head{max-width:560px;margin-bottom:56px;}
  .section-head h2{font-size:38px;font-weight:500;line-height:1.15;}
  .entry{display:grid;grid-template-columns:110px 1fr 1fr;gap:32px;padding:28px 0;border-top:1px solid var(--line);opacity:0;transform:translateY(14px);transition:opacity .5s ease, transform .5s ease;}
  .entry.in-view{opacity:1;transform:translateY(0);}
  .entry:last-child{border-bottom:1px solid var(--line);}
  .entry .code{font-family:'IBM Plex Mono',monospace;font-size:14px;color:var(--terracotta);padding-top:4px;}
  .entry h3{font-size:21px;font-weight:600;}
  .entry p{margin-top:8px;font-size:15px;opacity:0.78;line-height:1.6;}
  .timetable{padding:90px 0;background:var(--ink);color:var(--parchment);}
  .timetable .section-head h2{color:var(--parchment);}
  .timetable .eyebrow{color:var(--gold);}
  .timetable .eyebrow::before{background:var(--gold);}
  .periods{display:grid;grid-template-columns:repeat(5,1fr);gap:1px;background:rgba(246,240,223,0.15);border:1px solid rgba(246,240,223,0.15);border-radius:6px;overflow:hidden;}
  .period{background:var(--ink);padding:28px 20px;min-height:190px;display:flex;flex-direction:column;}
  .period .slot{font-family:'IBM Plex Mono',monospace;font-size:12px;color:var(--gold);opacity:0.9;margin-bottom:14px;}
  .period h4{font-family:'Fraunces',serif;font-size:18px;font-weight:500;color:var(--parchment);margin:0 0 8px;}
  .period p{font-size:13px;opacity:0.65;line-height:1.5;margin:0;}
  .cta-footer{padding:100px 0 60px;text-align:center;}
  .cta-footer h2{font-size:42px;font-weight:500;max-width:640px;margin:0 auto;line-height:1.15;}
  .cta-footer .hero-ctas{justify-content:center;margin-top:34px;}
  @media (max-width:860px){
    .hero{grid-template-columns:1fr;padding:56px 0 70px;}
    .hero h1{font-size:38px;}
    .stack{height:320px;margin-top:20px;}
    .entry{grid-template-columns:70px 1fr;}
    .periods{grid-template-columns:1fr;}
    .cta-footer h2{font-size:30px;}
  }
</style>

<header class="wrap hero">
  <div>
    <div class="eyebrow">La Salle · Academic Planning</div>
    <h1>Plan your semester<br>like it's <em>already aced</em>.</h1>
    <p>One place for every subject, task, and deadline — plus AI summaries that turn your reading into something you'll actually remember before the exam.</p>
    <div class="hero-ctas">
      <a href="/sign-up" class="btn btn-primary">Create your account</a>
      <a href="/sign-in" class="btn btn-ghost">Sign in</a>
    </div>
    <div class="hero-note mono">@students.salle.url.edu · @ext.salle.url.edu · @salle.url.edu</div>
  </div>

  <div class="stack">
    <div class="stamp"><span>ENROLLED<br>LSPLANNER</span></div>
    <div class="card card-1">
      <div class="code">SUBJ · 101</div>
      <h3>Subjects</h3>
      <p>Every course, its notes, and its documents in one folder.</p>
      <span class="tag">4 active</span>
    </div>
    <div class="card card-2">
      <div class="code">TASK · 204</div>
      <h3>Tasks</h3>
      <p>Deadlines on a calendar you'll actually look at.</p>
      <span class="tag">2 due Friday</span>
    </div>
    <div class="card card-3">
      <div class="code">AI · 360</div>
      <h3>AI Summaries</h3>
      <p>Upload a PDF, get the version you'll remember.</p>
      <span class="tag">Ready in seconds</span>
    </div>
  </div>
</header>

<section class="catalog wrap" id="catalog">
  <div class="section-head">
    <div class="eyebrow">Course Catalog</div>
    <h2>Everything a semester needs, filed correctly.</h2>
  </div>
  <div class="entry">
    <div class="code">01</div>
    <div><h3>Subject Management</h3></div>
    <div><p>Create a subject once and everything lives under it — related tasks, uploaded documents, plain-text notes, and any AI summaries generated from its readings.</p></div>
  </div>
  <div class="entry">
    <div class="code">02</div>
    <div><h3>Task Management</h3></div>
    <div><p>Every task carries a title, a deadline, a status, and the subject it belongs to.</p></div>
  </div>
  <div class="entry">
    <div class="code">03</div>
    <div><h3>Academic Calendar</h3></div>
    <div><p>Your homepage shows pending and completed work at a glance, click through into any task's detail.</p></div>
  </div>
  <div class="entry">
    <div class="code">04</div>
    <div><h3>AI Summaries</h3></div>
    <div><p>Upload a PDF from a subject or on its own — the text gets extracted and summarized, ready to revisit before the exam.</p></div>
  </div>
</section>

<section class="timetable" id="timetable">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Weekly Timetable</div>
      <h2>From sign-up to sorted, in five periods.</h2>
    </div>
    <div class="periods">
      <div class="period"><div class="slot mono">PERIOD 1</div><h4>Sign up</h4><p>Register with your La Salle email.</p></div>
      <div class="period"><div class="slot mono">PERIOD 2</div><h4>Add subjects</h4><p>Create a folder for each course.</p></div>
      <div class="period"><div class="slot mono">PERIOD 3</div><h4>Log tasks</h4><p>Deadlines attached to the right subject.</p></div>
      <div class="period"><div class="slot mono">PERIOD 4</div><h4>Upload &amp; summarize</h4><p>Drop in a PDF, get a summary back.</p></div>
      <div class="period"><div class="slot mono">PERIOD 5</div><h4>Stay ahead</h4><p>Check your calendar, walk in prepared.</p></div>
    </div>
  </div>
</section>

<section class="cta-footer wrap">
  <h2>Your semester, filed and findable.</h2>
  <div class="hero-ctas">
    <a href="/sign-up" class="btn btn-primary">Get started — it's free</a>
  </div>
</section>

<script>
  const entries = document.querySelectorAll('.entry');
  const io = new IntersectionObserver((items)=>{
    items.forEach(item=>{ if(item.isIntersecting){ item.target.classList.add('in-view'); io.unobserve(item.target); } });
  }, {threshold:0.2});
  entries.forEach(e=>io.observe(e));
</script>

<?= $this->endSection() ?>
