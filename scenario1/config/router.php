<?php 

$config['router'] = [
	'routes' => [
		// Page name => [<page code path>, allowed for anonymous users, allowed for authenticated users]
		'home' => ['pages/home.php', true, true],
		'students' => ['pages/students.php', false, true],
		'add_news' => ['pages/add_news.php', false, true],
		'login' => ['pages/login.php', true, false],
		'logout' => ['pages/logout.php', true, true],
	],
	'default' => 'home',
	'not_found_page' => 'pages/not_found.php',
	'access_denied_page' => 'pages/access_denied.php',
	'protocol' => 'http'
];