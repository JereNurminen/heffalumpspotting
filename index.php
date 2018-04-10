<?php 
	require_once('classes/Observation.php');
	require_once('functions.php');

	$success = False;
	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$observation = new Observation();

		$observation -> spotter = trim(htmlspecialchars($_POST['spotter']));
		$observation -> amount = trim(htmlspecialchars($_POST['amount']));
		$observation -> place = trim(htmlspecialchars($_POST['place']));
		$observation -> description = trim(htmlspecialchars($_POST['description']));

		/* VALIDATION */
		
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

		if (!count($errors)) {
			$success = True;
		}

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
						<input id="spotter" name="spotter" type="text" value="<?php if (count($errors)) echo $observation -> spotter ?>"></input>
					</div>

					<div class="input-holder">
						<label for="amount">Amount of heffalumps</label>
						<input id="amount" name="amount" type="text" value="<?php if (count($errors)) echo $observation -> amount ?>"></input>
					</div>

					<div class="input-holder">
						<label for="place">Where you saw them (Zip Code)</label>
						<input id="place" name="place" type="text" value="<?php if (count($errors)) echo $observation -> place ?>"></input>
					</div>

					<div class="input-holder">
						<label for="description">Description of the encounter</label>
						<textarea id="description" name="description">
							<?php if (count($errors)) echo $observation -> description ?>
						</textarea>
					</div>

					<div class="button-holder">
						<button class="cancel">Cancel</button>
						<button class="submit">Save</button>
					</div>

				</form>
			</div>
		</div>
	<script>
		console.log(`<?php print_r($observation) ?>`);
		console.log(`<?php print_r($errors) ?>`);
	</script>		

	</body>
</html>
