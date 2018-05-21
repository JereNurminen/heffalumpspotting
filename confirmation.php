<?php

	require_once('classes/Observation.php');
	require_once('functions.php');

	$db = get_db_connection();
	session_start();

	if ($_SESSION['observation']) {
		$observation = $_SESSION['observation'];
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$sql = 'INSERT INTO observations (spotter, amount, place, description, spot_time) VALUES (:spotter, :amount, :place, :description, :spot_time); ';
			$stmt = $db -> prepare($sql);
			$stmt -> bindValue(':spotter', 		$observation -> spotter, 		PDO::PARAM_STR);
			$stmt -> bindValue(':amount', 		$observation -> amount, 		PDO::PARAM_INT);
			$stmt -> bindValue(':place',		$observation -> place, 			PDO::PARAM_STR);
			$stmt -> bindValue(':description',	$observation -> description, 	PDO::PARAM_STR);
			$stmt -> bindValue(':spot_time',	$observation -> date, 			PDO::PARAM_STR);
			$stmt -> execute();
			
			unset($_SESSION['observation']);
		}
	} else {
		header("location: add_observation.php");
		exit;
	}



?>

<!DOCTYPE html>
<html>
	<?php include_head('Confirm 🐘 Spotting'); ?>
	<body>
		<div class="container">
			<?php include_navigation(array()); ?>
			<div class="content confirmation">

				<div class="message-container">
					<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
						<div class="success-message">
							<span>Spotting saved!</span>
						</div>
					<?php endif; ?>
				</div>

				<p class="observation">
					<strong><?php echo $observation -> spotter ?></strong> saw <strong><?php echo $observation -> amount ?></strong> Heffalump<?php if($observation -> amount > 1): echo 's'; endif; ?> in <strong><?php echo $observation -> place ?></strong> on <strong><?php echo $observation -> date ?></strong>.
				</p>

				<p class="quote">"<?php echo $observation -> description ?>"</p>

				<?php if ($_SERVER['REQUEST_METHOD'] === 'GET'): ?>
					<div class="button-holder">
						<a href="add_observation.php" class="cancel">Cancel</a>
						<a href="add_observation.php?modify=1" class="cancel">Modify</a>
						<form action="" class="confirm" method="POST">
							<button class="confirm">Confirm</button>
						</form>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</body>
</html>


