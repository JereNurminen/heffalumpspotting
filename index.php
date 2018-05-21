<?php 
	require_once('classes/Observation.php');
	require_once('functions.php');
?>

<!DOCTYPE html>
<html>
	<?php include_head('🐘 Heffalumpspotting'); ?>
	<body>
		<div class="container">
			<?php include_navigation(array('active' => 'index')); ?>
			<div class="content">
				<h1>Hello<?php if (isset($_COOKIE["name"])): echo ' '.$_COOKIE["name"]; endif;?>!</h1>
				<h2>Welcome to Heffalumpspotting!</h2>
			</div>
		</div>		
	</body>
</html>
