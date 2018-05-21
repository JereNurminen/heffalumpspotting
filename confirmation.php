<?php

	require_once('classes/Observation.php');
	require_once('classes/SpottingPDO.php');	
	require_once('functions.php');
	
	$db = new SpottingPDO();
	session_start();

	if ($_SESSION['observation']) {
		$observation = $_SESSION['observation'];
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$db -> save($observation);
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


