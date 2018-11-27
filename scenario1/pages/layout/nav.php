<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">BibyWebsite</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?= $app->router()->current() === 'home' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= $app->router()->url('home') ?>">Home</a>
	  </li>
	<?php if ($app->auth()->user()): ?>
		<li class="nav-item <?= $app->router()->current() === 'students' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= $app->router()->url('students') ?>">Students</a>
		</li>
		<li class="nav-item <?= $app->router()->current() === 'add_news' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= $app->router()->url('add_news') ?>">Add news</a>
		</li>
		<li class="nav-item <?= $app->router()->current() === 'logout' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= $app->router()->url('logout') ?>">Logout</a>
		</li>
	<?php else: ?>
		<li class="nav-item <?= $app->router()->current() === 'login' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= $app->router()->url('login') ?>">Login</a>
		</li>
	<?php endif; ?>

    
    </ul>
  </div>
</nav>