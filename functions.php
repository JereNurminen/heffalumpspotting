<?php


function include_head($title) {
	$html_head = <<<HEREDOC
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>{$title}</title>
		<link rel="stylesheet" href="style/style.css" type="text/css">
	</head>
HEREDOC;
	echo $html_head;
}

function include_navigation($active) {
	$if = function($condition, $true, $false) { return $condition ? $true : $false; };
	$html_nav = <<<HEREDOC
	<nav>
		<ul>
			<li><a {$if($active == "index", "class='active'", "")} href="index.php">Home</a></li>
			<li><a {$if($active == "add_observation", "class='active'", "")} href="add_observation.php">Add a spotting</a></li>
			<li><a {$if($active == "list_spottings", "class='active'", "")} href="">Spottings</a></li>
			<li><a {$if($active == "settings", "class='active'", "")} href="">Settings</a></li>
		</ul>
	</nav>
HEREDOC;
	echo $html_nav;
}