<?php

	require_once('classes/Observation.php');
	require_once('functions.php');
	session_start();

	$name = '';
	$success = False;
	
	if (isset($_COOKIE["name"])) {
		$name = $_COOKIE["name"];
	}

	if (isset($_POST['name'])) {
		setcookie("name", $_POST['name'], time() + (60 * 60 * 24 * 30));
		header("location: index.php");
	}

?>

<!DOCTYPE html>
<html>
	<?php include_head('🐘 Settings'); ?>
	<body>
		<div class="container">
			<?php include_navigation(array('active' => 'settings')); ?>
			<div class="content">
				<form action="" method="POST" class="observation-form">
				
					<div class="input-holder">
						<label for="name">Your name</label>
						<input id="name" name="name" type="text" value="<?php echo $name ?>">
					</div>

					<div class="button-holder">
						<input type="submit" class="submit" name="save" value="Save">
					</div>

				</form>
			</div>
		</div>
		<script>
			console.log(`<?php print_r($observation) ?>`);
		</script>		
	</body>
</html>
