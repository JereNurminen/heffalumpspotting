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
	$html_nav = <<<HEREDOC
	<nav>
		<ul>
			<li><a href="">Home</a></li>
			<li><a href="">Add a spotting</a></li>
			<li><a href="">Spottings</a></li>
			<li><a href="">Settings</a></li>
		</ul>
	</nav>
HEREDOC;
	echo $html_nav;
}