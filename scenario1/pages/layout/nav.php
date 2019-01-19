<?php 


$nav_items = [
	['name' => 'Home', 'route' => 'home'],
	['name' => 'Students', 'route' => 'students'],
	['name' => 'Add news', 'route' => 'add_news'],
	['name' => 'Upload marks', 'route' => 'upload_marks'],
];

?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">BibiSchool</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
			<?php foreach ($nav_items as $item): ?>
				<?php if ($app->auth()->authorize($app->config['router']['routes'][$item['route']])): ?>
					<li class="nav-item <?= $app->router()->current() === $item['route'] ? 'active' : '' ?>">
						<a class="nav-link" href="<?= $app->router()->url($item['route']) ?>"><?= $item['name'] ?></a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
			
    </ul>
		<ul class="navbar-nav">
			<?php if ($app->auth()->user()): ?>
				<li class="nav-item">
					<span class="navbar-text"><?= $app->auth()->user()['username'] ?> (<?= $app->auth()->getUserRole() ?>)</span>
				</li>
				<li class="nav-item <?= $app->router()->current() === 'logout' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= $app->router()->url('logout') ?>">Logout</a>
				</li>
			<?php else: ?>
				<li class="nav-item ml-auto <?= $app->router()->current() === 'login' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= $app->router()->url('login') ?>">Login</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</nav>