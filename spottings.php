<?php

	require_once('classes/Observation.php');
	require_once('classes/SpottingPDO.php');
	require_once('functions.php');
	session_start();

	$db = new SpottingPDO();

	$method = $_SERVER['REQUEST_METHOD'];

	if ($method === 'POST' && $_POST['_method'] === 'delete') {
		$db -> delete_by_id($_POST['id']);
	} elseif ($method === 'GET' && isset($_GET['id'])) {
		$observation = $db -> select_by_id($_GET['id']);
		$show_details = True;
	}

	$observations = $db -> get_all();

?>

<!DOCTYPE html>
<html>
	<?php include_head('See 🐘 Spottings'); ?>
	<body>
		<div class='container'>
			<?php include_navigation(array('active' => 'spottings')); ?>
			<div class='content'>
				<?php if (!isset($show_details) || !$show_details): ?>
					<table class="spotting-table">
						<tr>
							<th></th>
							<th>Who?</th>
							<th>How many?</th>
							<th>When?</th>
							<th>Where?</th>
						</tr>
						<?php // while ($row = $select_all_stmt -> fetchObject()): ?>
						<?php foreach ($observations as $row): ?>

							<tbody class="observation">
								<tr>
									<td rowspan="2" class="row_id"><?php echo $row['id']; ?></td>
									<td><?php echo $row['spotter']; ?></td>
									<td><?php echo $row['amount']; ?></td>
									<td><?php echo $row['spot_time']; ?></td>
									<td><?php echo $row['place']; ?></td>
								</tr>
								<tr>
									<td colspan="4">
										<div class="button-holder">
											<form action="" class="delete" method="POST">
												<input type='hidden' name='id' value='<?php echo $row['id'] ?>'>
												<input type="hidden" name="_method" value="delete" />
												<button class="delete">Delete</button>
											</form>
											<form action="" class="details" method="GET">
												<input type='hidden' name='id' value='<?php echo $row['id'] ?>'>
												<button class="details">Details</button>
											</form>
										</div>
									</td>
								</tr>
							</tbody>

						<?php endforeach; ?>

					</table>
				<?php 
					elseif (isset($show_details) && $show_details): 
				?>
					<p class="observation">
					<strong><?php echo $observation['spotter'] ?></strong> saw <strong><?php echo $observation['amount'] ?></strong> Heffalump<?php if($observation['amount'] > 1): echo 's'; endif; ?> in <strong><?php echo $observation['place'] ?></strong> on <strong><?php echo $observation['spot_time'] ?></strong>.
					</p>
					<a href="spottings.php">Return</a>
				<?php endif; ?>
			</div>
		</div>		
	</body>
</html>

