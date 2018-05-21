<?php 
	require_once('functions.php');
	require_once('classes/SpottingPDO.php');
	
	$db = new SpottingPDO();

	if (isset($_SERVER["CONTENT_TYPE"]) && $_SERVER["CONTENT_TYPE"] === 'application/json') {
		$search_results = $db -> search_by_name($_GET['q']);

		echo json_encode($search_results);
	} else {
?>

<!DOCTYPE html>
<html>
	<?php include_head('Search 🐘 Spottings'); ?>
	<body>
		<div class='container'>
			<?php include_navigation(array('active' => 'search')); ?>
			<div class='content'>
				<div class="search">
					<input id="search" type="text" placeholder="Spotter name" oninput="search(this)">
				</div>
				<div id="search-results">

				</div>
			</div>
		</div>		
	</body>
</html>

<?php
	}
?>
