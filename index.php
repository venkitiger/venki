<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'CineCast — Where stories find their stars';
$featured = [
 ['title'=>'The Last Monsoon','type'=>'Feature Film','city'=>'Bengaluru','role'=>'Lead Actress','age'=>'22–30','tag'=>'FEATURE FILM','tone'=>'violet'],
 ['title'=>'After the Rain','type'=>'Short Film','city'=>'Mysuru','role'=>'Supporting Actor','age'=>'25–38','tag'=>'SHORT FILM','tone'=>'amber'],
 ['title'=>'Untitled Series','type'=>'Web Series','city'=>'Hyderabad','role'=>'Fresh Faces','age'=>'18–26','tag'=>'WEB SERIES','tone'=>'blue'],
];
require __DIR__ . '/includes/header.php';
?>
<main>
<section class="hero">
 <div class="hero-backdrop"></div><div class="hero-grain"></div>
 <div class="container hero-content">
  <div class="eyebrow"><span class="pulse"></span> THE CASTING NETWORK FOR INDIAN CINEMA</div>
  <h1>Every great story<br>needs <em>its star.</em></h1>
  <p class="hero-copy">A new home for talent and storytellers. Discover opportunities, find the right faces, and bring your next production to life.</p>
  <div class="hero-actions"><a class="btn btn-primary" href="<?= e(url('auth/register.php')) ?>">Find your opportunity <span>↗</span></a><a class="btn btn-ghost" href="#how-it-works">Explore CineCast <span>↓</span></a></div>
  <div class="hero-proof"><div class="avatar-stack"><i>🎬</i><i>🎭</i><i>✨</i></div><span>For actors, models &amp; filmmakers</span><span class="proof-dot">•</span><span>Made for Indian cinema</span></div>
 </div>
 <div class="hero-side-note">CAST DIFFERENT. TELL STORIES.</div>
 <div class="hero-bottom"><span>01 / DISCOVER</span><span>SCROLL TO EXPLORE ↓</span></div>
</section>
<section class="ticker"><div class="ticker-track"><span>CASTING CALLS</span> ✳ <span>NEW TALENT</span> ✳ <span>REAL OPPORTUNITIES</span> ✳ <span>INDIAN CINEMA</span> ✳ <span>CASTING CALLS</span> ✳ <span>NEW TALENT</span> ✳ <span>REAL OPPORTUNITIES</span> ✳</div></section>
<section class="section opportunities" id="opportunities"><div class="container">
 <div class="section-heading"><div><div class="eyebrow dark">THE NEXT BIG THING STARTS HERE</div><h2>Open <em>casting calls.</em></h2></div><a class="text-link" href="<?= e(url('casting/index.php')) ?>">View all opportunities ↗</a></div>
 <div class="casting-grid">
 <?php foreach ($featured as $i=>$job): ?><article class="casting-card <?= e($job['tone']) ?>"><div class="poster poster-<?= $i+1 ?>"><span class="poster-mark"><?= ['C','A','N'][$i] ?></span><span class="poster-index">0<?= $i+1 ?></span><span class="poster-caption"><?= e($job['tag']) ?></span></div><div class="casting-info"><div class="meta-line"><span><?= e($job['type']) ?></span><span><?= e($job['city']) ?></span></div><h3><?= e($job['title']) ?></h3><p><?= e($job['role']) ?> <span>·</span> <?= e($job['age']) ?></p><a href="<?= e(url('casting/index.php')) ?>" class="card-arrow" aria-label="Explore casting calls">↗</a></div></article><?php endforeach; ?>
 </div>
 <p class="demo-note">A glimpse of the opportunities area. Sign in to explore live casting calls.</p>
</div></section>
<section class="section split-section" id="how-it-works"><div class="container split-layout"><div class="split-copy"><div class="eyebrow dark">ONE PLATFORM. TWO WORLDS.</div><h2>Talent meets<br><em>opportunity.</em></h2><p>Whether you're building a career in front of the camera or putting a production together, CineCast gives you a clear place to make the connection.</p><a class="btn btn-dark" href="<?= e(url('auth/register.php')) ?>">Join the network ↗</a></div><div class="role-panels"><a class="role-panel talent" href="<?= e(url('auth/register.php?role=talent')) ?>"><span class="role-number">01 / FOR TALENT</span><span class="role-icon">✳</span><h3>Your next role<br>is out there.</h3><p>Build your profile, showcase your work and apply to productions that fit you.</p><span class="role-link">Create talent profile ↗</span></a><a class="role-panel filmmaker" href="<?= e(url('auth/register.php?role=filmmaker')) ?>"><span class="role-number">02 / FOR FILMMAKERS</span><span class="role-icon">◈</span><h3>Find the face<br>of your story.</h3><p>Publish casting calls, discover talent and manage applications in one place.</p><span class="role-link">Start casting ↗</span></a></div></div></section>
<section class="closing"><div class="container closing-inner"><div class="eyebrow">YOUR STORY STARTS WITH A HELLO</div><h2>The camera is<br><em>waiting.</em></h2><a class="btn btn-light" href="<?= e(url('auth/register.php')) ?>">Create your free account ↗</a></div><div class="closing-orb"></div></section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>