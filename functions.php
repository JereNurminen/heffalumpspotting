<?php


function include_head($title) {
	$html_head = <<<HEREDOC
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>{$title}</title>
		<link rel="stylesheet" href="style/style.css" type="text/css">
		<script src="scripts/search.js"></script>
	</head>
HEREDOC;
	echo $html_head;
}

function include_navigation($params) {
	if (!isset($params['active'])) {
		$active = 'none';
	} else {
		$active = $params['active'];
	}
	$if = function($condition, $true, $false) { return $condition ? $true : $false; };
	$html_nav = <<<HEREDOC
	<nav>
		<ul>
			<li><a {$if($active == "index", "class='active'", "")} href="index.php">Home</a></li>
			<li><a {$if($active == "add_observation", "class='active'", "")} href="add_observation.php">Add a spotting</a></li>
			<li><a {$if($active == "spottings", "class='active'", "")} href="spottings.php">Spottings</a></li>
			<li><a {$if($active == "search", "class='active'", "")} href="search.php">Search</a></li>
			<li><a {$if($active == "settings", "class='active'", "")} href="settings.php">Settings</a></li>
		</ul>
	</nav>
HEREDOC;
	echo $html_nav;
}

function get_db_connection() {
	$db = new PDO('mysql:host=127.0.0.1;dbname=a1600526','heffalump','eib7ahnee0Oode7ahm9veizeefa5tail');
	$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

	return $db;
}