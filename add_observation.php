<?php 
	require_once('classes/Observation.php');
	require_once('functions.php');
	session_start();

	$success = False;
	$errors = [];
	$isCancelled = isset($_POST['cancel']);
	$isSubmitted = isset($_POST['submit']);
	$isModifying = isset($_GET['modify']);
	$observation = new Observation();

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isSubmitted) {

		$observation -> spotter = trim(htmlspecialchars($_POST['spotter']));
		$observation -> amount = trim(htmlspecialchars($_POST['amount']));
		$observation -> place = trim(htmlspecialchars($_POST['place']));
		$observation -> date = trim(htmlspecialchars($_POST['date']));
		$observation -> description = trim(htmlspecialchars($_POST['description']));

		$errors = $observation -> errors;
	}

	// If no errors were found, we set $success to true - we check this later 
	// to determine whether to show a success message or not. 
	if (!count($observation -> errors) && $isSubmitted) {
		$success = True;
		$_SESSION['observation'] = $observation;
		header("location: confirmation.php");
		exit;
	}

	if ($isModifying && isset($_SESSION['observation'])) {
		$observation = $_SESSION['observation'];
	} else {
		unset($_SESSION['observation']);
	}

	if ($isCancelled) {
		unset($_SESSION['observation']);
		unset($observation);
	}



?>

<!DOCTYPE html>
<html>
	<?php include_head('Add 🐘 Spotting'); ?>
	<body>
		<div class="container">
			<?php include_navigation(array('active' => 'add_observation')); ?>
			<div class="content">
				<div class="message-container">
					<?php foreach ($errors as $error): ?>
						<div class="error-message">
							<span><?php echo $error ?></span>
						</div>
					<?php endforeach;  ?>
					<?php if ($success): ?>
						<div class="success-message">
							<span>Observation succesfully saved!</span>
						</div>
					<?php endif; ?>
				</div>
				<form action="" method="POST" class="observation-form">
				
					<div class="input-holder">
						<label for="spotter">Your name</label>
						<input id="spotter" name="spotter" type="text" value="<?php if (isset($observation)) echo $observation -> spotter ?>">
					</div>

					<div class="input-holder">
						<label for="amount">Amount of heffalumps</label>
						<input id="amount" name="amount" type="text" value="<?php if (isset($observation)) echo $observation -> amount ?>">
					</div>

					<div class="input-holder">
						<label for="place">Where you saw them (Zip Code)</label>
						<input id="place" name="place" type="text" value="<?php if (isset($observation)) echo $observation -> place ?>">
					</div>

					<div class="input-holder">
						<label for="date">When you saw them? (YYYY-MM-DD)</label>
						<input id="date" name="date" type="text" value="<?php if (isset($observation)) echo $observation -> date ?>">
					</div>

					<div class="input-holder">
						<label for="description">Description of the encounter</label>
						<textarea id="description" name="description"><?php if (isset($observation)) echo $observation -> description ?></textarea>
					</div>

					<div class="button-holder">
						<input type="submit" class="cancel" name="cancel" value="Cancel">
						<input type="submit" class="submit" name="submit" value="Submit">
					</div>

				</form>
			</div>
		</div>
		<script>
			console.log(`<?php print_r($observation) ?>`);
		</script>		
	</body>
</html>
