<?php 

$config['router'] = [
	'routes' => [
		// Page name => [<page code path>, [<authorized roles>]]
		'home' => ['pages/home.php', 
			[
				$config['roles']['GUEST'], 
				$config['roles']['STUDENT'], 
				$config['roles']['TEACHER'], 
				$config['roles']['COMMUNICATION'], 
				$config['roles']['SECRETARY'], 
				$config['roles']['ADMIN']]
			],
		'students' => ['pages/students.php', 
			[
				$config['roles']['TEACHER']]
			],
		'add_news' => ['pages/add_news.php', 
			[
				$config['roles']['COMMUNICATION']]
			],
		'login' => ['pages/login.php', 
			[
				$config['roles']['GUEST']]
			],
		'logout' => ['pages/logout.php', [
			$config['roles']['GUEST'], 
			$config['roles']['STUDENT'], 
			$config['roles']['TEACHER'], 
			$config['roles']['COMMUNICATION'], 
			$config['roles']['SECRETARY'], 
			$config['roles']['ADMIN']]
			],
		'upload_marks' => ['pages/upload_marks.php', [
			$config['roles']['SECRETARY']]
			]
	],
	'default' => 'home',
	'not_found_page' => 'pages/not_found.php',
	'access_denied_page' => 'pages/access_denied.php',
	'protocol' => 'http'
];