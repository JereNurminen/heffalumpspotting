<?php 
	require_once('functions.php');
	$db = get_db_connection();

	if (isset($_SERVER["CONTENT_TYPE"]) && $_SERVER["CONTENT_TYPE"] === 'application/json') {
		$query = '%'.$_GET['q'].'%';

		$select_by_id_sql = 'SELECT * FROM observations WHERE spotter LIKE :q;';
		$select_by_id_stmt = $db -> prepare($select_by_id_sql);
		$select_by_id_stmt -> bindValue(':q', $query, PDO::PARAM_STR);
		$select_by_id_stmt -> execute();

		echo json_encode($select_by_id_stmt -> fetchAll());
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
			</div>
		</div>		
	</body>
</html>

<?php 
	}
?>
