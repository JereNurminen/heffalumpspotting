<?php 
	require_once('classes/Observation.php');
	require_once('functions.php');

	$success = False;
	$errors = [];
	$isCancelled = isset($_POST['cancel']);
	$isSubmitted = isset($_POST['submit']);
	$observation = new Observation();

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isSubmitted) {

		$observation -> spotter = trim(htmlspecialchars($_POST['spotter']));
		$observation -> amount = trim(htmlspecialchars($_POST['amount']));
		$observation -> place = trim(htmlspecialchars($_POST['place']));
		$observation -> date = trim(htmlspecialchars($_POST['date']));
		$observation -> description = trim(htmlspecialchars($_POST['description']));

		$errors = $observation -> errors;

		// VALIDATION 
		/*
		if (strlen($observation -> spotter) > 32) {
			array_push($errors, "Name too long!");
		}

		if (!is_numeric($observation -> amount) && !empty($observation -> amount)) {
			array_push($errors, "The amount must be a&nbsp;number!");
		}

		if (is_numeric($observation -> amount) && $observation -> amount < 1) {
			array_push($errors, "The amount must be a&nbsp;positive&nbsp;number!");
		}

		if (!preg_match("/[0-9]{5}/", $observation -> place)) {
			array_push($errors, "Location not a valid Finnish&nbsp;Zip&nbsp;Code!");
		}

		if (!preg_match("/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/", $observation -> date)) {
			array_push($errors, "Date not formatted correctly!");
		}
		*/

	}

	// If no errors were found, we set $success to true - we check this later 
	// to determine whether to show a success message or not. 
	if (!count($observation -> errors) && $isSubmitted) {
		$success = True;
	}

?>

<!DOCTYPE html>
<html>
	<?php include_head('🐘 Heffalumpspotting'); ?>
	<body>
		<div class="container">
			<?php include_navigation('add'); ?>
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
				<form action="" method="POST">
				
					<div class="input-holder">
						<label for="spotter">Your name</label>
						<input required id="spotter" name="spotter" type="text" value="<?php if (count($errors)) echo $observation -> spotter ?>"></input>
					</div>

					<div class="input-holder">
						<label for="amount">Amount of heffalumps</label>
						<input required id="amount" name="amount" type="text" value="<?php if (count($errors)) echo $observation -> amount ?>"></input>
					</div>

					<div class="input-holder">
						<label for="place">Where you saw them (Zip Code)</label>
						<input required id="place" name="place" type="text" value="<?php if (count($errors)) echo $observation -> place ?>"></input>
					</div>

					<div class="input-holder">
						<label for="date">When you saw them? (YYYY-MM-DD)</label>
						<input required id="date" name="date" type="text" value="<?php if (count($errors)) echo $observation -> date ?>"></input>
					</div>

					<div class="input-holder">
						<label for="description">Description of the encounter</label>
						<textarea required id="description" name="description"><?php if (count($errors)) echo $observation -> description ?></textarea>
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
